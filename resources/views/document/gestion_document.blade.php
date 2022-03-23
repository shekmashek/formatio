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
        padding-top: 1.25rem;
        border-radius: 5px;
        height: 4rem;
        border: 1px solid rgba(128, 128, 128, 0.651);
        position: relative;
        bottom: 3.5rem
    }

    .fa-folder{
        color: #7635dc !important;
        font-size: 20px !important;
    }

</style>
@section('content')
<div class="container" style="padding-top: 50px">
    <div class="row">
        <div class="col-md-4">
            <strong>Gestion de vos documents</strong>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <span class="" style = "background-color: #801D68;color:white"><i class="fa fa-plus"></i>&nbsp; <a href="" data-bs-toggle="modal" data-bs-target="#creer_dossier"> Créer un nouveau dossier </a> </span>
        </div><br><br>
        <hr>
    </div>
    <div class="row liste">
        <div class="col-md-2">
            <i class="fa fa-caret-right " id="droite" onclick="afficherSousDossier();" ></i>&nbsp;&nbsp;<i class="fa fa-folder"></i>&nbsp;&nbsp;<a href="{{route('gestion_documentaire')}}">  {{$get_nom_cfp}} </a>
            <div class="row" id="sub_directory" style="display: none;">
                @for($i = 0; $i < $nb_sub_folder; $i++)
                <div class="col-12">
                    <span style="padding-left: 28px"><i class="fa fa-folder"></i>&nbsp; <a href="{{route('liste_fichier',$get_sub_folder[$i]['name'])}}"> {{$get_sub_folder[$i]['name']}} </a> </span> &nbsp;&nbsp
                </div>
                @endfor
            </div>
        </div>

        <div class="col-md-1"><span class="vertical-line"></span></div>
        <div class="col-md-9 d-flex flex-wrap flex-row align-content-center">
            @for($i = 0; $i < $nb_sub_folder; $i++)
                <span class = "sous_dossier me-2 ms-2 mt-2 mb-2"><i class="fa fa-folder"></i>&nbsp; <a href="{{route('liste_fichier',$get_sub_folder[$i]['name'])}}"> {{$get_sub_folder[$i]['name']}} </a>  &nbsp;&nbsp;
                    @if ($get_sub_folder[$i]['name']!="Mes documents")
                        <div class=" btn-group dropend">
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <li style="font-size:15px"><a href="#" data-bs-toggle="modal"  data-bs-target="#exampleModal_{{$get_sub_folder[$i]['name']}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i>Supprimer</a></li>
                            </div>
                        </div>
                    @endif

                </span>
                {{-- modal delete  --}}
                <div class="modal fade"  id="exampleModal_{{$get_sub_folder[$i]['name']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                          <h6 class="modal-title text-white">Avertissement !</h6>

                        </div>
                        <div class="modal-body">
                          <small>Voulez-vous vraiment effacer ce dossier?Cette action est irréversible. Continuer ?</small>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                          <form action="{{route('delete_folder')}}" method="POST">
                                  @csrf
                                  {{-- {{ method_field('DELETE') }} --}}
                                  {{-- @method('delete') --}}
                              <button type="submit" class="btn btn-secondary"> Oui </button>
                              <input name="id" type="text" value="{{$get_sub_folder[$i]['name']}}" hidden>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            @endfor
        </div>
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
<script>
    function afficherSousDossier(){
        let sub_dir = document.getElementById('sub_directory');
        if(getComputedStyle(sub_dir).display != "none"){
            sub_dir.style.display = "none";
            droite.className = "fa fa-caret-right";
        }

        else{
            sub_dir.style.display = "block";
            droite.className = "fa fa-caret-down";
        }
    }
</script>
@endsection