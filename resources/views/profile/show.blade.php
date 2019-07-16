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
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h1 class="h2 flat">Profile</h1>
        <div class="btn-toolbar">
            <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fa fa-backspace mr-1"></i>
                Back
            </a>
        </div>
    </div>
    <div class="container">
        @if($user = auth()->user())
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <center style="margin-bottom: 30px;">
                            @auth
                                @if(auth()->user()->profile_img == null)
                                    <img src="{{ URL::to('/') }}/images/profile_images/default.png" class="img-thumbnail" alt="{{ $user->profile_img }}" width="275px" height="275px">
                                @else
                                    <img id="preview" src="{{ URL::to('/') }}/images/profile_images/{{ $user->profile_img }}" class="img-thumbnail" alt="{{ $user->profile_img }}" width="275px" height="275px">
                                @endif
                            @endauth
                            <input type="file" id="profile_img" name="profile_img" class="form-control-file mb-sm-3 mt-md-2">
                            <input type="hidden" id="image_name" name="image_name" />
                        </center>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-floating">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" autocomplete="first_name" autofocus required>
                                    <label for="first_name" class="form-control-placeholder-floating">First Name</label>
                                </div>
                                <div class="form-group-floating">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
                                    <label for="last_name" class="form-control-placeholder-floating">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-floating">
                                    <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ $user->middle_name }}" required>
                                    <label for="middle_name" class="form-control-placeholder-floating">Middle Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group-floating">
                            <input id="address" type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                            <label for="address" class="form-control-placeholder-floating">Address</label>
                        </div>
                        <div class="form-group-floating">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" autocomplete="email" required>
                            <label for="email" class="form-control-placeholder-floating">Email</label>
                        </div>
                        <div class="form-group-floating">
                            <input id="contact" type="text" class="form-control" name="contact" value="{{ $user->contact_number }}" required>
                            <label for="contact" class="form-control-placeholder-floating">Contact Number</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <textarea id="description" name="description" class="form-control" required maxlength="250" style="resize: none; height: 80px;">{{ $user->description }}</textarea>
                        <label for="description" class="form-control-placeholder-floating">Description</label>
                        <div class="fa-pull-right">
                            <p id="charNum" class="lead">250</p>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-edit mr-1"></i>
                    Update
                </button>
            </form>
        @endif
    </div>
@endsection
