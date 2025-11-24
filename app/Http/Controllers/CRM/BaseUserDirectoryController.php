<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Jobs\SendRawEmailJob;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

abstract class BaseUserDirectoryController extends Controller
{
    protected const ROLE = '';
    protected const INDEX_VIEW = '';
    protected const SHOW_ROUTE_NAME = '';
    protected const CODE_PREFIX = '';
    protected const ENTITY_LABEL = 'Record';

    protected function baseSelectColumns(): array
    {
        return [
            'users.id',
            DB::raw('learner_status as status'),
            DB::raw('birth_date as dob'),
            'users.name',
            'users.last_name',
            'users.email',
            'users.work_email',
            'users.unknown_delegate_name',
            'users.house_number',
            'users.house_name',
            'users.address',
            'users.address2',
            'users.town',
            'users.county',
            'users.country',
            'users.years_at_address',
            'users.start_date',
            'users.vle',
            'users.external_login',
            'users.exclude_from_level_check',
            'users.third_party_reference',
            'users.old_reference',
            'users.telephone',
            'users.work_tel',
            'users.fax',
            'users.mobile',
            'users.ni_number',
            'users.payroll_reference',
            'users.job_type',
            'users.hours_worked',
            'users.nationality',
            'users.salutation',
            'users.job_title',
            'users.customer_id',
            'users.client_id',
            'users.owner_id',
            'users.customer_group',
            'users.currency',
            'users.funder',
            'users.source',
            'users.source_affiliate',
            'users.source_campaign',
            'users.staff_link',
            'users.staff_code',
            'users.supervisor_confirmer',
            'users.learner_delegate_type',
            'users.notes',
            'users.website',
            'users.image',
            'users.phone_number',
            'users.postal_code',
            'users.postcode',
            'users.b2b_customer',
            'users.ct_cctv',
            'users.ct_close_protection',
            'users.ct_cscs',
            'users.ct_door_supervisor',
            'users.ct_fire_marshall',
            'users.ct_first_aid',
            'users.ct_vehicle_banksman',
            'users.pm_letter',
            'users.pm_email',
            'users.pm_sms',
            'users.created_at',
        ];
    }

    protected function baseListSelectColumns(): array
    {
        return [
            'users.id',
            'users.name',
            'users.last_name',
            'users.email',
            'users.phone_number',
            'users.address',
            'users.created_at',
        ];
    }

    protected function totalCount(): int
    {
        return User::role(static::ROLE)->count();
    }

    protected function buildDirectoryQuery(Request $request)
    {
        $q = $request->get('q');
        $starts = $request->get('starts');

        $query = User::role(static::ROLE)
            ->select($this->baseListSelectColumns());

        if (!empty($starts)) {
            $query->where(function ($w) use ($starts) {
                $w->where('users.name', 'like', $starts . '%')
                    ->orWhereRaw(
                        "CONCAT(users.name,' ',COALESCE(users.last_name,'')) LIKE ?",
                        [$starts . '%']
                    );
            });
        }

        if (!empty($q)) {
            $needle = "%{$q}%";
            $query->where(function ($w) use ($needle) {
                $w->where('users.name', 'like', $needle)
                    ->orWhere('users.last_name', 'like', $needle)
                    ->orWhereRaw(
                        "CONCAT(users.name,' ',COALESCE(users.last_name,'')) LIKE ?",
                        [$needle]
                    )
                    ->orWhere('users.email', 'like', $needle)
                    ->orWhere('users.phone_number', 'like', $needle)
                    ->orWhere('users.address', 'like', $needle);
            });
        }

        return $query;
    }

    public function datatables(Request $request)
    {
        $query = $this->buildDirectoryQuery($request);
        $baseCount = (clone $query)->count();

        return DataTables::eloquent($query)
            ->addColumn('full_name', fn($u) => ucfirst(trim(($u->name ?? '') . ' ' . ($u->last_name ?? ''))))
            ->editColumn('email', fn($u) => $u->email ?? '—')
            ->editColumn('phone_number', fn($u) => $u->phone_number ?: '—')
            ->editColumn('address', fn($u) => $u->address ?: '—')
            ->addColumn('date', fn($u) => optional($u->created_at)->format('d M Y'))
            ->orderColumn('date', function ($q, $order) {
                $q->orderBy('users.created_at', $order);
            })
            ->with(['total' => $baseCount])
            ->toJson();
    }

    public function quick(Request $request)
    {
        $q = trim($request->get('q', ''));
        $starts = $request->get('starts');

        $query = User::role(static::ROLE)
            ->select([
                'users.id',
                'users.name',
                'users.last_name',
                'users.email',
                'users.created_at',
                DB::raw('LPAD(users.id, 6, "0") as seq_code'),
            ]);

        if ($starts) {
            $query->where(function ($w) use ($starts) {
                $w->where('users.name', 'like', $starts . '%')
                    ->orWhereRaw(
                        "CONCAT(users.name,' ',COALESCE(users.last_name,'')) LIKE ?",
                        [$starts . '%']
                    );
            });
        }

        if ($q !== '') {
            $needle = "%{$q}%";
            $query->where(function ($w) use ($needle) {
                $w->where('users.name', 'like', $needle)
                    ->orWhere('users.last_name', 'like', $needle)
                    ->orWhereRaw(
                        "CONCAT(users.name,' ',COALESCE(users.last_name,'')) LIKE ?",
                        [$needle]
                    )
                    ->orWhere('users.email', 'like', $needle);
            });
        }

        $rows = $query->orderBy('users.created_at', 'desc')
            ->limit(200)
            ->get();

        return response()->json([
            'items' => $rows->map(function ($u) {
                return [
                    'id' => $u->id,
                    'date' => optional($u->created_at)->format('d-m-Y'),
                    'name' => ucfirst(trim(($u->name ?? '') . ' ' . ($u->last_name ?? ''))),
                    'email' => $u->email,
                    'code' => static::CODE_PREFIX . $u->seq_code,
                    'show' => route(static::SHOW_ROUTE_NAME, $u->id),
                ];
            }),
        ]);
    }

    protected function buildDelegateData($id): array
    {
        $delegate = User::role(static::ROLE)
            ->select($this->baseSelectColumns())
            ->with(['contacts', 'profilePhoto'])
            ->findOrFail($id);

        $delegate->postal_code_normalized = $delegate->postal_code ?: $delegate->postcode;
        $delegate->image = optional($delegate->profilePhoto)->profile_photo;

        $clients = User::role('Corporate Client')->get();

        return compact('delegate', 'clients');
    }

    public function show($id)
    {
        ['delegate' => $delegate, 'clients' => $clients] = $this->buildDelegateData($id);

        return view(static::INDEX_VIEW_PREFIX() . '.show', [
            'delegate'    => $delegate,
            'clients'     => $clients,
            'customerId'  => $delegate->client_id ?? null,
        ]);
    }

    public function showJson($id)
    {
        ['delegate' => $delegate, 'clients' => $clients] = $this->buildDelegateData($id);

        return response()->json([
            'delegate'  => $delegate,
            'contacts'  => $delegate->contacts,
            'clients'   => $clients,
        ]);
    }
    protected static function INDEX_VIEW_PREFIX(): string
    {
        return rtrim(static::INDEX_VIEW, '.index');
    }

    public function updateOrStore(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'work_email' => ['nullable', 'email', 'max:255'],
            'unknown_delegate_name' => ['nullable', 'string', 'max:255'],
            'house_number' => ['nullable', 'string', 'max:255'],
            'house_name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'address2' => ['nullable', 'string', 'max:255'],
            'town' => ['nullable', 'string', 'max:255'],
            'county' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'years_at_address' => ['nullable', 'string', 'max:50'],
            'start_date' => ['nullable', 'date'],
            'vle' => ['nullable', 'string', 'max:255'],
            'external_login' => ['nullable', 'in:0,1'],
            'exclude_from_level_check' => ['nullable', 'in:0,1'],
            'third_party_reference' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
            'old_reference' => ['nullable', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:100'],
            'work_tel' => ['nullable', 'string', 'max:100'],
            'fax' => ['nullable', 'string', 'max:100'],
            'mobile' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:100'],
            'postcode' => ['nullable', 'string', 'max:100'],
            'dob' => ['nullable', 'date'],
            'ni_number' => ['nullable', 'string', 'max:100'],
            'payroll_reference' => ['nullable', 'string', 'max:255'],
            'job_type' => ['nullable', 'string', 'max:255'],
            'hours_worked' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:255'],
            'salutation' => ['nullable', 'string', 'max:50'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'customer_id' => ['nullable'],
            'client_id' => ['nullable'],
            'owner_id' => ['nullable'],
            'funder' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'source_affiliate' => ['nullable', 'string', 'max:255'],
            'source_campaign' => ['nullable', 'string', 'max:255'],
            'staff_link' => ['nullable', 'string', 'max:255'],
            'staff_code' => ['nullable', 'string', 'max:255'],
            'supervisor_confirmer' => ['nullable', 'string', 'max:255'],
            'customer_group' => ['nullable', 'string', 'max:255'],
            'currency' => ['nullable', 'string', 'max:10'],
            'learner_delegate_type' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:5000'],
            'b2b_customer' => ['nullable', 'boolean'],
            'ct_cctv' => ['nullable', 'boolean'],
            'ct_close_protection' => ['nullable', 'boolean'],
            'ct_cscs' => ['nullable', 'boolean'],
            'ct_door_supervisor' => ['nullable', 'boolean'],
            'ct_fire_marshall' => ['nullable', 'boolean'],
            'ct_first_aid' => ['nullable', 'boolean'],
            'ct_vehicle_banksman' => ['nullable', 'boolean'],
            'pm_letter' => ['nullable', 'boolean'],
            'pm_email' => ['nullable', 'boolean'],
            'pm_sms' => ['nullable', 'boolean'],
            'website' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'image', 'max:4096'],
            'contacts' => ['nullable', 'array'],
            'contacts.*.id' => ['nullable', 'integer', 'exists:user_contacts,id'],
            'contacts.*.name' => ['nullable', 'string', 'max:255'],
            'contacts.*.position' => ['nullable', 'string', 'max:255'],
            'contacts.*.direct_number' => ['nullable', 'string', 'max:255'],
            'contacts.*.direct_email' => ['nullable', 'email', 'max:255'],
            'contacts.*.mobile' => ['nullable', 'string', 'max:255'],
            'contacts.*.opt_out' => ['nullable', 'in:0,1'],
        ]);

        try {
            $result = DB::transaction(function () use ($data, $request, $id) {
                $contacts = $data['contacts'] ?? [];

                $isNew = empty($id) || $id === '0' || $id === 'new';

                if ($isNew) {
                    $user = new User();
                    $plainPassword = Str::random(10);
                    $user->password = Hash::make($plainPassword);
                } else {
                    $user = User::role(static::ROLE)
                        ->whereKey($id)
                        ->lockForUpdate()
                        ->firstOrFail();
                }

                $imageName = $user->image;

                $assign = [
                    'name',
                    'last_name',
                    'client_id',
                    'email',
                    'work_email',
                    'unknown_delegate_name',
                    'house_number',
                    'house_name',
                    'address',
                    'address2',
                    'town',
                    'county',
                    'country',
                    'years_at_address',
                    'vle',
                    'third_party_reference',
                    'old_reference',
                    'telephone',
                    'work_tel',
                    'fax',
                    'mobile',
                    'ni_number',
                    'payroll_reference',
                    'job_type',
                    'hours_worked',
                    'nationality',
                    'salutation',
                    'job_title',
                    'customer_id',
                    'owner_id',
                    'funder',
                    'source',
                    'source_affiliate',
                    'source_campaign',
                    'staff_link',
                    'staff_code',
                    'supervisor_confirmer',
                    'customer_group',
                    'currency',
                    'learner_delegate_type',
                    'notes',
                    'postal_code',
                    'postcode',
                    'website',
                    'b2b_customer',
                    'ct_cctv',
                    'ct_close_protection',
                    'ct_cscs',
                    'ct_door_supervisor',
                    'ct_fire_marshall',
                    'ct_first_aid',
                    'ct_vehicle_banksman',
                    'pm_letter',
                    'pm_email',
                    'pm_sms',
                ];

                foreach ($assign as $k) {
                    if (array_key_exists($k, $data)) {
                        $user->{$k} = $data[$k];
                    }
                }

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $uploadedFile = $request->file('image');
                    $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
                    $dir = storage_path('app/public/profile_images');

                    if (!is_dir($dir)) mkdir($dir, 0775, true);

                    $uploadedFile->move($dir, $fileName);
                    $imageName = 'storage/profile_images/' . $fileName;
                }

                $user->image = $imageName;

                if (array_key_exists('start_date', $data)) $user->start_date = $data['start_date'];
                if (array_key_exists('mobile', $data)) $user->phone_number = $data['mobile'];
                if (array_key_exists('dob', $data)) $user->birth_date = $data['dob'];
                if (array_key_exists('external_login', $data)) $user->external_login = $data['external_login'] === '1';
                if (array_key_exists('exclude_from_level_check', $data)) $user->exclude_from_level_check = $data['exclude_from_level_check'] === '1';
                if (array_key_exists('status', $data)) $user->learner_status = $data['status'];

                $flagFields = [
                    'ct_cctv',
                    'ct_close_protection',
                    'ct_cscs',
                    'ct_door_supervisor',
                    'ct_fire_marshall',
                    'ct_first_aid',
                    'ct_vehicle_banksman',
                    'pm_letter',
                    'pm_email',
                    'pm_sms',
                ];

                foreach ($flagFields as $field) {
                    $user->{$field} = $request->boolean($field) ? 1 : 0;
                }

                $user->save();

                if ($isNew) {
                    Mail::to($user->email)->send(new WelcomeEmail($user, $plainPassword));
                    $user->assignRole(static::ROLE);
                }

                if ($imageName) {
                    $user->profilePhoto()->updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'profile_photo' => $imageName,
                            'status' => 'In Progress',
                        ]
                    );
                }

                if (method_exists($user, 'contacts')) {
                    $existing = $user->contacts()->get()->keyBy('id');

                    $existingByEmail = $user->contacts()
                        ->whereNotNull('direct_email')
                        ->pluck('id', 'direct_email')
                        ->mapWithKeys(fn($id, $email) => [strtolower(trim($email)) => $id]);

                    foreach ($contacts as $row) {
                        $cid = $row['id'] ?? null;
                        $name = trim($row['name'] ?? '');
                        $email = strtolower(trim($row['direct_email'] ?? ''));
                        $phone = trim($row['direct_number'] ?? '');
                        $mobile = trim($row['mobile'] ?? '');

                        if ($name === '' && $email === '' && $phone === '' && $mobile === '') continue;

                        $contactData = [
                            'name' => $name,
                            'position' => $row['position'] ?? null,
                            'direct_number' => $phone ?: null,
                            'direct_email' => $email ?: null,
                            'mobile' => $mobile ?: null,
                            'opt_out' => !empty($row['opt_out']),
                        ];

                        if ($cid && isset($existing[$cid])) {
                            $existing[$cid]->update($contactData);
                            $existing->forget($cid);
                            continue;
                        }

                        if ($email && isset($existingByEmail[$email])) continue;

                        $user->contacts()->create($contactData);

                        if ($email) $existingByEmail[$email] = true;
                    }

                    foreach ($existing as $contact) {
                        $contact->delete();
                    }
                }

                return $user->fresh(['contacts']);
            });

            return response()->json([
                'success' => true,
                'message' => static::ENTITY_LABEL . ' saved successfully',
                'delegate' => $result,
                'redirect' => route('crm.learner.delegates.show', ['id' => $result->id]),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Save failed: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function sendEmail(Request $request, $id)
    {
        $data = $request->validate([
            'to'          => ['required', 'string'],
            'subject'     => ['required', 'string', 'min:2', 'max:190'],
            'html_body'   => ['required', 'string', 'min:1'],
            'attachments' => ['nullable', 'string'],
        ]);

        $toRaw     = trim($data['to'] ?? '');
        $addresses = array_filter(array_map('trim', explode(',', $toRaw)));

        if (!count($addresses)) {
            return response()->json([
                'message' => 'No recipient email provided',
            ], 422);
        }

        foreach ($addresses as $addr) {
            if (!filter_var($addr, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'message' => 'Invalid email: ' . $addr,
                ], 422);
            }
        }

        $attachmentsJson = $data['attachments'] ?? '[]';
        $attachments = [];
        try {
            $decoded = json_decode($attachmentsJson, true);
            if (is_array($decoded)) {
                $attachments = $decoded;
            }
        } catch (\Throwable $e) {
            $attachments = [];
        }

        try {
            $users = User::whereIn('email', $addresses)->get()->keyBy('email');

            foreach ($addresses as $addr) {
                $recipientUserId = optional($users->get($addr))->id;

                SendRawEmailJob::dispatch(
                    $addr,
                    $data['subject'],
                    $data['html_body'],
                    $attachments,
                    $recipientUserId
                )->delay(now()->addSeconds(5));
            }

            return response()->json(['ok' => true], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Email enqueue failed',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function customerDelegatesDt(Request $request, $id)
    {
        $query = User::query()
            ->where('client_id', $id)
            ->select([
                'users.id',
                DB::raw('CONCAT("D", LPAD(users.id, 6, "0")) as learner_code'),
                'users.name',
                'users.last_name',
                'users.town',
                'users.postal_code',
                'users.postcode',
                'users.telephone',
                'users.email',
                'users.status',
                'users.created_at',
            ]);

        return DataTables::eloquent($query)
            ->addColumn('full_name', fn($u) => ucfirst(trim(($u->name ?? '') . ' ' . ($u->last_name ?? ''))))
            ->addColumn('postal', fn($u) => $u->postal_code ?: $u->postcode ?: '—')
            ->editColumn('telephone', fn($u) => $u->telephone ?: '—')
            ->editColumn('town', fn($u) => $u->town ?: '—')
            ->editColumn('email', fn($u) => $u->email ?: '—')
            ->editColumn('status', function ($u) {
                $status = strtolower($u->status ?? 'inactive');
                $classes = [
                    'active'   => 'delegate-status active',
                    'pending'  => 'delegate-status pending',
                    'inactive' => 'delegate-status inactive',
                ];
                $class = $classes[$status] ?? $classes['inactive'];
                return '<span class="' . $class . '">' . ucfirst($status) . '</span>';
            })
            ->rawColumns(['status'])
            ->toJson();
    }
}
