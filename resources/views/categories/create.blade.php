@extends('layouts.admin', ['page_title' => 'New category'])

@section('content')

    <section>
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" name="title"
                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                       value="{{ old('title') }}" required>
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
