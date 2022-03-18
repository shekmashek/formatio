@extends('./layouts/admin')
@section('content')
    <section class="notification section-50">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <h3 class="m-b-50 heading-line">Notifications <i class="bx bxs-bell text-muted"></i></h3>
                    <div class="notification-ui_dd-content">
                        <div class="notification-list notification-list--unread">
                            <div class="notification-list_content">
                                <div class="notification-list_img">
                                    <img src="https://i.imgur.com/zYxDCQT.jpg" alt="user">
                                </div>
                                <div class="notification-list_detail">
                                    <p><b>Nicole Raharifetra</b> à réagis à votre profil</p>
                                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p>
                                    <p class="text-muted"><small>10 minutes passés</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#!" class="dark-link">Plus de notifications</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row notification__filtre">
                        <h1 class="mt-3">Filtrer notifications</h1>
                        <div class="notification__search">
                            <div class="notification__search__form mt-3 mb-3">
                                <form class="" method="GET" action="">
                                    <button type="submit" class="btn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <input type="text" id="reference_search" name="nom_notification" placeholder="Vous cherchez..." class="form-control" autocomplete="off">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
