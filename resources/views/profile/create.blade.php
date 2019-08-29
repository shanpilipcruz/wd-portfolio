@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="mt-md-4 mt-lg-4 mt-sm-0">
            <div class="lead">
                Hello! {{ $userid->username }} kindly create your profile below!
            </div>
            @include('responses.form_success')
            @include('responses.form_error')
            @include('responses.form_warning')
            <br>
            <hr class="my-4">
            <form action="{{ action('UserProfileController@store', $userid->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-12">
                        <center style="margin-bottom: 30px;">
                            @auth
                                <img src="{{ URL::to('/') }}/images/profile_images/default.png" class="img-thumbnail" alt="user_picture" width="275px" height="275px">
                            @endauth
                            <input type="file" id="profile_img" name="profile_img" class="form-control-file mb-sm-3 mt-md-2">
                            <input type="hidden" id="profile_picture" name="profile_picture" />
                        </center>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-floating">
                                    <input id="first_name" type="text" class="form-control" name="first_name" autocomplete="first_name" autofocus required>
                                    <label for="first_name" class="form-control-placeholder-floating">First Name</label>
                                </div>
                                <div class="form-group-floating">
                                    <input id="last_name" type="text" class="form-control" name="last_name" required>
                                    <label for="last_name" class="form-control-placeholder-floating">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-floating">
                                    <input id="middle_name" type="text" class="form-control" name="middle_name" required>
                                    <label for="middle_name" class="form-control-placeholder-floating">Middle Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group-floating">
                            <input id="address" type="text" class="form-control" name="address" required>
                            <label for="address" class="form-control-placeholder-floating">Address</label>
                        </div>
                        <div class="form-group-floating">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $userid->email }}" autocomplete="email" required>
                            <label for="email" class="form-control-placeholder-floating">Email</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-floating">
                                    <input id="contact_number" type="text" class="form-control" name="contact_number" required>
                                    <label for="contact_number" class="form-control-placeholder-floating">Contact Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="birth_date" name="birth_date" class="form-control">
                                <label for="birth_date" class="form-control-placeholder-floating">Birth Date</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-secondary fa-pull-right">
                    <i class="fa fa-save mr-1"></i>
                    Save
                </button>
            </form>
        </div>
    </div>
@endsection
