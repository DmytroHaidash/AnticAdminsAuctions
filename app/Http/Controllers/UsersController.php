<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSavingRequest;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\MessageBag;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->get('search') ?? '';
        $users = User::query()
            ->when($search, function (Builder $builder) use ($search) {
                $builder->where('name', 'like', '%' . $search . '%')
                    ->orWhere('surname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(20);
        return view('users.index', compact('users'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * @param UserSavingRequest $request
     * @return RedirectResponse
     */
    public function store(UserSavingRequest $request): RedirectResponse
    {
        $attrs = $request->only('name', 'surname', 'email', 'role', 'country', 'city', 'address', 'post_code', 'phone', 'comission');
        $attrs['password'] = Hash::make($request->input('password'));

        $user = User::create($attrs);

        return redirect(route('admin.users.edit', $user))->with('success', 'User created.');
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * @param UserSavingRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserSavingRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->only('name', 'surname', 'email', 'role', 'country', 'city', 'address', 'post_code', 'phone', 'comission'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return back()->with('success', 'User updated.');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws /Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect(route('admin.users.index'))->with('success', 'User deleted');
    }

}
