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

    <div class="row my-5 w-100">

        <div class="col-md-2"></div>

        <div class="col-md-8">
            <h4>Formateurs</h4>
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
                            <button type="submit" class="btn btn-primary mt-3">inviter</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="col-md-2"></div>

    </div>

    <div class="row  mb-5">

        <div class="col-md-3">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-2">
                            <li class="nav-item  mx-2">
                                    <div>
                                        <a  href="#demmandes" data-toggle="collapse" aria-expanded="false"  class="new_list_nouvelle {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}">
                                            <span>Demmandes</span>
                                        </a>
                                    </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="collapse lisst-unstyled " id="demmandes">
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
                                                <a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>annuler </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-2">
                            <li class="nav-item  mx-2">
                                    <div>
                                        <a  href="#totale_invitations" data-toggle="collapse" aria-expanded="false"  class="new_list_nouvelle {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}">
                                            <span>Totales des Invitations</span>
                                        </a>
                                    </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="collapse lisst-unstyled " id="totale_invitations">
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
                                        <td>
                                            <div align="rigth">
                                                <a href="#" style="color: green"><i class="bx bxs-check-circle actions" title="Details"></i>accepter </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3">


            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-2">
                            <li class="nav-item  mx-2">
                                <div>
                                    <a href="#invitations_refuser" data-toggle="collapse" aria-expanded="false" class="new_list_nouvelle {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}" href="{{route('nouvelle_formation')}}">
                                        <span>Invitations réfuser</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>


        <div class="collapse lisst-unstyled " id="invitations_refuser">
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
                                            <strong style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </strong>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <div class="col-md-2">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-2">


                            <li class="nav-item  mx-2">
                                <div>
                                    <a  href="#invitations_accepter" data-toggle="collapse" aria-expanded="false" class="new_list_nouvelle " >
                                        <span>Invitations acceptés</span>
                                    </a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>


        <div class="collapse lisst-unstyled " id="invitations_accepter">
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

        </div>
    </div>



</div>


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table_frmt').DataTable();
    });

</script>
@endsection
