<?php

namespace App\Http\Controllers;

use App\Models\Lots;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\MediaLibrary\Models\Media;

class LotsController extends Controller
{
    public function index(): View
    {
        $lots = Lots::latest()->paginate(20);
        return view('lots.index', compact('lots'));
    }

    public function create(): View
    {
        return view('lots.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $lot = Lots::create([
            'title' => $request->get('title')
        ]);
        $this->handleMedia($request, $lot);
        return back()->with('success', 'Lot created.');
    }

    public function edit(Lots $lot): View
    {
        return view('lots.edit', compact('lot'));
    }

    public function update(Request $request, Lots $lot): RedirectResponse
    {
        $lot->update([
            'title' => $request->get('title'),
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
}
