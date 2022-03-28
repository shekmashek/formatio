@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<center>

<div class="col-lg-4">
    <div class="p-3 form-control">

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
                  <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
               <select   value="{{$formateur->genre}}" name="genre" class="form-select test input" id="genre"  >
                          <option value="2"  >Homme</option>
                          <option value="1">Femme</option>

                        </select>
                        <label class="ml-3 form-control-placeholder">Genre</label>

                    </div>
                </div>
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Genre</label> --}}



                        <input type="hidden" class="form-control test" name="dateNais" value="{{ $formateur->date_naissance }}">

                          <input type="hidden" value="{{ $formateur->cin}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="   {{ $formateur->mail_formateur }}" >


                        <input type="hidden" class="form-control test"  name="phone" value="  {{ $formateur->numero_formateur }}">
                                       <input type="hidden" class="form-control test" value=""  name="password" placeholder="">
                        <input type="hidden" class="form-control test"  name="niveau" value="  {{ $formateur->niveau}}">



                  <input type="hidden" class="form-control test"  name="specialite" value="   {{ $formateur->specialite }}">




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