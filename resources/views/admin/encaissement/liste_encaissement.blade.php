@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Encaissement</p>
@endsection
@section('content')
{{-- <link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}

<style>

.pdf_download{
            background-color: #e73827 !important;
        }
        .pdf_download:hover{
            background-color: #af3906 !important;
        }
        .pdf_download button{
            color: #ffffff !important;
        }

    table,
    th {
        font-size: 11px;
    }

    table,
    td {
        font-size: 11px;
    }

    .button_tail {
        font-size: 11px;
    }

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }

    .input_inscription {
        padding: 2px;
        border-radius: 100px;
        box-sizing: border-box;
        color: #9E9E9E;
        border: 1px solid #BDBDBD;
        font-size: 16px;
        letter-spacing: 1px;
        height: 50px !important;
        border: 2px solid #aa076c17 !important;


    }

    .input_inscription:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 2px solid #AA076B !important;
        outline-width: 0 !important;
    }


    .form-control-placeholder {
        position: absolute;
        top: 1rem;
        padding: 12px 2px 0 2px;
        padding: 0;
        padding-top: 2px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        transition: all 300ms;
        opacity: 0.5;
        left: 2rem;
    }

    .input_inscription:focus+.form-control-placeholder,
    .input_inscription:valid+.form-control-placeholder {
        font-size: 95%;
        font-weight: bolder;
        top: 1rem;
        transform: translate3d(0, -100%, 0);
        opacity: 1;
        backgroup-color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        box-shadow: 0 0 0 30px white inset !important;
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

    .status_grise {
        border-radius: 1rem;
        background-color: #637381;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reprogrammer {
        border-radius: 1rem;
        background-color: #00CDAC;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_cloturer {
        border-radius: 1rem;
        background-color: #314755;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reporter {
        border-radius: 1rem;
        background-color: #26a0da;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_annulee {
        border-radius: 1rem;
        background-color: #b31217;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_termine {
        border-radius: 1rem;
        background-color: #1E9600;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_confirme {
        border-radius: 1rem;
        background-color: #2B32B2;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .statut_active {
        border-radius: 1rem;
        background-color: rgb(15, 126, 145);
        color: whitesmoke;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    /* .filter{
    position: relative;
    bottom: .5rem;
    float: right;
} */
    .btn_creer {
        background-color: white;
        border: none;
        border-radius: 30px;
        padding: .2rem 1rem;
        color: black;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .btn_creer a {
        font-size: .8rem;
        position: relative;
        bottom: .2rem;
    }

    .btn_creer:hover {
        background: #6373812a;
        color: blue;
    }

    .btn_creer:focus {
        color: blue;
        text-decoration: none;
    }

    .icon_creer {
        background-image: linear-gradient(60deg, #f206ee, #0765f3);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        position: relative;
        top: .4rem;
        margin-right: .3rem;
    }

    .pagination {
        background-clip: text;
        margin-right: .3rem;
        font-size: 2rem;
        position: relative;
        top: .7rem;
    }

    .pagination:hover {
        color: #000000;
        background-color: rgb(239, 239, 239);
        border-radius: 1.3rem;
    }

    .nombre_pagination {
        color: #626262;

    }

</style>
<div class="container-fluid">

    <div class="m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="{{route('liste_facture')}}" class="nav-link">
                    Retour à la liste des factures
                </a>
            </li>
            @canany(['isCFP'])

            <li class="nav-item ">
                <a class="nav-link pdf_download {{ Route::currentRouteNamed('pdf+liste+encaissement',$numero_fact) ? 'active' : '' }}" href="{{route('pdf+liste+encaissement',$numero_fact)}}">
                    <button class="btn"><i class="bx bxs-file-pdf"></i> PDF </button></a>
            </li>
            @endcanany
        </ul>


        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                {{-- <a href="{{route('liste_facture',2)}}"><button class="btn btn-success">retour</button></a> --}}
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date de paiement</th>
                                            <th scope="col">Libellé</th>
                                            <th scope="col">N° facture</th>
                                            <th scope="col">Montant facturer</th>
                                            <th scope="col">Paiement</th>
                                            <th scope="col">Montant ouvert</th>
                                            <th scope="col">Mode de paiement</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($encaissement as $info)
                                        <tr>
                                            <td>{{ $info->date_encaissement }}</td>
                                            <td>{{ $info->libelle }}</td>
                                            <td> <a href="{{route('detail_facture',$info->num_facture)}}">
                                                    {{ $info->num_facture }}</a>
                                            </td>
                                            <td>{{$devise->reference." ". number_format($info->montant_facture, 0, ',', ' ') }}</td>
                                            <td>{{$devise->reference." ". number_format($info->payement, 0, ',', ' ') }}</td>
                                            <td>{{$devise->reference." ". number_format($info->montant_ouvert, 0, ',', ' ') }}</td>
                                            <td>{{ $info->description }}</td>
                                            <td><button class="button_tail btn btn_creer btn-block mb-2 payement" data-id="{{ $info->id }}" id="{{ $info->id }}" data-bs-toggle="modal" data-bs-target="#modal" style="color: green"><i class="fa fa-edit"></i></button>&nbsp;
                                                <a href="{{ route('supprimer',[$info->id]) }}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet encaissement ?');"><button class="button_tail btn btn_creer btn-block mb-2 supprimer" style="color: red"><span class="fa fa-trash"></span></button></a>
                                            </td>
                                        </tr>


                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    @error('montant')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    @error('libelle')
                    <span style="color: red">{{ $message }}</span>
                    @enderror

                </div>
            </div>

            {{-- debut modal encaissement --}}
            <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content  px-3 py-3">
                        <div class="modal-header">
                            <div class="modal-title text-md">
                                <h5>Modification</h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('modifier_encaissement') }}" method="POST">
                                @csrf
                                <div id="modification"></div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            {{-- fin --}}

        </div>
    </div>

</div>
{{-- </div> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $(".payement").on('click', function(e) {
        $('#modification').html('');
        var id = $(this).data("id");
        $.ajax({
            method: "GET"
            , url: "{{route('page_modification')}}"
            , data: {
                encaissement_id: id
            }
            , dataType: "html"
            , success: function(response) {
                var valiny = JSON.parse(response)[0];
                var html = '';
                html += '<div class="inputbox inputboxP mt-3  mx-1">';
                html += '<div class="row">';
                html += '<div class="col"><span>Date de paiement<strong style="color:#ff0000;">*</strong></span></div>';
                html += '<div class="col">';
                html += '<input type="date" name="date_encaissement" class="form-control formPayement" required style="height: 50px;" value=' + valiny.userData[3] + '>';
                html += '  </div></div>';
                html += '</div>';
                html += '<div class="inputbox inputboxP mt-3   mx-1">';
                html += '<div class="row">';
                html += '<div class="col"><span>Montant à facturer<strong style="color:#ff0000;">*</strong></span></div>';
                html += ' <div class="col">';
                html += '<input autocomplete="off" type="number" min="1" name="montant" value="' + valiny.userData[0] + '" class="form-control formPayement" required style="height: 50px;">';
                html += '  </div></div></div>';
                html += '<input type="hidden" name="encaissement_id" value="' + id + '">';
                html += '<input type="hidden" name="num_facture" value="' + valiny.userData[2] + '">';

                html += '<div class="form-group  mt-3  mx-1">';
                html += '<div class="row">';
                html += '   <div class="col"><span>Mode de paiement<strong style="color:#ff0000;">*</strong></span> </div>';
                html += '<div class="col">';
                html += '<select class="form-select selectP" name="mode_payement" aria-label="Default select example" style="height: 50px;">';
                html += '<option value="' + valiny.mode_finance_edit.id + '" selected>' + valiny.mode_finance_edit.description + '</option>';

                var tab = valiny.mode_finance_list;
                for (var i = 0; i < tab.length; i += 1) {
                    html += '<option value="' + tab[i].id + '">' + tab[i].description + '</option>';
                }
                html += ' </select> </div></div></div>';
                html += '<div class="inputbox inputboxP mt-2  mx-1"><span>Memo/Notes</span>';
                if (valiny.userData[1] != null) {
                    html += '<textarea autocomplete="off" name="libelle" class="text_description form-control"  rows="5">' + valiny.userData[1] + '</textarea> </div>';
                } else {
                    html += '<textarea autocomplete="off" name="libelle" class="text_description form-control"  rows="5"></textarea> </div>';

                }
                html += '<div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>';
                html += '<button type="submit" class="btn btn_creer px-3">Modifier</button>';
                /*        html += '<textarea  autocomplete="off" name="libelle" id="libelle" class="text_description form-control"  rows="5">' + valiny.userData[1] + '</textarea>';
                        html += '<div class="inputbox inputboxP mt-3">';
                        html += '<span>Montant à enaisser</span>';
                        html += '<input autocomplete="off" type="number" min="1" pattern="[0-9]" name="montant" class="form-control formPayement" value="' + valiny.userData[0] + '" required style="height: 50px;"><br>';
                        html += '<input type="hidden" name="encaissement_id" value="' + id + '">';
                        html += '<input type="hidden" name="num_facture" value="' + valiny.userData[2] + '">';
                        html += '</div>';
                        html += '<div class="form-group  mt-3">';
                        html += '<span>Mode de paiement<strong style="color:#ff0000;">*</strong></span>';
                        html += '<select class="form-select selectP" name="mode_payement" id="mode_payement" aria-label="Default select example" style="height: 50px;">';
                        html += '<option value="' + valiny.mode_finance_edit.id + '" selected>' + valiny.mode_finance_edit.description + '</option>';
                        var tab = valiny.mode_finance_list;
                        for (var i = 0; i < tab.length; i += 1) {
                            html += '<option value="' + tab[i].id + '">' + tab[i].description + '</option>';
                        }
                        html += '</select>';
                        html += '</div>';
                        html += '<div class="inputbox inputboxP mt-3">';
                        html += '<span>Date de paiement<strong style="color:#ff0000;">*</strong></span>';
                        html += '<input type="date" name="date_encaissement" class="form-control formPayement" required="required" style="height: 50px;" value=' + valiny.userData[3] + '>';
                        html += '</div>';
                        html += '<div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>';
                        html += '<button type="submit" class="btn btn_creer px-3">Modifier</button>'; */
                $("#modification").append(html);
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

</script>
@endsection
