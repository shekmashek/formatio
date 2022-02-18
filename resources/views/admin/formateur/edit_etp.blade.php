@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .input{
        width: 205px;
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
  margin-left: 90px;
}
</style>
<center>                
<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Poste</p>
        <form   class="btn-submit" action="{{route('update_prof',$formateur->id)}}" method="post" enctype="multipart/form-data">
            @csrf
        
                    <input type="hidden" value="   {{ $formateur->nom_formateur }}" class="form-control test input"  name="nom">
                    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
                 
               
                        <input type="hidden" class="form-control test input" value="   {{ $formateur->prenom_formateur }}"  name="prenom">
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Prénom</label> --}}
                      
                       
                        <input type="hidden" class="form-control test input" value="{{ $formateur->adresse }}"  name="adresse">
                       
            {{-- <center>
                <div class="image-upload">
                  <label for="file-input">
                    <div class="upload-icon">
                        <img src="{{asset('images/formateurs/'.$formateur->photos)}}" id = "photo_stg"  class="image-ronde"> 
                      {{-- <input type="text" id = 'vartemp'> --}}
              {{-- </div>
                  </label>
                     <input id="file-input" type="file" name="image" value="{{$formateur->photos}}"/>
                  </div> --}}
            
               <select hidden  value="{{$formateur->genre}}" name="genre" class="form-select test" id="genre"  >
                          <option value="{{$formateur->genre}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select>
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Genre</label> --}}
 
                       
                      
                        <input type="hidden" class="form-control test" name="dateNais" value="{{ $formateur->date_naissance }}">
                        
                          <input type="hidden" value="{{ $formateur->cin}}" class="form-control test"  name="cin" >
                          
                        <input type="hidden" class="form-control test input"  name="mail" value="   {{ $formateur->mail_formateur }}" >

                

                        <input type="hidden" class="form-control test"  name="phone" value="  {{ $formateur->numero_formateur }}"> 
                                       <input type="hidden" class="form-control test" value=""  name="password" placeholder="">  
                        <input type="hidden" class="form-control test"  name="niveau" value="  {{ $formateur->niveau}}"> 
                          
                        <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                      
                  <input type="text" class="form-control test input"  name="specialite" value="   {{ $formateur->specialite }}">
               
                  <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Poste</label>
                         
                </div>
            </div>
               
               
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
    
    
    
   
@endsection