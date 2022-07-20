@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">@lang('translation.Modification') @lang('translation.Image')</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">

<div class="col" style="margin-left: 25px">
  <a href="{{route('profil_manager')}}"> <button class="btn btn_precedent my-2 edit_pdp_cfp" ><i class="bx bxs-chevron-left me-1"></i> Retour</button></a>
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
   {{-- si l'utiliisateur a  choisir un fichier > 60Ko--}}
   @if (\Session::has('error_logo'))
   <div class="alert alert-danger col-md-4">
       <ul>
           <li>{!! \Session::get('error_logo') !!}</li>
       </ul>
   </div>
   @endif
<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">@lang('translation.ImageDeProfil')
            <strong>@lang('translation.TailleDuFichier') : (1.7 MB @lang('translation.max'))</strong>
        </p>
        <form   class="btn-submit" action="{{route('update_photos_resp')}}" method="post" enctype="multipart/form-data">
            @csrf

                    <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                            <center>

                                <div class="image-upload">
                                  <label for="file-input">
                                    <div class="upload-icon">
                                      @if($chef->photos==null)
                                      <span>
                                          <div style="display: grid; place-content: center">
                                              <div class='randomColor photo_users' style="color:white; font-size:20px; border: none; border-radius: 100%; height:70px; width:70px ; display: grid; place-content: center"  >
                                                  <img src="" alt="" id = "photo_stg" class="image-ronde" style="display: none">
                                              </div>
                                          </div>
                                      </span>
                                  @else
                                      <img src="{{asset('images/employes/'.$chef->photos)}}" id = "photo_stg"  class="image-ronde">
                                  @endif

                              </div>
                                  </label>
                                  </div>
                            </center>
                        </div>
                    </div>


<input id="file-input" type="file" name="image" value="{{$chef->photos}}"/><br>

<button  class="btn_enregistrer  mt-1 btn modification "><I class="bx bx-check me-1"></I>@lang('translation.Enregistrer')</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>
<style>

.image-ronde{
    width : 120px; height : 120px;
    border: none;
    -moz-border-radius : 75px;
    -webkit-border-radius : 75px;
    border-radius : 75px;
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
                        $('#photo_stg').css('display','block');
                        $('#photo_stg').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


        </script>
@endsection









































