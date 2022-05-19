@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Liste des équipes administratives</h3>
@endsection
@inject('groupe', 'App\groupe')
@section('content')
{{-- <link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}
<style>
    .td_hover:hover{
        background: #f0f0f0;

    }

    #aze:hover{
        background-color: #f0f0f0;
        border-color:#f0f0f0
    }

    @keyframes action{
        0%{
            filter: brightness(1);
        }
        25%{
            filter: brightness(2.4);
        }
        50%{
            filter: brightness(2);
        }
        75%{
            filter: brightness(1.5);
        }
        100%{
            filter: brightness(1.2);
        }
    }

    .animation_alert{
        animation-name: action;
        animation-duration: 3s;
        animation-delay: 1s;
        animation-iteration-count: infinite;
    }

    .warning{
    color: #f64f59;
    font-size: 4rem;
}
    #in2{
        cursor:default;
    }

    .main{
        cursor: pointer;
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
    color: #7635dc;
}

.nav-tabs .nav-link:hover {
    background-color: rgb(245, 243, 243);
    transform: scale(1.1);
    border: none;
}
.nav-tabs .nav-item a{
    text-decoration: none;
    text-decoration-line: none;
}


#tabDynamique{
    background-color: #70d061;
    border-radius: 3px;
}

#tabDynamique:hover{
    background-color: #4db53e;
    border-radius: 3px;
}

#text{
    color: white;
}

#text:hover{
    color: rgb(255, 255, 255);
}
</style>



{{--  --}}


<div class="container-fluid pb-1">
    @if($resp_connecte->activiter == 1)
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item ">
                <a href="#vosReferent" class="nav-link active" data-bs-toggle="tab">Vos réferents&nbsp;&nbsp;&nbsp;</a>
            </li>
        @if($resp_connecte->prioriter == 1)
            <li class="nav-item mt-1 ms-0" id="tabDynamique">
                <a href="{{route('liste+responsable+cfp')}}">&nbsp; <span id="text" style="vertical-align: middle" class="mt-3"> <i class="bx bx-plus mt-2" ></i> Nouveau réferent</span> &nbsp; &nbsp;</a>
            </li>
        @endif
            
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="vosReferent">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <table class="mt-4 table  table-borderless table-lg">
                                <thead  style="font-size: 12.5px; color: #676767; border-bottom: 0.5px solid rgb(103,103, 103); line-height: 20px">
                                    <th>Photo</th>
                                    <th>Nom & Prénom(s)</th>
                                    {{-- <th>Prénom</th> --}}
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Fonction</th>
                                    {{-- @if($resp_connecte->prioriter == 1) --}}
                                        <th class="text-center">Réferent principale</th>
                                        <th class="text-center">Activer</th>
                                    {{-- @endif --}}
                
                                </thead>
                                <tbody id="data_collaboration" style="font-size: 11.5px;">
                                    @foreach($cfp as $responsables_cfp)
                                        <tr class="information" data-id="" >
                                            @if($responsables_cfp->photos_resp_cfp == NULL or $responsables_cfp->photos_resp_cfp == '' or $responsables_cfp->photos_resp_cfp == 'XXXXXXX')
                                                <td role="button" class="randomColor m-auto mt-2 text-uppercase" style="width:40px;height:40px; border-radius:100%; color:white; display: grid; place-content: center"><span class=""> {{$responsables_cfp->nom}} {{$responsables_cfp->pr}} </span></td>
                                            @else
                                                <td class="td_hover" role="button" style="display: grid; place-content: center"><img src="{{asset("images/responsables/".$responsables_cfp->photos_resp_cfp)}}" style="width:40px;height:40px; border-radius:100%"></td>
                                            @endif
                                            <td class="td_hover" role="button" style="vertical-align: middle">{{$responsables_cfp->nom_resp_cfp}} &nbsp; {{$responsables_cfp->prenom_resp_cfp}}</td>
                                            {{-- <td class="td_hover" role="button" style="vertical-align: middle">{{$responsables_cfp->prenom_resp_cfp}}</td> --}}
                                            <td class="td_hover" role="button" style="vertical-align: middle">{{$responsables_cfp->email_resp_cfp}}</td>
                                            <td class="td_hover" role="button" style="vertical-align: middle">
                                                @php
                                                  echo $groupe->formatting_phone($responsables_cfp->telephone_resp_cfp);  
                                                @endphp
                                            </td>
                                            <td class="td_hover" role="button" style="vertical-align: middle">{{$responsables_cfp->fonction_resp_cfp}}</td>
                                            <td style="vertical-align: middle" class="text-center">
                                                @if($responsables_cfp->prioriter == 1 && $responsables_cfp->id == $resp_connecte->id)
                                                    <span data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="Résponsable principale" role="button" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i data-bs-toggle="modal" data-bs-target="#staticBackdrop" class='bx bxs-star'></i></span>
                                                @else
                                                    <span desabled title="Résponsable" role="button"  class="td_hover" @if($responsables_cfp->prioriter == 0) style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168)" @elseif($responsables_cfp->prioriter == 1) style="vertical-align: middle; font-size:23px; color:gold" @endif align="center">
                                                        <i desabled @if($resp_connecte->prioriter == 1) data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$responsables_cfp->id }}" @endif class='bx bxs-star'></i>
                                                    </span>
                                                @endif
                                            </td>            
                                            
                                            <td class="td_hover" role="button" style="vertical-align: middle" >
                                                @if($responsables_cfp->prioriter == 1 && $responsables_cfp->id == $resp_connecte->id)
                                                    <div style="display: grid; place-content: center" class="form-check form-switch">
                                                        <input  class="form-check-input activer main" data-id="" type="checkbox" role="switch" checked disabled/>
                                                    </div>
                                                @else
                                                    @if($resp_connecte->prioriter == 1)
                                                        <div style="display: grid; place-content: center" class="form-check form-switch">
                                                            <input class="form-check-input {{$responsables_cfp->id}} main" data-bs-toggle="modal"  name="switch"  @if($responsables_cfp->activiter == 1) data-bs-target="#test_{{$responsables_cfp->id}}" id="switch2_{{$responsables_cfp->id}}" title="Désactiver la personne selectionner" @elseif($responsables_cfp->activiter == 0) data-bs-target="#test2_{{$responsables_cfp->id}}" id="switch_{{$responsables_cfp->id}}" title="Activer la personne selectionner" @endif   class="form-check-input activer" data-id="" type="checkbox" role="switch" @if($responsables_cfp->activiter == 1) checked @endif/>
                                                        </div>
                                                    @else
                                                        <div style="display: grid; place-content: center" class="form-check form-switch">
                                                            <input class="form-check-input main" data-bs-toggle="modal" name="switch" data-bs-target="#test_{{$responsables_cfp->id}}" id="switch2_{{$responsables_cfp->id}}" title="Désactiver la personne selectionner" type="checkbox" role="switch" @if($responsables_cfp->activiter == 1) checked @endif disabled/>
                                                        </div>
                                                    @endif
                                                    
                                                @endif
                                                <td>
                                                        @if($responsables_cfp->activiter == 1)
                                                            <div class="text-center mt-3">
                                                                <p>
                                                                    <span style="color:white; background-color:rgb(144, 208, 134); border-radius:7px; padding: 5px" > Activé </span>
                                                                </p>
                                                            </div>
                                                        @elseif($responsables_cfp->activiter == 0)
                                                            <div class="text-center mt-3">
                                                                <p> 
                                                                    <span style="color:white; background-color:rgb(255, 175, 175); border-radius:7px; padding: 5px" > Desactivé </span>
                                                                </p>
                                                            </div>
                                                        @endif
                                                </td>
                                            </td>
                                            
                                        </tr>
                                        <div class="modal fade mt-5" id="staticBackdrop_{{$responsables_cfp->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <form action="{{route('update_roleReferent')}}" method="Post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <span style="font-size: 16px;" class="modal-title" id="staticBackdropLabel"></span>
                                                        <button style="font-size: 13px" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body mt-3">
                                                        <span>Vous êtes sur de designer cette personne comme referent principale?</span>
                                                        <input name="id_resp" type="hidden" class="responsable_cible" value="{{$responsables_cfp->id}}">
                                                    </div>
                                                    <div class="modal-footer mt-5">
                                                        <button style="border-radius:25px" type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Annuler</button>
                
                                                        <button style="border-radius:25px" type="submit" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Confirmer</button>
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="modal fade" id="test_{{$responsables_cfp->id}}" tabindex="-1" aria-labelledby="test_{{$responsables_cfp->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header  d-flex justify-content-center"
                                                                        style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez désactiver cette personne. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary non_active" data-bs-dismiss="modal" id="{{$responsables_cfp->id}}"> Non </button>
                                                        <button type="button" class="btn btn-secondary desactiver_personne" data-id="{{$responsables_cfp->id}}" id="{{$responsables_cfp->id}}"> Oui</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="modal fade" id="test2_{{$responsables_cfp->id}}" tabindex="-1" aria-labelledby="test2_{{$responsables_cfp->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez activer cette personne. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary non_active2"
                                                            data-bs-dismiss="modal" id="{{$responsables_cfp->id}}">Non
                                                        </button>
                                                        <button type="button" class="btn btn-secondary activer_personne" id="{{$responsables_cfp->id}}">Oui</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade mt-5" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <span style="font-size: 16px;" class="modal-title" id="staticBackdropLabel">Choississez comme</span>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mt-3">
                                       <span style="font-size: 14px;">vous êtes déjà une référence principale !</span>
                                    </div>
                                    <div class="modal-footer mt-5">
                                      <button style="border-radius:25px" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">OK</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @elseif($resp_connecte->prioriter == 0 || $resp_connecte->activiter == 0 )
                                @foreach($cfpPrincipale as $prioriter)
                                    <div id="in2" class=" text-center p-2 mt-5 m-0  alert alert-danger text-center" role="alert">
                                        <h4 class="alert-heading animation_alert"><i class="fas fa-exclamation-triangle"></i></h4>
                                        <p style="color: rgb(228, 128, 128)">Veuillez-vous contactez votre réferent principale pour activer votre compte !</p>
                                        <hr>
                                        <p class="mb-0" style="color: rgb(213, 97, 97);">{{$prioriter->nom_resp_cfp}} {{$prioriter->prenom_resp_cfp}} &nbsp; | &nbsp; {{$prioriter->email_resp_cfp}} &nbsp; | &nbsp;{{$prioriter->telephone_resp_cfp}}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script>


            var el = document.getElementById("in2");

            function fadeIn(el, time) {
                el.style.opacity = 0;

                var last = +new Date();
                var tick = function() {
                    el.style.opacity = +el.style.opacity + (new Date() - last) / time;
                    last = +new Date();

                    if (+el.style.opacity < 1) {
                        (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 10);
                    }
                };

                tick();
            }

    $(".randomColor").each(function() {
        //On change la couleur de fond au hasard
            $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16).slice(-6));
        });

     $(".non_active2").on('click', function(e) {
        let id = e.target.id;
        let id2 = $("#switch_"+id).val();
        $("#switch_"+id).prop('checked',false);
     });

     $(".non_active").on('click', function(e) {
        let id = e.target.id;
        let id2 = $("#switch_"+id).val();
        $("#switch2_"+id).prop('checked',true);
     });

    //  $('.container-fluid').click(function (event){
    //     if(!$(event.target).closest('#openModal').length && !$(event.target).is('#openModal')){
    //         event.preventDefault();
    //         // window.location.reload();
    //     }
    // });

     $('.desactiver_personne').on('click',function(e){
        let id = e.target.id;
        // let id = $(this).val();
        // console.log(id);
        $.ajax({
            method: "GET"
            , url: "{{route('desactiver_personne')}}"
            , data: {Id : id}
            , success: function(response) {
                window.location.reload();
            }
            , error: function(error) {
                console.log(error)
            }
        });
     });

     $('.activer_personne').on('click',function(e){
        let id = e.target.id;
        $.ajax({
            method: "GET"
            , url: "{{route('activer_personne')}}"
            , data: {Id : id}
            , success: function(response) {
                window.location.reload();
            }
            , error: function(error) {
                console.log(error)
            }
        });
     });

</script>
@endsection