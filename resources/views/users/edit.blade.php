@extends('layouts.admin', ['page_title' => 'Новый пользователь'])

@section('content')

    <section>
        <form action="{{ route('admin.users.update', $user) }}" method="post">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="title">Name</label>
                <input id="title" type="text" name="name"
                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       value="{{ old('name')  ?? $user->name }}" required>
                @if($errors->has('name'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    @foreach(\App\Models\User::$roles as $role)
                        <option value="{{ $role }}" {{ $role === $user->role ? 'selected' : '' }}>
                            {{$role}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       value="{{ old('email') ?? $user->email}}" autocomplete="none" required disabled="disabled">
                @if($errors->has('email'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <password-change inline-template>
                <div class="passwords">
                    <div class="custom-control custom-checkbox mt-4 mb-2">
                        <input type="checkbox" class="custom-control-input" id="show_passwords" @change="toggle">
                        <label class="custom-control-label" for="show_passwords">Change password</label>
                    </div>

                    <fieldset v-if="visible">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   autocomplete="none" required>
                            @if($errors->has('password'))
                                <div class="mt-1 text-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   autocomplete="none" required>
                        </div>
                    </fieldset>
                </div>
            </password-change>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection
