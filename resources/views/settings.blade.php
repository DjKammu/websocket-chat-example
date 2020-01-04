@extends('auth.app')
@section('content')
    <div class="box-inner-wrapper p-5 col-sm-12">
        @if ($errors->any())
             @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{$error}}
                  </div>
             @endforeach
         @endif
        <div class="box-inner-wrapper-head mb-5">
            <h2 class="text-yellow font-weight-bold">Account Settings</h2>
            <p class="text-low-alpha">Add more information about yourself</p>
        </div>
        <div class="box-inner-wrapper-content">
           <form action="{{ route('settings.update')}}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="avatar-upload mb-5">
                    <div class="avatar-edit">
                        <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload">Change Pic</label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview">
                            <img src="{{ ($image) ? $image : asset('images/user-placeholder.png') }}" 
                            class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-low-alpha">Country</label>
                    <select class="form-control" name="country">
                       @foreach($countries as $country)
                        @php 
                        $selected = ($country->code == @$userInfo->country) ? 'selected="selected"' : ''; 
                        @endphp
                        <option value="{{ $country->code}}" {{$selected}}>{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label class="text-low-alpha">Phone</label>
                    <input type="text" name="number" value="{{ @$userInfo->number }}" class="form-control">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label class="text-low-alpha">Date of Birth</label>
                    </div>
                    @php 
                    $dob = @$userInfo->dob;
                    $sDay = ($dob) ? date('d',strtotime($dob)) : '';  
                    $sMonth =  ($dob) ? date('m',strtotime($dob)) : '';  
                    $sYear =  ($dob) ? date('Y',strtotime($dob)) : '';  
                    $sLanguages = @json_decode($userInfo->languages,true) ?? [];
                    @endphp
                 
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-control" name="day">
                                @foreach( range(1,31) as $day)
                                @php 
                                 $day = sprintf("%02d", $day);
                                 $selected = ($day == $sDay) ? 'selected="selected"' : ''; 
                                @endphp
                                <option value="{{ $day }}" {{$selected}}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-control" name="month">
                                @for($i=1; $i<=12; ++$i)
                                 @php 
                                 $month = sprintf("%02d", $i);
                                 $selected = ($sMonth == $month) ? 'selected="selected"' : ''; 
                                 @endphp
                                  <option value="{{$month}}" {{$selected}}>{{$month}}</option>
                                @endfor
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-control" name="year">
                                @foreach($years as $year)
                                   @php
                                   $selected = ($sYear == $year) ? 'selected="selected"' : ''; 
                                   @endphp
                                   <option value='{{$year}}' {{$selected}}>{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                @if($user->role == App\User::ROLE_GIRL)

                <div class="form-group">
                    <label class="text-low-alpha">Height</label>
                    <select class="form-control" name="height">
                        <option> Not selected</option>
                        <option value="< 150cm"> < 150 cm</option>
                         @for($i=150; $i<=180; ++$i)
                         @php 
                         $month = sprintf("%02d", $i);
                         $selected = ($sMonth == $month) ? 'selected="selected"' : ''; 
                         @endphp
                          <option value="{{$i}} cm" {{$selected}}>{{$i}} cm</option>
                        @endfor
                        <option value="> 180 cm"> > 180 cm</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="text-low-alpha">Weight</label>
                    <select class="form-control" name="weight">
                        <option> Not selected</option>
                        <option value="< 40 kg"> < 40 kg</option>
                         @for($i=40; $i<=80; ++$i)
                         @php 
                         $month = sprintf("%02d", $i);
                         $selected = ($sMonth == $month) ? 'selected="selected"' : ''; 
                         @endphp
                          <option value="{{$i}} kg" {{$selected}}>{{$i}} kg</option>
                        @endfor
                        <option value="> 80 kg"> > 80 kg</option>
                    </select>
                </div> 

                <div class="form-group">
                    <label class="text-low-alpha">Breast size</label>
                    <select class="form-control" name="breast_size">
                        <option> Not selected</option>
                        @foreach($breastSize as $key => $breast)
                            @php
                             $selected = (in_array($key, $sLanguages)) ? 'selected="selected"' : ''; 
                            @endphp
                           <option value="{{$key}}" {{$selected}}>{{$breast}}</option>
                        @endforeach
                    </select>
                </div> 

                <div class="form-group">
                    <label class="text-low-alpha">Eye Color</label>
                    <select class="form-control" name="eye_color">
                        <option> Not selected</option>
                        @foreach($eyeColor as $key => $eye)
                            @php
                             $selected = (in_array($key, $sLanguages)) ? 'selected="selected"' : ''; 
                            @endphp
                           <option value="{{$key}}" {{$selected}}>{{$eye}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="text-low-alpha">Natural hair color</label>
                    <select class="form-control" name="hair_color">
                        <option> Not selected</option>
                        @foreach($hairColor as $key => $hair)
                            @php
                             $selected = (in_array($key, $sLanguages)) ? 'selected="selected"' : ''; 
                            @endphp
                           <option value="{{$key}}" {{$selected}}>{{$hair}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label class="text-low-alpha">Desirable amount</label>
                    <input type="text" name="desirable_amount" value="{{ @$userInfo->number }}" class="form-control">
                </div>
                
                 <div class="form-group mb-4">
                    <label class="text-low-alpha">About me</label>
                    <textarea class="form-control" name="about_me"> </textarea>
                </div>

                 @endif

                
               
                <div class="form-group">
                    <label class="text-low-alpha">Languages</label>
                    <select class="form-control" name="languages[]" multiple>
                        @foreach($languages as $key => $language)
                            @php
                             $selected = (in_array($key, $sLanguages)) ? 'selected="selected"' : ''; 
                            @endphp
                           <option value="{{$key}}" {{$selected}}>{{$language}}</option>
                        @endforeach
                    </select>
                    <!-- <ul class="list-inline mt-3">
                        <li class="list-inline-item">
                            <div class="chips">
                                <span>English</span>
                                <span><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="chips">
                                <span>English</span>
                                <span><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="chips">
                                <span>English</span>
                                <span><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                        </li>
                    </ul> -->
                </div>
                
                @if($user->role == App\User::ROLE_GIRL)
                 <div class="form-group mb-4">
                    <label class="text-low-alpha">I agree to medical checkup:</label>
                    <input type="checkbox" name="medical_checkup" value="" >
                </div>
               
                <div class="form-group mb-4">
                    <label class="text-low-alpha">Certificate from the doctor</label>
                    <input type="file" name="certificate" value="" >
                </div>
                @endif

                @if($user->role == App\User::ROLE_BUYER)
                <div class="form-group">
                    <label class="text-low-alpha">Preferred Currency</label>
                    <select class="form-control" name="currency">
                        @foreach($currencies as $key => $currency)
                        @php
                        $selected = (@$userInfo->currency == $currency) ? 'selected="selected"' : ''; 
                        @endphp
                           <option value="{{$key}}" {{$selected}}>{{$currency}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <button type="submit" class="btn btn-block btn-site mb-4">Save</button>
            </form>
        </div>
    </div>
@endsection
