@extends('auth.app')
@section('content')
<div class="box-inner-wrapper p-5 col-sm-12">
        <div class="box-inner-wrapper-head mb-5">
            <h2 class="text-yellow font-weight-bold">Welcome Back!</h2>
            <p class="text-low-alpha">Just create an account to join the club.</p>
        </div>
        <div class="d-flex justify-content-center">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#buyer">Buyer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#girl">Girl</a>
                </li>
            </ul>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="buyer" class="container tab-pane active"><br>
                <div class="box-inner-wrapper-content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="buyer">
                        <div class="form-group mb-4">
                            <label class="text-low-alpha">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="text-low-alpha">Email</label>
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" class="custom-control-input" id="accept-terms" name="example1">
                            <label class="custom-control-label text-white" for="accept-terms">I accept the Terms and agree with the rules of data processing</label>
                        </div>
                        <button type="submit" class="btn btn-block btn-site mb-4">Register</button>
                        <p class="text-center text-white">Already User? <a href="{{ route('login') }}" class="text-yellow font-weight-bold">Login</a> </p>
                    </form>
                </div>
            </div>
            <div id="girl" class="container tab-pane fade"><br>
                <div class="box-inner-wrapper-content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="girl">
                        <div class="form-group mb-4">
                            <label class="text-low-alpha">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="text-low-alpha">Email</label>
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" class="custom-control-input" id="accept-terms-2" name="example1">
                            <label class="custom-control-label text-white" for="accept-terms-2">I accept the Terms and agree with the rules of data processing</label>
                        </div>
                        <button type="submit" class="btn btn-block btn-site mb-4">Register</button>
                        <p class="text-center text-white">Already User? <a href="{{ route('login') }}" class="text-yellow font-weight-bold">Login</a> </p>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
