@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Departement / Sérvice</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/departement_service.css')}}">

    {{-- <style type="text/css">
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
 --}}
<style>
      .btn-label {
	position: relative;
	left: -12px;
	display: inline-block;
	padding: 6px 12px;
	background: rgba(0, 0, 0, 0.15);
	border-radius: 3px 0 0 3px;
        }

    .btn-labeled {
	padding-top: 0;
	padding-bottom: 0;
    }

    .btn {
	margin-bottom: 10px;
    }
    .save1{
        display: none;
    }
    .save2{
        display: none;
    }
    .save3{
        display: none;
    }
    /*modal*/
    
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<div class="container-fluid pb-1">

    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i
            class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item active">
                <a href="#departements" class="nav-link active" data-toggle="tab">Départements</a>
            </li>
            <li class="nav-item">
                <a href="#services" class="nav-link" data-toggle="tab">Services</a>
            </li>
            <li class="nav-item">
                <a href="#branches" class="nav-link" data-toggle="tab">Branches</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="departements">
                <div class="container-fluid p-0 mt-3 ">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="p-3 mb-5 bg-body rounded ">
                                <h5>Départements</h5>
                                <hr>
                                <div class="table-responsive text-center mt-0">
                                    <table class="table  table-borderless table-sm ">
                                        <tbody id="data_collaboration " >
                                            @if (count($rqt)>0)
                                            @if(isset($rqt))
                                                @for($i = 0; $i < count($rqt); $i++) <p>
                                            <tr >
                                                <td >
                                                    <div align="left">
                                                        
                                                            <span>{{$rqt[$i]->nom_departement}}</span></p>
                                                            
                                                    </div>
                                                </td>
                                                <td>     
                                                </td>
                                                <td>
                                                  
                                                 <a href="" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal_{{$rqt[$i]->id}}"  class="btn btn-labeled btn-success">
                                                            {{-- <i class='bx  bx-edit bx_modifier'></i> --}}

                                                    <span class="btn-label"><i class='bx  bx-edit bx_modifier'></i></span>Modifier</a>
                                                    <a href=""  data-bs-toggle="modal" data-bs-target="#deletedep_{{$rqt[$i]->id}}" type="button" class="btn btn-labeled btn-danger">
                                                    <span class="btn-label"><i class='bx  bx-trash bx_supprimer' ></i></span>Supprimer</a>
                                                </td> 
                                            </tr>
                                            {{-- modal edit departement --}}
                                            <div class="modal fade" id="exampleModal_{{$rqt[$i]->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1>Modification</h1>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('update_departement')}}"  method="post">
                                                                @csrf
                                                                <label for=""> Département</label>
                                                                <input type="text" class="form-control" required name="departement" value="{{$rqt[$i]->nom_departement}}">
                                                                <input type="hidden" class="form-control" required name="id" value="{{$rqt[$i]->id}}"> <br><br>
                                                                
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; Annuler</button>
                                                                <button type="submit" class="btn btn_enregistrer">&nbsp; Enregistrer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                   {{-- modal delete departement --}}
                                                   <div class="modal fade" id="deletedep_{{$rqt[$i]->id}}" tabindex="-1" role="dialog"
                                                   aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered" role="document">
                                                       <div class="modal-content">
                                                           <div class="modal-header d-flex justify-content-center"
                                                               style="background-color:rgb(224,182,187);">
                                                               <h6 class="modal-title text-white">Avertissement !</h6>
                                                           </div>
                                                           <div class="modal-body">
                                                               <small>Vous êtes sur le point d'effacer une donnée, cette action
                                                                   est irréversible. Continuer ?</small>
                                                           </div>
                                                           <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary"
                                                                   data-bs-dismiss="modal"> Non </button>
                                                               <form action="{{route('delete_departement',$rqt[$i]->id)}}" method="get">
                                                                   @csrf
                                                                   <button type="submit" class="btn btn-secondary"> Oui
                                                                   </button>
                                                                   <input name="cfp_id" type="text" value="test" hidden>
                                                               </form>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                            @endfor
                                            @endif
                                      
                                            @else
                                            <tr>
                                                <td colspan="3"> Aucun département pour l'entreprise</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="p-3 mb-5 bg-body rounded ">
                                {{-- <h4>Ajouter département</h4> --}}
                                <form class="form form_colab" action="{{ route('departement.store') }}" method="POST">
                                    @csrf
                                    <div class="form-row d-flex">
                                        {{-- <div class="col">
                                            <input type="text" class="form-control mb-2" id="inlineFormInput"
                                                name="departement[]" placeholder="Nom de département" required />
                                        </div> --}}
                                        <div class="col ms-2">
                                            {{-- <button type="button" class="btn btn-success mt-2" id="addRow1"><i
                                                    class='bx bxs-plus-circle'></i></button> --}}
                                                    <button type="button" class="btn btn-labeled btn-success affiche_btn1" id="addRow1">
                                                        <span class="btn-label"><i class="bx bxs-plus-circle"></i></span>Ajouter département</button>
                                                        {{-- <button type="button" class="btn btn-labeled btn-danger">
                                                        <span class="btn-label"><i class="fa fa-remove"></i></span>Cancel</button> --}}
                                        </div>
                                    </div>
                                    <div id="add_column"></div>
                                    <button type="submit" class="btn btn_enregistrer mt-2 save1" >Sauvegarder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane show fade" id="services">
                <div class="container-fluid p-0 mt-3 ">
                    <div class="row">
                        <div class="col-md-5">
                            <div class=" p-3 mb-5 bg-body rounded ">
                                <h5>Services</h5>
                                <hr>
                                <div class="table-responsive text-center  mt-0">
                                    <table class="table  table-borderless table-sm">
                                        <tbody id="data_collaboration">
                                            @if (count($service_departement)>0)

                                            <tr>
                                                <td>
                                                    <div align="left">
                                                        @if(isset($service_departement))
                                                        @for($i = 0; $i < $nb_serv; $i++) <h6>
                                                            <strong>{{$service_departement[$i]->nom_departement}}</strong>
                                                            </h6>
                                                            <div class="row">
                                                              
                                                                <div class="col-md-5 ms-2">
                                                                    <span >
                                                                        
                                                                        @php
                                                                            echo str_replace(',',' <br> ',$service_departement[$i]->nom_service);
                                                                        @endphp 
                                                                       
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1" style="white-space: nowrap">
                                                                    <a type="button" class="btn btn-labeled btn-success" href="" data-bs-toggle="modal" data-bs-target="#example_{{$service_departement[$i]->departement_entreprise_id}}"><span class="btn-label"><i class='bx  bx-edit bx_modifier'></i></span>Modifier</a>
                                                                    <a type="button" class="btn btn-labeled btn-danger" href="" data-bs-toggle="modal" data-bs-target="#deleteserve_{{$service_departement[$i]->departement_entreprise_id}}"><span class="btn-label"><i class='bx  bx-trash bx_supprimer' ></i></span>Supprimer</a>

                                                                </div>
                                                            </div>
                                                        {{-- modal edit service --}}
                                                            <div class="modal fade" id="example_{{$service_departement[$i]->departement_entreprise_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1>Modification</h1>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{route('update_service')}}"  method="post">
                                                                                @csrf
                                                                                <input type="hidden" name="departement" value="{{$service_departement[$i]->departement_entreprise_id}}">
                                                                                <label for=""> Service(s)</label>
                                                                                @foreach ($service_departement_tous as $sd)
                                                                                    @if ($sd->departement_entreprise_id == $service_departement[$i]->departement_entreprise_id)
                                                                                        <input type="text" class="form-control mt-2" required name="service[{{ $sd->service_id }}]" value="{{$sd->nom_service}}">
                                                                                    @endif
                                                                                    
                                                                                @endforeach
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; Annuler</button>
                                                                                    <button type="submit" class="btn btn_enregistrer">&nbsp; Enregistrer</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- modal delete service --}}
                                                            <div class="modal fade" id="deleteserve_{{$service_departement[$i]->departement_entreprise_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1>Suppression</h1>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{route('delete_service')}}"  method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="departement" value="{{$service_departement[$i]->departement_entreprise_id}}">
                                                                                <label > Selectionner les elements à supprimer</label><br>
                                                                                @foreach ($service_departement_tous as $sd)
                                                                                    @if ($sd->departement_entreprise_id == $service_departement[$i]->departement_entreprise_id)
                                                                                    
                                                                                    <br><span class="mx-5"><input type="checkbox" name="ids[{{$sd->service_id}}]" value="{{$sd->service_id}}" >
                                                                                        <label for="scales">{{$sd->nom_service}}</label></span>
                                                                                    
                                                                                    @endif
                                                                                @endforeach
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; Annuler</button>
                                                                                    <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class='bx  bx-trash bx_supprimer' ></i></span>Supprimer</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                {{-- <div class="modal fade" id="deleteserve_{{$service_departement[$i]->service_id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex justify-content-center"
                                                            style="background-color:rgb(224,182,187);">
                                                            <h6 class="modal-title text-white">Avertissement !</h6>
                                                        </div>
                                                        <div class="modal-body">
                                                            <small>Vous êtes sur le point d'effacer une donnée, cette action
                                                                est irréversible. Continuer ?</small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal"> Non </button>
                                                            <form action="{{route('delete_service',$service_departement[$i]->service_id)}}" method="get">
                                                                @csrf
                                                                <button type="submit" class="btn btn-secondary"> Oui
                                                                </button>
                                                                <input name="cfp_id" type="text" value="test" hidden>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div> --}}
                                                @endfor
                                                @endif
                                                </tr>
                                                
                                                </div>
                                                @else
                                                <tr>
                                                <td colspan="3"> Aucun service pour l'entreprise</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class=" p-3 mb-5 bg-body rounded ">
                                {{-- <h4>Ajouter service</h4> --}}
                                <form name="formInsert" id="formInsert" action="{{route('enregistrement_service')}}"
                                    method="POST" enctype="multipart/form-data" onsubmit="return validateForm();"
                                    class="form_colab">
                                    @csrf
                                    <div class="form-row d-flex">
                                        {{-- <div class="col mb-2">
                                            <select class="form-select mt-2" id="inlineFormInput"
                                                aria-label="Default select example" name="departement_id[]">
                                                <option selected>Choisissez le département </option>
                                                @if(isset($rqt))
                                                @for($i = 0; $i < $nb; $i++) <option value="{{$rqt[$i]->id}}">
                                                    {{$rqt[$i]->nom_departement}}</option>
                                                    @endfor
                                                    @endif
                                            </select>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control mb-2" id="inlineFormInput"
                                                name="service[]" placeholder="Nom de service" required />
                                        </div> --}}
                                        <div class="col ms-2">
                                            <button type="button" class="btn btn-labeled btn-success affiche_btn2" id="addRow2" >
                                                <span class="btn-label"><i class="bx bxs-plus-circle"></i></span>Ajouter service</button>
                                            {{-- <button type="button" class="btn btn-success mt-2" id="addRow2"><i
                                                    class='bx bxs-plus-circle'></i></button> --}}
                                        </div>
                                    </div>
                                    <div id="add_column2"></div>
                                    <button type="submit" class="btn btn_enregistrer mt-2 save2">Sauvegarder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane show fade" id="branches">
                <div class="container-fluid p-0 mt-3 ">
                    <div class="row">
                        <div class="col-md-5">
                            <div class=" p-3 mb-5 bg-body rounded ">
                                <h5>Branche</h5>
                                <hr>
                                <div class="table-responsive mt-0">
                                    <table class="table  table-borderless table-sm">
                                        <tbody id="data_collaboration">
                                            @if (count($branches)>0)
                                            @if(isset($branches))
                                            @for($i = 0; $i < $nb_branche; $i++) 
                                            <tr>
                                                <td>
                                                    <p class="ms-0">
                                                        <span>{{$branches[$i]->nom_branche}}</span></p>
                                                       
                                                </td>
                                                <td>
                                                    <a href="" type="button"  data-bs-toggle="modal" data-bs-target="#Modal_{{$branches[$i]->id}}"type="button" class="btn btn-labeled btn-success">
                                                        <span class="btn-label"><i class='bx  bx-edit bx_modifier'></i></span>Modifier</a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#deletebranche_{{$branches[$i]->id}}" type="button" class="btn btn-labeled btn-danger">
                                                        <span class="btn-label"><i class='bx  bx-trash bx_supprimer'></i></span>Supprimer</a>
                                                   <span></span></a>

                                            </td>
                                               
                                            </tr>
                                            {{-- modal edit branche --}}
                                            <div class="modal fade" id="Modal_{{$branches[$i]->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1>Modification</h1>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('update_branche')}}"  method="post">
                                                                @csrf
                                                                <label for="">Branche</label>
                                                                <input type="text" class="form-control" required name="branche" value="{{$branches[$i]->nom_branche}}">
                                                                <input type="hidden" class="form-control" required name="id" value="{{$branches[$i]->id}}"> <br><br>
                                                                
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; Annuler</button>
                                                                <button type="submit" class="btn btn_enregistrer">&nbsp; Enregistrer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                       {{-- modal delete branche--}}
                                                       <div class="modal fade" id="deletebranche_{{$branches[$i]->id}}" tabindex="-1" role="dialog"
                                                       aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                                           <div class="modal-content">
                                                               <div class="modal-header d-flex justify-content-center"
                                                                   style="background-color:rgb(224,182,187);">
                                                                   <h6 class="modal-title text-white">Avertissement !</h6>
                                                               </div>
                                                               <div class="modal-body">
                                                                   <small>Vous êtes sur le point d'effacer une donnée, cette action
                                                                       est irréversible. Continuer ?</small>
                                                               </div>
                                                               <div class="modal-footer">
                                                                   <button type="button" class="btn btn-secondary"
                                                                       data-bs-dismiss="modal"> Non </button>
                                                                   <form action="{{route('delete_branche',$branches[$i]->id)}}" method="get">
                                                                       @csrf
                                                                       <button type="submit" class="btn btn-secondary"> Oui
                                                                       </button>
                                                                       <input name="cfp_id" type="text" value="test" hidden>
                                                                   </form>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                            @endfor
                                            @endif
                                            @else
                                            <tr>
                                                <td colspan="3"> Aucun branche pour l'entreprise</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="p-3 mb-5 bg-body rounded ">
                                {{-- <h4>Ajouter branche</h4> --}}
                                <form name="formInsert" id="formInsert" action="{{route('enregistrement_branche')}}"
                                    method="POST" enctype="multipart/form-data" onsubmit="return validateForm();"
                                    class="form_colab">
                                    @csrf
                                    <div class="form-row d-flex">
                                        {{-- <div class="col">
                                            <input type="text" class="form-control mb-2" id="inlineFormInput3"
                                                name="nom_branche[]" placeholder="Nom de la branche" required />
                                        </div> --}}
                                        <div class="col ms-2">
                                            {{-- <button type="button" class="btn btn-success mt-2" id="addRow3"><i
                                                    class='bx bxs-plus-circle'></i></button> --}}
                                                    <button type="button" class="btn btn-labeled btn-success affiche_btn3" id="addRow3">
                                                    <span class="btn-label"><i class="bx bxs-plus-circle"></i></span>Ajouter branche</button>
                                        </div>
                                    </div>
                                    <div id="add_column3"></div>
                                    <button type="submit" class="btn btn_enregistrer mt-2 save3">Sauvegarder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('activeTab', lien);
    });
    let activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
    //add row1
    $(document).on('click', '#addRow1', function() {
        var html = '';
        html += '<div class="form-row d-flex" id="inputFormRow1">';
        html += '<div class="col">';
        html += '<input type="text" class="form-control  mb-2" name="departement[]" id="inlineFormInput"  placeholder="Nom de département"  required>';
        html += '</div>';
        html += '<div class="col ms-2">';
        html += ' <button id="removeRow1" type="button" class="btn btn-labeled btn-danger"> <span class="btn-label"><i class="bx bx-x"></i></span>Annuler</button>';
        
        // html += '<button id="removeRow1" type="button" class="btn btn-danger mt-2"><i class="fa fa-close style="font-size: 15px;"></i></button>';
        html += '</div>';
        html += '</div>';
        $('#add_column').append(html);
    });

    // remove row1
    $(document).on('click', '#removeRow1', function() {
        $(this).closest('#inputFormRow1').remove();
        var input= $('#inlineFormInput');
        if(input.length<=0){
            $(".save1").hide();
        }
    });

    //add row2
    $(document).on('click', '#addRow2', function() {
        $('#inlineFormInput').empty();
        $.ajax({
            url: "{{route('affiche_departement')}}"
            , type: 'get'
            , success: function(response) {

                var userData = response;
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#inlineFormInput").append('<option value="' + userData[$i].id + '">' + JSON.stringify(userData[$i].nom_departement) + '</option>');
                }
            }
            , error: function(error) {
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
                    html += ' <option value="' + userData[$i].id + '"> ' + userData[$i].nom_departement + '</option>';
                }
                html += ' </select>';
                html += '</div>';
                html += '<div class="col mb-2">';
                html += '<input type="text" class="form-control mt-2 mb-2 ms-1" name="service[]" id="inlineFormInput"  placeholder="Nom de service"   required>';
                html += '</div>';
                html += '<div class="col ms-2">';
                // html += '<button id="removeRow2" type="button" class="btn btn-danger mt-2"><i class="fa fa-close style="font-size: 15px;"></i></button>';
                html += ' <button id="removeRow2" type="button" class="btn btn-labeled btn-danger mt-2"> <span class="btn-label"><i class="bx bx-x"></i></span>Annuler</button>';

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
        var input= $('#inlineFormInput');
        if(input.length<=0){
            $(".save2").hide();
        }
    });

    //add row3
    $(document).on('click', '#addRow3', function() {
        var html = '';
        html += '<div class="form-row d-flex" id="inputFormRow3">';
        html += '<div class="col">';
        html += '<input type="text" class="form-control  mb-2" name="nom_branche[]" id="inlineFormInput3"  placeholder="Nom de la branche"  required>';
        html += '</div>';
        html += '<div class="col ms-2">';
        // html += '<button id="removeRow3" type="button" class="btn btn-danger mt-2"><i class="fa fa-close style="font-size: 15px;"></i></button>';
        html += ' <button id="removeRow3" type="button" class="btn btn-labeled btn-danger "> <span class="btn-label"><i class="bx bx-x"></i></span>Annuler</button>';
        html += '</div>';
        html += '</div>';
        $('#add_column3').append(html);
    });

    // remove row3
    $(document).on('click', '#removeRow3', function() {
        $(this).closest('#inputFormRow3').remove();
        var input= $('#inlineFormInput3');
        if(input.length<=0){
            $(".save3").hide();
        }
    });
    $(document).on('click','.affiche_btn1',function(){
        $(".save1").css({display: "block"});
       
        // alert(input);
    });
    $(document).on('click','.affiche_btn2',function(){
        $(".save2").css({display: "block"});
    });
    $(document).on('click','.affiche_btn3',function(){
        $(".save3").css({display: "block"});
        
    });
    
    $(document).ready(function () {
       var service = $('#servId').text();
       console.log(service);
   });
</script>
    @endsection