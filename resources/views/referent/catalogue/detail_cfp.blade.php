@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Détails centre de formation </h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<section class="container-fluid">
    <div class="container pb-5">
        <div class="row details g-0">
            <div class="col-12 justify-content-center">
                <div id="result">
                    <div class="row details_content g-0">
                        <div class="col-3 logo_content">
                            <a href="#" class="text-center mb-2"><img src="{{asset("images/CFP/".$cfp->logo)}}" alt="logo" class="img-fliud logo_img"></a>

                          @if (count($horaire)>0)
                          <p class="text-center m-0 horloge text-capitalize"><i class="bx bx-alarm"></i>
                            Ouvert le
                            @php
                                $ouverture = 0;
                                $fermeture = 0;
                                foreach ($horaire as $cfp_h) {
                                    setlocale(LC_ALL, "fr_FR");
                                    $today = date("l");
                                    $jours_today = lcfirst(strftime("%A", strtotime($today)));
                                    if ($cfp_h->jours === $jours_today) {
                                        echo $cfp_h->jours."<br>";
                                        $ouverture = $cfp_h->h_entree;
                                        $fermeture = $cfp_h->h_sortie;
                                    }
                                }
                                echo (date('H:i', strtotime($ouverture))." - ".date('H:i', strtotime($fermeture)));
                            @endphp
                        </p>
                        @else
                            <p> Aucun horaire</p>
                        @endif

                        </div>
                        <div class="col-5">
                            <div class="row ps-5">
                                <h4><a href="#">{{$cfp->nom}}</a>
                                @foreach ($type_abonnement as $type)
                                    @if($cfp->id == $type->cfp_id)
                                        @if($type->type_abonnement_id == 1)
                                            <sup><span class="mode1"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                        @endif
                                        @if($type->type_abonnement_id == 2)
                                            <sup><span class="mode2"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                        @endif
                                        @if($type->type_abonnement_id == 3)
                                            <sup><span class="mode3"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                        @endif
                                        @if($type->type_abonnement_id == 4)
                                            <sup><span class="mode4"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                        @endif
                                        @if($type->type_abonnement_id == 5)
                                            <sup><span class="mode5"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                        @endif
                                        @if($type->type_abonnement_id != 1 && $type->type_abonnement_id != 2 && $type->type_abonnement_id != 3 && $type->type_abonnement_id != 4 && $type->type_abonnement_id != 5 )

                                        @endif
                                    @endif
                                @endforeach
                                </h4>
                                <p>{{$cfp->slogan}}</p>
                                @if($avis_etoile[0]->pourcentage != null)
                                <div class="d-flex flex-row">
                                    @if($avis_etoile[0]->pourcentage != null)
                                        <div class="Stars" style="--note: {{ $avis_etoile[0]->pourcentage }};"></div>
                                    @else
                                        <div class="Stars" style="--note: 0;"></div>
                                    @endif
                                    <div class="rating-box ms-2">
                                        @if($avis_etoile[0]->pourcentage != null)
                                            <span class="avis_verif"><span class="">{{ $avis_etoile[0]->pourcentage }}</span> ({{$avis_etoile[0]->nb_avis}} avis)</span>
                                        @else
                                            <span class="">0 sur 5 (0 avis)</span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <p class="mt-1"><i
                                        class="bx bx-map me-2"></i>{{$cfp->adresse_lot}}&nbsp;{{$cfp->adresse_quartier}}&sbquo;&nbsp;{{$cfp->adresse_ville}}&nbsp;{{$cfp->adresse_code_postal}}&sbquo;&nbsp;{{$cfp->adresse_region}}
                                </p>
                                <div class="col-6 mb-3">
                                    <span class="text-muted"><i class="bx bx-phone me-2"></i>{{$cfp->telephone}}</span>
                                    <p class="m-0"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 place_badge">
                            <div class="col d-flex flex-row mb-4">
                                <span class="btn_actions" role="button"><a href="#"><i
                                            class="bx bx-mail-send"></i>Email</a></span>
                                <span class="btn_actions ms-3" role="button"><a href="https://{{$cfp->site_web}}" target="_blank"><i class="bx bx-globe"></i>Site
                                        Web</a></span>
                            </div>
                            @foreach ($collaboration as $collab)
                                @if($collab->inviter_cfp_id == $cfp->id && $collab->activiter == 1)
                                    <div class="main-wrapper">
                                        <div class="badge green">
                                            <div class="circle"> <i class="bx bxs-badge-check"></i></div>
                                            <div class="ribbon">Collaboré</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="col-4 location">
                 <a href="#"><img src="{{asset('images/CFP/Capture d’écran 2022-03-14 à 15.44.30.png')}}"
                        alt="location" class="img-fluid"></a>
            </div>--}}
        </div>
        <div class="row">
            <div class="col-12 mt-3 services">
                <div class="row text-center">
                    <div class="col-4"><a href="#presentation">
                            <p class="border_end choisir">Pourquoi nous choisir?</p>
                        </a></div>
                    <div class="col-4"><a href="#domaines">
                            <p class="border_end"><i class="bx bx-pyramid"></i>Domaines de Formations</p>
                        </a></div>
                    <div class="col-4"><a href="#avis">
                            <p><i class='bx bx-microphone'></i>Avis</p>
                        </a></div>
                    <div id="presentation"></div>

                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3 ">
                <div class="row avis mt-3 ">
                    <div class="col-12">
                        <h5 class="text-center mb-3">Résumé des avis</h5>
                        @if($avis_etoile[0]->pourcentage != null)

                        <div class="row d-flex">
                            <div class="col-md-12 text-center justify-content-center d-flex flex-column">

                                <div class="Stars" style="--note: {{ $avis_etoile[0]->pourcentage }};"></div>
                                <div class="rating-box ms-2 mt-3">
                                    @if($avis_etoile[0]->pourcentage != null)
                                        <h6 class=""><span class="fs-4">{{ $avis_etoile[0]->pourcentage }}</span> sur 5 ({{$avis_etoile[0]->nb_avis}} avis véifiées)</h6>
                                    @else
                                        <h6 class="">0 sur 5 (0 avis)</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <div class="col-md-12 pt-2">
                                <div class="table-rating-bar ">
                                    <table class="">
                                        <tr>
                                            <td class="rating-label">Excellent</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    @if(isset($avis_cfp[0]))
                                                    <div class="bar-3"
                                                        style="--progress_bar: {{ $avis_cfp[0]->pourcentage }}%;">
                                                    </div>
                                                    @else
                                                    <div class="bar-3"
                                                        style="--progress_bar: 0%;">
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                            @if(isset($avis_cfp[0]))
                                                <td class="text-right">{{ $avis_cfp[0]->pourcentage }}%
                                                </td>
                                            @else
                                                <td class="text-right">0%
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="rating-label">Bien</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    @if(isset($avis_cfp[1]))
                                                    <div class="bar-3"
                                                        style="--progress_bar: {{ $avis_cfp[1]->pourcentage }}%;">
                                                    </div>
                                                    @else
                                                    <div class="bar-3"
                                                        style="--progress_bar: 0%;">
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                            @if(isset($avis_cfp[1]))
                                                <td class="text-right">{{ $avis_cfp[1]->pourcentage }}%
                                                </td>
                                            @else
                                                <td class="text-right">0%
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="rating-label">Moyenne</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    @if(isset($avis_cfp[2]))
                                                    <div class="bar-3"
                                                        style="--progress_bar: {{ $avis_cfp[2]->pourcentage }}%;">
                                                    </div>
                                                    @else
                                                    <div class="bar-3"
                                                        style="--progress_bar: 0%;">
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                            @if(isset($avis_cfp[2]))
                                                <td class="text-right">{{ $avis_cfp[2]->pourcentage }}%
                                                </td>
                                            @else
                                                <td class="text-right">0%
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="rating-label">Normal</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    @if(isset($avis_cfp[3]))
                                                    <div class="bar-3"
                                                        style="--progress_bar: {{ $avis_cfp[3]->pourcentage }}%;">
                                                    </div>
                                                    @else
                                                    <div class="bar-3"
                                                        style="--progress_bar: 0%;">
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                            @if(isset($avis_cfp[3]))
                                                <td class="text-right">{{ $avis_cfp[3]->pourcentage }}%
                                                </td>
                                            @else
                                                <td class="text-right">0%
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="rating-label">Terrible</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    @if(isset($avis_cfp[4]))
                                                    <div class="bar-3"
                                                        style="--progress_bar: {{ $avis_cfp[4]->pourcentage }}%;">
                                                    </div>
                                                    @else
                                                    <div class="bar-3"
                                                        style="--progress_bar: 0%;">
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                            @if(isset($avis_cfp[4]))
                                                <td class="text-right">{{ $avis_cfp[4]->pourcentage }}%
                                                </td>
                                            @else
                                                <td class="text-right">0%
                                                </td>
                                            @endif
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="#avis" role="button" class="btn btn_annuler">voir les avis</a>
                        </div>
                        @else
                        <div class="row d-flex">
                            <div class="col-md-12 justify-content-center d-flex flex-ow">

                                <div class="Stars" style="--note: 0;"></div>
                                <div class="rating-box ms-2">
                                    @if($avis_etoile[0]->pourcentage != null)
                                        <h6 class=""><strong>{{ $avis_etoile[0]->pourcentage }}</strong> sur 5 ({{$avis_etoile[0]->nb_avis}} avis vérifiés)</h6>
                                    @else
                                        <h6 class="">0 sur 5 (0 avis)</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="text-center">Il n'y a pas d'avis pour cette organisme de formation</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row avis mt-3">
                    <div class="col-12">
                        <h5 class="text-center mb-3">Horaires d'ouvertures</h5>
                        @if (count($horaire)>0)
                        @foreach ($horaire as $cfps)

                        <div class="row">
                            <div class="col-6">
                                <p class="m-0 text-capitalize">{{$cfps->jours}}</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">{{date('H:i', strtotime($cfps->h_entree))}} - {{date('H:i', strtotime($cfps->h_sortie))}}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <p class="text-center">Aucun horaire</p>
                        @endif

                    </div>
                </div>
                <div class="row avis mt-3 ">
                    <div class="col-12">
                        <h5 class="text-center mb-3">Trouvez-nous sur</h5>
                        @if (count($reseau_sociaux)>0)
                        @foreach ($reseau_sociaux as $reseau)
                        <div class="row">
                            <div class="col-12 text-center">
                                @if(isset($reseau->lien_facebook))
                                <a href="https://{{$reseau->lien_facebook}}" target="_blank"><span><i class='bx bxl-facebook-circle'></i></span></a>
                                @endif
                                @if(isset($reseau->lien_twitter))
                                <a href="https://{{$reseau->lien_twitter}}" target="_blank"><span><i class='bx bxl-twitter' ></i></span></a>
                                @endif
                                @if(isset($reseau->lien_instagram))
                                <a href="https://{{$reseau->lien_instagram}}" target="_blank"><span><i class='bx bxl-instagram' ></i></span></a>
                                @endif
                                @if(isset($reseau->lien_linkedin))
                                <a href="https://{{$reseau->lien_linkedin}}" target="_blank"><span><i class='bx bxl-linkedin' ></i></span></a>
                                @endif

                            </div>
                        </div>
                        @endforeach

                        @else
                        <p class="text-center">Aucun réseau sociaux</p>

                        @endif

                    </div>
                </div>
            </div>
            <div class="col-9 px-5 mt-3 details_plus">
                <div class="row">
                    <h5>Présentation de l'entreprise</h5>

                    <p class="strong">{{$cfp->specialisation}}</p>
                    <p class="mb-2">{{$cfp->presentation}}</p>
                </div>
                <div id="domaines"></div>
                <div class="row mt-5">
                    <hr>
                    <h5>Domaines de formations</h5>
                    <div class="row">
                        <div class="col-12 p-2 flex-wrap d-flex">
                            @foreach ($domaine_cfp as $dmc)
                                <p class="text-capitalize formations my-4 mx-2">{{$dmc->nom_domaine}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <hr>
                    <h5>Thématiques de formations</h5>
                    <div class="row">
                        <div class="col-12 p-2 flex-wrap d-flex">
                        @foreach ($formation as $frm)
                            <p class="text-capitalize my-4 mx-2"><a href="{{route("select_par_formation_par_cfp",[$frm->id])}}" class="formations">{{$frm->nom_formation}}</a></p>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="content_modules mt-5">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($formation as $frmt)
                        <div id="encre_{{$frmt->id}}"></div>
                        <div class="accordion-item mb-3" id="formation{{$frmt->id}}">
                            <h2 class="accordion-header" id="{{$frmt->id}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#frmt_{{$frmt->id}}" aria-expanded="false" aria-controls="frmt_{{$frmt->id}}">
                                    <span>Formation sur :<strong>&nbsp;{{$frmt->nom_formation}}</strong></span>
                                    @foreach ($modules_counts as $mdc)
                                        @if ($frmt->id == $mdc->formation_id)
                                            @if ($mdc->nb_modules != null)
                                                <span class="nbr_module"><span>{{$mdc->nb_modules}}</span>&nbsp;Modules</span>
                                            @else
                                                <span class="nbr_module"><span>0</span>&nbsp;Modules</span>
                                            @endif
                                        @endif
                                    @endforeach
                                </button>
                            </h2>


                            <div id="frmt_{{$frmt->id}}" class="accordion-collapse collapse show" aria-labelledby="{{$frmt->id}}">
                                <div class="accordion-body">
                                    @foreach ($modules as $mod)
                                        @if($mod->formation_id == $frmt->id)
                                            @if ($mod->nom_module == null)
                                                <p class="text-center">Cette thématique n'as pas encore de module mise en ligne 😓!</p>
                                            @else
                                                <a href="{{route('select_par_module',$mod->module_id)}}" class="">
                                                    <div id="module{{$mod->module_id}}" class="row mb-3 module_lien justify-content-center align-items-center">
                                                        <div class="col-5 text_minifier">
                                                            <div class="pt-2">{{$mod->nom_module}}</div>
                                                            <div>
                                                                <div class="Stars" style="--note: {{ $mod->pourcentage }};">
                                                                </div>
                                                                <span class="me-3"><strong>{{ $mod->pourcentage }}</strong>/5
                                                                    @if($mod->total_avis != null)
                                                                        ({{$mod->total_avis}} avis)
                                                                    @else
                                                                        (0 avis)
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 text_minifier">
                                                            <div class="mb-2"><i class='bx bx-calendar bx_supprimer me-2'></i>{{$mod->duree_jour}}&nbsp;J / {{$mod->duree}}&nbsp;H</div>
                                                            <div><i class='bx bx-windows bx_ajouter me-2'></i>{{$mod->modalite_formation}}</div>
                                                        </div>
                                                        <div class="col-2 text_minifier text-end">
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                            @if($mod->prix_groupe != null)
                                                                <div>{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                            @endif
                                                        </div>
                                                        <div class="col-2 text_minifier text-center">
                                                            <div class="mb-3">
                                                                <span class="btn_annuler text-uppercase">Organisme</span>
                                                            </div>
                                                            <div class="">
                                                                {{$mod->nom}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div id="avis"></div>
                <div class="detail__formation__programme__avis__donnes mt-3">
                    <hr>
                    <h5 class="mb-5 mt-4">Evaluations sur les formations</h5>
                    @foreach ($liste_avis as $avis)
                    <div class="row" id="avis">
                        <div class="d-flex flex-row">
                            <div class="col">
                                <h6 class="mt-3 mb-0">{{ $avis->nom_stagiaire }}.{{ $avis->prenom_stagiaire }}
                                </h6>
                            </div>
                            <div class="col">
                                <p class="text-muted pt-5 pt-sm-3">{{ $avis->date_avis }}</p>
                            </div>
                            <div class="col">
                                <p class="text-left d-flex flex-row">
                                <div class="Stars" style="--note: {{ $avis->note }};"></div>&nbsp;<span class="text-muted">{{ $avis->note }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row ms-1 mb-3">
                        <p>{{ $avis->commentaire }}</p>
                    </div>
                    @endforeach
                    @if(count($liste_avis_count) >= 10)
                        <div class="text-end"><a class="btn btn_fermer plus_avis" role="button" role="button" id="{{$cfp->id}}">voir tous les avis</a></div>
                    @endif
                    <div class="newRowAvis"></div>
                </div>
            </div>
        </div>
    </div>

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('.plus_avis').on('click', function(e){
        let id = $(e.target).closest('.plus_avis').attr("id");

        $.ajax({
            type: "get"
            ,url: "{{route('plus_avis')}}"
            ,data:{
                Id: id,
            }
            ,success: function(response){
                let cfpData = response;
                if (cfpData['liste_avis'] != null || undefined){
                    let html = '';

                    for (let i = 0; i < cfpData['liste_avis'].length; i++) {
                        html += '<div class="row" id="avis">';
                        html +=     '<div class="d-flex flex-row">';
                        html +=         '<div class="col">';
                        html +=             '<h6 class="mt-3 mb-0">'+cfpData['liste_avis'][i]['nom_stagiaire']+'.'+cfpData['liste_avis'][i]['prenom_stagiaire']+'</h6>';
                        html +=         '</div>'
                        html +=         '<div class="col">';
                        html +=             '<p class="text-muted pt-5 pt-sm-3">'+cfpData['liste_avis'][i]['date_avis']+'</p>';
                        html +=         '</div>'
                        html +=         '<div class="col">';
                        html +=             '<p class="text-left d-flex flex-row">';
                        html +=                 '<div class="Stars" style="--note: '+cfpData['liste_avis'][i]['note']+';"></div>&nbsp;<span class="text-muted">'+cfpData['liste_avis'][i]['note']+'</span>';
                        html +=             '</p>'
                        html +=         '</div>'
                        html +=     '</div>'
                        html += '</div>'
                        html += '<div class="row ms-1">';
                        html +=     '<p>'+cfpData['liste_avis'][i]['commentaire']+'</p>';
                        html += '</div>';
                    }
                    $('.newRowAvis').empty();
                    $('.newRowAvis').append(html);
                    $('.plus_avis').hide();
                }else{
                    alert('error');
                }

            }
            ,error: function(error){
                console.log(error);
            },
        });
    });
</script>

@endsection