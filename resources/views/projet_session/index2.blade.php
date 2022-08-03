@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Projets</p>
@endsection

@inject('groupe', 'App\groupe')
@inject('carbon', 'Carbon\Carbon')
@inject('froidEval', 'App\FroidEvaluation')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="http://infra.clarin.eu/content/libs/DataTables-1.10.6/extensions/ColVis/css/dataTables.colVis.css">
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


    .body_nav {
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

    .tabcontent {
        display: none;
    }

    .btn_modifier_statut {
        border-radius: 30px;
        padding: 1rem 1rem;
        color: black;
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
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding: 4px 1rem !important;
        border-radius: 5px !important;
        box-sizing: border-box !important;
        color: #637381 !important;
        font-size: 16px !important;
        letter-spacing: 1px !important;
        height: 40px !important;
    }

    .select2-container .select2-selection--single :focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border-bottom: 2px solid #28a7eb !important;
        outline-width: 0 !important;
    }

    .select2-container .select2-selection--single{
        height: 40px !important;
        border: 1px solid #28a7eb !important;
    }
    .popover{
        max-width:500px;
    }

    .myCircle:hover{
        color: #1e9600;
    }
    .hideAction{
        display: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 35px !important;
    }

    .fixedTop{
        overflow-y: scroll;
    }

    #myDiv{
        position: fixed;
        top: 0;

    }
    .spanClass:hover{
        color: #673ab7;
        transition: 0.3s ease-in-out;
    }

    .modifTable_length label, .modifTable_length select, .modifTable_filter label, .pagination, .headEtp, .dataTables_info, .dataTables_length, .headProject {
        font-size: 13px;
    }
    
    .dataTables_length label, .dataTables_filter label {
        font-size: 12px;
    }
    .redClass{
        color: #f44336 !important;
    }

    .arrowDrop{
        color: #1e9600;
        
    }
    .mivadika{
        transform: rotate(180deg) !important;
        color: red !important;
        transition: 0.3s !important;
    }

    #example_length select{
        height: 25px;
        font-size: 13px;
        vertical-align: middle;
    }

    .popover{
        max-width:500px;
    }

    .myCircle:hover{
        color: #1e9600;
    }
    .hideAction{
        display: none;
    }
    .dataTables_empty{
        font-size: 13px;
    }

    /* colvis */
    th, td { 
        white-space: nowrap; 
        border: none;
    }

    div.dataTables_wrapper {
        width: 95%;
        margin: 0 auto;
    }

    div.ColVis {
        float: left;
    }
    .DTFC_LeftBodyLiner{
        margin-top:-12px;
        padding-top: 0px;
        background: #ffff;
    }

    ul.ColVis_collection{
        box-shadow: none !important;
        background: #f3f3f3 !important;
        font-size: 12px !important;
    }

    ul.ColVis_collection li span{
        font-size: 14px !important;
    }

    ul.ColVis_collection li{
        background: #f3f3f3;
        box-shadow: none !important;
        border: none;
        font-size: 12px !important;
    }
    ul.ColVis_collection li:hover{
        background: #f3f3f3;
        box-shadow: none !important;
        border: none;
        font-size: 12px !important;
    }
    /* .myTh th{
        font-size: 0px; 
        padding: 0;
        background: white; 
        border: 1px solid #fff !important;
    } */

    .myTh{
        font-size: 13px;

    }
    .myData{
        font-size: 12px;
    }
    #example{
        padding-bottom: 20px !important; 
    }
    
    /* table .dropdown-menu  {
        position:fixed !important; 
        z-index: 1;
        background: white;
        opacity: inherit;
    } */
    
    .dataTables_wrapper.no-footer div.dataTables_scrollBody > table {
        position: relative; 
        z-index: 0;
        
    }

    .table{
        overflow: unset !important;
    }
    button.ColVis_Button{
        box-shadow: none;
        font-size: 12px;
        height: 25px;
        background: #ffff !important;
        color: rgb(73, 69, 69) !important;
    }
    button.ColVis_Button:hover{
        box-shadow: none !important;
    }

    div.dataTables_scrollHead {
        overflow: visible !important;
    }

    div.DTFC_LeftHeadWrapper{
        overflow: visible !important;
    }
</style>
<div class="container-fluid mt-5">
    @if (Session::has('pdf_error'))
        <div class="alert alert-danger ms-4 me-4">
            <ul>
                <li>{!! \Session::get('pdf_error') !!}</li>
            </ul>
        </div>
    @endif

    @canany(['isCFP'])
        @if (count($projet) <= 0)
            <div class="container mt-3 p-1 mb-1">
                <div id="popup">
                    <div class="row">
                        <div class="col text-center">
                            <i class='bx bxs-plus-circle icon_upgrade me-3'></i>
                            @if($abonnement_cfp[0]->illimite != 1)
                                @if($nb_formateur == 0 || $nb_formateur == 0 || $nb_collaboration == 0)Vous n’avez pas encore de projet @if($nb_modules == 0)pour en créer un ajouter d’abord des modules a votre <a data-bs-toggle="modal" data-bs-target="#nouveau_module" role="button" class="text-primary lien_condition">catalogue de formation</a>.@endif @if($nb_formateur == 0)<a href="{{route('liste_formateur')}}" class="text-primary lien_condition">Ajouter des formateurs</a>.@endif @if($nb_collaboration == 0)<a href="{{route('liste_entreprise')}}" class="text-primary lien_condition">Inviter des entreprises.</a>@endif .@endif @if($nb_formateur != 0 && $nb_formateur != 0 && $nb_collaboration != 0)Maintenant vous pouvez créer votre premier projet de formation <a href="{{route('nouveau_groupe',1)}}" class="text-primary lien_condition">intra</a> @if($abonnement_cfp != null) ou <a href="{{route('nouveau_groupe_inter',2)}}" class="text-primary lien_condition">inter</a>@endif.@endif
                            @else
                                <span>Votre abonnement actuel vous permet de faire un nombre illimités de projets.</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <img src="{{asset('img/folder(1).webp')}}" alt="folder empty" width="300px" height="300px">
                    <p>Aucun projet en cours</p>
                </div>
            </div>
        @endif
        @if (Session::has('groupe_error'))
            <div class="alert alert-danger ms-2 me-2">
                <ul>
                    <li>{!! \Session::get('groupe_error') !!}</li>
                </ul>
            </div>
        @endif

        <table class="table order-column" id="example">
            <thead>
                <tr style="background: #d4d1d139;margin-top:-10px">
                    <th >
                        <div class="dropdown">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-library align-middle'></i> Projet
                            </button>
                            <ul class="dropdown-menu main p-2" >
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all">
                                    <label class="form-check-label label" for="select_all" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomProjet as $prj)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Projet2" value="{{ $prj->nom_projet}}"><span style="font-size: 12px">{{ $prj->nom_projet}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th >
                        <div class="dropdown">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bxs-book-open align-middle" style="color: #2e3950"></i> Session
                            </button>
                            <ul class="dropdown-menu main p-2" >
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all">
                                    <label class="form-check-label label" for="select_all" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomSessions as $s)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Session2" value="{{ $s->nom_groupe}}"><span style="font-size: 12px">{{ $s->nom_groupe}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    
                    <th class="headProject" >
                        <div class="dropdown">
                
                            <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bxs-customize align-middle" style="color: #2e3950"></i> Module
                            </button>
                            {{-- <ul  class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all23">
                                    <label class="form-check-label label" for="select_all23" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomModules as $m)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Module2" value="{{ $m->nom_module}}"><span style="font-size: 12px">{{ $m->nom_module}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul> --}}
                        </div>
                    </th>
                    <th class="headProject" >
                        <div class="dropdown z-index-2" id="ta">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-building-house align-middle'></i> Entreprise
                            </button>
                            
                            <ul  class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all3">
                                    <label class="form-check-label label" for="select_all3" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomEntreprises as $e)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Entreprise2" value="{{ $e->nom_etp}}"><span style="font-size: 12px">{{ $e->nom_etp}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th >
                        <div class="dropdown" >
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-calendar-check align-middle' ></i> Modalité
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all4">
                                    <label class="form-check-label label" for="select_all4" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomModalites as $mdlt)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Modalite2" value="{{ $mdlt->modalite}}"><span style="font-size: 12px">{{ $mdlt->modalite}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                        </ul>
                        </div>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-dollar-circle align-middle' ></i> Montant
                        </button>
                    </th>
                    <th>
                        <div class="dropdown">
                            <a id="exampleE1" tabindex="0" class="btn btn-sm btn-default" role="button" data-bs-toggle="popover" title="Recherche entre 2 périodes" style="width: 100%;">
                                <i class='bx bx-time-five'></i> <span style="font-size: 13px">Date</span> &nbsp;&nbsp;<i class='bx bx-caret-down' style="font-size: 12px"></i>
                            </a>
                        </div>
                        <div hidden>
                            <div data-name="popover-content">
                                <table class="table">
                                    <thead>
                                        <form action="{{ route('project.filterBydate') }}" method="post">
                                            @csrf
                                            <tr>
                                                <th style="font-size: 12px; font-weight: 400;">De</th>
                                                <th style="font-size: 12px; font-weight: 400;">A</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <div class="input-group input-group-sm" style="width: 98%;">
                                                        <input type="date" name="from" id="from" value="{{ date('Y-m-d')}}" class="form-control form-control-sm @error('from') is-invalid @enderror" style="font-size: 13px">
                                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' style="font-size: 20px"></i></span>
                                                        @error('from')
                                                            <span class="text-danger" style="font-size: 12px">{{ "Ce champs est obligatoire" }}</span>
                                                        @enderror
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="input-group input-group-sm" style="width: 98%;">
                                                        <input type="date" name="to" id="to" value="{{ date('Y-m-d')}}" class="form-control form-control-sm @error('to') is-invalid @enderror" style="font-size: 13px">
                                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' style="font-size: 20px"></i></span>
                                                        @error('to')
                                                            <span class="text-danger" style="font-size: 12px">{{ "Ce champs est obligatoire" }}</span>
                                                        @enderror
                                                    </div>
                                                </th>
                                                <th>
                                                    <button type="submit" class="btn btn-sm btn-primary">Filtrer <i class='bx bx-search-alt-2' style="font-size: 20px; vertical-align: middle;"></i></button>
                                                </th>
                                            </tr>
                                        </form>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </th>
                    <th  >
                        <div class="dropdown" >
                            <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-home align-middle' ></i> Ville
                            </button>
                        </div>
                    </th>
                    <th >
                        <div class="dropdown" >
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-book-content align-middle' style="vertical-align: middle"></i> Type
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all6">
                                    <label class="form-check-label label" for="select_all6" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomTypes as $ntp)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Type2" value="{{ $ntp->type_formation}}"><span style="font-size: 12px">{{ $ntp->type_formation}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th  >
                        <div class="dropdown" >
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-calendar-x align-middle' style="color: #2e3950"></i> Statuts
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all1">
                                    <label class="form-check-label label" for="select_all1" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomStatuts as $stt)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Statut2" value="{{ $stt->item_status_groupe}}"><span style="font-size: 12px">{{ $stt->item_status_groupe}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                
                    <th >
                        <div class="dropdown" >
                            <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-task align-middle' ></i> Eval à chaud
                            </button>
                        </div>
                    </th>
                    <th >
                        <div class="dropdown" >
                            <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-task-x align-middle' ></i> Eval à froid
                            </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bxs-report align-middle' style="vertical-align: middle"></i> Rapport
                                </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-timer align-middle' style="vertical-align: middle; font-size: 20px"></i> Présence
                                </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-spa align-middle' style="vertical-align: middle"></i> Competence
                                </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bxs-file-pdf align-middle' style="vertical-align: middle"></i> PDF
                                </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-menu align-middle' style="vertical-align: middle"></i> Action
                                </button>
                        </div>
                    </th>
                </tr>
                <tr class="myTh">
                    <th >Projet</th>
                    <th >Session</th>
                    <th >Module</th>
                    <th >Entreprise</th>
                    <th >Modalité</th>
                    <th >Montant</th>
                    <th >Date</th>
                    <th >Ville</th>
                    <th >Type</th>
                    <th >Statuts</th>
                    <th >Eval à chaud</th>
                    <th >Eval à froid</th>
                    <th >Rapport</th>
                    <th >Présence</th>
                    <th >Competence</th>
                    <th >PDF</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody class="myTbody">
                @foreach ($fullProjects as $projet)
                    <tr class="tab">
                        <td >
                            <span>
                                <a role="button"  data-bs-toggle="modal" data-bs-target="#exampleModal_{{$projet->groupe_id}}">
                                    <i class='bx bx-window-open' data-id="{{$projet->groupe_id}}" style="font-size: 18px; vertical-align: middle; color: #1c7f2e"></i>
                                </a>&nbsp;&nbsp;
                                <span class="myData">{{ $projet->nom_projet }}</span>
                            </span>
                        </td>
                        <td>
                            <span class="myData">
                                <a href="{{ route('detail_session', [$projet->groupe_id, $projet->id]) }}">
                                    <span style="font-size: 13px"  class="spanClass">{{ $projet->session }}</span>
                                    &nbsp;&nbsp;
                                    <span>
                                        <i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i>
                                    </span>
                                </a>
                            </span>
                        </td>
                        <td>
                            <span class="myData">{{ $projet->nom_module }}</span>
                        </td>
                        <td>
                            <span class="myData">{{ $projet->nom_etp }}</span>
                        </td>
                        <td>
                            <span style="z-index:-1!important" class="myData">{{ $projet->modalite }}</span>
                        </td>
                        <td class="text-end">
                            <span style="font-size: 13px">0 Ar</span>
                        </td>
                        <td>
                            <span class="myData">{{ \Carbon\Carbon::parse($projet->date_debut)->translatedFormat('d-m-y') }}</span> <span style="font-size: 11px">au</span> 
                            <span class="myData">{{ \Carbon\Carbon::parse($projet->date_fin)->translatedFormat('d-m-y') }}</span>
                        </td>
                        @if ($projet->lieu == null)
                            <td class="text-center">
                                <span>{{ '-' }}</span>
                            </td>
                        @else
                            <td>
                                <span class="myData">{{ $projet->lieu }}</span>
                            </td>
                        @endif
                        <td class="text-center">
                            <span class="myData">{{ $projet->type_formation }}</span>
                        </td>
                        <td class="text-center">
                            @if($projet->item_status_groupe === 'Cloturé')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#111111"">Cloturé</span>
                            @elseif($projet->item_status_groupe === 'Reporté')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#af10e9"">Reporté</span>
                            @elseif($projet->item_status_groupe === 'Prévisionnel')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#2792e4"">Prévisionnel</span>
                            @elseif($projet->item_status_groupe === 'Annulée')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#b33939"">Annulée</span>
                            @elseif($projet->item_status_groupe === 'Reprogrammer')    
                                <span class="myData badge" style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#00CDAC">Reprogrammer</span>
                            @endif 
                        </td>

                        <td class="text-center" style="font-size: 13px">
                            @php
                                $eval_chaud = $groupe->statut_evaluation($projet->groupe_id);
                            @endphp
                            @if($projet->date_debut > \Carbon\Carbon::today()->toDateString())
                                <a href="{{ route('resultat_evaluation', [$projet->groupe_id]) }}" style="font-size: 13px">
                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #868686"></i>
                                </a>
                            @elseif($eval_chaud == 1)
                                <a href="{{ route('resultat_evaluation', [$projet->groupe_id]) }}" style="font-size: 13px">
                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                </a>
                            @elseif($eval_chaud == 0)
                                <a href="{{ route('resultat_evaluation', [$projet->groupe_id]) }}" style="font-size: 13px">
                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #b31217"></i>
                                </a>
                            @endif
                        </td>
                        <td class="text-center" style="font-size: 13px">
                            <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                        </td>

                        
                        @if ($projet->id == 1)
                            <td class="text-center" style="font-size: 13px">
                                <a href="{{ route('nouveauRapportFinale', [$projet->groupe_id]) }}" target="_blank" style="font-size: 13px">
                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                </a>
                            </td>
                        @else
                            <td class="text-center">
                                <i class='bx bxs-circle' style="font-size: 13px; cursor: not-allowed; color: #b31217"></i>
                            </td>
                        @endif
                        <td class="text-center">
                            <i class='bx bxs-circle' style="font-size: 13px; cursor: not-allowed; color: rgb(163, 162, 162)"></i>
                        </td>
                        <td class="text-center">
                            <i class='bx bxs-circle' style="font-size: 13px; cursor: not-allowed; color: #1c7f2e"></i>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('fiche_technique_pdf', [$projet->groupe_id]) }}" style="font-size: 13px">
                                <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            @can('isCFP')
                                <i style="color: rgb(25, 193, 225); cursor: pointer;font-size:20px" class='bx bx-edit'data-bs-toggle="modal" data-bs-target="#modal_modifier_session_{{ $projet->groupe_id }}" data-backdrop="static"></i>
                            @endcan
                        </td>
                    </tr>

                    <div class="modal fade  "  id="exampleModal_{{$projet->groupe_id}}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl " >
                        <div class="modal-content" style="width: 1800px">
                            <div class="modal-header text-dark" style="background: whitesmoke;color:gray !important">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ $projet->nom_module }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                
                                <div  id="collapseProject_{{$projet->groupe_id}}">
                                    <div class="card card-xl" >
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class='bx bxs-customize' style="color: #011e2a;"></i>
                                                        <span style="color: #011e2a; font-weight: 500; text-transform: capitalize; font-size: 16px">{{ $projet->nom_module }}</span>
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
                                                                    $dataDetails = $groupe->formateurData($projet->groupe_id);
                                                                @endphp

                                                                @if ( count($dataDetails) > 0)
                                                                    @foreach ($dataDetails as $dataDetail)
                                                                        <span class='rounded-pill' style='padding: 4px 8px; border: 1px solid #e4e4e498; color: #011e2a; font-size: 14px;'>{{ $dataDetail->nom_formateur }}</span>
                                                                    @endforeach
                                                                @elseif(count($dataDetails) <= 0)
                                                                    <span class='rounded-pill' style='padding: 2px 7px; border: 1px solid #e4e4e498; color: #011e2a;'>{{"--"}}</span>
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
                                                                    $dataApprs = $groupe->dataApprenant($projet->entreprise_id, $projet->groupe_id);
                                                                    $dataNombres = $groupe->dataNombre($projet->groupe_id);
                                                                @endphp

                                                                @if ( count($dataApprs) > 0)
                                                                    @foreach ($dataApprs as $dataAppr)
                                                                        <span class='rounded-pill' style='padding: 2px 6px; border: 1px solid #e4e4e498; color: #011e2a; display: inline-block; margin-bottom: 1px; font-size: 13px'>{{ $dataAppr->nom_stagiaire." ".$dataAppr->prenom_stagiaire }}</span>
                                                                    @endforeach
                                                                @elseif(count($dataApprs) <= 0)
                                                                    
                                                                @endif
                                                            </a>
                                                            @foreach ($dataNombres as $nbr)
                                                                <span class='rounded-pill' style='padding: 4px 8px; border: 1px solid #e4e4e498; color: #011e2a; font-size: 13px;'>{{$nbr->nombre}}</span>
                                                            @endforeach

                                                            <a data-bs-toggle="collapse" href="#collapseNombre" role="button" aria-expanded="false" aria-controls="collapseNombre">
                                                                <i class='bx bx-chevron-down' style="vertical-align: middle; font-size: 25px;"></i>
                                                                <div class="collapse" id="collapseNombre">
                                                                    <div class="card card-body">
                                                                        <a href="#">
                                                                            @php
                                                                                $dataAllApprs = $groupe->dataApprenantAll($projet->groupe_id);
                                                                            @endphp

                                                                            @if ( count($dataAllApprs) > 0)
                                                                                @foreach ($dataAllApprs as $dataAllAppr)
                                                                                    <span class='rounded-pill' style='padding: 2px 6px; border: 1px solid #e4e4e498; color: #011e2a; display: inline-block; margin-bottom: 1px; font-size: 13px'>{{ $dataAllAppr->nom_stagiaire." ".$dataAllAppr->prenom_stagiaire }}</span>
                                                                                @endforeach
                                                                            @elseif(count($dataAllApprs) <= 0)
                                                                                <span class='rounded-pill' style='padding: 4px 8px; border: 1px solid #e4e4e498; color: #011e2a; font-size: 13px;'>0</span>
                                                                            @endif
                                                                        </a>
                                                                    </div>
                                                                </div>
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
                                                                    $dataFrais = $groupe->dataFraisAnnexe($projet->groupe_id, $projet->entreprise_id);

                                                                    $somme = 0;
                                                                    if (count($dataFrais) > 0) {
                                                                        foreach ($dataFrais as $dataFrai) {
                                                                            $somme += $dataFrai->montantTotal;
                                                                        }
                                                                    }
                                                                @endphp

                                                            <span style="color: #011e2a; font-size: 13px">{{ number_format($somme, 2, ',', ' ') }} <span style="font-size: 12px">{{ $devise }}</span></span>

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
                                                                {{-- @php
                                                                    $dataFrais = $groupe->dataFraisAnnexe($projet->groupe_id, $projet->entreprise_id);

                                                                    $somme = 0;
                                                                    if (count($dataFrais) > 0) {
                                                                        foreach ($dataFrais as $dataFrai) {
                                                                            $somme += $dataFrai->montantTotal;
                                                                        }
                                                                    }
                                                                @endphp --}}

                                                            <span style="color: #011e2a; font-size: 13px">00 <span style="font-size: 12px">{{ $devise }}</span></span>
                                                            {{-- <span style="color: #011e2a; font-size: 13px">{{ number_format($projet->prix, 2) }} <span>{{ $devise }}</span></span> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class='bx bx-calendar' style="color: #011e2a;"></i>
                                                        <span style="color: #011e2a; font-weight: 500; font-size: 16px">Calendrier des séances</span>
                                                    </h5>
                                                    <hr>

                                                    @php
                                                        $dataSessions = $groupe->dataSession($projet->groupe_id);
                                                    @endphp
                                                    <div class="row">
                                                        @php
                                                            $info = $groupe->infos_session($projet->groupe_id);
                                                            if ($info->difference == null && $info->nb_detail == 0) {
                                                                echo "<span style='font-size: 13px'>".$info->nb_detail . ' séance , durée totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m'."</span>";
                                                            } elseif ($info->difference != null && $info->nb_detail == 1) {
                                                                echo "<span style='font-size: 13px'>".$info->nb_detail . ' séance , durée totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m'."</span>";
                                                            } elseif ($info->difference != null && $info->nb_detail > 1) {
                                                                echo "<span style='font-size: 13px'>".$info->nb_detail . ' séances , durée totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m'."</span>";
                                                            }
                                                        @endphp
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="background: #e4e4e498;">
                                                            <div class="row">
                                                                <div class="col-md-2" >
                                                                    <span class="headEtp">Séances</span>
                                                                </div>
                                                                <div class="col-md-2" >
                                                                    <span class="headEtp">Date</span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <span class="headEtp">Lieu de formation</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <span class="headEtp">Début</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <span class="headEtp">Fin</span>
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
                                                                            <p style="font-size: 13px">{{ \Carbon\Carbon::parse($dataSession->date_detail)->translatedFormat('d M Y') }}</p>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        @foreach ($dataSessions as $dataSession)
                                                                        @php
                                                                            $salle = explode(',  ', $dataSession->lieu);
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
                                                                            <span style="font-size: 13px; color: #011e2a">Aucune séance</span>
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
                                </div>
                            </div>
                            {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                            </div> --}}
                        </div>
                        </div>
                    </div>
                @endforeach
                @foreach ($data as $pj)
                    <div>
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
                                data-backdrop="static" data-bs-backdrop="false">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content p-3">
                                        <div class="modal-title pt-3"
                                            style="height: 50px; align-items: center;">
                                            <h5 class="text-center my-auto">Modifier session
                                                <strong>{{ $pj->nom_groupe }}</strong>
                                            </h5>
                                        </div>
                                        @if ($projet->id == 1)
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
                                                            </div>
                                                            <div class="row ps-3 mt-2">
                                                                <div
                                                                    class="col-lg-6 text-end mt-2">
                                                                    <span>Module<strong
                                                                            class="text-danger">*</strong>
                                                                    </span>
                                                                </div>
                                                                <div class="col-lg-6 text-start">
                                                                    <select
                                                                        class="form-select input_select"
                                                                        name="module"
                                                                        aria-label="Default select example"
                                                                        style="width: 15rem;"
                                                                        required>
                                                                        <option value="null">
                                                                            Sélectionnez</option>
                                                                        @foreach ($module as $modu)
                                                                            <option value="{{ $modu->id }}">{{ $modu->nom_module }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div
                                                                    class="col-lg-6 text-end mt-2">
                                                                    <span>Modalité<strong
                                                                            class="text-danger">*</strong>
                                                                    </span>
                                                                </div>
                                                                <div class="col-lg-6 text-start">
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
                                                </form>
                                            </div>
                                        @endif
                                        @if ($projet->id == 2)
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
                                                                <button type="button" class="btn  btn_annuler" data-dismiss="modal">
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
                    </div>
                @endforeach
            </tbody>
        </table>
    @endcanany

    @canany(['isReferent','isReferentSimple','isManager','isChefDeService'])
        @if (count($data) <= 0)
            <div class="d-flex mt-3 titre_projet p-1 mb-1">
                <span class="text-center">Vous n'avez pas encore du projet.</span>
            </div>
        @else
            <table class="table mahafaly">
                <thead>
                    <tr style="background: #c7c9c939">
                        <th>
                            <div class="dropdown">
                                <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-library align-middle'></i> Projet
                                </button>
                                <ul class="dropdown-menu main p-2" >
                                    <li>
                                        <input type="text" class="column_search form-control form-control-sm">
                                    </li>
                                    <li>
                                        <input class="form-check-input select_all1" type="checkbox" id="select_all">
                                        <label class="form-check-label label" for="select_all" style="font-size: 12px">Selectionez tout</label>
                                    </li>
                                    <ul>
                                        @foreach ($nomProjet as $prj)
                                            <div class="form-check">
                                                <li>
                                                    <input class="checkbox form-check-input" type="checkbox" name="Projet1" value="{{ $prj->nom_projet}}"><span style="font-size: 12px">{{ $prj->nom_projet}}</span>
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </ul>
                            </div>
                        </th>
                        <th>
                            <div class="dropdown">
                                <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bxs-book-open align-middle" style="color: #2e3950"></i> Session
                                </button>
                                <ul class="dropdown-menu main p-2">
                                    <li>
                                        <input type="text" class="column_search form-control form-control-sm">
                                    </li>
                                    <li>
                                        <input class="form-check-input select_all1" type="checkbox" id="select_all1">
                                        <label class="form-check10abel label" for="select_all1" style="font-size: 12px">Selectionez tout</label>
                                    </li>
                                    <ul>
                                        @foreach ($nomSessions as $sess)
                                            <div class="form-check">
                                                <li>
                                                    <input class="checkbox form-check-input" type="checkbox" name="Session1" value="{{ $sess->nom_groupe}}"><span style="font-size: 12px">{{ $sess->nom_groupe}}</span>
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </ul>
                            </div>
                        </th>
                        <th>
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bxs-customize'></i> Module
                            </button>
                        </th>
                        <th>
                            <div class="dropdown z-index-2" id="ta">
                                <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-building-house'></i> Centre de formation
                                </button>
                                
                                <ul  class="dropdown-menu main p-2">
                                    <li>
                                        <input type="text" class="column_search form-control form-control-sm">
                                    </li>
                                    <li>
                                        <input class="form-check-input select_all1" type="checkbox" id="select_all3">
                                        <label class="form-check-label label" for="select_all3" style="font-size: 12px">Selectionez tout</label>
                                    </li>
                                    <ul>
                                        @foreach ($nomEtps as $e)
                                            <div class="form-check">
                                                <li>
                                                    <input class="checkbox form-check-input" type="checkbox" name="Cfp1" value="{{ $e->nom_etp}}"><span style="font-size: 12px">{{ $e->nom_etp}}</span>
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </ul>
                            </div>
                        </th>
                        <th>
                            <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-calendar-check' ></i> Modalité
                            </button>
                        </th>
                        <th>
                            <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-time-five' ></i> Date
                            </button>
                        </th>
                        <th>
                            <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-home' ></i> Ville
                            </button>
                        </th>
                        <th>
                            <div class="dropdown" >
                                <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-calendar-x align-middle' style="color: #2e3950"></i> Statuts
                                </button>
                                <ul class="dropdown-menu main p-2">
                                    <li>
                                        <input type="text" class="column_search form-control form-control-sm">
                                    </li>
                                    <li>
                                        <input class="form-check-input select_all1" type="checkbox" id="select_all1">
                                        <label class="form-check-label label" for="select_all1" style="font-size: 12px">Selectionez tout</label>
                                    </li>
                                    <ul>
                                        @foreach ($nomStatuts as $stt)
                                            <div class="form-check">
                                                <li>
                                                    <input class="checkbox form-check-input" type="checkbox" name="Statut1" value="{{ $stt->item_status_groupe}}"><span style="font-size: 12px">{{ $stt->item_status_groupe}}</span>
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </ul>
                            </div>
                        </th>
                        <th>
                            <div class="dropdown" >
                                <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-book-content align-middle' style="vertical-align: middle"></i> Type
                                </button>
                                <ul class="dropdown-menu main p-2">
                                    <li>
                                        <input type="text" class="column_search form-control form-control-sm">
                                    </li>
                                    <li>
                                        <input class="form-check-input select_all1" type="checkbox" id="select_all6">
                                        <label class="form-check-label label" for="select_all6" style="font-size: 12px">Selectionez tout</label>
                                    </li>
                                    <ul>
                                        @foreach ($nomTypes as $ntp)
                                            <div class="form-check">
                                                <li>
                                                    <input class="checkbox form-check-input" type="checkbox" name="Type1" value="{{ $ntp->type_formation}}"><span style="font-size: 12px">{{ $ntp->type_formation}}</span>
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </ul>
                            </div>
                        </th>
                        <th>
                            <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-task align-middle' ></i> Eval à chaud
                            </button>
                        </th>
                        <th>
                            <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-task-x align-middle' ></i> Eval à froid
                            </button>
                        </th>
                        <th>
                            <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bxs-file-pdf align-middle' style="vertical-align: middle"></i> PDF
                            </button>
                        </th>
                    </tr>
                    <tr class="myTh">
                        <th></i> Projet</th>
                        <th></i> Session</th>
                        <th></i> Module</th>
                        <th></i> Centre de formation</th>
                        <th></i> Modalité</th>
                        <th></i> Date</th>
                        <th> Ville</th>
                        <th></i> Statut</th>
                        <th></i> Type</th>
                        <th> Eval à chaud</th>
                        <th> Eval à froid</th>
                        <th> PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $pj)
                        <tr>
                            <td>
                                <span  style='font-size: 13px;'>{{ $pj->nom_projet }}</span>
                            </td>
                            <td>
                                @if ($pj->type_formation_id == 3)
                                <a style="font-size: 13px" href="{{ route('detail_session_interne', [$pj->groupe_id]) }}"><span class="spanClass"style="font-size: 13px;">{{ $pj->nom_groupe }} &nbsp;&nbsp;<i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i></span></a>
                                @else
                                    <a href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">
                                        <span style="font-size: 13px"  class="spanClass">{{ $pj->nom_groupe }} &nbsp;&nbsp;<i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i></span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="font-size: 13px">{{ $pj->nom_module }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px">{{ $pj->nom_cfp }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px">{{ $pj->modalite }}</span>
                            </td>
                            <td class="text-center">
                                @php
                                    echo "<span style='font-size: 13px;'>".strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin))."</span>";
                                @endphp
                            </td>
                            <td>
                                @if($lieuFormation!=null)
                                    <span style="font-size: 13px;">{{$lieuFormation[0]}}</span>
                                @else
                                    {{"-"}}
                                @endif
                            </td>
                            <td class="text-center">
                                @if($pj->item_status_groupe === 'Cloturé')
                                    <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#111111"">Cloturé</span>
                                @elseif($pj->item_status_groupe === 'Reporté')
                                    <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#af10e9"">Reporté</span>
                                @elseif($pj->item_status_groupe === 'Prévisionnel')
                                    <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#2792e4"">Prévisionnel</span>
                                @elseif($pj->item_status_groupe === 'Annulée')
                                    <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#b33939"">Annulée</span>
                                @elseif($pj->item_status_groupe === 'Reprogrammer')    
                                    <span class="myData badge" style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#00CDAC">Reprogrammer</span>
                                @endif 
                            </td>
                            <td class="text-center">
                                @if ($pj->type_formation_id == 1)
                                    <span style="text-align: center; font-weight: 400; font-size: 13px">
                                        {{ $pj->type_formation }}
                                    </span>
                                @elseif ($pj->type_formation_id == 2)
                                    <span style="text-align: center; font-weight: 400; font-size: 13px">
                                        {{ $pj->type_formation }}
                                    </span>
                                @elseif ($pj->type_formation_id == 3)
                                    <span style="text-align: center; font-weight: 400; font-size: 13px">
                                        {{ $pj->type_formation }}
                                    </span>
                                @endif
                            </td>

                            @if ($pj->type_formation_id == 3)
                                <td class="text-center">
                                    <a href="{{ route('resultat_evaluation_interne', [$pj->groupe_id]) }}" style="font-size: 13px">
                                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                    </a>
                                </td>
                            @else
                                <td class="text-center">
                                    <a href="{{ route('resultat_evaluation', [$pj->groupe_id]) }}" style="font-size: 13px">
                                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                    </a>
                                </td>
                            @endif

                            @if ($pj->type_formation_id == 3)
                                <td class="text-center">
                                    <span> {{ '-' }} </span>
                                </td>
                            @else
                                @php
                                    $reponse = $froidEval->periode_froid_evaluation($pj->groupe_id);
                                @endphp
                                @if($reponse == 1)
                                    <td class="text-center">
                                        <a href="{{ route('evaluation_froid/resultat', [$pj->groupe_id]) }}" style="font-size: 13px">
                                            <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                        </a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        {{ '-' }}
                                    </td>
                                @endif
                            @endif

                            @if ($pj->type_formation_id == 3)
                                <td class="text-center">
                                    <a href="{{ route('fiche_technique_interne_pdf', [$pj->groupe_id]) }}" style="font-size: 13px">
                                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                    </a>
                                </td>
                            @else
                                <td class="text-center">
                                    <a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" style="font-size: 13px">
                                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endcanany

    @canany(['isFormateur'])
    @if (count($data) <= 0)
        <div class="d-flex mt-3 titre_projet p-1 mb-1">
            <span class="text-center">Vous n'avez pas encore du projet.</span>
        </div>
    @else
        <table class="table m-0 p-0 mt-2 table-borderless mahafaly2">
            <thead style="background: #c7c9c939">
                <tr>
                    <th class="myTh">
                        <i class='bx bx-library align-middle'></i> Projet
                    </th>
                    <th class="myTh">
                        <i class="bx bxs-book-open align-middle" style="color: #2e3950"></i> Session
                    </th>
                    <th class="myTh">
                        <i class="bx bxs-customize align-middle" style="color: #2e3950"></i> Module
                    </th>
                    <th class="myTh">
                        <i class='bx bx-building-house align-middle'></i> Entreprise
                    </th>
                    <th class="myTh">
                        <i class='bx bx-calendar-check align-middle' ></i> Modalité
                    </th>
                    <th class="myTh">
                        <i class='bx bx-time-five'></i> <span style="font-size: 13px">Date</span>
                    </th>
                    <th class="myTh">
                        <i class='bx bx-book-content align-middle' style="vertical-align: middle"></i> Type
                    </th>
                    <th class="myTh">
                        <i class='bx bx-calendar-x align-middle' style="color: #2e3950"></i> Statuts
                    </th>
                    <th class="myTh">Emargement</th>
                    <th class="myTh">
                        <i class='bx bxs-file-pdf align-middle' style="vertical-align: middle"></i> PDF
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $pj)
                    <tr class="m-0">
                        <td class="myTh">
                            {{ $pj->nom_projet }}
                        </td>
                        
                        <td>
                            <span class="myData">
                                <a href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">
                                    <span style="font-size: 13px"  class="spanClass">{{ $pj->nom_groupe }}</span>
                                    &nbsp;&nbsp;
                                    <span>
                                        <i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i>
                                    </span>
                                </a>
                            </span>
                        </td>
                        <td class="myTh text-start">
                            {{ $pj->nom_module }}
                            @php
                                '&nbsp;' . $groupe->nombre_apprenant_session($pj->groupe_id);
                            @endphp
                        </td>
                        <td class="myTh text-start">
                            @foreach ($entreprise as $etp)
                                @if ($etp->groupe_id == $pj->groupe_id)
                                    {{ $etp->nom_etp }}
                                @endif
                            @endforeach
                        </td>
                        <td class="myTh">
                            <span style="font-size: 13px">{{ $pj->modalite }}</span>
                        </td>
                        <td class="myTh">
                            @php
                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                            @endphp
                        </td>
                        <td class="myTh">
                            @if ($pj->type_formation_id == 1)
                                <span class="myData">{{ $pj->type_formation }}</span>
                            @elseif ($pj->type_formation_id == 2)
                                <span class="myData">{{ $pj->type_formation }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($pj->item_status_groupe === 'Cloturé')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#111111"">Cloturé</span>
                            @elseif($pj->item_status_groupe === 'Reporté')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#af10e9"">Reporté</span>
                            @elseif($pj->item_status_groupe === 'Prévisionnel')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#2792e4"">Prévisionnel</span>
                            @elseif($pj->item_status_groupe === 'Annulée')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#b33939"">Annulée</span>
                            @elseif($pj->item_status_groupe === 'Reprogrammer')    
                                <span class="myData badge" style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#00CDAC">Reprogrammer</span>
                            @endif 
                        </td>
                        <td class="myTh">
                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle' style="color:
                                @php
                                    echo $groupe->statut_presences($pj->groupe_id);
                                @endphp
                                "></i>&nbsp;Emargement</p>
                            <p class="myTh"><i class='bx bx-check-circle'
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
                            <a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" style="font-size: 13px">
                                <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                            </a>
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
               
</div>
</div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="http://infra.clarin.eu/content/libs/DataTables-1.10.6/extensions/ColVis/js/dataTables.colVis.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script type='text/javascript'>
        $(document).ready(function() {
            var options = {
                html: true,
                title: "Optional: HELLO(Will overide the default-the inline title)",
                content: $('[data-name="popover-content"]')
            }
            var example = document.getElementById('exampleE1')
            var popover = new bootstrap.Popover(example, options)
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.mahafaly2').DataTable({
                "bAutoWidth": false,
                "language": {
                    "paginate": {
                    "previous": "précédent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun résultat trouvé",
                    "infoEmpty":      " 0 trouvés",
                    "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoFiltered":   "(filtre sur _MAX_ entrées)",
                    "lengthMenu":     "Affichage _MENU_ ",
                    "buttonText": "Change colonne"
                }
            });
            var table1 = $('.mahafaly').DataTable({
                // dom:            "Bfrtip",
                "dom": 'C<"clear">lfrtip',
                // scrollY:        "500px",
                scrollX:        true,
                // scrollCollapse: true,
                paging:         true,
                buttons:        [ 'colvis','colonne' ],
                select: true,
                ordering:false,
                "bAutoWidth": false,
                "language": {
                    "paginate": {
                    "previous": "précédent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun résultat trouvé",
                    "infoEmpty":      " 0 trouvés",
                    "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoFiltered":   "(filtre sur _MAX_ entrées)",
                    "lengthMenu":     "Affichage _MENU_ ",
                    "buttonText": "Change colonne"
                },
                "colVis": {
                    "label": function ( index, title, th ) {
                        return (index+1) +'. '+ title;
                    }
                }
            });

            $('input:checkbox').on('change', function () {
                var Projet1 = $('input:checkbox[name="Projet1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(0).search(Projet1, true,false,false).draw();

                var Session1 = $('input:checkbox[name="Session1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(1).search(Session1, true,false,false).draw();

                var Module1 = $('input:checkbox[name="Module1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(2).search(Module1, true,false,false).draw();

                var Cfp1 = $('input:checkbox[name="Cfp1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(3).search(Cfp1, true,false,false).draw();

                var Statut1 = $('input:checkbox[name="Statut1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(7).search(Statut1, true,false,false).draw();

                var Type1 = $('input:checkbox[name="Type1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(8).search(Type1, true,false,false).draw();
                
                
                // select all
                $('.select_all1').on('click', function(){
                    if(this.checked){
                        $('.checkbox').each(function(){
                            this.checked = true;
                        });
                    }else{
                        $('.checkbox').each(function(){
                            this.checked = false;
                        });
                    }
                });

                $('.checkbox').on('click', function(){
                    if(('.checkbox:checked').length == $('.checkboxx').length){
                        $('.select_all1').prop('checked', true);
                    } else{
                        $('.select_all1').prop('checked', false);
                    }
                });
                // end select all
            });

            var table = $('#example').DataTable( {
                // dom:            "Bfrtip",
                "dom": 'C<"clear">lfrtip',
                // scrollY:        "500px",
                scrollX:        true,
                // scrollCollapse: true,
                paging:         true,
                buttons:        [ 'colvis','colonne' ],
                select: true,
                ordering:false,
                "language": {
                    "paginate": {
                    "previous": "précédent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun résultat trouvé",
                    "infoEmpty":      " 0 trouvés",
                    "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoFiltered":   "(filtre sur _MAX_ entrées)",
                    "lengthMenu":     "Affichage _MENU_ ",
                    "buttonText": "Change colonne"
                },
                "colVis": {
                    "label": function ( index, title, th ) {
                        return (index+1) +'. '+ title;
                    }
                }
            } );

            $('.ColVis_Button').text('Afficher / Masquer');

            new $.fn.dataTable.FixedColumns( table, {
                leftColumns: 3,
            } );
            $('.ColVis_Button').text('Afficher / Masquer');

            $('input:checkbox').on('change', function () {
                var Projet2 = $('input:checkbox[name="Projet2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(0).search(Projet2, true,false,false).draw();

                var Session2 = $('input:checkbox[name="Session2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(1).search(Session2, true,false,false).draw();

                
                // var Module2 = $('input:checkbox[name="Module2"]:checked').map(function() {
                //     return this.value;
                // }).get().join('|');
                
                // table.column(2).search(Module2, true,false,false).draw();

                
                var Entreprise2 = $('input:checkbox[name="Entreprise2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(3).search(Entreprise2, true,false,false).draw();

                var Modalite2 = $('input:checkbox[name="Modalite2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(4).search(Modalite2, true,false,false).draw();
                
                var Type2 = $('input:checkbox[name="Type2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(8).search(Type2, true,false,false).draw();

                var Statut2 = $('input:checkbox[name="Statut2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(9).search(Statut2, true,false,false).draw();
                // select all
                $('.select_all2').on('click', function(){
                    if(this.checked){
                        $('.checkbox2').each(function(){
                            this.checked = true;
                        });
                    }else{
                        $('.checkbox2').each(function(){
                            this.checked = false;
                        });
                    }
                });

                $('.checkbox2').on('click', function(){
                    if(('.checkbox2:checked').length == $('.checkbox2').length){
                        $('.select_all2').prop('checked', true);
                    } else{
                        $('.select_all2').prop('checked', false);
                    }
                });
                // end select all
            });

            $('.column_search').on('keyup' ,function () {
                console.log($(this).val());
                table.column( $(this).parent().parent().parent().parent().index() ).search( this.value ).draw();
            } );
        } );
    </script>
@endsection