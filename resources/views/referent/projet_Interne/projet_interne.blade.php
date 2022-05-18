@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Formation interne</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projetInterne.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<div class="container-fluid">
{{-- <div role="tabpanel">
  <ul class="nav nav-tabs" role="tablist" id="myTab">
    <li class="active"><a id="tab1" href="#chart1" role="tab" data-toggle="tab">Tab 1</a></li>
    <li><a id="tab2" href="#chart2" role="tab" data-toggle="tab">Tab 2</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="chart1">Tab 1 Content</div>
    <div class="tab-pane" id="chart2">Tabe 2 Content</div>
  </div>
</div> --}}

    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i
            class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
    <div class="col-12 mt-2" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_interne" id="myTab">
            <li class="nav-item active">
                <a href="#formations" class="nav-link active me-5" data-toggle="tab">Formations Internes</a>
            </li>
            <li class="nav-item">
                <a href="#formateurs" class="nav-link me-5" data-toggle="tab">Formateurs Internes</a>
            </li>
            <li class="nav-item">
                <a href="#projets" class="nav-link me-5" data-toggle="tab">Projets Internes</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="formations">
                <div class="col-4 px-4">
                    <div class="projet_interne p1">
                        <a href="{{route('formations')}}">
                            <span><i class='bx bxs-grid-alt'></i></span>
                            <p class="mt-3">Formations</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="tab-pane show fade" id="formateurs">
                <div class="col-4 px-4">
                    <div class="projet_interne p2">
                        <a href="{{route('formateurs')}}">
                            <span><i class='bx bxs-user'></i></span>
                            <p class="mt-3">Formateurs</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="tab-pane show fade" id="projets">
                <div class="col-4 px-4">
                    <div class="projet_interne p3">
                        <a href="{{route('projets')}}">
                            <span><i class='bx bx-unite'></i></span>
                            <p class="mt-3">Projets</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filtrer mt-3">
        <div class="row">
            <div class="col-10">
                <p class="m-0">Filter vos Formations Internes</p>
            </div>
            <div class="col-2 text-end">
                <i class="bx bx-x" role="button" onclick="afficherFiltre();"></i>
            </div>
            <hr class="mt-2">
        </div>
    </div>
</div>
<script>
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('activeTab', lien);
    });
    let activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
</script>
@endsection