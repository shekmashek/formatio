@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profiles Organises de Formation</h3>
@endsection
@section('content')
<style>
    .image-ronde {
        width: 30px;
        height: 30px;
        border: none;
        -moz-border-radius: 75px;
        -webkit-border-radius: 75px;
        border-radius: 75px;
    }

    .none:hover{
        cursor:default;
    }
</style>

<div class="row">
    <div class="row mt-2">

        <div class="col-lg-6">
            <div class="form-control">
                <p class="text-center">Informations professionnelles</p>

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 12px;">Poste responsable<span style="float: right;">{{$refs->poste_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}
                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                    <div>
                        <p class="p-1 m-0" style="font-size: 12px;">Logo</p>
                    </div>
                    <div class="text-end">
                        {{-- <a href="{{route('modification_logo_cfp',$refs->id)}}"> --}}
                        @if($refs->logo_cfp == NULL )
                            <span class="text-end">
                                <img src="" alt="Logo centre de formation professionnel" width="50%" height="50%">
                            </span>
                        @else
                            <span class="text-end">
                                <img src="{{asset('images/CFP/'.$refs->logo_cfp)}}" class="" style="width:120px;height:60px">
                            </span>
                            @endif
                        </a>
                    </div>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('modification_nom_organisme',$refs->id)}}"> --}}
                        <p class="p-1 m-0" style="font-size: 12px;">Nom de l'organisme<span style="float: right;">{{$refs->nom_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('modification_email',$refs->id)}}"> --}}
                        @if($refs->email_resp_cfp==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">E-mail<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">E-mail<span style="float: right;">{{$refs->email_resp_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('modification_telephone',$refs->id)}}"> --}}
                        @if($refs->telephone_resp_cfp==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Télephone<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Télephone<span style="float: right;">{{$refs->telephone_resp_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('modification_horaire',$refs->id)}}"> --}}
                        @if($horaire==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Horaire d'ouverture<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            @for($i = 0;$i < count($horaire);$i++)
                                <p class="p-1 m-0" style="font-size: 12px;">Horaire d'ouverture<span style="float: right;">{{ $horaire[$i]->jours}} : @php echo (date('H:i', strtotime($horaire[$i]->h_entree))." - ".date('H:i', strtotime($horaire[$i]->h_sortie))) @endphp &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            @endfor
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                        @if($reseaux_sociaux == NULL)
                            {{-- <a href="{{route('lien_facebook',$refs->id)}}"> --}}
                                <p class="p-1 m-0" style="font-size: 12px;">Facebook<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                            {{-- <a href="{{route('lien_twitter',$refs->id)}}"> --}}
                                <p class="p-1 m-0" style="font-size: 12px;">Twitter<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                            {{-- <a href="{{route('lien_instagram',$refs->id)}}"> --}}
                                <p class="p-1 m-0" style="font-size: 12px;">Instagram<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                            {{-- <a href="{{route('lien_linkedin',$refs->id)}}"> --}}
                                <p class="p-1 m-0" style="font-size: 12px;">Linkedin<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                            @else
                                @if($reseaux_sociaux[0]->lien_facebook==null)
                                    {{-- <a href="{{route('lien_facebook',$refs->id)}}"> --}}
                                        <p class="p-1 m-0" style="font-size: 12px;">Facebook<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @else
                                    {{-- <a href="{{route('lien_facebook',$refs->id)}}"> --}}
                                        <p class="p-1 m-0" style="font-size: 12px;">Facebook<span style="float: right;">{{$reseaux_sociaux[0]->lien_facebook}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @endif
                                @if($reseaux_sociaux[0]->lien_twitter==null)
                                    {{-- <a href="{{route('lien_twitter',$refs->id)}}"> --}}
                                        <p class="p-1 m-0" style="font-size: 12px;">Twitter<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @else
                                    {{-- <a href="{{route('lien_twitter',$refs->id)}}"> --}}
                                        <p class="p-1 m-0" style="font-size: 12px;">Twitter<span style="float: right;">{{$reseaux_sociaux[0]->lien_twitter}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @endif
                                @if($reseaux_sociaux[0]->lien_instagram==null)
                                    {{-- <a href="{{route('lien_instagram',$refs->id)}}"> --}}
                                        <p class="p-1 m-0" style="font-size: 12px;">Instagram<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @else
                                    {{-- <a href="{{route('lien_instagram',$refs->id)}}"> --}}
                                        <p class="p-1 m-0" style="font-size: 12px;">Instagram<span style="float: right;">{{$reseaux_sociaux[0]->lien_instagram}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @endif
                                @if($reseaux_sociaux[0]->lien_linkedin==null)
                                    {{-- <a href="{{route('lien_linkedin',$refs->id)}}"> --}}
                                        <p class="p-1 m-0" style="font-size: 12px;">Linkedin<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @else
                                    {{-- <a href="{{route('lien_linkedin',$refs->id)}}"> --}}
                                        <p class="p-1 m-0" style="font-size: 12px;">Linkedin<span style="float: right;">{{$reseaux_sociaux[0]->lien_linkedin}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @endif
                        @endif
                </div>


                
                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('profil_of',$refs->cfp_id)}}">
                        <p class="p-1 m-0" style="font-size: 12px;">ORGANISME DE FORMATION<span style="float: right;">{{$refs->nom_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div> --}}

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 12px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>

        <div class="col-lg-6">

            <div class="form-control" style="height:324px">
                <p class="text-center">Coordonnées</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="mt-5">
                    {{-- <a href="{{route('modification_adresse_organisme',$refs->id)}}" class=""> --}}
                        @if($refs->adresse_quartier== null)
                            <p class="p-1 m-0" style="font-size: 12px; color:red;">Adresse<span style="float: right;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Adresse<span style="float: right;">{{$refs->adresse_quartier}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;">
                    {{-- <a href="{{route('modification_adresse_organisme',$refs->id)}}" class=""> --}}
                        @if($refs->adresse_ville== null)
                            <p class="p-1 m-0" style="font-size: 12px; color:red;">Adresse ville<span style="float: right;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Adresse ville<span style="float: right;">{{$refs->adresse_ville}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;">
                    {{-- <a href="{{route('modification_adresse_organisme',$refs->id)}}" class=""> --}}
                        @if($refs->adresse_region== null)
                            <p class="p-1 m-0" style="font-size: 12px; color:red;">Adresse région<span style="float: right;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Adresse région<span style="float: right;">{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                {{-- <div style="border-bottom: solid 1px #e8dfe5;" >
                    <a href="{{route('modification_site_web',$refs->id)}}" class="">
                        @if($refs->site_web == NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Site web officiel<span style="float: right; color:red;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Site web officiel<span style="float: right;">{{$refs->site_web}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div> --}}
            </div>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
        {{-- <div class="col-lg-4">
            <div class="form-control" style="height:324px">
                <p class="text-center">Informations de taxation</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('profil_of',$refs->cfp_id)}}"> --}}
                        {{-- @if($refs->assujetti_id == null )
                            {{-- <a href="{{route('modification_assujetti_cfp',$refs->id)}}" class="none_"> --}}
                                {{-- <p class="p-1 m-0" style="font-size: 12px; ">Taxation<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a> --}}
                        {{-- @elseif($refs->assujetti_id == 1)
                            {{-- <a href="{{route('modification_assujetti_cfp',$refs->id)}}" class="none_"> --}}
                                {{-- <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Assujetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a> --}}
                        {{-- @else --}} 
                            {{-- <a href="{{route('modification_assujetti_cfp',$refs->id)}}" class="none_"> --}}
                                {{-- <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Non assujetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a> --}}
                        {{-- @endif --}} 
                {{-- </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                        <a href="" class="none_">
                            <p class="p-1 m-0" style="font-size: 12px;">TVA en pourcentage (%)<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        </a>
                </div>
            </div>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
    </div> --}} 
    <div class="container mt-3">
        <div class="row ">
            <div class="col-md-6">
                <span style="font-size: 16px">Historiques d'Abonnement</span>
                <table class="table">
                    <thead style="font-size: 12px; color: #737373">
                    <th>Date debut d'abonnement</th>
                    <th>Date fin d'abonnement</th>
                    <th>Numero Facture</th>
                    <th>Status facture</th>
                     <th>Type d'abonnement</th> 
                    <th>Montant</th>
                    {{-- <th>Categorie Paiement</th> --}}
                  
                    </thead>
                @foreach ($abonnement as $abn)
                        
                    <tbody style="font-size: 11px; color:  #545454""> 
                    <tr>
                        <td><span>{{$abn->date_debut}}</span></td>
                        <td><span>{{$abn->date_fin}}</span></td>
                        <td><span>{{$abn->num_facture}}</span></td>
                        <td> {{$abn->status_facture}}</td>
                        <td>{{$abn->nom_type}}</td> 
                        <td>{{$abn->montant_facture}}</td>
                        {{-- <td>{{$abn->categorie}}</td> --}}
                    </tr>
                </tbody>
                @endforeach
                </table>
            </div>
         
            <div class="col-md-6">

            
                <span style="font-size: 16px">Liste des responsables</span>
                <table class="table">
                    <thead style="font-size: 12px; color: #737373">
                    <th>Responsables</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    </thead>
                @foreach ($responsables as $resp )
                        
                    <tbody style="font-size: 11px; color:  #545454"">
                    <tr>
                        <td><span>{{$resp->nom_resp_cfp}}</span><span class="ms-2">{{$resp->prenom_resp_cfp}}</span></td>
                        <td>{{$resp->telephone_resp_cfp}}</td>
                        <td>{{$resp->email_resp_cfp}}</td>
                        <td>{{$resp->created_at}}</td>
                    </tr>
                </tbody>
                @endforeach
                </table>
            </div>
       
    </div>
    </div>

    @endsection