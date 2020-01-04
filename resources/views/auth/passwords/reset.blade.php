@extends('auth.app')
@section('content')
<div class="box-inner-wrapper p-5 col-sm-12">
    <div class="box-inner-wrapper-head mb-5">
        <h2 class="text-yellow font-weight-bold">{{ __('Reset Password') }}</h2>
        <!-- <p class="text-low-alpha">Instruction will be sent to your email address</p> -->
    </div>
    <div class="box-inner-wrapper-content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

         <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="form-group mb-4">
                <label class="text-low-alpha">Email</label>
                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label class="text-low-alpha">Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="form-group mb-4">
                <label class="text-low-alpha">Confirm Password</label>
                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit" class="btn btn-block btn-site mb-4">Reset Password</button>
        </form>
    </div>
</div>
@endsection
