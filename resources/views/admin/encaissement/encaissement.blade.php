@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Encaissement</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>ENCAISSEMENT</h3>
            </div>
        </div> --}}
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Informations</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="projet">Entreprise : {{$data[0]->nom_etp}}</label><br>
                                </div>
                                <div class="form-group">
                                    <label for ="entreprise">Nom du projet : {{$data[0]->nom_projet}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="row gx-2 gy-2 align-items-center" id="inputFormRow">

                            @if (Session::has('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('success') }}</strong>
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger alert-block">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            <form action="{{ route('encaisser') }}" method="post" name="encaissement" id="encaissement">
                                @csrf
                                <input type="hidden" name="entreprise_id" value="{{ $data[0]->entreprise_id }}">
                                <input type="hidden" name="projet_id" value="{{ $data[0]->projet_id }}">
                                <input type="hidden" name="facture_id" value="{{ $id_facture[0]->id }}">

                                <div class="row gx-2 gy-2 align-items-center">
                                 <br>
                                    <h5>Montant de la formation:</h5>
                                    <div class="col-sm-6">
                                      <label for="inputPassword6" class="col-form-label">Description</label>
                                      <input type="text" name="libelle" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" >
                                      @error('libelle')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="inputPassword6" class="col-form-label">Montant</label>
                                        <input type="number" min="0" name="montant" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" placeholder="0">
                                        @error('montant')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    </div>
                                  </div>

                                <div class="row gx-2 gy-2 align-items-center" id="inputFormRow">

                                </div>
                                <br>

                                <div id="newRow"></div>
                                <button id="addRow" type="button" data-id="{{ $data[0]->projet_id }}" class="btn btn-info"><i class="fa fa-plus">Autres encaissement</i></button>

                                <br>
                                <br>
                                <button type="submit" class="btn btn-success">Encaisser</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
            	<br>
                    <a href="{{ route('listeEncaissement',[$data[0]->entreprise_id,$data[0]->projet_id]) }}"><button type="submit" class="btn btn-primary">Extrait de compte client</button></a>

            </div>
        </div>

    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript">
        // add row
        $(document).on('click', '#addRow', function () {
            var id_pj = $(this).data("id");
            $('#frais').empty();
            $.ajax({
                url:'{{ route("frais_annexes") }}',
                type:'get',
                data:{id_projet:id_pj},
                success:function(response){
                    var userData=response;
                    for (var $i = 0; $i < userData.length; $i++){
                        $("#frais").append('<option value="'+userData[$i].montant_frais_annexe_id+'">'+ userData[$i].description+'</option>');
                    }
                },
                error:function(error){
                    console.log(error);
                }
            });

            $.ajax({
                url:'{{ route("frais_annexes") }}',
                type:'get',
                data:{id_projet:id_pj},
                success:function(response){
                    var userData=response;
                    var html = '';
                    html +='<div class="row gx-2 gy-2 align-items-center" id="inputFormRow"><h5>Montant pour les frais annexes:</h5>';
                    html += '<div class="col-sm-4">';
                    html += 'Frais annexe:';
                    html += '<select class="form-select" id="frais" name="frais_annexe[]" id="specificSizeSelect">';

                    for (var $i = 0; $i < userData.length; $i++){
                        html += '<option value="'+userData[$i].montant_frais_annexe_id+'">'+userData[$i].description+'</option>';
                    }
                    html += '</select></div>';
                    html += '<div class="col-sm-4">';
                    html += 'Description:';
                    html += '<input type="text" name="description[]" class="form-control" id="specificSizeInputName" placeholder="Description" required="" oninvalid="this.setCustomValidity("Veuillez entrer un montant.")"></div>';
                    html += '<div class="col-sm-3">';
                    html += 'Montant:';
                    html += '<input type="number" min="0" name="montant_frais_annexe[]" class="form-control" id="specificSizeInputName" placeholder="0" required></div>';
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
