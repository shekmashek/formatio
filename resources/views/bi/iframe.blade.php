@extends('./layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="m-4">
                <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link btn_enregistrer" class=" active" id="tab_etp" data-bs-toggle="tab" href="#etp" type="button" role="tab" aria-controls="etp" aria-selected="true">
                            Entreprises</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn_enregistrer" class=" active" id="tab_of" data-bs-toggle="tab" href="#of" type="button" role="tab" aria-controls="of" aria-selected="true">
                            Organisme de Formation</a>
                    </li>
                </ul>
                <div class="tab-content mt-5" id="myTabContent">
                    {{-- entreprises --}}
                    <div class="tab-pane fade show active" id="etp" role="tabpanel" aria-labelledby="tab_etp">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12"><div class="shadow p-3 mb-12 bg-body rounded ">
                                        <h4>Entreprises</h4>
                                        <div class="table-responsive text-center">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nom</th>
                                                        <th scope="col">Iframe</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($entreprise)>0)
                                                        @for($i = 0; $i < count($entreprise); $i++)
                                                            <tr>
                                                                <td>{{$entreprise[$i]->nom_etp}}</td>
                                                                @if($iframe_etp == null)
                                                                    <td class="d-flex flex-row">
                                                                        <form action="enregistrer_iframe_etp" method="post" class="d-flex flex-row">
                                                                            @csrf
                                                                            <input type="hidden" name="entreprise_id" value={{$entreprise[$i]->id}}>
                                                                            <input type="text" name="iframe_url" class="form-control"><button class="btn btn_next" type="submit">Ajouter </button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                                @if($iframe_etp != null)
                                                                    @for($j= 0; $j< count($iframe_etp); $j++)
                                                                        @if($iframe_etp[$j]->entreprise_id == $entreprise[$i]->id)
                                                                            <td> {{$iframe_etp[$j]->iframe}}</td>
                                                                        @endif
                                                                    @endfor
                                                                @endif
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <div class="btn-group dropstart">
                                                                            <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <a href="#" class="dropdown-item"><button class="btn btn_enregistrer my-2 " data-bs-toggle="modal" data-bs-target="#modal_{{$entreprise[$i]->id}}"> <i class="bx bx-edit"></i> Modifier</button></a>
                                                                                <a class="dropdown-item" href="#"><button class="btn btn_enregistrer my-2 delete_pdp_cfp" data-id="" id="" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$entreprise[$i]->id}}" style="color: red">Supprimer</button></a>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                        </tr>
                                                         {{-- modal modifier  --}}
                                                        <div class="modal fade"  id="modal_{{$entreprise[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex justify-content-center" style="background-color:aquamarine;">
                                                                <h6 class="modal-title text-white">Modification </h6>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form  class="btn-submit" action="{{route('modifier_iframe_etp')}}" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input id="id_value" name = "id_etp" value="{{$entreprise[$i]->id}}" style='display:none'>
                                                                        <div class="form-group">
                                                                            <label for="nom"><small><b>Iframe {{$entreprise[$i]->nom_etp}}</b></small></label>
                                                                            <input type="text" class="form-control" id="nomModif" name="n_iframe" placeholder="URL">
                                                                        </div><br>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Non </button>
                                                                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal"> Oui </button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer"></div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                         {{-- modal supprimer  --}}
                                                         <div class="modal fade"  id="delete_modal_{{$entreprise[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                                    <h6 class="modal-title text-white">Avertissement !</h6>

                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Non </button>
                                                                    <form action="{{ route('supprimer_iframe_etp') }}" method="post">
                                                                            @csrf
                                                                            {{-- {{ method_field('DELETE') }} --}}
                                                                            {{-- @method('delete') --}}
                                                                        <button type="submit" class="btn btn-secondary"> Oui </button>
                                                                        <input name="id_etp" type="text" value="{{$entreprise[$i]->id}}" hidden>
                                                                    </form>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        @endfor
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- organisme de formation --}}
                    <div class="tab-pane fade show" id="of" role="tabpanel" aria-labelledby="tab_of">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="shadow p-3 mb-5 bg-body rounded ">

                                        <h4>Organisme de formation</h4>

                                        <div class="table-responsive text-center">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nom</th>
                                                        <th scope="col">Iframe</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($of)>0)
                                                        @for($i = 0; $i < count($of); $i++)
                                                        <tr>
                                                            <td>{{$of[$i]->nom}}</td>
                                                            @if($iframe_of == null)
                                                            <td class="d-flex flex-row">
                                                                <form action="enregistrer_iframe_cfp" method="post" class="d-flex flex-row">
                                                                    @csrf
                                                                    <input type="hidden" name="cfp_id" value={{$of[$i]->id}}>
                                                                    <input type="text" name="iframe_url" class="form-control w-50"><button class="btn btn_next" type="submit">Ajouter </button>
                                                                </form>
                                                            </td>
                                                            @else
                                                                @for($j= 0; $j< count($iframe_of); $j++) @if($iframe_of[$j]->cfp_id === $of[$i]->id)
                                                                    <td>{{$iframe_of[$j]->iframe}}</td>
                                                                    @else
                                                                        <td>
                                                                            <form action="enregistrer_iframe_cfp" method="post">
                                                                                @csrf
                                                                                <input type="hidden" name="cfp_id" value={{$of[$i]->id}}>
                                                                                <input type="text" name="iframe_url" class="form-control w-50"><button class="btn btn_next" type="submit">Ajouter </button>
                                                                            </form>
                                                                        </td>
                                                                    @endif
                                                                @endfor
                                                            @endif
                                                            <td>
                                                                <div class="dropdown">
                                                                    <div class="btn-group dropstart">
                                                                        <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <i class="fa fa-ellipsis-v"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <a href="#" class="dropdown-item"><button class="btn btn_enregistrer my-2 " data-bs-toggle="modal" data-bs-target="#modalcfp_{{$of[$i]->id}}"> <i class="bx bx-edit"></i> Modifier</button></a>
                                                                            <a class="dropdown-item" href="#"><button class="btn btn_enregistrer my-2 delete_pdp_cfp" data-id="" id="" data-bs-toggle="modal" data-bs-target="#deletecfp_modal_{{$of[$i]->id}}" style="color: red">Supprimer</button></a>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                         {{-- modal modifier  --}}
                                                         <div class="modal fade"  id="modalcfp_{{$of[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex justify-content-center" style="background-color:aquamarine;">
                                                                <h6 class="modal-title text-white">Modification </h6>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form  class="btn-submit" action="{{route('modifier_iframe_cfp')}}" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input id="id_value" name = "id_cfp" value="{{$of[$i]->id}}" style='display:none'>
                                                                        <div class="form-group">
                                                                            <label for="nom"><small><b>Iframe {{$of[$i]->nom}}</b></small></label>
                                                                            <input type="text" class="form-control" id="nomModif" name="n_iframe_cfp" placeholder="URL">
                                                                        </div><br>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Non </button>
                                                                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal"> Oui </button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer"></div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                         {{-- modal supprimer  --}}
                                                         <div class="modal fade"  id="deletecfp_modal_{{$of[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                                    <h6 class="modal-title text-white">Avertissement !</h6>

                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Non </button>
                                                                    <form action="{{ route('supprimer_iframe_cfp') }}" method="post">
                                                                            @csrf
                                                                            {{-- {{ method_field('DELETE') }} --}}
                                                                            {{-- @method('delete') --}}
                                                                        <button type="submit" class="btn btn-secondary"> Oui </button>
                                                                        <input name="id_cfp" type="text" value="{{$of[$i]->id}}" hidden>
                                                                    </form>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        @endfor
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
