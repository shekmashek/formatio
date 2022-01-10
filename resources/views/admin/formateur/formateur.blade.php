@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>FORMATEUR</h3>
            </div>
            <a href="{{ route('collaboration')}}">
                 <button class="btn btn-success mb-2 payement"><i class="fa fa-plus"></i> collaborer</button></a>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">

                        <a class="nav-link  {{ Route::currentRouteNamed('liste_formateur') || Route::currentRouteNamed('liste_formateur') ? 'active' : '' }}" href="{{route('liste_formateur')}}">
                            <i class="fa fa-list">Formateurs</i></a>
                        </li>

                        {{-- <li class="nav-item">

                        <a class="nav-link  {{ Route::currentRouteNamed('nouveau_formateur') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_formateur')}}">
                            <i class="fa fa-plus">Nouveau Formateur</i></a>

                        </li> --}}

                    </ul>

                    <form class="navbar-form navbar-left" role="search">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Tout <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('liste_formateur',5)}}">5</a></li>
                                <li><a href="{{route('liste_formateur',10)}}">10</a></li>
                                <li><a href="{{route('liste_formateur',25)}}">25</a></li>
                                <li><a href="{{route('liste_formateur',50)}}">50</a></li>
                                <li><a href="{{route('liste_formateur',100)}}">100</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('liste_formateur')}}">Tout</a></li>
                            </ul>
                        </div>
                    </form>
                    </div>
                </div>
            </nav>
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        @canany(['isAdmin','isManager','isReferent','isSuperAdmin'])
                                        <th>CFP</th>
                                        @endcanany

                                        <th>Date de naissance</th>
                                        <th>Adresse</th>
                                        <th>Genre</th>
                                        <th>CIN</th>
                                        <th>E-mail</th>
                                        <th>Numéro</th>
                                        <th>Spécialité</th>


                                        <th colspan = "3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($formateur as $frm)
                                    	    <tr>

                                                <td>
                                                    <img src="{{asset('images/formateurs/'.$frm->photos)}}" width="100" height="100" class="rounded-circle"></a>

                                                </td>


                                                <td>{{$frm->nom_formateur}}</td>
                                                <td>{{$frm->prenom_formateur}}</td>
                                                @canany(['isAdmin','isManager','isReferent','isSuperAdmin'])
                                                <td> <strong style="color: blue">{{$frm->nom}}</strong></td>
                                                @endcanany
                                                <td>{{$frm->date_naissance}}</td>
                                                <td>{{$frm->adresse}}</td>
                                                <td>{{$frm->genre}}</td>
                                                <td>{{$frm->cin}}</td>
                                                <td>{{$frm->mail_formateur}}</td>
                                                <td>{{$frm->numero_formateur}}</td>
                                                <td>{{$frm->specialite}}</td>

                                                <td>
                                                <div class=" btn-group dropend" >
                                                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>

                                                    <div class="dropdown-menu">
                                                        <li style="font-size:15px"><a href="{{route('profile_formateur',$frm->formateur_id)}}" class="voir" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px" ></i>&nbsp;Profile</a></li>

                                                        <li style="font-size:15px"><a href="{{route('profilFormateur',[$frm->formateur_id])}}" class="voir" title="Voir Profile"><i class="fa fa-user" aria-hidden="true" style="font-size:15px" ></i>&nbsp;&nbsp;CV</a></li>
                                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                        <li style="font-size:15px"><a href=""   class=" modifier" title="Modifier" id="{{$frm->formateur_id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil fa-xs" aria-hidden="true" style="font-size:15px"></i>&nbsp;Modifier</a></li>
                                                        <li style="font-size:15px"><a href="" data-toggle="modal" data-target="#exampleModal_{{$frm->formateur_id}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i>&nbsp;Supprimer</a></li>
                                                            @endcanany
                                                    </div>

                                            </tr>


                                             <!-- Modal delete -->
                                             <div class="modal fade"  id="exampleModal_{{$frm->formateur_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                      <h6 class="modal-title"><font color="white">Avertissement !</font></h6>

                                                    </div>
                                                    <div class="modal-body">
                                                      <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                      <form action="{{ route('destroy_formateur') }}" method="GET">
                                                              @csrf
                                                          <button type="submit" class="btn btn-secondary">Oui </button>
                                                          <input type="text" value="{{$frm->formateur_id}}" hidden name="id_get">
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              {{-- fin modal delete --}}





                            <div class="modal fade" id = "myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                            <h5 class="modal-title text-white">Modification</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form  action="{{ route('update_formateur') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name"><small><b>Nom</b></small></label>
                                                    <input type="text" class="form-control" value="{{ $frm->nom_formateur }}" name="nom_formateur" placeholder="Nom">
                                                </div>
                                                <div class="form-group">
                                                  <label for="prenom"><small><b>Prénom</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $frm->prenom_formateur }}" name="prenom_formateur" placeholder="Prénom">
                                                </div>

                                                <div class="form-group">
                                                  <label for="adresse"><small><b>Adresse</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $frm->adresse }}" name="adresse_formateur" placeholder="Adresse">
                                                </div>

                                                <div class="form-group">
                                                  <label for="email"><small><b>Email</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $frm->mail_formateur}}" name="email_formateur" >
                                                </div>

                                                <div class="form-group">
                                                  <label for="telephone"><small><b>Telephone</b></small></label>
                                                  <input type="text" class="form-control" value="{{$frm->numero_formateur}}" name="phone_formateur">
                                                </div>

                                                <div class="form-group">
                                                    <label for="telephone"><small><b>CIN</b></small></label>
                                                    <input type="text" class="form-control" value="{{$frm->cin}}" name="cin_formateur">
                                                  </div>

                                                  <div class="form-group">
                                                    <label for="telephone"><small><b>Spécialité</b></small></label>
                                                    <input type="text" class="form-control" value="{{$frm->specialite}}" name="specialite_formateur">
                                                  </div>

                                                  <div class="form-group">
                                                    <label for="telephone"><small><b>Niveau</b></small></label>
                                                    <input type="text" class="form-control" value="{{$frm->niveau}}" name="niveau_formateur">
                                                  </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fermer </button>&nbsp;
                                            <button type="submit" class="btn btn-success"> Enregistrer </button>
                                                <input type="text" name="id_get" value="{{ $frm->formateur_id }}" hidden>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    var id_formateur;
//===================== ajout information a modifier
    $(".modifierFrm").on('click',function(e){
        var id = e.target.id;
        $.ajax({
            type: "GET",
            url: "{{route('edit_formateur')}}",
            data:{Id:id},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $("#nomModif").val(userData[$i].nom_formateur);
                    $("#prenomModif").val(userData[$i].prenom_formateur);
                    $("#emailModif").val(userData[$i].mail_formateur);
                    $("#phoneModif").val(userData[$i].numero_formateur);
                    $("#adresseModif").val(userData[$i].adresse);
                    $('#id_formateur').val(userData[$i].id);
                }
            },
            error:function(error){
              console.log(error)
           }
        });
    });


    $(".supprimer").on('click',function(e){
        alert("eto");
        var id = e.target.id;
       $.ajax({
            type: "GET",
            url: "{{route('destroy_formateur')}}",
            data:{Id:id},
            success:function(response){
                if(response.success){
                     window.location.reload();
                }else{
                      alert("Error")
                  }
            },
            error:function(error){
                  console.log(error)
            }
        });
        alert(id);
    });
    $("#action1").click(function(e){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN':
        $('meta[name="_token"]').attr('content') }
        });

        var nom =$("#nomModif").val();
        var prenom =$("#prenomModif").val();
        var email = $('#emailModif').val();
        var adresse = $('#adresseModif').val();
        var phone = $('#phoneModif').val();
        var id_formateur = $('#id_formateur').val();

        $.ajax({
           url:"{{route('update_formateur')}}",
           type:'get',
           data:{
                  Id:id_formateur,
                  Nom:nom,
                  Prenom:prenom,
                  Email:email,
                  Adresse:adresse,
                  Phone:phone
                },
           success:function(response){
              if(response.success){
                 window.location.reload();
              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
    });



</script>
@endsection
