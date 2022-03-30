@extends('./layouts/admin')
@section('content')
{{--<link rel="stylesheet" href="{{asset('css/facture.css')}}"> --}}
{{-- https://www.youtube.com/watch?v=RBeqKYsw7CQ  link template facture videos youtube --}}
<link rel="stylesheet" href="{{asset('assets/css/facture_new.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div class="container mb-5 mt-5">
    <form action="{{route('create_facture')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <section class="section1 mb-4">
                <div class="row">
                    <div class="col-6">
                        <h2>Nouvelle facture</h2>
                    </div>
                    <div class="col-6 text-end">
                        <input type="submit" class="btn btn_submit" value="Enregistrer et continuer">
                    </div>
                </div>
            </section>
            <section class="section2 mb-4">
                <div class="row header_facture">
                    <h6 class="mb-0 changer_carret d-flex pt-2 justify-content-between" data-bs-toggle="collapse"
                        href="#titre" aria-expanded="true" aria-controls="collapseprojet">
                        Adresse et coordonnées de l'entreprise, titre, résumé et logo
                        <i class="bx bx-caret-down carret-icon text-end"></i>
                    </h6>
                    <div class="col-12 collapse" id="titre" >
                        <div class="row p-2">
                            <div class="col-4">
                                <img src="{{asset('img/logo_numerika/logonmrk.png')}}" alt="logo_cfp" class="img-fluid">
                            </div>
                            <div class="col-8 text-end">
                                <input type="text" name="" id="" class="text-end titre_facture" placeholder="titre facture" required>
                                <input type="text" name="" id="" class="text-end description_facture" placeholder="Déscription du facture">
                                <div class="info_cfp">
                                    <p class="m-0 nom_cfp">Numerika</p>
                                    <p class="m-0 adresse_cfp">adresse</p>
                                    <p class="m-0 adresse_cfp">adresse</p>
                                    <p class="m-0 adresse_cfp">adresse</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section3">
                <div class="row entreprise_facturer">
                    <div class="col-6 p-4">
                        <h6>Facturer</h6>
                        <div class="form-group">
                            <select class="form-select selectP input_entreprise mb-2" id="entreprise_id" name="entreprise_id" aria-label="Default select example" required>
                                <option onselected hidden> Ajouter l'entreprise à facturer...</option>
                                @foreach ($entreprise as $tp)
                                <option value="{{$tp->id}}">{{$tp->nom_etp}}</option>
                                @endforeach
                            </select>
                            <div class="details">
                                @foreach ($entreprise as $tp)
                                @if($tp->nom_etp)
                                <p class="m-0 nom_etp">{{$tp->nom_etp}}</p>
                                <p class="m-0 adresse_cfp">{{$tp->adresse_rue}}&nbsp;{{$tp->adresse_quartier}} <br> {{$tp->adresse_ville}}&nbsp;{{$tp->adresse_code_postal}} <br> {{$tp->adresse_region}}</p>
                                <p class="mt-3 m-0 adresse_cfp">{{$tp->telephone_etp}}</p>
                                <p class="m-0 adresse_cfp">{{$tp->email_etp}}</p>
                                <p class="m-0 adresse_cfp">{{$tp->site_etp}}</p>
                                @endif

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-4">
                        <div class="row mb-2">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Numéro de facture</p> <input type="text" class="form-control input_simple" name="num_facture" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Reference de bon de commande</p> <input type="number" class="form-control input_simple" name="num_facture">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Date de facturation</p> <input type="date" class="form-control input_simple" name="num_facture" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Payement du</p> <input type="date" class="form-control input_simple" name="num_facture" required>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section4 mb-4">
                <div class="row services_factures">
                    <div class="col-12 pb-4 element">
                        <div class="row titres_services">
                            <div class="col-3">
                                <h6 class="m-0">Projets</h6>
                            </div>
                            <div class="col-3">
                                <h6 class="m-0">Session</h6>
                            </div>
                            <div class="col-1 text-end"><h6 class="m-0">Quantité</h6></div>
                            <div class="col-2"><h6 class="m-0">Prix Unitaire</h6></div>
                            <div class="col-3 text-end"><h6 class="m-0">Montant</h6></div>
                        </div>
                        <div class="row my-3">
                            <div class="col-3">
                                <select class="form-select selectP input_section4 mb-2" id="" name="" aria-label="Default select example" required>
                                    <option onselected hidden>Projet à facturer...</option>
                                    @foreach ($entreprise as $tp)
                                    <option value="{{$tp->id}}">{{$tp->nom_etp}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select class="form-select selectP input_section4 mb-2" id="" name="" aria-label="Default select example" required>
                                    <option onselected hidden>Session à facturer...</option>
                                    @foreach ($entreprise as $tp)
                                    <option value="{{$tp->id}}">{{$tp->nom_etp}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <input type="number" name="" id="" class="form-control input_quantite">
                            </div>
                            <div class="col-2">
                                <input type="number" name="" id="" class="form-control input_quantite2">
                            </div>
                            <div class="col-3 text-end pt-2">
                                <p class="m-0"><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-9 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Taxe</p> <input type="number" class="form-control input_tax" name="num_facture" required>
                            </div>
                            <div class="col-3 text-end">
                                <p class="m-0 pt-2"><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-9 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">TVA</p> <input type="number" class="form-control input_tax" name="num_facture">
                            </div>
                            <div class="col-3 text-end">
                                <p class="m-0 pt-2"><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row nouveau_service g-0">
                        <div class="col-12 py-2 text-center">
                            <span><i class='bx bx-plus-circle me-2'></i>Ajouter un élément</span>
                        </div>
                    </div>
                    <div class="col-12 pb-4 element">
                        <div class="row titres_services">
                            <div class="col-3">
                                <h6 class="m-0">Frais annexes</h6>
                            </div>
                            <div class="col-3">
                                <h6 class="m-0">Déscriptions</h6>
                            </div>
                            <div class="col-1 text-end"><h6 class="m-0">Quantité</h6></div>
                            <div class="col-2"><h6 class="m-0">Prix Unitaire</h6></div>
                            <div class="col-3 text-end"><h6 class="m-0">Montant</h6></div>
                        </div>
                        <div class="row my-3">
                            <div class="col-3">
                                <input type="text" name="" id="" class="form-control input_quantite" placeholder="Titre frais annexe">
                            </div>
                            <div class="col-3">
                                <textarea name="" id="" class="text_description form-control" placeholder="déscription du frais annexe"></textarea>
                            </div>
                            <div class="col-1">
                                <input type="number" name="" id="" class="form-control input_quantite">
                            </div>
                            <div class="col-2">
                                <input type="number" name="" id="" class="form-control input_quantite2">
                            </div>
                            <div class="col-3 text-end pt-2">
                                <p class="m-0"><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row nouveau_service g-0">
                        <div class="col-12 py-2 text-center">
                            <span><i class='bx bx-plus-circle me-2'></i>Ajouter un frais</span>
                        </div>
                    </div>
                    <div class="row mb-2 g-0 p-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 text-end pt-1"> Montant total</p>
                        </div>
                        <div class="col-3 text-end">
                            <p><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                        </div>
                    </div>
                    <div class="row mb-2 g-0 p-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 pt-3 text-end me-3">Remise</p> <input type="number" class="form-control input_tax" name="num_facture" required><select class="form-select selectP input_select text-end ms-2" id="" name="" aria-label="Default select example" required>
                                <option value="MGA"selected>MGA</option>
                                <option value="%">%</option>
                            </select>
                        </div>
                        <div class="col-3 text-end">
                            <p><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                        </div>
                    </div>
                    <div class="row mb-2 g-0 p-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 text-end total">Total</p>
                        </div>
                        <div class="col-3 text-end">
                            <p class="pt-1 me-3"><span class="total">500 000</span>&nbsp;MGA</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2 g-0">
                        <div class="col-12 ">
                            <h6 class="note_titre ms-2">Notes et autres rémarques</h6>
                            <textarea name="" id="" class="notes_texte"></textarea>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section5 mb-4">
                <div class="row header_facture">
                    <h6 class="mb-0 changer_carret d-flex pt-2 justify-content-between" data-bs-toggle="collapse"
                        href="#titre" aria-expanded="true" aria-controls="collapseprojet">
                        Informations légales
                        <i class="bx bx-caret-down carret-icon text-end"></i>
                    </h6>
                    <div class="col-12 collapse" id="titre" >
                        <div class="row p-2">

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>
{{-- <script src="{{asset('js/facture.js')}}"></script> --}}
<script>
$(document).ready(function() {
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
});
</script>
@endsection