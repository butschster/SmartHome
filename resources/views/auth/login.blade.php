@extends('layouts.app')

@section('content')
<div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
        <div class="page-brand-info">

        </div>

        <div class="page-login-main">

            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="sr-only" for="inputEmail">Email</label>
                    <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="sr-only" for="inputPassword">Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="password" placeholder="Password" value="{{ old('password') }}" required>

                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                        <input type="checkbox" id="rememberMe" class="form-check-input"
                               name="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                        <label for="rememberMe">Remember me</label>
                    </div>
                    <a class="float-right" href="{{ route('password.request') }} ">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script>
        $('body').addClass('page-login-v2 layout-full page-dark');
    </script>
@endsection
