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
                    <input id="inputEmail" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" autofocus>

                    @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="sr-only" for="inputPassword">Пароль</label>
                    <input id="inputPassword" type="password" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="password" placeholder="Пароль" value="{{ old('password') }}">

                    @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="form-group clearfix">
                    <div class="custom-control custom-checkbox checkbox-primary float-left">
                        <input type="checkbox" id="rememberMe" class="custom-control-input"
                               name="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                        <label for="rememberMe" class="custom-control-label">Запомнить меня</label>
                    </div>

                    <small class="float-right"><a href="{{ route('password.request') }} ">Забыли пароль?</a></small>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Войти</button>
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
