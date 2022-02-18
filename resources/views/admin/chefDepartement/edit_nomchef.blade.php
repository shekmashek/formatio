@extends('./layouts/admin')
@section('content')
<style>
   .input{
        width: 300px;
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
  margin-left: 50px;

}
</style>
<center>                

<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Modifier le nom</p>
        <form   class="btn-submit" action="{{route('update_manager',$chef->id)}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $chef->nom_chef }}" class="form-control test input"  name="nom">
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label>
                    </div>
                </div>
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $chef->prenom_chef }}" class="form-control test input"  name="prenom">
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Prénom</label>
                    </div>
                </div>
                        <input type="hidden" class="form-control test" name="fonction"  value="{{ $chef->fonction_chef }}" >
                          <input type="hidden" value="{{ $chef->mail_chef}}" class="form-control test"  name="mail" >

                        <input type="hidden" class="form-control test"  name="phone" value="{{ $chef->telephone_chef}}" >

                   
<button style=" background-color: #801D68;color:white;float: right;" class=" mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center> 
</div>
</div>
</div>

@endsection