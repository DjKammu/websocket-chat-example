@extends('layouts.app')

@section('content')

 <section class="bg-yellow py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="font-weight-bold">Administrator</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb d-flex justify-content-center bg-transparent m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Administrator</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <div class="title text-center px-5">
                        <h2 class="font-weight-bold">Contact The Administration</h2>
                        <div class="underline-design">
                            <img src="images/line-design.svg">
                        </div>
                        <p class="text-secondary px-5 mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-6 custom-form">
                    <div class="form-group"><input type="text" class="form-control text-center" placeholder="Your Name"></div>
                    <div class="form-group"><input type="email" class="form-control text-center" placeholder="Your Email"></div>
                    <div class="form-group"><textarea class="form-control text-center" placeholder="Text of the Letter"></textarea></div>
                    <button class="btn btn-block btn-site mt-5">Send</button>
                </div>
            </div>
        </div>
    </section>
@endsection
