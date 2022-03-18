@extends('./layouts/admin')
@section('content')
    <div class="container-fluid">
        <div class="row align-items-center ligneServ">
            <div class="col-7">
                <i class="bx bx-comment-dots icon_collab text-center">&nbsp;Collaborations Services</i>
            </div>
            <div class="col-5">
                <h5>SERVICES</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked disabled>
                    <label class="form-check-label" for="flexCheckChecked">Centre de Formation</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked disabled>
                    <label class="form-check-label" for="flexCheckChecked">Demande de collaboration</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked disabled>
                    <label class="form-check-label" for="flexCheckChecked">Invitations</label>
                </div>
            </div>
        </div>
        <div class="row">
            <p>
                Envoyer des demandes de collaborations aux Centres de Formations disponibles
            </p>
        </div>
        <div class="row container d-flex justify-content-center">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Centre de Formations</h4>
                        <p class="card-description"> Liste des Centres de Formations </p>
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                        @endif
                        <div class="table-responsive text-center">
                            <table class="table table-borderless table-hover table-sm" id="table_frmt">
                                <tbody>
                                    @foreach($cfps as $c)
                                    <tr>
                                        <td>
                                            <img src="{{asset('images/CFP/'.$c->logo)}}" alt="photo" class="logo">
                                            <div id="cfp_pdp_{{$c->id}}" class="collapse">
                                                <hr>
                                                Domaine d'activiter: "{{$c->domaine_de_formation}}" <br>
                                                Activités: {{$c->domaine_de_formation}} <br>
                                                Téléphone: {{$c->telephone}} <br>
                                                Email: {{$c->email}} <br>
                                                <a href="#" type="button" data-toggle="collapse" data-target="#cfp_pdp_{{$c->id}}"><button type="submit" class="btn btn-primary" id="demande">fermer</button></a><br>
                                            </div>
                                        </td>
                                        <td class="py-1">{{$c->nom}}</td>
                                        <td>{{$c->adresse_ville}}</td>
                                        {{-- <td><a href="#" type="button" data-toggle="modal" data-target="#cfp_pdp_{{$c->id}}"><i class="bx bxs-plus-circle actions" title="Details"></i></a></td> --}}
                                        <td><a href="#" type="button" data-toggle="collapse" data-target="#cfp_pdp_{{$c->id}}"><i class="bx bxs-plus-circle actions" title="Details"></i></a></td>

                                        <td>

                                            @if($c->collaboration==1)
                                                <strong> <h5><i class="bx bx-user-check"></i></h5> </strong>
                                            @else
                                            <form action="{{ route('create_formateur_cfp') }}" method="POST">
                                                @csrf
                                                <input name="formateur_id" type="hidden" value="{{ $formateur_id }}">
                                                <input name="cfp_id" type="hidden" value="{{ $c->id }}">
                                                <button type="submit" class="btn btn-primary" id="demande"><i class="bx bx-layer-plus actions" title="Collaborer"></i></button>
                                            </form>
                                            @endif



                                            {{-- @if (count($cfpCollaborer)<=0)
                                                <form action="{{ route('create_formateur_cfp') }}" method="POST">
                                                    @csrf
                                                    <input name="formateur_id" type="hidden" value="{{ $formateur_id }}">
                                                    <input name="cfp_id" type="hidden" value="{{ $c->id }}">
                                                    <button type="submit" class="btn btn-primary" id="demande"><i class="bx bx-layer-plus actions" title="Collaborer"></i></button>
                                                </form>
                                            @else
                                                @foreach($cfpCollaborer as $cfpCollab)
                                                    @if ($c->id == $cfpCollab->cfp_id)
                                                        <strong> <h5><i class="bx bx-user-check"></i></h5> </strong>
                                                    @endif
                                                    @if ($c->id != $cfpCollab->cfp_id)
                                                    <form action="{{ route('create_formateur_cfp') }}" method="POST">
                                                            @csrf
                                                            <input name="formateur_id" type="hidden" value="{{ $formateur_id }}">
                                                            <input name="cfp_id" type="hidden" value="{{ $c->id }}">
                                                            <button type="submit" class="btn btn-primary" id="demande"><i class="bx bx-layer-plus actions" title="Collaborer"></i></button>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            @endif --}}




                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal" id="cfp" data-backdrop="static" data-keyboard="false" aria-labelledby="cfpLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="photo" class="img-fluid image_fmrt">
                            <i class="bx bx-x close" data-dismiss="modal" aria-label="Close"></i>
                        </div>
                        <div class="modal-body">
                            <div>
                                <h5 class="text-uppercase">Prenom Nom</h5>
                                <h4 class="mt-5 text-primary mb-5">Developpeur Web</h4> <span class="theme-color">Profil</span>
                                <div class="mb-3">
                                    <hr class="new1">
                                </div>
                                <div class="d-flex justify-content-between"> <span class="font-weight-bold">Sexe</span> <span class="text-muted"></span>Homme</div>
                                <div class="d-flex justify-content-between"> <span>Age</span><span></span>25</div>
                                <div class="d-flex justify-content-between"> <span>Niveau d'étude</span> <span>Master en developpement Web</span> </div>
                            </div>
                        </div>
                        <div class="modal-footer"> <button type="button" class="btn btn-default text-primary" data-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container d-flex justify-content-center">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Demandes</h4>
                        <p class="card-description"> Liste des Demandes aux Centres de Formations</p>
                        <div class="table-responsive text-center">
                            <table class="table table-info table-borderless table-hover table-sm" id="table_dmd">
                                <tbody>
                                    @foreach($demmande as $demand)
                                        <tr>
                                        <td><a href="" data-toggle="collapse" data-target="#plus_{{$demand->id}}">
                                            <img src="{{asset('images/CFP/'.$demand->logo_cfp)}}" class="logo"><br>
                                            </a>
                                        <div id="plus_{{$demand->id}}" class="collapse">
                                        <hr>
                                            Activité: {{$demand->domaine_de_formation}} <br>
                                            Adresse: {{$demand->adresse_ville_cfp}} <br>
                                            Téléphone: {{$demand->tel_cfp}} <br>
                                            Email: {{$demand->mail_cfp}} <br>
                                        </div>
                                        </td>
                                            <td width = "200px">{{$demand->nom_cfp}}</td>
                                            <td width = "200px">{{$demand->attente}}</td>
                                        <td>
                                            <a href="{{ route('delete_formateur_cfp',$demand->id)}}"><i class="bx bxs-x-circle actions" title="Annuler"></i></a>
                                            <div id="modifier_{{$demand->id}}" class="collapse">
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container d-flex justify-content-center">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Invitations</h4>
                        <p class="card-description"> Liste des Invitations des Centres de Formations</p>
                        <div class="table-responsive text-center">
                            <table class="table table-danger table-borderless table-hover table-sm" id="table_invt">
                                <tbody>
                                    @foreach($invitation as $invit)
                                        <tr>
                                        <td  class="py-1"><a href="" data-toggle="collapse" data-target="#info_{{$invit->id}}"><img src="{{asset('images/CFP/'.$invit->logo_cfp)}}"  class="logo"></a>
                                            <div id="info_{{$invit->id}}" class="collapse">
                                                @csrf
                                                <hr>
                                                Activite: {{$invit->domaine_de_formation}} <br>
                                                Adresse: {{$invit->adresse_ville_cfp}} <br>
                                                Téléphone: {{$invit->tel_cfp}} <br>
                                                Email: {{$invit->mail_cfp}} <br>
                                            </div>

                                        </td>
                                        <td width = "200px">{{$invit->nom_cfp}}</td>
                                        <td><a href="{{ route('annulation_formateur_cfp',$invit->id) }}" ><i class="bx bxs-x-circle actions btn-danger" title="Annuler"></i></a></td>
                                        <td><a href="{{ route('accept_formateur_cfp',$invit->id) }}"><i class="bx bxs-check-circle actions btn-success" title="Accepter"></i></a>
                                            <div id="modifier_{{$invit->id}}" class="collapse">
                                        </td>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
                $('#table_frmt').DataTable();
        });
    </script>
@endsection
