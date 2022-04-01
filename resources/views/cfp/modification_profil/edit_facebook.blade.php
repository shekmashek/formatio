@extends('./layouts/admin')
@section('content')
<style>

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
<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_of',$id)}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" style="color:black"> Page précédente</button></a>
</div>

<center>
    @if (\Session::has('erreur_reseau'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('erreur_reseau') !!}</li>
            </ul>
        </div>
    @endif

    <div class="col-lg-4">
        <div class="p-3 form-control">
            <p style="text-align: left">Lien facebook</p>
            <form   class="btn-submit" action="{{route('ajout_facebook',$id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    @if($lien == null)
                        <input type="text" value="" class="form-control test input"  name="facebook">
                    @else
                        <input type="text" value="{{$lien[0]->lien_facebook}}" class="form-control test input"  name="facebook">
                    @endif
                    </div>
                </div>


                <button style=" background-color: #801D68;color:white;float: right;" class=" mt-1 btn modification "> Enregister</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
        </div>
    </div>
</div>


@endsection