@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Modules</p>
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('assets/css/moduleM.css')}}">
    <div class="container shadow-sm mt-4 contenue" >
        <div class="row">
            <p>Liste des modules</p> 
            
                <button class="btn btn-outline but" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: 200px;color:white;background:rgb(125, 38, 207);font-size:17px">Crée une nouvelle module</button>
            
            <div class="col-12 col-lg-12 " style="display: flex;margin-top:-40px">
                    
                    <input type="text" style="margin-left:80%" placeholder="recherche" class="form-control">
                    <button type="submit"  class="btn btn" style="border:#5e5873 1px solid;color:#5e5873" ><i class="bi bi-search"></i></button>     
            </div>
            <div class="row">
                
            </div>
            <div class="col-12 col-lg-12 mt-4">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2"><i class="bi bi-circle-fill" style="font-size:15px;color:rgb(156, 238, 156);"></i>&nbsp; En ligne (1)</th>
                            <th colspan="2"><i class="bi bi-circle-fill" style="font-size:15px;color:rgb(226, 22, 14);"></i>&nbsp; Hors ligne (1)</th>
                            <th colspan="2"><i class="bi bi-circle-fill" style="font-size:15px;color:rgb(11, 158, 202);"></i>&nbsp; En configuration programme</th>
                            <th colspan="2"><i class="bi bi-circle-fill" style="font-size:15px;color:rgb(22, 38, 43);"></i>&nbsp; En configuration competence</th>
                        </tr>
                        <tr>
                            <td style="width: 50px" class="text-center"> <input type="checkbox"></td>
                            <td style="width: 100px">Réference</td>
                            <td>Nom</td>
                            <td class="text-center">Durée</td>
                            <td>Niveau</td>
                            <td>Formation</td>
                            <td class="text-center">Statut</td>
                            <td class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $mod)
                        
                        @if($mod->status == 1)
                        <tr class="">
                            <td style="width: 50px" class="text-center align-middle"> <input type="checkbox"></td>
                            <td class="align-middle">{{$mod->reference}}</td>
                            <td class="align-middle">{{$mod->nom_module}}</td>
                            <td class="text-center align-middle">{{$mod->duree_jour}}J</td>
                            @if ($mod->niveau_id == 1)
                                <td class="align-middle">Débutant</td>
                            @elseif ($mod->niveau_id == 2)
                                <td class="align-middle">Intermediaire</td>
                            @else
                                <td class="align-middle">Avancé</td>
                            @endif
                            <td class="align-middle">{{$mod->nom_formation}}</td>
                            <td class="text-center align-middle"><span class="dan">Hors ligne</span></td>
                            <td>
                                <a href=""><i class="bi bi-pencil-square ma" ></i></a>
                                <a href=""><i class="bi bi-trash ma"></i></a>
                                {{-- <div class=" btn-group dropleft" >
                                    <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v align-middle" ></i>
                                    </button>

                                    <div class="dropdown-menu" style="margin-right:-20px;">
                                        <a class=" dropdown-item " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            voir
                                        </a>
                                        <a href="" class="dropdown-item" title="Voir Profile"><i class="bi bi-pencil-square"></i>&nbsp;</a>
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal_"><i class="bi bi-sliders2"></i>&nbsp;Configurer</a>
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal_"><i class="bi bi-trash3"></i>&nbsp;Suprimer</a>
                                    </div>
                                </div> --}}
                            </td>
                        </tr>
                        @else
                        <tr class="">
                            <td style="width: 50px" class="text-center align-middle"> <input type="checkbox"></td>
                            <td class="align-middle">{{$mod->reference}}</td>
                            <td class="align-middle">{{$mod->nom_module}}</td>
                            <td class="text-center align-middle">{{$mod->duree_jour}}J</td>
                            @if ($mod->niveau_id == 1)
                                <td class="align-middle">Débutant</td>
                            @elseif ($mod->niveau_id == 2)
                                <td class="align-middle">Intermediaire</td>
                            @else
                                <td class="align-middle">Avancé</td>
                            @endif
                            <td class="align-middle">{{$mod->nom_formation}}</td>
                            <td class="text-center align-middle"><span class="badge ">En ligne</span></td>
                            <td>
                                        <a href=""><i class="bi bi-pencil-square ma" ></i></a>
                                        <a href=""><i class="bi bi-trash ma"></i></a>
                                    
                                
                                
                                
                                {{-- <div class=" btn-group dropleft" >
                                    <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v align-middle" ></i>
                                    </button>

                                    <div class="dropdown-menu" style="margin-right:-20px;">
                                        <a class=" dropdown-item " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            voir
                                        </a>
                                        <a href="" class="dropdown-item" title="Voir Profile"><i class="bi bi-vector-pen"></i>&nbsp;Modifier</a>
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal_"><i class="bi bi-trash3"></i>&nbsp;Suprimer</a>
                                    </div>
                                </div> --}}
                            </td>
                        </tr>
                        @endif
                       
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Button trigger modal -->
                
                
                <!-- Modal -->
                {{-- <div class="modal fade" id="staticBackdrop"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog " style="width: 900px;">
                    <div class="modal-content" style="background-color: transparent;border:none;">
                        <div class="modal-wrap" >
                            <div class="modal-header">
                              <span class="is-active"></span>
                              <span></span>
                              <span></span>
                            </div>
                            <div class="modal-bodies">
                            <div class="modal-body modal1 is-showing">
                              <div class="title" style="font-size:20px;">Excel To pro</div>
                              <div class="description">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <table class="table table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>Dureé</th>
                                                        <th>Niveaux</th>
                                                        <th>Entreprise</th>
                                                        <th>Modalité</th>
                                                        <th>Prix</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>

                                                        <td>4j </td>
                                                        <td>Débutant</td>
                                                        <td>Numerika Center</td>
                                                        
                                                        <td>Presentiel</td>
                                                        <td>150 000ar</td>
                                                    </tr>
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                              </div>
                              
                                <div class="text-center">
                                  <div class="button" type="submit">Information suivante</div>
                                </div>
                              
                            </div>
                              
                              <div class="modal-body modal2">
                                <div class="title " style="font-size:20px;">Excel To Pro</div>
                              <div class="description"><div class="description">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <table class="table table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Cible</th>
                                                    <th>Objectif</th>
                                                    <th>prerequis</th>
                                                    <th>Materiel necessaire</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium suscipit, eos fugiat doloremque expedita corporis molestias impedit ad inventore atque?</td>
                                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure voluptas odit fuga repellendus assumenda quasi neque, atque possimus distinctio alias.</td>
                                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, consectetur?</td>
                                                    <td>Ordinateur Portable,Cahier,Stylo</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                              </div>
                              <div class="text-center">
                                <div class="button" type="submit">Information suivante</div>
                              </div>
                           </div>
                                
                                
                              </div>
                              
                              <div class="modal-body modal3">
                                 <div class="title" style="font-size:20px;">Excel To Pro</div>
                                 <div class="description"><div class="description">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <table class="table table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>Bon a savoir</th>
                                                        <th>Nombre persone minimum</th>
                                                        <th>Nombre persone maximum</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium suscipit, eos fugiat doloremque expedita corporis molestias impedit ad inventore atque?</td>
                                                        <td>5</td>
                                                        <td>6</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="location.reload(true)" data-bs-dismiss="modal">Close</button>
                                    
                                  </div>
                              </div>
                            </div>
                          </div>
                          
                    </div>
                    </div>
                </div> --}}

                {{-- modal ajout --}}
            <form action="{{route('module.store')}}" method="POST" >
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="test" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-wrap" >
                            <div class="modal-header">
                              <span class="is-active"></span>
                              <span onclick="testeB()"></span>
                              <span onclick="testeC()"></span>
                              
                            </div>
                            <div class="modal-bodies">
                            {{-- setup tsirairay --}}
                            <div class="modal-body modal1 is-showing">
                              <div class="title" style="font-size:20px;">Module</div>
                              <div class="description">
                                <div class="formul " style="margin-top:-20px;">
                                    <div class="row">
                                        <div class="col-lg-4 col-lg-6-4 col-xl-4">
                                            <label for="" style="float: left">Domaine de formation :</label><br>
                                            <div class="input-group " style="">
                                                <select name="domaine" id="acf-domaine" name="domaine" class="form-control pe" id="" required>
                                                    <option value="null" class="pe" disable selected hidden>Choisissez la domaine de formation ...</option>
                                                    @foreach ($domaines as $domaine)
                                                        <option value="{{$domaine->id}}">{{$domaine->nom_domaine}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4">
                                            <label for="" style="float: left">Thematique par domaine :</label><br>
                                            <div class="input-group " style="">
                                                <select name="categorie" class="form-control categ" id="acf-categorie"  name="categorie"  required>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4">
                                            <label for="" style="float: left">Nom du module :</label><br>
                                            <div class="input-group " style="">
                                                <input type="text" name="nom_module" class="form-control " required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4">
                                            <label for="" style="float: left">Description :</label><br>
                                            <div class="input-group " style="">
                                                <input type="text" name="description" class="form-control " required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4">
                                            <label for="" style="float: left">Durée en jour :</label><br>
                                            <div class="input-group " style="">
                                                <input type="number" name="jour" class="form-control " required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4">
                                            <label for="" style="float: left">Durée en heure :</label><br>
                                            <div class="input-group " style="">
                                                <input type="number" name="heure" class="form-control " required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4">
                                            <label for="" style="float: left">Modalité du formation:</label><br>
                                            <div class="input-group " style="">
                                                <select name="modalite" id="" class="form-control" required>
                                                    <option value="null" class="pe" disable selected hidden>Choisissez la
                                                        modalite de formation ...</option>
                                                    <option value="En ligne">En ligne</option>
                                                    <option value="Presentiel">Présentiel</option>
                                                    <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4">
                                            <label for="" style="float: left">Niveau de formation :</label><br>
                                            <div class="input-group " style="">
                                                <select name="niveau" id="" class="form-control" required>
                                                    <option value="null" class="pe" disable selected hidden>Choisissez le niveau de formation...</option>
                                                    @foreach ($niveaux as $niveau)
                                                        <option value="{{$niveau->id}}">{{$niveau->niveau}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>   
                                    </div>  
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="title mt-2" style="font-size:20px;">Objectif</div> 
                                            <div class="col-lg-12">
                                                <input type="text" name="objectif" placeholder="objectif du module" style="height: 100px" class="form-control " required>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                              </div>
                              <div class="text-center">
                                  <div class="button" >Information suivante</div>
                              </div>
                            </div>
                            {{-- setup fin --}}
                            {{-- setup tsirairay --}}
                            
                              {{-- setup fin --}}
                            {{-- setup tsirairay --}}
                            <div class="modal-body modal2">
                                
                                <div class="description">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="title " style="font-size:20px;float: left;">Cible</div>
                                            <div class="input-group" >
                                                <input type="text" name="cible" placeholder="cible" class="form-control" style="margin-top:-20px;height:100px" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="title " style="font-size:20px;float: left;">Prerequis</div>
                                            <div class="input-group" >
                                                <input type="text" name="prerequis"  class="form-control" placeholder=" Les prérequis" style="margin-top:-20px;height:100px" required>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="title " style="font-size:20px;float: left;">Référence</div>
                                            <div class="input-group" >
                                                <input type="text" class="form-control" name="reference" placeholder="Référence" style="margin-top:-20px" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="title " style="font-size:20px;float: left;">Prix</div>
                                            <div class="input-group" >
                                                <input type="text" class="form-control" name="prix" placeholder="Prix en Ar" style="margin-top:-20px" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="title " style="font-size:20px;float: left;">Prix Groupe</div>
                                            <div class="input-group" >
                                                <input type="text" class="form-control" name="prix_groupe" placeholder="Prix du groupe en Ar" style="margin-top:-20px" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="text-center">
                                <div class="prev btn btn-dark" >Precedent</div>
                                <div class="button " >Information suivante</div>
                            </div>
                            
                            </div>
                            {{-- setup fin --}} 
                              <div class="modal-body modal3">
                                <div class="description">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="title " style="font-size:20px;float: left;">Equipement </div>
                                            <div class="input-group" >
                                                <input type="text" name="materiel" placeholder="Equipement necessaire" class="form-control" style="margin-top:-20px;height:100px" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="title " style="font-size:20px;float: left;">Bon à savoir</div>
                                            <div class="input-group" >
                                                <input type="text" class="form-control" name="bon_a_savoir" placeholder=" " style="margin-top:-20px;height:100px" required>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="title " style="font-size:20px;float: left;">Prestation</div>
                                            <div class="input-group" >
                                                <input type="text" placeholder="Prestation pédagogique" name="prestation" class="form-control" style="margin-top:-20px;height:100px" required>
                                            </div>
                                        </div>
                                           
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="title " style="font-size:20px;float: left;">Nombre presonne min</div>
                                            <div class="input-group" >
                                                <input type="number" placeholder="" class="form-control" name="min_pers" style="margin-top:-20px;" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="title " style="font-size:20px;float: left;">Nombre presonne max</div>
                                            <div class="input-group" >
                                                <input type="number" placeholder="" name="max_pers" class="form-control" style="margin-top:-20px;" required>
                                            </div>
                                        </div>
                                           
                                    </div>
                                </div>
                                <div class="modal-footer">
                                   <div class="prev btn btn-dark" type="submit">Precedent</div>
                                    <button type="submit" class="btn btn-secondary"  style="background: blueviolet;color:white" >Enregistré</button>
                                </form>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                {{-- tapitra eto --}}
                
            </div>
            
        </div>   
    </div>
 
    <script
			  src="https://code.jquery.com/jquery-3.6.0.js"
			  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $('.prev').click(function miverina(){
            var $but = $(this);
            var $ste = $but.parents('.modal-body');
            var $cout = $ste.index() - 1;
            var $page = $('.modal-header span').prev($cout)
            
            if($cout === 0 || $cout === 1 ){
                miverina1($ste,$page);
            }else{
                miverina2($ste,$page);
            }
        });

        function miverina1($ste,$page){
            $ste.addClass('animateout');
        
            setTimeout(function(){
                $ste.removeClass('is-showing animateout').prev().addClass('animatein');
                $page.removeClass('is-active').prev().addClass('is-active');
            }, 600);
            
            setTimeout(function(){
                $ste.prev().removeClass('animatein').addClass('is-showing');
            }, 1200);
        }
        function miverina2($ste,$pageE){
            $ste.addClass('animateout');
        
            setTimeout(function(){
                $ste.removeClass('is-showing animateout').prev().addClass('animatein');
                $pageE.removeClass('is-active').prev().addClass('is-active');
            }, 600);
            
            setTimeout(function(){
                $ste.prev().removeClass('animatein').addClass('is-showing');
            }, 1200);
        }


        $('.button').click(function teste(){
        var $btn = $(this);
        //refers to the parent node modal-body
        var $step = $btn.parents('.modal-body');
        //get the element number of modal body
        var $stepcount = $step.index();
        //refers to the indent in header when pages go to next
        var $page = $('.modal-header span').eq($stepcount);
        
        if($stepcount === 0 || $stepcount === 1 ){
            step2($step, $page);
        }else{
            step3($step, $page);
        }
        });

        function step2($step, $page){
        $step.addClass('animateout');
        
        setTimeout(function(){
            $step.removeClass('is-showing animateout').next().addClass('animatein');
            $page.removeClass('is-active').next().addClass('is-active');
        }, 600);
        
        setTimeout(function(){
            $step.next().removeClass('animatein').addClass('is-showing');
        }, 1200);
        }
        // function step3($step, $page){
        // $step.parents('.modal-wrap').addClass('animateright').delay(800).fadeOut(200);
        
        // setTimeout(function(){
        //     $('.rerun-button').css('display', 'inline-block');
        // }, 900);
        // }

        $('.btn-secondary').click(function(){
         //$('.model-wrap').removeClass('animateright').find('.modal-body').addClass('is-showing').siblings().removeClass('is-showing');
         return $stepcount = 0;
        
        });


       
        


        
        $("#acf-domaine").change(function() {
            var id = $(this).val();
            $(".categ").empty();
            $(".categ").append(
                '<option value="null" class="pe" disable selected hidden>Choisissez la catégorie de formation ...</option>'
            );

            $.ajax({
                url: "/get_formation",
                type: "get",
                data: {
                    id: id,
                },
                success: function(response) {
                    
                    var userData = response;
                    if (userData.length > 0) {
                        for (var $i = 0; $i < userData.length; $i++) {
                            
                            $(".categ").append(
                                '<option value="' +
                                    userData[$i].id +
                                    '" data-value="' +
                                    userData[$i].nom_formation +
                                    '" >' +
                                    userData[$i].nom_formation +
                                    "</option>"
                            );
                        }
                    } else {
                        document.getElementById("domaine_id_err").innerHTML =
                            "choisir le type de domaine valide pour avoir ses formations";
                    }
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });
    </script>
@endsection