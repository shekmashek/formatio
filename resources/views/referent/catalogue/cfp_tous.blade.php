@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<section class="annuaire mb-5">
    <div class="container g-0 p-0 recherche">
        <div class="row g-0 m-0 p-3">
            <div class="col-3 logo_formation text-center">
                <img src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="logo" class="img-fluid">
            </div>
            <div class="col-9">
                <form action="">
                    <div class="form-row d-flex">
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control input" required name="organisme" id="organisme">
                                <label for="organisme" class="form-control-placeholder"><i class="bx bx-search me-3"></i>Numerika Center</label>
                            </div>
                        </div>
                        <div class="col-3 text-center">
                            <div class="form-group">
                                <button type="submit" class="btn_submit">Rechercher</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div class="container my-5">
    <div class="row">
        <h4 class="text-center">Les Organismes de Formations près de chez vous</h4>
        <div class="col-4">
            <h6>Filtrer les resultats</h6>
            <div class="row">
                <p>Categories</p>
            </div>
        </div>
        <div class="col-8">

        </div>
    </div>
</div>
</section>
@endsection