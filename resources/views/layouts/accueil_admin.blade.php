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
    <h1>Guide d'utilisation</h1>
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
    <h1>Creation de projet</h1>
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
    <h1>Facture et encaissement</h1>
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
    <h1>Collaboration avec d'autres utilisateurs</h1>
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
    <h1>Abonnement</h1>
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
</style>
@endsection
