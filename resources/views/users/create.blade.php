@extends('layouts.admin', ['page_title' => 'New user'])

@section('content')

    <section>
        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="title">Name</label>
                <input id="title" type="text" name="name"
                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       value="{{ old('name') }}" required>
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
                        <option value="{{ $role }}">
                            {{  $role  }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       value="{{ old('email') }}" autocomplete="none" required>
                @if($errors->has('email'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

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

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection
