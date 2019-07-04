@extends('layouts.dashboard');

@section('content')
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
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="modal-content mt-5">
        <div class="modal-header">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h1 class="h2 flat modal-title">Edit {{ $dashboard->ProjectName }}</h1>
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
                <div class="input-group mt-3">
                    <div class="custom-file">
                        <label class="custom-file-label" for="ProjectImage">Choose File</label>s
                        <input type="file" class="custom-file-input" id="ProjectImage" name="ProjectImage">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-outline-secondary fa-pull-left">
                <i class="fa fa-save"></i>
                Save
            </button>
            </form>
            <a href="{{ action('DashboardController@index') }}" class="btn btn-outline-secondary fa-pull-right">
                <i class="fa fa-backspace"></i>
                Back
            </a>
        </div>
    </div>
@endsection
