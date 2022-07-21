<?php

namespace App\Http\Controllers;

use App\Exports\LotsExport;
use App\Http\Requests\ExportLotsRequest;
use App\Models\Lots;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportOne(ExportLotsRequest $request)
    {
        $ids = $request->get('ids');
        $sort = $request->get('sort');
        $order = $request->get('order');
        $search = $request->get('search');
        $lots = Lots::query()
            ->select('lots.*', 'categories.title as category')
            ->leftJoin('categories', 'categories.id', '=', 'lots.category_id')
            ->when($ids, function ($query) use ($ids) {
                $query->whereIn('id', $ids);
            })
            ->when($search, function (Builder $builder) use ($search) {
                $builder->where('lots.title', 'like', '%' . $search . '%');
            })
            ->orderBy('lots.' . $sort, $order)
            ->get();
        $columns = getNouvelColumn();
        $filename = 'export-' . Carbon::now()->timestamp . '.xlsx';
        return Excel::download(new LotsExport($lots, $columns), $filename);
    }
}
