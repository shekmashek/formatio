@extends('./layouts/admin')
@section('content')

<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_du_responsable')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
</div>
<center>
 {{-- si l'utiliisateur a cliqué sur enregistrer sans choisir un fichier--}}
 @if (\Session::has('error'))
 <div class="alert alert-danger col-md-4">
     <ul>
         <li>{!! \Session::get('error') !!}</li>
     </ul>
 </div>
@endif
{{-- si l'utiliisateur a choisi un fichier > 60Ko--}}
@if (\Session::has('error_logo'))
<div class="alert alert-danger col-md-4">
    <ul>
        <li>{!! \Session::get('error_logo') !!}</li>
    </ul>
</div>
@endif
{{-- si l'utiliisateur a choisi un format incompatible --}}
@if (\Session::has('error_format'))
<div class="alert alert-danger col-md-4">
    <ul>
        <li>{!! \Session::get('error_format') !!}</li>
    </ul>
</div>
@endif
    <div class="col-lg-4">
        <div class="p-3 form-control">
            <p style="text-align: left">Modifier la photo de profil <strong>(60Ko max)</strong></p><br>
            <form   class="btn-submit" action="{{route('enregistrer_modification_photo',$responsable->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="   {{ $responsable->nom_resp_cfp }}" class="form-control test input"  name="nom">
                <input type="hidden" class="form-control test input" value="   {{ $responsable->prenom_resp_cfp }}"  name="prenom">

                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <center>
                        <div class="image-upload">
                          <label for="file-input">
                            <div class="upload-icon">
                                @if($responsable->photos_resp_cfp==null)
                                    <span>
                                        <div style="display: grid; place-content: center">
                                            <div class='randomColor photo_users' style="color:white; font-size:30px; border: none; border-radius: 100%; height:80px; width:80px ; display: grid; place-content: center"  >
                                                <img src="" alt="" id = "photo_stg" class="image-ronde" style="display: none">
                                            </div>
                                        </div>
                                    </span>
                                @else
                                    <img src="{{asset('images/responsables/'.$responsable->photos_resp_cfp)}}" id = "photo_stg"  class="image-ronde">
                                @endif
                              {{-- <input type="text" id = 'vartemp'> --}}
                            </div>
                        </div>
                        </label>
                            <input id="file-input" type="file" name="image" value="{{$responsable->photos_resp_cfp}}"/>
                            <button class="btn_enregistrer  mt-1 btn modification "> Enregister</button>
                        </div>
                    </center>

                </div>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
        </div>
    </div>




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
                $('#photo_stg').css('display','block');
                $('#photo_stg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


</script>
@endsection