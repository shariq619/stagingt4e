<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\UserAuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Cohort;
use App\Models\ProductInvoice;
use App\Models\ProductInvoiceLine;
use App\Models\PaymentAuditLog;
use App\Models\User;

class AuditController extends Controller
{
    public function cohortDt($cohortId, Request $request)
    {
        $cohort = Cohort::findOrFail($cohortId);

        $invoiceIds = ProductInvoice::where('cohort_id', $cohort->id)->pluck('id');
        $lineIds = ProductInvoiceLine::whereIn('invoice_id', $invoiceIds)->pluck('id');

        $piClass = addslashes(ProductInvoice::class);
        $pilClass = addslashes(ProductInvoiceLine::class);

        $base = PaymentAuditLog::query()
            ->leftJoin('users', 'users.id', '=', 'payment_audit_logs.user_id')
            ->select([
                'payment_audit_logs.*',
                DB::raw('users.name as user_name'),
                DB::raw("(CASE
                    WHEN payment_audit_logs.auditable_type = '{$piClass}'
                        THEN (SELECT pi.invoice_no FROM product_invoices pi WHERE pi.id = payment_audit_logs.auditable_id)
                    WHEN payment_audit_logs.auditable_type = '{$pilClass}'
                        THEN (SELECT p.invoice_no
                              FROM product_invoices p
                              JOIN product_invoice_lines pil ON pil.invoice_id = p.id
                              WHERE pil.id = payment_audit_logs.auditable_id
                              LIMIT 1)
                    ELSE NULL
                END) as auditable_invoice_no"),
            ])
            ->where(function ($outer) use ($invoiceIds, $lineIds) {
                $outer->where(function ($w) use ($invoiceIds) {
                    $w->where('payment_audit_logs.auditable_type', ProductInvoice::class)
                        ->whereIn('payment_audit_logs.auditable_id', $invoiceIds);
                })->orWhere(function ($w) use ($lineIds) {
                    $w->where('payment_audit_logs.auditable_type', ProductInvoiceLine::class)
                        ->whereIn('payment_audit_logs.auditable_id', $lineIds);
                });
            });

        return DataTables::of($base)
            ->filter(function ($query) use ($request, $piClass, $pilClass) {

                if ($request->filled('event')) {
                    $query->where('payment_audit_logs.event', $request->event);
                }
                if ($request->filled('from')) {
                    $query->where('payment_audit_logs.created_at', '>=', $request->from . ' 00:00:00');
                }
                if ($request->filled('to')) {
                    $query->where('payment_audit_logs.created_at', '<=', $request->to . ' 23:59:59');
                }
                if ($request->get('reassign') === '1') {
                    $query->where('payment_audit_logs.auditable_type', ProductInvoice::class)
                        ->where('payment_audit_logs.event', 'updated')
                        ->where(function ($w) {
                            $w->whereRaw('JSON_EXTRACT(payment_audit_logs.old_values, "$.cohort_id") IS NOT NULL')
                                ->orWhereRaw('JSON_EXTRACT(payment_audit_logs.new_values, "$.cohort_id") IS NOT NULL');
                        })
                        ->whereRaw('COALESCE(JSON_UNQUOTE(JSON_EXTRACT(payment_audit_logs.old_values, "$.cohort_id")), "") <> COALESCE(JSON_UNQUOTE(JSON_EXTRACT(payment_audit_logs.new_values, "$.cohort_id")), "")');
                }

                if ($request->filled('search.value')) {
                    $term = '%' . strtolower($request->input('search.value')) . '%';

                    $labelFrom = 'CONCAT(DATE_FORMAT(c_from.start_date_time, "%d-%m-%Y"), " – ", COALESCE(crsf.name, ""), IFNULL(CONCAT(" (", vf.venue_name, ")"), ""))';
                    $labelTo = 'CONCAT(DATE_FORMAT(c_to.start_date_time, "%d-%m-%Y"), " – ", COALESCE(crst.name, ""), IFNULL(CONCAT(" (", vt.venue_name, ")"), ""))';

                    $query->where(function ($w) use ($term, $piClass, $pilClass, $labelFrom, $labelTo) {
                        $w->orWhereRaw('LOWER(payment_audit_logs.event) like ?', [$term])
                            ->orWhereRaw('LOWER(payment_audit_logs.auditable_type) like ?', [$term])
                            ->orWhereRaw('CAST(payment_audit_logs.auditable_id AS CHAR) like ?', [$term])
                            ->orWhereRaw('LOWER(payment_audit_logs.ip) like ?', [$term])
                            ->orWhereRaw('LOWER(payment_audit_logs.user_agent) like ?', [$term])
                            ->orWhereRaw('LOWER(users.name) like ?', [$term])
                            ->orWhereRaw('LOWER(JSON_EXTRACT(payment_audit_logs.old_values, "$")) like ?', [$term])
                            ->orWhereRaw('LOWER(JSON_EXTRACT(payment_audit_logs.new_values, "$")) like ?', [$term])
                            ->orWhereRaw("(CASE
                                WHEN payment_audit_logs.auditable_type = '{$piClass}'
                                     THEN LOWER(COALESCE((SELECT pi.invoice_no FROM product_invoices pi WHERE pi.id = payment_audit_logs.auditable_id), ''))
                                WHEN payment_audit_logs.auditable_type = '{$pilClass}'
                                     THEN LOWER(COALESCE((SELECT p.invoice_no
                                                          FROM product_invoices p
                                                          JOIN product_invoice_lines pil ON pil.invoice_id = p.id
                                                          WHERE pil.id = payment_audit_logs.auditable_id
                                                          LIMIT 1), ''))
                                ELSE ''
                           END) like ?", [$term]);

                        $w->orWhereExists(function ($sq) use ($term) {
                            $sq->from('cohorts as c')
                                ->leftJoin('courses as crs', 'crs.id', '=', 'c.course_id')
                                ->leftJoin('venues as v', 'v.id', '=', 'c.venue_id')
                                ->whereRaw('c.id = CAST(JSON_UNQUOTE(JSON_EXTRACT(payment_audit_logs.old_values, "$.cohort_id")) AS UNSIGNED)')
                                ->whereRaw('LOWER(CONCAT(DATE_FORMAT(c.start_date_time, "%d-%m-%Y"), " – ", COALESCE(crs.name, ""), IFNULL(CONCAT(" (", v.venue_name, ")"), ""))) LIKE ?', [$term]);
                        });

                        $w->orWhereExists(function ($sq) use ($term) {
                            $sq->from('cohorts as c')
                                ->leftJoin('courses as crs', 'crs.id', '=', 'c.course_id')
                                ->leftJoin('venues as v', 'v.id', '=', 'c.venue_id')
                                ->whereRaw('c.id = CAST(JSON_UNQUOTE(JSON_EXTRACT(payment_audit_logs.new_values, "$.cohort_id")) AS UNSIGNED)')
                                ->whereRaw('LOWER(CONCAT(DATE_FORMAT(c.start_date_time, "%d-%m-%Y"), " – ", COALESCE(crs.name, ""), IFNULL(CONCAT(" (", v.venue_name, ")"), ""))) LIKE ?', [$term]);
                        });

                        $w->orWhereExists(function ($sq) use ($term, $labelFrom, $labelTo) {
                            $sq->from('cohorts as c_from')
                                ->leftJoin('courses as crsf', 'crsf.id', '=', 'c_from.course_id')
                                ->leftJoin('venues  as vf', 'vf.id', '=', 'c_from.venue_id')
                                ->leftJoin('cohorts as c_to', function ($j) {
                                    $j->on(DB::raw('1'), '=', DB::raw('1'));
                                })
                                ->leftJoin('courses as crst', 'crst.id', '=', 'c_to.course_id')
                                ->leftJoin('venues  as vt', 'vt.id', '=', 'c_to.venue_id')
                                ->whereRaw('c_from.id = CAST(JSON_UNQUOTE(JSON_EXTRACT(payment_audit_logs.old_values, "$.cohort_id")) AS UNSIGNED)')
                                ->whereRaw('c_to.id   = CAST(JSON_UNQUOTE(JSON_EXTRACT(payment_audit_logs.new_values, "$.cohort_id")) AS UNSIGNED)')
                                ->whereRaw('LOWER(CONCAT("from: ", ' . $labelFrom . ', " → to: ", ' . $labelTo . ')) LIKE ?', [$term]);
                        });
                    });
                }
            })
            ->filterColumn('payment_audit_logs.auditable_id', function ($q, $kw) use ($piClass, $pilClass) {
                $kw = '%' . strtolower($kw) . '%';
                $q->where(function ($w) use ($kw, $piClass, $pilClass) {
                    $w->orWhereRaw('LOWER(CAST(payment_audit_logs.auditable_id AS CHAR)) like ?', [$kw])
                        ->orWhereRaw("(CASE
                            WHEN payment_audit_logs.auditable_type = '{$piClass}'
                                 THEN LOWER(COALESCE((SELECT pi.invoice_no FROM product_invoices pi WHERE pi.id = payment_audit_logs.auditable_id), ''))
                            WHEN payment_audit_logs.auditable_type = '{$pilClass}'
                                 THEN LOWER(COALESCE((SELECT p.invoice_no
                                                      FROM product_invoices p
                                                      JOIN product_invoice_lines pil ON pil.invoice_id = p.id
                                                      WHERE pil.id = payment_audit_logs.auditable_id
                                                      LIMIT 1), ''))
                            ELSE ''
                      END) like ?", [$kw]);
                });
            })
            ->editColumn('auditable_id', function ($row) {
                $label = $row->auditable_invoice_no ?: $row->auditable_id;
                $href = url('/crm/invoices/' . $row->auditable_id);
                return '<a href="' . $href . '" target="_blank">' . e($label) . '</a>';
            })
            ->addColumn('changes_list', function ($row) {
                return $this->diffList($row);
            })
            ->addColumn('changes_btn', function ($row) {
                $n = count($this->diffList($row));
                if ($n <= 0) {
                    return '';
                }
                return '<button type="button" class="btn btn-changes" '
                    . 'data-id="' . e($row->id) . '" '
                    . 'data-at="' . e(optional($row->created_at)->format('Y-m-d H:i:s')) . '" '
                    . 'data-type="' . e(class_basename($row->auditable_type)) . '" '
                    . 'data-target="' . e($row->auditable_invoice_no ?: $row->auditable_id) . '">'
                    . 'Changes (' . $n . ')</button>';
            })
            ->editColumn('created_at', function ($row) {
                return optional($row->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('at', function ($row) {
                return optional($row->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('type', function ($row) {
                return class_basename($row->auditable_type);
            })
            ->addColumn('event_badge', function ($row) {
                $e = e($row->event);
                $cls = in_array($row->event, ['updated', 'created', 'restored']) ? 'b-upd' : 'b-del';
                return "<span class=\"badge {$cls}\">{$e}</span>";
            })
            ->addColumn('user_name', function ($row) {
                return $row->user_name ?: $row->user_id;
            })
            ->addColumn('is_reassignment', function ($row) {
                $old = $this->jsonArr($row->old_values);
                $new = $this->jsonArr($row->new_values);
                if ($row->auditable_type !== ProductInvoice::class || $row->event !== 'updated') {
                    return 0;
                }
                $o = $old['cohort_id'] ?? null;
                $n = $new['cohort_id'] ?? null;
                if ($o !== $n && $n !== null) {
                    return 1;
                }
                return 0;
            })
            ->addColumn('reassign_recap', function ($row) {
                $old = $this->jsonArr($row->old_values);
                $new = $this->jsonArr($row->new_values);
                $fromId = $old['cohort_id'] ?? null;
                $toId = $new['cohort_id'] ?? null;
                if ($row->auditable_type !== ProductInvoice::class || $row->event !== 'updated' || $fromId === $toId || $toId === null) {
                    return '';
                }
                $from = $this->cohortLabel($fromId);
                $to = $this->cohortLabel($toId);
                $fromHtml = e($from ?: $fromId);
                $toHtml = e($to ?: $toId);
                return "<div class=\"recap\"><span class=\"lab\">From:</span> {$fromHtml} <span class=\"lab\">→ To:</span> {$toHtml}</div>";
            })
            ->rawColumns(['event_badge', 'reassign_recap', 'auditable_id', 'changes_btn'])
            ->order(function ($q) {
                if (!request()->has('order')) {
                    $q->orderBy('payment_audit_logs.created_at', 'desc');
                }
            })
            ->toJson();
    }


    public function userDt($userId, Request $request)
    {
        $user = User::findOrFail($userId);

        if (!$request->ajax()) {
            return view('crm.customers.audit', compact('user'));
        }

        $base = UserAuditLog::from('user_audit_logs as ual')
            ->leftJoin('users', 'users.id', '=', 'ual.user_id')
            ->select([
                'ual.*',
                DB::raw('users.name as user_name'),
            ])
            ->where('ual.auditable_type', User::class)
            ->where('ual.auditable_id', $user->id);

        return DataTables::of($base)
            ->filter(function ($query) use ($request) {
                if ($request->filled('event')) {
                    $query->where('ual.event', $request->event);
                }
                if ($request->filled('from')) {
                    $query->where('ual.created_at', '>=', $request->from . ' 00:00:00');
                }
                if ($request->filled('to')) {
                    $query->where('ual.created_at', '<=', $request->to . ' 23:59:59');
                }
                if ($request->filled('search.value')) {
                    $term = '%' . strtolower($request->input('search.value')) . '%';
                    $query->where(function ($w) use ($term) {
                        $w->orWhereRaw('LOWER(ual.event) like ?', [$term])
                            ->orWhereRaw('LOWER(ual.auditable_type) like ?', [$term])
                            ->orWhereRaw('CAST(ual.auditable_id AS CHAR) like ?', [$term])
                            ->orWhereRaw('LOWER(ual.ip) like ?', [$term])
                            ->orWhereRaw('LOWER(ual.user_agent) like ?', [$term])
                            ->orWhereRaw('LOWER(users.name) like ?', [$term])
                            ->orWhereRaw('LOWER(JSON_EXTRACT(ual.old_values, "$")) like ?', [$term])
                            ->orWhereRaw('LOWER(JSON_EXTRACT(ual.new_values, "$")) like ?', [$term]);
                    });
                }
            })
            ->editColumn('auditable_id', function ($row) {
                $label = $row->auditable_id;

                if (!$label) {
                    return '-';
                }

                $delegate =User::find($label);

                if (!$delegate) {
                    return e($label);
                }

                $href = route('crm.customers.show', ['id' => $delegate->id]);

                return '<a href="' . e($href) . '" target="_blank">' . e($label) . '</a>';
            })


            ->addColumn('changes_list', function ($row) {
                return $this->diffList($row);
            })
            ->addColumn('changes_btn', function ($row) {
                $n = count($this->diffList($row));
                if ($n <= 0) {
                    return '';
                }
                return '<button type="button" class="btn btn-changes" '
                    . 'data-id="' . e($row->id) . '" '
                    . 'data-at="' . e(optional($row->created_at)->format('Y-m-d H:i:s')) . '" '
                    . 'data-type="' . e(class_basename($row->auditable_type)) . '" '
                    . 'data-target="' . e($row->auditable_id) . '">'
                    . 'Changes (' . $n . ')</button>';
            })
            ->editColumn('created_at', function ($row) {
                return optional($row->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('at', function ($row) {
                return optional($row->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('type', function ($row) {
                return class_basename($row->auditable_type);
            })
            ->addColumn('event_badge', function ($row) {
                $e = e($row->event);
                $cls = in_array($row->event, ['updated', 'created', 'restored']) ? 'b-upd' : 'b-del';
                return "<span class=\"badge {$cls}\">{$e}</span>";
            })
            ->addColumn('user_name', function ($row) {
                return $row->user_name ?: $row->user_id;
            })
            ->rawColumns(['event_badge', 'auditable_id', 'changes_btn'])
            ->order(function ($q) {
                if (!request()->has('order')) {
                    $q->orderBy('ual.created_at', 'desc');
                }
            })
            ->toJson();
    }

    private function diffList($row): array
    {
        $old = $this->jsonArr($row->old_values);
        $new = $this->jsonArr($row->new_values);
        $keys = array_values(array_unique(array_merge(array_keys($old), array_keys($new))));
        $hide = $this->hiddenSet(request('hide'));
        $out = [];
        foreach ($keys as $k) {
            if (isset($hide[$k])) {
                continue;
            }
            $ov = $old[$k] ?? null;
            $nv = $new[$k] ?? null;
            if ($this->valuesEqual($ov, $nv)) {
                continue;
            }
            $out[] = ['field' => (string)$k, 'old' => $this->show($ov), 'new' => $this->show($nv)];
        }
        return $out;
    }

    protected function jsonArr($v): array
    {
        if (is_array($v)) {
            return $v;
        }
        $a = json_decode($v ?? '[]', true);
        if (is_array($a)) {
            return $a;
        }
        return [];
    }

    protected function show($v)
    {
        if ($v === null || $v === '') {
            return '∅';
        }
        if (is_bool($v)) {
            return $v ? 'true' : 'false';
        }
        if (is_array($v)) {
            return json_encode($v);
        }
        return (string)$v;
    }

    protected function hiddenSet($csv): array
    {
        $out = [];
        foreach (explode(',', (string)$csv) as $p) {
            $p = trim($p);
            if ($p !== '') {
                $out[$p] = true;
            }
        }
        return $out;
    }

    protected function cohortLabel($id)
    {
        if (!$id) {
            return null;
        }
        $row = DB::table('cohorts as c')
            ->leftJoin('courses as crs', 'crs.id', '=', 'c.course_id')
            ->leftJoin('venues as v', 'v.id', '=', 'c.venue_id')
            ->where('c.id', (int)$id)
            ->select([
                DB::raw('DATE_FORMAT(c.start_date_time, "%d-%m-%Y") as course_date'),
                DB::raw('crs.name as course_name'),
                DB::raw('v.venue_name as venue_name'),
            ])->first();
        if (!$row) {
            return null;
        }
        return trim(($row->course_date ?? '') . ' – ' . ($row->course_name ?? '') . (empty($row->venue_name) ? '' : ' (' . $row->venue_name . ')'));
    }

    protected function valuesEqual($a, $b): bool
    {
        if ($a === $b) {
            return true;
        }
        if (is_numeric($a) && is_numeric($b)) {
            return ((float)$a == (float)$b);
        }
        if (is_bool($a) || is_bool($b)) {
            return ((bool)$a) === ((bool)$b);
        }
        if (is_array($a) && is_array($b)) {
            return json_encode($a) === json_encode($b);
        }
        if ($a === null && $b === '') {
            return true;
        }
        if ($b === null && $a === '') {
            return true;
        }
        return false;
    }
}
