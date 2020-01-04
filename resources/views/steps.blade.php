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
            <h2 class="text-yellow font-weight-bold">Upload Profile Pic!</h2>
            <p class="text-low-alpha">Buyers with Photo get more confidence from girls.</p>
        </div>
        <div class="box-inner-wrapper-content">
            <form action="{{ route('steps.update')}}"  method="post" enctype="multipart/form-data">
                 @csrf
                <div class="avatar-upload mb-5">
                    <div class="avatar-edit">
                        <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload">Upload Pic</label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview">
                            <img src="{{ ($image) ? $image : asset('images/user-placeholder.png') }}" class="img-fluid">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-site mb-4">Continue</button>

                @if($role == App\User::ROLE_BUYER)
                <p class="text-center"><a href="{{ route('settings') }}" class="text-yellow">Skip</a> </p>
                @endif
            </form>
        </div>
    </div>
    
@endsection
