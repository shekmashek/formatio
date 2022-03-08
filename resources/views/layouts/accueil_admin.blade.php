@extends('./layouts/admin')
@section('content')
<script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
<link rel="stylesheet" href="{{asset('css/stagiaires.css')}}">
<div class="container-fluid" id="font">
    <div class="row">
        <div class="col-lg-6">
            <div class="card text-white mb-3 mt-3" id="bc">
                <div class="" style="height:45px; ">
                    <img id="example2" src="@foreach($phone_tmp as $item) {{$item->photos}}  @endforeach" alt="image stagiaire">
                    <img id="exemple1" class="ms-3" src="{{asset('images/stagiaires/ilaina.png')}}" alt="Image">
                </div>
                <div class="card-body text-dark mt-3" id="cl">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="card-title" id="sp">
                                    @foreach ($phone_tmp as $item)
                                        {{$item->nom_stagiaire}} {{$item->prenom_stagiaire}}
                                    @endforeach
                                </span><br>
                                <p class="card-text mt-2 m-1 " id="pp"><i class="fas fa-phone-alt"></i>&nbsp;
                                    <span>
                                        @foreach ($phone_tmp as $item)
                                            {{$item->telephone_stagiaire}}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-1 " id="p1"><i class="fas fa-mail-bulk"></i>&nbsp;
                                    <span>
                                        @foreach ($phone_tmp as $item)
                                            {{$item->mail_stagiaire}}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-1 " id="pp"><i class="fas fa-map"></i>&nbsp;
                                    <span>
                                        @foreach ($phone_tmp as $item)
                                            {{$item->ville}} • {{$item->region}} • {{$item->lot}}
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <span class="card-title" id="ftt" ><i class="fas fa-id-card"></i> Informations professionnelles </span><br>
                                <p class="card-text mt-2 m-1 " id="ip" ><i class="fas fa-phone-alt"></i>&nbsp;
                                    <span>
                                        @foreach ($phone_tmp as $item)
                                            {{$item->fonction_stagiaire}}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-1 " id="fpt"><i class="fas fa-briefcase"></i>&nbsp;
                                    <span>
                                        @foreach($phone_tmp as $item)
                                            {{$item->nom_departement}}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-1 " id="pp" ><i class="fas fa-code-branch"></i>&nbsp;
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
            <div class="card text-white mb-3 mt-3" id="bc">
                    <div class="card-body text-dark" id="ffp">
                        <div class="row">
                            <div class="col-lg-4 p-1 mt-1 m-0">
                                <div class="shadow-sm p-3 mb-1  mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8" >
                                            <p class="p-0 m-0 ms-0" id="ft2"> Coût pédagogique</p>
                                            <p class="p-0 m-0 mt-1 ms-0" id="ft155">900.000 Ar</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="" >
                                                <p id="pddp">
                                                    <i class='bx bxs-wallet' id="sssq"></i>
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
                                            <p class="p-0 m-0 ms-0" id="coll">Frais annexe</p>
                                            <p class="p-0 m-0 mt-1 ms-0" id="ft155">200.000 Ar</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <p id="qssq">
                                                    <i class='bx bxs-wallet' id="sssq"></i>
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
                                            <p class="p-0 m-0 ms-0" id="coll">Coût total</p>
                                            <p class="p-0 m-0 mt-1 ms-0" id="ft155">1.100.000 Ar</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <p id="wq">
                                                    <i class='bx bxs-wallet' id="sssq"></i>
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
                                            <p class="p-0 m-0 ms-0" id="coll">NB heure total</p>
                                            <p class="p-0 m-0 mt-1 ms-0" id="ft155">320 h</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <p id="xw">
                                                    <i class='bx bx-time-five' id="sssq"></i>
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
                                            <p class="p-0 m-0 ms-0" id="coll">Assiduité</p>
                                            <p class="p-0 m-0 mt-1 ms-0" id="fs">20 %</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <p id="pdn">
                                                    <i class='bx bxs-briefcase-alt-2'  id="sssq"></i>
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
                                            <p class="p-0 m-0 ms-0" id="coll">vide</p>
                                            <p class="p-0 m-0 mt-1 ms-0" id="fs">vide</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <p id="cx">
                                                    <i class="fas fa-user" id="qxqx"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card text-white mb-3 mt-2" id="n">
                <div class="card-body text-dark" id="b">
                    <span class="card-title" id="ff">  Prochaines formations </span><br>
                    <div class="a1">
                        <p class="card-text mt-2 m-1" id="ddd"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1" id="sdf" ><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span><hr>
                    </div>

                    <div class="a1">
                        <p class="card-text mt-0 m-1" id="ddd"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1" id="sdf" ><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span><hr>
                    </div>

                    <div class="a1">
                        <p class="card-text mt-0 m-1" id="ddd"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1" id="sdf" ><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card text-white mb-3 mt-2" id="n">
                <div class="card-body text-dark" id="b">
                    <span class="card-title" id="ff">  Dernières formations </span><br>
                    <div class="a1">
                        <p class="card-text mt-2 m-1" id="" id="ddd"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1" id="sdf" ><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span><hr>
                    </div>

                    <div class="a1">
                        <p class="card-text mt-0 m-1" id="" id="ddd"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1" id="sdf" ><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span><hr>
                    </div>

                    <div class="a1">
                        <p class="card-text mt-0 m-1" id="ddd"><i class="fas fa-building"></i>&nbsp; <b>Nom entreprise &nbsp; • &nbsp; nom de la formation &nbsp; • &nbsp; CFP </b></p>
                        <span class="card-text  m-1" id="sdf" ><i class="fas fa-calendar mt-2" ></i>&nbsp; <span>Date complet debut - date fin </span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-clock mt-2" ></i>&nbsp; <span>Heures</span></span>
                        <span class="card-text  m-3" id="sdf" ><i class="fas fa-users mt-2" ></i>&nbsp; <span>Nombres des stagiaires</span></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
