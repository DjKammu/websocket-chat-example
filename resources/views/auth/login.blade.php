@extends('auth.app')

@section('content')

 <div class="box-inner-wrapper p-5 col-sm-12">
<div class="box-inner-wrapper-head mb-5">
    <h2 class="text-yellow font-weight-bold">Welcome Back!</h2>
    <p class="text-low-alpha">Please login to enter the club.</p>
</div>
<div class="box-inner-wrapper-content">
   <form method="POST" action="{{ route('login') }}">
         @csrf
        <div class="form-group mb-4">
            <label class="text-low-alpha">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label class="text-low-alpha">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                     {{ old('remember') ? 'checked' : '' }}>

                    <label class="text-low-alpha" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
             <p class="text-right text-white mb-4">
             @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </p>
        </div>
       
        <button type="submit" class="btn btn-block btn-site mb-4">
            {{ __('Enter the club') }}
        </button>
         @if (Route::has('register'))
            <p class="text-center text-white">New User? <a href="{{ route('register') }}" class="text-yellow font-weight-bold">{{ __('Register') }}</a> </p>
        @endif
        
    </form>
</div>
</div>
@endsection
