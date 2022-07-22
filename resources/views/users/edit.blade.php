@extends('layouts.admin', ['page_title' => $user->name])

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
                <label for="surname">Surname</label>
                <input id="surname" type="text" name="surname"
                       class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}"
                       value="{{ old('surname') ?? $user->surname }}" required>
                @if($errors->has('surname'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('surname') }}
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

            <div class="form-group">
                <label for="country">Country</label>
                <input id="country" type="text" name="country"
                       class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                       value="{{ old('country') ?? $user->country  }}" required>
                @if($errors->has('country'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('country') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input id="city" type="text" name="city"
                       class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                       value="{{ old('city') ?? $user->city }}" required>
                @if($errors->has('city'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" type="text" name="address"
                       class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                       value="{{ old('address') ?? $user->address }}" required>
                @if($errors->has('address'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="post_code">Post Code</label>
                <input id="post_code" type="text" name="post_code"
                       class="form-control{{ $errors->has('post_code') ? ' is-invalid' : '' }}"
                       value="{{ old('post_code') ?? $user->post_code }}" required>
                @if($errors->has('post_code'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('post_code') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" type="text" name="phone"
                       class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                       value="{{ old('phone') ?? $user->phone }}" required>
                @if($errors->has('phone'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <label for="comission">Comission</label>
                <input id="comission" type="number" name="comission" min="0.00" step="0.01" max="100"
                       class="form-control{{ $errors->has('comission') ? ' is-invalid' : '' }}"
                       value="{{ old('comission') ?? $user->comission }}">
                @if($errors->has('comission'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('comission') }}
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
