@extends('./layouts/admin')
<style>
    .liste{
        padding-top: 10px;
    }
    .vertical-line{
      border-left: 2px solid #000;
      display: inline-block;
      height: 300px;
      margin: 0 20px;
    }
    .sous_dossier{
        padding : 10px;
        border-radius: 5px;
    }
</style>
@section('content')
<div class="container" style="padding-top: 50px">
    <div class="row">
        <div class="col-md-4">
            <strong>Gestion de vos documents</strong>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <input type="file" name="file_name">  <span class="border border-dark sous_dossier" style = "background-color: #801D68;color:white"><i class="fa fa-upload"></i>&nbsp; <a href="">Importer</a> </span>
        </div><br><br><br>
        <hr>
    </div>
    <div class="row liste">
        <div class="col-md-2">
            <i class="fa fa-folder"></i>&nbsp;&nbsp;<a href="{{route('gestion_documentaire')}}">  {{$get_nom_cfp}} </a>
        </div>
        <div class="col-md-1"><span class="vertical-line"></span></div>
        {{-- <div class="col-md-9">
            @for($i = 0; $i < $nb_sub_folder; $i++)
               <span class = "border border-dark sous_dossier"><i class="fa fa-folder"></i>&nbsp; <a href="{{route('liste_fichier',$get_sub_folder[$i]['name'])}}"> {{$get_sub_folder[$i]['name']}} </a> </span> &nbsp;&nbsp;
            @endfor
        </div> --}}
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="creer_dossier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Le nom de votre dossier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('nouveau_dossier')}}" method="POST">
                @csrf
                <input type="text" class="form-control" name="nom_sous_dossier">

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
      </div>
    </div>
</div>
<!-- End Modal -->
@endsection