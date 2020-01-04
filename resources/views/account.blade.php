@extends('layouts.app')
@section('content')
   <section class="bg-yellow pt-5 pb-0 info-part d-flex align-items-end section p-0">
        <div class="container">
            <div class="row pb-3">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <figure class="m-0">
                                <img src="{{ ($image) ? url($image) : asset('images/user-placeholder.png') }}" height="150" width="150" class="rounded-circle">
                            </figure>
                        </div>
                        <div class="col-sm-8">
                            <h4>{{ $user->name}} {{ ($userInfo->desirable_amount) ? '| '.$userInfo->desirable_amount : '' }}</h4>
                            <h6>{{ @$userInfo->age }} . {{ $userInfo->country}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <div class="container">
            <div class="row my-5">
                <div class="col-sm-7">
                    <div class="box bg-white rounded p-4 shadow mb-4">
                        <div class="title mb-4">
                            <h5 class="title-heading-grey">About Me</h5>
                        </div>
                        <div class="row mb-6">
                            <div class="col-sm-6 mb-3">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Country</p>
                                    </div>
                                    <h6 class="my-2">{{ $userInfo->country}}</h6>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Age</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->age }} Years</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Languages</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->languages ? implode(',',json_decode($userInfo->languages,true)) : '' }}</h6>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-6">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Preferred currency:</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->currency}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection
