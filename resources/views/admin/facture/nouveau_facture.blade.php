@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Nouvelle facture</p>
@endsection
@section('content')
<style>
    .bnt_new_fact {
        position: sticky;
        top: 5rem;
    }

</style>
{{-- <link rel="stylesheet" href="{{asset('css/facture.css')}}"> --}}

<link rel="stylesheet" href="{{asset('assets/css/facture_new.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div class="container-fluid mb-5">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
    @endif

    <div class="m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            {{-- <li></li> --}}
            <li class="nav-item">
                <a href="{{route('liste_facture')}}" class="nav-link">
                    Retour à la liste des factures
                </a>
            </li>
        </ul>

        <form action="{{route('create_facture')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <section class="section1 mb-4">
                    <div class="row">
                        <div class="col-6">
                            <h2>Nouvelle facture</h2>
                        </div>
                        <div class="col-6 text-end">
                            <input type="submit" class="btn btn_submit " id="enregristrer_facture" value="Enregistrer et continuer">
                        </div>
                    </div>
                </section>
                <section class="section2 mb-4">
                    <div class="row header_facture">
                        <h6 class="mb-0 changer_carret d-flex pt-2 justify-content-between" data-bs-toggle="collapse" href="#titre" aria-expanded="true" aria-controls="collapseprojet">
                            Adresse et coordonnées de l'entreprise, titre, résumé et logo
                            <i class="bx bx-caret-down carret-icon text-end"></i>
                        </h6>
                        <div class="col-12 collapse" id="titre">
                            <div class="row p-2">
                                <div class="col-4">
                                    <img src="{{asset('images/CFP/'.$cfp->logo)}}" alt="logo_cfp" class="img-fluid">
                                </div>
                                <div class="col-8 d-flex flex-column" align="right">
                                    <div>
                                        <select class="text-end titre_facture form-select  mb-2 m-0 " id="type_facture" name="type_facture" aria-label="Default select example" required>
                                            <option onselected hidden value="0"> Type de Facture...</option>
                                            @foreach ($type_facture as $tp_fact)
                                            <option value="{{$tp_fact->id}}">{{$tp_fact->reference}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <select class="text-end titre_facture form-select  mb-2 m-0 " id="id_mode_financement" name="id_mode_financement" aria-label="Default select example">
                                            <option onselected hidden value="0"> Mode de payement...</option>
                                            @foreach ($mode_payement as $mod)
                                            <option value="{{$mod->id}}">{{$mod->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <input type="hidden" name="description_facture" id="description_facture" class="text-end description_facture" placeholder="Déscription du facture"> --}}
                                    {{-- <br> --}}
                                    <div class="info_cfp">
                                        <p class="m-0 nom_cfp ">{{$cfp->nom}}</p>
                                        <p class="m-0 adresse_cfp">{{$cfp->adresse_lot." ".$cfp->adresse_quartier}}</p>
                                        <p class="m-0 adresse_cfp">{{$cfp->adresse_ville." ".$cfp->adresse_code_postal}}</p>
                                        <p class="m-0 adresse_cfp">{{$cfp->adresse_region}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section3">
                    <div class="row entreprise_facturer">
                        <div class="col-6 p-4">
                            <h6>Facturer à</h6>
                            <div class="form-group">
                                <select class="form-select selectP input_entreprise mb-2" id="entreprise_id" name="entreprise_id" aria-label="Default select example" required>
                                    <option onselected hidden> Ajouter l'entreprise à facturer...</option>
                                    @foreach ($entreprise as $tp)
                                    <option value="{{$tp->entreprise_id}}">{{$tp->nom_etp}}</option>
                                    @endforeach
                                </select>
                                @if ((count($entreprise))<=0)
                                <span style="color:#ff0000;"> vous ne pouvez pas faire la facturation si vous n'êtes collaboré avec aucun entreprise</span>

                                @endif
                                <div class="details">
                                    <p class="m-0 nom_cfp" id="nom_etp_detail"></p>
                                    <p class="m-0 " id="adresse_etp"></p>
                                    <p class="mt-3 m-0 " id="tel_etp"></p>
                                    <p class="m-0 " id="mail_etp"></p>
                                    <p class="m-0 " id="site_etp"></p>
                                    <p class="m-0 " id="info_légale_etp"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-4">
                            <div class="row mb-2">
                                <div class="col-12 d-flex flex-row justify-content-end">
                                    {{-- <p class="m-0 pt-3 text-end me-3">N° facture</p> <input type="text" autocomplete="off" placeholder="N° facture" class="form-control input_simple" name="num_facture" id="num_facture" required> --}}

                                    <p class="m-0 pt-3 text-end me-3">N° facture</p> <input type="text" autocomplete="off" placeholder="N°" class="text-end titre_facture form-select  mb-2 m-0 " name="num_facture" id="num_facture" required>
                                    @error('num_facture')
                                    <p> <span style="color:#ff0000;"> {{$message}} </span></p>
                                    @enderror
                                </div>
                                <p> <span style="color:#ff0000;" id="num_facture_err"></span></p>

                            </div>
                            <div class="row mb-2">
                                <div class="col-12 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">N° BC</p> <input type="text" autocomplete="off" class="text-end titre_facture form-select  mb-2 m-0 " name="reference_bc" id="reference_bc" required placeholder="bon de commande">
                                    @error('reference_bc')
                                    <p> <span style="color:#ff0000;"> {{$message}} </span></p>
                                    @enderror
                                </div>
                                <p> <span style="color:#ff0000;" id="reference_bc_err"></span></p>

                            </div>
                            <div class="row mb-2">
                                <div class="col-12 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">Date de facturation</p> <input type="date" class="text-end titre_facture form-select  mb-2 m-0 " name="invoice_date" id="invoice_date" required>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-12 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">Date de règlement</p> <input type="date" class="text-end titre_facture form-select  mb-2 m-0 " name="due_date" id="due_date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section4 mb-4">
                    <div class="row services_factures">
                        <div class="col-12 pb-4 element">
                            <div class="row titres_services">
                                <div class="col-2">
                                    <h6 class="m-0">Projet</h6>
                                </div>
                                <div class="col-3">
                                    <h6 class="m-0">Session</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0">Quantité</h6>
                                </div>
                                <div class="col-2">
                                    <h6 class="m-0">Unité</h6>
                                </div>
                                <div class="col-2">
                                    <h6 class="m-0">PU HT ({{$devise->devise}})</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0">Totale HT ({{$devise->devise}})</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0"></h6>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-2">
                                    <select class="form-select selectP input_section4 mb-2" id="projet_id" name="projet_id" aria-label="Default select example" required>
                                    </select>
                                    <span style="color:#ff0000;" id="projet_id_err">Aucun projet a été
                                        détecter</span>
                                </div>
                                <div class="col-3">
                                    <select class="form-select selectP input_section4 mb-2 session_id" id="session_id[]" name="session_id[]" aria-label="Default select example" required>
                                    </select>
                                    <span style="color:#ff0000;" id="session_id_err">Aucun session a été
                                        détecter</span>
                                </div>
                                <div class="col-1">
                                    <input type="number" name="qte[]" autocomplete="off" id="qte[]" min="1" value="1" class="form-control qte input_quantite qte[]" required>
                                </div>
                                <div class="col-2">
                                    <input type="text" name="description[]" autocomplete="off" id="description[]" placeholder=" ex: personne ou groupe ou etc" class="form-control qte input_quantite" required>
                                </div>
                                <div class="col-2">
                                    <input type="number" name="facture[]" autocomplete="off" min="0" id="facture[]" class="  form-control  qte input_quantite" required>
                                </div>
                                <div class="col-1 text-end">
                                    <p name="totale_facture[]" class="m-0 text_prix">0</p>
                                </div>
                                <div class="col-1 text-start pt-2">
                                </div>
                            </div>

                            <div class="row">
                                <div id="newRowMontant"></div>
                            </div>


                        </div>

                        <div class="">
                            <p><a href="#" id="addRowMontant" value="0"><i class='bx bx-plus-medical me-2'></i> Ajouter une autre session</a></p>
                        </div>

                        <div class="col-12 pb-4 element">
                            <div class="row  titres_services" style="display: none" id="titres_services_annexe">
                                <div class="col-3">
                                    <h6 class="m-0">Frais annexes</h6>
                                </div>
                                <div class="col-4">
                                    <h6 class="m-0">Descriptions</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0">Quantité</h6>
                                </div>
                                <div class="col-2">
                                    <h6 class="m-0">PU HT ({{$devise->devise}})</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0">Totale HT ({{$devise->devise}})</h6>
                                </div>
                                <div class="col-1 text-end">
                                    <h6 class="m-0"></h6>
                                </div>
                            </div>

                            <div id="newRow"></div>
                        </div>

                        <div class="">
                            <p> <a href="#" id="addRow" value="0"><i class='bx bx-plus-medical me-2'></i>Ajouter un ou des frais annexes(s)</a> </p>
                        </div>
                        <div class="row mb-1 g-0 p-2">

                            <div class="row mb-3">
                                <div class="col-8">
                                </div>
                                <div class="col-2">
                                    <p>Montant Brut HT</p>
                                </div>
                                <div class="col-2 text-end pe-2">
                                    <p id="totale_facture_ht">0</p>
                                </div>
                                {{-- <div class="col-1 text-end pt-2">
                                </div> --}}
                            </div>
                            <div class="row mb-3">
                                <div class="col-8 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">Remise</p> <input type="number" autocomplete="off" min="0" value="0" class="form-control input_tax" name="remise" id="remise">
                                    <select class="form-select selectP input_select text-end ms-2" id="type_remise_id" name="type_remise_id" aria-label="Default select example">
                                        @foreach ($type_remise as $re)
                                        <option value="{{$re->id}}" selected>{{$re->description}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-1 ">
                                </div>
                                <div class="col-1 ">
                                </div>
                                <div class="col-2 text-end pe-2">
                                    <p id="total_remise">0</p>
                                </div>
                                {{-- <div class="col-1">
                                </div> --}}
                            </div>
                        </div>

                        <div class="row  mb-1">
                            <div class="col-2">
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-1">
                            </div>
                            <div class="col-2">
                            </div>
                            <div class="col-2">
                                <span id="taxe_name" value="0"></span>
                            </div>
                            <div class="col-2 text-end">
                                <input type="hidden" id="taxe_value">
                                <p class="text-end" id="taxe"></p>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-2">
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-1">
                            </div>
                            <div class="col-2">
                            </div>
                            <div class="col-2">
                                <p> Net à payer TTC</p>
                            </div>
                            <div class="col-2 text-end pe-3">
                                <p id="totale_facture_ttc">0</p>
                            </div>
                            {{-- <div class="col-1 text-end pt-2">
                            </div> --}}
                        </div>

                        <hr>
                        <div class="row mb-2 g-0">
                            <div class="col-12 ">
                                <h6 class="note_titre ms-2"><span> Notes et autres rémarques</span></h6>
                                <textarea name="other_message" autocomplete="off" id="other_message" class="notes_texte" placeholder="'Vos commentaires ou descriptions'"></textarea>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section5 mb-4">
                    <div class="row header_facture">
                        <h6 class="mb-0 changer_carret2 d-flex pt-2 justify-content-between" data-bs-toggle="collapse" href="#titre" aria-expanded="true" aria-controls="collapseprojet">
                            Informations légales
                            <i class="bx bx-caret-down carret-icon text-end"></i>
                        </h6>
                        <div class="col-12 collapse" id="titre">
                            <div class="row p-2 justify-content-center text-center">
                                <p>NIF: {{$cfp->nif}}&nbsp;&nbsp; STAT: {{$cfp->stat}}&nbsp;&nbsp; RCS: {{$cfp->rcs}} &nbsp;&nbsp; CIF: {{$cfp->cif}}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>
</div>
{{-- <script src="{{asset('js/facture.js')}}"></script> --}}
@include("admin.facture.function_js.js_nouveau_facture")

@endsection
