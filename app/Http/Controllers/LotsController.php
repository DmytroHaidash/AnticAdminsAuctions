<?php

namespace App\Http\Controllers;

use App\Models\Lots;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        Lots::create([
            'title' => $request->get('title')
        ]);
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
        return back()->with('success', 'Lot updated.');
    }

    public function destroy(Lots $lot): RedirectResponse
    {
        $lot->delete();

        return redirect(route('admin.lots.index'))->with('success', 'Lot deleted');
    }
}
