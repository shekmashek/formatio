@extends('./layouts/admin')
@section('content')
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
</style>
<center>                

<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Modifier Logo</p>
        <form   class="btn-submit" action="{{route('utilisateur_update_cfp',$cfp->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row px-3 mt-4">
                <div class="form-group mt-1 mb-1">
                    <center>
                        <div class="image-upload">
                          <label for="file-input">
                            <div class="upload-icon">
                                <img src="{{asset('images/CFP/'.$cfp->logo)}}" id = "photo_stg"  class="image-ronde"> 
                              {{-- <input type="text" id = 'vartemp'> --}}
                      </div>
                          </label>
                             <input id="file-input" type="file" name="image" value="{{$cfp->logo}}"/>
                          </div>
                    </center>  
        </div>
    </div>
                
                    <input type="hidden" value="   {{ $cfp->nom }}" class="form-control test input"  name="nom_cfp">
                   
                        <input type="hidden" class="form-control test" name="adresse_lot"  value="{{ $cfp->adresse_lot }}" >
                          <input type="hidden" value="{{ $cfp->adresse_ville}}" class="form-control test"  name="adresse_ville" >

                        <input type="hidden" class="form-control test"  name="adresse_region" value="{{ $cfp->adresse_region }}" >

                        <input type="hidden" class="form-control test" name="phone" value="{{ $cfp->telephone }}">
                        <input type="hidden" class="form-control test" value=""  name="password" placeholder="">  
                          
                    
                  <input class="form-control test"  type="hidden" name="mail" value="{{ $cfp->email }}">
                    <input type="hidden" value="{{ $cfp->site_cfp}}"  class="form-control"  name="site_web" placeholder="" >
            
                    
 
                    <input type="hidden" class="form-control test input"  name="domaine_cfp" placeholder="Fonction" value="  {{ $cfp->domaine_de_formation }}" >
                 
                  
                    <input type="hidden" class="form-control"  name="nif_cfp"  value="{{ $cfp->nif}}" >
                
                    <input type="hidden" value="{{ $cfp->stat}}"  class="form-control"  name="stat_cfp" placeholder="Matricule" >
             
                 
  
                    <input type="hidden" class="form-control test input"  name="cif_cfp" value="  {{ $cfp->cif }}" >
                
                    <input type="hidden" class="form-control"  name="rcs_cfp" value="{{ $cfp->rcs }}" >

            
                 
                   
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