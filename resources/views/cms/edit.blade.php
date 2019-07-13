@extends('layouts.dashboard');

@section('content')
    @include('responses.form_error')
    @include('responses.form_success')
    @include('responses.form_warning')
    <div class="modal-content mt-2">
        <div class="modal-header">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h1 class="h2 flat modal-title">{{ $dashboard->ProjectName }}</h1>
            </div>
        </div>
        <div class="modal-body">
            <center>
                <img src="{{ URL::to('/') }}/images/project_images/{{ $dashboard->ProjectImage }}" class="img-fluid img-thumbnail rounded" style="max-width: 75%; height: auto;" alt="{{ $dashboard->ProjectImage }}">
            </center>
            <form action="{{ route('dashboard.update', $dashboard->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group mb-3 mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-folder"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="ProjectName" name="ProjectName" placeholder="Project Name" required aria-label="projectName" value="{{ $dashboard->ProjectName }}" autofocus>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-list-alt"></i>
                        </span>
                    </div>
                    <textarea type="text" class="form-control" id="ProjectDescription" name="ProjectDescription" placeholder="Description" required aria-label="projectDescription">{{ $dashboard->ProjectDescription }}</textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="ProjectAuthor" name="ProjectAuthor" placeholder="Author" required aria-label="projectAuthor" value="{{ $dashboard->ProjectAuthor }}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-link"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="ProjectLink" name="ProjectLink" placeholder="Link to the Project" required aria-label="projectLink" value="{{ $dashboard->ProjectLink }}">
                </div>
                <div class="input-group mt-3">
                    <div class="custom-file">
                        <label class="custom-file-label" for="ProjectImage">Choose File</label>s
                        <input type="file" class="custom-file-input" id="ProjectImage" name="ProjectImage">
                    </div>
                </div>
                <input type="hidden" class="form-control" id="existingProjectName" name="existingProjectName" placeholder="Project Name" required aria-label="existingProjectName" value="{{ $dashboard->ProjectName }}">
                <input type="hidden" class="form-control" id="existingProjectDescription" name="existingProjectDescription" placeholder="Project Description" required aria-label="existingProjectDescription" value="{{ $dashboard->ProjectDescription }}">
                <input type="hidden" class="form-control" id="existingProjectAuthor" name="existingProjectAuthor" placeholder="Project Author" required aria-label="existingProjectAuthor" value="{{ $dashboard->ProjectAuthor }}">
                <input type="hidden" class="form-control" id="existingProjectImage" name="existingProjectImage" placeholder="Project Image" aria-label="existingProjectImage" value="{{ $dashboard->ProjectImage }}">
                <input type="hidden" class="form-control" id="existingProjectLink" name="existingProjectLink" placeholder="Link to the Project" required aria-label="existingProjectLink" value="{{ $dashboard->ProjectLink }}">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-outline-secondary fa-pull-left">
                <i class="fa fa-save"></i>
                Update
            </button>
            </form>
            <a href="{{ action('DashboardController@index') }}" class="btn btn-outline-secondary fa-pull-right">
                <i class="fa fa-backspace"></i>
                Back
            </a>
        </div>
    </div>
@endsection
