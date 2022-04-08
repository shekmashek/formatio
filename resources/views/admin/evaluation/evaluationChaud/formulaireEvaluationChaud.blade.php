@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Evaluation à chaud</h3>
@endsection
@section('content')
<div id="page-wrapper" >
    <div class="container-fluid " style="width: 80%;">
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                {{-- <h4>Formulaire</h4> <br> --}}
                <div class="panel-heading">
                        <ul class="nav nav-pills">
                            {{-- <li  class ="" ><a href=""><span class="fa fa-plus-sign"></span> Nouveau formulaire</a></li> --}}
                        </ul>
                    </div>
            </div>
            </div>
        </div>
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                                <form action = "{{route('ajoutt.store')}}" method = "post" >
                                    @csrf

                                    @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{Session::get('error')}}
                                    </div>
                                    @endif
                                        {{-- test --}}
                                    {{--  --}}
                                    <div id="desc_champ">

                                        <div class="card-body col-lg-6">

                                            <label for="descfille1">Description</label><br><br>
                                            <textarea class="form-control"  name="desc_reponse_qste_fille[]"  rows="3" cols="20">
                                            </textarea>
                                        </div>
                                        <div class="card-body col-lg-6">
                                            <label for="nbfille1">Nombres maximum</label><br><br>
                                            <input type="number" min="1" class="form-control"  name="nb_max_desc__reponse_fille[]">
                                        </div>

                                    </div>
                                {{--  --}}


                                <br>
                                    <div class="card border-warning mb-3" style="max-width: 108rem;">
                                        <div class="card-header" > <h6> Question mère</h6></div><br>
                                        <div class="row">
                                            <div class="card-body col-lg-4">
                                                <label for="qstmere">Question</label><br><br>
                                                <input class="form-control" id="qstmere" autocomplete="off" name="qstmere" type="text">
                                            </div>
                                            <div class="card-body col-lg-4">
                                                <label for="descmere">Description</label><br><br>
                                                <textarea class="form-control" id="descmere" name="descmere"
                                                        rows="4" cols="20">
                                                </textarea>
                                            </div>

                                            <div class="card-body col-lg-4">
                                                <label for="rp">Séléctionner une type de réponse <span style="color: red;"><strong>*</strong></span></label><br><br>
                                                <select id="click" style="cursor: pointer;" name="type_champ" class="form-select" aria-label="Default select example">
                                                    @foreach ($type_champ as $tp)
                                                    <option  value="{{$tp->desc_champ}}">{{$tp->nom_champ}}</option>
                                                    @endforeach
                                                    {{-- <option  value="CASE">Case à cocher</option>
                                                    <option  value="TEXT">Text</option> --}}
                                                </select>
                                            </div>

                                        </div><br>
                                    </div><br>
                                    </div><br>
                                    <hr>
                                <br><br>

                                <div class="card border-warning mb-3" style="max-width: 108rem;">
                                    <div class="card-header"> <h6> Question fille</h6></div><br>
                                    <div class="row">
                                        <div id="" class="card-body col-lg-6">
                                            <label for="qstfille1">Question</label><br><br>
                                            <input type="text" autocomplete="off" class="form-control"  name="qstfille">
                                        </div>
                                </div>


                                    </div><br><br>
                                    <button type = "submit" class="btn btn-outline-primary"><span class="fa fa-save"></span>&nbsp; Enregistrer
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
 <script>

$(document).on('change','#click',function () {
        var id = $(this).val();
        var html = '';

        if(id == 'NOMBRE'){
            $("#desc_champ").empty();
            $("#imput_case").empty();
                html +='<div class="card-body col-lg-6">';
                html += '<label for="descfille1">Description</label><br><br>';
                html += '<textarea class="form-control"  name="desc_reponse_qste_fille[]" rows="3" cols="20"></textarea>';
                html += '</div>';
                html += '<div class="card-body col-lg-6">';

                html += '<label for="nbfille1">Nombres maximum</label><br><br>';
                html += '<input type="number" min="1" class="form-control"  name="nb_max_desc__reponse_fille[]">';
                html += '</div>';
            $('#desc_champ').append(html);
        }
        else if(id == 'TEXT'){
            $("#desc_champ").empty();
            $("#imput_case").empty();
                html +='<div class="card-body col-lg-6">';
                html += '<label for="descfille1">Description</label><br><br>';
                html += '<textarea class="form-control"  name="desc_reponse_qste_fille[]" rows="3" cols="20"></textarea>';
                html += '</div>';
                html += '</div>';
            $('#desc_champ').append(html);
        } else
        {

            $("#desc_champ").empty();
            $("#imput_case").empty();
                html += '<div>';
                html +='<button id="case" type="button" class="btn btn-success"><i class="fa fa-plus">description case a cochez</i></button>';
                html += '<div id="imput_case"></div>';
                html += '</div>';
            $('#desc_champ').append(html);

        }

        // alert(JSON.stringify(id));
        // if (id == 'CASE') {
        //     $('#select').show();
        //     $('#nombre').css('display', 'none');
        //     $('#texte').css('display', 'none');
        // }
        // else if(id == 'NOMBRE'){
        //     $('#nombre').show();
        //     $('#select').css('display', 'none');
        //     $('#texte').css('display', 'none');
        // }
        // else{
        //     $('#texte').show();
        //     $('#select').css('display', 'none');
        //     $('#nombre').css('display', 'none');
        // }


        $(document).on('click','#case',function () {
        // $('#imput_case').empty();

                var html = '';
                html +='<div class="row" id="inputFormRowCase">';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeSelect">Descriptione</label>';
                html += '<input type="text" class="form-control" placeholder=Description  name="desc_reponse_qste_fille[]" />';
                html += '</div>';
                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<button id="removeCase" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                html += '</div>';
                html += '</div><br>';
                $('#imput_case').append(html);
    });
    // remove row
    $(document).on('click', '#removeCase', function () {
        $(this).closest('#inputFormRowCase').remove();
    });


});


</script>
@endsection
