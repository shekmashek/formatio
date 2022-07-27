@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">employés</p>
@endsection
@section('content')
    <style>
        table,
        th {
            font-size: 11px;
        }

        table,
        td {
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

        .color-text-trie {
            color: blue;
        }

        .navigation_module .nav-link {
            color: #637381;
            padding: 5px;
            cursor: pointer;
            font-size: 0.900rem;
            transition: all 200ms;
            margin-right: 1rem;
            text-transform: uppercase;
            padding-top: 10px;
            border: none;
        }

        .nav-item .nav-link.active {
            border-bottom: 3px solid #7635dc !important;
            border: none;
            color: #7635dc
        }

        .nav-tabs .nav-link:hover {
            background-color: rgb(245, 243, 243);
            transform: scale(1.1);
            border: none;
        }

        .nav-tabs .nav-item a {
            text-decoration: none;
            text-decoration-line: none;
        }

        #modifTable_length label, #modifTable_length select, #modifTable_filter label, .pagination, .headEtp, .dataTables_info, .dataTables_length, .headProject {
            font-size: 13px;
        }

        #example_length select{
            height: 25px;
            font-size: 13px;
            vertical-align: middle;
        }
    </style>

    <div class="container-fluid">
        <div class="m-4">
            <div class="mt-4">
                <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                    <li class="nav-item">
                        <a href="{{route('employes.liste')}}" class="nav-link">
                            employés
                        </a>
                    </li>
                    @canany(['isReferent','isReferentSimple'])
                        <li class="nav-item">
                            <a href="{{route('employes.new')}}" class="nav-link">
                                nouveau employé
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employes.export.nouveau')}}" class="nav-link">
                                import EXCEL employé
                            </a>
                        </li>
                    @endcanany
                    <li class="nav-item">
                        <a href="{{route('employes.export.nouveau')}}" class="nav-link active">
                        Référents
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 mt-2">
                <table  id="modifTable" class="table">
                    <thead style="position: sticky; top: 0; background: #c7c9c939">
                        <tr>
                            <th class="id">ID</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Employé</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Contacts</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">
                                <span class="d-block">Département</span>
                                <span>Service</span>
                            </th>
                            @can('isReferent')
                                <th scope="col" class="table-head font-weight-light align-middle text-center">Référent Principal</th>
                            @endcan
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employers as $employe)
                            <tr >
                                <td class="align-middle id empNew" data-id={{$employe->user_id}} id={{$employe->user_id}} onclick="afficherInfos();" style="cursor: pointer">
                                    @if ($employe->activiter == 1)
                                        <span style="color:#00b900; "> <i class="bx bxs-circle"></i> </span>
                                    @else
                                        <span style="color:red; "> <i class="bx bxs-circle"></i> </span>
                                    @endif
                                    {{ $employe->matricule }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($employe->photos == null)
                                            <div class="randomColor rounded-circle p-3 mb-2 profile-circle" >
                                                <span class="align-middle text-center profile-initial" style="position:relative;">
                                                    <b data-id={{$employe->user_id}} id={{$employe->user_id}} onclick="afficherInfos();" class="empNew" style="cursor: pointer">{{substr($employe->nom_resp, 0, 1)}} {{substr($employe->prenom_resp, 0, 1)}}</b>
                                                </span>
                                            </div>
                                        @else
                                            <img data-id={{$employe->user_id}} id={{$employe->user_id}} onclick="afficherInfos();" src="{{ asset('images/employes/' . $employe->photos) }}"
                                            alt="Image non chargée" style="width: 45px; height: 45px; cursor: pointer"
                                            class="rounded-circle empNew" />
                                        @endif
                                        <div class="ms-3">
                                            <p class="fw-normal mb-1 text-purple empNew" data-id={{$employe->user_id}} id={{$employe->user_id}} onclick="afficherInfos();" style="cursor: pointer">
                                            {{-- <p class="fw-bold mb-1 text-purple "> --}}
                                                {{ $employe->nom_resp }} {{ $employe->prenom_resp }}</p>
                                            <p class="text-muted mb-0 empNew" data-id={{$employe->user_id}} id={{$employe->user_id}} onclick="afficherInfos();" style="cursor: pointer">{{ $employe->fonction_resp }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-start empNew" data-id={{$employe->user_id}} id={{$employe->user_id}} onclick="afficherInfos();" style="cursor: pointer">
    
                                    <div class="ms-3">
                                        <p class="mb-1 text-purple">{{ $employe->email_resp }}</p>
                                        <p class="text-muted mb-0">
                                            {{ $employe->telephone_resp != null ? $employe->telephone_resp : '----' }}
                                        </p>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-secondary">
                                    <p class="text-muted mb-0">
                                        {{ $employe->nom_departement != null ? $employe->nom_departement : '----' }} <br>
                                        {{ $employe->nom_service != null ? $employe->nom_service : '----' }} <br>
                                    </p>
                                </td>
                                @can('isReferent')
                                    <td class="align-middle text-center text-secondary">
                                        @if($employe->activiter == 1)
                                            @if($employe->prioriter == 1)
                                            <span desabled title="Référent principal" role="button"  class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center">
                                                <i desabled class='bx bxs-star'></i>
                                            </span>
                                            @else
                                            <span data-bs-toggle="modal" data-bs-target="#principal_{{$employe->id }}"  title="Référent" role="button"  class="td_hover" style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168)" align="center">
                                                <i desabled class='bx bxs-star'></i>
                                            </span>
                                            @endif
                                        @endif
                                        @if($employe->activiter == 0)
                                            <span disabled  title="Référent" role="button"  class="td_hover" style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168)" align="center">
                                                <i desabled class='bx bxs-star'></i>
                                            </span>
                                        @endif
                                    </td>
                                @endcan
                                <td class="align-middle text-center text-secondary">
                                    @if ($employe->activiter == 1)
                                        <div class="form-check form-switch">
                                            <label class="form-check-label" for="flexSwitchCheckChecked"><span
                                                    class="badge bg-success">actif</span></label>
                                        </div>
                                    @else
                                        <div class="form-check form-switch">
                                            <label class="form-check-label"
                                                for="flexSwitchCheckChecked">
                                                <span class="badge bg-danger">
                                                    inactif
                                                </span>
                                            </label>
                                        </div>
                                    @endif
    
                                </td>
                            </tr>
    
                            <div class="modal fade" id="principal_{{$employe->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center"
                                                style="background-color:rgb(57, 134, 241);">
                                                <h4 class="modal-title text-white">Confirmation !</h4>
    
                                            </div>
                                            <div class="modal-body">
                                                <small>Vous êtes sur le point de designer cette personne comme référent principal?
                                                    </small>
                                            </div>
    
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non
                                                </button>
    
                                                <a href="{{ route('employes.ajouter.referent_principal', $employe->id) }}"> <button
                                                        type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                                            </div>
                                        </div>
                                    </div>
    
                            </div>
                        @empty
    
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('js/index2.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $(document).ready(function () {
            $('#modifTable thead tr:eq(1) th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" class="column_search form-control form-control-sm" style="font-size:13px;"/>' );
                // $(this).html( '<input type="text" placeholder="Afficher par '+title+'" class="column_search form-control form-control-sm" style="font-size:13px;"/>' );
                $( "th#hideAction > input" ).prop( "disabled", true ).attr( "placeholder", "" );
                $( "th#hideDate > input" ).prop( "disabled", true ).attr( "placeholder", "" );
                $( "th#hideVille > input" ).prop( "disabled", true ).attr( "placeholder", "" );
            } );

            function searchByColumn(table){
                var defaultSearch = 0;

                $(document).on('change keyup', '#select-column', function(){
                    defaultSearch = this.value; 
                });

                $(document).on('change keyup', '#search-by-column', function(){
                    table.search('').column().search('').draw();
                    table.column(defaultSearch).search(this.value).draw();
                });
            }
            
            $( '#modifTable thead'  ).on( 'keyup', ".column_search",function () {
        
                table
                    .column( $(this).parent().index() )
                    .search( this.value )
                    .draw();
            } );

            var table = $('#modifTable').removeAttr('width').DataTable({
                initComplete : function() {
                    $("#myDatatablesa_filter").detach().appendTo('#new-search-area');
                },
                scrollY:        "500px",
                // scrollX:        true,
                // scrollCollapse: true,
                orderCellsTop: true,
                fixedHeader: true,
                "language": {
                    "paginate": {
                    "previous": "précédent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun résultat trouvé",
                    "infoEmpty":      " 0 trouvés",
                    "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoFiltered":   "(filtre sur _MAX_ entrées)",
                    "lengthMenu":     "Affichage _MENU_ ",
                }
            });
            
            $('input:checkbox').on('change', function () {
                var Projet = $('input:checkbox[name="Projet"]:checked').map(function() {
                    return '^' + this.value + '$';
                }).get().join('|');
                
                table.column(0).search(Projet, true, false, false).draw(false);

                var Session = $('input:checkbox[name="session"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(1).search(Session, true, false, false).draw(false);

                var Entreprise = $('input:checkbox[name="entreprise"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(3).search(Entreprise, true, false, false).draw(false);

                var Modalite = $('input:checkbox[name="modalite"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(4).search(Modalite, true, false, false).draw(false);
                
                var TypeFormation = $('input:checkbox[name="typeFormation"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(8).search(TypeFormation, true, false, false).draw(false);
                
                var Module = $('input:checkbox[name="module"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(2).search(Module, true, false, false).draw(false);
                
                var Statut = $('input:checkbox[name="statut"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(7).search(Statut, true, false, false).draw(false);
            
            });

            searchByColumn(table);
        }); 

        $('.referent').click(function() {
            $('#delete_emp').modal("show");
        })   
    </script>
@endsection

