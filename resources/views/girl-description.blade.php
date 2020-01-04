@extends('layouts.app')
@section('content')
<section class="bg-yellow pt-5 pb-0 info-part d-flex align-items-end">
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
                            <h4>{{ $user->name}} {{ ($userInfo->desirable_amount) ? '|  $'.$userInfo->desirable_amount : '' }}</h4>
                            <h6>{{ @$userInfo->age }} . {{ $userInfo->country}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 text-right">   
                    @if ($errors->any())
                     @foreach ($errors->all() as $error)
                          <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{$error}}
                          </div>
                     @endforeach
                   @endif  
                   @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                   @if($bid)
                    <h5>$ {{ $bid->amount }}</h5>
                    <p>Offered By ****{{  substr($bid->bidBy->name, -1) }} </p>
                       @if($bid->bidBy->id == auth()->user()->id)
                         <p >Your bid is ${{ $bid->amount }}</p> 
                       @endif
                   @else
                        <h5>$ {{ \App\Bid::INITIAL_BID}}</h5>
                        <p>Intial Bid</p >
                   @endif 

                   @if(!$accepted)
                   <form class="form-inline float-right" method="post" id="placebid-form" style="display: none;" action="{{ route('girls.placebid',$user->id)}}">
                       @csrf
                        <div class="form-group">
                          <label for="email">$ </label>
                          <input type="text" class="form-control" name="bid" required="required">
                        </div>
                        <button type="submit" class="btn btn-custom-rounded bg-white text-uppercase">
                        Confirm
                       </button>
                        <a  href="javascript::void(0)" class="btn btn-custom-rounded bg-white text-uppercase">
                          Cancel
                        </a>
                   </form> 

                    <button id="placebid" class="btn btn-custom-rounded bg-white text-uppercase">
                        <span class="mr-2"><i class="fa fa-gavel" aria-hidden="true"></i></span>   @if($bid && $bid->bidBy->id == auth()->user()->id)
                          Raise the Bid
                        @else
                          Place a Bid
                        @endif
                    </button>

                    @else
                     <button class="btn btn-custom-rounded bg-white text-uppercase">
                        Bid Accepted
                    </button>
                         @if($bid->bidBy->id == auth()->user()->id)
                           <button class="btn btn-custom-rounded bg-white text-uppercase text-yellow" data-toggle="modal" data-target="#chatpopup">
                            <span class="mr-2"><i class="fa fa-comment" aria-hidden="true"></i></span> Send Message
                        </button> 
                        @endif
    
                    @endif
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
                        <div class="row mb-4">
                            <div class="col-sm-4 mb-3">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Personal Details</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->age }} Years</h6>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Height</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->height }}</h6>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Weight</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->weight }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Breast Size</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->breast_size }}</h6>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Eye Color</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->eye_color }}</h6>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description border-bottom">
                                    <div class="title">
                                        <p class="title-heading-grey mb-0">Natural Hair Color</p>
                                    </div>
                                    <h6 class="my-2">{{ @$userInfo->hair_color }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box bg-white rounded p-4 shadow">
                        <div class="title mb-4">
                            <h5 class="title-heading-grey">Personal Details</h5>
                        </div>
                        <p>{{ @$userInfo->about_me }}</p>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="box bg-white rounded p-4 shadow">
                        <p class="d-flex align-items-center">
                            <span class="mr-3 f-30 text-success">
                                <i class="fa fa-globe" aria-hidden="true"></i></span> 
                                {{ @$userInfo->languages ? implode(',',json_decode($userInfo->languages,true)) : '' }}
                        </p>
                        <p class="d-flex align-items-center">
                            <span class="mr-3 f-30 text-primary">
                                <i class="fa fa-briefcase" aria-hidden="true"></i></span>
                                 {{($userInfo->medical_checkup  == 1) ? 'Yes <span class="text-secondary"> (Agree to medical checkup)</span>' : 'No'}}
                                 
                        </p>
                        <p>
                            <span class="text-secondary"><b>Desirable Amount :</b></span> {{ ($userInfo->desirable_amount) ? '$'.$userInfo->desirable_amount : '' }}
                        </p>
                        <div class="title my-4">
                            <h5 class="title-heading-grey">Photos</h5>
                        </div>
                        <div class="row">
                            @foreach($gallery as $img)
                            <div class="col-sm-3 mb-4">
                                <img src="{{ $img }}" class="rounded img-fluid">
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('pagescript')

<script type="text/javascript">
    $('#placebid').click(function(){
        $(this).hide();
        $('#placebid-form').show();
    });
    $('#placebid-form a').click(function(){
        $('#placebid-form').hide();
        $('#placebid').show();
    });

</script>

@endsection