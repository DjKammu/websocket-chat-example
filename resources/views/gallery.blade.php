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
        <h2 class="text-yellow font-weight-bold">Upload Gallery</h2>
        <p class="text-low-alpha">Add more images of you.</p>
    </div>
    <div class="box-inner-wrapper-content gallery">
       <form action="{{ route('gallery.update')}}"  method="post" enctype="multipart/form-data">
         @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="images">
                        <div class="pic">
                            @if(isset($gallery[0]))
                                <img src="{{ $gallery[0] }}" class="img-fluid">
                            @else
                               <input type="file" name="gallery[]" accept="image/*" />
                            @endif
                            <!-- add image -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="images">
                        <div class="pic">
                           @if(isset($gallery[1]))
                                <img src="{{ $gallery[1] }}" class="img-fluid">
                            @else
                               <input type="file" name="gallery[]" accept="image/*" />
                            @endif
                            <!-- add image -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="images">
                        <div class="pic">
                            @if(isset($gallery[2]))
                                <img src="{{ $gallery[2] }}" class="img-fluid">
                            @else
                               <input type="file" name="gallery[]" accept="image/*" />
                            @endif
                            <!-- add image -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="images">
                        <div class="pic">
                            @if(isset($gallery[3]))
                                <img src="{{ $gallery[3] }}" class="img-fluid">
                            @else
                               <input type="file" name="gallery[]" accept="image/*" />
                            @endif
                            <!-- add image -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="images">
                        <div class="pic">
                           @if(isset($gallery[4]))
                                <img src="{{ $gallery[4] }}" class="img-fluid">
                            @else
                               <input type="file" name="gallery[]" accept="image/*" />
                            @endif
                            <!-- add image -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="images">
                        <div class="pic">
                            @if(isset($gallery[5]))
                                <img src="{{ $gallery[5] }}" class="img-fluid">
                            @else
                               <input type="file" name="gallery[]" accept="image/*" />
                            @endif
                            <!-- add image -->
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-site mb-4">Next</button>
        </form>
    </div>
</div>


@endsection
