@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification logo</h3>
@endsection
@section('content')

<div class="col" style="margin-left: 25px">
    <a href="{{route('aff_parametre_referent')}}"> <button class="btn btn_precedent"><i class='bx bxs-chevron-left me-1'></i>Retour</button></a>
</div>
<center>
        @if (\Session::has('error_logo'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('error_logo') !!}</li>
            </ul>
        </div>
        @endif
        {{-- si l'utiliisateur a  choisir un fichier > 60Ko--}}
        @if (\Session::has('error_format'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('error_format') !!}</li>
            </ul>
        </div>
        @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">
            <p class="text-center">Photo de profil
                <strong>Taille du fichier: (1.7 MB max)</strong>
            </p>
        <form   class="btn-submit" action="{{route('enregistrer_logo',$etp->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row px-3 ">
                <div class="form-group mt-1 mb-1">
                <center>
                    <div class="image-upload">
                      <label for="file-input">
                        <div class="upload-icon">
                            <img src="{{asset('images/entreprises/'.$etp->logo)}}" id = "photo_stg"  class="image-ronde">
                          {{-- <input type="text" id = 'vartemp'> --}}
                  </div>
                      </label>
                         <input id="file-input" type="file" name="image" value="{{$etp->logo}}"/>
                      </div>
                </center>
            </div>
        </div>

        <button type="submit" class="btn btn_enregistrer"><i class='bx bx-check me-1'></i>Enregistrer</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>
<style>
.image-ronde{
    width : 150px; height : 150px;
    border: none;

    cursor: pointer;
  }
      .image-upload > input
      {
          display: none;
      }
    </style>
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script>

        // $(document).ready(function(){
        //   alert("Bien venu");
        // });
        $('#file-input').change( function(event) {
          $("img.icon").attr('src',URL.createObjectURL(event.target.files[0]));
          $("img.icon").parents('.upload-icon').addClass('has-img');
          readURL(this);
        });
        //fonction qui change la photo de profil du stagiaire
        function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function (e) {
                      //alert(e.target.result);
                      $('#photo_stg').attr('src', e.target.result);
                  }

                  reader.readAsDataURL(input.files[0]);
              }
          }


      </script>
@endsection