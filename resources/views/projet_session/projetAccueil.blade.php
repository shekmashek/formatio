@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projets.css')}}">
<div class="container pt-5">
    <div class="row card_projets">
        <h3 class="text-center mt-5 mb-5">Formation continue : former en inter et en intra</h3>
        <div class="col-6 ">
            <a href="{{route('nouveau_groupe',['type_formation'=>1])}}">
                <div class="row projets_card me-2">
                    <div class="col-3 text-center">
                        <i class='bx bx-customize projets_icon'></i>
                    </div>
                    <div class="col-9">
                        <h5>Creer un projet en intra</h5>
                        <p>
                            Découvrez toutes nos formations en présentiel et à distance, en inter, intra
                            packagées, en entreprise, diplômantes, éligibles au CPF et les cycles avec
                            certification.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6  ">
            <a href="{{route('nouveau_groupe_inter',['type_formation'=>2])}}">
                <div class="row projets_card2 ms-2">
                    <div class="col-3">
                        <i class='bx bxs-customize projets_icon'></i>
                    </div>
                    <div class="col-9">
                        <h5>Creer un projet en inter</h5>
                        <p>
                            Découvrez toutes nos formations en présentiel et à distance, en inter, intra
                            packagées, en entreprise, diplômantes, éligibles au CPF et les cycles avec
                            certification.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row mt-5 card_projets">
        <div class="col-6 ">
            <a href="{{route('liste_projet',['type_formation'=>1])}}">
                <div class="row projets_card3 me-2">
                    <div class="col-3 text-center">
                        <i class='bx bxs-grid-alt projets_icon'></i>
                    </div>
                    <div class="col-9">
                        <h5>Session pour un projet en intra</h5>
                        <p>
                            Découvrez toutes nos formations en présentiel et à distance, en inter, intra
                            packagées, en entreprise, diplômantes, éligibles au CPF et les cycles avec
                            certification.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6  ">
            <a href="{{route('liste_projet',['type_formation'=>2])}}">
                <div class="row projets_card4 ms-2">
                    <div class="col-3">
                        <i class='bx bx-grid-alt projets_icon'></i>
                    </div>
                    <div class="col-9">
                        <h5>Session pour un projet en inter</h5>
                        <p>
                            Découvrez toutes nos formations en présentiel et à distance, en inter, intra
                            packagées, en entreprise, diplômantes, éligibles au CPF et les cycles avec
                            certification.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection