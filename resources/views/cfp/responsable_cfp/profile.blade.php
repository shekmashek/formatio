@extends('./layouts/admin')
@section('title')
    <h5 class="text_header m-0 mt-1"> </h5>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    .image-ronde {
        width: 30px;
        height: 30px;
        border: none;
        -moz-border-radius: 75px;
        -webkit-border-radius: 75px;
        border-radius: 75px;
    }

    .none:hover{
        cursor:default;
    }
    .nav-link{
        background-color: #6610f2;
    }
    .nav-link:hover{
        background-color: #6610f2;
        color: white;
        box-shadow: 0 4px 18px -4px rgba(115,103,240,.65)
    }
    #photo{
        width: 100px;
        height: 90px;
        background: rgb(240, 237, 237);
        border-radius: 10px;
    }
    button:active{
        background-color: #7367f0;
    }
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #6610f2;
        
    }
    .form-control {
        transition: all .1s linear;
        border: gray 1px solid;
        font-size: 12px;
    }
    .form-control:focus{
        border: #6610f2 1px solid;
        outline: #6610f2;
    }
    .file-input-wrapper {
        height: 30px;
        margin: 2px;
        overflow: hidden;
        position: relative;
        width: 118px;
        background-color: #fff;
        cursor: pointer;
    }

    .file-input-wrapper>input[type="file"] {
        font-size: 40px;
        position: absolute;
        top: 0;
        right: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-input-wrapper>.btn-file-input {
        background-color: #494949;
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        height: 34px;
        margin: 0 0 0 -1px;
        padding-left: 0;
        width: 121px;
        cursor: pointer;
    }

    .file-input-wrapper:hover>.btn-file-input {
        //background-color: #494949;
    }

    #img_text {
        float: right;
        margin-right: -80px;
        margin-top: -14px;
    }
        
    
</style>

<div class="container shadow-sm mt-4" >
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><span class="iconify" data-icon="ep:setting"></span> &nbsp; Parametre du compte</a></li>
              <li class="breadcrumb-item active" id="test" aria-current="page">General</li>
            </ol>
          </nav>
        <div class="col-md-12" >
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button onclick="mandeG()" style="width: 250px;" class="nav-link active test"  id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><span class="iconify" style="font-size: 22px" data-icon="el:address-book-alt"></span>&nbsp; General</button>
                  <button onclick="mandeA();"  class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><span class="iconify" style="font-size: 22px" data-icon="carbon:group-security"></span>&nbsp;Sécurité</button>
                  <button onclick="mandeB();" class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><span class="iconify" style="font-size: 22px" data-icon="bx:map"></span>&nbsp Coordoneés</button>
                  <button onclick="mandeC();" class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><span class="iconify" style="font-size: 22px"  data-icon="gg:organisation"></span> &nbsp; Organisme de Formation</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-2" >
                                    <div id="photo">
                                        <a href="{{route('modification_photo',$refs->id)}}">
    
                                            @if($refs->photos_resp_cfp==null)
                                                <span>
                                                    <div style="display: grid; place-content: center">
                                                        <div class='randomColor photo_users' style="color:white; font-size: 12px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                                                        </div>
                                                    </div>
                                                </span>
                                            @else
                                                <img src="{{asset('images/responsables/'.$refs->photos_resp_cfp)}}"  id = "photo_stg" style="height: 88px;width:100px;border-radius:10px">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="col-md-10" >
                                    <form action="{{route('modification.general')}}" method="get" enctype="multipart/form-data">
                                        @csrf
                                    <div class="file-input-wrapper">
                                        <button class=" btn " style="background-color:#6610f2;color:white">Upload</button>
                                        <input id="file-input" type="file" name="image" id="image" value="" />          
                                      </div>            
                                    </div>
                              </div>
                              
                             
                              
                              <input type="hidden" value="{{$refs->id}}" name="id"><br>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="float-start">
                                        <label style="font-size: 12px;color:gray" for="">Noms :</label>
                                        <input type="text" value="{{$refs->nom_resp_cfp}}" class="form-control" name="nom_resp_cfp" style="width: 450px">
                                    </div>
                                    <div class="float-end">
                                        <label style="font-size: 12px;color:gray;margin-left:10px" for="">Prenoms :</label>
                                        <input type="text" class="form-control" value="{{$refs->prenom_resp_cfp}}" name="prenoms" style="margin-left:10px;width:350px">
                                    </div>
                                    
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="float-start">
                                        <label style="font-size: 12px;color:gray" for="">Phone :</label>
                                        @if ($refs->telephone_resp_cfp==null)
                                        <input type="text" class="form-control" value="incomplet" name="phone" style="width: 450px;color:red">
                                        @else
                                        <input type="text" class="form-control" name="phone" value="{{$refs->telephone_resp_cfp}}" style="width: 450px">
                                        @endif
                                    </div>
                                    <div class="float-end">
                                        <label style="font-size: 12px;color:gray;margin-left:10px" for="">CIN :</label>
                                        <input type="text" class="form-control" value="{{$refs->cin_resp_cfp}}" name="CIN" style="margin-left:10px;width:350px">
                                    </div>
                                </div>
                            
                              </div>
                              <div class="row">
                                <button class="btn btn-info mt-2" style="width: 100px;background-color:#6610f2;margin-left:720px;margin-bottom:50px" >Modifier</button>
                              </div>
                            </form>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="row mt-3">
                        <form action="{{route('modification_mdp')}}" method="get">
                        @csrf
                            <div class="col-md-12">      
                                    <label style="font-size: 12px;color:gray" for="">Email:</label>
                                    <input type="text" class="form-control" value="{{$refs->email_resp_cfp}}" name="email" style="width: 820px" required> 
                                    <label style="font-size: 12px;color:gray" for="">Mots de passe actuel:</label>
                                    <input type="password" class="form-control" name="actuel" style="width: 820px" required> 
                                    <label style="font-size: 12px;color:gray" for="">Nouveaux mots de passe:</label>
                                    <input type="password" class="form-control" name="nouveaux" style="width: 820px" required> 
                                    <button class="btn btn-info mt-2" style="width: 100px;background-color:#6610f2;margin-left:720px;margin-bottom:50px" >Modifier</button>
                            </div>
                        </form>
                    </div> 
                      
                  </div>
                  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <div class="row mt-3">
                        <form action="{{route('modification_coo')}}" method="get">
                        @csrf
                        <div class="col-md-12">   
                            <div class="float-start">   
                                <label style="font-size: 12px;color:gray" for="">Lot:</label>
                                @if ($refs->adresse_lot==null)
                                    <input type="text" value="Incomplet" class="form-control" style="width: 420px;color:red"> 
                                @else
                                    <input type="text" value="{{$refs->adresse_lot}}" name="lot" class="form-control" style="width: 420px" required> 
                                @endif
                                <label style="font-size: 12px;color:gray" for="">Quartier:</label>
                                @if ($refs->adresse_quartier==null)
                                    <input type="text" value="Incomplet" class="form-control" style="width: 420px;color:red"> 
                                @else
                                    <input type="text" value="{{$refs->adresse_quartier}}" name="quartier" class="form-control" style="width: 420px" required> 
                                @endif
                                <label style="font-size: 12px;color:gray" for="">Ville:</label>
                                @if ($refs->adresse_ville==null)
                                    <input type="text" value="Incomplet" class="form-control"  style="width: 420px;color:red"> 
                                @else
                                    <input type="text" value="{{$refs->adresse_ville}}" name="ville" class="form-control" style="width: 420px" required> 
                                @endif
                                
                               
                            </div>
                            <div class="float-end " style="margin-left:2px">

                                <label style="font-size: 12px;color:gray" for="">Region:</label>
                                @if ($refs->adresse_region==null)
                                    <input type="text" value="Incomplet" class="form-control" style="width: 420px;color:red"> 
                                @else
                                    <input type="text" value="{{$refs->adresse_region}}" name="region" class="form-control" style="width: 420px" required> 
                                @endif
                                <label style="font-size: 12px;color:gray" for="">Code Postal:</label>
                                @if ($refs->adresse_code_postal==null)
                                    <input type="text" value="Incomplet" class="form-control" style="width: 420px;color:red"> 
                                @else
                                    <input type="text" value="{{$refs->adresse_code_postal}}" name="cp" class="form-control" style="width: 420px" required> 
                                @endif
                                
                                
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <button class="btn btn-info mt-2" style="width: 100px;background-color:#6610f2;margin-left:10px;margin-bottom:50px" >Modifier</button>
                    </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                </div>
              </div>
              
        </div>  
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
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

    (function($) {
    $('input[type="file"]').bind('change', function() {
        $("#img_text").html($('input[type="file"]').val());
    });
    })(jQuery);
    function mandeA(){
        document.getElementById('test').innerHTML ='Sécurités';
    }
    function mandeB(){
        document.getElementById('test').innerHTML ='Coordonées';
    }
    function mandeG(){
        document.getElementById('test').innerHTML ='General';
    };
    
    
</script>
@endsection
