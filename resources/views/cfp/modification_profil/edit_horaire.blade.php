@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification horaire</h3>
@endsection
@section('content')
<a href="{{route('affichage_parametre_cfp')}}"> <button class="btn btn_precedent" ><i class='bx bxs-chevron-left me-1'></i>Retour</button></a>

<center>
    @if (\Session::has('error_adresse'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('error_adresse') !!}</li>
            </ul>
        </div>
    @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">
            @if($cfp!=null)
                <form   class="btn-submit" action="{{route('modification_horaire',$id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row px-3 mt-4">

                        @for($i = 0; $i < count($cfp); $i++)
                            <div class="form-group mt-1 mb-1" style="display: flex">
                                    <input type="text" class="form-control test input"  name="jour[]"  value="{{ $cfp[$i]->jours}}">&nbsp;
                                    <input type="time" class="form-control test input"  name="ouverture[]"  value="{{ $cfp[$i]->h_entree}}">&nbsp;
                                    <input type="time" class="form-control test input"  name="fermeture[]" value="{{ $cfp[$i]->h_sortie}}">&nbsp;
                            </div>


                        @endfor
                        <div class="text-end mt-1">
                            <button title="Ajouter une nouvelle horaire" type="button" class="btn btn-success btn-lg" id="addRow2"><i class='bx bxs-plus-circle'></i></button>
                        </div>
                    </div>
                    <div id="add_column2"></div>
                    <button  class="btn_enregistrer mt-2 btn modification "> Enregister</button>
                </form>
            @else
            <form  class="btn-submit" action="{{route('remplir_horaire',$id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4" style="display: flex">
                        <input type="text" class="form-control" id="inlineFormInput3" name="jour[]" placeholder="Jour" required />
                    </div>
                    <div class="col-4" style="display: flex">
                        <input type="time" class="form-control" id="inlineFormInput3" name="ouverture[]" placeholder="Ouverture" required />
                    </div>
                    <div class="col-4" style="display: flex">
                        <input type="time" class="form-control" id="inlineFormInput3" name="fermeture[]" placeholder="Fermeture" required />&nbsp;
                        <button type="button" class="btn btn-success" id="addRow"><i class='bx bxs-plus-circle'></i></button>
                    </div>
                </div>
                <div id="add_column"></div>
                <button type="submit" class="btn_enregistrer mt-1 btn modification "> Enregister</button>

            </form>
            @endif

            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript">
 //add row1
    $(document).on('click', '#addRow', function() {
        var html = '';

        html += '<div class="row" id = "inputFormRow1">';
        html += '<div class="col-4" style="display: flex">';
        html += '<input type="text" class="form-control" id="inlineFormInput3" name="jour[]" placeholder="Jour" required />';
        html += '</div>';
        html += '<div class="col-4" style="display: flex">';
        html += '<input type="time" class="form-control" id="inlineFormInput3" name="ouverture[]" placeholder="Jour" required />';
        html += '</div>';
        html += '<div class="col-4" style="display: flex">';
        html += '<input type="time" class="form-control" id="inlineFormInput3" name="fermeture[]" placeholder="Jour" required />';
        html += '<button id="removeRow1" type="button" class="btn btn-danger mt-2"><i class="bx bx-x" style="font-size: 15px;"></i></button>&nbsp;';
        html += '</div>';
        $('#add_column').append(html);
    });

    // remove row1
    $(document).on('click', '#removeRow1', function() {
        $(this).closest('#inputFormRow1').remove();
    });

    $(document).on('click', '#addRow2', function() {
        var html = '';

        html += '<div class="row" id = "inputFormRow2">';
        html += '<div class="col-4" style="display: flex">';
        html += '<input type="text" class="form-control" id="inlineFormInput3" name="jour[]" placeholder="Jour" required />';
        html += '</div>';
        html += '<div class="col-4" style="display: flex">';
        html += '<input type="time" class="form-control" id="inlineFormInput3" name="ouverture[]" placeholder="Jour" required />';
        html += '</div>';
        html += '<div class="col-4" style="display: flex">';
        html += '<input type="time" class="form-control" id="inlineFormInput3" name="fermeture[]" placeholder="Jour" required />';
        html += '<button id="removeRow2" type="button" class="btn btn-danger mt-2"><i class="bx bx-x" style="font-size: 15px;"></i></button>&nbsp;';
        html += '</div>';
        $('#add_column2').append(html);
    });

    // remove row1
    $(document).on('click', '#removeRow2', function() {
        $(this).closest('#inputFormRow2').remove();
    });
</script>

@endsection