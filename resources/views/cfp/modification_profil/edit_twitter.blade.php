@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification twiter</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('affichage_parametre_cfp',$id)}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
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
            <p style="text-align: left"></p>
            <form   class="btn-submit" action="{{route('ajout_twitter',$id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        @if($lien == null)
                            <input type="text" value="" class="form-control test input"  name="twitter">
                        @else
                            <input type="text" value="{{$lien[0]->lien_twitter}}" class="form-control test input"  name="twitter">
                        @endif
                        <label class="form-control-placeholder ">Lien twitter</label>
                    
                    </div>
                </div>


                <button  class="btn_enregistrer mt-1 btn modification "> Enregister</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
        </div>
    </div>
</div>


@endsection