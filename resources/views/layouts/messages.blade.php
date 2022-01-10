@extends('./layouts/admin')
@section('content')
    <section class="message section-50">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <h3 class="m-b-50 heading-line">Messages <i class="bx bxs-envelope text-muted"></i></h3>
                    <div class="message-ui_dd-content">
                        <div class="message-list message-list--unread">
                            <div class="message-list_content">
                                <div class="message-list_img">
                                    <img src="https://i.imgur.com/zYxDCQT.jpg" alt="user">
                                </div>
                                <div class="message-list_detail">
                                    <p><b>Nicole Raharifetra</b> à réagis à votre profil</p>
                                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p>
                                    <p class="text-muted"><small>10 minutes passés</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#!" class="dark-link">Plus de messages</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row message__filtre">
                        <h1 class="mt-3">Filtrer messages</h1>
                        <div class="message__search">
                            <div class="message__search__form mt-3 mb-3">
                                <form class="" method="GET" action="">
                                    <button type="submit" class="btn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <input type="text" id="reference_search" name="nom_message" placeholder="Vous cherchez..." class="form-control" autocomplete="off">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
