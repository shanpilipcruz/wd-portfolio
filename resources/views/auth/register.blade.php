@extends('layouts.base')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header bg-dark flat" style="color: white;">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                    <label for="first_name" class="form-control-placeholder-floating flat">{{ __('First Name') }}</label>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input id="middle_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name">
                                    <label for="middle_name" class="form-control-placeholder-floating flat">{{ __('Middle Name') }}</label>
                                    @if ($errors->has('middle_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-12 mb-3">
                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                                    <label for="last_name" class="form-control-placeholder-floating flat">{{ __('Last Name') }}</label>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-12 mb-3">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <label for="email" class="form-control-placeholder-floating flat">{{ __('E-Mail Address') }}</label>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-12 mb-3">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">
                                    <label for="password" class="form-control-placeholder-floating text-md-right flat">{{ __('Password') }}</label>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-12 mb-3">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label for="password-confirm" class="form-control-placeholder-floating text-md-right flat">{{ __('Confirm Password') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-secondary fa-pull-right">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
