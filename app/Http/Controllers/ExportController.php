<?php

namespace App\Http\Controllers;

use App\Exports\LotsExport;
use App\Http\Requests\ExportLotsRequest;
use App\Models\Lots;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
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
            ->when($ids, function($query) use($ids) {
                $query ->whereIn('id', $ids);
            })
            ->when($search, function (Builder $builder) use ($search) {
                $builder->where('lots.title', 'like', '%' . $search . '%');
            })
            ->orderBy('lots.' . $sort, $order)
            ->get();
        $columns = [];
        $newExp = new LotsExport($lots, $columns);
       
        return Excel::download($newExp, 'lots-' .Carbon::now(). '.xlsx');
    }
}
