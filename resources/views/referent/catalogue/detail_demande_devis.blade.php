@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Detail demande de devis </h3>
@endsection
@section('content')
<style>
    .test {
  position: absolute; /* postulat de départ */
  top: 50%; left: 50%; /* à 50%/50% du parent référent */
  transform: translate(-50%, -50%); /* décalage de 50% de sa propre taille */
}
</style>

<a href="{{url()->previous()}}" ><button type="button" class="btn btn_precedent my-2 edit_pdp_cfp" ><i class="bx bx-chevron-left me-1"></i> Retour</a></button>
<div class="container-fluid " style="max-width:660px;">
<div class="row">
 <div class="col-lg-3"></div>
<div class="col-lg-6 form-control">
<div class="mt-3 text-center ">
<h5>{{$detail->objet}}</h5>
<i class='bx bx-user-circle'></i>&nbsp;<span style="font-weight: bold">{{$detail->nom}}</span> < {{$detail->email}} ><br>
<span style="font-size:13px" class="ms-3">À moi</span><br>
{{$detail->description}}
</div>
</div>
<div class="col-lg-3"></div>
</div>
</div>
@endsection

