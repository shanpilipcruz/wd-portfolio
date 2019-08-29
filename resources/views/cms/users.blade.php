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
                                    <?php try { ?>
                                        @if($usersData->Profile->profile_picture === null)
                                            <img class="img-thumbnail" src="{{ url('/') }}/images/profile_images/default.png" alt="default.png" height="150px" width="150px">
                                        @else
                                            <img class="img-thumbnail" src="{{ url('/') }}/images/profile_images/{{ $usersData->Profile->profile_picture }}" alt="{{ $usersData->Profile->profile_picture }}" height="150px" width="150px">
                                        @endif
                                    <?php } catch (ErrorException $e) {?>

                                    <?php } ?>
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
                                            <input type="text" id="first_name" name="first_name" class="form-control" readonly value="{{ $usersData->Profile->first_name }}" data-toggle="tooltip" data-placement="top" title="First Name">
                                            <input type="text" id="middle_name" name="middle_name" class="form-control" readonly value="{{ $usersData->Profile->middle_name }}" data-toggle="tooltip" data-placement="top" title="Middle Name">
                                            <input type="text" id="last_name" name="last_name" class="form-control" readonly value="{{ $usersData->Profile->last_name }}" data-toggle="tooltip" data-placement="top" title="Last Name">
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
                                            @if($usersData->Profile->address == null)
                                                <input type="text" id="address" class="form-control" readonly data-toggle="tooltip" data-placement="right" title="Address">
                                            @elseif($usersData->Profile->address != null)
                                                <input type="text" id="address" class="form-control" readonly value="{{ $usersData->Profile->address }}" data-toggle="tooltip" data-placement="right" title="Address">
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-phone-alt"></i>
                                                </span>
                                            </div>
                                            @if($usersData->Profile->contact_number == null)
                                                <input type="text" id="contact_number" class="form-control" readonly data-toggle="tooltip" data-placement="right" title="Contact">
                                            @elseif($usersData->Profile->contact_number != null)
                                                <input type="text" id="contact_number" class="form-control" readonly value="{{ $usersData->Profile->contact_number }}" data-toggle="tooltip" data-placement="right" title="Contact Number">
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-birthday-cake"></i>
                                                </span>
                                            </div>
                                            <input type="date" id="birth_date" name="birth_date" class="form-control" readonly value="{{ $usersData->Profile->birth_date->format('Y-m-d') }}" data-toggle="tooltip" data-placement="right" title="Birthday">
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
                    <td>{{ $users->Profile->first_name }}</td>
                    <td>{{ $users->Profile->middle_name }}</td>
                    <td>{{ $users->Profile->last_name }}</td>
                    <td>{{ $users->Profile->email }}</td>
                    <td>{{ $users->Profile->address }}</td>
                    <td class="text-center">
                        @if($loggedUser = auth()->user())
                            @if($loggedUser->id === $users->id)
                                <a href="#" data-toggle="modal" data-target="#view_{{ $users->id }}" class="text-muted">Show</a>
                                <a href="{{ action('UserProfileController@destroy', $users->id) }}" hidden class="text-muted">Delete</a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#view_{{ $users->id }}" class="text-muted">Show</a>
                                <a href="{{ action('UserProfileController@destroy', $users->id) }}" class="text-muted">Delete</a>
                            @endif
                        @endif
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection
