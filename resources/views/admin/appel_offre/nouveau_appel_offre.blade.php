@extends('./layouts/admin')
@section('content')

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<!-- include summernote css/js -->
{{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<div id="page-wrapper">

    @if (Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{{Session::get('error') }}</li>
        </ul>
    </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>Appel d'offre</h1>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                            <li class="nav-item me-5">
                                <a href="#" class="active" id="nav-nouveau_offre-tab" data-bs-toggle="tab" data-bs-target="#nav-nouveau_offre" type="button" role="tab" aria-controls="nav-nouveau_offre" aria-selected="true">
                                    Nouveau appel d'offre
                                    {{-- @if (count($facture_inactif) > 0)
                                    <strong style="color: red">({{count($facture_inactif)}})</strong>
                                    @endif --}}
                                </a>
                            </li>
                            <li class="nav-item me-5">
                                <a href="#" class="" id="nav-offre_nom_publier-tab" data-bs-toggle="tab" data-bs-target="#nav-offre_nom_publier" type="button" role="tab" aria-controls="nav-offre_nom_publier" aria-selected="false">
                                    Appel d'offre non publié
                                    {{-- @if (count($facture_actif) > 0)
                                    <strong style="color: red">({{count($facture_actif)}})</strong>
                                    @endif --}}
                                </a>
                            </li>
                            <li class="nav-item me-5">
                                <a href="#" class="" id="nav-offre_publier-tab" data-bs-toggle="tab" data-bs-target="#nav-offre_publier" type="button" role="tab" aria-controls="nav-offre_publier" aria-selected="false">
                                    Appel d'offre publié
                                    {{-- @if (count($facture_encour) > 0)
                                    <strong style="color: red">({{count($facture_encour)}})</strong>
                                    @endif --}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

    </div>

    <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade  show active" id="nav-nouveau_offre" role="tabpanel" aria-labelledby="nav-nouveau_offre-tab">

            <div class="row mt-5">
                <div class="col-12">
                    <div class="shadow p-3 mb-5 bg-body rounded">
                        <h4>Nouveau Appel d'Offre</h4>

                        <form class="mt-5" action="{{route('appel_offre.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf



                            <div class="form-group">
                                <label for="tdr" class="form-label" align="left">TDR (Terme De Reference) PDF<strong style="color:#ff0000;">*</strong></label>
                                <input type="file" autocomplete="off" required name="tdr" class="form-control" id="tdr" />
                                @error('tdr')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="reference_soumission" class="form-label" align="left">Référence de soumission<strong style="color:#ff0000;">*</strong></label>
                                  {{-- <input type="text" autocomplete="off" required name="reference_soumission" placeholder="référence de soumissionn" class="form-control " id="reference_soumission" /> --}}

                                <textarea class="form-control" id="reference_soumission" placeholder="référence de soumission" rows="2" cols="10" name="reference_soumission"></textarea>
                                @error('reference_soumission')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="dte" class="form-label" align="left">Date finale de soumission<strong style="color:#ff0000;">*</strong></label>
                                        <input type="date" autocomplete="off" required name="dte" class="form-control " id="dte" />
                                        @error('dte')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="hr" class="form-label" align="left">Heure finale de soumission<strong style="color:#ff0000;">*</strong></label>
                                        <input type="time" autocomplete="off" required name="hr" class="form-control  mt-2" id="hr" />
                                        @error('hr')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="prestation" class="form-label" align="left">Préstation démandé (objectif de la formation)<strong style="color:#ff0000;">*</strong></label>
                                {{-- <textarea class="form-control" id="prestation" placeholder="objectif de la formation" rows="4" name="prestation"></textarea> --}}
                                <textarea class="form-control" id="prestation"  rows="4" name="prestation"></textarea>

                                @error('prestation')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contexte" class="form-label" align="left">Contexte de la préstation<strong style="color:#ff0000;">*</strong></label>
                                {{-- <input type="text" autocomplete="off" required name="contexte" placeholder="contexte  de la préstation" class="form-control " id="contexte" /> --}}
                                <textarea class="form-control" id="contexte"  rows="4" name="contexte"></textarea>

                                @error('contexte')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                 <label for="dossier_fournir" class="form-label" align="left">Liste des dossiers à fournir<strong style="color:#ff0000;">*</strong>
                                    <textarea class="form-control" id="dossier_fournir" cols="30" rows="10" name="dossier_fournir"></textarea>
                                    @error('dossier_fournir')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror

                            </div> --}}
                            <div class="form-group">
                                <label for="information_generale" class="form-label" align="left">Liste des dossiers à fournir<strong style="color:#ff0000;">*</strong></label>
                                <textarea class="form-control" id="dossier_fournir" cols="30" rows="10" name="dossier_fournir"></textarea>
                                @error('dossier_fournir')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="information_generale" class="form-label" align="left">Information générale<strong style="color:#ff0000;">*</strong></label>
                                <textarea class="form-control" id="information_generale" cols="30" rows="10" name="information_generale"></textarea>
                                @error('information_generale')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exigence_soumission" class="form-label" align="left">Exigence et Condition de soumission<strong style="color:#ff0000;">*</strong></label>
                                <textarea class="form-control" id="exigence_soumission" cols="30" rows="10" name="exigence_soumission"></textarea>
                                @error('information_geenrale')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-lg" style="background-color: #9C27B0; color: white"><span class="fa fa-save"></span>&nbsp; sauvegarder
                        </form>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                </div> --}}

            </div>



        </div>

        <div class="tab-pane fade" id="nav-offre_nom_publier" role="tabpanel" aria-labelledby="nav-offre_nom_publier-tab">
            <h1>Appel d'offre non publier</h1>

            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            {{-- <div class="card" style="width: 30rem;">
                <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="...">
                <h5 class="card-title">Numerika Center</h5>
                <div class="card-body">
                    <h6 class="card-title">APPEL D'OFFRES OUVERT N°001/PAGEII/2022</h6>
                    <h6 class="card-subtitle mb-2 text-muted">préstation démandé: EXCEL</h6>
                    <p class="card-text">préstation: Les interventions du prestataire s'étaleront sur une durée environ 3 mois, avec la date fin le date date_fin: 17 juin 2022 à heure fin: 12:00:00</p>
                    <p class="card-text">Information génerale:</p>
                    <p class="card-text">Exigence et condition de soumission:</p>
                    <a href="#" class="card-link">TDR: TDR.pdf</a>
                    <p class="card-text">contactez-nous par:</p>
                    <p class="card-text">email: email@gmail.com</p>
                </div>
            </div> --}}

            @foreach($appel_offre_non_publier as $offre)
            <div class="card" style="width: 30rem;">
                <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="...">
                <h5 class="card-title">{{$entreprise->nom_etp}}r</h5>
                <div class="card-body">
                    <h5 class="card-title">APPEL D'OFFRES OUVERT {{$offre->reference_soumission}}</h5>
                    <h5 class="card-subtitle mb-2 text-muted">{{$offre->prestation_demande}}</h5>
                    <h6 class="card-text">Les interventions du prestataire s'étaleront sur une durée environ 3 mois(static), avec la date fin le date {{$offre->date_fin}} à heure {{$offre->hr_fin}}</h6>
                    <h6 class="card-text">Information génerale:</h6>
                    {{-- {{"".$offre->information_generale}} --}}
                    @php
                        echo html_entity_decode($offre->information_generale);
                    @endphp
                    <h6 class="card-text">Exigence et condition de soumission:</h6>
                    @php
                        echo html_entity_decode($offre->exigence_soumission);
                    @endphp
                    {{-- {{$offre->exigence_soumission}} --}}
                    <h6 class="card-text">Liste des dossiers à fournir:</h6>
                    @php
                        echo html_entity_decode($offre->dossier_fournir);
                    @endphp
                    {{-- {{$offre->dossier_fournir}} --}}
                    <a href="#" class="card-link">TDR: {{$offre->tdr_url}}</a>
                    <h6 class="card-text">contactez-nous par:</h6>
                    <p class="card-text">email: {{$resp_connecter->email_resp}}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="tab-pane fade" id="nav-offre_publier" role="tabpanel" aria-labelledby="nav-offre_publier-tab">
            <h1>Appel d'offre publier</h1>
        </div>


    </div>


</div>
</div>
</div>
</div>
</div>
</div>
{{-- </div> --}}
</div>
{{--
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    // tinymce.init({
    //     selector: '#exigence_soumission,#information_generale,#dossier_fournir,#reference_soumission,#prestation,#contexte'
    // });
    $('#dossier_fournir').summernote({
        placeholder: 'liste des dossiers à fournir',
        tabsize: 2,
        height: 100
      });
      $('#information_generale').summernote({
        placeholder: 'liste des informations generale',
        tabsize: 2,
        height: 100
      });
      $('#exigence_soumission').summernote({
        placeholder: 'liste des exigences de soumission',
        tabsize: 2,
        height: 100
      });

     /* $('#reference_soumission').summernote({
        placeholder: 'référence de soumission',
        tabsize: 2,
        height: 100
      }); */

      $('#prestation').summernote({
        placeholder: 'objectif de la formation',
        tabsize: 2,
        height: 100
      });
      $('#contexte').summernote({
        placeholder: 'contexte  de la préstation',
        tabsize: 2,
        height: 100
      });

    //=================== liste des soumission =========================

    $(document).on('click', '#addRow', function() {
        // alert("tong");
        $.ajax({
            success: function(response) {
                var html = '';
                html += '<div class="row justify-content" id="inputFormRowMontant">';
                html += '<div class="col-8">';
                html += ' <textarea class="form-control" id="dossier_fournir[]" placeholder="ajouter un dossier à fournir" rows="3" name="dossier_fournir[]"></textarea>';
                html += '</div>';
                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<button id="removeRowMontant" type="button" class="btn btn-danger" style="position:relative; top: 2.3rem"><i class="fa fa-trash"></i></button>';
                html += '</div>';
                html += '</div>';
                html += '</div><br>';


                $('#newRow').append(html);
            }
        });
    });

    // remove row
    $(document).on('click', '#removeRowMontant', function() {
        $(this).closest('#inputFormRowMontant').remove();
    });

</script>
@endsection
