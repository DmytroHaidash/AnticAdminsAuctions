@extends('layouts.admin', ['page_title' => 'Categories'])

@section('content')
    <p>Categories</p>
    <section>
        <table class="table">
            <thead class="small">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>

            @forelse($categories as $category)
                <tr>
                    <td width="20">{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td class="nobr">{{ $category->created_at->format('d.m.Y H:i') }}</td>
                    <td width="80" class="nobr">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="btn btn-warning btn-squire rounded-circle">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire rounded-circle"
                                onclick="deleteItem('{{ route('admin.categories.destroy', $category) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="4">Categories not added</td>
                </tr>
            @endforelse
        </table>

        <div class="my-4">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                Create category
            </a>
        </div>

        @include('partials.admin.restore-delete')

        {{ $categories->appends(request()->except('page'))->links() }}
    </section>

@endsection
