@extends('./layouts/admin')
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<i class="far fa-caret-circle-down"></i> Janvier 2022 <br><hr>
<div class="container-fluid px-3">
    <div class="d-flex">
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Projets</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Logo</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Date</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Statut</b></p>   
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Progression</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Evaluation</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Detail</b></p>
        </div>
    </div>


    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    {{-- duplication --}}
    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>


    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>


    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    {{-- fin duplication --}}

</div>
<br><br><br>







<i class="far fa-caret-circle-down"></i> Fevrier 2022 <br><hr>
<div class="container-fluid px-3">
    <div class="d-flex">
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Projets</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Logo</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Date</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Statut</b></p>   
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Progression</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Evaluation</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Detail</b></p>
        </div>
    </div>


    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    {{-- duplication --}}
    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>


    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>


    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    {{-- fin duplication --}}

</div>

<style>
    .enfant_flex{
        width: 100%;
        margin: 0 5px;
        background-color: rgb(211, 188, 188);
        border-radius: 2rem;
    }
    .enfant_flex_1{
        width: 100%;
        margin: 0 5px;
    }
    .statut_en_cours{
        background-color: rgb(143, 217, 240);
        color: blue;
        padding: 4px auto;
        border-radius: 4px;
    }
    .checked {
  color: orangered;
}
.image_logo_projet{
    border-radius: 50%;
}
.bg-projet{
    background-color: rgb(213, 213, 214);
}
.collapse_projet{
    background-color: #fff;
    margin:  2px 6px;
    border-radius: 8px;
}
</style>
<script>
    $(document).ready(function() {
  $('#rateMe3').mdbRate();
});
</script>
@endsection