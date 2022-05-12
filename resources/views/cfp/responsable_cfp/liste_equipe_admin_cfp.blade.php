@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Liste des équipes administratives</h3>
@endsection
@section('content')
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
</style>

<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-12">  
            @if($resp_connecte->prioriter == 1)
            <table class="mt-4 table  table-borderless table-lg">
                <thead  style="font-size: 12.5px; color: #676767; border-bottom: 0.5px solid rgb(103,103, 103); line-height: 20px">
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
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
                                <td role="button" class="randomColor m-auto mt-2 text-uppercase" style="width:40px;height:40px; border-radius:100%; color:white; display: grid; place-content: center" onclick="afficherInfos();"><span class=""> {{$responsables_cfp->nom}} {{$responsables_cfp->pr}} </span></td>
                            @else
                                <td class="td_hover" role="button"  onclick="afficherInfos();"><img src="{{asset("images/responsables/".$responsables_cfp->photos_resp_cfp)}}" style="width:45px;height:45px; border-radius:100%"></td>
                            @endif
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->nom_resp_cfp}}{{$responsables_cfp->id}}</td>
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->prenom_resp_cfp}}</td>
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->email_resp_cfp}}</td>
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->telephone_resp_cfp}}</td>
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->fonction_resp_cfp}}</td>
                            @if($resp_connecte->prioriter == 1)
                                    @if($responsables_cfp->prioriter == 1)
                                        {{-- <td id="demo" onclick="myFunction()" title="Résponsable principale" role="button" onclick="afficherInfos();" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i class='bx bxs-star'></i></td> --}}
                                        <td data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="myFunction()" title="Résponsable principale" role="button" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i data-bs-toggle="modal" data-bs-target="#staticBackdrop" class='bx bxs-star'></i></td>
                                    @elseif($responsables_cfp->prioriter == 0)
                                            <td title="Résponsable" role="button" onclick="afficherInfos()" class="td_hover" style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168)" align="center">
                                                <i data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{ $responsables_cfp->id }}" class='bx bxs-star'></i>
                                            </td>
                                    @endif
                            @elseif($resp_connecte->prioriter == 0)
                                @if($responsables_cfp->prioriter == 1)
                                    {{-- <td id="demo" onclick="myFunction()" title="Résponsable principale" role="button" onclick="afficherInfos();" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i class='bx bxs-star'></i></td> --}}
                                    <td onclick="myFunction()" title="Résponsable principale" role="button" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i class='bx bxs-star'></i></td>
                                @elseif($responsables_cfp->prioriter == 0)
                                        <td title="Résponsable" role="button" onclick="afficherInfos()" class="td_hover" style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168)" align="center">
                                            <i class='bx bxs-star'></i>
                                        </td>
                                @endif
                            @endif


                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">
                                @if($responsables_cfp->prioriter == 1 && $responsables_cfp->activiter == 1)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input activer" data-id="" type="checkbox" role="switch" checked disabled/>
                                    </div>
                                @elseif($responsables_cfp->prioriter == 0 && $responsables_cfp->activiter == 1)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input " data-bs-toggle="modal" name="switch" data-bs-target="#test_{{$responsables_cfp->id}}" id="switch2_{{$responsables_cfp->id}}" title="désactiver la personne selectionner"  type="checkbox" checked>
                                    </div>
                                @else
                                    <div class="form-check form-switch">
                                        <input class="form-check-input {{$responsables_cfp->id}}" data-bs-toggle="modal" id="switch_{{$responsables_cfp->id}}" name="switch" data-bs-target="#test2_{{$responsables_cfp->id}}" title="activer la personne selectionner" type="checkbox"/>
                                    </div>
                                @endif
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
                                        <button type="button" class="btn btn-secondary desactiver_personne" id="{{$responsables_cfp->id}}"> Oui</button>
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
                                            data-bs-dismiss="modal" id="{{$responsables_cfp->id}}"> Non
                                        </button>
                                        <button type="button" class="btn btn-secondary activer_personne" id="{{$responsables_cfp->id}}"> Oui</button>
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
            @elseif($resp_connecte->prioriter == 0)
                @foreach($cfpPrincipale as $prioriter)
                    <div id="in2" class=" text-center p-2 mt-5 m-0  alert alert-danger text-center" role="alert">
                        <h4 class="alert-heading animation_alert"><i class="fas fa-exclamation-triangle"></i></h4>
                        <p style="color: rgb(228, 128, 128)">Veuillez-vous contactez votre réferent principale pour réactiver votre compte !</p>
                        <hr>
                        <p class="mb-0" style="color: rgb(213, 97, 97);">{{$prioriter->nom_resp_cfp}} {{$prioriter->prenom_resp_cfp}} &nbsp; | &nbsp; {{$prioriter->email_resp_cfp}} &nbsp; | &nbsp;{{$prioriter->telephone_resp_cfp}}</p>
                    </div>
                @endforeach
            @endif
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


            // $('.show_confirm').click(function(event) {
            //         alert($('.responsable_cible').val());
            //       var form =  $(this).closest("form");
            //       var name = $(this).data("name");
            //       event.preventDefault();
            //       swal({
            //           title: `Vous êtes sur de designer cette personne comme referent principale?`,
            //           icon: "warning",
            //           buttons: true,
            //           dangerMode: true,
            //       })
            //       .then((value) => {
            //         if (value) {
            //             console.log("eto");
            //             $("#form_test").submit();
            //         }
            //       });
            //   });



            // $(".activer" ).on( "change", function() {
            //     var statut,idActiver;
            //     if($( this ).prop('checked')){
            //         statut = "Activé";
            //         idActiver = $(this).data('id');
            //     }
            //     else{
            //         statut = "Désactivé";
            //         idActiver = $(this).data('id');
            //     }

            //     $.ajax({
            //         type: "GET",
            //         url: "{{route('activer_compte')}}",
            //         data:{Id:idActiver,Statut:statut},
            //         dataType: "html",
            //         success:function(response){
            //             var userData=JSON.parse(response);
            //             for (var $i = 0; $i < userData.length; $i++){
            //                 $('#span_statut').text(userData[$i].status);
            //                 if (userData[$i].status === "Activé") {
            //                     $('#label_statut_'+userData[$i].id).text(userData[$i].status);
            //                     $('#statut_'+userData[$i].id).text('Désactivé');
            //                     // $('#label_statut_'+userData[$i].id).css("background","red");
            //                     $('#label_statut_'+userData[$i].id).css("background","green");
            //                 }
            //                 else{
            //                     $('#label_statut_'+userData[$i].id).text(userData[$i].status);
            //                     $('#statut_'+userData[$i].id).text('Activé');
            //                     // $('#label_statut_'+userData[$i].id).css("background","green");
            //                     $('#label_statut_'+userData[$i].id).css("background","red");
            //                 }
            //                 $('#debut_'+userData[$i].id).text(userData[$i].date_debut);
            //                 $('#fin_'+userData[$i].id).text(userData[$i].date_fin);
            //             }
            //         },
            //         error:function(error){
            //             console.log(error)
            //         }
            //     });
            // });

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

     $('.desactiver_personne').on('click',function(e){
        let id = e.target.id;
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