@extends('layouts.admin', ['page_title' => 'Lots'])

@section('content')
    <section>
        <div class="my-4">
            <p>Lots</p>
            <a href="{{ route('admin.lots.create') }}" class="btn btn-primary">
                Create lot
            </a>
        </div>
        <div>
            <lots-page></lots-page>
        </div>
    </section>

@endsection
