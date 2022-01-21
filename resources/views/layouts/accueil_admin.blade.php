@extends('./layouts/admin')
@section('content')
{{-- <div class="container-fluid" id="affiche">
    <div class="row line_default justify-content-center">
        <h1 class="text-mutted text-center titre mt-5">Bienvenue dans votre espace d'administration</h1>
        <img src="{{asset('img/images/logo_transparent_background.png')}}" alt="" class="img-fluid image_fond">
        <a href="#" class="text-center"><button class="btn btn-warning btnP my-5" type="">Voir plus</button></a>
    </div>
    <?php
     echo date("l, j F  Y ");
    ?>
</div> --}}
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-sm-7 pe-3">
            <p><h4 class="text-center text-danger text_formation">Formation.mg</h4></p>
            <div class="card essai">

            </div>

        </div>
        <div class="col-sm-5 ps-3">
            <div class="card" style="background: linear-gradient(45deg, rgb(251, 202, 50), rgb(245, 62, 57)); border-radius:20px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="" alt="" class="utilisateur" id="photo_profil"></div>
                        <div class="col-sm-8">
                            <p class="text-white m-2 p-0"> <b>Bienvenue, {{ Auth::user()->name }}</b></p>
                            <p class="text-white m-2 p-0" style="font-size:12px"><?php echo date("l, j F  Y "); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="card card_1 me-3 shadow bg-white">
                    <span class="text-center card_2"></span>
                </div>
                <div class="card card_1 ms-3 shadow bg-white">
                    <span class="text-center card_2"></span>
                </div>
            </div>
            <div class="d-flex">
                <div class="card card_1 me-3 shadow bg-white">
                    <span class="text-center card_2"></span>
                </div>
                <div class="card card_1 ms-3 shadow bg-white">
                    <span class="text-center card_2"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div>
    <div class="ribbon">
        <p>
            <strong class="ribbonData clignote">Guide d'utilisation</strong>
        </p>
    </div>
    <section>
        <ul>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li><br>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li>
        </ul>
    </section>
</div> <hr>
<div>
    <div class="ribbon">
        <p>
            <strong class="ribbonData clignote">Creation de projet</strong>
        </p>
    </div>
    <section>
        <ul>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li><br>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li>
        </ul>
    </section>
</div><hr>
<div>
    <div class="ribbon">
        <p>
            <strong class="ribbonData clignote">Facture et encaissement</strong>
        </p>
    </div>
    <section>
        <ul>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li><br>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li>
        </ul>
    </section>
</div><hr>
<div>
    <div class="ribbon my-3">
        <p>
            <strong class="ribbonData clignote">Collaboration avec d'autres utilisateurs</strong>
        </p>
    </div>
    <section>
        <ul>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li><br>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li>
        </ul>
    </section>
</div>
<div>
    <div class="ribbon">
        <p>
            <strong class="ribbonData clignote">Abonnement</strong>
        </p>
    </div>
    <section>
        <ul>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li><br>
            <li>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto assumenda, illo ipsa, deleniti odit ratione optio fugit quis earum vitae soluta suscipit veniam eius fugiat, dignissimos labore. Quidem, soluta officia.
            </li>
        </ul>
    </section>
</div><hr>
    <span class="clignote">Texte qui clignote en HTML avec CSS</span>
<style>
    .essai{
        background-image: url('img/background_login/body_home.jpg');
        background-size: 100%;
        background-repeat: no-repeat;
        width: 100%;
        height: 400px;
    }
    .card_1{
        width: 50%;
    }
    .card_2{
        height: 150px;p;
    }
    .text_formation{
        font-weight: bold;
        font-family: "Times New Roman", Times, serif;
    }
    .clignote {
      color:white;
      font-weight: bolder;
      font-size: 20px;
      animation: clignote 2s linear infinite;
    }
    @keyframes clignote {
      50% { opacity: 0; }
    }


    .ribbon {
        position: relative;
        z-index:99;
        padding:0 2em;
    }
    .ribbon p {
        /* background: #037cd5;  */
        background: orangered;
        color: #fff;
        font-size: 18px;
        text-align: center;
        padding: 1em 2em;
        margin: 0 0 3em;
        position: relative;
    }
    .ribbon p:before,
    .ribbon p:after {
        content: "";
        position: absolute;
        display: block;
        bottom: -1em;
        border: 1.5em solid #0361a7 ;
        z-index: -1;
    }
    .ribbon p:before {
        left: -2em;
        border-right-width: 1.5em;
        border-left-color: transparent;
    }
    .ribbon p:after {
        right: -2em;
        border-left-width: 1.5em;
        border-right-color: transparent;
    }
    .ribbon .ribbonData:before,
    .ribbon .ribbonData:after {
        content: "";
        position: absolute;
        display: block;
        border-style: solid;
        border-color: #014679 transparent transparent transparent;
        bottom: -1em;
    }
    .ribbon .ribbonData:before {
        left: 0;
        border-width: 1em 0 0 1em;
    }
    .ribbon .ribbonData:after {
        right: 0;
        border-width: 1em 1em 0 0; ]
    }
</style>
@endsection
