@extends('layouts.dashboard')
@section('content')
    @include('responses.form_error')
    @include('responses.form_success')
    @include('responses.form_warning')
    @foreach($userData as $usersData)
        <div id="view_{{ $usersData->id }}" class="modal fade" role="dialog">
            <div class="modal-lg modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">User Information</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <center>
                                    @if($usersData->profile_img === null)
                                        <img src="{{ url('/') }}/images/profile_images/default.png" alt="default.png" height="150px" width="150px">
                                    @else
                                        <img src="{{ url('/') }}/images/profile_images/{{ $usersData->profile_img }}" alt="{{ $usersData->profile_img }}" height="150px" width="150px">
                                    @endif
                                </center>
                                <br>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="first_name" name="first_name" class="form-control" readonly value="{{ $usersData->first_name }}" data-toggle="tooltip" data-placement="top" title="First Name">
                                            <input type="text" id="middle_name" name="middle_name" class="form-control" readonly value="{{ $usersData->middle_name }}" data-toggle="tooltip" data-placement="top" title="Middle Name">
                                            <input type="text" id="last_name" name="last_name" class="form-control" readonly value="{{ $usersData->last_name }}" data-toggle="tooltip" data-placement="top" title="Last Name">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="email" id="email" class="form-control" readonly value="{{ $usersData->email }}" data-toggle="tooltip" data-placement="right" title="Email">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-home"></i>
                                                </span>
                                            </div>
                                            @if($usersData->address == null)
                                                <input type="text" id="address" class="form-control" readonly data-toggle="tooltip" data-placement="right" title="Address">
                                            @elseif($usersData->address != null)
                                                <input type="text" id="address" class="form-control" readonly value="{{ $usersData->address }}" data-toggle="tooltip" data-placement="right" title="Address">
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-phone-alt"></i>
                                                </span>
                                            </div>
                                            @if($usersData->contact_number == null)
                                                <input type="text" id="contact_number" class="form-control" readonly data-toggle="tooltip" data-placement="right" title="Contact">
                                            @elseif($usersData->contact_number != null)
                                                <input type="text" id="contact_number" class="form-control" readonly value="{{ $usersData->contact_number }}" data-toggle="tooltip" data-placement="right" title="Contact">
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user-edit"></i>
                                                </span>
                                            </div>
                                            @if($usersData->description == null)
                                                <input type="text" id="description" class="form-control" readonly data-toggle="tooltip" data-placement="right" title="Description">
                                            @elseif($usersData->description != null)
                                                <input type="text" id="description" class="form-control" readonly value="{{ $usersData->description }}" data-toggle="tooltip" data-placement="right" title="Description">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 fa-pull-right">
                                    Updated: <p class="lead">{{ $usersData->updated_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="container-fluid">
        <table class="table table-hover">
            <thead>
            <tr class="text-center">
                <th class="flat">First Name</th>
                <th class="flat">Middle Name</th>
                <th class="flat">Last Name</th>
                <th class="flat">Email</th>
                <th class="flat">Address</th>
                <th class="flat">Action</th>
            </tr>
            </thead>
            @foreach($userData as $users)
            <tbody>
                <tr>
                    <td>{{ $users->first_name }}</td>
                    <td>{{ $users->middle_name }}</td>
                    <td>{{ $users->last_name }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{ $users->address }}</td>
                    <td>
                        @if($loggedUser = auth()->user())
                            @if($loggedUser->id === $users->id)
                                <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#view_{{ $users->id }}" style="width: 140px;">Show</a>
                                <a href="{{ action('UserProfileController@destroy', $users->id) }}" class="btn btn-outline-warning" style="visibility: hidden;">Delete</a>
                            @else
                                <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#view_{{ $users->id }}">Show</a>
                                <a href="{{ action('UserProfileController@destroy', $users->id) }}" class="btn btn-outline-warning">Delete</a>
                            @endif
                        @endif
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection
