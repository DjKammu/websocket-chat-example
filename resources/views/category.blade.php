@extends('layouts.app')
@section('content')
  <section class="bg-yellow py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="font-weight-bold">{{ $title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb d-flex justify-content-center bg-transparent m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/')}} ">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
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
                    <div class="title">
                        <h5 class="title-heading">{{ $title }}</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($girls as $g)
                <div class="col-sm-3 mb-3">
                    <div class="card">
                      <a href="{{ route('girls.description', $g->id) }}">
                        <img class="card-img-top" src="{{ ($g->image) ? $g->image : asset('images/img-1.jpg') }}" alt="Card image" style="width:100%">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold">{{$g->name}}</h6>
                                <h6 class="m-0 font-weight-bold text-yellow"> 
                                {{ is_numeric($g->bid) ? '$'.$g->bid : $g->bid}}</h6>
                            </div>
                        </div>
                      </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{ ($girls) ? $girls->links() : '' }}
        </div>
    </section>
@endsection
