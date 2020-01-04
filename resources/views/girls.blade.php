@extends('layouts.app')
@section('content')
<section>
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="title">
                            <h5 class="title-heading">Relevance</h5>
                        </div>
                        <a href="{{ route('girls.category', 'relevance') }}" class="text-yellow">
                            See All
                        </a>
                    </div>
                    <div>
                        <!-- Swiper -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($relevanceGirls as $rg)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <a href="{{ route('girls.description', $rg->id) }}">
                                        <img class="card-img-top" src="{{ ($rg->image) ? $rg->image : asset('images/img-1.jpg') }}" alt="Card image" style="width:100%">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold">{{$rg->name}}</h6>
                                                <h6 class="m-0 font-weight-bold text-yellow">
                                                {{ is_numeric($rg->bid) ? '$'.$rg->bid : $rg->bid}}
                                                </h6>
                                            </div>
                                        </div>
                                       </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="title">
                            <h5 class="title-heading">New</h5>
                        </div>
                        <a href="{{ route('girls.category', 'new') }}" class="text-yellow">
                            See All
                        </a>
                    </div>
                    <div>
                        <!-- Swiper -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($newGirls as $ng)
                                <div class="swiper-slide">
                                    <div class="card">
                                     <a href="{{ route('girls.description', $ng->id) }}">
                                        <img class="card-img-top" src="{{ ($ng->image) ? $ng->image : asset('images/img-1.jpg') }}" alt="Card image" style="width:100%">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold">{{$ng->name}}</h6>
                                                <h6 class="m-0 font-weight-bold text-yellow">
                                                {{ is_numeric($ng->bid) ? '$'.$ng->bid : $ng->bid}}
                                                </h6>
                                            </div>
                                        </div>
                                     </a>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="title">
                            <h5 class="title-heading">From My Country</h5>
                        </div>
                        <a href="{{ route('girls.category', 'country') }}" class="text-yellow">
                            See All
                        </a>
                    </div>
                    <div>
                        <!-- Swiper -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($countryGirls as $cg)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <a href="{{ route('girls.description', $cg->id) }}">
                                        <img class="card-img-top" src="{{ ($cg->image) ? $cg->image : asset('images/img-1.jpg') }}" alt="Card image" style="width:100%">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold">{{$cg->name}}</h6>
                                                <h6 class="m-0 font-weight-bold text-yellow">
                                                {{ is_numeric($ng->bid) ? '$'.$cg->bid : $cg->bid}}
                                                </h6>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="title">
                            <h5 class="title-heading">By Bids</h5>
                        </div>
                        <a href="{{ route('girls.category', 'bids') }}" class="text-yellow">
                            See All
                        </a>
                    </div>
                    <div>
                        <!-- Swiper -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($bidGirls as $bg)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <a href="{{ route('girls.description', $bg->id) }}">
                                        <img class="card-img-top" src="{{ ($bg->image) ? $bg->image : asset('images/img-1.jpg') }}" alt="Card image" style="width:100%">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold">{{$bg->name}}</h6>
                                                <h6 class="m-0 font-weight-bold text-yellow">
                                                {{ is_numeric($ng->bid) ? '$'.$bg->bid : $bg->bid}}
                                                </h6>
                                            </div>
                                        </div>
                                     </a>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
</section>
@endsection
