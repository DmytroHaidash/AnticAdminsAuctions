@extends('layouts.admin', ['page_title' => 'Consigners'])

@section('content')

    <section>
        <div class="my-4 justify-content-center">
            <p>Consigners</p>
            <a href="{{ route('admin.consigners.create') }}" class="btn btn-primary">
                Create consigner
            </a>
        </div>

        <table class="table">
            <thead class="small">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
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

            @foreach($consigners as $consigner)
                <tr>
                    <td width="20">{{ $consigner->id }}</td>
                    <td>{{ $consigner->name }}</td>
                    <td>{{ $consigner->surname }}</td>
                    <td>{{ $consigner->email }}</td>
                    <td>{{ $consigner->country }}</td>
                    <td>{{ $consigner->city }}</td>
                    <td>{{ $consigner->address }}</td>
                    <td>{{ $consigner->post_code }}</td>
                    <td>{{ $consigner->phone }}</td>
                    <td>{{ $consigner->comission }}</td>
                    <td class="nobr">{{ $consigner->created_at->format('d.m.Y H:i') }}</td>
                    <td width="80" class="nobr">
                        <a href="{{ route('admin.consigners.edit', $consigner) }}"
                           class="btn btn-warning btn-squire rounded-circle">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire rounded-circle"
                                onclick="deleteItem('{{ route('admin.consigners.destroy', $consigner) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>

        @include('partials.admin.restore-delete')

        {{ $consigners->appends(request()->except('page'))->links() }}
    </section>

@endsection
