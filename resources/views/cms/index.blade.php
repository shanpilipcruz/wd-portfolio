@extends('layouts.dashboard')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                                <img src="{{ URL::to('/') }}/images/project_images/{{ $projects->ProjectImage }}" class="card-img-top img-responsive" style="max-width: 100%;" alt="{{ $projects->ProjectImage }}">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $projects->ProjectName }}</h3>
                                    <p class="card-text">
                                        {{ $projects->ProjectDescription }}
                                    </p>
                                    <hr>
                                    <small class="text-muted">Date Created:&nbsp;{{ $projects->updated_at }}</small>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="btn-group">
                                            <a href="{{ route('dashboard.edit', $projects->id) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            <a href="{{ route('dashboard.destroy', $projects->id) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="fa fa-trash"></i>
                                                Delete
                                            </a>
                                        </div>
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
                <h2 class="display-3">No Data Found</h2>
            @endforelse
            @if($count%4 != 1)
                </div>
                <hr/>
            @endif
        </div>
    </div>
@endsection
