@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Collaboration</h3>
@endsection
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
                    <label class="form-check-label" for="flexCheckChecked">Formateurs</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked disabled>
                    <label class="form-check-label" for="flexCheckChecked">Entreprises</label>
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
                Envoyer des demandes de collaborations aux Formateurs et aux entreprises disponibles
            </p>
            @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
            @endif
        </div>
        <div class="row container d-flex justify-content-center">
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Formateurs</h4>
                        <p class="card-description"> Liste des Formateurs </p>
                        <div class="table-responsive text-center">
                            <table class="table  table-borderless table-hover table-sm" id="table_frmt">
                                <tbody>
                                    @foreach($formateur as $format)
                                    <tr>
                                        <td><img src="{{asset('images/formateurs/'.$format->photos)}}" class="logo">
                                            <div id="pdp_formateur_{{$format->id}}" class="collapse">
                                                <hr>
                                                Niveau d'étude: {{$format->niveau}} <br>
                                                Spécialité: {{$format->specialite}} <br>
                                                Téléphone: {{$format->numero_formateur}} <br>
                                                Email: {{$format->mail_formateur}}<br>
                                            </div>
                                        </td>

                                        <td class="py-1">{{$format->nom_formateur.' '.$format->prenom_formateur}}</td>
                                        <td>{{$format->adresse}}</td>
                                        <td><a href="#" type="button" data-toggle="collapse" data-target="#pdp_formateur_{{$format->id}}"><i class="bx bxs-plus-circle actions" title="Details"></i></a></td>
                                        <td>
                                            @if ($format->collaboration==0)
                                                <form action="{{ route('create_cfp_formateur') }}" method="POST">
                                                    @csrf
                                                    <input name="formateur_id" type="hidden" value="{{ $format->id }}">
                                                    <input name="cfp_id" type="hidden" value="{{ $cfp_id }}">
                                                    <button type="submit" class="btn btn-primary" id="demande"><i class="bx bx-layer-plus actions" title="Collaborer"></i></button>
                                                </form>
                                            @else
                                                    <strong> <h5><i class="bx bx-user-check"></i></h5> </strong>


                                            @endif


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
            <div class="modal" id="frmt" data-backdrop="static" data-keyboard="false" aria-labelledby="frmtLabel" aria-hidden="true">
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

            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Entreprises</h4>
                        <p class="card-description"> Liste des Entreprises </p>
                        <div class="table-responsive text-center">
                            <table class="table table-link table-borderless table-hover table-sm" id="table_etp">
                                <tbody>

                                    @foreach($entreprise as $etp)

                                    <tr>
                                        <td><img src="{{asset('images/entreprises/'.$etp->logo)}}" class="logo">
                                            <div id="etp_pdp_{{$etp->id}}" class="collapse">
                                                <hr>

                                                Activités: {{$etp->secteur_id}} <br>
                                                Téléphone: {{$etp->telephone_etp}} <br>
                                                Email: {{$etp->email_etp}}<br>
                                            </div>
                                        </td>
                                        <td class="py-1">{{$etp->nom_etp}}</td>
                                        <td>{{$etp->adresse}}</td>
                                        <td><a href="#" type="button" data-toggle="collapse" data-target="#etp_pdp_{{$etp->id}}"><i class="bx bxs-plus-circle actions" title="Details"></i></a></td>

                                        <td>
                                            @if ($etp->collaboration==0)
                                                <form action="{{ route('create_cfp_etp') }}" method="POST">
                                                    @csrf
                                                    <input name="etp_id" type="hidden" value="{{ $etp->id }}">
                                                    <input name="cfp_id" type="hidden" value="{{ $cfp_id }}">
                                                    <button type="submit" class="btn btn-primary" id="demande"><i class="bx bx-layer-plus actions" title="Collaborer"></i></button>
                                                </form>
                                            @else
                                                    <strong> <h5><i class="bx bx-user-check"></i></h5> </strong>
                                            @endif

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
            <div class="modal" id="etp" data-backdrop="static" data-keyboard="false" aria-labelledby="etpLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="logo" class="img-fluid image_etp">
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
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Demandes</h4>
                        <p class="card-description"> Liste des Demandes aux Formateurs</p>
                        <div class="table-responsive text-center">
                            <table class="table table-info table-borderless table-hover table-sm" id="table_dmd">
                                <tbody>
                                    @foreach($demmande_formateur as $demmande_forma)
                                        <tr>
                                        <td><a href="" data-toggle="collapse" data-target="#plus_{{$demmande_forma->id}}">
                                            <img src="{{asset('images/formateurs/'.$demmande_forma->photo_formateur)}}" class="logo"><br>
                                        </a>
                                            <div id="plus_{{$demmande_forma->id}}" class="collapse">
                                                <hr>
                                                Niveau d'étude: {{$demmande_forma->niveau_formateur}} <br>
                                                Spécialité: {{$demmande_forma->specialite_formateur}} <br>
                                                Téléphone: {{$demmande_forma->numero_formateur}} <br>
                                                Email: {{$demmande_forma->mail_formateur}}<br>
                                            </div>
                                        </td>

                                            <td class="py-1">{{$demmande_forma->nom_formateur.' '.$demmande_forma->prenom_formateur}}</td>
                                            <td>{{$demmande_forma->attente}}</td>
                                        <td>
                                            <a href="{{ route('delete_cfp_formateur',$demmande_forma->id)}}"><i class="bx bxs-x-circle actions btn-danger" title="Annuler"></i></a>
                                            <div id="modifier_{{$demmande_forma->id}}" class="collapse">
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Demandes</h4>
                        <p class="card-description"> Liste des Demandes aux Entreprises </p>
                        <div class="table-responsive text-center">
                            <table class="table table-info table-borderless table-hover table-sm" id="table_dmd">
                                <tbody>
                                    @foreach($demmande_etp as $demand)
                                        <tr>
                                        <td><a href="" data-toggle="collapse" data-target="#plus_{{$demand->id}}">
                                            <img src="{{asset('images/entreprises/'.$demand->logo_etp)}}" class="logo"><br>
                                        </a>
                                        <div id="plus_{{$demand->id}}" class="collapse">
                                            <hr>
                                            Activité: {{$demand->secteur_activite}} <br>
                                            Adresse: {{$demand->adresse_etp}} <br>
                                            Téléphone: {{$demand->telephone_etp}} <br>
                                            Email: {{$demand->email_etp}}<br>
                                        </div>

                                        </td>
                                            <td width = "200px">{{$demand->nom_etp}}</td>
                                            <td width = "200px">{{$demand->attente}}</td>
                                        <td>
                                            <a href="{{ route('delete_cfp_etp',$demand->id)}}"><i class="bx bxs-x-circle actions btn-danger" title="Annuler"></i></a>
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
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Invitations</h4>
                        <p class="card-description"> Liste des Invitations des Formateurs</p>
                        <div class="table-responsive text-center">
                            <table class="table table-danger table-borderless table-hover table-sm" id="table_invt">
                                <tbody>

                                    @foreach($invitation_formateur as $invit_forma)
                                        <tr>
                                        <td><a href="" data-toggle="collapse" data-target="#info_{{$invit_forma->id}}"><img src="{{asset('images/formateurs/'.$invit_forma->photo_formateur)}}" class="logo"></a>
                                            <div id="info_{{$invit_forma->id}}" class="collapse">
                                            <hr>
                                            Niveau d'étude: {{$invit_forma->niveau_formateur}} <br>
                                            Spécialité: {{$invit_forma->specialite_formateur}} <br>
                                            Téléphone: {{$invit_forma->numero_formateur}} <br>
                                            Email: {{$invit_forma->mail_formateur}}<br>
                                            </div>
                                        </td>
                                        <td width = "200px">{{$invit_forma->nom_formateur.' '.$invit_forma->prenom_formateur}}</td>
                                        <td>
                                            <a href="{{ route('accept_cfp_formateur',$invit_forma->id) }}">
                                                <i class="bx bxs-check-circle actions" title="Accepter"></i>
                                            </a>
                                            <a href="{{ route('annulation_cfp_formateur',$invit_forma->id) }}">
                                                <i class="bx bxs-x-circle actions" title="Refuser"></i>
                                            </a>
                                            <div id="modifier_{{$invit_forma->id}}" class="collapse">
                                        @csrf

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Invitations</h4>
                        <p class="card-description"> Liste des Invitations des Entreprises </p>
                        <div class="table-responsive text-center">
                            <table class="table table-danger table-borderless table-hover table-sm" id="table_invt">
                                <tbody>
                                    @foreach($invitation_etp as $invit)
                                        <tr>
                                        <td><a href="" data-toggle="collapse" data-target="#info_{{$invit->id}}"><img src="{{asset('images/entreprises/'.$invit->logo_etp)}}" class="logo"></a>
                                            <div id="info_{{$invit->id}}" class="collapse">
                                            @csrf
                                            <hr>
                                            Activité: {{$invit->secteur_activite}} <br>
                                            Adresse: {{$invit->adresse_etp}} <br>
                                            Téléphone: {{$invit->telephone_etp}} <br>
                                            Email: {{$invit->email_etp}}<br>
                                            </div>
                                        </td>
                                            <td width = "200px">{{$invit->nom_etp}}</td>
                                        <td>
                                            <a href="{{ route('accept_cfp_etp',$invit->id) }}" ><i class="bx bxs-check-circle actions" title="Accepter"></i></a>
                                            <a href="{{ route('annulation_cfp_etp', $invit->id) }}" ><i class="bx bxs-x-circle actions" title="Refuser"></i></a>
                                            <div id="modifier_{{$invit->id}}" class="collapse">
                                        </td>

                                    @endforeach

                                    {{-- <tr>
                                        <td class="py-1">1</td>
                                        <td>Vonjy</td>
                                        <td>Nomenjanahary</td>
                                        <td><a href="#"><i class="bx bxs-x-circle actions" title="Refuser"></i></a></td>
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
