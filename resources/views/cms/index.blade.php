@extends('layouts.dashboard')

@section('content')
    @include('responses.form_error')
    @include('responses.form_success')
    @include('responses.form_warning')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h1 class="h2 flat">Dashboard</h1>
        <div class="btn-toolbar">
            <a href="{{ action('DashboardController@create') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fa fa-plus mr-1"></i>
                Create
            </a>
        </div>
    </div>
    <form method="POST">
        @csrf
        <div class="form-group-floating">
            <input id="search" type="text" class="form-control" name="search" required autocomplete="search" autofocus>
            <label for="search" class="form-control-placeholder-floating flat">Search</label>
        </div>
    </form>
    <div class="album py-5 bg-light">
        <div class="container">
            <?php $count = 1;?>
            @forelse($data['dashboard'] as $key => $projects)
                @if($count%4 == 1)
                    <div class="row">
                @endif
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-6 col-lg-3">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $projects->ProjectName }}</h3>
                                    <p class="card-text">
                                        {{ $projects->ProjectDescription }}
                                    </p>
                                    <hr>
                                    <small class="text-muted">Date Created:&nbsp;&nbsp;{{ $projects->updated_at }}</small>
                                    <small class="text-muted">Author:&nbsp;&nbsp;{{ $projects->ProjectAuthor }}</small>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="{{ route('dashboard.edit', $projects->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-eye"></i>
                                            Show
                                        </a>
                                        <form action="{{ route('dashboard.destroy', $projects->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                <i class="fa fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                @if($count%4 == 0)
                    </div>
                    <hr/>
                @endif
                <?php $count++ ?>
            @empty
                <center>
                    <h2 class="display-3">No Data Found</h2>
                </center>
            @endforelse
            @if($count%4 != 1)
                </div>
                <hr/>
            @endif
        </div>
    </div>
@endsection
