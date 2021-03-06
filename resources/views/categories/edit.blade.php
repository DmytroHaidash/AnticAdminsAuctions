@extends('layouts.admin', ['page_title' => $category->title])

@section('content')

    <section>
        <form action="{{ route('admin.categories.update', $category) }}" method="post">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" name="title"
                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                       value="{{ old('title') ?? $category->title}}" required>
                @if($errors->has('title'))
                    <div class="mt-1 text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection
