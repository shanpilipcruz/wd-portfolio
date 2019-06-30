@extends('index')
@section('main')
    <br>
    <br>
<div class="container box">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="text-align: center; font-weight: 300;" class="modal-title">Contact Me</h3><br />
                    </div>
                    <div class="modal-body">
                        <form method="post" id="sendEmailForm" action="{{url('sendemail/send')}}">
                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </span>
                                <input type="text" name="name" class="form-control" value="" data-toggle="tooltip" title="Your Name" data-placement="right" required/>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </span>
                                <input type="email" name="email" class="form-control" value="" data-toggle="tooltip" title="Your Email" data-placement="right" required/>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-inbox"></i>
                                    </span>
                                </span>
                                <textarea name="message" class="form-control" data-toggle="tooltip" title="Enter your Message" data-placement="right" required></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <input type="submit" name="send" class="btn btn-outline-secondary" value="Send" />
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
</div>
@endsection
