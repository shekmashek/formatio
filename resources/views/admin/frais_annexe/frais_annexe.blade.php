@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Frais annexes</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<div class="container" role="tabpanel">
    <ul class="nav nav-tabs navigation_frais mt-4" id="myTab" role="tablist">
        <li class="nav-item active" role="presentation">
        <a href="#liste_salle" class="nav-link active" id="home-tab" data-toggle="tab" type="button" role="tab" aria-controls="home" aria-selected="true" style="color: black">Frais annexes&nbsp;&nbsp;{{ count($frais) }}</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#ajout_salle" class="nav-link" id="profile-tab" data-toggle="tab" type="button" role="tab" aria-controls="profile" aria-selected="false" style="color: black">Ajouter une frais annexe</a>
        </li>
    </ul>
    <div class="tab-content"  id="myTabContent">
        <div class="tab-pane fade show active" id="liste_salle" role="tabpanel" aria-labelledby="home-tab">
            @if (Session::has('frais_error'))
                <div class="alert alert-danger ms-1 me-1">
                    <ul class="p-0">
                        <li>{!! Session::get('frais_error') !!}</li>
                    </ul>
                </div>
            @endif
            <table class="table table-hover table-borderless">
                <thead style="border-bottom: 1px solid black; line-height: 20px">
                    <tr>
                        <td>Frais annexes système</td>
                      </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Frais de déplacement</td>
                    </tr>
                    <tr>
                        <td>Hébergement</td>
                    </tr>
                    <tr>
                        <td>Restauration</td>
                    </tr>
                    <tr>
                        <td>Location salle</td>
                    </tr>
                    <tr>
                        <td>Location matérielle</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-hover table-borderless">
                <thead style="border-bottom: 1px solid black; line-height: 20px">
                  <tr>
                    <td>Vos frais annexes&nbsp;&nbsp;{{ count($frais) }}</td>
                    <th rowspan="2"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($frais as $fr)
                        <tr>
                            <td>{{ $fr->description }}</td>
                            <td><a href="" aria-current="page" data-bs-toggle="modal" data-bs-target="#modal_modifier_frais_{{ $fr->id }}"><i style="font-size: 1rem !important" class="bx bxs-edit-alt bx_modifier"></i></a></td>
                            <td><a href="{{ route('supprimer_frais',[$fr->id]) }}"><i class="bx bx-trash bx_supprimer" style="font-size: 1rem !important"></i></a></td>
                        </tr>
                        <div class="modal fade"
                            id="modal_modifier_frais_{{ $fr->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content p-3">
                                    <div class="modal-title pt-3 mb-2 d-flex justify-content-between"
                                        style="height: 50px; align-items: center;">
                                        <h5 class="modal-title">Modification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('modifier_frais',[$fr->id]) }}" method="POST">
                                        @csrf
                                        <div class="d-flex justify-content-around">
                                            <span class="me-3 mt-1">Description</span>
                                            <input class="form-control" name="description" id="exampleDataList" value="{{ $fr->description }}">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn_enregistrer mt-2">Modifier</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="tab-pane fade show" id="ajout_salle" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container mt-1">
                <div class="row">
                    <div class="col-md-6">
                        @if (Session::has('frais_error'))
                            <div class="alert alert-danger ms-2 me-2">
                                <ul>
                                    <li>{!! Session::get('frais_error') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('enregistrer_frais_annexe') }}" method="POST">
                            @csrf
                            <label for="exampleDataList" class="form-label">Description</label>
                            <input class="form-control mb-3" name="description" id="exampleDataList" placeholder="Description...">
                            <button type="submit" class="btn btn_enregistrer mt-3">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('activeTab', lien);
        ($('.nav_list a[href="' + Tabactive + '"]').closest('a')).addClass('active');
        ($('a[href="' + Tabactive + '"]').closest('div')).addClass('active');
    });
    let activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
</script>
<style>
.navigation_frais .nav-link {
    color: #637381;
    padding: 5px;
    cursor: pointer;
    font-size: 0.900rem;
    transition: all 200ms;
    margin-right: 1rem;
    padding-top: 10px;
    border: none;
}

.nav-item.active .nav-link {
    border-bottom: 3px solid #7635dc !important;
    border: none;
    color: #7635dc
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
@endsection