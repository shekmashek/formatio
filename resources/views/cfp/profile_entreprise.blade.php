@extends('./layouts/admin')

@section('title')
<p class="text_header m-0 mt-1">Entreprise collaboré</p>
@endsection

@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
<style>
     .nav-item .nav-link.active {
        border-bottom: 3px solid #7635dc !important;
        border: none;
        transform: none;
        color: #7635dc;
    }
    .nav-tabs .nav-link:hover {
        background-color: rgb(245, 243, 243);
        transform: none;
        border: none;
    }
    .nav-tabs .nav-link.active:hover {
        background-color: rgb(245, 243, 243);
        transform: none;
        border: none;
    }
    label{
        color: rgb(20, 20, 20);
        font-size: 15px;
    }
</style>
<div class="container-fluid mt-4 p-5 " >


    @if(Session::has('error'))
    
    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
          <a
            class="nav-link "
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="false"
            ><i class="bi bi-wallet-fill"></i>&nbsp;&nbsp;EN COLABORATION</a
          >
        </li>
        <li class="nav-item" role="presentation">
          <a
            class="nav-link active"
            id="ex1-tab-2"
            data-mdb-toggle="tab" 
            data-bs-toggle="tab"
            href="#ex1-tabs-2"
            role="tab"
            aria-controls="ex1-tabs-2"
            aria-selected="true"
            ><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;INVITATION</a
          >
        </li>
    </ul>         
    @elseif (Session::has('success'))
    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
          <a
            class="nav-link "
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="false"
            ><i class="bi bi-wallet-fill"></i>&nbsp;&nbsp;EN COLABORATION</a
          >
        </li>
        <li class="nav-item" role="presentation">
          <a
            class="nav-link active"
            id="ex1-tab-2"
            data-mdb-toggle="tab" 
            data-bs-toggle="tab"
            href="#ex1-tabs-2"
            role="tab"
            aria-controls="ex1-tabs-2"
            aria-selected="true"
            ><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;INVITATION</a
          >
        </li>
    </ul>     
    @else
    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
          <a
            class="nav-link active"
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true"
            ><i class="bi bi-wallet-fill"></i>&nbsp;&nbsp;EN COLABORATION</a
          >
        </li>
        <li class="nav-item" role="presentation">
          <a
            class="nav-link"
            id="ex1-tab-2"
            data-mdb-toggle="tab" 
            data-bs-toggle="tab"
            href="#ex1-tabs-2"
            role="tab"
            aria-controls="ex1-tabs-2"
            aria-selected="false"
            ><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;INVITATION</a
          >
        </li>
    </ul> 
    @endif


    
    
        {{-- <li class="nav-item" role="presentation">
          <a
            class="nav-link"
            id="ex1-tab-3"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-3"
            role="tab"
            aria-controls="ex1-tabs-3"
            aria-selected="false"
            >Tab 3</a
          >
        </li> --}}
      </ul>
      <!-- Tabs navs -->
      
      <!-- Tabs content -->
      @if(Session::has('error'))
      {{-- eto --}}
      
      <div class="tab-content" id="ex1-content">
        <div
          class="tab-pane fade "
          id="ex1-tabs-1"
          role="tabpanel"
          aria-labelledby="ex1-tab-1"
        >
          {{-- Tab 1 content --}}
            <div class="row">
                
            </div> 
            @if(Session::has('message'))
            <div class="alert alert-danger close">
                <strong> {{Session::get('message')}}</strong>
            </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom de l'entreprise</th>
                        <th>Réferent principal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="data_collaboration" style="font-size: 15.5px;">
    
                    @if (count($entreprise)<=0) <tr>
                        <td> Aucun entreprise collaborer</td>
                        </tr>
                    @else
                        @foreach($entreprise as $etp)
                        <tr  class="information" data-id="{{$etp->entreprise_id}}" id="{{$etp->entreprise_id}}">
                            <td role="button"  onclick="afficherInfos();"><img src="{{asset("images/entreprises/".$etp->logo_etp)}}" style="width: 80px;height: 80px;text-align:center;"><span class="ms-3">{{$etp->nom_etp}}</span></td>
                            <td role="button"  onclick="afficherInfos();">
                                <img src="{{asset("images/responsables/".$etp->photos_resp)}}" style="height:60px; width:60px;border-radius:100%"><span class="ms-3">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
                            </td>
                        <td>
                            <a  href="" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$etp->entreprise_id}}"><i class='bx bx-trash bx_supprimer'></i></a>
                        </td>
    
                           {{-- modal delete  --}}
                        <div class="modal fade" id="exampleModal_{{$etp->entreprise_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(192, 37, 55);">
                                        <h4 class="modal-title text-white">Avertissement !</h4>
                                    </div>
                                    <div class="modal-body">
                                        <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button> --}}
                                        <button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                        <form action="{{route('mettre_fin_cfp_etp') }}"  method="POST">
                                            @csrf
                                            <input name="etp_id" type="text" value="{{$etp->entreprise_id}}" hidden>
                                            <div class="mt-4 mb-4">
                                                <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            {{-- fin modal delete --}}
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    
    
          {{-- Tab 1 content --}}
        </div>
        <div class="tab-pane fade show active" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <div class="row mt-2">
                <div class="col-12 col-lg-6">
                    @if(Session::has('success'))
                    <div class="alert alert-success align-middle" >
                        <p> {{Session::get('success')}}</p>
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div style="height: 60px" class="alert alert-danger">
                        <p> {{Session::get('error')}}</p>
                    </div>
                    @endif
                    <p style="font-size:20px"> &nbsp;Invité une entreprise</p>
                    <form class="form form_colab mt-3" action="{{ route('create_cfp_etp') }}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="">Noms :</label>
                        <input style="width: 500px" type="text" class="form-control" name="nom_resp"  required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Email :</label>
                        <input style="width: 500px" type="email" class="form-control" name="email_resp" required>
                    </div>
                    <button type="submit" class="btn btn mt-2" style="color: white;background:#7635dc" >Envoyer l'invitation</button>
                    </form>
                </div>
                <div class="col-12 col-lg-6">
                    <p style="font-size:20px">Gérer les invitation</p>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list text-center">
                                <li class="nav-item" style="width: 300px;">
                                    <a href="#" class="nav-link active " style="border-bottom: 3px solid black" id="home-tab" data-bs-toggle="tab" data-bs-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                                        Invitations en attentes
                                    </a>
                                </li>
                                <li class="nav-item ms-5" style="width: 300px;">
                                    <a href="#" class="nav-link" id="profile-tab" style="border-bottom: 3px solid black" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        Invitations réfuser
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
    
                        <div class="tab-pane fade show active" id="invitation" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive text-center">
        
                                <table class="table  table-borderless table-sm mt-4" >
                                    <tbody id="data_collaboration" >
        
                                        @if (count($invitation_etp)<=0) <tr style="text-align:left">
                                            <td > Aucun invitations en attente</td>
                                            </tr>
                                            @else
                                            @foreach($invitation_etp as $invit_etp)
                                            <tr>
                                                <td>
                                                    <div align="left">
                                                        <strong>{{$invit_etp->nom_resp.' '.$invit_etp->prenom_resp}}</strong>
                                                        <p style="color: rgb(238, 150, 18)">{{$invit_etp->email_resp}}</p>
        
                                                </td>
                                                <td>
                                                    <div align="left">
                                                        <strong>{{$invit_etp->nom_etp}}</strong>
                                                        <p style="color: rgb(126, 124, 121)"> <strong>({{$invit_etp->nom_secteur}})</strong></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('accept_cfp_etp',$invit_etp->id) }}">
                                                        <strong>
                                                            <h5><i class="bx bxs-check-circle actions" title="Accepter"></i> accepter</h5>
                                                        </strong>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('annulation_cfp_etp',$invit_etp->id) }}">
                                                        <strong>
                                                            <h5><i class="bx bxs-x-circle actions" title="Refuser"></i> réfuser</h5>
                                                        </strong>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
        
                            </div>
        
                        </div>
        
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        
                            <div class="table-responsive text-center">
                                <table class="table  table-borderless table-sm mt-4">
                                    <tbody>
                                        @if (count($refuse_demmande_etp)<=0) <tr style="text-align:left">
                                            <td class="3t-2"> Aucun invitation réfuser</td>
                                            </tr>
                                            @else
                                            @foreach($refuse_demmande_etp as $refuse_invit)
                                            <tr>
                                                <td>
                                                    <div align="left">
                                                        {{$refuse_invit->nom_etp}}
                                                    </div>
                                                </td>
                                                <td>
                                                        le {{$refuse_invit->date_refuse}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
                            </div>
        
        
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
          Tab 3 content
        </div>
      </div>
      <div class="infos mt-3">
        <div class="row">
            <div class="col">
                <p class="m-0 text-center">INFORMATION</p>
            </div>
            <div class="col text-end">
                <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
            </div>
            <hr class="mt-2">
            <div style="font-size: 13px">
    
                <div class="mt-1 text-center mb-3">
                    <span id="logo"></span>
                </div>
                <div class="mt-1 text-center">
                    <span id="nom_entreprise" style="color: #64b5f6; font-size: 22px; text-transform: uppercase; "></span>
                </div>
    
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-user-gear"></i></div>
                        <div class="col-md-3">Responsable</div>
                        <div class="col-md">
                            <span id="nom_reponsable" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                            <span id="prenom_responsable" style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="col-md-3">Adresse</div>
                        <div class="col-md">
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="adrlot"></span>
                                </div>
                                <div class="com-md-12">
                                    <span id="adrlot2"></span>
                                </div>
                                <div class="col-md-12">
                                    <span id="adrlot3"></span>
                                </div>
                                <div class="col-md-12">
                                    <span id="adrlot4"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-envelope"></i></div>
                        <div class="col-md-3">E-mail</div>
                        <div class="col-md">
                            <span id="email_etp"><span>
                    </div>
    
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-phone"></i></div>
                        <div class="col-md-3">Tel</div>
                        <div class="col-md">
                            <span id="telephone_etp"><span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-globe"></i></div>
                        <div class="col-md-3">Site web</div>
                        <div class="col-md"><span id="site_etp"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      {{-- tapitra --}}
      @elseif (Session::has('success'))
      <div class="tab-content" id="ex1-content">
        <div
          class="tab-pane fade "
          id="ex1-tabs-1"
          role="tabpanel"
          aria-labelledby="ex1-tab-1"
        >
          {{-- Tab 1 content --}}
            <div class="row">
                
            </div> 
            @if(Session::has('message'))
            <div class="alert alert-danger close">
                <strong> {{Session::get('message')}}</strong>
            </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom de l'entreprise</th>
                        <th>Réferent principal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="data_collaboration" style="font-size: 15.5px;">
    
                    @if (count($entreprise)<=0) <tr>
                        <td> Aucun entreprise collaborer</td>
                        </tr>
                    @else
                        @foreach($entreprise as $etp)
                        <tr  class="information" data-id="{{$etp->entreprise_id}}" id="{{$etp->entreprise_id}}">
                            <td role="button"  onclick="afficherInfos();"><img src="{{asset("images/entreprises/".$etp->logo_etp)}}" style="width:120px;height:60px;text-align:center;"><span class="ms-3">{{$etp->nom_etp}}</span></td>
                            <td role="button"  onclick="afficherInfos();">
                                <img src="{{asset("images/responsables/".$etp->photos_resp)}}" style="height:60px; width:60px;border-radius:100%"><span class="ms-3">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
                            </td>
                        <td>
                            <a  href="" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$etp->entreprise_id}}"><i class='bx bx-trash bx_supprimer'></i></a>
                        </td>
    
                           {{-- modal delete  --}}
                        <div class="modal fade" id="exampleModal_{{$etp->entreprise_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(192, 37, 55);">
                                        <h4 class="modal-title text-white">Avertissement !</h4>
                                    </div>
                                    <div class="modal-body">
                                        <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button> --}}
                                        <button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                        <form action="{{route('mettre_fin_cfp_etp') }}"  method="POST">
                                            @csrf
                                            <input name="etp_id" type="text" value="{{$etp->entreprise_id}}" hidden>
                                            <div class="mt-4 mb-4">
                                                <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            {{-- fin modal delete --}}
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    
    
          {{-- Tab 1 content --}}
        </div>
        <div class="tab-pane fade show active" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <div class="row mt-2">
                <div class="col-12 col-lg-6">
                    @if(Session::has('success'))
                    <div class="alert alert-success align-middle" >
                        <p> {{Session::get('success')}}</p>
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div style="height: 60px" class="alert alert-danger">
                        <p> {{Session::get('error')}}</p>
                    </div>
                    @endif
                    <p style="font-size:20px"> &nbsp;Invité une entreprise</p>
                    <form class="form form_colab mt-3" action="{{ route('create_cfp_etp') }}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="">Noms :</label>
                        <input style="width: 500px" type="text" class="form-control" name="nom_resp"  required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Email :</label>
                        <input style="width: 500px" type="email" class="form-control" name="email_resp" required>
                    </div>
                    <button type="submit" class="btn btn mt-2" style="color: white;background:#7635dc" >Envoyer l'invitation</button>
                    </form>
                </div>
                <div class="col-12 col-lg-6">
                    <p style="font-size:20px">Gérer les invitation</p>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list text-center">
                                <li class="nav-item" style="width: 300px;">
                                    <a href="#" class="nav-link active " style="border-bottom: 3px solid black" id="home-tab" data-bs-toggle="tab" data-bs-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                                        Invitations en attentes
                                    </a>
                                </li>
                                <li class="nav-item ms-5" style="width: 300px;">
                                    <a href="#" class="nav-link" id="profile-tab" style="border-bottom: 3px solid black" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        Invitations réfuser
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
    
                        <div class="tab-pane fade show active" id="invitation" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive text-center">
        
                                <table class="table  table-borderless table-sm mt-4" >
                                    <tbody id="data_collaboration" >
        
                                        @if (count($invitation_etp)<=0) <tr style="text-align:left">
                                            <td > Aucun invitations en attente</td>
                                            </tr>
                                            @else
                                            @foreach($invitation_etp as $invit_etp)
                                            <tr>
                                                <td>
                                                    <div align="left">
                                                        <strong>{{$invit_etp->nom_resp.' '.$invit_etp->prenom_resp}}</strong>
                                                        <p style="color: rgb(238, 150, 18)">{{$invit_etp->email_resp}}</p>
        
                                                </td>
                                                <td>
                                                    <div align="left">
                                                        <strong>{{$invit_etp->nom_etp}}</strong>
                                                        <p style="color: rgb(126, 124, 121)"> <strong>({{$invit_etp->nom_secteur}})</strong></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('accept_cfp_etp',$invit_etp->id) }}">
                                                        <strong>
                                                            <h5><i class="bx bxs-check-circle actions" title="Accepter"></i> accepter</h5>
                                                        </strong>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('annulation_cfp_etp',$invit_etp->id) }}">
                                                        <strong>
                                                            <h5><i class="bx bxs-x-circle actions" title="Refuser"></i> réfuser</h5>
                                                        </strong>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
        
                            </div>
        
                        </div>
        
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        
                            <div class="table-responsive text-center">
                                <table class="table  table-borderless table-sm mt-4">
                                    <tbody>
                                        @if (count($refuse_demmande_etp)<=0) <tr style="text-align:left">
                                            <td class="3t-2"> Aucun invitation réfuser</td>
                                            </tr>
                                            @else
                                            @foreach($refuse_demmande_etp as $refuse_invit)
                                            <tr>
                                                <td>
                                                    <div align="left">
                                                        {{$refuse_invit->nom_etp}}
                                                    </div>
                                                </td>
                                                <td>
                                                        le {{$refuse_invit->date_refuse}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
                            </div>
        
        
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
          Tab 3 content
        </div>
      </div>
      <div class="infos mt-3">
        <div class="row">
            <div class="col">
                <p class="m-0 text-center">INFORMATION</p>
            </div>
            <div class="col text-end">
                <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
            </div>
            <hr class="mt-2">
            <div style="font-size: 13px">
    
                <div class="mt-1 text-center mb-3">
                    <span id="logo"></span>
                </div>
                <div class="mt-1 text-center">
                    <span id="nom_entreprise" style="color: #64b5f6; font-size: 22px; text-transform: uppercase; "></span>
                </div>
    
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-user-gear"></i></div>
                        <div class="col-md-3">Responsable</div>
                        <div class="col-md">
                            <span id="nom_reponsable" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                            <span id="prenom_responsable" style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="col-md-3">Adresse</div>
                        <div class="col-md">
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="adrlot"></span>
                                </div>
                                <div class="com-md-12">
                                    <span id="adrlot2"></span>
                                </div>
                                <div class="col-md-12">
                                    <span id="adrlot3"></span>
                                </div>
                                <div class="col-md-12">
                                    <span id="adrlot4"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-envelope"></i></div>
                        <div class="col-md-3">E-mail</div>
                        <div class="col-md">
                            <span id="email_etp"><span>
                    </div>
    
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-phone"></i></div>
                        <div class="col-md-3">Tel</div>
                        <div class="col-md">
                            <span id="telephone_etp"><span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-globe"></i></div>
                        <div class="col-md-3">Site web</div>
                        <div class="col-md"><span id="site_etp"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      @else
      <div class="tab-content" id="ex1-content">
        <div
          class="tab-pane fade show active"
          id="ex1-tabs-1"
          role="tabpanel"
          aria-labelledby="ex1-tab-1"
        >
          {{-- Tab 1 content --}}
            <div class="row">
                
            </div> 
            @if(Session::has('message'))
            <div class="alert alert-danger close">
                <strong> {{Session::get('message')}}</strong>
            </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom de l'entreprise</th>
                        <th>Réferent principal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="data_collaboration" style="font-size: 15.5px;">
    
                    @if (count($entreprise)<=0) <tr>
                        <td> Aucun entreprise collaborer</td>
                        </tr>
                    @else
                        @foreach($entreprise as $etp)
                        <tr  class="information" data-id="{{$etp->entreprise_id}}" id="{{$etp->entreprise_id}}">
                            <td role="button"  onclick="afficherInfos();"><img src="{{asset("images/entreprises/".$etp->logo_etp)}}" style="width:120px;height:60px;text-align:center;"><span class="ms-3">{{$etp->nom_etp}}</span></td>
                            <td role="button"  onclick="afficherInfos();">
                                <img src="{{asset("images/responsables/".$etp->photos_resp)}}" style="height:60px; width:60px;border-radius:100%"><span class="ms-3">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
                            </td>
                        <td>
                            <a  href="" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$etp->entreprise_id}}"><i class='bx bx-trash bx_supprimer'></i></a>
                        </td>
    
                           {{-- modal delete  --}}
                        <div class="modal fade" id="exampleModal_{{$etp->entreprise_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(192, 37, 55);">
                                        <h4 class="modal-title text-white">Avertissement !</h4>
                                    </div>
                                    <div class="modal-body">
                                        <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button> --}}
                                        <button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                        <form action="{{route('mettre_fin_cfp_etp') }}"  method="POST">
                                            @csrf
                                            <input name="etp_id" type="text" value="{{$etp->entreprise_id}}" hidden>
                                            <div class="mt-4 mb-4">
                                                <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            {{-- fin modal delete --}}
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    
    
          {{-- Tab 1 content --}}
        </div>
        <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <div class="row mt-2">
                <div class="col-12 col-lg-6">
                    @if(Session::has('success'))
                    <div class="alert alert-success align-middle" >
                        <p> {{Session::get('success')}}</p>
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <p> {{Session::get('error')}}</p>
                    </div>
                    @endif
                    <p style="font-size:20px"> &nbsp;Invité une entreprise</p>
                    <form class="form form_colab mt-3" action="{{ route('create_cfp_etp') }}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="">Noms :</label>
                        <input style="width: 500px" type="text" class="form-control" name="nom_resp"  required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Email :</label>
                        <input style="width: 500px" type="email" class="form-control" name="email_resp" required>
                    </div>
                    <button type="submit" class="btn btn mt-2" style="color: white;background:#7635dc" >Envoyer l'invitation</button>
                    </form>
                </div>
                <div class="col-12 col-lg-6">
                    <p style="font-size:20px">Gérer les invitation</p>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list text-center">
                                <li class="nav-item te" style="width: 300px;">
                                    <a href="#" class="nav-link active " style="border-bottom: 3px solid black" id="home-tab" data-bs-toggle="tab" data-bs-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                                        Invitations en attentes
                                    </a>
                                </li>
                                <li class="nav-item ms-5 te" style="width: 300px;">
                                    <a href="#" class="nav-link" id="profile-tab" style="border-bottom: 3px solid black" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        Invitations réfuser
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
    
                        <div class="tab-pane fade show active" id="invitation" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive text-center">
        
                                <table class="table  table-borderless table-sm mt-4" >
                                    <tbody id="data_collaboration" >
        
                                        @if (count($invitation_etp)<=0) 
                                            <tr style="text-align:left">
                                            <td > Aucun invitations en attente</td>
                                            </tr>
                                            @else
                                            @foreach($invitation_etp as $invit_etp)
                                            <tr>
                                                <td>
                                                    <div align="left">
                                                        <strong>{{$invit_etp->nom_resp.' '.$invit_etp->prenom_resp}}</strong>
                                                        <p style="color: rgb(238, 150, 18)">{{$invit_etp->email_resp}}</p>
        
                                                </td>
                                                <td>
                                                    <div align="left">
                                                        <strong>{{$invit_etp->nom_etp}}</strong>
                                                        <p style="color: rgb(126, 124, 121)"> <strong>({{$invit_etp->nom_secteur}})</strong></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('accept_cfp_etp',$invit_etp->id) }}">
                                                        <strong>
                                                            <h5><i class="bx bxs-check-circle actions" title="Accepter"></i> accepter</h5>
                                                        </strong>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('annulation_cfp_etp',$invit_etp->id) }}">
                                                        <strong>
                                                            <h5><i class="bx bxs-x-circle actions" title="Refuser"></i> réfuser</h5>
                                                        </strong>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
        
                            </div>
        
                        </div>
        
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        
                            <div class="table-responsive text-center">
                                <table class="table  table-borderless table-sm mt-4">
                                    <tbody>
                                        @if (count($refuse_demmande_etp)<=0) <tr>
                                            <tr style="text-align:left">
                                            <td class="mt-2" > Aucun invitation réfuser</td>
                                            </tr>
                                            </tr>
                                            @else
                                            @foreach($refuse_demmande_etp as $refuse_invit)
                                            <tr>
                                                <td>
                                                    <div align="left">
                                                        {{$refuse_invit->nom_etp}}
                                                    </div>
                                                </td>
                                                <td>
                                                        le {{$refuse_invit->date_refuse}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
                            </div>
        
        
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
          Tab 3 content
        </div>
      </div>
      <div class="infos mt-3">
        <div class="row">
            <div class="col">
                <p class="m-0 text-center">INFORMATION</p>
            </div>
            <div class="col text-end">
                <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
            </div>
            <hr class="mt-2">
            <div style="font-size: 13px">
    
                <div class="mt-1 text-center mb-3">
                    <span id="logo"></span>
                </div>
                <div class="mt-1 text-center">
                    <span id="nom_entreprise" style="color: #64b5f6; font-size: 22px; text-transform: uppercase; "></span>
                </div>
    
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-user-gear"></i></div>
                        <div class="col-md-3">Responsable</div>
                        <div class="col-md">
                            <span id="nom_reponsable" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                            <span id="prenom_responsable" style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="col-md-3">Adresse</div>
                        <div class="col-md">
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="adrlot"></span>
                                </div>
                                <div class="com-md-12">
                                    <span id="adrlot2"></span>
                                </div>
                                <div class="col-md-12">
                                    <span id="adrlot3"></span>
                                </div>
                                <div class="col-md-12">
                                    <span id="adrlot4"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-envelope"></i></div>
                        <div class="col-md-3">E-mail</div>
                        <div class="col-md">
                            <span id="email_etp"><span>
                    </div>
    
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-phone"></i></div>
                        <div class="col-md-3">Tel</div>
                        <div class="col-md">
                            <span id="telephone_etp"><span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-globe"></i></div>
                        <div class="col-md-3">Site web</div>
                        <div class="col-md"><span id="site_etp"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      @endif


      

      
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $("#totale_invitations").on('click', function(e) {
        $('#data_collaboration').empty();

        var html = '';
        html += ' <tr>';
        html += '<td><div align="left">';
        html += '<strong>ANTOENJARA Noam Francisco</strong>';
        html += '<p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>';
        html += '</div></td>';

        html += '<td><div align="rigth">';
        html += '<a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>';
        html += '</div></td>';

        html += '<td><div align="rigth">';
        html += '<a href="#" style="color: green"><i class="bx bxs-check-circle actions" title="Details"></i>accepter </a>';
        html += '</div></td>';

        $('#data_collaboration').append(html);



        // $.ajax({
        //     method: "GET"
        //     , url: "{{route('edit_projet')}}"
        //     , data: {
        //         Id: id
        //     }
        //     , dataType: "html"
        //     , success: function(response) {

        //         var userData = JSON.parse(response);
        //         for (var $i = 0; $i < userData.length; $i++) {
        //             $("#projetModif").val(userData[$i].nom_projet);

        //             $('#id_value').val(userData[$i].id);

        //         }
        //     }
        //     , error: function(error) {
        //         console.log(error)
        //     }
        // });
    });

    $("#invitations_refuser").on('click', function(e) {
        $('#data_collaboration').empty();

        var html = '';
        html += ' <tr>';
        html += '<td><div align="left">';
        html += '<strong>ANTOENJARA Noam Francisco</strong>';
        html += '<p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>';
        html += '</div></td>';

        html += '<td><div align="rigth">';
        html += '<a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>';
        html += '</div></td>';

        $('#data_collaboration').append(html);



        // $.ajax({
        //     method: "GET"
        //     , url: "{{route('edit_projet')}}"
        //     , data: {
        //         Id: id
        //     }
        //     , dataType: "html"
        //     , success: function(response) {

        //         var userData = JSON.parse(response);
        //         for (var $i = 0; $i < userData.length; $i++) {
        //             $("#projetModif").val(userData[$i].nom_projet);

        //             $('#id_value').val(userData[$i].id);

        //         }
        //     }
        //     , error: function(error) {
        //         console.log(error)
        //     }
        // });
    });
    //     $(".information").on('click', function(e) {

    //         let id = $(this).data("id");

    //     $.ajax({
    //         type: "GET"
    //         , url: 'information_entreprise'
    //         , data: {
    //             Id: id
    //         }
    //         , success: function(response) {

    //             let userData = JSON.parse(response);
    //             console.log(userData);
    //             //parcourir le premier tableau contenant les info sur les programmes
    //             for (let $i = 0; $i < userData.length; $i++){
    //                $("#nom_etp").text(userData[$i].nom_etp);
    //                 $("#email_etp").text(userData[$i].email_etp);
    //                 $("#telephone_etp").text(userData[$i].telephone_etp);
    //                 $("#site_etp").text(userData[$i].site_etp);
    //                 $("#logo_etp").text(userData[$i].logo_etp);
    //             }


    //         }
    //         , error: function(error) {
    //             console.log(JSON.parse(error));
    //         }
    //     });
    // });
    $(".information").on('click', function(e) {
        let id = $(this).data("id");;
        $.ajax({
            method: "GET"
            , url: "{{route('information_entreprise')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {
                let userData = JSON.parse(response);
                console.log(userData);
                //parcourir le premier tableau contenant les info sur les programmes
                for (let $i = 0; $i < userData.length; $i++) {

                    let url_photo = '<img src="{{asset("images/entreprises/:url_img")}}" style="width:120px;height:60px">';
                    url_photo = url_photo.replace(":url_img", userData[$i].logo_etp);
                    $("#logo").html(" ");
                    $("#logo").append(url_photo);
                    $("#nom_entreprise").text(userData[$i].nom_etp);
                    $("#nom_reponsable").text(': '+userData[$i].nom_resp);
                    $("#prenom_responsable").text(userData[$i].prenom_resp);
                    $("#adrlot").text(': '+userData[$i].adresse_lot);
                    $("#adrlot3").text(': '+userData[$i].adresse_ville);
                    $("#adrlot4").text(': '+userData[$i].adresse_region);
                    $("#email_etp").text(': '+userData[$i].email_responsable);
                    $("#telephone_etp").text(': '+userData[$i].telephone_etp);
                    $("#site_etp").text(': '+userData[$i].site_etp);
                }
            }
        });
    });

</script>
@endsection
