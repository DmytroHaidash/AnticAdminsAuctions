@extends('layouts.admin', ['page_title' => 'Users'])

@section('content')

    <section>
        <div class="my-4 justify-content-center">
            <p>Users</p>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                Create user
            </a>
        </div>

        <table class="table">
            <thead class="small">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Country</th>
                <th>City</th>
                <th>Address</th>
                <th>Post code</th>
                <th>Phone</th>
                <th>Comission</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>

            @foreach($users as $user)
                <tr>
                    <td width="20">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->country }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->post_code }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->comission }}</td>
                    <td class="nobr">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                    <td width="80" class="nobr">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="btn btn-warning btn-squire rounded-circle">
                            <i class="i-pencil"></i>
                        </a>

                        @if (Auth::user()->id !== $user->id)
                            <button class="btn btn-danger btn-squire rounded-circle"
                                    onclick="deleteItem('{{ route('admin.users.destroy', $user) }}')">
                                <i class="i-trash"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        @include('partials.admin.restore-delete')

        {{ $users->appends(request()->except('page'))->links() }}
    </section>

@endsection
