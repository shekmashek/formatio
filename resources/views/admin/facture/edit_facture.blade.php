@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Modification facture</h3>
@endsection
@section('content')

<link rel="stylesheet" href="{{asset('assets/css/facture_new.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div class="container-fluid mb-5 mt-5">

    <div class="m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            {{-- <li></li> --}}
            <li class="nav-item">
                <a href="{{route('liste_facture')}}" class="nav-link">
                    Retour à la liste des factures
                </a>
            </li>
        </ul>

        <form action="{{route('modifier_facture',[$montant_totale->num_facture,$montant_totale->entreprise_id])}}" id="msform_facture" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <section class="section1 mb-4">
                    <div class="row">

                        <div class="col-6">
                            <h2>Modification facture</h2>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn_enregistrer " id="enregristrer_facture"> <i class="bx bx-check me-1"></i> Modifier</button>

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
                                        <select class="text-end titre_facture form-select  mb-2 m-0" id="type_facture" name="type_facture" aria-label="Default select example" required>
                                            <option value="{{$session[0]->type_facture_id}}">{{$session[0]->reference_facture}}</option>
                                            @foreach ($type_facture as $tp_fact)
                                            <option value="{{$tp_fact->id}}">{{$tp_fact->reference}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <select class="text-end titre_facture form-select mb-2 m-0" id="id_mode_financement" name="id_mode_financement" aria-label="Default select example" required>
                                            <option value="{{$session[0]->type_financement_id}}">{{$session[0]->description_financement}}</option>
                                            @foreach ($mode_payement as $mod)
                                            <option value="{{$mod->id}}">{{$mod->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <input type="text" value="{{$session[0]->description_facture}}" name="description_facture" id="description_facture" class="text-end description_facture" placeholder="Déscription du facture"> --}}
                                    <div class="info_cfp">
                                        <p class="m-0 nom_cfp">{{$cfp->nom}}</p>
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
                                <div class="details">
                                    <input type="number" value="{{$entreprise->id}}" name="entreprise_id" id="entreprise_id" hidden>
                                    <p class="m-0 nom_cfp" id="nom_etp_detail">{{$entreprise->nom_etp}}</p>
                                    <p class="m-0 " id="adresse_etp">
                                        {{$entreprise->adresse_rue}}&nbsp;
                                        {{$entreprise->adresse_quartier}} <br>
                                        {{$entreprise->adresse_ville}}&nbsp;
                                        {{$entreprise->adresse_code_postal}}<br>
                                        {{$entreprise->adresse_region}}

                                    </p>
                                    <p class="mt-3 m-0 " id="tel_etp">{{$entreprise->telephone_etp}}</p>
                                    <p class="m-0 " id="mail_etp">{{$entreprise->email_etp}}</p>
                                    <p class="m-0 " id="site_etp">{{$entreprise->site_etp}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-4">
                            <div class="row mb-2">
                                <div class="col-12 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">N° facture</p> <input type="text" value="{{$montant_totale->num_facture}}" class="text-end titre_facture   mb-2 m-0 " name="num_facture" required placeholder="reference du facture">
                                    @error('num_facture')
                                    <p> <span style="color:#ff0000;"> {{$message}} </span></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">N° BC</p> <input type="text" value="{{$session[0]->reference_bc}}" class="text-end titre_facture   mb-2 m-0 " name="reference_bc" id="reference_bc" required placeholder="reference du bon de commande">
                                    @error('reference_bc')
                                    <p> <span style="color:#ff0000;"> {{$message}} </span></p>
                                    @enderror
                                    <p> <span style="color:#ff0000;" id="reference_bc_err"></span></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">Date de facturation</p> <input type="date" value="{{$montant_totale->invoice_date}}" class="text-end titre_facture   mb-2 m-0 " name="invoice_date" id="invoice_date" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">Date de règlement</p> <input type="date" value="{{$montant_totale->due_date}}" class="text-end titre_facture   mb-2 m-0 " name="due_date" id="due_date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section4 mb-4">
                    <div class="row services_factures">
                        <div class="col-12 pb-4 ">
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
                                    <h6 class="m-0">PU HT ({{$devise->reference}})</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0">Total HT ({{$devise->reference}})</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0"></h6>
                                </div>
                            </div>
                            <div class="row my-2" id="inputFormRowMontant">
                                <div class="col-2">
                                    <select class="form-select selectP input_section4 mb-2" id="projet_id" name="projet_id" aria-label="Default select example" required>
                                        <option value="{{$projet->id}}">{{$projet->nom_projet}}</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select class="form-select selectP input_section4 mb-2 session_id" id="session_id[]" name="session_id[]" aria-label="Default select example" required>
                                        <option value="{{$session[0]->groupe_entreprise_id}}">{{$session[0]->nom_groupe}}</option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <input type="number" value="{{$session[0]->qte}}" name="qte[]" id="qte[]" min="1" value="1" class="form-control qte input_quantite" required>
                                </div>
                                <div class="col-2">
                                    <input type="text" name="description[]" value="{{$session[0]->description_facture}}" id="description[]" placeholder=" ex: personne ou groupe ou etc" class="form-control qte input_quantite" required>
                                </div>
                                <div class="col-2">
                                    <input type="number" value="{{$session[0]->pu}}" name="facture[]" min="0" value="0" id="facture[]" class=" somme_totale_montant facture form-control input_quantite2 montant_session_facture" required>
                                </div>
                                <div class="col-1  text-end pe-0">
                                    <p align="right" name="totale_facture[]" class="m-0 text_prix">{{number_format($session[0]->hors_taxe,0,","," ")}}</p>
                                </div>
                                <div class="col-1 text-start pt-2">
                                    <a href="{{route('delete_session_facture',[$montant_totale->num_facture,$session[0]->groupe_entreprise_id])}}"><button id="removeRowMontant" type="button" class="btn icon_suppre_frais"><i class="fa fa-trash"></i></button></a>
                                </div>
                            </div>

                            @if((count($session)-1)>0)
                            @for ($i=1;$i<count($session);$i+=1) <div class="row my-1" id="inputFormRowMontant">
                                <div class="col-2">
                                </div>
                                <div class="col-3">
                                    <select class="form-select selectP input_section4 mb-2 session_id" id="session_id[]" name="session_id[]" aria-label="Default select example" required>
                                        <option value="{{$session[$i]->groupe_entreprise_id}}">{{$session[$i]->nom_groupe}}</option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <input type="number" value="{{$session[$i]->qte}}" name="qte[]" id="qte[]" min="1" value="1" class="form-control qte input_quantite" required>
                                </div>
                                <div class="col-2">
                                    <input type="text" name="description[]" value="{{$session[$i]->description_facture}}" id="description[]" placeholder=" ex: personne ou groupe ou etc" class="form-control qte input_quantite" required>
                                </div>
                                <div class="col-2">
                                    <input type="number" value="{{$session[$i]->pu}}" name="facture[]" min="0" value="0" id="facture[]" class=" somme_totale_montant facture form-control input_quantite2 montant_session_facture" required>
                                </div>
                                <div class="col-1 text-end">
                                    <p align="right" name="totale_facture[]" class="m-0 text_prix">{{number_format($session[$i]->hors_taxe,0,","," ")}}</p>
                                </div>
                                <div class="col-1 text-end pt-2">
                                    <p class="m-0">
                                        <a href="{{route('delete_session_facture',[$montant_totale->num_facture,$session[$i]->groupe_entreprise_id])}}"> <button id="removeRowMontant" type="button" class="btn icon_suppre_frais"><i class="fa fa-trash"></i></button></a>
                                    </p>
                                </div>
                                @endfor
                                @endif

                                <div id="newRowMontant"></div>
                        </div>

                        <div class="">
                            <p><a href="#" id="addRowMontant" value="0"><i class='bx bx-plus-medical me-2'></i> Ajouter une autre session</a></p>
                        </div>

                        @if (count($frais_annexes)>0)
                        <div class="col-12 pb-4 ">

                            <div class="row  titres_services" " id=" titres_services_annexe">

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
                                    <h6 class="m-0">PU HT ({{$devise->reference}})</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0">Total HT ({{$devise->reference}})</h6>
                                </div>
                                <div class="col-1 text-end">
                                    <h6 class="m-0"></h6>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12 pb-4 ">

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
                                    <h6 class="m-0">PU HT ({{$devise->reference}})</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="m-0">Total HT ({{$devise->reference}})</h6>
                                </div>
                                <div class="col-1 text-end">
                                    <h6 class="m-0"></h6>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (count($frais_annexes)>0)

                        <div class="row my-1" id="inputFormRow">
                            <div class="col-3">
                                <select class="form-select selectP input_section4" id="frais_annexe_id[]" name="frais_annexe_id[]" required>
                                    @foreach ($frais_annexes as $frais)
                                    <option value="{{$frais->frais_annexe_id}}">{{$frais->frais_annexe_description}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <textarea name="description_annexe[]" id="description_annexe[]" class="text_description form-control" placeholder="déscription du frais annexe">{{$frais->frais_annexe_description}}</textarea>
                            </div>

                            <div class="col-1">
                                <input type="number" min="1" value="{{$frais->qte}}" required class="form-control input_quantite annexe_qte" name="qte_annexe[]" id="qte_annexe[]">
                            </div>

                            <div class="col-2">
                                <input type="number" min="0" value="{{$frais->pu}}" required name="montant_frais_annexe[]" class="somme_totale_montant form-control input_quantite2 frais_annexe" id="montant_frais_annexe[]" placeholder="0">
                            </div>

                            <div class="col-1 text-end">
                                <p align="right" name="totale_frais_annexe[]" class="text_prix">{{number_format($frais->hors_taxe,0,","," ")}}</p>
                            </div>

                            <div class="col-1 text-end pt-2">
                                <p class="m-0"> </p>
                                <a href="{{route('delete_frais_annexe_facture',[$montant_totale->num_facture,$frais->frais_annexe_id])}}"> <button type="button" class="btn icon_suppre_frais"><i class="fa fa-trash"></i></button></a></span>

                            </div>
                        </div>
                        @endif
                        {{-- </div> --}}
                        <div class="row my-1">
                            <div id="newRow"></div>
                        </div>
                        {{-- <div id="newRow" class="mx-0"></div> --}}

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
                                    <p align="right" id="totale_facture_ht"> {{number_format($montant_totale->montant_brut_ht,0,","," ")}}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-8 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">Remise</p> <input type="number" autocomplete="off" min="0" value="{{$montant_totale->valeur_remise}}" class="form-control input_tax" name="remise" id="remise">
                                    <select class="form-select selectP input_select text-end ms-2" id="type_remise_id" name="type_remise_id" aria-label=" select example">
                                        <option value="{{$montant_totale->remise_id}}" selected>{{$montant_totale->description_remise}}</option>
                                        @foreach ($type_remise as $re)
                                        <option value="{{$re->id}}">{{$re->description}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-1 ">
                                </div>
                                <div class="col-1 ">
                                </div>
                                <div class="col-2 text-end pe-2">
                                    <p align="right" id="total_remise"> {{number_format($montant_totale->remise,0,","," ")}}</p>
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
                                    <span id="taxe_name" value="0">{{$taxes->description." (".$taxes->pourcent." %)"}}</span>
                                </div>
                                <div class="col-2 text-end">
                                    <input type="hidden" id="taxe_value" value="{{$taxes->pourcent}}">
                                    <p align="right" class="text-end" id="taxe"> {{number_format($montant_totale->tva,0,","," ")}}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8">
                                </div>
                                <div class="col-2">
                                    <p> Net à payer TTC</p>
                                </div>
                                <div class="col-2 text-end pe-2">
                                    <p align="right" id="totale_facture_ttc">{{number_format($montant_totale->net_commercial,0,","," ")}}</p>
                                </div>
                            </div>
                        </div>


                        <hr>
                        <div class="row mb-2 g-0">
                            <div class="col-12 ">
                                <h6 class="note_titre ms-2"><span> Notes et autres rémarques</span></h6>
                                <textarea name="other_message" id="other_message" class="notes_texte" placeholder="'Vos commentaires ou descriptions'">
                                {{$montant_totale->other_message}}
                                </textarea>
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
    {{-- <script src="{{asset('js/facture.js')}}"></script> --}}

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('js/facture.js')}}"></script>
    <script type="text/javascript">
        function getCalcule() {
            var qte = document.getElementsByName("qte[]");
            var facture = document.getElementsByName("facture[]");
            var totale_facture = document.getElementsByName("totale_facture[]");
            var facture_new = document.getElementsByName("facture_new[]");
            var totale_facture_new = document.getElementsByName("totale_facture_new[]");
            var qte_new = document.getElementsByName("qte_new[]");

            var remise = document.getElementById("remise");
            var type_remise = document.getElementById("type_remise_id");
            var total_remise = document.getElementById("total_remise");
            var montant_frais_annexe = document.getElementsByName("montant_frais_annexe[]");
            var totale_frais_annexe = document.getElementsByName("totale_frais_annexe[]");
            var qte_annexe = document.getElementsByName("qte_annexe[]");

            var montant_frais_annexe_new = document.getElementsByName("montant_frais_annexe_new[]");
            var totale_frais_annexe_new = document.getElementsByName("totale_frais_annexe_new[]");
            var qte_annexe_new = document.getElementsByName("qte_annexe_new[]");
            var calc_re = 0;

            var totale_facture_ht = document.getElementById("totale_facture_ht");
            var totale_facture_ttc = document.getElementById("totale_facture_ttc");
            var taxe_value = document.getElementById("taxe_value");
            var taxe = document.getElementById("taxe");

            var calc_taxe = 0;
            var totale = 0;
            var totale_new = 0;
            var totale_annexe = 0;
            var totale_annexe_new = 0;
            var ensemble = 0;
            for (var i = 0; i < facture.length; i += 1) {
                var sum = facture[i].value * qte[i].value;
                totale_facture[i].innerHTML = sum;
                totale_facture[i].innerHTML = totale_facture[i].innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

                /*     totale_facture[i].innerHTML = number_format(sum, 0, ",", " "); */
                totale += sum;
            }

            for (var ii = 0; ii < facture_new.length; ii += 1) {
                var sum_new = facture_new[ii].value * qte_new[ii].value;
                totale_facture_new[ii].innerHTML = sum_new;
                totale_facture_new[ii].innerHTML = totale_facture_new[ii].innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

                /*     totale_facture[i].innerHTML = number_format(sum, 0, ",", " "); */
                totale += sum_new;
            }

            for (var j = 0; j < montant_frais_annexe.length; j += 1) {
                var sum_annexe = qte_annexe[j].value * montant_frais_annexe[j].value;
                totale_annexe += sum_annexe;
                totale_frais_annexe[j].innerHTML = sum_annexe;
                totale_frais_annexe[j].innerHTML = totale_frais_annexe[j].innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();
            }

            for (var jj = 0; jj < montant_frais_annexe_new.length; jj += 1) {
                var sum_annexe_new = qte_annexe_new[jj].value * montant_frais_annexe_new[jj].value;
                totale_annexe_new += sum_annexe_new;
                totale_frais_annexe_new[jj].innerHTML = sum_annexe_new;
                totale_frais_annexe_new[jj].innerHTML = totale_frais_annexe_new[jj].innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();
            }

            ensemble = totale + totale_annexe + totale_annexe_new;
            totale_facture_ht.innerHTML = ensemble;
            totale_facture_ht.innerHTML = totale_facture_ht.innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

            if (type_remise.value == 1) { // MGA
                calc_re = remise.value;
                total_remise.innerHTML = "-" + calc_re;
            }
            if (type_remise.value == 2) { // %
                calc_re = (ensemble * remise.value) / 100;
                total_remise.innerHTML = "-" + calc_re;
            }
            total_remise.innerHTML = total_remise.innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

            if (taxe_value.value > 0) {
                calc_taxe = (ensemble * taxe_value.value) / 100;
            }
            taxe.innerHTML = calc_taxe;
            taxe.innerHTML = taxe.innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

            //TTC = TAXE+MONTANT_total-remise
            totale_facture_ttc.innerHTML = (ensemble - calc_re + calc_taxe);
            totale_facture_ttc.innerHTML = totale_facture_ttc.innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

        }
        /*=========================================================*/
        $(document).ready(function() {
            // if ($("#addRowMontant").val() > 1) {
            //     $("#addRowMontant").css("display", "inline-block");
            // } else {
            //     $("#addRowMontant").css("display", "none");
            // }

            // if ($("#addRow").val() > 1) {
            //             $("#addRow").css("display", "inline-block");
            //         } else {
            //             $("#addRow").css("display", "none");
            //         }

            $(".changer_carret").on("click", function() {
                if (
                    $(this)
                    .find(".carret-icon")
                    .hasClass("bx-caret-down")
                ) {
                    $(this)
                        .find(".carret-icon")
                        .removeClass("bx-caret-down")
                        .addClass("bx-caret-up");
                } else {
                    $(this)
                        .find(".carret-icon")
                        .removeClass("bx-caret-up")
                        .addClass("bx-caret-down");
                }
            });

            $(".changer_carret2").on("click", function() {
                if (
                    $(this)
                    .find(".carret-icon")
                    .hasClass("bx-caret-down")
                ) {
                    $(this)
                        .find(".carret-icon")
                        .removeClass("bx-caret-down")
                        .addClass("bx-caret-up");
                } else {
                    $(this)
                        .find(".carret-icon")
                        .removeClass("bx-caret-up")
                        .addClass("bx-caret-down");
                }
            });


        });



        // ========= show facture existe déjà
        $(document).on('change', '#num_facture', function() {
            var num_facture = $(this).val();
            $.ajax({
                url: '{{route("verifyFacture")}}'
                , type: 'get'
                , data: {
                    num_facture: num_facture
                }
                , success: function(response) {
                    var userData = response;

                    if (userData.length > 0) {
                        document.getElementById("num_facture_err").innerHTML = "Numero Facture est déjà utiliser!";
                    } else {
                        document.getElementById("num_facture_err").innerHTML = "";
                    }

                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });

        // ========= show reference bon de commande existe déjà
        $(document).on('change', '#reference_bc', function() {
            var reference_bc = $(this).val();
            $.ajax({
                url: '{{route("verifyReferenceBC")}}'
                , type: 'get'
                , data: {
                    reference_bc: reference_bc
                }
                , success: function(response) {
                    var userData = response;
                    if (userData.length > 0) {
                        document.getElementById("reference_bc_err").innerHTML = "Reference Bon de commande est déjà utiliser!";
                    } else {
                        document.getElementById("reference_bc_err").innerHTML = "";
                    }

                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });


        // ======== show session
        $(document).on('change', '#projet_id', function() {
            $(".session_id").empty();

            var prj_id = $(this).val();
            var entreprise_id = $("#entreprise_id").val();
            $.ajax({
                url: "{{route('groupe_projet')}}"
                , type: 'get'
                , data: {
                    id: prj_id
                    , entreprise_id: entreprise_id
                }
                , success: function(response2) {
                    var userData2 = response2;
                    $("#addRowMontant").val(userData2.length);
                    if ($("#addRowMontant").val() > 1) {
                        $("#addRowMontant").css("display", "inline-block");
                    } else {
                        $("#addRowMontant").css("display", "none");
                    }
                    if (userData2.length > 0) {
                        for (var $i = 0; $i < userData2.length; $i++) {
                            $(".session_id").append('<option value="' + userData2[$i].groupe_entreprise_id + '">' + userData2[$i].nom_formation + '/ ' + userData2[$i].nom_module + '/ ' + userData2[$i].reference + "/ " + userData2[$i].nom_groupe + '</option>');
                        }
                        document.getElementById("session_id_err").innerHTML = "";
                    } else {
                        document.getElementById("session_id_err").innerHTML = "Aucun session a été détecter";
                    }
                }
            });

        });


        // add row
        $(document).on('click', '#addRow', function() {
            $('#frais').empty();
            $.ajax({
                url: "{{route('frais_annexe')}}"
                , type: 'get'
                , success: function(response) {
                    var userData = response;
                    $("#addRow").val(userData.length);
                    var total_frais_annexe_possible = ($(".row #inputFormRow").length + 1);

                    if ($("#addRow").val() > 1) {
                        $("#addRow").css("display", "inline-block");
                    } else {
                        $("#addRow").css("display", "none");
                    }
                    if (total_frais_annexe_possible < ($("#addRow").val() + 1)) {

                        $("#addRow").css("display", "inline-block");
                        /*     for (var $i = 0; $i < userData.length; $i++) {
                                 $("#frais").append('<option value="' + userData[$i].id + '">' + JSON.stringify(userData[$i].description) + '</option>');
                             }*/
                        var html = '';
                        html += '<div class="row justify-content" id="inputFormRow">';
                        html += '<div class="col-3">';
                        html += '<select class="form-select selectP input_section4"  id="frais_annexe_id_new[]" name="frais_annexe_id_new[]" required>';

                        for (var $i = 0; $i < userData.length; $i++) {
                            html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                        }
                        html += '</select>';
                        html += '</div>';

                        html += '<div class="col-4">';
                        html += '  <textarea name="description_annexe_new[]" id="description_annexe_new[]" class="text_description form-control" placeholder="déscription du frais annexe"></textarea>';
                        html += '</div>';

                        html += '<div class="col-1">';
                        html += '<input type="number" min="1" value="1" required class="form-control input_quantite annexe_qte" name="qte_annexe_new[]" id="qte_annexe_new[]">';
                        html += '</div>';

                        html += '<div class="col-2">';
                        html += '<input type="number" min="0" value="0" required name="montant_frais_annexe_new[]" class="somme_totale_montant form-control input_quantite2 frais_annexe" id="montant_frais_annexe_new[]" placeholder="0">';
                        html += '</div>';

                        html += '<div class="col-1 text-end">';
                        html += '<p name="totale_frais_annexe_new[]" class="text_prix" align="right">0</p>';
                        html += '</div>';

                        html += '<div class="col-1 text-end pt-2">';
                        html += '<p class="m-0"><span>';
                        html += '<button id="removeRow" type="button" class="btn icon_suppre_frais"><i class="fa fa-trash"></i></button></span>';
                        html += '</div>';
                        html += '</div><br>';

                        $('#newRow').append(html);

                        if (total_frais_annexe_possible >= ($("#addRow").val())) {
                            $("#addRow").css("display", "none");
                        }
                    } else {
                        $("#addRow").css("display", "none");

                    }

                }
                , error: function(error) {
                    console.log(error);
                }
            });

        });

        // remove row
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
            var total_frais_annexe_possible = ($(".row #inputFormRow").length + 1);
            if (total_frais_annexe_possible < ($("#addRow").val() + 1)) {
                $("#addRow").css("display", "inline-block");
            }
            getCalcule();
        });


        // ============================ Montant=========================

        $(document).on('click', '#addRowMontant', function() {
            $('#montant').empty();
            var id = $("#projet_id").val();
            var etp_id = $("#entreprise_id").val();

            var total_session_possible = ($(".row #inputFormRowMontant").length);
            var totale_session = @php echo(count($init_session) - 1) @endphp;

            if (total_session_possible < (totale_session)) {
                $("#addRowMontant").css("display", "inline-block");
                $.ajax({
                    url: "{{route('groupe_projet_edit')}}"
                    , type: 'get'
                    , data: {
                        num_facture: "@php echo $montant_totale->num_facture  @endphp"
                        , id: id
                        , entreprise_id: etp_id
                    }
                    , success: function(response) {
                        var userData = response;
                        var html = '';
                        html += '<div class="row" id="inputFormRowMontant">';
                        html += '<div class="col-2">';
                        html += '</div>';
                        html += '<div class="col-3">';
                        html += '<select class="form-select selectP input_section4"  id="session_id_new[]" name="session_id_new[]" required>';

                        for (var $i = 0; $i < userData.length; $i++) {
                            html += '<option value="' + userData[$i].groupe_entreprise_id + '">' + userData[$i].nom_formation + '/ ' + userData[$i].nom_module + '/ ' + userData[$i].reference + '/ ' + userData[$i].nom_groupe + '</option>';
                        }
                        html += '</select>';
                        html += '</div>';
                        html += '<div class="col-1">';
                        html += '<input type="number" min="1" value="1" required class="form-control input_quantite" name="qte_new[]" id="qte_new[]">';
                        html += '</div>';
                        html += '<div class="col-2">';
                        html += '<input type="text" name="description_new[]" id="description_new[]" placeholder=" ex: personne ou groupe ou etc" class="form-control qte input_quantite" required>';
                        html += '</div>';
                        html += '<div class="col-2">';
                        html += '<input type="number" min="0" value="0" required name="facture_new[]" class="somme_totale_montant form-control input_quantite2 montant_session_facture" id="facture_new[]" placeholder="0">';
                        html += '</div>';
                        html += '<div class="col-1 text-end">';
                        html += '<p name="totale_facture_new[]" class="text_prix" align="right">0</p>';
                        html += '</div>';

                        html += '<div class="col-1 text-start pt-2">';
                        html += '<button id="removeRowMontant" type="button" class="btn icon_suppre_frais "><i class="fa fa-trash suppre_frais"></i></button></p>';
                        html += '</div>';
                        html += '</div><br>';

                        $('#newRowMontant').append(html);
                    }
                    , error: function(error) {
                        console.log(error);
                    }
                });

                if (total_session_possible + 1 >= (totale_session)) {
                    $("#addRowMontant").css("display", "none");
                }
            } else {
                $("#addRowMontant").css("display", "none");
            }

        });

        // remove row
        $(document).on('click', '#removeRowMontant', function() {
            $(this).closest('#inputFormRowMontant').remove();
            var total_session_possible = ($(".row #inputFormRowMontant").length);
            var totale_session = @php echo count($init_session) @endphp;

            if (total_session_possible < totale_session) {
                $("#addRowMontant").css("display", "inline-block");
            } else {
                $("#addRowMontant").css("display", "none");
            }
            getCalcule();
        });



        $(document).on("keyup change", ".services_factures", function() {
            getCalcule();
        });

    </script>
    @endsection
