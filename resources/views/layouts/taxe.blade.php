
@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Taxes
    </p>
@endsection
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
@section('content')
<center>
{{-- <div class="col-lg-4 mt-5">
    <div class="p-3 form-control">
 <form method="POST" action="{{route('taxe_enregistrer')}}">
    @csrf
        <div class="row px-3 mt-4">
                <div class="form-group mt-1 mb-1">
         <input type="text" class="form-control test input"  name="tva"> --}}
        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
            {{-- <label class="ml-3 form-control-placeholder" >TVA</label>

            </div>
            </div> --}}
        {{-- <div class="row px-3 mt-4">
            <div class="form-group mt-1 mb-1">
        <input type="text" class="form-control test input"  name="valeur">
    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
        {{-- <label class="ml-3 form-control-placeholder" >Valeur</label>
    
    </div>
    </div> --}} 
    {{-- <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
 </form>
</div>
</div> --}}
<div class="container">
    <div class="col-md-8">
        <table class="table mt-4">
            <thead>
            <th>TVA</th>
            <th>Action</th>

            </thead>
            <tbody>
                @foreach ($tva as $taxe )
                <tr>
                    <td>{{$taxe->pourcent}}%</td>
                    <td>
                        <a href="" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal_{{$taxe->id}}">
                            <i class='bx bxs-edit-alt'  style="color: green"></i>
                          </a>
                          {{-- <a href="{{route('delete_tva',$taxe->id)}}" type="button"  onclick="return  confirm('voulez vraiment supprimer?')">
                            <i class='bx bx-trash' style="color: red"></i>
                          </a> --}}
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal_{{$taxe->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>Modification</h1>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('update_tva')}}"  method="post">
                                    @csrf
                                    <label for=""> Tva</label>
                                    <input type="text" class="form-control" required name="tva" value="{{$taxe->pourcent}}">
                                    <input type="hidden" class="form-control" required name="id" value="{{$taxe->id}}"> <br><br>
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; Retour</button>
                                    <button type="submit" class="btn btn-primary">&nbsp; Enregistrer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
</center>
    <!-- Button trigger modal -->
   

<!-- Modal -->

@endsection