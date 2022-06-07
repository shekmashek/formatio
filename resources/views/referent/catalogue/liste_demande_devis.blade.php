@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Listes demandes de devis </h3>
@endsection
@section('content')


<h5 style="font-weight: 200">Liste demande de devis</h5>
<table class="table">
   
    <tbody>
@foreach ($liste as $devis )
      <tr>
        <th scope="row"> 
        <a href="{{route('detail_demande_devis',$devis->id)}}">   <h6>{{$devis->nom_resp." ".$devis->prenom_resp}}<br>
            < {{$devis->email}} ></h6></a>
        </th>
        <td>
             <a href="{{route('detail_demande_devis',$devis->id)}}"><span class="d-inline-block text-truncate" style="max-width: 150px;">{{$devis->objet}}</a> </span>
        </td>
        <td>
        <a href="{{route('detail_demande_devis',$devis->id)}}">   <h6>{{$devis->reference_module." / ".$devis->nom_module."  ".$devis->date_envoye}}</h6> 
        </td>
        <td>
        <a href="{{route('detail_demande_devis',$devis->id)}}">  <a href=""  data-bs-toggle="modal" data-bs-target="#deletedep_{{$devis->id}}" role="button" ><i class='bx bx-trash bx_supprimer' ></i></a>
        </td>
   {{-- modal delete departement --}}
   <div class="modal fade" id="deletedep_{{$devis->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center"
                style="background-color:rgb(224,182,187);">
                <h6 class="modal-title text-white">Avertissement !</h6>
            </div>
            <div class="modal-body">
                <small>Vous êtes sur le point d'effacer une donnée, cette action
                    est irréversible. Continuer ?</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal"> Non </button>
                <form action="{{route('delete_demande_devis',$devis->id)}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-secondary"> Oui
                    </button>
                    <input name="cfp_id" type="text" value="test" hidden>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach
     </tr>
</tbody>
</table>

@endsection