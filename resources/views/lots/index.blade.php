@extends('layouts.admin', ['page_title' => 'Lots'])

@section('content')
    <section>
        <div class="my-4">
            <p>Lots</p>
            <a href="{{ route('admin.lots.create') }}" class="btn btn-primary">
                Create lot
            </a>
        </div>
        <form action=""></form>
        <table class="table">
            <thead class="small">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>

            @forelse($lots as $lot)
                <tr>
                    <td width="20">{{ $lot->id }}</td>
                    <td>{{ $lot->title }}</td>
                    <td class="nobr">{{ $lot->created_at->format('d.m.Y H:i') }}</td>
                    <td width="80" class="nobr">
                        <a href="{{ route('admin.lots.edit', $lot) }}"
                           class="btn btn-warning btn-squire rounded-circle">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire rounded-circle"
                                onclick="deleteItem('{{ route('admin.lots.destroy', $lot) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="4">Lots not added</td>
                </tr>
            @endforelse
        </table>

        @include('partials.admin.restore-delete')

        {{ $lots->appends(request()->except('page'))->links() }}
    </section>

@endsection
