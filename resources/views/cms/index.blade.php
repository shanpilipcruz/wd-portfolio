@extends('layouts.dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h1 class="h2 flat">Dashboard</h1>
        <div class="btn-toolbar">
            <a href="{{ action('DashboardController@create') }}" class="btn btn-sm btn-outline-secondary">Create</a>
        </div>
    </div>
    <form method="POST">
        @csrf
        <div class="form-label-group mb-3">
            <input id="search" class="form-control form-control-lg" type="text" placeholder="Search" aria-label="Search" autocomplete="off">
            <label for="search">Search</label>
        </div>
    </form>
    @foreach($data as $key)
        @if($key > 1)
            <div class="card" style="width: 18rem;">
                <img src="{{ URL::to('/') }}/images/project_images/{{ $key->ProjectImage }}" class="card-img-top" alt="{{ $key->ProjectImage }}">
                <div class="card-body">
                    <h5 class="card-title">$key->ProjectName</h5>
                    <p class="card-text">$key->ProjectDescription</p>
                    <a href="{{ route('dashboard.edit', $key->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        @elseif($key < 1)
            <div class="alert alert-warning" role="alert">
                The database has no content yet.
            </div>
        @endif
    @endforeach
@endsection
