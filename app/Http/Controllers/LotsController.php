<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllLotsRequest;
use App\Http\Requests\LotsRequest;
use App\Http\Resources\LotsPaginatedResource;
use App\Models\Category;
use App\Models\Consigner;
use App\Models\Lots;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\MediaLibrary\Models\Media;

class LotsController extends Controller
{
    public function index(): View
    {
        return view('lots.index');
    }

    public function create(): View
    {
        $categories = Category::where('user_id', Auth::user()->id)->latest()->get();
        $consigners = Consigner::where('user_id', Auth::user()->id)->latest()->get();
        return view('lots.create', compact('categories', 'consigners'));
    }

    public function store(LotsRequest $request): RedirectResponse
    {
        $lot = Lots::create([
            'title' => $request->get('title'),
            'user_id' => Auth::user()->id,
            'description' => $request->get('description'),
            'author' => $request->get('author'),
            'num' => $request->get('num'),
            'category_id' => $request->get('category_id'),
            'consigner_id' => $request->get('consigner_id'),
            'low_estimate' => $request->get('low_estimate'),
            'high_estimate' => $request->get('high_estimate'),
            'starting_price' => $request->get('starting_price'),
        ]);
        $this->handleMedia($request, $lot);
        return back()->with('success', 'Lot created.');
    }

    public function edit(Lots $lot): View
    {
        $categories = Category::where('user_id', Auth::user()->id)->latest()->get();
        $consigners = Consigner::where('user_id', Auth::user()->id)->latest()->get();
        return view('lots.edit', compact('lot', 'consigners', 'categories'));
    }

    public function update(Request $request, Lots $lot): RedirectResponse
    {
        $lot->update([
            'title' => $request->get('title'),
            'account_id' => Auth::user()->id,
            'description' => $request->get('description'),
            'author' => $request->get('author'),
            'num' => $request->get('num'),
            'category_id' => $request->get('category_id'),
            'consigner_id' => $request->get('consigner_id'),
            'low_estimate' => $request->get('low_estimate'),
            'high_estimate' => $request->get('high_estimate'),
            'starting_price' => $request->get('starting_price'),
        ]);
        $this->handleMedia($request, $lot);
        return back()->with('success', 'Lot updated.');
    }

    public function destroy(Lots $lot): RedirectResponse
    {
        $lot->delete();

        return redirect(route('admin.lots.index'))->with('success', 'Lot deleted');
    }

    private function handleMedia(Request $request, Lots $lot): void
    {
        if ($request->filled('uploads')) {
            foreach ($request->input('uploads') as $media) {
                Media::find($media)->update([
                    'model_type' => Lots::class,
                    'model_id' => $lot->id
                ]);
            }

            Media::setNewOrder($request->input('uploads'));
        }

        if ($request->filled('deletion')) {
            Media::whereIn('id', $request->input('deletion'))->delete();
        }
    }

    public function getLots(AllLotsRequest $request): JsonResponse
    {
        $search = $request->get('search');
        $sort = $request->get('sort');
        $order = $request->get('order');
        $lots = Lots::query()
            ->select([
                'lots.*',
                'categories.title as category',
                DB::raw('CONCAT(consigners.name, " " ,consigners.surname) as consigner')
                ])
            ->when($search, function (Builder $builder) use ($search) {
                $builder->where('lots.title', 'like', '%' . $search . '%');
            })
            ->orderBy($sort, $order)
            ->leftJoin('categories', 'categories.id', '=', 'lots.category_id')
            ->leftJoin('consigners', 'consigners.id', '=', 'lots.consigner_id')
            ->paginate(20);

        return response()->json(new LotsPaginatedResource($lots));
    }
}
