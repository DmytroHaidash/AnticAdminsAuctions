@extends('layouts.admin', ['page_title' => 'New lot'])

@section('content')

    <section>
        <form action="{{ route('admin.lots.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-8">
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

                    <wysiwyg label="Description" name="description" content="{{old('description')}}"
                             class="mb-0"></wysiwyg>

                    <div class="form-group mt-4">
                        <label for="author">Author</label>
                        <input id="author" type="text" name="author"
                               class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}"
                               value="{{ old('author') }}" required>
                        @if($errors->has('author'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('author') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="num">Num</label>
                        <input type="number" min="0" step="1" name="num" value="{{ old('num') }}"
                               class="form-control {{ $errors->has('num') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="low_estimate">Low estimate</label>
                        <input type="number" min="0" step="1" name="low_estimate" value="{{ old('low_estimate') }}"
                               class="form-control {{ $errors->has('low_estimate') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="high_estimate">High estimate</label>
                        <input type="number" min="0" step="1" name="high_estimate" value="{{ old('high_estimate') }}"
                               class="form-control {{ $errors->has('high_estimate') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="starting_price">Starting price</label>
                        <input type="number" min="0" step="1" name="starting_price" value="{{ old('starting_price') }}"
                               class="form-control {{ $errors->has('starting_price') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="category">Category <small>(not required)</small></label>
                        <select name="category_id" id="category" class="form-control">
                            <option value="">----</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <multi-uploader></multi-uploader>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection
