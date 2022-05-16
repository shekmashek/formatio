@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil formateur</h3>
@endsection
@section('content')

    <style>


    body{
        margin-top:20px;
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;    
    }
    .main-body {
        padding: 15px;
    }
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }

    </style>

<div class="container">
    <div class="main-body">
    
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    
                    @if ($formateur->photos==null)
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    @else
                    <img src="{{asset('images/formateurs/'.$formateur->photos)}}" alt="Admin" class="rounded-circle" width="150">
                    @endif
                    
                    <div class="mt-3">
                      <h4>{{$formateur->nom_formateur}} {{ $formateur->prenom_formateur }}</h4>
                      <p class="text-secondary mb-1">{{ $formateur->specialite }}</p>
                      <p class="text-muted font-size-sm">{{ $formateur->specialite }}</p>
                      {{-- <button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button> --}}
                    </div>
                  </div>
                </div>
              </div>

              {{-- réseaux sociaux --}}
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="m-2 list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                    <span class="text-secondary">https://bootdey.com</span>
                  </li>
                  <li class="m-2 list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="m-2 list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                    <span class="text-secondary">@bootdey</span>
                  </li>
                  <li class="m-2 list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="m-2 list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                </ul>
              </div>

            </div>
            <div class="col-md-8">
                
              <div class="card mb-3">
                  <span class="m-2 text-center">Informations personnels</span>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $formateur->nom_formateur }} {{ $formateur->prenom_formateur }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$formateur->mail_formateur}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$formateur->numero_formateur}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">CIN</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$formateur->cin}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$formateur->adresse}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('edit_form', $formateur->id) }}"  class="btn btn-secondary" >
                            <i class="bi bi-pencil"></i>
                        </a>
                    </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="align-items-center mb-3 text-center text-uppercase">Compétences</h6>
                      

                        @forelse ($competence as $competence)
                            <div class="progress-group">
                                <div class="progress-group-header">
                                    <p class="progress-group-number text-info mb-0">{{$competence->domaine}}</p>
                                    <span class="">{{$competence->competence}}</span>
                                </div>
                                <div class="progress-group-bars">
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$competence->niveau}}%" aria-valuenow="{{$competence->niveau}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-secondary">rien à afficher</p>
                        @endforelse


                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            </div>
          </div>

        </div>
    </div> --}}
    <style>
        .image-ronde{
   width : 30px; height : 30px;
   border: none;
   -moz-border-radius : 75px;
   -webkit-border-radius : 75px;
   border-radius : 75px;
 }
 /* .hover:hover{
     font-size: 25px;
     cursor: pointer;
     background-color: #f0ececfa;
     border: 25px;
 }
 #nom:hover{
     font-size: 25px;
     cursor: pointer;
     background-color: #f0ececfa;
     border: 25px;
 }
  */

     </style>
      <div class="row">
    <div class="row mt-2">

                             <div class="col-lg-4">

                                 <div class="form-control">
                                     <p class="text-center">Informations générales</p>

                                     <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                                     <p class="p-1 m-0" style="font-size: 12px;">PHOTO
                                     </p>
                                     <a href="{{route('editer_photos',$formateur->id)}}" >
                                        @if($formateur->photos==null)
                                        <span>
                                            <div style="display: grid; place-content: center">
                                                <div class='randomColor photo_users' style="color:white; font-size: 12px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                                                </div>
                                            </div>
                                        </span>
                                        @else
                                        <img src="{{asset('images/formateurs/'.$formateur->photos)}}" class="image-ronde">
                                        @endif
                                    </a>
                                    </div>
                                    <div  style="border-bottom: solid 1px #e8dfe5;">
                                     <a href="{{route('editer_nom',$formateur->id)}}" >
                                        <p class="p-1 m-0" id="nom" style="font-size: 12px;">NOM<span style="float: right;">{{$formateur->nom_formateur}} {{$formateur->prenom_formateur}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                        </p></a>

                                        </div>
                                        <div id="nom" style="border-bottom: solid 1px #e8dfe5;">
                                        <a href="{{route('editer_naissance',$formateur->id)}}" >
                                        <p class="p-1 m-0" style="font-size: 12px;">ANNIVERSAIRE<span style="float: right;">{{date('j \\ F Y', strtotime($formateur->date_naissance))}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                        </p>
                                    </a>

                                    </div>
                                    <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                                     <a href="{{route('editer_genre',$formateur->id)}}" >
                                     <p class="p-1 m-0" style="font-size: 12px;">GENRE<span style="float: right;">{{optional(optional($formateur)->genre)->genre}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                     </p>
                                     </a>
                                    </div>
                                    <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                                        <a href="{{route('editer_pwd',$formateur->id)}}" >
                                        <p class="p-1 m-0" style="font-size: 12px;">Mot de passe<span style="float: right;">Mot de passe&nbsp;<i class="fas fa-angle-right"></i></span>
                                        </p>
                                        </a>
                                       </div>
                                     <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                                 </div>
                             </div>


                                 <div class="col-lg-4">

                                     <div class="form-control">
                                         <p class="text-center">Coordonnées</p>

                                         <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                             <a href="{{route('editer_mail',$formateur->id)}}" >
                                         <p class="p-1 m-0" style="font-size: 12px;">ADRESSE E-MAIL<span style="float: right;">{{$formateur->mail_formateur}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                         </p>
                                             </a>
                                         </div>
                                         <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                             <a href=" {{route('editer_phone',$formateur->id)}}" >
                                         <p class="p-1 m-0" style="font-size: 12px;">TELEPHONE<span style="float: right;">{{$formateur->numero_formateur}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                                         </p>
                                             </a>
                                         </div>

                                         <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                             <a href="{{route('editer_cin',$formateur->id)}} " >
                                         <p class="p-1 m-0" style="font-size: 12px;">CIN<span style="float: right;">{{$formateur->cin}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                         </p>
                                             </a>
                                         </div>
                                         <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                      <a href="{{route('editer_adresse',$formateur->id)}}  " >
                                         <p class="p-1 m-0" style="font-size: 12px;">ADRESSE<span style="float: right;">{{$formateur->adresse}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-right"></i></span>

                                         </p>
                                      </a>
                                         </div>

                                         <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                                     </div>
                             </div>
                             <div class="col-lg-4">

                                 <div class="form-control">
                                     <p class="text-center">Informations professionnelles</p>

                                     <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                         <a href="{{route('editer_etp',$formateur->id)}} " >
                                     <p class="p-1 m-0" style="font-size: 12px;">Poste<span style="float: right;">{{$formateur->specialite}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                     </p>
                                         </a>
                                     </div>

                                     <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                         <a href="{{route('editer_niveau',$formateur->id)}}  " >
                                     <p class="p-1 m-0" style="font-size: 12px;">Niveau d'étude<span style="float: right;">{{$formateur->niveau}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                     </p>
                                         </a>

                                     </div>
                                     @foreach($competence as $comp)
                                     <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                        <a href="{{route('editer_comp',$formateur->id)}}  " >
                                    <p class="p-1 m-0" style="font-size: 12px;">Competence<span style="float: right;">{{$comp->competence}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                    </p>
                                </div>
                                    <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                        <a href="{{route('editer_domaine',$formateur->id)}}  " >
                                    <p class="p-1 m-0" style="font-size: 12px;">Domaine<span style="float: right;">{{$comp->domaine}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                    </p>
                                    @endforeach
                                        </a>

                                    </div>
                                    @foreach($experience as $exp)
                                    <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                        <a href="{{route('editer_nom_etp',$formateur->id)}}  " >
                                    <p class="p-1 m-0" style="font-size: 12px;">Entreprise<span style="float: right;">{{$exp->nom_entreprise}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                    </p>
                                        </a>
                                        </div>
                                        <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                            <a href="{{route('editer_poste',$formateur->id)}}  " >
                                        <p class="p-1 m-0" style="font-size: 12px;">Poste occuper<span style="float: right;">{{$exp->poste_occuper}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                        </p>
                                            </a>
                                            </div>
                                            <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                                <a href="{{route('editer_fonction',$formateur->id)}}  " >
                                            <p class="p-1 m-0" style="font-size: 12px;">Fonction<span style="float: right;">{{$exp->taches}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                            </p>
                                                </a>
                                                </div>
                                     @endforeach
                                     {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                                         <a href="#" >
                                     <p class="p-1 m-0" style="font-size: 12px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                     </p>
                                         </a>
                                     </div> --}}
                                     <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                                 </div>
                         </div>

     </div>

@endsection


