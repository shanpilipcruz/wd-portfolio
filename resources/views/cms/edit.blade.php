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
                    <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name" required aria-label="project_name" value="{{ $dashboard->ProjectName }}" autofocus>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-list-alt"></i>
                        </span>
                    </div>
                    <textarea type="text" class="form-control" id="project_description" name="project_description" placeholder="Description" required aria-label="project_description">{{ $dashboard->ProjectDescription }}</textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="project_author" name="project_author" placeholder="Author" required aria-label="project_author" value="{{ $dashboard->ProjectAuthor }}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-link"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="project_link" name="project_link" placeholder="Link to the Project" required aria-label="project_link" value="{{ $dashboard->ProjectLink }}">
                </div>
                <div class="input-group mt-3">
                    <div class="custom-file">
                        <label class="custom-file-label" for="ProjectImage">Choose File</label>s
                        <input type="file" class="custom-file-input" id="project_image" name="project_image">
                    </div>
                </div>
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
