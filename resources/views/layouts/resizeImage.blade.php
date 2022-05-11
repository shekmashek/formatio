@extends('./layouts/admin')

   

@section('content')
<form method="post" action="{{ route('resizeImagePost') }}"  enctype="multipart/form-data">
    @CSRF
    <div class="row">
           <div class="col-md-4" align="right">
            <h3>Choisir la photos</h3>
           </div>
           <div class="col-md-4">
            <br />
               <input type="file" name="image" class="image" />
           </div>
           <div class="col-md-2">
            <br />
               <button type="submit" class="btn btn-primary">Enregistrer image</button>
           </div>
       </div>
   </form>
   <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
           <ul>
           @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
           @endforeach
           </ul>
       </div>
   @endif

   @if($message = Session::get('success'))
   {{-- <div class="alert alert-success alert-block">
       <button type="button" class="close" data-dismiss="alert">×</button>    
       <strong>{{ $message }}</strong>
   </div> --}}
   <div class="row">
       <div class="col-md-6">
           <strong>Original Image:</strong>
           <br/>
           <img src="/images/{{ Session::get('imageName') }}" class="img-responsive img-thumbnail">
       </div>
       <div class="col-md-4">
           <strong>ResizeImage Image:</strong>
           <br/>
           <img src="/image_resize/{{ Session::get('imageName') }}" class="img-thumbnail" />
       </div>
   </div>
   @endif
  </div>
</div>
@endsection