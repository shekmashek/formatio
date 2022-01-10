
@extends('./layouts/admin')
@section('content')
    <div class="container"style="max-width: 700px;">

        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary">Add or Remove Input Fields Dynamically using jQuery</span>
        </div>



        <form action="{{ route('testForm') }}" method="POST">
            <div class="row gx-2 gy-2 align-items-center" id="inputFormRow">
                <div class="col-sm-5">
                    <label class="visually-hidden" for="specificSizeSelect">Frais annexe</label>
                    <select class="form-select" id="frais" name='frais_annexes[]' id="specificSizeSelect">

                        @foreach ($datas as $data)
                            <option value="{{ $data->id }}">{{ $data->designation }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                <label class="visually-hidden" for="specificSizeInputName">Description</label>
                <input type="text" class="form-control" name="libelle[]" id="specificSizeInputName" placeholder="Description">
                </div>
                <div class="col-sm-3">
                    <label class="visually-hidden" for="specificSizeInputGroupUsername">Montant</label>
                    <div class="input-group">
                        <input type="number" min="0" name="motant[]" class="form-control" id="specificSizeInputGroupUsername" placeholder="0">
                    </div>
                </div>

                <div class="col-auto">
                    <div class="input-group-append">
                        <button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <br>

            <div id="newRow"></div>
            <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus"></i></button>


            <div class="col-auto">
              <button type="submit" class="btn btn-primary">Encaisser</button>
            </div>
        </form>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript">
        // add row
        $(document).on('click', '#addRow', function () {
            $('#frais').empty();
            $.ajax({
                url:'frais_annexes',
                type:'get',
                success:function(response){
                    var userData=response;
                    // alert(JSON.stringify(userData));
                    for (var $i = 0; $i < userData.length; $i++){
                        $("#frais").append('<option value="'+userData[$i].id+'">'+ userData[$i].designation+'</option>');
                    }
                },
                error:function(error){
                    console.log(error);
                }
            });

            $.ajax({
                url:'frais_annexes',
                type:'get',
                success:function(response){
                    var userData=response;

                    var html = '';
                    html +='<div class="row gx-2 gy-2 align-items-center" id="inputFormRow">';
                    html += '<div class="col-sm-5">';
                    html += '<label class="visually-hidden" for="specificSizeSelect">Frais annexe</label>';
                    html += '<select class="form-select" id="frais" name="frais_annexes[]" id="specificSizeSelect">';

                    for (var $i = 0; $i < userData.length; $i++){
                        html += '<option value="'+userData[$i].id+'">'+userData[$i].designation+'</option>';
                    }
                    html += '</select></div>';
                    html += '<div class="col-sm-3">';
                    html += '<label class="visually-hidden" for="specificSizeInputName">Description</label>';
                    html += '<input type="text" name="libelle[]" class="form-control" id="specificSizeInputName" placeholder="Description"></div>';
                    html += '<div class="col-sm-3">';
                    html += '<label class="visually-hidden" for="specificSizeInputName">Montant</label>';
                    html += '<input type="number" min="0" name="motant[]" class="form-control" id="specificSizeInputName" placeholder="0"></div>';
                    html += '<div class="col-auto"><div class="input-group-append">';
                    html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div><br>';

                    $('#newRow').append(html);


                },
                error:function(error){
                    console.log(error);
                }
            });

        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>

@endsection
