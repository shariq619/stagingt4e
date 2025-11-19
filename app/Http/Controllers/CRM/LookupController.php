<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{NominalCode, ProjectCode, Source, Department};

class LookupController extends Controller
{
    public function index(Request $req, string $type)
    {
        $q = trim((string)$req->get('q', ''));
        $page = max(1, (int)$req->get('page', 1));
        $perPage = 20;

        $map = [
            'nominal-codes' => [NominalCode::query(), ['code', 'description']],
            'project-codes' => [ProjectCode::query(), ['code', 'description']],
            'sources' => [Source::query(), ['code', 'name', 'contact', 'email', 'telephone']],
            'departments' => [Department::query(), ['code', 'description']],
        ];
        abort_unless(isset($map[$type]), 404);

        [$builder, $cols] = $map[$type];
        if ($q !== '') {
            $builder->where(function ($w) use ($cols, $q) {
                foreach ($cols as $i => $col) {
                    $i ? $w->orWhere($col, 'like', "%$q%") : $w->where($col, 'like', "%$q%");
                }
            });
        }
        $builder->orderBy($cols[0]);
        $results = $builder->paginate($perPage, ['*'], 'page', $page);

        $items = $results->items();
        $data = array_map(function ($row) use ($type) {
            if ($type === 'sources') {
                $label = "{$row->code} — {$row->name}";
            } else {
                $desc = $row->description ?? '';
                $label = trim($row->code . ($desc ? " — {$desc}" : ''));
            }
            return ['id' => $row->id, 'text' => $label];
        }, $items);

        return response()->json([
            'results' => $data,
            'pagination' => ['more' => $results->hasMorePages()],
        ]);
    }
}
