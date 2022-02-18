@extends('./layouts/admin')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" rel="stylesheet" />

<style>
   .input{
        width: 170px;
    }
.test {
    padding: 2px;
    border-radius: 5px;
    box-sizing: border-box;
    color: #9E9E9E;
    border: 1px solid #BDBDBD;
    font-size: 16px;
    letter-spacing: 1px;
    height: 50px !important
}

.test:focus{
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 2px solid #E53935 !important;
    outline-width: 0 !important;
}

.form-control-placeholder {
  position: absolute;
  top: 1rem;
  padding: 12px 2px 0 2px;
  padding: 0;
  padding-top: 2px;
  padding-bottom: 5px;
  transition: all 300ms;
  opacity: 0.5;
  left: 2rem;
}

.test:focus+.form-control-placeholder,
.test:valid+.form-control-placeholder {
  font-size: 95%;
  font-weight: bolder;
  top: 1.5rem;
  transform: translate3d(0, -100%, 0);
  opacity: 1;
  background-color: white;
  margin-left: 105px;

}
/* image style */
.profilepic {
  position: relative;
  width: 125px;
  height: 125px;
  border-radius: 50%;
  overflow: hidden;
  background-color: rgb(116, 111, 111);
}

.profilepic:hover .profilepic__content {
  opacity: 1;
}

.profilepic:hover .profilepic__image {
  opacity: .5;
}

.profilepic__image {
  object-fit: cover;
  opacity: 1;
  transition: opacity .2s ease-in-out;
}

.profilepic__content {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: white;
  opacity: 0;
  transition: opacity .2s ease-in-out;
}

.profilepic__icon {
  color: white;
  padding-bottom: 8px;
}

.fas {
  font-size: 20px;
}

.profilepic__text {
  text-transform: uppercase;
  font-size: 12px;
  width: 50%;
  text-align: center;
}
</style>
<center>                

<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Modifier la Photo</p>
        <form   class="btn-submit" action="{{route('update_photo_chef',$chef->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row px-3 mt-4">
                <div class="form-group mt-1 mb-1">
                    <center>
                        <div class="image-upload">
                          <label for="file-input">
                            <div class="upload-icon profilepic">
                                <img src="/stagiaire-image/{{$chef->photos}}" id = "photo_stg"  class="image-ronde profilepic__image"> 
                              {{-- <input type="text" id = 'vartemp'> --}}
                              <div class="profilepic__content">
                                <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                                <span class="profilepic__text">Modifier photo</span>
                              </div>
                      </div>
                          </label>
                             <input id="file-input" type="file" name="image" value="{{$chef->photos}}"/>
                          </div>
                    </center>  
            </div>
        </div>
             
                    <input type="hidden" value="   {{ $chef->nom_chef }}" class="form-control test input"  name="nom">
                    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
               
                    <input type="hidden" value="   {{ $chef->prenom_chef }}" class="form-control test input"  name="prenom">
                  

                        <input type="hidden" class="form-control test input" name="fonction"  value="  {{ $chef->fonction_chef }}" >
                          
                     
 
                        <input type="hidden" value="{{ $chef->mail_chef}}" class="form-control test input"  name="mail" >
                       
                        <input type="hidden" class="form-control test input"  name="phone" value="  {{ $chef->telephone_chef}}" >
                       
                   
<button style=" background-color: #801D68;color:white;float: right;" class=" mt-1 btn modification "> Enregister</button>
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
      -moz-border-radius : 75px;
      -webkit-border-radius : 75px;
      border-radius : 75px;
      cursor: pointer;
      margin-top: -6px;
      margin-left: -15px;
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