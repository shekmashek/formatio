@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification CIF</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('affichage_parametre_cfp',$cif->id)}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp">Page précédente</button></a>
</div>

<center>
    @if (\Session::has('error_rcs'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('error_rcs') !!}</li>
            </ul>
        </div>
    @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">
            <form class="btn-submit" action="{{route('enregistrer_modification_cif_cfp',$cif->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" id="cif" name="cif" placeholder="CIF" value="{{$cif->cif}}">
                        <label class="form-control-placeholder ">CIF</label>

                    </div>
                </div>
                <button  class="btn_enregistrer mt-1 btn modification "> Enregister</button>
            </form>
        </div>
    </div>
    <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>


@endsection