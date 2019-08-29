@extends('layouts.dashboard');

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="modal-content mt-5">
        <div class="modal-header">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h1 class="h2 flat modal-title">Add a Project</h1>
            </div>
        </div>
        <div class="modal-body">
            <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data"> {{-- TODO: PUT THE UPLOADER ID HERE --}}
                @csrf
                <div class="input-group mb-3 mt-3">
                    <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-folder"></i>
                </span>
                    </div>
                    <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name" required aria-label="project_name">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-list-alt"></i>
                </span>
                    </div>
                    <textarea type="text" class="form-control" id="project_description" name="project_description" placeholder="Description" required aria-label="project_description" maxlength="250"></textarea>
                </div>
                <p id="characterCount" class="lead fa-pull-right">
                    250
                </p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="project_author" name="project_author" placeholder="Author" required aria-label="project_author" data-toggle="tooltip" title="put who developed the project, if not you or you just contributed, put your name and copyright." data-placement="bottom">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-link"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="project_link" name="project_link" placeholder="Link" required aria-label="project_link" data-toggle="tooltip" title="where the project is viewable or downloadable" data-placement="bottom">
                </div>
                <input type="file" class="form-control-file" id="project_image" name="project_image" required>
        </div>
        <div class="modal-footer">
                <button type="submit" class="btn btn-outline-secondary fa-pull-left">Save</button>
            </form>
            <a href="{{ action('DashboardController@index') }}" class="btn btn-outline-secondary fa-pull-right">Back</a>
        </div>
    </div>
@endsection
