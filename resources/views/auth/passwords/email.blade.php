@extends('auth.app')

@section('content')
<div class="box-inner-wrapper p-5 col-sm-12">
    <div class="box-inner-wrapper-head mb-5">
        <h2 class="text-yellow font-weight-bold">Password Recovery!</h2>
        <p class="text-low-alpha">Instruction will be sent to your email address</p>
    </div>
    <div class="box-inner-wrapper-content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
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

            <button class="btn btn-block btn-site mb-4">Send Password Reset Link</button>
            <p class="text-center text-white">Already User? <a href="{{ route('login')}}" class="text-yellow font-weight-bold">Login</a> </p>
        </form>
    </div>
</div>
@endsection
