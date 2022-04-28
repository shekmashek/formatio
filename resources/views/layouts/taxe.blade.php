
@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Taxes
    </p>
@endsection
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
@section('content')
<center>
<div class="col-lg-4 mt-5">
    <div class="p-3 form-control">
 <form method="POST" action="{{route('taxe_enregistrer')}}">
    @csrf
        <div class="row px-3 mt-4">
                <div class="form-group mt-1 mb-1">
         <input type="text" class="form-control test input"  name="tva">
        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
            <label class="ml-3 form-control-placeholder" >TVA</label>

            </div>
            </div>
        {{-- <div class="row px-3 mt-4">
            <div class="form-group mt-1 mb-1">
        <input type="text" class="form-control test input"  name="valeur">
    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
        {{-- <label class="ml-3 form-control-placeholder" >Valeur</label>
    
    </div>
    </div> --}} 
    <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
 </form>
</div>
</div>
</center>
@endsection