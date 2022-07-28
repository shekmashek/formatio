@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Evaluation à froid</h3>
@endsection
@inject('groupe', 'App\groupe')
@section('content')
    <style>
        #texte {
            font-size: 13px;
        }

        #texte_1 {
            font-size: 13px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .text_11 {
            margin-top: 5px;
        }


        .container_code {
            padding-right: 15px;
            padding-left: 15px;
        }

        .text_center {
            text-align: center;
            margin-top: 4px;
        }

        .row_flex {
            display: flex;
            /* width: fit-content; */
            justify-content: flex-end;
        }

        .table-rating-bar {
            margin-bottom: 25px 0;
        }

        .rating-bar {
            min-width: 285px;
        }

        .table-rating-bar .rating-bar {
            width: 300px;
            padding: 0px;
            border-radius: 5px;
            padding-right: 10px;

        }

        .table-rating-bar .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
            border-radius: 20px;
            cursor: pointer;
        }

        .table-rating-bar .bar-container .bar-5 {
            width: var(--progress_bar);
            height: 8px;
            background-color: rgb(123, 240, 199);
            border-radius: 20px;
        }


        .placement_progress {
            display: grid;
            place-content: center;
            margin-left: 20px;
        }

        .col-lg-4 {
            flex: 0 0 auto;
            width: 33%;
        }

        .marge_top {
            margin-top: 0px;
        }

        .marge_top .row_flex {
            justify-content: space-between;
            border-right: 1px solid rgb(222, 222, 222);
            margin-bottom: 10px;
        }

        #my-pie-chart {
            margin-bottom: 20px
        }

        /* .table-rating-bar td {
            padding-bottom: 10px;
        } */

        /* .downlad_pdf {
            position: sticky;
        } */

        .get_pdf {
            background-color: red;
            color: white;
        }

        .get_pdf:hover {
            background-color: rgb(136, 2, 2);
            color: white;
        }

        .nav-pills .btn.active{
            color: white;
            background: rgb(226, 192, 178);
        }
        .nav-pills .btn{
            background: rgba(237, 237, 237, 0.943);
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-11 downlad_pdf">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item me-2" role="presentation">
                        <button class="btn btn_stagiaire active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Stagiaire(s)</button>
                    </li>
                    @canany(['isReferent','isReferentSimple','isCFP'])
                    <li class="nav-item" role="presentation">
                        <button class="btn btn_manager" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Manager(s)</button>
                    </li>
                    @endcan

                </ul>
            </div>
            <div class="col-1 downlad_pdf">
                <button class="btn get_pdf"><i class='bx bxs-file-pdf'></i>PDF</button>
            </div>
        </div>
    </div>



      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div id="statistique_stagiaire" class="row mb-5">
                    <div class="container_code col-lg-12">
                        <div class="text_center row">
                            <div class="col-11">
                                <span style="text-transform: uppercase">RESULTATS EVALUATIONS À FROID PAR LE(S) STAGIAIRE(S), FORMATION
                                    {{ $session->nom_formation }}&nbsp;
                                    {{-- @php
                                        setlocale(LC_TIME, 'fr_FR');
                                        echo strftime('%e %B %Y', strtotime($session->date_debut));
                                    @endphp --}}
                                </span>
                            </div>
                        </div><br>
                        <div class="">
                            @foreach ($questions as $qst)
                                <div class="marge_top">
                                    <div class="row_flex">
                                        <div class="text_11">
                                            <span>{{ $qst->question }}</span>
                                        </div>
                                    </div>
                                    <div class="row ms-5">
                                        <div class="table-rating-bar justify-content-center" style="margin-bottom: 10px; margin-top: 10px">
                                            @if($qst->desc_champ == 'TEXT')
                                                @foreach ($commentaires as $comm)
                                                    @if($comm->question_id == $qst->question_id)
                                                        <span style="color: rgb(100, 100, 100)">{{ $comm->reponse_text }}</span><br>
                                                    @endif
                                                @endforeach
                                            @else
                                                <table class="text-left mx-auto">
                                                    @foreach ($resultats as $res)
                                                        @if($res->question_id == $qst->question_id)
                                                            <tr>
                                                                <td class="col-lg-8" style="color: rgb(100, 100, 100)">{{ $res->reponse }}</td>
                                                                <td class="rating-bar ms-2 col-lg-2">
                                                                    <div class="bar-container">
                                                                        <div class="bar-5" style="--progress_bar: {{ $res->pourcentage_reponse }}%;"></div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-right col-lg-2"><span class="ms-2" style="color: rgb(100, 100, 100)">{{ $res->nombre_reponse }}</span>&nbsp;<span
                                                                        class="text-muted ms-1">{{ $res->pourcentage_reponse }}%</span>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </table>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div id="statistique_manager" class="row mb-5">
                    <div class="container_code col-lg-12">
                        <div class="text_center row">
                            <div class="col-11">
                                <span style="text-transform: uppercase">RESULTATS EVALUATIONS À FROID PAR LE(S) MANAGER(S), FORMATION
                                    {{ $session->nom_formation }}&nbsp;
                                    {{-- @php
                                        setlocale(LC_TIME, 'fr_FR');
                                        echo strftime('%e %B %Y', strtotime($session->date_debut));
                                    @endphp --}}
                                </span>
                            </div>
                        </div><br>
                        <div class="">
                            @foreach ($questions as $qst)
                                <div class="marge_top">
                                    <div class="row_flex">
                                        <div class="text_11">
                                            <span>{{ $qst->question }}</span>
                                        </div>
                                    </div>
                                    <div class="row ms-5">
                                        <div class="table-rating-bar justify-content-center" style="margin-bottom: 10px; margin-top: 10px">
                                            @if($qst->desc_champ == 'TEXT')
                                                @foreach ($commentaires_manager as $comm)
                                                    @if($comm->question_id == $qst->question_id)
                                                        <span style="color: rgb(100, 100, 100)">{{ $comm->reponse_text }}</span><br>
                                                    @endif
                                                @endforeach
                                            @else
                                                <table class="text-left mx-auto">
                                                    @foreach ($resultats_manager as $res)
                                                        @if($res->question_id == $qst->question_id)
                                                            <tr>
                                                                <td class="col-lg-8" style="color: rgb(100, 100, 100)">{{ $res->reponse }}</td>
                                                                <td class="rating-bar ms-2 col-lg-2">
                                                                    <div class="bar-container">
                                                                        <div class="bar-5" style="--progress_bar: {{ $res->pourcentage_reponse }}%;"></div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-right col-lg-2"><span class="ms-2" style="color: rgb(100, 100, 100)">{{ $res->nombre_reponse }}</span>&nbsp;<span
                                                                        class="text-muted ms-1">{{ $res->pourcentage_reponse }}%</span>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </table>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
      </div>




    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css"
        integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        var pdf_id = 'statistique_stagiaire';
        $(document).on('click','.btn_stagiaire',function(){
            pdf_id = 'statistique_stagiaire';
        });
        $(document).on('click','.btn_manager',function(){
            pdf_id = 'statistique_manager';
        });

        $(document).on('click', '.get_pdf', function() {
            const rapport = document.getElementById(pdf_id);
            var opt = {
                margin: 0.3,
                width: 400,
                filename: 'rapport_evaluation_a_froid.pdf',
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'landscape'
                }
            };
            html2pdf().set(opt).from(rapport).save();
        });
    </script>
@endsection
