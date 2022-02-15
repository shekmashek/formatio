@extends('./layouts/admin')
@section('content')


<div class="container-fluid justify-content-center pb-3">

    <style type="text/css">
        button,
        value {
            font-size: 12px;
        }

        .font_text strong,
        .font_text li,
        .font_text h3,
        .font_text h4,
        .font_text p {
            font-size: 12px;
        }

        .font_text h5,
        .font_text h6 {
            font-size: 10px;
        }

        .form_colab input {
            height: 30px;
        }

        .form_colab select {
            height: 30px;
            padding: 0;
            padding-left: 5px;
            padding-right: 5px;
            font-size: 13px;
        }

        .form_colab input::placeholder {
            font-size: 12px
        }


        .form_colab button {
            height: 30px;
            padding: 0;
            padding-left: 5px;
            padding-right: 5px;
            font-size: 13px;
        }

        .nav_bar_list:hover {
            background-color: transparent;
        }

        .nav_bar_list .nav-item:hover {
            border-bottom: 2px solid black;
        }

    </style>



    <div class="container my-5">
        <div class="row">
            <h4>Départements/Services</h4>
            @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>{{Session::get('success')}}</strong>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
                <strong>{{Session::get('error')}}</strong>
            </div>
            @endif

            <div class="col-md-12 mt-5">
                <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                    <li class="nav-item">
                        <a href="#" style="color: rgb(102, 15, 241)" class=" active" id="home-tab" data-toggle="tab" data-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                            gestion de département
                        </a>
                    </li>
                    <li class="nav-item ms-5">
                        <a href="#"  style="color: rgb(102, 15, 241)" class="" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            gestion de service
                        </a>
                    </li>
                    <li class="nav-item ms-5">
                        <a href="#"  style="color: rgb(102, 15, 241)" class="" id="profile-tab" data-toggle="tab" data-target="#branche" type="button" role="tab" aria-controls="branche" aria-selected="false">
                            gestion de branche
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>



    <div class="tab-content" id="myTabContent">
        {{-- département --}}

        <div class="tab-pane fade show active" id="invitation" role="tabpanel" aria-labelledby="home-tab">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">

                        <div class="shadow p-3 mb-5 bg-body rounded ">

                            <h4>Départements</h4>

                            <div class="table-responsive text-center">

                                <table class="table  table-borderless table-sm">
                                    <tbody id="data_collaboration">

                                        <tr>
                                            <td>
                                                <div align="left">
                                                    @if(isset($rqt))
                                                        @for($i = 0; $i < $nb; $i++)
                                                            <p><strong>{{$rqt[$i]->nom_departement}}</strong></p>
                                                        @endfor
                                                    @endif

                                                </div>
                                            <td>
                                                <div align="rigth">
                                                    <p style="color: rgb(66, 55, 221)"><i class="bx bx-check"></i></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group dropleft">
                                                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> &nbsp; modifier</a>
                                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_#"><i class="fa fa-trash"></i> <strong style="color: red">rétirer définitvement</strong></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="exampleModal_#" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title text-white">Avertissement !</h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                        <form action="#" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                            <input name="cfp_id" type="text" value="test" hidden>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="shadow p-3 mb-5 bg-body rounded ">

                            <h4>Ajout de département</h4>
                            <form class="form form_colab" action="{{ route('departement.store') }}" method="POST">
                                @csrf
                                <div class="form-row d-flex">
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="inlineFormInput" name="departement[]" placeholder="Nom de déprtement" required />
                                    </div>
                                    <div class="col ms-2">
                                        <button type="button" class="btn btn-success mt-2" id="addRow1"><i class='bx bxs-plus-circle'></i></button>
                                    </div>

                                </div>
                                <div id="add_column"></div>

                                <button type="submit" class="btn btn-primary mt-2">Sauvegarder</button>

                            </form>


                        </div>
                    </div>
                </div>
            </div>


        </div>

        {{-- service --}}
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">

                        <div class="shadow p-3 mb-5 bg-body rounded ">

                            <h4>Services</h4>

                            <div class="table-responsive text-center">

                                <table class="table  table-borderless table-sm">
                                    <tbody id="data_collaboration">

                                        <tr>
                                            <td>
                                                <div align="left">
                                                    @if(isset($service_departement))
                                                        @for($i = 0; $i < $nb_serv; $i++)
                                                            <h6><strong>{{$service_departement[$i]->nom_departement}}</strong></h6>

                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-9">
                                                            <p>{{$service_departement[$i]->nom_service}}</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                                <div align="rigth">
                                                                    <p style="color: rgb(66, 55, 221)"><i class="bx bx-check"></i></p>
                                                                </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="btn-group dropleft">
                                                                <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> &nbsp; modifier</a>
                                                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_#"><i class="fa fa-trash"></i> <strong style="color: red">rétirer définitvement</strong></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endfor
                                                    @endif
                                                </div>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                        </tr>
                                        <div class="modal fade" id="exampleModal_#" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title text-white">Avertissement !</h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                        <form action="#" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                            <input name="cfp_id" type="text" value="test" hidden>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="shadow p-3 mb-5 bg-body rounded ">

                            <h4>Ajout de service</h4>
                            <form name="formInsert" id="formInsert" action="{{route('enregistrement_service')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" class="form_colab">
                                @csrf
                                <div class="form-row d-flex">
                                    <div class="col mb-2">
                                        <select class="form-select mt-2" id="inlineFormInput" aria-label="Default select example" name = "departement_id[]">
                                            <option selected>Choisissez le département </option>
                                            @if(isset($rqt))
                                                @for($i = 0; $i < $nb; $i++)
                                                    <option value= "{{$rqt[$i]->id}}">{{$rqt[$i]->nom_departement}}</option>
                                                @endfor
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="inlineFormInput" name="service[]" placeholder="Nom de service" required />
                                    </div>
                                    <div class="col ms-2">
                                        <button type="button" class="btn btn-success mt-2" id="addRow2"><i class='bx bxs-plus-circle'></i></button>
                                    </div>

                                </div>
                                <div id="add_column2"></div>

                                <button type="submit" class="btn btn-primary mt-2">Sauvegarder</button>

                            </form>


                        </div>
                    </div>
                </div>
            </div>


        </div>




        {{-- internface branch --}}

        <div class="tab-pane fade" id="branche" role="tabpanel" aria-labelledby="branche-tab">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">

                        <div class="shadow p-3 mb-5 bg-body rounded ">

                            <h4>Branche</h4>

                            <div class="table-responsive text-center">

                                <table class="table  table-borderless table-sm">
                                    <tbody id="data_collaboration">
                                        <tr>
                                            <td>
                                                @if(isset($branches))
                                                    @for($i = 0; $i < $nb_branche; $i++)
                                                        <p><strong>{{$branches[$i]->nom_branche}}</strong></p>
                                                    @endfor
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="shadow p-3 mb-5 bg-body rounded ">

                            <h4>Ajout de branche</h4>
                            <form name="formInsert" id="formInsert" action="{{route('enregistrement_branche')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" class="form_colab">
                                @csrf
                                <div class="form-row d-flex">
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="inlineFormInput3" name="nom_branche[]" placeholder="Nom de la branche" required />
                                    </div>
                                    <div class="col ms-2">
                                        <button type="button" class="btn btn-success mt-2" id="addRow3"><i class='bx bxs-plus-circle'></i></button>
                                    </div>

                                </div>
                                <div id="add_column3"></div>

                                <button type="submit" class="btn btn-primary mt-2">Sauvegarder</button>

                            </form>


                        </div>
                    </div>
                </div>
            </div>


        </div>
        {{-- fin --}}

    </div>



    @endsection

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script type="text/javascript">
        //add row1
        $(document).on('click', '#addRow1', function() {
            var html = '';
            html += '<div class="form-row d-flex" id="inputFormRow1">';
            html += '<div class="col">';
            html += '<input type="text" class="form-control  mb-2" name="departement[]" id="inlineFormInput"  placeholder="Nom de département"  required>';
            html += '</div>';
            html += '<div class="col ms-2">';
            html += '<button id="removeRow1" type="button" class="btn btn-danger mt-2"><i class="fa fa-close style="font-size: 15px;"></i></button>';
            html += '</div>';
            html += '</div>';
            $('#add_column').append(html);
        });

        // remove row1
        $(document).on('click', '#removeRow1', function() {
            $(this).closest('#inputFormRow1').remove();
        });

        //add row2
        $(document).on('click', '#addRow2', function() {
            $('#inlineFormInput').empty();
            $.ajax({
                url:"{{route('affiche_departement')}}",
                type:'get',
                success:function(response){

                    var userData=response;
                    for (var $i = 0; $i < userData.length; $i++){
                        $("#inlineFormInput").append('<option value="'+userData[$i].id+'">'+ JSON.stringify(userData[$i].nom_departement)+'</option>');
                    }
                },
                error:function(error){
                    console.log(error);
                }
            });
            $.ajax({
                type: "GET"
                , url: "{{route('affiche_departement')}}"
                , dataType: "html"
                , success: function(response) {
                    var userData = JSON.parse(response);
                    var html = '';
                    html += '<div class="form-row d-flex" id="inputFormRow2">';
                    html += '<div class="col">';
                    html += '<select class="form-select mt-2" id="inlineFormInput" aria-label="Default select example" name = "departement_id[]">';
                    html += ' <option selected>Choisissez le département </option>';
                    for (var $i = 0; $i < userData.length; $i++) {
                        html += ' <option value="'+userData[$i].id+'"> ' + userData[$i].nom_departement + '</option>';
                    }
                    html += ' </select>';
                    html += '</div>';
                    html += '<div class="col mb-2">';
                    html += '<input type="text" class="form-control  mb-2" name="service[]" id="inlineFormInput"  placeholder="Nom de service"   required>';
                    html += '</div>';
                    html += '<div class="col ms-2">';
                    html += '<button id="removeRow2" type="button" class="btn btn-danger mt-2"><i class="fa fa-close style="font-size: 15px;"></i></button>';
                    html += '</div>';
                    html += '</div>';
                    $('#add_column2').append(html);

                }
                , error: function(error) {
                    console.log(error)
                }
            });
        });

        // remove row2
        $(document).on('click', '#removeRow2', function() {
            $(this).closest('#inputFormRow2').remove();
        });

           //add row3
           $(document).on('click', '#addRow3', function() {
            var html = '';
            html += '<div class="form-row d-flex" id="inputFormRow3">';
            html += '<div class="col">';
            html += '<input type="text" class="form-control  mb-2" name="nom_branche[]" id="inlineFormInput3"  placeholder="Nom de la branche"  required>';
            html += '</div>';
            html += '<div class="col ms-2">';
            html += '<button id="removeRow3" type="button" class="btn btn-danger mt-2"><i class="fa fa-close style="font-size: 15px;"></i></button>';
            html += '</div>';
            html += '</div>';
            $('#add_column3').append(html);
        });

        // remove row3
        $(document).on('click', '#removeRow3', function() {
            $(this).closest('#inputFormRow3').remove();
        });

    </script>

    {{-- <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script type="text/javascript">
        // add row
        $(document).on('click', '#addRow', function() {

            var html = '';
            html += '<div class="form-row d-flex" id="inputFormRow">';
            html += '<div class="col">';
            html += ' <input type="text" class="form-control mb-2" id="inlineFormInput" name="nom_cfp[]" placeholder="Nom de déprtement" required />
            ';
            html += '</div>';
            html += '<div class="col ms-2">';
            html += '<button id="removeRow" type="button" class="btn btn-success mt-2"><i class="bx bxs-plus-close nouveau_icon"></i></button>';
            html += '</div></div></div>';

            $('#add_column').append(html);


        });

        // remove row
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
        });

    </script> --}}
