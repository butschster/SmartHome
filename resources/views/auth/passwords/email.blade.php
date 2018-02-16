@extends('layouts.app')

@section('content')
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
            <h2>Forgot Your Password ?</h2>
            <p>Input your registered email to reset your password</p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form role="form" method="POST" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" placeholder="E-Mail Address">

                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Reset Your Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        $('body').addClass('page-forgot-password layout-full');
    </script>
@endsection

