@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">

<div class="col" style="margin-left: 25px">
  <a href="{{route('affProfilChefDepartement')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
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
        <p style="text-align: left">Photo de profil <strong>(60Ko max)</strong></p>
        <form   class="btn-submit" action="{{route('update_photos_chef')}}" method="post" enctype="multipart/form-data">
            @csrf

                    <input type="hidden" value="   {{ $chef->nom_chef }}" class="form-control test input"  name="nom">
                    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}


                        <input type="hidden" class="form-control test input" value="   {{ $chef->prenom_chef }}"  name="prenom">
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
                                      <img src="{{asset('images/chefDepartement/'.$chef->photos)}}" id = "photo_stg"  class="image-ronde">
                                  @endif
                                      {{-- @if($chef->photos==null)
                                      <span>
                                          <div style="display: grid; place-content: center">
                                              <div class='randomColor photo_users' style="color:white; font-size: 50px; border: none; border-radius: 100%; height:150px; width:150px ; display: grid; place-content: center">
                                                <img src="" alt="" id = "photo_stg" class="image-ronde" style="display: none">
                                              </div>
                                          </div>
                                      </span>
                                  @else
                                  <img src="{{asset('images/chefDepartement/'.$chef->photos)}}" id = "photo_stg"  class="image-ronde">


                                  @endif --}}
                                      {{-- <input type="text" id = 'vartemp'> --}}
                              </div>
                                  </label>
                                     <input id="file-input" type="file" name="image" value="{{$chef->photos}}"/>
                                  </div>
                            </center>
                        </div>
                    </div>


                        {{-- <select hidden  value="{{$chef->sexe_resp}}" name="genre" class="form-select test input" id="genre"  >
                          <option value="{{$chef->sexe_resp}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select> --}}


                        <input type="hidden" class="form-control test" name="genre" value="{{ $genre}}">

                          <input type="hidden" value="{{ $chef->cin_chef}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="{{ $chef->mail_chef}}" >

                        <input type="hidden" class="form-control test"  name="phone" value="{{ $chef->telephone_chef }}">
                        <input type="hidden" value="{{ $chef->fonction_chef}}" class="form-control test"  name="fonction" >

                        <input type="hidden" class="form-control test"  name="matricule" value="{{ $chef->matricule}}" >
                        <input type="hidden" class="form-control test"  name="etp" value="{{ optional(optional($chef)->entreprise)->nom_etp}}" >





<button  class="btn_enregistrer  mt-1 btn modification "> Enregister</button>
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









































