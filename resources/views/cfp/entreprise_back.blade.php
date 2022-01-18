@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{ asset('design_entreprise/index.css') }}">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<div class="d-flex justify-content-between pt-3">
    <h5 class="mx-5">Entreprise</h5>

    <div>
        <i class="fa fa-search"></i>
        <input type="search" class="recherche" id="categorie_search" name="categorie" placeholder="Rechercher entreprise">
    </div>
</div>
<hr>
<a href="{{ route('collaboration')}}">
        <button class="btn btn-success mb-2 payement"><i class="fa fa-plus"></i> collaborer</button></a>


@canany(['isCFP'])
{{-- corps --}}

@foreach($datas as $etp)
<div class="card rounded-3 pe-3 ps-3">
    <div class="row pt-3">
        <div class="col-md-2">
            <img class="img-fluid" src="{{ asset('images/entreprises/'.$etp->logo_etp) }}">
        </div>
        <div class="col-md-4 pt-2">
            <h5 class="nom_entreprise"><b>{{$etp->nom_etp}}</b></h5>
            <p class="adresse">
                {{$etp->adresse}}
        </div>
        <div class="col-md-3 pt-2">
            <small><b>Secteur d'activités</b></small>
            <p class="adresse">{{$etp->nom_secteur}}</p>
        </div>
        <div class="col-md-3 pt-2">
            <small class="d-flex justify-content-between">
                <b>Contact</b>
                <a href="{{route('profile_entreprise',$etp->entreprise_id)}}" class="voir mx-4" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i></a>
            </small>

            <p class="adresse">{{$etp->telephone_etp}}</p>
            <small><b>E-mail</b></small>
            <p class="adresse">{{$etp->email_etp}}</p>
        </div>

    </div>


    {{-- dropdown collapse --}}
    <div data-toggle="collapse" class="bg-light d-flex justify-content-between mx-2 my-2 rounded-3 pt-3" href="#collapseExample_{{ $etp->entreprise_id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
        <p class="px-2"><b>
                <font color="blue"><u>Informations légales</u></font>
            </b></p>
        <i class="fa fa-chevron-down px-3"></i>
    </div>
    <div class="collapse" id="collapseExample_{{ $etp->entreprise_id }}">
        <div class="d-flex justify-content-between mx-5">
            <div>
                <small><b>NIF</b></small>
                <P class="adresse">{{$etp->nif_etp}}</P>
            </div>
            <div>
                <small><b>STAT</b></small>
                <P class="adresse">{{$etp->stat_etp}}</P>
            </div>
            <div>
                <small><b>RCS</b></small>
                <P class="adresse">{{$etp->rcs_etp}}</P>
            </div>
            <div>
                <small><b>CIF</b></small>
                <P class="adresse">{{$etp->cif_etp}}</P>
            </div>

        </div>
    </div>

</div>
@endforeach
<br><br><br>

@endcanany






@canany(['isSuperAdmin','isAdmin'])
{{-- corps --}}
@foreach($datas as $etp)
<div class="card rounded-3 pe-3 ps-3">
    <div class="row pt-3">
        <div class="col-md-2">
            <img class="img-fluid" src="{{ asset('images/entreprises/'.$etp->logo) }}">
        </div>
        <div class="col-md-4 pt-2">
            <h5 class="nom_entreprise"><b>{{$etp->nom_etp}}</b></h5>
            <p class="adresse">
                {{$etp->adresse}}
        </div>
        <div class="col-md-3 pt-2">
            <small><b>Secteur d'activités</b></small>
            <p class="adresse">{{$etp->secteur->nom_secteur}}</p>
        </div>
        <div class="col-md-3 pt-2">
            <small class="d-flex justify-content-between">
                <b>Contact</b>
                <a href="{{route('profile_entreprise',$etp)}}" class="voir mx-4" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i></a>
            </small>
            <p class="adresse">{{$etp->telephone_etp}}</p>
            <small><b>E-mail</b></small>
            <p class="adresse">{{$etp->email_etp}}</p>

        </div>

    </div>

    {{-- dropdown collapse --}}
    <div data-toggle="collapse" class="bg-light d-flex justify-content-between mx-2 my-2 rounded-3 pt-3" href="#collapseExample_{{ $etp->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
        <p class="px-2"><b>
                <font color="blue"><u>Informations légales</u></font>
            </b></p>
        <i class="fa fa-chevron-down px-3"></i>
    </div>
    <div class="collapse" id="collapseExample_{{ $etp->id }}">
        <div class="d-flex justify-content-between mx-5">
            <div>
                <small><b>NIF</b></small>
                <P class="adresse">{{$etp->nif}}</P>
            </div>
            <div>
                <small><b>STAT</b></small>
                <P class="adresse">{{$etp->stat}}</P>
            </div>
            <div>
                <small><b>RCS</b></small>
                <P class="adresse">{{$etp->rcs}}</P>
            </div>
            <div>
                <small><b>CIF</b></small>
                <P class="adresse">{{$etp->cif}}</P>
            </div>

        </div>
    </div>

</div>
@endforeach
<br><br><br>

@endcanany

<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $("#categorie_search").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('searchCategorie')}}"
                    , type: 'get'
                    , dataType: "json"
                    , data: {
                        //    _token: CSRF_TOKEN,
                        recheche: request.term
                    }
                    , success: function(data) {
                        // alert("eto");
                        response(data);
                    }
                    , error: function(data) {
                        alert("error");
                        //alert(JSON.stringify(data));
                    }
                });
            }
            , select: function(event, ui) {
                // Set selection
                $('#categorie_search').val(ui.item.label); // display the selected text
                $('#stagiaireid').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });

</script>

@endsection
