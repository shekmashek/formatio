@extends('./layouts/admin')
@section('content')
<div class="container-fluid justify-content-center pb-3">

    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
        @endif
    </div>


    <style type="text/css">
        /* h1 {

            font-size: 80%;
            }
            h2 {

            font-size: 80%;
            } */
        button,value{
            font-size: 12px;
        }
        strong{
            font-size: 12px;
        }
        li{
            font-size: 12px;
        }
        h3 {

            font-size: 12px;
        }

        h4 {

            /* font-size: 90%; */
            font-size: 13px;
        }

        h5 {

            font-size: 10px;
        }

        h6 {

            font-size: 10px;
        }

        p {

            font-size: 12px;
        }

    </style>


    <div class="row my-5 w-100">

                <div class="col-md-4">
                    <div class="card my-5">
                    <div class="card-body">
                        <h4>Formateurs  déjà collaborer</h4>

                        <div class="table-responsive text-center">
                            <table class="table  table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>ANTOENJARA Noam Francisco</strong>
                                                <p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="rigth">
                                                <strong><i class="bx bx-user-check"></i></strong>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-7">

            <div class="card my-5">
                <div class="card-body">

            <h4>Inviter un Formateur</h4>
            <p>
                Pour travailler avec un formateur,il suffit simplement de se collaborer.
                La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail</strong>".
            </p>

            <form class="form">

                <div class="row">
                    <div class="col">
                        <label class="sr-only" for="inlineFormInput">Nom <strong style="color: red">*</strong></label>
                        <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Nom"/>
                    </div>
                    <div class="col">
                        <label class="sr-only" for="inlineFormInput">Email</label>
                        <input type="email" class="form-control  mb-2" id="inlineFormInput" placeholder="Adresse mail"/>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-3">envoyer l'invitation</button>
                        </div>
                    </div>
                </div>
            </form>


            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                            <li class="nav-item">
                                <div>
                                    <a  href="#totale_invitations" id="totale_invitations"   class="new_list_nouvelle  ? 'active' : '' }}">
                                        <span>Totales des Invitations</span>
                                    </a>
                                    {{-- <a  href="#totale_invitations" id="totale_invitations" data-toggle="collapse" aria-expanded="false"  class="new_list_nouvelle {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}">
                                        <span>Totales des Invitations</span>
                                    </a> --}}
                                </div>
                            </li>
                            <li class="nav-item  mx-2">
                                <div>
                                    <a href="#invitations_refuser" id="invitations_refuser" data-toggle="collapse" aria-expanded="false" class="new_list_nouvelle {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}" href="{{route('nouvelle_formation')}}">
                                        <span>Invitations réfuser</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

            {{-- <div class="collapse lisst-unstyled " id="totale_invitations"> --}}
                <div class="card my-5">
                    <div class="card-body">
                        <div class="table-responsive text-center">

                            <table class="table  table-borderless table-sm">
                                <tbody id="data_collaboration">
                                    {{-- <tr>
                                        <td>
                                            <div align="left">
                                                <strong>ANTOENJARA Noam Francisco</strong>
                                                <p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="rigth">
                                                <a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="rigth">
                                                <a href="#" style="color: green"><i class="bx bxs-check-circle actions" title="Details"></i>accepter </a>
                                            </div>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>

                            {{-- <table class="table  table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>ANTOENJARA Noam Francisco</strong>
                                                <p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="rigth">
                                                <a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="rigth">
                                                <a href="#" style="color: green"><i class="bx bxs-check-circle actions" title="Details"></i>accepter </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> --}}
                        </div>
                    </div>
                </div>
            {{-- </div> --}}

            {{-- <div class="collapse lisst-unstyled " id="invitations_refuser">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="table-responsive text-center">
                            <table class="table  table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>ANTOENJARA Noam Francisco</strong>
                                                <p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="rigth">
                                                <a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}

                </div>
            </div>


        </div>


    </div>




</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">


    $("#totale_invitations").on('click', function(e) {
        $('#data_collaboration').empty();

                var html = '';
                html +=' <tr>';
                html += '<td><div align="left">';
                html += '<strong>ANTOENJARA Noam Francisco</strong>';
                html += '<p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>';
                html += '</div></td>';

                html += '<td><div align="rigth">';
                html += '<a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>';
                html += '</div></td>';

                html += '<td><div align="rigth">';
                html += '<a href="#" style="color: green"><i class="bx bxs-check-circle actions" title="Details"></i>accepter </a>';
                html += '</div></td>';

                $('#data_collaboration').append(html);



        // $.ajax({
        //     method: "GET"
        //     , url: "{{route('edit_projet')}}"
        //     , data: {
        //         Id: id
        //     }
        //     , dataType: "html"
        //     , success: function(response) {

        //         var userData = JSON.parse(response);
        //         for (var $i = 0; $i < userData.length; $i++) {
        //             $("#projetModif").val(userData[$i].nom_projet);

        //             $('#id_value').val(userData[$i].id);

        //         }
        //     }
        //     , error: function(error) {
        //         console.log(error)
        //     }
        // });
    });

    $("#invitations_refuser").on('click', function(e) {
        $('#data_collaboration').empty();

            var html = '';
            html +=' <tr>';
            html += '<td><div align="left">';
            html += '<strong>ANTOENJARA Noam Francisco</strong>';
            html += '<p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>';
            html += '</div></td>';

            html += '<td><div align="rigth">';
            html += '<a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>';
            html += '</div></td>';

            $('#data_collaboration').append(html);



        // $.ajax({
        //     method: "GET"
        //     , url: "{{route('edit_projet')}}"
        //     , data: {
        //         Id: id
        //     }
        //     , dataType: "html"
        //     , success: function(response) {

        //         var userData = JSON.parse(response);
        //         for (var $i = 0; $i < userData.length; $i++) {
        //             $("#projetModif").val(userData[$i].nom_projet);

        //             $('#id_value').val(userData[$i].id);

        //         }
        //     }
        //     , error: function(error) {
        //         console.log(error)
        //     }
        // });
    });

</script>
@endsection
