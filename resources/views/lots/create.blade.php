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
                        <label for="artist">Artist</label>
                        <input id="artist" type="text" name="artist"
                               class="form-control{{ $errors->has('artist') ? ' is-invalid' : '' }}"
                               value="{{ old('artist') }}" required>
                        @if($errors->has('artist'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('artist') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="num">Num</label>
                        <input type="number" min="0" step="1" name="num" class="form-control {{ $errors->has('num') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="low_estimate">Low estimate</label>
                        <input type="number" min="0" step="1" name="low_estimate" class="form-control {{ $errors->has('low_estimate') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="high_estimate">High estimate</label>
                        <input type="number" min="0" step="1" name="high_estimate" class="form-control {{ $errors->has('high_estimate') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="starting_price">Starting price</label>
                        <input type="number" min="0" step="1" name="starting_price" class="form-control {{ $errors->has('starting_price') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="author">Category <small>(not required)</small></label>
                        <select name="author_id" id="author" class="form-control">
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
