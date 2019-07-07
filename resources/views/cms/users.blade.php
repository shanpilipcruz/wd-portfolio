@extends('layouts.dashboard')
{{--TODO: FINISH DESIGNING UI OF THIS FIELD--}}
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
    <div class="container-fluid">
        @foreach($data as $users)
            <table class="table table-hover">
                <thead>
                <tr class="text-center">
                    <th class="flat">id</th>
                    <th class="flat">First Name</th>
                    <th class="flat">Middle Name</th>
                    <th class="flat">Last Name</th>
                    <th class="flat">Email</th>
                    <th class="flat">Address</th>
                    <th class="flat">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $users->id }}</td>
                    <td>{{ $users->first_name }}</td>
                    <td>{{ $users->middle_name }}</td>
                    <td>{{ $users->last_name }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{ $users->address }}</td>
                    <td>
                        <a href="{{ action('UserProfileController@show', $users->id) }}" class="btn btn-outline-primary">Show</a>
                        <a href="{{ action('UserProfileController@destroy', $users->id) }}" class="btn btn-outline-warning">Delete</a>
                    </td>
                </tr>
                </tbody>
            </table>
        @endforeach
    </div>
@endsection
