<?php

namespace App\Http\Controllers;

use App\Models\Consigner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConsignersController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search') ?? '';
        $consigners = Consigner::query()
            ->when($search, function (Builder $builder) use ($search) {
                $builder->where('title', 'like', '%' . $search . '%');
            })
            ->when(!Auth::user()->hasRole('admin'), function (Builder $builder) {
                $builder->where('user_id', Auth::user()->id);
            })
            ->paginate();
        return view('consigners.index', compact('consigners'));
    }

    public function create(): View
    {
        return view('consigners.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Consigner::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'country' => $request->get('country'),
            'city' => $request->get('city'),
            'address' => $request->get('address'),
            'post_code' => $request->get('post_code'),
            'phone' => $request->get('phone'),
            'comission' => $request->get('comission'),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('admin.consigners.index')->with('success', 'Consigner created');
    }

    public function edit(Consigner $consigner): View
    {
        return view('consigners.edit', compact('consigner'));
    }

    public function update(Request $request, Consigner $consigner): RedirectResponse
    {
        $consigner->update([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'country' => $request->get('country'),
            'city' => $request->get('city'),
            'address' => $request->get('address'),
            'post_code' => $request->get('post_code'),
            'phone' => $request->get('phone'),
            'comission' => $request->get('comission'),
        ]);

        return redirect()->route('admin.consigners.index')->with('success', 'Consigner updated');
    }

    public function destroy(Consigner $consigner): RedirectResponse
    {
        $consigner->delete();
        return redirect()->back()->with('success', 'Consigner deleted');
    }
}
