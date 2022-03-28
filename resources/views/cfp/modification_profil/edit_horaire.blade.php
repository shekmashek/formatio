@extends('./layouts/admin')
@section('content')
<style>

.test {
    padding: 2px;
    border-radius: 5px;
    box-sizing: border-box;
    color: #9E9E9E;
    border: 1px solid #BDBDBD;
    font-size: 16px;
    letter-spacing: 1px;
    height: 50px !important
}

.test:focus{
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 2px solid #E53935 !important;
    outline-width: 0 !important;
}

.form-control-placeholder {
  position: absolute;
  top: 1rem;
  padding: 12px 2px 0 2px;
  padding: 0;
  padding-top: 2px;
  padding-bottom: 5px;
  transition: all 300ms;
  opacity: 0.5;
  left: 2rem;
}

.test:focus+.form-control-placeholder,
.test:valid+.form-control-placeholder {
  font-size: 95%;
  font-weight: bolder;
  top: 1.5rem;
  transform: translate3d(0, -100%, 0);
  opacity: 1;
  background-color: white;
  margin-left: 105px;

}
</style>


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
            <p style="text-align: left">Modifier l'horaire d'ouverture(Jour - heure d'ouverture - heure de fermeture)</p>
            @if($cfp!=null)
                <form   class="btn-submit" action="" method="post" enctype="multipart/form-data">
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
                            <button title="Ajouter une nouvelle horaire" type="button" class="btn btn-success btn-lg" id="addRow"><i class='bx bxs-plus-circle'></i></button>
                        </div>
                    </div>

                    <button style=" background-color: #801D68;color:white;float: right;" class=" mt-2 btn modification "> Enregister</button>
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
                <button type="submit" style=" background-color: #801D68;color:white;float: right;" class=" mt-1 btn modification "> Enregister</button>

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
</script>

@endsection