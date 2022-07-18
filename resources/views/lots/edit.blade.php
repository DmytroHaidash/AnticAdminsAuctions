@extends('layouts.admin', ['page_title' => $lot->title])

@section('content')

    <section>
        <form action="{{ route('admin.lots.update', $lot) }}" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="{{ old('title') ?? $lot->title }}" required>
                        @if($errors->has('title'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <wysiwyg label="Description" name="description"
                             content="{{ old('description') ?? $lot->description }}"
                             class="mb-0"></wysiwyg>

                    <div class="form-group mt-4">
                        <label for="artist">Artist</label>
                        <input id="artist" type="text" name="artist"
                               class="form-control{{ $errors->has('artist') ? ' is-invalid' : '' }}"
                               value="{{ old('artist') ?? $lot->artist }}" required>
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
                        <input type="number" min="0" step="1" name="num" value="{{ old('num') ?? $lot->num }}"
                               class="form-control {{ $errors->has('num') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="low_estimate">Low estimate</label>
                        <input type="number" min="0" step="1" name="low_estimate" value="{{ old('low_estimate') ?? $lot->low_estimate }}"
                               class="form-control {{ $errors->has('low_estimate') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="high_estimate">High estimate</label>
                        <input type="number" min="0" step="1" name="high_estimate" value="{{ old('high_estimate') ?? $lot->high_estimate }}"
                               class="form-control {{ $errors->has('high_estimate') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="starting_price">Starting price</label>
                        <input type="number" min="0" step="1" name="starting_price" value="{{ old('starting_price') ?? $lot->starting_price }}"
                               class="form-control {{ $errors->has('starting_price') ? ' is-invalid' : '' }}">
                    </div>
                    <div class="mt-4">
                        <multi-uploader
                                :src="{{ json_encode(\App\Http\Resources\MediaResource::collection($lot->getMedia('uploads'))) }}"></multi-uploader>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection
