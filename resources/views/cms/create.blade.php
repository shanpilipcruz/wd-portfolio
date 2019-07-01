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
            <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3 mt-3">
                    <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-folder"></i>
                </span>
                    </div>
                    <input type="text" class="form-control" id="ProjectName" name="ProjectName" placeholder="Project Name" required aria-label="projectName">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-list-alt"></i>
                </span>
                    </div>
                    <textarea type="text" class="form-control" id="ProjectDescription" name="ProjectDescription" placeholder="Description" required aria-label="projectDescription"></textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                    </div>
                    <input type="text" class="form-control" id="ProjectAuthor" name="ProjectAuthor" placeholder="Author" required aria-label="projectAuthor">
                </div>
                <input type="file" class="form-control-file" id="ProjectImage" name="ProjectImage" required>
        </div>
        <div class="modal-footer">
                <button type="submit" class="btn btn-outline-secondary fa-pull-left">Save</button>
            </form>
            <a href="{{ action('DashboardController@index') }}" class="btn btn-outline-secondary fa-pull-right">Back</a>
        </div>
    </div>
@endsection
