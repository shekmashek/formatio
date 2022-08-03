@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Projets</p>
@endsection

@inject('groupe', 'App\groupe')
@inject('carbon', 'Carbon\Carbon')
@inject('froidEval', 'App\FroidEvaluation')

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

@section('content')
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
            @endforeach
        </div>
    @endif
@endsection

@section('script')
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
@endsection