@extends('./layouts/admin')
@section('title')
<h3 class="text-white ms-5">Nouvelle Formation</h3>
@endsection
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
@section('content')
{{-- <div id="page-wrapper">
    <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">

                                <a class="nav-link {{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" aria-current="page" href="{{route('liste_formation')}}">
<i class="bx bx-list-ul" style="font-size: 20px;"></i><span>&nbsp;Liste des formations</span></a>

</li>
<li class="nav-item">
    <a class="nav-link  {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}" href="{{route('nouvelle_formation')}}"><i class="bx bxs-plus-circle"></i><span>&nbsp;Nouvelle Formation</span></a>
</li>
<li class="nav-item">

    <a class="nav-link  {{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}" href="{{route('liste_module')}}">
        <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des modules</span></a>
</li>

<li class="nav-item">

    <a class="nav-link  {{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}" aria-current="page" href="{{route('liste_programme')}}">
        <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des programmes</span></a>

</li>

</ul>
</div>
</div>
</nav>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">

            <div class="panel-body">
                <div class="container">
                    <div class="col-lg-12">
                        <form action="{{route('formation.store')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group me-3">
                                        <label for="domaine de formation" class="label_margin_bottom">Domaine de formation</label>
                                        <select class="form-select" name="domaine" aria-label="Default select example">
                                            <option value="null" disabled selected hidden>Choisissez votre domaine de formation ...</option>
                                            @foreach ($domaine as $frmt)
                                            <option value="{{ $d->id }}">{{ $d->nom_domaine }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mt-2 ms-3">
                                        <label for="username">Nom de la formation</label>
                                        <input type="text" class="form-control" id="nom_projet" autocomplete="off" name="nom_formation" placeholder="Nom" pattern="[a-zA-Z0-9@&,/'- ']" required>
                                        @error('nom_formation')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mb-5 mt-3" align="center">
                                <div class="col">
                                    <button type="submit" class="btn btn-secondary w-50"> <i class="bx bxs-plus-circle"></i><span>&nbsp;Ajouter</span></button>
                                </div>
                            </div>
                            <!-- <input type = "submit" class="btn btn-primary" id ="action2" value = "Modifier" style="visibility:hidden">
                                   		 -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div> --}}

<div class="container-fluid px-1 px-md-4 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11 col-lg-10 col-xl-9">
            <div class="card card0 border-0">
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('formation.store')}}" method="POST">
                            @csrf
                            <div class="card card00 m-2 border-0">
                                <div class="row text-center justify-content-center px-3">
                                    <p class="prev text-danger text-left" style="font-size: 20px;"><i class="bx bxs-left-arrow-circle"></i>&nbsp;&nbsp;Retour</p id="back">
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
                                                        <select name="account" class="form-control custom-select" style="height:50px" required>
                                                            <option value="null" disabled selected hidden>Choisissez votre Domaine de formation...</option>
                                                            @foreach ($domaine as $d)
                                                            <option value="{{ $d->id }}">{{ $d->nom_domaine }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="next-button text-center mt-4"> <span class="">Suivant</span> </div>
                                            </div>
                                        </div>
                                        <div class="card2 ml-2">
                                            <div class="row px-3 mt-3">
                                                <p class="mb-0 w-100 mb-3">Choisissez votre Formation</p>
                                                <div class="form-group mt-2 mb-4">
                                                    <div class="select">
                                                        <select name="account" class="form-control custom-select" style="height:50px" required>
                                                            <option value="null" disabled selected hidden>Choisissez votre Formation...</option>
                                                            {{-- @foreach ($formation as $frmt)
                                                            <option value="{{ $frmt->id }}">{{ $frmt->nom_domaine }}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="next-button text-center mt-4"> <span class="">Suivant</span> </div>
                                            </div>
                                        </div>
                                        <div class="card2 ml-2">
                                            <div class="row px-3 mt-3">
                                                <p class="mb-0 w-100 mb-4">Entrer le nom de votre module</p>
                                                <div class="form-group"> <input type="text" id="pwd" class="form-control" required> <label class="form-control-placeholder ms-2" for="pwd">Module</label>
                                                    @error('nom_formation')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="next-button text-center mt-2"><a href="{{route('nouveau_module')}}">Suivant</a></div>
                                            </div>
                                        </div>
                                        <div class="card2 ml-2">
                                            <div class="row px-3 mt-2 mb-4 text-center">
                                                <button class="btn btn-success">Ajouter les détails de votre module</button>
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
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs;

        // No BACK button on first screen
        if ($(".show").hasClass("first-screen")) {
            $(".prev").css({
                'display': 'none'
            });
        }

        // Next button
        $(".next-button").click(function() {

            current_fs = $(this).parent().parent();
            next_fs = $(this).parent().parent().next();

            $(".prev").css({
                'display': 'block'
            });

            $(current_fs).removeClass("show");
            $(next_fs).addClass("show");

            $("#progressbar li").eq($(".card2").index(next_fs)).addClass("active");

            current_fs.animate({}, {
                step: function() {

                    current_fs.css({
                        'display': 'none'
                        , 'position': 'relative'
                    });

                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        });

        // Previous button
        $(".prev").click(function() {

            current_fs = $(".show");
            previous_fs = $(".show").prev();

            $(current_fs).removeClass("show");
            $(previous_fs).addClass("show");

            $(".prev").css({
                'display': 'block'
            });

            if ($(".show").hasClass("first-screen")) {
                $(".prev").css({
                    'display': 'none'
                });
            }

            $("#progressbar li").eq($(".card2").index(current_fs)).removeClass("active");

            current_fs.animate({}, {
                step: function() {

                    current_fs.css({
                        'display': 'none'
                        , 'position': 'relative'
                    });

                    previous_fs.css({
                        'display': 'block'
                    });
                }
            });
        });

    });

</script>

@endsection
