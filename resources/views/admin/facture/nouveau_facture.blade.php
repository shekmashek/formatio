@extends('./layouts/admin')
@section('content')
{{--
<link rel="stylesheet" href="{{asset('css/facture.css')}}"> --}}
<link rel="stylesheet" href="{{asset('assets/css/facture_new.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div class="container mb-5">
    <form action="{{route('create_facture')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <section class="section1 mb-4">
                <div class="row">
                    <div class="col-6">
                        Nouvelle facture
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
                    <div class="col-12" id="titre">
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
                                <option onselected hidden> Ajouter l'entreprise <i class='bx bxs-user-plus'></i> à facturer... <i class='bx bxs-user-plus'></i></option>
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
                                <p class="m-0 pt-3 text-end me-3">Nombre de facture</p> <input type="text" class="form-control input_simple" name="num_facture" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Nombre de bon de commande</p> <input type="number" class="form-control input_simple" name="num_facture">
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
            <section class="section4">
                <div class="row">
                    <div class="col-12">
                        <div class="row titres_services">
                            <div class="col-6">
                                <h6 class="m-0">Services</h6>
                            </div>
                            <div class="col-2"><h6 class="m-0">Quantité</h6></div>
                            <div class="col-2"><h6 class="m-0">Prix Unitaire</h6></div>
                            <div class="col-2"><h6 class="m-0">Montant</h6></div>
                        </div>
                        <div class="row">

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