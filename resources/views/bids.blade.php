@extends('layouts.app')
@section('content')
 <section>
        <div class="container">
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

            <div class="row mb-5">
                <div class="col-sm-12">
                    <ul class="center-tab">
                        <li><a href="{{ route('bids',['s' => 'pending'])}}" 
                            class="{{@$status == 'pending' ? 'active' : '' }}">Recent</a></li>
                        <li><a href="{{ route('bids',['s' => 'accepted'])}}"
                            class="{{@$status == 'accepted' ? 'active' : '' }}">Accepted</a></li>
                        <li><a href="{{ route('bids',['s' => 'finished'])}}" 
                            class="{{@$status == 'finished' ? 'active' : '' }}">Finished</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <table class="table table-borderless">
                            @foreach($bids as $bid)
                                    <tr>
                                     <td>
                                        <div class="d-flex align-items-center">
                                            <figure class="m-0 p-0">
                                                <img src="{{ ($bid->image) ? url($bid->image) : asset('images/user-placeholder.png') }}" height="60px" width="60px" class="rounded-circle">
                                            </figure>
                                            <span>
                                                <p class="m-0"><a href="#" class="text-yellow font-weight-bold">{{ @$bid->name }}</a></p>
                                                <p class="m-0">
                                                    {{ @$bid->country }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <span>
                                            <p class="m-0 font-weight-bold">My Bid</p>
                                            <p class="m-0">${{$bid->amount}}</p>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <p class="m-0 font-weight-bold">Current Bid</p>
                                            <p class="m-0">${{ $bid->current}}</p>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">Auction {{ @$status }}</span>
                                    </td>
                                    @if($user->role == App\User::ROLE_GIRL)
                                     <td>
                                         @if($acceptedBid)
                                             @if($acceptedBid->id == $bid->id)
                                               {{ ucFirst(App\Bid::ACCEPTED)}} {{ ($bid->payment) ? '/ '.App\Payment::PAID : '' }} 
                                             @else
                                                {{ ucfirst(App\Bid::PENDING)}}
                                             @endif
                                         @else
                                           <a href="{{ route('bids.accept',$bid->id) }}" class="btn btn-light">Accept</a>
                                         @endif
                                     </td>
                                    @elseif($user->role == App\User::ROLE_BUYER)
                                     <td>
                                        @if($bid->acceptedBid)
                                             @if($bid->acceptedBid->id == $bid->id)
                                                {!! ($bid->payment) ? App\Payment::PAID : '<a href="'.route('bids.pay',$bid->id).'" class="btn btn-light"> Pay Now </a>' !!}  
                                             @else
                                                {{ ucfirst(App\Bid::PENDING)}}
                                             @endif
                                         @else
                                            {{ ucfirst(App\Bid::PENDING)}}
                                         @endif
                                        
                                     </td>

                                    @endif
                                </tr>
                            @endforeach

                            @if(count($bids) == 0)
                                <tr>
                                     <td colspan="8" class="text-center">
                                          No Bids Available
                                    </td>
                                </tr>
                            @endif
                       
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
