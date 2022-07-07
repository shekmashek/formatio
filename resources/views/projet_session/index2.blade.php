@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Projets</p>
@endsection

@inject('groupe', 'App\groupe')
@inject('carbon', 'Carbon\Carbon')
@inject('froidEval', 'App\FroidEvaluation')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/projets.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/configAll.css') }}">
    <style>
        .corps_planning .nav-link {
            color: #637381;
            padding: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 200ms;
            text-transform: uppercase;
            padding-top: 10px;
        }


        .nav-item .nav-link button.active {
            /* border-bottom: 3px solid #7635dc !important; */
            color: #7635dc;
            border-right:.2rem solid  #7635dc;
        }

        /* .nav-item .nav-link.active {
            border-bottom: none !important;
        } */

        .nav-tabs .nav-link:hover {
            background-color: rgb(245, 243, 243);
            transform: scale(1.1);
            border: none;
        }

        .nav-tabs .nav-item a {
            text-decoration: none;
            text-decoration-line: none;
        }

        .corps_planning .nav-item .planning{
            border-right:.2rem solid  #c5c4c49b;
        }

    </style>
    <style>
        /* .myEtpStyle:hover{
            text-decoration: underline;
            color: darkorchid;
        } */
        .dropdown-item.active{
            background-color: transparent !important;
        }

        .dropdown-item.active:hover{
            background-color: #ececec !important;
        }
        .status_grise {
            border-radius: 5px;
            background-color: #637381;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_reprogrammer {
            border-radius: 5px;
            background-color: #00CDAC;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_cloturer {
            border-radius: 5px;
            background-color: #314755;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_reporter {
            border-radius: 5px;
            background-color: #26a0da;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_annulee {
            border-radius: 5px;
            background-color: #b31217;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_termine {
            border-radius: 5px;
            background-color: #1E9600;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_confirme {
            border-radius: 5px;
            background-color: #2B32B2;
            color: white;
            align-items: center ;margin: 0 auto;
            padding-end: 1rem;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .statut_active {
            border-radius: 5px;
            background-color: rgb(15, 126, 145);
            color: whitesmoke;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .modalite {
            border-radius: 5px;
            background-color: #26a0da;
            color: rgb(255, 255, 255);
            /* width: 60%; */
            margin: 0 auto;
            text-align: center;
            padding: 0.2rem 0.3rem !important;
            min-width: 140px;
            display: inline-block;
        }

        /* .filter{
            position: relative;
            bottom: .5rem;
            float: right;
        } */
        .btn_creer {
            background-color: white;
            border: none;
            border-radius: 30px;
            padding: .2rem 1rem;
            color: black;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }

        .btn_creer a {
            font-size: .8rem;
            position: relative;
            bottom: .2rem;
        }

        .btn_creer:hover {
            background: #6373812a;
            color: blue;
        }

        .btn_creer:focus {
            color: blue;
            text-decoration: none;
        }

        .icon_creer {
            background-image: linear-gradient(60deg, #f206ee, #0765f3);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            font-size: 1.5rem;
            position: relative;
            top: .4rem;
            margin-right: .3rem;
        }

        .pagination {
            background-clip: text;
            margin-right: .3rem;
            font-size: 2rem;
            position: relative;
            top: .7rem;
        }

        .pagination:hover {
            color: #000000;
            background-color: rgb(239, 239, 239);
            border-radius: 1.3rem;
        }

        .nombre_pagination {
            color: #626262;

        }

        .rapport_finale {
            background-color: #F16529 !important;
        }

        .rapport_finale button {
            color: #ffffff !important;
        }

        .rapport_finale:hover {
            background-color: #af3906 !important;
        }

        .pdf_download {
            background-color: #e73827 !important;
            padding: 0.3rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all .5ms ease;
            color: white !important;
            position: relative;
        }

        .pdf_download:hover {
            background-color: #af3906 !important;
        }

        .pdf_download button {
            color: #ffffff !important;
        }

        tbody tr {
            vertical-align: middle;
        }

        .btn-label-session {
            position: relative;
            left: -12px;
            display: inline-block;
            padding: 6px 12px;
            background: rgba(37, 37, 37, 0.15);
            /* background-color: #a8e063; */
            border-radius: 3px 0 0 3px;
        }

        .btn-ajout-session {
            padding-top: 0;
            padding-bottom: 0;
        }

        .resultat_stg{
            background-color: #2cb445;
            padding: 0.3rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all .5ms ease;
            position: relative;
        }
        .resultat_stg button{
            color: #ffffff !important;
        }
        .resultat_stg:hover{
            background-color: #1c7f2e;
        }

        .btn_eval_stg{
            background-color: #363dbc;
            padding: 0.3rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all .5ms ease;
            position: relative;
        }
        .btn_eval_stg:hover{
            background-color: #262b86;
        }
            /*info SESSION*/
        .green{
            color: #5e35b1;
            border: 2px solid #43a047;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .red{
            color: #5e35b1;
            border: 2px solid #f4511e;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .yellow{
            color: #5e35b1;
            border: 2px solid #fdd835;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .saClass{
            font-size: 21px;
            color: #637381;
        }
        .saSpan{
            color: #637381;
            font-size: 14px;
        }
        /* fixed top header */
        .fixedTop{
            max-height: 750px;
            overflow-y: scroll;
        }

        .fixedTop thead th {
        position: sticky;
        top: 0;
        background: #e5e5e5;
        border-bottom: none;
        z-index: 100;
        }
        .spanClass:hover{
            color: #673ab7;
            transition: 0.3s ease-in-out;
            /* border-bottom: 3px solid #673ab7; */
        }

        .head{
            font-size: 14px;
        }
        .wrapper_stg{
            height:26px;
            border-radius: 30px;
            background-color: #014f70;
        }
        .shadow {
        height: auto;
    }

    * {
        font-size: 1rem;
    }

    .body_nav p {
        font-size: 0.9rem;
    }

    .chiffre_d_affaire p {
        font-size: 0.9rem;
    }
/*
    .corps_planning {
        font-size: 1.5rem;
    } */

    .body_nav {
        /* background-color: #e8e8e9;
    color: rgb(3, 0, 0); */
        padding: 6px 8px;
        border-radius: 4px 4px 0 0;
    }

    .numero_session {
        background-color: rgb(255, 255, 255);
        padding: 0 6px;
        border-radius: 4px;
    }

    strong {
        font-size: 10px;
    }

    .img_commentaire {
        border-radius: 5rem;
        position: absolute;
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .img_commentaire:hover {
        cursor: pointer;
    }

    .height_default {
        height: 27px;
        align-items: center
    }

    a {
        font-size: 12px;
        text-decoration: none;
    }

    #myDIV {
        position: absolute;
        display: none;
        margin-left: 57%;
        margin-top: 20px;
    }

    u {
        font-size: 12px;
    }

    .pad_img {
        padding-left: 10px;
    }

    a:hover {
        color: blueviolet;
    }

    p {
        font-size: 10px;
    }

    .img_superpose {
        margin-left: -10px;
        border: 2px solid white;
    }

    .chiffre_d_affaire {
        padding: 0 10px;
    }

    .status_grise {
        border-radius: 1rem;
        background-color: #637381;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_reprogrammer {
        border-radius: 1rem;
        background-color: #00CDAC;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_cloturer {
        border-radius: 1rem;
        background-color: #314755;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_reporter {
        border-radius: 1rem;
        background-color: #26a0da;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_annulee {
        border-radius: 1rem;
        background-color: #b31217;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_termine {
        border-radius: 1rem;
        background-color: #2ebf91;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_confirme {
        border-radius: 1rem;
        background-color: #2B32B2;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .statut_active {
        border-radius: 1rem;
        background-color: rgb(15, 126, 145);
        color: whitesmoke;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .modalite {
        border-radius: 1rem;
        background-color: #26a0da;
        color: rgb(255, 255, 255);
        /* width: 60%; */
        align-items: center margin: 0 auto;

        padding: 0.1rem 0.5rem !important;
    }


    .dernier_planning {
        text-align: left;
        padding-left: 6px;
        height: 100%;
        font-size: 12px;
        background-color: rgba(230, 228, 228, 0.39);
    }

    .dernier_planning:focus {
        color: rgb(130, 33, 100);
        background-color: white;
        font-weight: bold;
    }



    button {
        background-color: white;
        border: none;
        margin: 0;
        padding: 0;
    }

    .titre_card {
        background-color: rgb(223, 219, 219);
        height: 30px;
        border-radius: 4px 4px 0 0;
        margin: 2px 0;
        color: white;
    }

    /* .card {
        position: absolute;
    } */

    /* Style the tab content */
    .tabcontent {
        display: none;
    }

    .btn_modifier_statut {
        /* background-color: white; */
        /* border: 1px; */
        border-radius: 30px;
        /* border-color: #7635dc; */
        padding: 1rem 1rem;
        color: black;
        /* box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; */
    }

    .btn_modifier_statut a {
        font-size: .8rem;
        position: relative;
        bottom: .2rem;
    }

    .btn_modifier_statut:hover {
        background-color: white;
        color: black;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .planning {
        text-align: left;
        padding-left: 6px;
        height: 100%;
        font-size: 12px;
        margin:0;
    }

    .planning:hover {
        background-color: #eeeeee;
    }

    .planning p{
        font-size: .85rem;
    }

    @keyframes action{
        0%{
            filter: brightness(0.99);
        }
        25%{
            filter: brightness(0.94);
        }
        50%{
            filter: brightness(0.96);
        }
        75%{
            filter: brightness(0.98);
        }
        100%{
            filter: brightness(1);
        }
    }


    .action_animation{
        animation-name: action;
        animation-duration: 3s;
        animation-delay: 1s;
        animation-iteration-count: infinite;
    }

    /* .btn_modifier_statut:focus{
    color: blue;
    text-decoration: none;
} */

    .icon_creer {
        background-image: linear-gradient(60deg, #f206ee, #0765f3);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        position: relative;
        top: .4rem;
        margin-right: .3rem;
    }

    .liste_projet{
        background-color: #637381;
        margin: 0;
        padding: 1;
        color: #ffffff;
    }

    .liste_projet:hover{
        background-color: #cfccccc5;
        color: #191818;
    }

    .pdf_download{
            background-color: #e73827 !important;
            border-radius: 5px;
    }
    .pdf_download:hover{
        background-color: #af3906 !important;
    }
    .pdf_download button{
        color: #ffffff !important;
    }

    .type_formation{
        border-radius: 1rem;
        background-color: #826bf3;
        color: rgb(255, 255, 255);
        /* width: 60%; */
        align-items: center margin: 0 auto;

        padding: 0.1rem 0.5rem !important;
    }
    .type_intra{
        padding: 0.1rem 0.5rem !important;
        font-size: 0.85rem;
        background-color: #2193b0;
        border-radius: 1rem;
        transition: all 200ms;
        color: white;
        border: none;
        box-shadow: none;
        outline: none;
        position: relative;
        align-items: center margin: 0 auto;
    }

    .type_intra:hover,
    .type_inter:hover{
        cursor: default;
        color: white;
    }

    .type_inter{
        padding: 0.1rem 0.5rem !important;
        font-size: 0.85rem;
        background-color: #2ebf91;
        border-radius: 1rem;
        transition: all 200ms;
        color: rgb(255, 255, 255);
        border: none;
        box-shadow: none;
        outline: none;
        position: relative;
        align-items: center; margin: 0 auto;
    }

    /*info SESSION*/
    .green{
        color: #5e35b1;
        border: 2px solid #43a047;
        border-radius: 2px;
        font-size: 16px;
        font-weight: 700;
        padding: 4px;
    }

    .red{
        color: #5e35b1;
        border: 2px solid #f4511e;
        border-radius: 2px;
        font-size: 16px;
        font-weight: 700;
        padding: 4px;
    }

    .yellow{
        color: #5e35b1;
        border: 2px solid #fdd835;
        border-radius: 2px;
        font-size: 16px;
        font-weight: 700;
        padding: 4px;
    }

    .saClass{
        font-size: 22px;
        color: #637381;
    }
    .saSpan{
        color: #637381;
        font-size: 14px;
    }
    .nom_status{
        text-align: center;
    }
            /****************
VERTICAL TIMELINE ( BOOTSTRAP 5)
****************/
    .timeline-1 {
        border-left: 3px solid #b565a7;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        /* background: rgba(177, 99, 163, 0.09); */
        margin: 0 auto;
        position: relative;
        padding: 30px;
        list-style: none;
        text-align: left;
        max-width: 99%;
    }
    @media (max-width: 767px) {
        .timeline-1 {
            max-width: 98%;
            padding: 25px;
        }
    }

    .timeline-1 .event {
        border-bottom: 1px dashed #000;
        padding-bottom: 25px;
        margin-bottom: 25px;
        position: relative;
    }

    @media (max-width: 767px) {
        .timeline-1 .event {
            padding-top: 30px;
        }
    }

    .timeline-1 .event:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border: none;
    }

    .timeline-1 .event:before,
    .timeline-1 .event:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline-1 .event:before {
        left: -207px;
        content: attr(data-date);
        text-align: right;
        font-weight: 100;
        font-size: 0.9em;
        min-width: 120px;
    }

    @media (max-width: 767px) {
        .timeline-1 .event:before {
            left: 0px;
            text-align: left;
        }
    }

    .timeline-1 .event:after {
        -webkit-box-shadow: 0 0 0 3px #b565a7;
        box-shadow: 0 0 0 3px #b565a7;
        left: -35.8px;
        background: #fff;
        border-radius: 50%;
        height: 9px;
        width: 9px;
        content: "";
        top: 31px;
    }
    /* event terminer */
    .timeline-1 .event_terminer {
        border-bottom: 1px dashed #000;
        padding-bottom: 25px;
        margin-bottom: 25px;
        position: relative;
    }

    @media (max-width: 767px) {
        .timeline-1 .event_terminer {
            padding-top: 30px;
        }
    }

    .timeline-1 .event_terminer:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border: none;
    }

    .timeline-1 .event_terminer:before,
    .timeline-1 .event_terminer:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline-1 .event_terminer:before {
        left: -207px;
        content: attr(data-date);
        text-align: right;
        font-weight: 100;
        font-size: 0.9em;
        min-width: 120px;
    }

    @media (max-width: 767px) {
        .timeline-1 .event_terminer:before {
            left: 0px;
            text-align: left;
        }
    }

    .timeline-1 .event_terminer:after {
        -webkit-box-shadow: 0 0 0 3px #b565a7;
        box-shadow: 0 0 0 3px #b565a7;
        left: -35.8px;
        background: rgb(168, 246, 108);
        border-radius: 50%;
        height: 9px;
        width: 9px;
        content: "";
        top: 31px;
    }
    /* evenet repro */
    .timeline-1 .event_repro {
        border-bottom: 1px dashed #000;
        padding-bottom: 25px;
        margin-bottom: 25px;
        position: relative;
    }
    @media (max-width: 767px) {
        .timeline-1 .event_repro {
            padding-top: 30px;
        }
    }

    .timeline-1 .event_repro:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border: none;
    }

    .timeline-1 .event_repro:before,
    .timeline-1 .event_repro:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline-1 .event_repro:before {
        left: -207px;
        content: attr(data-date);
        text-align: right;
        font-weight: 100;
        font-size: 0.9em;
        min-width: 120px;
    }

    @media (max-width: 767px) {
        .timeline-1 .event_repro:before {
            left: 0px;
            text-align: left;
        }
    }

    .timeline-1 .event_repro:after {
        -webkit-box-shadow: 0 0 0 3px #b565a7;
        box-shadow: 0 0 0 3px #b565a7;
        left: -35.8px;
        background: rgba(0, 0, 0, 0.745);
        border-radius: 50%;
        height: 9px;
        content: "";
        width: 9px;
        top: 31px;
    }
    @media (max-width: 767px) {
        .timeline-1 .event:after {
            left: -31.8px;
        }
        .timeline-1 .event_terminer:after {
            left: -31.8px;
        }
        .timeline-1 .event_repro:after {
            left: -31.8px;
        }
    }
    .p_date{
        margin-left:40%;
    }
    .div_class>div{
        display:inline-block;
    }
    .triangle-right {
        width: 0;
        height: 0;
        border-top: 7px solid transparent;
        border-left: 7px solid rgba(191, 26, 160, 0.593);
        border-bottom: 7px solid transparent;
        display: inline-block;
        margin-left: 10px;
        margin-top: 67px;
        position: absolute;
    }
    .text_retourner {
        position: relative;
    }
    .text_retourner span {
        position: relative;
        display: inline-block;
        font-size: 25px;
        color: rgba(0,0,0,.5);
        text-transform: uppercase;
        animation: flip 3s infinite;
        animation-delay: calc(.2s * var(--i))
    }
    @keyframes flip {
        0%,80% {
            transform: rotateY(360deg)
        }
    }
/* timeline */
    </style>

    <div class="container-fluid mb-5">
        <div class="d-flex flex-row justify-content-end mt-3">
            @canany(['isReferent','isReferentSimple','isManager','isChefDeService', 'isCFP', 'isFormateur','isFormateurInterne'])
                <span class="nombre_pagination"><span style="position: relative; bottom: -0.2rem">{{ $debut . '-' . $fin }} sur
                        {{ $nb_projet }}</span>
                    @if ($nb_par_page >= $nb_projet)
                        <a href="{{ route('liste_projet', [1, $page - 1]) }}" role="button"
                            style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('liste_projet', [1, $page + 1]) }}" role="button"
                            style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                    @elseif ($page == 1)
                        <a href="{{ route('liste_projet', [1, $page - 1]) }}" role="button"
                            style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('liste_projet', [1, $page + 1]) }}" role="button"><i
                                class='bx bx-chevron-right pagination'></i></a>
                    @elseif ($page == $fin_page || $page > $fin_page)
                        <a href="{{ route('liste_projet', [1, $page - 1]) }}" role="button"><i
                                class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('liste_projet', [1, $page + 1]) }}" role="button"
                            style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                    @else
                        <a href="{{ route('liste_projet', [1, $page - 1]) }}" role="button"><i
                                class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('liste_projet', [1, $page + 1]) }}" role="button"><i
                                class='bx bx-chevron-right pagination'></i></a>
                    @endif
                </span>
                <a href="#" class="btn_creer text-center filter mt-3" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
            @endcanany
        </div>
        @if (Session::has('pdf_error'))
            <div class="alert alert-danger ms-4 me-4">
                <ul>
                    <li>{!! \Session::get('pdf_error') !!}</li>
                </ul>
            </div>
        @endif
        <div class="row w-100">

            <div class="col-12 ps-5">
                <div class="row">
                    @canany(['isCFP'])
                        <div class="m" id="corps">
                            @if (count($projet) <= 0)
                                <div class="row d-flex mt-3 titre_projet p-1 mb-1">
                                    <p class="text-center text_aucun">Vous n'avez pas encore du projet.</p>
                                </div>
                            @endif
                            @if (Session::has('groupe_error'))
                                <div class="alert alert-danger ms-2 me-2">
                                    <ul>
                                        <li>{!! \Session::get('groupe_error') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            <div class="fixedTop">
                                <table class="table shadow-sm p-3 mb-5 bg-body rounded">
                                    <thead>
                                        <tr style="background: #eff1f3;">
                                            <th scope="col">Projet</th>
                                            <th scope="col">Session</th>
                                            <th scope="col">Module</th>
                                            <th scope="col">Entrepise</th>
                                            <th scope="col">Modalité</th>
                                            <th scope="col">Date du projet</th>
                                            <th scope="col">Ville</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projet as $prj)
                                            <tr>
                                                <td colspan="9" scope="row" style="border-bottom: none; background: #cccccc;">
                                                    @php
                                                        if ($prj->totale_session == 1) {
                                                            echo $prj->nom_projet;
                                                        } elseif ($prj->totale_session > 1) {
                                                            echo $prj->nom_projet;
                                                        } elseif ($prj->totale_session == 0) {
                                                            echo $prj->nom_projet;
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" style="font-size: 20;">
                                                    @if ($prj->type_formation_id == 1)
                                                        <span style="background: #2193b0; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                            {{ $prj->type_formation }}
                                                        </span>
                                                    @elseif ($prj->type_formation_id == 2)
                                                        <span style="background: #2ebf91; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                            {{ $prj->type_formation }}
                                                        </span>
                                                    @endif
                                                </td>

                                                {{-- Bouton add session --}}
                                                @can('isCFP')
                                                    @if ($prj->type_formation_id == 1)
                                                        <td style="border-bottom: none;">
                                                            <span role="button" data-bs-toggle="modal"
                                                                data-bs-target="#modal_{{ $prj->projet_id }}" data-backdrop='static'
                                                                title="Nouvelle session" class="btn btn_nouveau py-1">
                                                                <i class='bx bx-plus-medical me-1'></i>Session
                                                            </span>
                                                        </td>
                                                    @endif
                                                @endcan

                                                @if ($prj->totale_session <= 0)
                                                    <td colspan="9"> Aucune session</td>
                                                @else
                                                    @foreach ($data as $pj)
                                                        @if ($prj->projet_id == $pj->projet_id)
                                                        <tr>
                                                        <td>
                                                            <a data-bs-toggle="collapse" href="#collapseExample_{{$pj->groupe_id}}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-arrow-down-circle"></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('detail_session', [$pj->groupe_id, $prj->type_formation_id]) }}">
                                                                <span style="border-bottom: 3px solid #673ab7"  class="spanClass">{{ $pj->nom_groupe }}</span>
                                                            </a>
                                                        </td>
                                                        <td>{{ $pj->nom_module }}</td>
                                                        <td>
                                                            @foreach ($entreprise as $etp)
                                                                @if ($etp->groupe_id == $pj->groupe_id)
                                                                    {{ $etp->nom_etp }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        {{-- <td>
                                                            @if ($prj->type_formation_id == 1)
                                                                <span style="background: #2193b0; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px">
                                                                    {{ $prj->type_formation }}
                                                                </span>
                                                            @elseif ($prj->type_formation_id == 2)
                                                                <span style="background: #2ebf91; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px">
                                                                    {{ $prj->type_formation }}
                                                                </span>
                                                            @endif
                                                        </td> --}}
                                                        <td>
                                                            <span>
                                                                {{ $pj->modalite }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @php
                                                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            @if($lieuFormation!=null)
                                                                {{$lieuFormation[0]}}
                                                            @else
                                                                {{"-"}}
                                                            @endif
                                                        </td>
                                                        <td style="min-width: 6rem;">
                                                            <p class="{{ $pj->class_status_groupe }} m-0 ps-1 pe-1 text-center">
                                                                {{ $pj->item_status_groupe }}
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            <i class='bx bx-chevron-down-circle mt-1' style="font-size: 1.8rem" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                            <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1">
                                                                @can('isCFP')
                                                                    <li><span class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_modifier_session_{{ $pj->groupe_id }}" data-backdrop="static" style="cursor: pointer;">Modifier</span></li>
                                                                @endcan
                                                                <li class="action_projet"><a class="dropdown-item" href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}">Expoter en PDF</a></li>
                                                                <li class="action_projet"><a class="dropdown-item" href="{{ route('resultat_evaluation', [$pj->groupe_id]) }}">Evaluation à chaud</a></li>
                                                                @php
                                                                    $reponse = $froidEval->periode_froid_evaluation($pj->groupe_id);
                                                                @endphp
                                                                @if($reponse == 1)
                                                                    <li class="action_projet"><a class="dropdown-item" href="{{ route('evaluation_froid/resultat', [$pj->groupe_id]) }}">Evaluation à froid</a></li>
                                                                @endif
                                                                @if ($prj->type_formation_id == 1)
                                                                    <li class="action_projet"><a class="dropdown-item" href="{{ route('nouveauRapportFinale', [$pj->groupe_id]) }}" target="_blank">Rapport</a></li>
                                                                @endif
                                                            </ul>
                                                        </td>


                                                        <tr>
                                                            <div class="modal fade" id="delete_session_{{ $pj->groupe_id }}"
                                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header  d-flex justify-content-center"
                                                                            style="background-color:rgb(224,182,187);">
                                                                            <h6 class="modal-title">Avertissement !</h6>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <small>Vous êtes sur le point d'effacer une donnée,
                                                                                cette
                                                                                action est irréversible. Continuer ?</small>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal"> Non </button>
                                                                            <button type="button" class="btn btn-secondary"><a
                                                                                    href="{{ route('destroy_groupe', [$pj->groupe_id]) }}">Oui</a></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- fin supprimer session --}}
                                                            {{-- Debut modal edit session --}}
                                                            <div>
                                                                <div class="modal fade"
                                                                    id="modal_modifier_session_{{ $pj->groupe_id }}"
                                                                    data-backdrop="static">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content p-3">
                                                                            <div class="modal-title pt-3"
                                                                                style="height: 50px; align-items: center;">
                                                                                <h5 class="text-center my-auto">Modifier session
                                                                                    <strong>{{ $pj->nom_groupe }}</strong>
                                                                                </h5>
                                                                            </div>
                                                                            @if ($prj->type_formation_id == 1)
                                                                                <div class="row">
                                                                                    <form
                                                                                        action="{{ route('modifier_session_intra') }}"
                                                                                        id="formPayement" method="post">
                                                                                        @csrf
                                                                                        <input type="hidden" name="id"
                                                                                            value="{{ $pj->groupe_id }}">
                                                                                        <div class="row">
                                                                                            <div class="form-group">
                                                                                                <div class="form-row d-flex">
                                                                                                    <div class="col">
                                                                                                        <div class="row ps-3 mt-2">
                                                                                                            <div
                                                                                                                class="form-group mt-1 mb-1">
                                                                                                                <input type="text"
                                                                                                                    id="min"
                                                                                                                    class="form-control input"
                                                                                                                    name="date_debut"
                                                                                                                    required
                                                                                                                    onfocus="(this.type='date')"
                                                                                                                    value="{{ $pj->date_debut }}">
                                                                                                                <label
                                                                                                                    class="ml-3 form-control-placeholder"
                                                                                                                    for="min">Date
                                                                                                                    debut du
                                                                                                                    session<strong
                                                                                                                        class="text-danger">*</strong></label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="row ps-3 mt-2">
                                                                                                            <div
                                                                                                                class="form-group mt-1">
                                                                                                                <select
                                                                                                                    class="form-select selectP input"
                                                                                                                    id="formation_session_id"
                                                                                                                    name="formation_id"
                                                                                                                    aria-label="Default select example">
                                                                                                                    <option
                                                                                                                        value="{{ $pj->formation_id }}">
                                                                                                                        {{ $pj->nom_formation }}
                                                                                                                    </option>
                                                                                                                    @foreach ($formation as $form)
                                                                                                                        <option
                                                                                                                            value="{{ $form->id }}">
                                                                                                                            {{ $form->nom_formation }}
                                                                                                                        </option>
                                                                                                                    @endforeach
                                                                                                                </select>
                                                                                                                <label
                                                                                                                    class="ml-3 form-control-placeholder"
                                                                                                                    for="formation_id">Formations<strong
                                                                                                                        class="text-danger">*</strong></label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col">
                                                                                                        <div class="row ps-3 mt-2">
                                                                                                            <div
                                                                                                                class="form-group mt-1 mb-1">
                                                                                                                <input type="text"
                                                                                                                    id="min"
                                                                                                                    class="form-control input"
                                                                                                                    name="date_fin"
                                                                                                                    required
                                                                                                                    onfocus="(this.type='date')"
                                                                                                                    value="{{ $pj->date_fin }}">
                                                                                                                <label
                                                                                                                    class="ml-3 form-control-placeholder"
                                                                                                                    for="min">Date
                                                                                                                    fin du
                                                                                                                    session<strong
                                                                                                                        class="text-danger">*</strong></label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="row ps-3 mt-2">
                                                                                                            <div
                                                                                                                class="form-group mt-1 mb-1">
                                                                                                                <select
                                                                                                                    class="form-select selectP input"
                                                                                                                    id="module_id"
                                                                                                                    name="module_id"
                                                                                                                    aria-label="Default select example">
                                                                                                                    <option
                                                                                                                        value="{{ $pj->module_id }}">
                                                                                                                        {{ $pj->nom_module }}
                                                                                                                    </option>
                                                                                                                    @foreach ($module as $mod)
                                                                                                                        <option
                                                                                                                            value="{{ $mod->id }}">
                                                                                                                            {{ $mod->nom_module }}
                                                                                                                        </option>
                                                                                                                    @endforeach
                                                                                                                </select>
                                                                                                                <label
                                                                                                                    class="ml-3 form-control-placeholder"
                                                                                                                    for="module_id">Modules<strong
                                                                                                                        class="text-danger">*</strong></label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-row">
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1 mb-1">
                                                                                                            <select
                                                                                                                class="form-select selectP input"
                                                                                                                id="payement_id"
                                                                                                                name="payement"
                                                                                                                aria-label="Default select example">
                                                                                                                <option
                                                                                                                    value="{{ $pj->type_payement_id }}"
                                                                                                                    hidden>
                                                                                                                    {{ $pj->type }}
                                                                                                                </option>
                                                                                                                @foreach ($payement as $paye)
                                                                                                                    <option
                                                                                                                        value="{{ $paye->id }}">
                                                                                                                        {{ $paye->type }}
                                                                                                                    </option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                            <label
                                                                                                                class=" form-control-placeholder"
                                                                                                                for="payement_id">Mode
                                                                                                                de Payement<strong
                                                                                                                    class="text-danger">*</strong></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-row d-flex">
                                                                                                    <div class="col">
                                                                                                        <div class="row ps-3">
                                                                                                            <div
                                                                                                                class="form-group ">
                                                                                                                <input type="text"
                                                                                                                    id="min"
                                                                                                                    class="form-control input"
                                                                                                                    min="1" max="50"
                                                                                                                    name="min_part"
                                                                                                                    required
                                                                                                                    onfocus="(this.type='number')"
                                                                                                                    value="{{ $pj->min_participant }}">
                                                                                                                <label
                                                                                                                    class="ml-3 form-control-placeholder"
                                                                                                                    for="min">Nombre
                                                                                                                    de participant
                                                                                                                    minimal</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="text-center mb-1">
                                                                                                            <button type="submit"
                                                                                                                form="formPayement"
                                                                                                                class="btn btn_enregistrer">Valider</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col">
                                                                                                        <div class="row ps-3">
                                                                                                            <div
                                                                                                                class="form-group ">
                                                                                                                <input type="text"
                                                                                                                    id="min"
                                                                                                                    class="form-control input"
                                                                                                                    min="1" max="50"
                                                                                                                    name="max_part"
                                                                                                                    required
                                                                                                                    onfocus="(this.type='number')"
                                                                                                                    value="{{ $pj->max_participant }}">
                                                                                                                <label
                                                                                                                    class="ml-3 form-control-placeholder"
                                                                                                                    for="min">Nombre
                                                                                                                    de participant
                                                                                                                    maximal</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="text-center mb-1">
                                                                                                            <button type="button"
                                                                                                                class="btn  btn_annuler"
                                                                                                                data-bs-dismiss="modal">Annuler</button>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                    </form>
                                                                                </div>
                                                                            @endif
                                                                            @if ($prj->type_formation_id == 2)
                                                                                <div class="row">
                                                                                    <div class="form-group">
                                                                                        <div class="form-row d-flex">
                                                                                            <form
                                                                                                action="{{ route('modifier_session_inter') }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                <input type="hidden" name="id"
                                                                                                    value="{{ $pj->groupe_id }}">
                                                                                                <div class="col">
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1 mb-1">
                                                                                                            <input type="text"
                                                                                                                id="min"
                                                                                                                class="form-control input"
                                                                                                                name="date_debut"
                                                                                                                required
                                                                                                                onfocus="(this.type='date')"
                                                                                                                value="{{ $pj->date_debut }}">
                                                                                                            <label
                                                                                                                class="form-control-placeholder"
                                                                                                                for="min">Date
                                                                                                                debut<strong
                                                                                                                    class="text-danger">*</strong></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1 mb-1">
                                                                                                            <input type="text"
                                                                                                                id="min"
                                                                                                                class="form-control input"
                                                                                                                min="1" max="50"
                                                                                                                name="min_part"
                                                                                                                required
                                                                                                                onfocus="(this.type='number')"
                                                                                                                value="{{ $pj->min_participant }}">
                                                                                                            <label
                                                                                                                class="form-control-placeholder"
                                                                                                                for="min">Participant
                                                                                                                minimal</label>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="text-center ps-3">
                                                                                                        <button type="submit"
                                                                                                            class="btn btn_enregistrer">Valider</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col">
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1 mb-1">
                                                                                                            <input type="text"
                                                                                                                id="min"
                                                                                                                class="form-control input"
                                                                                                                name="date_fin"
                                                                                                                required
                                                                                                                onfocus="(this.type='date')"
                                                                                                                value="{{ $pj->date_fin }}">
                                                                                                            <label
                                                                                                                class=" form-control-placeholder"
                                                                                                                for="min">Date
                                                                                                                fin<strong
                                                                                                                    class="text-danger">*</strong></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1 mb-1">
                                                                                                            <input type="text"
                                                                                                                id="min"
                                                                                                                class="form-control input"
                                                                                                                min="1" max="50"
                                                                                                                name="max_part"
                                                                                                                required
                                                                                                                onfocus="(this.type='number')"
                                                                                                                value="{{ $pj->max_participant }}">
                                                                                                            <label
                                                                                                                class="form-control-placeholder"
                                                                                                                for="min">Participant
                                                                                                                maximal</label>
                                                                                                        </div>
                                                                                                    </div>


                                                                                                    <div class="text-center ps-3">
                                                                                                        <button type="button"
                                                                                                            class="btn btn_annuler"
                                                                                                            data-bs-dismiss="modal"
                                                                                                            aria-label="Close">Annuler</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Fin modal edit session --}}
                                                            {{-- debut modal nouveau session --}}
                                                            <div>
                                                                <div id="modal_{{ $pj->projet_id }}"
                                                                    class="modal fade modal_projets">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="w-100 text-center">Nouvelle Session pour
                                                                                    le&nbsp;{{ $pj->nom_projet }}
                                                                                </h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{ route('insert_session') }}"
                                                                                    method="POST"
                                                                                    class="justify-content-center me-5">
                                                                                    @csrf
                                                                                    <input type="hidden" name="type_formation"
                                                                                        value="1">
                                                                                    <input type="hidden" name="projet"
                                                                                        value="{{ $pj->projet_id }}">
                                                                                        <h5 class="mb-4 text-center">Ajouter votre
                                                                                            nouvelle
                                                                                            Session</h5>
                                                                                        <div class="form-group">
                                                                                            <div class="row mt-2">
                                                                                                <div
                                                                                                    class="col-lg-6 text-end mt-2">
                                                                                                    <span>Date debut de la
                                                                                                        session<strong
                                                                                                            class="text-danger">*</strong></span>
                                                                                                </div>
                                                                                                <div class="col-lg-6"><input
                                                                                                        type="date" id="min"
                                                                                                        class="form-control input"
                                                                                                        name="date_debut"
                                                                                                        style="width: 12rem;"
                                                                                                        required></div>
                                                                                            </div>
                                                                                            <div class="row mt-2">
                                                                                                <div
                                                                                                    class="col-lg-6 text-end mt-2">
                                                                                                    <span>Date fin de la
                                                                                                        session<strong
                                                                                                            class="text-danger">*</strong></span>
                                                                                                </div>
                                                                                                <div class="col-lg-6"><input
                                                                                                        type="date" id="min"
                                                                                                        class="form-control input"
                                                                                                        name="date_fin"
                                                                                                        style="width: 12rem;"
                                                                                                        required></div>
                                                                                            </div>
                                                                                            <div class="row mt-2">
                                                                                                <div
                                                                                                    class="col-lg-6 text-end mt-2">
                                                                                                    <span>Modalité<strong
                                                                                                            class="text-danger">*</strong>
                                                                                                    </span>
                                                                                                </div>
                                                                                                <div class="col-lg-6 text-end">
                                                                                                    <select
                                                                                                        class="form-select input_select"
                                                                                                        name="modalite"
                                                                                                        aria-label="Default select example"
                                                                                                        style="width: 15rem;"
                                                                                                        required>
                                                                                                        <option value="null">
                                                                                                            Sélectionnez</option>
                                                                                                        <option value="Présentiel">
                                                                                                            Présentielle</option>
                                                                                                        <option value="En ligne">En
                                                                                                            ligne</option>
                                                                                                        <option
                                                                                                            value="Présentiel/En ligne">
                                                                                                            Présentiel/En ligne
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row mt-3">
                                                                                                <div class="col-lg-6 text-end"><button type="submit"
                                                                                                        class="btn btn_enregistrer"><i class="bx bx-check me-1"></i> Enregistrer</button></div>
                                                                                                <div class="col-lg-6">
                                                                                                    <button type="button" class="btn  btn_annuler" data-bs-dismiss="modal">
                                                                                                        <i class='bx bx-x me-1'></i> Annuler
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- fin --}}
                                                            {{-- debut modal edit projet --}}
                                                            <div>
                                                                <div id="edit_prj_{{ $pj->projet_id }}"
                                                                    class="modal fade modal_projets">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="text-center w-100">Modification de la
                                                                                    Status du
                                                                                    Session dans le&nbsp;{{ $pj->nom_projet }}
                                                                                </h5>

                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('update_projet', $pj->projet_id) }}"
                                                                                    id="zsxsq" method="POST">
                                                                                    @csrf
                                                                                    <div class="row ps-3 mt-2">
                                                                                        <div class="form-group mt-1 mb-1">
                                                                                            <select
                                                                                                class="form-select selectP input"
                                                                                                id="formation_id"
                                                                                                name="formation_id"
                                                                                                aria-label="Default select example">
                                                                                                <option onselected hidden>choisir la
                                                                                                    status
                                                                                                    du session</option>
                                                                                                @foreach ($status as $stat)
                                                                                                    <option
                                                                                                        value="{{ $stat->id }}">
                                                                                                        {{ $stat->status }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            <label
                                                                                                class="ml-3 form-control-placeholder"
                                                                                                for="formation_id">Status</label>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="mt-4 mb-4">
                                                                                        <div
                                                                                            class="mt-4 mb-4 d-flex justify-content-around">
                                                                                            <div class="text-center ps-3"><button
                                                                                                    type="submit"
                                                                                                    form="formPayement"
                                                                                                    class="btn btn_enregistrer">Valider</button>
                                                                                            </div>
                                                                                            <div class="text-center ps-3"><button
                                                                                                    type="button"
                                                                                                    class="btn btn_annuler"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close">Annuler</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- fin --}}
                                                        </tr>

                                                        <tr  class="collapse" id="collapseExample_{{$pj->groupe_id}}">
                                                            <td style="transition: 0.2s ease-in-out" colspan="9">
                                                                <div class="card">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">
                                                                                    <i class='bx bxs-customize' style="color: #011e2a;"></i>
                                                                                    <span style="color: #011e2a; font-weight: 500; text-transform: capitalize;">{{ $pj->nom_module }}</span>
                                                                                </h5>
                                                                                <hr>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-md-4">
                                                                                        <i class="bi bi-person-square"></i>
                                                                                            <span style="color: #011e2a; font-weight: 500; font-size: 14px; text-transform: capitalize; margin-left: 4px;">
                                                                                                formateurs
                                                                                            </span>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <a href="#">

                                                                                            @php
                                                                                                $dataDetails = $groupe->formateurData($pj->groupe_id);
                                                                                                // var_dump($dataDetails);
                                                                                            @endphp

                                                                                            @if ( count($dataDetails) > 0)
                                                                                                @foreach ($dataDetails as $dataDetail)
                                                                                                    <span class='rounded-pill' style='padding: 4px 8px; color: #fff; background-color: #2193b0; font-size: 14px;'>{{ $dataDetail->nom_formateur }}</span>
                                                                                                @endforeach
                                                                                            @elseif(count($dataDetails) <= 0)
                                                                                                <span class='rounded-pill' style='padding: 2px 7px; color: #fff; background-color: #014f70'>{{"--"}}</span>
                                                                                            @endif
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-md-4">
                                                                                        <i class="bi bi-people-fill"></i>
                                                                                            <span style="color: #011e2a; font-weight: 500; font-size: 14px; text-transform: capitalize; margin-left: 4px;">
                                                                                                Apprenants
                                                                                            </span>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <a href="#">
                                                                                            @php
                                                                                                $dataApprs = $groupe->dataApprenant($pj->cfp_id, $pj->groupe_id);
                                                                                            @endphp

                                                                                            @if ( count($dataApprs) > 0)
                                                                                                @foreach ($dataApprs as $dataAppr)
                                                                                                    <span class='rounded-pill' style='padding: 2px 6px; color: #fff; background-color: #014f70; display: inline-block; margin-bottom: 1px; font-size: 13px'>{{ $dataAppr->nom_stagiaire." ".$dataAppr->prenom_stagiaire }}</span>
                                                                                                @endforeach
                                                                                            @elseif(count($dataApprs) <= 0)
                                                                                                <span class='rounded-pill' style='padding: 2px 7px; color: #fff; background-color: #014f70'>{{"--"}}</span>
                                                                                            @endif
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-md-4">
                                                                                        <i class="bi bi-currency-dollar"></i>
                                                                                            <span style="color: #011e2a; font-weight: 500; font-size: 14px; text-transform: capitalize; margin-left: 4px;">
                                                                                                Frais annexes
                                                                                            </span>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                            @php
                                                                                                $dataFrais = $groupe->dataFraisAnnexe($pj->groupe_id, $pj->entreprise_id);

                                                                                                $somme = 0;
                                                                                                if (count($dataFrais) > 0) {
                                                                                                    foreach ($dataFrais as $dataFrai) {
                                                                                                        $somme += $dataFrai->montantTotal;
                                                                                                    }
                                                                                                }
                                                                                            @endphp

                                                                                        <span style="color: #275b75; font-size: 15px">{{ number_format($somme, 2, ',', ' ') }} <span style="color: #ff0000">{{ $devise }}</span></span>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-md-4">
                                                                                        <i class="bi bi-cash-coin"></i>
                                                                                            <span style="color: #011e2a; font-weight: 500; font-size: 14px; text-transform: capitalize; margin-left: 4px;">
                                                                                                Coûts
                                                                                            </span>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                            @php
                                                                                                $dataFrais = $groupe->dataFraisAnnexe($pj->groupe_id, $pj->entreprise_id);

                                                                                                $somme = 0;
                                                                                                if (count($dataFrais) > 0) {
                                                                                                    foreach ($dataFrais as $dataFrai) {
                                                                                                        $somme += $dataFrai->montantTotal;
                                                                                                    }
                                                                                                }
                                                                                            @endphp

                                                                                        <span style="color: #275b75; font-size: 15px">{{ number_format($pj->prix, 2) }} <span style="color: #ff0000">{{ $devise }}</span></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">
                                                                                    <i class="bi bi-calendar2-week" style="color: #011e2a;"></i>
                                                                                    <span style="color: #011e2a; font-weight: 500;">Calendrier des séances</span>
                                                                                </h5>
                                                                                <hr>

                                                                                @php
                                                                                    $dataSessions = $groupe->dataSession($pj->groupe_id);
                                                                                @endphp
                                                                                <div class="row">
                                                                                    <div class="col-md-12" style="background: #014f70; color: #fff;">
                                                                                        <div class="row">
                                                                                            <div class="col-md-2" >
                                                                                                <span class="head">Séances</span>
                                                                                            </div>
                                                                                            <div class="col-md-2" >
                                                                                                <span class="head">Date</span>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <span class="head">Lieu de formation</span>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <span class="head">Début</span>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <span class="head">Fin</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-12" >
                                                                                        <div class="row">
                                                                                            @if ( count($dataSessions) > 0)
                                                                                                <div class="col-md-2" >
                                                                                                    @php
                                                                                                        $i = 1;
                                                                                                    @endphp
                                                                                                    @foreach ($dataSessions as $dataSession)
                                                                                                        <p style="font-size: 13px">{{ $i++ }}</p>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                                <div class="col-md-2" >
                                                                                                    @foreach ($dataSessions as $dataSession)
                                                                                                        <p style="font-size: 13px">{{ date('d M Y', strtotime($dataSession->date_detail)) }}</p>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                                <div class="col-md-4">
                                                                                                    @foreach ($dataSessions as $dataSession)
                                                                                                    @php
                                                                                                        $salle = explode(',', $dataSession->lieu);
                                                                                                    @endphp
                                                                                                        <p style="font-size: 13px">{{ $salle[0]." ".$salle[1] }}</p>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    @foreach ($dataSessions as $dataSession)
                                                                                                        <p style="font-size: 13px">{{ $dataSession->h_debut}} </p>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    @foreach ($dataSessions as $dataSession)
                                                                                                        <p style="font-size: 13px">{{ $dataSession->h_fin}} </p>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            @elseif( count($dataSessions) <= 0)
                                                                                               <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <span style="color: rgb(179, 95, 95)">Aucune séance</span>
                                                                                                    </div>
                                                                                               </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @if ($prj->type_formation_id == 2)
                                                            @break
                                                        @endif
                                                        </tr>
                                                    @endif
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                @endcanany

                @canany(['isFormateur'])
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <table class="table table-hover m-0 p-0 mt-2 table-borderless">
                            <thead class="thead_projet" style="border-bottom: 1px solid black; line-height: 20px">
                                <th>Projet</th>
                                <th>Type</th>
                                <th>Session</th>
                                <th> Module </th>
                                <th>Date session</th>
                                <th> Entreprise </th>
                                {{-- <th> Date du projet</th> --}}
                                <th> Modalité</th>
                                <th> Statut </th>
                                <th></th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $pj)
                                    <tr class="m-0">
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td>
                                            @if ($pj->type_formation_id == 1)
                                                <h6 class="m-0"><button
                                                        class="type_intra ">{{ $pj->type_formation }}</button>
                                                </h6>
                                                &nbsp;&nbsp;
                                            @elseif ($pj->type_formation_id == 2)
                                                <h6 class="m-0"><button
                                                        class="type_inter ">{{ $pj->type_formation }}</button></h6>
                                                &nbsp;&nbsp;
                                            @endif
                                        </td>
                                        <td class="detail_session">
                                            <a
                                                href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td class="text-start">
                                            {{ $pj->nom_module }}
                                            @php
                                                '&nbsp;' . $groupe->nombre_apprenant_session($pj->groupe_id);
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                                            @endphp
                                        </td>
                                        <td class="text-start">
                                            @foreach ($entreprise as $etp)
                                                @if ($etp->groupe_id == $pj->groupe_id)
                                                    {{ $etp->nom_etp }}
                                                @endif
                                            @endforeach
                                        </td>
                                        {{-- <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td> --}}
                                        <td class="tbody_projet"><span class="modalite">{{ $pj->modalite }}</span></td>
                                        <td class="tbody_projet">
                                            <p class="{{ $pj->class_status_groupe }} pe-1 ps-1 m-0">
                                                {{ $pj->item_status_groupe }}</p>
                                        </td>
                                        <td align="left">
                                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle' style="color:
                                                @php
                                                    echo $groupe->statut_presences($pj->groupe_id);
                                                @endphp
                                                "></i>&nbsp;Emargement</p>
                                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle'
                                                @php
                                                    $statut_eval = $groupe->statut_evaluation($pj->groupe_id);
                                                    if($statut_eval == 0){
                                                        echo 'style="color:#bdbebd;"';
                                                    }
                                                    elseif ($statut_eval == 1) {
                                                        echo 'style="color:#00ff00;"';
                                                    }
                                                @endphp
                                                ></i>&nbsp;Evaluation</p>
                                        </td>
                                        <td class="text-center">
                                            <i class='bx bx-chevron-down-circle mt-1' style="font-size: 1.8rem" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1">
                                                    <li class="action_projet"><a class="dropdown-item " href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}">Expoter en PDF</a></li>
                                                </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endcan


                @can('isFormateurInterne')
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <table class="table table-hover m-0 p-0 mt-2 table-borderless">
                            <thead class="thead_projet" style="border-bottom: 1px solid black; line-height: 20px">
                                <th>Projet</th>
                                <th>Type</th>
                                <th>Session</th>
                                <th> Module </th>
                                <th>Date session</th>
                                <th> Modalité</th>
                                <th> Statut </th>
                                {{-- <th></th> --}}
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $pj)
                                    <tr class="m-0">
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td class="pb-2 text-center">
                                            <h6><button class="type_inter">Interne</button></h6>
                                        </td>
                                        <td class="detail_session text-center">
                                            <a
                                                href="{{ route('detail_session_interne', [$pj->groupe_id]) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td class="text-start">{{ $pj->nom_module }}</td>
                                        <td class="text-center">
                                            @php
                                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                                            @endphp
                                        </td>
                                        <td class="tbody_projet"><span class="modalite">{{ $pj->modalite }}</span></td>
                                        <td class="tbody_projet">
                                            <p class="{{ $pj->class_status_groupe }} pe-1 ps-1 m-0">
                                                {{ $pj->item_status_groupe }}</p>
                                        </td>
                                        {{-- <td align="left">
                                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle' style="color:
                                                @php
                                                    echo $groupe->statut_presences($pj->groupe_id);
                                                @endphp
                                                "></i>&nbsp;Emargement</p>
                                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle'
                                                @php
                                                    $statut_eval = $groupe->statut_evaluation($pj->groupe_id);
                                                    if($statut_eval == 0){
                                                        echo 'style="color:#bdbebd;"';
                                                    }
                                                    elseif ($statut_eval == 1) {
                                                        echo 'style="color:#00ff00;"';
                                                    }
                                                @endphp
                                                ></i>&nbsp;Evaluation</p>
                                        </td> --}}
                                        <td class="text-center">
                                            <i class='bx bx-chevron-down-circle mt-1' style="font-size: 1.8rem" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1">
                                                    <li class="action_projet"><a class="dropdown-item " href="{{ route('fiche_technique_interne_pdf', [$pj->groupe_id]) }}">Expoter en PDF</a></li>
                                                </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endcan

                @canany(['isReferent','isReferentSimple','isManager','isChefDeService'])
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <table class="table shadow-sm table-striped">
                            <thead style="background: #cccccc" class="text-center">
                                <th>Projet</th>
                                <th> Session </th>
                                <th>Type de formation</th>
                                <th> Module </th>
                                <th><i class="bx bx-dollar"></i> {{$ref}}</th>
                                <th> <i class='bx bx-group'></i> </th>
                                <th>Date session</th>
                                <th>Ville</th>
                                <th> Centre de formation </th>
                                <th>Modalité</th>
                                <th> Statut </th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $pj)
                                    <tr>
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td class="text-center">
                                            @if ($pj->type_formation_id == 3)
                                            <a href="{{ route('detail_session_interne', [$pj->groupe_id]) }}"><span class="spanClass" style="border-bottom: 3px solid #673ab7">{{ $pj->nom_groupe }}</span></a>
                                            @else
                                                <a href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}"><span class="spanClass" style="border-bottom: 3px solid #673ab7">{{ $pj->nom_groupe }}</span></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($pj->type_formation_id == 1)
                                                <span style="background: #2193b0; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                    {{ $pj->type_formation }}
                                                </span>
                                            @elseif ($pj->type_formation_id == 2)
                                                <span style="background: #2ebf91; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                    {{ $pj->type_formation }}
                                                </span>
                                            @elseif ($pj->type_formation_id == 3)
                                                <span style="background: #b32cb8; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                    {{ $pj->type_formation }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-start">
                                            {{-- @php
                                                echo $groupe->module_session($pj->module_id);
                                            @endphp --}}
                                            {{ $pj->nom_module }}
                                        </td>
                                        <td class="text-end">
                                           @if($pj->hors_taxe_net!=null)
                                           {{number_format($pj->hors_taxe_net,0,","," ")}}
                                           @else
                                                @php
                                                    echo "<span>-</span>";
                                                @endphp
                                           @endif
                                        </td>
                                       <td>
                                        @if($pj->qte!=null)
                                            {{$pj->qte}}
                                        @else
                                            @php
                                                echo "<span>-</span>";
                                            @endphp
                                        @endif
                                         </td>
                                        <td class="text-center">
                                            @php
                                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                                            @endphp
                                        </td>
                                        <td>
                                            @if($lieuFormation!=null)
                                               {{$lieuFormation[0]}}
                                            @else
                                                {{"-"}}
                                            @endif
                                        </td>
                                        <td class="text-center"> {{ $pj->nom_cfp }} </td>
                                        {{-- <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td> --}}
                                        <td>
                                            <span>{{ $pj->modalite }}</span>
                                        </td>
                                        <td class="text-center">
                                            <p class="{{ $pj->class_status_groupe }} m-0">
                                                {{ $pj->item_status_groupe }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <i class='bx bx-chevron-down-circle mt-1' style="font-size: 1.8rem" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                            <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1">
                                                @if ($pj->type_formation_id == 3)
                                                    <li class="action_projet"><a class="dropdown-item " href="{{ route('fiche_technique_interne_pdf', [$pj->groupe_id]) }}">Expoter en PDF</a></li>
                                                    <li class="action_projet"><a class="dropdown-item " href="{{ route('resultat_evaluation_interne', [$pj->groupe_id]) }}">Evaluation à chaud</a></li>
                                                @else
                                                    <li class="action_projet"><a class="dropdown-item " href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}">Expoter en PDF</a></li>
                                                    <li class="action_projet"><a class="dropdown-item " href="{{ route('resultat_evaluation', [$pj->groupe_id]) }}">Evaluation à chaud</a></li>
                                                    @php
                                                        $reponse = $froidEval->periode_froid_evaluation($pj->groupe_id);
                                                    @endphp
                                                    @if($reponse == 1)
                                                        <li class="action_projet"><a class="dropdown-item" href="{{ route('evaluation_froid/resultat', [$pj->groupe_id]) }}">Evaluation à froid</a></li>
                                                    @endif
                                                @endif
                                              </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endcanany
                @can('isStagiaire')
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <div class="row mb-5 justify-content-md-start">
                            <div class="col-md-3 border-bottom">
                                <div class="text_retourner">
                                    <span style="--i:1">P</span>
                                    <span style="--i:2">r</span>
                                    <span style="--i:3">o</span>
                                    <span style="--i:4">j</span>
                                    <span style="--i:5">e</span>
                                    <span style="--i:6">c</span>
                                    <span style="--i:7">t</span>
                                    <span style="--i:8">s</span>
                                    <span style="--i:9"> </span>
                                    <span style="--i:10">T</span>
                                    <span style="--i:11">i</span>
                                    <span style="--i:12">m</span>
                                    <span style="--i:13">e</span>
                                    <span style="--i:14">l</span>
                                    <span style="--i:15">i</span>
                                    <span style="--i:16">n</span>
                                    <span style="--i:17">e</span>
                                </div>
                            </div>
                        </div>
                        @can('isStagiaire')
                            <div class="row justify-content-md-center mb-5">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-1 col-form-label">De:</label>
                                            <div class="col-sm-5">
                                                <input type="date" id="start_date" class="form-control input"/>
                                            </div>
                                                <label for="inputEmail3" class="col-sm-1 col-form-label">à:</label>
                                            <div class="col-sm-5">
                                                <input type="date" id="end_date" class="form-control input"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-sm-11 btn-group">
                                            <button type="button" class="form-select" data-bs-toggle="dropdown" aria-expanded="false">
                                                Tous les module
                                            </button>
                                            <ul id="module" class="dropdown-menu">
                                                <li class="border-bottom border-2">
                                                    <div class="col-sm-11 ms-2 mt-2 mb-2">
                                                        <input type="text" id="recherche_module" placeholder="Rechercher par module" class="form-control input"/>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item"><input name="module_all" type="checkbox" value="null"> Tous les modules</li>
                                            @foreach ($modules as $mod)
                                                <li class="dropdown-item"><input name="module" type="checkbox" value="{{$mod->nom_module}}"> {{$mod->nom_module}}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="btn-group col-sm-10">
                                            <button type="button" class="form-select" data-bs-toggle="dropdown" aria-expanded="false">
                                                Tous les formations
                                            </button>
                                            <ul id="formation" class="dropdown-menu">
                                                <li class="border-bottom border-2">
                                                    <div class="col-sm-11 ms-2 mt-2 mb-2">
                                                        <input type="text" id="recherche_formation" placeholder="Rechercher par formation" class="form-control input"/>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item"><input name="formation_all" type="checkbox" value="null"> Tous les formations</li>
                                            @foreach ($formations as $form)
                                                <li class="dropdown-item"><input name="formation" type="checkbox" value="{{$form->nom_formation}}"> {{$form->nom_formation}}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="btn-group col-sm-11">
                                            <button type="button" class="form-select" data-bs-toggle="dropdown" aria-expanded="false">
                                                Tous les Status
                                            </button>
                                            <ul id="status" class="dropdown-menu">
                                                <li class="border-bottom border-2">
                                                    <div class="col-sm-11 ms-2 mt-2 mb-2">
                                                        <input type="text" id="recherche_status" placeholder="Rechercher par status" class="form-control input"/>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item"><input name="status_all" type="checkbox" value="null"> Tous les Status</li>
                                                <li class="dropdown-item"><input name="status" type="checkbox" value="En cours"> En cours</li>
                                                <li class="dropdown-item"><input name="status" type="checkbox" value="Reprogrammer"> Reprogrammer</li>
                                                <li class="dropdown-item"><input name="status" type="checkbox" value="Annulée"> Annulée</li>
                                                <li class="dropdown-item"><input name="status" type="checkbox" value="Reporté"> Reporté</li>
                                                <li class="dropdown-item"><input name="status" type="checkbox" value="Cloturé"> Cloturé</li>
                                                <li class="dropdown-item"><input name="status" type="checkbox" value="Terminé"> Terminé</li>
                                                <li class="dropdown-item"><input name="status" type="checkbox" value="A venir"> A venir</li>
                                                <li class="dropdown-item"><input name="status" type="checkbox" value="Prévisionnel"> Prévisionnel</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        <div id="stg_projet">
                        @foreach ($data as $pj)
                        <div class="row listes justify-content-md-center">
                            <div class="col-md-2" style="">
                                <div class="date_class">
                                    <div style="float: left; display: inline-block; width: 100%;">
                                        <h5 class="p_date nom_mois mt-5">{{ $carbon::parse($pj->date_debut)->translatedFormat('M') }}</h5>
                                        <h6 class="p_date text-black-50"><span class="date_debut">@php echo strftime('%d-%m-%y', strtotime($pj->date_debut))@endphp</span> au <span class="date_fin">@php echo strftime('%d-%m-%y', strtotime($pj->date_fin)); @endphp</span></h6>
                                        <p class="col-md-3 nom_status {{$pj->class_status_groupe}}">{{$pj->item_status_groupe}}</p>
                                    </div>
                                    <div class="triangle-right"></div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <ul class="timeline-1 text-black">{{-- here --}}
                                    @php
                                        $statut_eval = $groupe->statut_evaluation_chaud($pj->groupe_id,$pj->stagiaire_id);
                                        $statut_eval_interne = $groupe->statut_evaluation_chaud_interne($pj->groupe_id,$pj->stagiaire_id);
                                    @endphp
                                    @if ($pj->item_status_groupe == 'En cours' || $pj->item_status_groupe == 'Prévisionnel')
                                        <li class="event">
                                    @elseif ($pj->item_status_groupe == 'Terminé')
                                        <li class="event_terminer">
                                    @elseif ($pj->item_status_groupe == 'Reprogrammer' || $pj->item_status_groupe == 'Annulée' || $pj->item_status_groupe == 'Reporté' || $pj->item_status_groupe == 'Cloturé')
                                        <li class="event_repro">
                                    @endif
                                        <div class="row mt-2 titre_projet mb-1 pt-2 pb-2 w-100 g-0">
                                            <div class="col-md-1 p-0">
                                            <h6 class="m-0"><a href="#collapseprojet_{{ $pj->groupe_id }}" class="mb-0 changer_carret d-flex" data-bs-toggle="collapse" role="button"><i class="bx bx-caret-down carret-icon"></i></a></h6>
                                            </div>
                                            <div class="col-md-2 text-start">
                                                <h6 class="nom_module">{{ $pj->nom_module }}</h6>
                                                <span class="nom_formation text-black-50">{{ $pj->nom_formation }}</span>
                                            </div>
                                            <div class="col-md-2 p-0 d-flex justify-content-start">
                                                @if($pj->type_formation_id == 3)
                                                <span style="background: #b32cb8; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                    Interne
                                                </span>
                                                @else
                                                    <img src="{{ asset('images/CFP/' . $pj->logo) }}" alt="{{ $pj->logo }}" style="width:64px;height:34px"/>
                                                @endif
                                            </div>
                                            <div class="col-md-1 p-0 d-flex justify-content-start">
                                                <a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" class="m-0 ps-1 pe-1 pdf_download"><button class="btn" style="width:57x;height:20px;font-size: 11px;padding-top: initial;"><i class="bx bxs-file-pdf"></i>PDF</button></a>
                                            </div>
                                            <div class="col-md-2 p-0 d-flex justify-content-start">
                                                @if($pj->type_formation_id == 3)
                                                    @if ($statut_eval_interne == 0)
                                                        <a class="btn_eval_stg" href="{{ route('faireEvaluationChaud_interne', [$pj->groupe_id]) }}"><button class="btn" style="width:116px;height:20px;font-size: 11px;padding-top: initial;color: #ffffff !important">Evaluation à faire</button></a>
                                                    @elseif ($statut_eval_interne == 1)
                                                        <p class="mt-3" style="color: green">Evaluation terminé</p>
                                                    @endif
                                                @else
                                                    @if ($statut_eval == 0)
                                                        <a class="btn_eval_stg" href="{{ route('faireEvaluationChaud', [$pj->groupe_id]) }}"><button class="btn" style="width:116px;height:20px;font-size: 11px;padding-top: initial;color: #ffffff !important">Evaluation à faire</button></a>
                                                    @elseif ($statut_eval == 1)
                                                        <p class="mt-3" style="color: green">Evaluation terminé</p>
                                                    @endif
                                                @endif

                                            </div>
                                            <div class="col-md-1 p-0 d-flex justify-content-start">
                                                <a class="resultat_stg" href="{{ route('resultat_stagiaire',[$pj->groupe_id]) }}"><button class="btn" style="width:63px;height:20px;font-size: 11px;padding-top: initial;">Résultat</button></a>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseprojet_{{ $pj->groupe_id }}">
                                            {{-- section --}}
                                            <section>
                                                <div class="row bg-light p-0 d-flex flex-row" role="tabpanel">
                                                    @if($pj->type_formation_id == 3)
                                                    <div class="col-md-2 nav_session">
                                                        <div class="corps_planning m-0 bg-light" id="myTab" data-id="refresh" role="tablist">
                                                            <div class="nav-item active" role="presentation">
                                                                <a href="#detail_{{ $pj->groupe_id }}" class="nav-link active p-0" id="detail-tab" data-toggle="tab" type="button"
                                                                    role="tab" aria-controls="home" aria-selected="true">
                                                                    <button class="planning_{{ $pj->groupe_id }} d-flex justify-content-between active detail-tab_{{ $pj->groupe_id }}" onclick="openCity(event, 'detail_{{ $pj->groupe_id }}')" style="width: 100%">
                                                                        <p class="m-0 pt-2 pb-2">PLANNING</p>
                                                                        {{-- @if ($test == 0)
                                                                            <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                                                        @endif
                                                                        @if ($test != 0)
                                                                            <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                                                        @endif --}}
                                                                    </button>
                                                                </a>
                                                            </div>
                                                            <div class="nav-item" role="presentation">
                                                                <a href="#apprenant_{{ $pj->groupe_id }}" class="nav-link p-0" id="apprenant-tab" data-toggle="tab" type="button"
                                                                    role="tab" aria-controls="home" aria-selected="true">
                                                                    <button class="planning_{{ $pj->groupe_id }} d-flex justify-content-between apprenant-tab_{{ $pj->groupe_id }}" onclick="openCity(event, 'apprenant_{{ $pj->groupe_id }}')" style="width: 100%">
                                                                        <p class="m-0 pt-2 pb-2">APPRENANTS</p>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                            <div class="nav-item" role="presentation">
                                                                <a href="#ressource_{{ $pj->groupe_id }}" class="nav-link p-0" id="ressource-tab" data-toggle="tab" type="button"
                                                                    role="tab" aria-controls="home" aria-selected="true">
                                                                    <button class="planning_{{ $pj->groupe_id }} d-flex justify-content-between action_animation ressource-tab_{{ $pj->groupe_id }}" onclick="openCity(event, 'ressource_{{ $pj->groupe_id }}')" style="width: 100%">
                                                                        <p class="m-0 pt-2 pb-2">RESSOURCES</p>
                                                                        {{-- @if (count($ressource) == 0)
                                                                            <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                                                        @else
                                                                            <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                                                        @endif --}}
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <div class="tab-content col-md-10">
                                                            <div class="tab-pane fade show active tabcontent_{{ $pj->module_id }}" id="detail_{{ $pj->module_id }}" role="tabpanel" aria-labelledby="detail-tab" style="display: block">
                                                                <table class="table table-hover table-borderless" style="border: none" id="dataTables-example">
                                                                    <thead style="border-bottom: 1px solid black; line-height: 20px">
                                                                        <td>Séance</td>
                                                                        <td>Module</td>
                                                                        <td>Ville</td>
                                                                        <td>Date</td>
                                                                        <td>Début</td>
                                                                        <td>Fin</td>
                                                                        <td>Formateur</td>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $i = 1;
                                                                        @endphp
                                                                        @foreach ($data_detail_interne as $dt)
                                                                        @if($pj->module_id == $dt->module_id)
                                                                            <tr>
                                                                                <td>{{ $i }}</td>
                                                                                <td>{{ $dt->nom_module }}</td>
                                                                                @php
                                                                                    $salle = explode(',  ', $dt->lieu);
                                                                                @endphp
                                                                                <td>{{ $dt->lieu }}</td>
                                                                                <td>{{ $dt->date_detail }}</td>
                                                                                <td>{{ $dt->h_debut }} h</td>
                                                                                <td>{{ $dt->h_fin }} h</td>
                                                                                <td>{{ $dt->nom_formateur . ' ' . $dt->prenom_formateur }}</td>
                                                                            </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="tab-pane fade show tabcontent_{{ $pj->module_id }}" id="apprenant_{{ $pj->module_id }}" role="tabpanel" aria-labelledby="apprenant-tab" style="display: none">
                                                                <div style="display: inline-block">
                                                                    @foreach($stagiaire_interne as $stg)
                                                                        @if($pj->module_id == $stg->module_id)
                                                                        <div class="float-start wrapper_stg mt-3 p-1 pe-2 ps-2 me-2">
                                                                            <span style="color:#ececec;">{{$stg->nom_stagiaire}}&nbsp;{{$stg->prenom_stagiaire}}</span>
                                                                        </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade show tabcontent_{{ $pj->module_id }}" id="ressource_{{ $pj->module_id }}" role="tabpanel" aria-labelledby="ressource-tab" style="display: none">
                                                            {{--  @if (count($ressource)>0) --}}
                                                                    <div class="mb-3 pe-5 ps-1 col-12 pb-5">
                                                                        <div class="row mt-0" style="border-bottom: 1px solid black; line-height: 20px">
                                                                            <div class="col-md-3">
                                                                                <span>
                                                                                    <h6>Matériel nécessaire</h6>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-3 p-0">
                                                                                <span>
                                                                                    <h6>Pris en charge par </h6>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-3 p-0">
                                                                                <span>
                                                                                    <h6>Note </h6>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-0 align-content-center">
                                                                            <div id="affiche_ressource">
                                                                                @foreach ($ressource_interne as $ri)
                                                                                    @if ($ri->groupe_id == $pj->groupe_id)

                                                                                    <div class="d-flex mt-1" id="ressource_{{ $ri->id }}">
                                                                                        <div class="col-md-3">
                                                                                            <section>
                                                                                                <i class="far fa-check-circle"></i>&nbsp; {{ $ri->description }}
                                                                                            </section>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <section>
                                                                                                {{ $ri->pris_en_charge }}
                                                                                            </section>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <section>
                                                                                                {{ $ri->note }}
                                                                                            </section>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                {{-- @else
                                                                    <div class="mb-3 pe-5 ps-1 col-12 pb-5">Vous n'avez pas besoin de ressources!</div>
                                                                @endif --}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @else
                                                        <div class="col-md-2 nav_session">
                                                            <div class="corps_planning m-0 bg-light" id="myTab" data-id="refresh" role="tablist">
                                                                <div class="nav-item active" role="presentation">
                                                                    <a href="#detail_{{ $pj->module_id }}" class="nav-link active p-0" id="detail-tab" data-toggle="tab" type="button"
                                                                        role="tab" aria-controls="home" aria-selected="true">
                                                                        <button class="planning_{{ $pj->module_id }} d-flex justify-content-between active detail-tab_{{ $pj->module_id }}" onclick="openCity(event, 'detail_{{ $pj->module_id }}')" style="width: 100%">
                                                                            <p class="m-0 pt-2 pb-2">PLANNING</p>
                                                                            {{-- @if ($test == 0)
                                                                                <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                                                            @endif
                                                                            @if ($test != 0)
                                                                                <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                                                            @endif --}}
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <div class="nav-item" role="presentation">
                                                                    <a href="#apprenant_{{ $pj->module_id }}" class="nav-link p-0" id="apprenant-tab" data-toggle="tab" type="button"
                                                                        role="tab" aria-controls="home" aria-selected="true">
                                                                        <button class="planning_{{ $pj->module_id }} d-flex justify-content-between apprenant-tab_{{ $pj->module_id }}" onclick="openCity(event, 'apprenant_{{ $pj->module_id }}')" style="width: 100%">
                                                                            <p class="m-0 pt-2 pb-2">APPRENANTS</p>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <div class="nav-item" role="presentation">
                                                                    <a href="#ressource_{{ $pj->module_id }}" class="nav-link p-0" id="ressource-tab" data-toggle="tab" type="button"
                                                                        role="tab" aria-controls="home" aria-selected="true">
                                                                        <button class="planning_{{ $pj->module_id }} d-flex justify-content-between action_animation ressource-tab_{{ $pj->module_id }}" onclick="openCity(event, 'ressource_{{ $pj->module_id }}')" style="width: 100%">
                                                                            <p class="m-0 pt-2 pb-2">RESSOURCES</p>
                                                                            {{-- @if (count($ressource) == 0)
                                                                                <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                                                            @else
                                                                                <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                                                            @endif --}}
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-content col-md-10">
                                                            <div class="tab-pane fade show active tabcontent_{{ $pj->module_id }}" id="detail_{{ $pj->module_id }}" role="tabpanel" aria-labelledby="detail-tab" style="display: block">
                                                                <table class="table table-hover table-borderless" style="border: none" id="dataTables-example">
                                                                    <thead style="border-bottom: 1px solid black; line-height: 20px">
                                                                        <td>Séance</td>
                                                                        <td>Module</td>
                                                                        <td>Ville</td>
                                                                        <td>Date</td>
                                                                        <td>Début</td>
                                                                        <td>Fin</td>
                                                                        <td>Formateur</td>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $i = 1;
                                                                        @endphp
                                                                        @foreach ($data_detail as $dt)
                                                                        @if($pj->module_id == $dt->module_id)
                                                                            <tr>
                                                                                <td>{{ $i }}</td>
                                                                                <td>{{ $dt->nom_module }}</td>
                                                                                @php
                                                                                    $salle = explode(',  ', $dt->lieu);
                                                                                @endphp
                                                                                <td>{{ $dt->lieu }}</td>
                                                                                <td>{{ $dt->date_detail }}</td>
                                                                                <td>{{ $dt->h_debut }} h</td>
                                                                                <td>{{ $dt->h_fin }} h</td>
                                                                                <td>{{ $dt->nom_formateur . ' ' . $dt->prenom_formateur }}</td>
                                                                            </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="tab-pane fade show tabcontent_{{ $pj->module_id }}" id="apprenant_{{ $pj->module_id }}" role="tabpanel" aria-labelledby="apprenant-tab" style="display: none">
                                                                <div style="display: inline-block">
                                                                    @foreach($stagiaire as $stg)
                                                                        @if($pj->module_id == $stg->module_id)
                                                                        <div class="float-start wrapper_stg mt-3 p-1 pe-2 ps-2 me-2">
                                                                            <span style="color:#ececec;">{{$stg->nom_stagiaire}}&nbsp;{{$stg->prenom_stagiaire}}</span>
                                                                        </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade show tabcontent_{{ $pj->module_id }}" id="ressource_{{ $pj->module_id }}" role="tabpanel" aria-labelledby="ressource-tab" style="display: none">
                                                            {{--  @if (count($ressource)>0) --}}
                                                                    <div class="mb-3 pe-5 ps-1 col-12 pb-5">
                                                                        <div class="row mt-0" style="border-bottom: 1px solid black; line-height: 20px">
                                                                            <div class="col-md-3">
                                                                                <span>
                                                                                    <h6>Matériel nécessaire</h6>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-3 p-0">
                                                                                <span>
                                                                                    <h6>Demandé(e) par </h6>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-3 p-0">
                                                                                <span>
                                                                                    <h6>Pris en charge par </h6>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-3 p-0">
                                                                                <span>
                                                                                    <h6>Note </h6>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-0 align-content-center">
                                                                            <div id="affiche_ressource">
                                                                                @foreach ($ressource as $r)
                                                                                    @if ($r->groupe_id == $pj->groupe_id)

                                                                                    <div class="d-flex mt-1" id="ressource_{{ $r->id }}">
                                                                                        <div class="col-md-3">
                                                                                            <section>
                                                                                                <i class="far fa-check-circle"></i>&nbsp; {{ $r->description }}
                                                                                            </section>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <section>
                                                                                                {{ $r->demandeur }}
                                                                                            </section>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <section>
                                                                                                {{ $r->pris_en_charge }}
                                                                                            </section>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <section>
                                                                                                {{ $r->note }}
                                                                                            </section>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                {{-- @else
                                                                    <div class="mb-3 pe-5 ps-1 col-12 pb-5">Vous n'avez pas besoin de ressources!</div>
                                                                @endif --}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif
                                                <div>
                                            </section>
                                            {{-- /section --}}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <script>
                            $('.document-tab_'.$pj->groupe_id).on('click',function(e){
                                localStorage.setItem('activeTab', 'document_'.$pj->groupe_id);
                            });
                            $('.ressource-tab_'.$pj->groupe_id).on('click',function(e){
                                localStorage.setItem('activeTab', 'ressource_'.$pj->groupe_id);
                            });
                            $('.apprenant-tab_'.$pj->groupe_id).on('click',function(e){
                                console.log("here");
                                localStorage.setItem('activeTab', 'apprenant_'.$pj->groupe_id);
                            });
                            $('.detail-tab_'.$pj->groupe_id).on('click',function(e){
                                localStorage.setItem('activeTab', 'detail_'.$pj->groupe_id);
                            });

                            let activeTab = localStorage.getItem('activeTab');

                            if(activeTab){
                                $('.tabcontent_'.$pj->groupe_id).css('display','none');
                                $('#' + activeTab).show();
                                tablinks = document.getElementsByClassName("planning_".$pj->groupe_id);
                                for (i = 0; i < tablinks.length; i++) {
                                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                                }
                                $('.'+activeTab+'-tab').addClass("active");
                            }
                        </script>
                        @endforeach
                        </div>
                    @endif
                @endcan
                    {{-- {!! $projet->links() !!} --}}
                </div>
            </div>
        </div>
        <div class="filtrer mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">Filter vos projets</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                </div>
                <hr class="mt-2">
                @canany(['isReferent', 'isCFP','isStagiaire','isReferentSimple','isManager','isChefDeService'])
                    <div class="col-12 pe-3">
                        <div class="row mb-3 p-2 pt-0">
                            <form action="{{ route('liste_projet') }}" method="GET">
                                <input type="hidden" name="type_formation" value="{{ $type_formation_id }}">
                                <div class="row px-3 mt-2">
                                    <select name="mois" id="mois" class="filtre_projet">
                                        <option value="null" selected>Mois</option>
                                        <option style="background-color: red;color: red;" value="1">Janvier</option>
                                        <option value="2">Février</option>
                                        <option value="3">Mars</option>
                                        <option value="4">Avril</option>
                                        <option value="5">Mai</option>
                                        <option value="6">Juin</option>
                                        <option value="7">Juillet</option>
                                        <option value="8">Août</option>
                                        <option value="9">Septembre</option>
                                        <option value="10">Octobre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Décembre</option>
                                    </select>
                                </div>
                                <div class="row px-3 mt-2">
                                    <select name="trimestre" id="trimestre" class="filtre_projet">
                                        <option value="null" selected>Trimestres</option>
                                        <option value="1">1e Trimestre</option>
                                        <option value="2">2e Trimestre</option>
                                        <option value="3">3e Trimestre</option>
                                        <option value="4">4e Trimestre</option>
                                    </select>

                                </div>
                                <div class="row px-3 mt-2">
                                    <select name="semestre" id="semestre" class="filtre_projet">
                                        <option value="null" selected>Semestres</option>
                                        <option value="1">1e Semestre</option>
                                        <option value="2">2e Semestre</option>
                                    </select>

                                </div>
                                <div class="row px-3 mt-2">
                                    <select name="annee" id="annee" class="filtre_projet">
                                        <option value="null" selected>Années</option>
                                    </select>
                                    <button class="btn btn_next mt-3 mb-3" type="submit">Appliquer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endcanany
                @canany(['isReferent','isReferentSimple'])
                    <div class="row px-3 mt-2">
                        <form action="{{ route('recherche_cfp') }}" method="POST">
                            @csrf
                            <div class="form-group mt-1 mb-1">
                                <input type="text " class="form-control input" name="cfp_search">
                                <label class="form-control-placeholder">Organisme de formation</label>
                            </div>
                            <div class="row px-3">
                                <button class="btn btn_next mt-3 mb-3" type="submit">Rechercher</button>
                            </div>
                        </form>
                    </div>
                @endcanany
                {{-- @can('isCFP')
                <div class="row px-3 mt-2">
                    <form  action="{{ route('recherche_entreprise') }}" method="POST">
                        @csrf
                        <div class="form-group mt-1 mb-1">
                        <input type="text " class="form-control input"   name="entreprise">
                        <label class="form-control-placeholder">Entreprise</label>
                    </div>
                    <div class="row px-3">
                        <button class="btn btn_next mt-3 mb-3" type="submit">Rechercher</button>
                    </div>
                    </form>
                </div>
                @endcan --}}
                @canany(['isReferent','isReferentSimple','isManager', 'isCFP','isChefDeService'])
                    <div class="col-12 ps-5">
                @endcanany
                @canany(['isFormateur', 'isStagiaire','isFormateurInterne'])
                    <div class="col-12 ps-5">
                    @endcanany
                    </div>
                    </div>

                {{--info Entreprise --}}
                <div class="infos mt-3">
                    <div class="row">

                        <div class="col">
                            <p class="m-0 text-center">INFORMATION</p>
                        </div>
                        <div class="col text-end">
                            <i class="bx bx-x " role="button" onclick="afficherInfos();" style="padding: 10px;"></i>
                        </div>
                        <hr class="mt-2">

                        <div class="mt-2" style="font-size:14px">
                                <div class="mt-1 text-center mb-3">
                                    <span id="lEtp">

                                    </span>
                                </div>
                                <div class="mt-1 text-center">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">

                                            <p id="nEtp" style="color: #64b5f6; font-size: 14px; text-transform: uppercase; font-weight: 700; padding: 5px;">

                                            </p>
                                            <p id="status">

                                            </p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1"><i class='bx bx-donate-heart'></i></div>
                                        <div class="col-md-3">Type</div>
                                        <div class="col-md">
                                            <span id="juridic" style="font-size: 14px;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1"><i class='bx bx-credit-card-front' ></i></div>
                                        <div class="col-md-3">NIF</div>
                                        <div class="col-md">
                                            <span id="nif" style="font-size: 14px;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1"><i class='bx bx-credit-card' ></i></div>
                                        <div class="col-md-3">STAT</div>
                                        <div class="col-md">
                                            <span id="stat" style="font-size: 14px;">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1"><i class='bx bx-phone'></i></div>
                                        <div class="col-md-3">Tel</div>
                                        <div class="col-md">
                                            <span id="tel" style="font-size: 14px;">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1"><i class='bx bx-envelope' ></i></div>
                                        <div class="col-md-3">E-mail</div>
                                        <div class="col-md">
                                            <span id="mail">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1"><i class='bx bx-location-plus' ></i></div>
                                        <div class="col-md-3">Adresse</div>
                                        <div class="col-md">
                                            <span id="adrlot"></span>
                                            <span id="adrlot2"></span>
                                            <span id="adrlot3"></span>
                                            <span id="adrlot4"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1"><i class='bx bx-globe' ></i></div>
                                        <div class="col-md-3">Site web</div>
                                        <div class="col-md">
                                            <span id="site">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                <script src="{{ asset('js/index2.js') }}"></script>
                @include("projet_session.functions.projet_stg")
                <script>
                    $("#formation_session_id").on("change", function() {
                        var id = $("#formation_session_id").val();
                        $("#module_id option").remove();
                        $.ajax({
                            method: "GET",
                            url: "{{ route('module_formation') }}",
                            data: {
                                id: id,
                            },
                            dataType: "html",
                            _token: "{{ csrf_token() }}",
                            success: function(response) {
                                var data = JSON.parse(response);
                                if (data.length <= 0) {
                                    document.getElementById("module_id_err").innerHTML =
                                        "Aucun module a été détecter! veuillez choisir la formation";
                                } else {
                                    // document.getElementById("module_id_err").innerHTML = "";
                                    for (var $i = 0; $i < data.length; $i++) {
                                        $("#module_id").append(
                                            '<option value="' +
                                            data[$i].id +
                                            '">' +
                                            data[$i].nom_module +
                                            "</option>"
                                        );
                                    }
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            },
                        });
                    });
                    // $('.changer_carret').on('click',function(){
                    //     if ($('.collapse').hasClass('show')) {
                    //         $('.collapse').remove('show');
                    //     } ;
                    // });

                    localStorage.setItem('activeTab', 'detail');
                </script>
                <script type="text/javascript">
                    function openCity(evt, cityName) {
                        // Declare all variables
                        var i, tabcontent, tablinks;
                        var module_id = cityName.split('_')[1];
                        // Get all elements with class="tabcontent" and hide them
                        tabcontent = document.getElementsByClassName("tabcontent_"+module_id);
                        for (i = 0; i < tabcontent.length; i++) {
                            tabcontent[i].style.display = "none";
                        }

                        // Get all elements with class="tablinks" and remove the class "active"
                        tablinks = document.getElementsByClassName("planning_"+module_id);
                        for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                        }

                        // Show the current tab, and add an "active" class to the button that opened the tab
                        document.getElementById(cityName).style.display = "block";
                        evt.currentTarget.className += " active";
                    }

                    function myFunction_commentaire() {
                        var x = document.getElementById("myDIV");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                    }
                </script>

                {{--info etp --}}
                <script>

                    $('.information').on('click', function(){
                        var etpId = $(this).data("id");
                        // console.log(etpId);
                        $.ajax({
                            type: "get",
                            url: "/info/etp",
                            data: { Id: etpId},
                            dataType: "html",
                            success: function (response) {
                                let userData = JSON.parse(response);
                                // console.log(userData);
                                for(let i = 0; i < userData.length; i++){
                                    let logo = '<img src="{{asset("images/entreprises/:url_img")}}" style="width:120px;height:120px;border-radius:100%">';
                                    logo = logo.replace(":url_img", userData[i].logo);
                                    $("#lEtp").html(" ");
                                    $("#lEtp").append(logo);
                                    $("#status").text(userData[i].nom_statut);
                                    $("#nEtp").text(userData[i].nom_etp);
                                    $("#juridic").text(': '+userData[i].nom_type);
                                    $("#nif").text(': '+userData[i].nif);
                                    $("#stat").text(': '+userData[i].stat);
                                    $("#tel").text(': '+userData[i].telephone_etp);
                                    $("#mail").text(': '+userData[i].email_etp);
                                    $("#adrlot").text(': '+userData[i].adresse_lot);
                                    $("#adrlot2").text(userData[i].adresse_quartier);

                                    $("#adrlot3").text(userData[i].adresse_ville);
                                    $("#adrlot4").text(userData[i].adresse_region);
                                    $("#site").text(': '+userData[i].site_etp);


                                    var status = $('#status');
                                    // console.log(status);

                                    if(status.text() == "Premium"){
                                        status.removeClass();
                                        status.addClass('green');
                                    }else if(status.text() == "Invité"){
                                        status.removeClass();
                                        status.addClass('red');
                                    }else if(status.text() == "Pending"){
                                        status.removeClass();
                                        status.addClass('yellow');
                                    }else{
                                        console.log('ereur');
                                    }

                                }
                            }
                        });

                    });

                </script>
            @endsection