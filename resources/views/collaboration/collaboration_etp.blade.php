@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Collaborations services</p>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row align-items-center ligneServ">
            <div class="col-7">
                <i class="bx bx-comment-dots icon_collab text-center">&nbsp;Collaborations Services</i>
            </div>
            <div class="col-5 mt-4">
                <p style="font-size: 14px">SERVICES</p>
                <div style="font-size: 12px">
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
        </div>
        <div class="row">
            <p style="font-size: 12px">
                Envoyer des demandes de collaborations aux Centres de Formations disponibles
            </p>
        </div>
        <div class="row container d-flex justify-content-center">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title" style="font-size: 14px">Centre de Formations</p>
                        {{-- <p class="card-description"> Listes des Centres de Formations </p> --}}
                            <br>
                            {{-- <h5> Entreprise</h5> --}}
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
                                                {{-- Domaine d'activiter: {{$c->domaine_de_formation}} <br> --}}
                                                {{-- Activités: {{$c->domaine_de_formation}} <br> --}}
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
                                            @if ($c->collaboration == 1)
                                                <strong> <h5><i class="bx bx-user-check"></i></h5> </strong>
                                            @else
                                                <form action="{{ route('create_etp_cfp') }}" method="POST">
                                                    @csrf
                                                    <input name="etp_id" type="hidden" value="{{ $entreprise_id }}">
                                                    <input name="cfp_id" type="hidden" value="{{ $c->id }}">
                                                    <button type="submit" class="btn btn-primary" id="demande"><i class="bx bx-layer-plus actions" title="Collaborer"></i></button>
                                                </form>
                                            @endif

                                        </td>
                                    </tr>

                                <!-- Modal -->


                                <div class="modal" id="cfp_static" data-backdrop="static" data-keyboard="false" aria-labelledby="cfpLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <img src="{{asset('images/CFP/'.$c->logo)}}" alt="photo" class="img-fluid image_fmrt">
                                                <i class="bx bx-x close" data-dismiss="modal" aria-label="Close"></i>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <h5 class="text-uppercase">{{$c->nom}}</h5>
                                                    {{-- <h4 class="mt-5 text-primary mb-5">{{$c->domaine_de_formation}}</h4> <span class="theme-color">Informations</span> --}}
                                                    <div class="mb-3">
                                                        <hr class="new1">
                                                    </div>
                                                    <div class="d-flex justify-content-between"> <span class="font-weight-bold">Adresse</span> <span class="text-muted"></span>{{$c->adresse_ville}}</div>
                                                    <div class="d-flex justify-content-between"> <span>Téléphone</span><span></span>{{$c->telephone}}</div>
                                                    <div class="d-flex justify-content-between"> <span>Mail</span> <span>{{$c->email}}</span> </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer"> <button type="button" class="btn btn-default text-primary" data-dismiss="modal">Close</button></div>
                                        </div>
                                    </div>
                                </div>

                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            {{-- <div class="modal" id="cfp" data-backdrop="static" data-keyboard="false" aria-labelledby="cfpLabel" aria-hidden="true">
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
            </div> --}}
        </div>

        <div class="row container d-flex justify-content-center">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title" style="font-size: 14px">Mes Demandes</p>
                        {{-- <p class="card-description"> Listes des Demandes aux Centres de Formations</p> --}}
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
                                            <a href="{{ route('delete_etp_cfp',$demand->id)}}"><i class="bx bxs-x-circle actions" title="Annuler"></i></a>
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
                        <p class="card-title" style="font-size: 14px">Invitations</p>
                        <p class="card-description" style="font-size: 12px"> Liste des Invitations des Centres de Formations</p>
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
                                        <td><a href="{{ route('annulation_etp_cfp',$invit->id) }}" ><i class="bx bxs-x-circle actions btn-danger" title="Annuler"></i></a></td>
                                        <td><a href="{{ route('accept_etp_cfp',$invit->id) }}"><i class="bx bxs-check-circle actions btn-success" title="Accepter"></i></a>
                                            <div id="modifier_{{$invit->id}}" class="collapse">
                                        </td>

                                    @endforeach

                                    {{-- <tr>
                                        <td class="py-1">1</td>
                                        <td>Vonjy</td>
                                        <td>Nomenjanahary</td>
                                        <td><a href="#" ><i class="bx bxs-x-circle actions" title="Annuler"></i></a></td>
                                        <td><a href="#"><i class="bx bxs-check-circle actions" title="Accepter"></i></a></td>
                                    </tr> --}}
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
