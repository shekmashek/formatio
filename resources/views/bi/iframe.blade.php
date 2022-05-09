@extends('./layouts.admin')
@section('title')
    <h3 class="text-white ms-5">Bussness intelligent</h3>
@endsection
<style>
    .navigation_module .nav-link {
    color: #637381;
    padding: 5px;
    cursor: pointer;
    font-size: 0.900rem;
    transition: all 200ms;
    margin-right: 1rem;
    text-transform: uppercase;
    padding-top: 10px;
    border: none;
}

.nav-tabs .nav-link.active {
    border-bottom: 3px solid #7635dc !important;
    border: none;
}

.nav-tabs .nav-link:hover {
    background-color: rgb(245, 243, 243);
    transform: scale(1.1);
    border: none;
}
.nav-tabs .nav-item a{
    text-decoration: none;
    text-decoration-line: none;
}
</style>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="m-4">
                <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab_etp" data-bs-toggle="tab" href="#etp" type="button" role="tab" aria-controls="etp" aria-selected="true">
                            Entreprises</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link" id="tab_of" data-bs-toggle="tab" href="#of" type="button" role="tab" aria-controls="of" aria-selected="true">
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
                                                    @if(count($iframe_etp)>0)
                                                        @foreach($iframe_etp as $f_etp)
                                                            <tr>
                                                                <td>{{$f_etp->nom_etp}}</td>
                                                                <td>
                                                                    @if($f_etp->iframe == null)
                                                                        <form action="enregistrer_iframe_etp" method="post" class="d-flex flex-row">
                                                                            @csrf
                                                                            <input type="hidden" name="entreprise_id" value={{$f_etp->entreprise_id}}>
                                                                            <input type="text" name="iframe_url" class="form-control"><button class="btn btn_next" type="submit">Ajouter </button>
                                                                        </form>
                                                                    @else
                                                                        {{$f_etp->iframe}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($f_etp->iframe != null)
                                                                        <div class="dropdown">
                                                                            <div class="btn-group dropstart">
                                                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="fa fa-ellipsis-v"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <a href="#" class="dropdown-item"><button class="btn btn_enregistrer my-2 " data-bs-toggle="modal" data-bs-target="#modal_{{$f_etp->entreprise_id}}"> <i class="bx bx-edit"></i> Modifier</button></a>
                                                                                    <a class="dropdown-item" href="#"><button class="btn btn_enregistrer my-2 delete_pdp_cfp" data-id="" id="" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$f_etp->entreprise_id}}" style="color: red">Supprimer</button></a>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                        </tr>
                                                         {{-- modal modifier  --}}
                                                        <div class="modal fade"  id="modal_{{$f_etp->entreprise_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex justify-content-center" style="background-color:aquamarine;">
                                                                <h6 class="modal-title text-white">Modification </h6>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form  class="btn-submit" action="{{route('modifier_iframe_etp')}}" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input id="id_value" name = "id_etp" value="{{$f_etp->entreprise_id}}" style='display:none'>
                                                                        <div class="form-group">
                                                                            <label for="nom"><small><b>Iframe {{$f_etp->nom_etp}}</b></small></label>
                                                                            <input type="text" class="form-control" id="nomModif" name="n_iframe" placeholder="URL" value="{{$f_etp->iframe}}">
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
                                                         <div class="modal fade"  id="delete_modal_{{$f_etp->entreprise_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <input name="id_etp" type="text" value="{{$f_etp->entreprise_id}}" hidden>
                                                                    </form>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
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
                                                    @if(count($iframe_of)>0)
                                                    @foreach($iframe_of as $f_etp)
                                                        <tr>
                                                            <td>{{$f_etp->nom}}</td>
                                                            <td>
                                                                @if($f_etp->iframe == null)
                                                                    <form action="enregistrer_iframe_cfp" method="post" class="d-flex flex-row">
                                                                        @csrf
                                                                        <input type="hidden" name="cfp_id" value={{$f_etp->cfp_id}}>
                                                                        <input type="text" name="iframe_url" class="form-control"><button class="btn btn_next" type="submit">Ajouter </button>
                                                                    </form>
                                                                @else
                                                                    {{$f_etp->iframe}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($f_etp->iframe != null)
                                                                    <div class="dropdown">
                                                                        <div class="btn-group dropstart">
                                                                            <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <a href="#" class="dropdown-item"><button class="btn btn_enregistrer my-2 " data-bs-toggle="modal" data-bs-target="#modalcfp_{{$f_etp->cfp_id}}"> <i class="bx bx-edit"></i> Modifier</button></a>
                                                                                <a class="dropdown-item" href="#"><button class="btn btn_enregistrer my-2 delete_pdp_cfp" data-id="" id="" data-bs-toggle="modal" data-bs-target="#deletecfp_modal_{{$f_etp->cfp_id}}" style="color: red">Supprimer</button></a>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                         {{-- modal modifier  --}}
                                                         <div class="modal fade"  id="modalcfp_{{$f_etp->cfp_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex justify-content-center" style="background-color:aquamarine;">
                                                                <h6 class="modal-title text-white">Modification </h6>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form  class="btn-submit" action="{{route('modifier_iframe_cfp')}}" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input id="id_value" name = "id_cfp" value="{{$f_etp->cfp_id}}" style='display:none'>
                                                                        <div class="form-group">
                                                                            <label for="nom"><small><b>Iframe {{$f_etp->nom}}</b></small></label>
                                                                            <input type="text" class="form-control" id="nomModif" name="n_iframe_cfp" placeholder="URL" value="{{$f_etp->iframe}}">
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
                                                         <div class="modal fade"  id="deletecfp_modal_{{$f_etp->cfp_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <input name="id_cfp" type="text" value="{{$f_etp->cfp_id}}" hidden>
                                                                    </form>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
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
