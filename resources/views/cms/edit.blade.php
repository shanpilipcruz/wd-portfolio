@extends('layouts.dashboard');

@section('content')
    <div class="modal-content mt-5">
        <div class="modal-header">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h1 class="h2 flat modal-title">Edit {{ $dashboard->ProjectName }}</h1>
            </div>
        </div>
        <div class="modal-body">
            <img src="{{ URL::to('/') }}/images/project_images/{{ $dashboard->ProjectImage }}" class="img-thumbnail" alt="{{ $dashboard->ProjectImage }}" height="250" width="250">
            <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3 mt-3">
                    <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-folder"></i>
                </span>
                    </div>
                    <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Project Name" required aria-label="projectName" value="{{ $dashboard->ProjectName }}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-list-alt"></i>
                </span>
                    </div>
                    <textarea type="text" class="form-control" id="projectDescription" name="projectDescription" placeholder="Description" required aria-label="projectDescription">
                        {{ $dashboard->ProjectDescription }}
                    </textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                    </div>
                    <input type="text" class="form-control" id="projectAuthor" name="projectAuthor" placeholder="Author" required aria-label="projectAuthor" value="{{ $dashboard->ProjectAuthor }}">
                </div>
                <input type="file" class="form-control-file" id="projectImage" name="projectImage" required accept="*image/">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-outline-secondary fa-pull-left">Save</button>
            </form>
            <a href="{{ action('DashboardController@index') }}" class="btn btn-outline-secondary fa-pull-right">Back</a>
        </div>
    </div>
@endsection
