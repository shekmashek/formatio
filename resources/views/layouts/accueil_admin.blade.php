@extends('./layouts/admin')
@section('content')
<script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
<style>
#example2 {
  box-shadow: 1px 1px 7px #888888;
}

.ck:hover{
    background-color: #888888;
    font-size: 12px;
}

.a1:hover{
    background-color: rgb(245, 237, 237);
    border-radius: 7px;
    padding-block-start: 1px;
    cursor: pointer;
    font-size: 11.5px;
}
</style>

<div class="container-fluid" id="" style="font-size: 11px;">
    <div class="row">
    {{-- <div class="shadow-sm p-3 mb-5 bg-body rounded"> --}}

        {{-- card le plus haut --}}
    {{-- <div class="row line_default justify-content-center">
        {{-- <p class="text-center">Bienvenue dans votre espace d'administration</p> --}}
        {{-- <img src="{{asset('img/images/logo_transparent_background.png')}}" alt="" class="img-fluid image_fond">
        <div class="d-flex align-items-center justify-content-between " >
            <p class="p-1 m-0"><img src="{{asset('assets/images/formateurs/20220215123536.jpg')}}" alt=""></p>
            <a href="">
            </a>
        </div>
    </div>    style="background-color: #74b7eb"-eo ambony ty couleur ty --}}
        <div class="col-lg-6">
            <div class="card text-white mb-3 mt-3" >
                <div class="" style="height:45px;"><img id="example2" class="ms-3" src="{{asset('images/formateurs/20220215123536.jpg')}}" alt="image stagiaire" style="position: absolute; margin-top: 8px; border-radius: 100%; height:60px; width:60px"></div>
                {{-- <div class="card-header" style="height:45px;"><img id="example2" class="ms-3" src="@foreach($phone_tmp as $item) {{$item->photos}}  @endforeach" alt="image stagiaire" style="position: absolute; margin-top: 8px; border-radius: 100%; height:60px; width:60px"></div> --}}
                {{-- <div class="rond"><img src="" alt=""></div> --}}
                <div class="card-body text-dark" style="background-color: #fff; border-radius: 3px">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="card-title" style="font-size: 16px">
                                    @foreach ($phone_tmp as $item)
                                        {{$item->nom_stagiaire}} {{$item->prenom_stagiaire}}
                                    @endforeach
                                </span><br>
                                <p class="card-text mt-2 m-1 " style="color: rgb(136, 136, 136)"><i class="fas fa-phone-alt"></i>&nbsp;
                                    <span>
                                        @foreach ($phone_tmp as $item)
                                            {{$item->telephone_stagiaire}}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-1 "  style="color: rgb(124, 116, 116)"><i class="fas fa-mail-bulk"></i>&nbsp;
                                    <span>
                                        @foreach ($phone_tmp as $item)
                                            {{$item->mail_stagiaire}}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-1 "  style="color: rgb(136, 136, 136)"><i class="fas fa-map"></i>&nbsp;
                                    <span>
                                        @foreach ($phone_tmp as $item)
                                            {{$item->ville}} • {{$item->region}} • {{$item->lot}}
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <span class="card-title" style="font-size: 16px; color: #7635DC"><i class="fas fa-id-card"></i> Informations professionnelles </span><br>
                                <p class="card-text mt-2 m-1 " style="color: rgb(136, 136, 136)"><i class="fas fa-phone-alt"></i>&nbsp;
                                    <span>
                                        @foreach ($phone_tmp as $item)
                                            {{$item->fonction_stagiaire}}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-1 "  style="color: rgb(124, 116, 116)"><i class="fas fa-briefcase"></i>&nbsp;
                                    <span>
                                        @foreach($phone_tmp as $item)
                                            {{$item->nom_departement}}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-1 "  style="color: rgb(136, 136, 136)"><i class="fas fa-code-branch"></i>&nbsp;
                                    <span>
                                        @foreach($phone_tmp as $item)
                                            {{$item->nom_branche}}
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card text-white mb-3 mt-3" style="border-color: #7635DC">
                {{-- <div class="card-header bg-white" style="height:38px;"><span class="card-title" style="font-size: 5; color: #7635DC" ><i class="fas fa-chart-pie"></i> Dashboard </span></div> --}}
                    <div class="card-body text-dark" style="background-color: #fff; border-radius: 3px">
                        <div class="row">
                            <div class="col-lg-4 p-1 mt-1 m-0">
                                <div class="shadow-sm p-3 mb-1  mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="p-0 m-0 ms-0" style="color: #7635DC; font-size: 12px" > Coût pédagogique</p>
                                            <p class="p-0 m-0 mt-1 ms-0" style="font-size: 15px;">900.000 Ar</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="" >
                                                <p style="padding: .6rem 1.4rem;  background-image: linear-gradient(to right, #755dd0 , #a0a5ca);color:white; border:none;border-radius: 50%;">
                                                    {{-- mila natao centre --}}
                                                    <i class='bx bxs-wallet' style=" font-size: 20px; position: relative;right: .65rem;"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 p-1 mt-1 m-0">
                                <div class="shadow-sm p-3 mb-1 mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="p-0 m-0 ms-0" style="color: #7635DC; font-size: 12px" >Frais annexe</p>
                                            <p class="p-0 m-0 mt-1 ms-0" style="font-size: 15px;">200.000 Ar</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="" >
                                                <p style="padding: .6rem 1.4rem; background-image: linear-gradient(to right, rgb(248, 131, 131) , rgb(250, 250, 108));color:white; border:none;border-radius: 50%;">
                                                    <i class='bx bxs-wallet' style=" font-size: 20px; position: relative;right: .65rem;"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 p-1 mt-1 m-0">
                                <div class="shadow-sm p-3 mb-1 mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="p-0 m-0 ms-0" style="color: #7635DC; font-size: 12px" >Coût total</p>
                                            <p class="p-0 m-0 mt-1 ms-0" style="font-size: 15px;">1.100.000 Ar</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="" >
                                                <p style="padding: .6rem 1.4rem; background-image: linear-gradient(to right, #895ad3 , #b29dd3) ;color:white; border:none;border-radius: 50%;">
                                                    <i class='bx bxs-wallet' style=" font-size: 20px; position: relative;right: .65rem;"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 p-1 mt-1 m-0">
                                <div class="shadow-sm p-3 mb-1  mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="p-0 m-0 ms-0" style="color: #7635DC; font-size: 12px" >NB heure total</p>
                                            <p class="p-0 m-0 mt-1 ms-0" style="font-size: 15px;">320 h</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="" >
                                                <p style="padding: .6rem 1.4rem;  background-image: linear-gradient(to right, #755dd0 , #a0a5ca);color:white; border:none;border-radius: 50%;">
                                                    <i class='bx bx-time-five' style=" font-size: 20px; position: relative;right: .65rem;"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 p-1 mt-1 m-0">
                                <div class="shadow-sm p-3 mb-1  mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="p-0 m-0 ms-0" style="color: #7635DC; font-size: 12px" >Assiduité</p>
                                            <p class="p-0 m-0 mt-1 ms-0" style="font-size: 15px;">20 %</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="" >
                                                <p style="padding: .6rem 1.4rem; background-image: linear-gradient(to right, rgb(248, 131, 131) , rgb(250, 250, 108));color:white; border:none;border-radius: 50%;">
                                                    <i class='bx bxs-briefcase-alt-2'  style=" font-size: 20px; position: relative;right: .65rem;"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 p-1 mt-1 m-0">
                                <div class="shadow-sm p-3 mb-1  mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="p-0 m-0 ms-0" style="color: #7635DC; font-size: 12px" >vide</p>
                                            <p class="p-0 m-0 mt-1 ms-0" style="font-size: 15px;">vide</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="" >
                                                <p style="padding: .6rem 1.4rem; background-image: linear-gradient(to right, #895ad3 , #b29dd3);color:white; border:none;border-radius: 50%;">
                                                    <i class="fas fa-user" style=" font-size: 20px; position: relative;right: .55rem;"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- <div>
                            <span class="ms-2" style="color: #7635DC">Nombre heure total:</span>&nbsp;<span >320 h</span>
                        </div>
                        <div>
                            <span class="ms-2" style="color: #7635DC">Assiduité:</span>&nbsp;<span >32%</span>
                        </div> --}}
                    </div>
            </div>
        </div>

    {{-- {{date("l, j F  Y ")}} --}}
    {{-- </div> --}}

    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card text-white mb-3 mt-3" style="background-color: #74b7eb">
                <div class="card-body text-dark" style="background-color: #fff; border-radius: 3px">
                    <span class="card-title" style="font-size: 16px; color: #7635DC">  Prochaines formations </span><br>
                    <div class="a1">
                        <p class="card-text mt-2 m-1" style="color: rgb(136, 136, 136); font-size: 13px;"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1"  style="color: rgb(136, 136, 136)"><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span><hr>
                    </div>

                    <div class="a1">
                        <p class="card-text mt-0 m-1" style="color: rgb(136, 136, 136); font-size: 13px;"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1"  style="color: rgb(136, 136, 136)"><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span><hr>
                    </div>

                    <div class="a1">
                        <p class="card-text mt-0 m-1" style="color: rgb(136, 136, 136); font-size: 13px;"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1"  style="color: rgb(136, 136, 136)"><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card text-white mb-3 mt-3" style="background-color: #74b7eb">
                <div class="card-body text-dark" style="background-color: #fff; border-radius: 3px">
                    <span class="card-title" style="font-size: 16px; color: #7635DC">  Dernières formations </span><br>
                    <div class="a1">
                        <p class="card-text mt-2 m-1" style="color: rgb(136, 136, 136); font-size: 13px;"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1"  style="color: rgb(136, 136, 136)"><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span><hr>
                    </div>

                    <div class="a1">
                        <p class="card-text mt-0 m-1" style="color: rgb(136, 136, 136); font-size: 13px;"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1"  style="color: rgb(136, 136, 136)"><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span><hr>
                    </div>

                    <div class="a1">
                        <p class="card-text mt-0 m-1" style="color: rgb(136, 136, 136); font-size: 13px;"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1"  style="color: rgb(136, 136, 136)"><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3"  style="color: rgb(136, 136, 136)"><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
