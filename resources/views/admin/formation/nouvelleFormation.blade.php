@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Nouvelle formation</h3>
@endsection
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
@section('content')
<nav class="navbar navbar-expand-lg w-100">
    <div class="row w-100 g-0 m-0">
        <div class="col-lg-12">
            <div class="row g-0 m-0" style="align-items: center">
                @can('isCFP')
                <div class="col-12 d-flex justify-content-between" style="align-items: center">
                    <div class="col">
                        <h3 class="mt-2">Nouvelle Moudule</h3>
                    </div>
                    <div class="col search_formatiom">
                        <form action="">
                            <div class="row w-100 form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Chercher des formations...">
                                    <span class="input-group-addon success"><a href="#ici"><span class="bx bx-search"
                                                role="button"></span></a></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col text-right">
                        <a class="new_list_nouvelle {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}"
                            href="{{route('nouvelle_formation')}}">
                            <span><span style="font-size: 20px">+</span>&nbsp;Nouvelle
                                Formation</span>
                        </a>
                    </div>
                    @endcan
                </div>

            </div>
        </div>
    </div>
</nav>
<hr>

<div class="container-fluid">
    <div class="row">
       {{--  <div class="col-6">
            <div class="panel-body">
                <div class="row">
                    <div class="container">
                        <div class="col-lg-12">
                            <form action="{{route('module.store')}}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col me-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="reference" name="reference"
                                                placeholder="Référence" required>
                                            @error('reference')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nom_module" name="nom_module"
                                                placeholder="Nom du module" required>
                                            @error('nom_module')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="duree" name="duree" min="1"
                                                max="8760" placeholder="Durée en Heure (H)"
                                                onfocus="(this.type='number')" title="entrer une durée en heure"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" d="jour" name="jour" min="1"
                                                max="365" placeholder="Durée en Jours (J)"
                                                onfocus="(this.type='number')" title="entrer une durée en jours"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" class="form-control" id="prix" name="prix"
                                                placeholder="Prix en AR" minlength="1" maxlength="7"
                                                pattern="[0-9]{1,7}" title="entrer une montant raisonnable en chiffre"
                                                required>
                                            @error('prix')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" id="objectifs" name="objectifs"
                                                placeholder="Objectifs" rows=3 required></textarea>
                                            @error('objectifs')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <Span> Ajouter un nouveau Niveau de formation : &nbsp;</Span><i
                                            class="bx bxs-edit close" onclick="myFunction()"></i>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <select name="categorie" class="form-control select_formulaire"
                                                id="categorie" name="categorie" style="height: 50px;">
                                                <option value="null" disable selected hidden>Choisissez la catégorie de
                                                    formation ...</option>
                                                @foreach($liste as $li)
                                                <option value="{{$li->id}}">{{$li->nom_formation}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="modalite" class="form-control" id="modalite" name="modalite"
                                                style="height: 50px;">
                                                <option value="null" selected hidden>Choisissez une modalité de
                                                    formation ...</option>
                                                <option value="En ligne">En ligne</option>
                                                <option value="Présentiel">Présentiel</option>
                                                <option value="En ligne/Présentiel">En ligne/Présentiel</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="niveau" class="form-control" id="niveau"
                                                style="height: 50px;">
                                                <option value="null" selected hidden>Veuillez saisir un niveau adapté...
                                                </option>
                                                @foreach($niveau as $nv)
                                                <option value="{{$nv->id}}">{{$nv->niveau}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" id="prerequis" name="prerequis"
                                                placeholder="Prérequis" required></textarea>
                                            @error('prerequis')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" id="description" name="description"
                                                placeholder="Déscription" required></textarea>
                                            @error('description')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Matériel nécessaire"
                                                name="materiel" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                placeholder="A qui s'adresse cette formation ?" name="cible" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mb-5">
                                    <div class="col" align="center">
                                        <button type="submit" class="btn btn-secondary w-50"><i
                                                class="bx bxs-plus-circle"></i> Ajouter</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="modal" tabindex="-1" role="dialog" id="ouvrir_flottant">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Changer le niveau</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div id="myDIV" class="card" style="display: none;">
                                                <table class="table">
                                                    <thead align="center">
                                                        <th>Niveau</th>
                                                        <th>Supprimer</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($niveau as $nv)
                                                        <tr>
                                                            <td>{{$nv->niveau}}</td>
                                                            <td align="center"><a
                                                                    href="{{route('supprimer_niveau',$nv->id)}}"><i
                                                                        class="bx bxs-trash"></i></a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end mx-5 pb-3">
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="myFunction()">Retour</button>&nbsp;
                                                    <button class="btn btn-primary" onclick="myFunction1()">Ajouter un
                                                        niveau</button>
                                                </div>
                                                <div id="mydiv" style="display: none;">
                                                    <form action="{{route('enregistrer_niveau')}}" method="POST">
                                                        @csrf
                                                        <table class="table">
                                                            <thead>
                                                                <th>Nouvelle niveau : </th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            name="niveau" placeholder="niveau" required>
                                                                    </td>
                                                                    <td align="center" class="p-2">
                                                                        <button type="submit"
                                                                            class="btn btn-primary mt-3">Enregistrer</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-6">

        </div>
    </div>
</div>



{{-- <form action="{{route('formation.store')}}" method="POST">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 form_new_module pb-2">
                <div class="form-row form_row_1">
                    <div class="col-1 text-center">
                        <i class='bx bxs-grid-alt form_row_icon'></i>
                    </div>
                    <div class="col-7">
                        <div class="d-flex">
                            <i class='bx bx-door-open form_row_icon_1'></i>
                            <select name="list_domaine" id="list_domaine" class="form-control custom-select"
                                style="width: 50%">
                                <option value="null" disabled hidden>Choissisez votre domaine de formation...
                                </option>
                                @foreach ($domaine as $d)
                                <option value="{{ $d->id }}">{{ $d->nom_domaine }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex">
                            <i class='bx bx-chevron-right form_row_icon_1'></i>
                            <select name="list_domaine" id="list_domaine" class="form-control custom-select1"
                                style="width: 50%">
                                <option value="null" disabled hidden>Choissisez votre formation...</option>
                                @foreach ($formation as $frmt)
                                <option value="{{ $frmt->id }}">{{ $frmt->nom_domaine }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-4 text-center d-flex" style="text-align: center">
                        <label for="reference">Reference : </label>
                        <input type="text" name="reference" id="" placeholder=" Ref. 20FR2022-01"
                            class="form-control form_row_input ms-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> --}}

{{-- <div class="row d-flex justify-content-center">
    <div class="col-12 col-md-11 col-lg-10 col-xl-9">
        <div class="card card0 border-0">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('formation.store')}}" method="POST">
                        @csrf
                        <div class="card card00 m-2 border-0">
                            <div class="row text-center justify-content-center px-3">
                                <p class="prev text-danger text-left" style="font-size: 20px;"><i
                                        class="bx bxs-left-arrow-circle"></i>&nbsp;&nbsp;Retour</p id="back">
                                <h3 class="mt-4">Nouvelle Formation</h3>
                            </div>
                            <div class="d-flex mt-4 flex-column-reverse">
                                <div class="col-md-12">
                                    <div class="card1">
                                        <ul id="progressbar" class="text-center">
                                            <li class="active step0">
                                                <h6 class="mb-5">Domaine</h6>
                                            </li>
                                            <li class="step0">
                                                <h6 class="mb-5">Formation</h6>
                                            </li>
                                            <li class="step0">
                                                <h6 class="mb-5">Module</h6>
                                            </li>
                                            <li class="step0">
                                                <h6 class="mb-5">Succès</h6>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card2 first-screen show ml-2">
                                        <div class="row px-3 mt-3">
                                            <p class="mb-0 w-100 mb-3">Choisissez votre Domaine</p>
                                            <div class="form-group mt-2 mb-4">
                                                <div class="select">
                                                    <select name="account" class="form-control 1" style="height:50px"
                                                        required>
                                                        <option value="null" disabled selected hidden>Choisissez
                                                            votre Domaine de formation...</option>
                                                        @foreach ($domaine as $d)
                                                        <option value="{{ $d->id }}">{{ $d->nom_domaine }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="next-button text-center mt-4"> <span class="">Suivant</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card2 ml-2">
                                        <div class="row px-3 mt-3">
                                            <p class="mb-0 w-100 mb-3">Choisissez votre Formation</p>
                                            <div class="form-group mt-2 mb-4">
                                                <div class="select">
                                                    <select name="account" class="form-control custom-select"
                                                        style="height:50px" required>
                                                        <option value="null" disabled selected hidden>Choisissez
                                                            votre Formation...</option>
                                                        @foreach ($formation as $frmt)
                                                        <option value="{{ $frmt->id }}">{{ $frmt->nom_domaine }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="next-button text-center mt-4"> <span class="">Suivant</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card2 ml-2">
                                        <div class="row px-3 mt-3">
                                            <p class="mb-0 w-100 mb-4">Entrer le nom de votre module</p>
                                            <div class="form-group"> <input type="text" id="pwd" class="form-control"
                                                    required> <label class="form-control-placeholder ms-2"
                                                    for="pwd">Module</label>
                                                @error('nom_formation')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{$message}} </span>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="next-button text-center mt-2"><a
                                                    href="{{route('nouveau_module')}}">Suivant</a></div>
                                        </div>
                                    </div>
                                    <div class="card2 ml-2">
                                        <div class="row px-3 mt-2 mb-4 text-center">
                                            <button class="btn btn-success">Ajouter les détails de votre
                                                module</button>
                                        </div>
                                        <div class="row px-3 mt-2 mb-4 text-center">
                                            <h2 class="col-12 text-danger"><strong>Succès !</strong></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>--}}



<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(".import").keyup(function() {
var $this = $(this);
$('.' + $this.attr("id") + '').html($this.val());
});
$(".import2").keyup(function() {
var $this = $(this);
$('.' + $this.attr("id") + '').html($this.val());
});
$(".import3").keyup(function() {
var $this = $(this);
$('.' + $this.attr("id") + '').html($this.val());
});
$(".import4").keyup(function() {
var $this = $(this);
$('.' + $this.attr("id") + '').html($this.val());
});
$(".import5").change(function() {
var $this = $(this);
$('.' + $this.attr("id") + '').html($this.val());
});


    // $(document).ready(function() {

    //     var current_fs, next_fs, previous_fs;

    //     // No BACK button on first screen
    //     if ($(".show").hasClass("first-screen")) {
    //         $(".prev").css({
    //             'display': 'none'
    //         });
    //     }

    //     // Next button
    //     $(".next-button").click(function() {

    //         current_fs = $(this).parent().parent();
    //         next_fs = $(this).parent().parent().next();

    //         $(".prev").css({
    //             'display': 'block'
    //         });

    //         $(current_fs).removeClass("show");
    //         $(next_fs).addClass("show");

    //         $("#progressbar li").eq($(".card2").index(next_fs)).addClass("active");

    //         current_fs.animate({}, {
    //             step: function() {

    //                 current_fs.css({
    //                     'display': 'none'
    //                     , 'position': 'relative'
    //                 });

    //                 next_fs.css({
    //                     'display': 'block'
    //                 });
    //             }
    //         });
    //     });

    //     // Previous button
    //     $(".prev").click(function() {

    //         current_fs = $(".show");
    //         previous_fs = $(".show").prev();

    //         $(current_fs).removeClass("show");
    //         $(previous_fs).addClass("show");

    //         $(".prev").css({
    //             'display': 'block'
    //         });

    //         if ($(".show").hasClass("first-screen")) {
    //             $(".prev").css({
    //                 'display': 'none'
    //             });
    //         }

    //         $("#progressbar li").eq($(".card2").index(current_fs)).removeClass("active");

    //         current_fs.animate({}, {
    //             step: function() {

    //                 current_fs.css({
    //                     'display': 'none'
    //                     , 'position': 'relative'
    //                 });

    //                 previous_fs.css({
    //                     'display': 'block'
    //                 });
    //             }
    //         });
    //     });
    // });



</script>

@endsection