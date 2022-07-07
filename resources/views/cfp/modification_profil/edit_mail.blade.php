@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Modification email</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_du_responsable')}}"> <button class="btn btn_precedent"><i
                class='bx bxs-chevron-left me-1'></i>Retour</button></a>

</div>

<center>
    @if (\Session::has('error_mail'))
    <div class="alert alert-danger col-md-4">
        <ul>
            <li>{!! \Session::get('error_mail') !!}</li>
        </ul>
    </div>
    @endif

    <div class="col-lg-4">
        <div class="p-3 form-control">

            <form class="btn-submit" action="{{route('enregistrer_modification_mail_cfp',$cfp->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="hidden" value="resp">
                    <input type="email" value="{{ $cfp->email}}" class="form-control test input"  name="mail">
                        <label class="form-control-placeholder ">Email</label>
                    </div>
                </div>
                <button  class="btn btn_enregistrer  mt-1 btn modification "><i class="bx bx-check me-1"></i> Enregistrer</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>


@endsection