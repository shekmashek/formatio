@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>Listes plan de formation</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('liste_demande_stagiaire') ? 'active' : '' }}"><a href="{{route('liste_demande_stagiaire')}}" ><span class="fa fa-th-list"></span>  Liste des demandes</a></li>&nbsp;&nbsp;
                            <li class ="{{ Route::currentRouteNamed('listePlanFormation') ? 'active' : '' }}"><a href="{{route('listePlanFormation')}}" ><span class="fa fa-th-list"></span>  Liste des Plan de formation</a></li>&nbsp;&nbsp;
                            <li  class ="{{ Route::currentRouteNamed('ajout_plan') ? 'active' : '' }}" ><a href="{{route('ajout_plan')}}"><span class="fa fa-plus-sign"></span> Nouveau Plan de formation</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>

                                        <th>Formation</th>
                                        <th>Collaborateurs</th>
                                        <th>Typologie</th>
                                        <th>Objectif</th>
                                        <th>Mode de financement</th>
                                        <th>Durée</th>
                                        <th>Date</th>
                                        <th>Coût(en Ar)</th>
                                        <th colspan = "2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($liste_plan as $list)
                                    <tr>
                                        @foreach($formations as $form)
                                            @if($form->id ==  $list->recueil_information->formation_id   )
                                                <td>{{$form->domaine->nom_domaine}} - <br>{{$form->nom_formation}}
                                                </td>
                                            @endif
                                        @endforeach
                                        @foreach($stagiaire as $stage)
                                            @if($list->recueil_information->stagiaire_id==$stage->id)
                                                <td>
                                                    {{$stage->nom_stagiaire}}  &nbsp;
                                                    {{$stage->prenom_stagiaire}} <br>
                                                    {{$stage->fonction_stagiaire}}
                                                </td>
                                            @endif
                                        @endforeach
                                        <td>{{$list->recueil_information->typologie_formation}}</td>
                                        <td>{{$list->recueil_information->objectif_attendu}}</td>
                                        <td>{{$list->mode_financement}}</td>
                                        <td>{{$list->recueil_information->duree_formation}}j</td>
                                        <td>{{$list->recueil_information->mois_previsionnelle}} / {{$list->recueil_information->annee_previsionnelle}}</td>
                                        <td>
                                            @php
                                                echo number_format($list->cout_previsionnel, 2, ',', '.');
                                            @endphp
                                            <br>
                                            {{$list->mode_de_financement}}
                                        </td>
                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    {{-- {{route('planFormation.edit',$list->id)}} --}}
                                                    {{-- <li  type="button" style="font-size:15px;"><a  href="#" class="modifier" title="Modifier le profil" id="" data-bs-toggle="modal_{{$list->id}}" data-bs-target="#exampleModal" ><i style="font-size:18px;" class = "fa fa-edit"></i> &nbsp;Modifier</a>  </li> --}}
                                                    <li  type="button" style="font-size:15px;"> <a href="" type="button"  data-bs-target="#modifier_{{$list->id}}" data-bs-toggle="modal"><i style="font-size:18px;" class = "fa fa-edit"></i> &nbsp;Modifier</a> </li>

                                                </div>
                                            </div>
                                        </center>
                                    </td>
                                    </tr>
                                    <div class="modal fade" id="modifier_{{$list->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
                                                <a href="" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                              </div>
                                              <div class="modal-body">
                                                  <form action = "{{route('planFormation.update',$list->id)}}" method = "POST" >
                                                      @csrf
                                                     <br>

                                                      <div class="col-lg-6">
                                                      <div class="form-group">
                                                        <label for="coutPrevisionnel">Coût prév en Ar</label><br><br>
                                                        <input type="text" autocomplete="off" class="form-control" id="coutPrevisionnel" name="cout" placeholder="Coût prévisionnel" value="{{$list->cout_previsionnel}}">
                                                        @error('cout')
                                                          <div class ="col-sm-6">
                                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                                          </div>
                                                          @enderror
                                                      </div><br><br>
                                                      <div class="form-group">
                                                        <label for="modeFinancement">Mode de financement</label><br><br>
                                                        <select value="{{$list->mode_financement}}" class="form-select" aria-label="Default select example" id="mode_financement" name="mode_financement" ">
                                                            @if($list->mode_financement == "Fonds propre")
                                                                <option value="Fonds propre" selected>Fonds propre</option>
                                                                <option value="FMFP">FMFP</option>
                                                            @endif
                                                            @if($list->mode_financement == "FMFP")
                                                              <option value="FMFP" selected>FMFP</option>
                                                              <option value="Fonds propre">Fonds propre</option>
                                                            @endif
                                                        </select>
                                                      </div><br>
                                                      <input name="_method" type="hidden" value="PUT">
                                                      </div>
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          <button type="submit" class="btn btn-success">Enregistrer</button>
                                                    </form>
                                              </div>

                                          </div>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
                                  <a href="" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                </div>
                                <div class="modal-body">
                                    {{-- <form action = "{{route('planFormation.update')}}" method = "POST" > --}}
                                        <form action = "" method = "POST" >
                                        @csrf
                                       <br>
                                        <label for="typologieFormation">Typologie de formation</label><br><br>
                                        <select class="form-select" aria-label="Default select example" id="typologieFormation" name="typologie">
                                            {{-- <option  value="{{$list->typologie_formation}}"></option> --}}
                                            <option value="Adaptation au poste">Adaptation au poste</option>
                                            <option value="Evolution dans l’emploi">Evolution dans l’emploi</option>
                                            <option value="Développement de compétences">Développement de compétences</option>
                                        </select>
                                        <div class="form-group">
                                          <label for="objectifAttendu">Objectif attendue</label><br><br>
                                          {{-- <input type="text" autocomplete="off" class="form-control" id="objectifAttendu" name="objectif" placeholder="Objectif attendue" value="{{$list->objectif_attendu}}"> --}}
                                          @error('objectif')
                                            <div class ="col-sm-6">
                                                <span style = "color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div><br><br>
                                        <div class="col-lg-6">

                                        <div class="form-group">
                                          <label for="coutPrevisionnel">Coût prév en Ar</label><br><br>
                                          {{-- <input type="text" autocomplete="off" class="form-control" id="coutPrevisionnel" name="cout" placeholder="Coût prévisionnel" value="{{$list->cout_previsionnel}}"> --}}
                                          @error('cout')
                                            <div class ="col-sm-6">
                                                <span style = "color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div><br><br>
                                        <div class="form-group">
                                          <label for="modeFinancement">Mode de financement</label><br><br>
                                          <select class="form-select" aria-label="Default select example" id="typologieFormation" name="mode_financement" ">
                                            {{-- <option value="{{$list->mode_financement}}" ></option> --}}
                                            <option value="Fonds propre">Fonds propre</option>
                                            <option value="FMFP">FMFP</option>
                                        </select>
                                        </div><br>
                                        </div>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success">Enregistrer</button>


                                      </form>

                                </div>

                            </div>
                          </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
