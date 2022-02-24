@extends('./layouts/admin')
@section('content')

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



<div id="page-wrapper">
    {{-- <div class="shadow-sm p-3 mb-5 bg-body rounded"> --}}
    <div class="container-fluid">
        {{-- <div class="panel-heading d-flex mb-5">
            <div class="mx-2">
                <li class="{{ Route::currentRouteNamed('liste_participant') ? 'active' : '' }}" style="list-style: none"><a href="{{route('liste_participant')}}"><span class="bx bx-list-ul"></span>Liste des participants</a></li>&nbsp;
    </div>
    <div class="mx-2">
        <li class="{{ Route::currentRouteNamed('liste_chefDepartement') ? 'active' : '' }}" style="list-style: none"><a href="{{route('liste_chefDepartement')}}"><span class="bx bx-list-ul"></span>Liste des Manager</a></li>&nbsp;
    </div>
    <div class="mx-2">
        <li class="{{ Route::currentRouteNamed('liste+responsable+entreprise') ? 'active' : '' }}" style="list-style: none"><a href="{{route('liste+responsable+entreprise')}}"><span class="bx bx-list-ul"></span>Liste des responsables</a></li>&nbsp;
    </div>

</div> --}}
@if (Session::has('error'))
<div class="alert alert-danger">
    <ul>
        <li>{{Session::get('error') }}</li>
    </ul>
</div>
@endif
<!-- /.row -->

<div class="row">
    {{-- <div class="col-md-2"></div> --}}
    <div class="col-md-6">
        <div class="shadow p-3 mb-5 bg-body rounded">
            <h2>Appel d'offre</h2>

            <form action="{{route('employeur.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="tdr" class="form-label" align="left">TDR (Terme De Reference)<strong style="color:#ff0000;">*</strong></label>
                    <input type="file" autocomplete="off" required name="tdr" class="form-control" id="tdr" />
                    @error('tdr')
                    <div class="col-sm-6">
                        <span style="color:#ff0000;"> {{$message}} </span>
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reference_soumission" class="form-label" align="left">Référence de soumission<strong style="color:#ff0000;">*</strong></label>
                    <input type="text" autocomplete="off" required name="reference_soumission" class="form-control " id="reference_soumission" placeholder="référence de soumission" />
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
                    {{-- <input type="text" autocomplete="off" required name="prestation" class="form-control " id="prestation" /> --}}
                    <textarea class="form-control" id="prestation" placeholder="objectif de la formation" rows="3" name="prestation"></textarea>

                    @error('prestation')
                    <div class="col-sm-6">
                        <span style="color:#ff0000;"> {{$message}} </span>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="contexte" class="form-label" align="left">Contexte de la préstation<strong style="color:#ff0000;">*</strong></label>
                    <input type="text" autocomplete="off" required name="contexte" placeholder="contexte  de la préstation" class="form-control " id="contexte" />
                    @error('contexte')
                    <div class="col-sm-6">
                        <span style="color:#ff0000;"> {{$message}} </span>
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dossier_fournir" class="form-label" align="left">Liste des dossiers à fournier<strong style="color:#ff0000;">*</strong> &nbsp;&nbsp;<a class='nouveau_icon_lien' id="addRow"><i class='bx  bxs-plus-circle nouveau_icon' title="nouveau formateur"></i></a></label>
                    {{-- <input type="text" autocomplete="off" required name="prestation" class="form-control " id="prestation" /> --}}
                    <textarea class="form-control" id="dossier_fournir" placeholder="ajouter un dossier à fournir" rows="3" name="dossier_fournir"></textarea>
                    <div id="newRow"></div>
                </div>


                <div class="form-group">
                    <label for="information_geenrale" class="form-label" align="left">Information générale<strong style="color:#ff0000;">*</strong></label>
                    <textarea class="form-control" id="information_geenrale" rows="3" name="information_geenrale"></textarea>

                    @error('information_geenrale')
                    <div class="col-sm-6">
                        <span style="color:#ff0000;"> {{$message}} </span>
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exigence_soumission" class="form-label" align="left">Exigence et Condition de soumission<strong style="color:#ff0000;">*</strong></label>
                    <textarea class="form-control" id="exigence_soumission" rows="3" name="exigence_soumission"></textarea>

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
    <div class="col-md-6"></div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>
{{-- </div> --}}
</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '#exigence_soumission,#information_geenrale'
    });

    //=================== liste des soumission =========================

    $(document).on('click', '#addRow', function() {
        // alert("tong");
        $.ajax({
            success: function(response) {
                var html = '';
                html += '<div class="row justify-content" id="inputFormRowMontant">';
                html += '<div class="col">';
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
