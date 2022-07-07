@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Evaluation à chaud</h3>
@endsection
@inject('groupe', 'App\groupe')
@section('content')
      <style>

        #texte{
          font-size: 13px;
        }

        #texte_1{
          font-size: 13px;
          display: flex;
          flex-direction: column;
          justify-content: space-around;
        }

        .text_11{
          margin-top: 5px;
        }

        .circle_1{
          margin-bottom: 25px;

          padding: 0 30px;

        }

        .container_code{
          padding-right: 15px;
          padding-left: 15px;
        }

        .text_center{
          text-align: center;
          margin-top: 4px;
        }

        .row_flex{
          display: flex;
          /* width: fit-content; */
          justify-content: flex-end;
        }
          #my-pie-chart {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }
            #my-pie-chart2 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }

            #my-pie-chart3 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }

            #my-pie-chart4 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }

            #my-pie-chart5 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }

            #my-pie-chart6 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }


            #my-pie-chart7 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }

            #my-pie-chart8 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }

            #my-pie-chart9 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }

            #my-pie-chart10 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }
            #my-pie-chart11 {
            /* --pourcentage: calc((var(--test) / 100 * 100%); */
            border-radius: 50%;
                width: 60px;
                height: 60px;
            }
          #my-pie-chart::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }
          #my-pie-chart2::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }

          #my-pie-chart3::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }

          #my-pie-chart4::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }


          #my-pie-chart5::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }

          #my-pie-chart6::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }


          #my-pie-chart7::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }

          #my-pie-chart8::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }

          #my-pie-chart9::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }

          #my-pie-chart10::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }

          #my-pie-chart11::before{
            content: '';
            background: conic-gradient(rgb(123, 240, 199) 0.00% calc(var(--test)*1%),rgb(156, 252, 160) calc(var(--test)*1%) calc(var(--test2)*1%), rgb(251, 238, 145) calc(var(--test2)*1%) calc(var(--test3)*1%), rgb(255, 188, 126) calc(var(--test3)*1%) calc(var(--test4)*1%), rgb(255, 255, 255) calc(var(--test4)*1%) 100%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 1px solid rgb(195, 194, 194)
          }

    .circle{
        position: relative;
        width: 100px;
        height: 100px;
    }

    .center{
        position: absolute;
        top: 30%;
        left: 23%;
        color: black;
    }

    .table-rating-bar {
        margin-bottom: 25px 0;
    }

    .rating-label {
        min-width: 110px;
    }

    .rating-bar {
        min-width: 285px;
    }
.table-rating-bar .rating-label{
  /* padding-right: 10px; */
  text-align: end

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

.table-rating-bar .bar-container .bar-4 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-3 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-2 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-6 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-7 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-8 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-9 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}



.table-rating-bar .bar-container .bar-10 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-11 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-12 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-13 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}



.table-rating-bar .bar-container .bar-14 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-15 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-16 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-17 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-18 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-19 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-20 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-21 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-22 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-23 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-24 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-25 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-26 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-27 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-28 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-29 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(126, 137, 255);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-30 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(203, 123, 240);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-31 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(252, 156, 156);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-32 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-33 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-34 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-35 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-36 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-37 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-38 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-39 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-40 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-41 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-42 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-43 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-44 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-45 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-46 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(252, 156, 156);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-47 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-48 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-49 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-50 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}




.table-rating-bar .bar-container .bar-51 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(123, 240, 199);
    border-radius: 20px;
}


.table-rating-bar .bar-container .bar-52 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(156, 252, 160);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-53 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(251, 238, 145);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-54 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(255, 188, 126);
    border-radius: 20px;
}

.table-rating-bar .bar-container .bar-55 {
    width: var(--progress_bar);
    height: 8px;
    background-color: rgb(252, 156, 156);
    border-radius: 20px;
}


.placement_progress{
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

#my-pie-chart{
  margin-bottom: 20px
}

/* .table-rating-bar td {
    padding-bottom: 10px;
} */

.downlad_pdf{
    position: fixed;
    float :right;
}
.get_pdf{
    background-color: red;
    color: white;
}
.get_pdf:hover{
    background-color: rgb(136, 2, 2);
    color: white;
}

      </style>
<div class="downlad_pdf">
    <button class="btn get_pdf me-5"><i class='bx bxs-file-pdf'></i>PDF</button>
</div>
<div id="statistique" class="row">
    <div class="container_code col-lg-12">
    {{-- <div class="form-control"> --}}
        <div class="text_center">
        <span style="text-transform: uppercase">RESULTATS EVALUATIONS A CHAUD, FORMATION INTERNE : {{ $session->nom_formation}}&nbsp; @php
            setlocale(LC_TIME, "fr_FR"); echo strftime('%e %B %Y', strtotime($session->date_debut));
        @endphp </span>
        </div><br>
        <div class="row_flex">
        <div class="">
            <span style="color: rgb(100, 100, 100)"><b>Préparation de la formation</b></span>
            <div class="marge_top">

            <div class="row_flex">
                <div class=" text_11">
                <span id="texte">Les objectifs de la formation ont-ils été clairement annoncés ?</span>
                </div>
                <div class=" circle_1">
                <div id="my-pie-chart" class="circle " style="--test: {{ $res_q1[0]->pourcentage }}; --test2: {{ $res_q1[1]->pourcentage + $res_q1[0]->pourcentage}}; --test3: {{ $res_q1[0]->pourcentage + $res_q1[1]->pourcentage + $res_q1[2]->pourcentage}}; --test4: {{ $res_q1[3]->pourcentage + $res_q1[0]->pourcentage + $res_q1[1]->pourcentage + $res_q1[2]->pourcentage}}">
                    <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q1[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
                </div>
            </div>

            <div class="row_flex">
            <div class=" text_11">
                <span id="texte">Avez-vous eu une discussion avec votre hiérarchie concernant  cette formation ?</span>
            </div>
            <div class=" circle_1">
                <div id="my-pie-chart2" class="circle " style="--test: {{ $res_q2[0]->pourcentage }}; --test2: {{ $res_q2[1]->pourcentage + $res_q2[0]->pourcentage}}; --test3: {{ $res_q2[0]->pourcentage + $res_q2[1]->pourcentage + $res_q2[2]->pourcentage}}; --test4: {{ $res_q2[3]->pourcentage + $res_q2[0]->pourcentage + $res_q2[1]->pourcentage + $res_q2[2]->pourcentage}}">
                <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q2[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
            </div>
            </div>

            </div>
        </div>
        <div class="col-lg-4 placement_progress marge_top" id="texte_1">
            <div class="table-rating-bar justify-content-center" style="margin-bottom: 10px; margin-top: 20px">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-label">Totalement</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-5"
                                    style="--progress_bar: {{ $res_q1[0]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q1[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q1[0]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">En partie</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-4"
                                    style="--progress_bar: {{ $res_q1[1]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q1[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q1[1]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Insuffisament</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-3"
                                    style="--progress_bar: {{ $res_q1[2]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q1[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q1[2]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Pas du tout</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-2"
                                    style="--progress_bar: {{ $res_q1[3]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q1[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q1[3]->pourcentage }}%</span>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="table-rating-bar justify-content-center" style=" margin-top: 5px">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-label">Totalement</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-6"
                                    style="--progress_bar: {{ $res_q2[0]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q2[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q2[0]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">En partie</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-7"
                                    style="--progress_bar: {{ $res_q2[1]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q2[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q2[1]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Insuffisament</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-8"
                                    style="--progress_bar: {{ $res_q2[2]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q2[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q2[2]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Pas du tout</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-9"
                                    style="--progress_bar: {{ $res_q2[3]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q2[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q2[3]->pourcentage }}%</span>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="table-rating-bar justify-content-center">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-10"
                                style="--progress_bar: {{ round(($note_10_q1[0]->note+$note_10_q2[0]->note)*10/2,1) }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ round(($note_10_q1[0]->note+$note_10_q2[0]->note)/2,1) }}</span><span class="text-muted">/10</span>
                    </td>
                </tr>
            </table>
            </div>
        </div>
        </div>
        <br>

        {{-- 2 --}}
        <div class="row_flex">
        <div class="">
            <span style="color: rgb(100, 100, 100)"><b>Organisation de la formation</b></span>
            <div class="marge_top">
            <div class="row_flex">
            <div class=" text_11">
                <span id="texte">La durée du stage vous a t-elle semblé adaptée ?</span>
            </div>
            <div class=" circle_1">
                <div id="my-pie-chart3" class="circle " style="--test: {{ $res_q3[0]->pourcentage }}; --test2: {{ $res_q3[1]->pourcentage + $res_q3[0]->pourcentage}}; --test3: {{ $res_q3[0]->pourcentage + $res_q3[1]->pourcentage + $res_q3[2]->pourcentage}}; --test4: {{ $res_q3[3]->pourcentage + $res_q3[0]->pourcentage + $res_q3[1]->pourcentage + $res_q3[2]->pourcentage}}">
                <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q3[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
            </div>
            </div>

            </div>
        </div>
        <div class="col-lg-4 placement_progress marge_top" id="texte_1">
            <div class="table-rating-bar justify-content-center" style="margin-bottom: 10px; margin-top: 20px">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-label">Totalement</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-11"
                                    style="--progress_bar: {{ $res_q3[0]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q3[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q3[0]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">En partie</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-12"
                                    style="--progress_bar: {{ $res_q3[1]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q3[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q3[1]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Insuffisament</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-13"
                                    style="--progress_bar: {{ $res_q3[2]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q3[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q3[2]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Pas du tout</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-14"
                                    style="--progress_bar: {{ $res_q3[3]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q3[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q3[3]->pourcentage }}%</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="table-rating-bar justify-content-center">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-15"
                                style="--progress_bar: {{ $note_10_q3[0]->note * 10 }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $note_10_q3[0]->note}}</span><span class="text-muted">/10</span>
                    </td>
                </tr>
            </table>
            </div>
        </div>
        </div>
            <br>
        {{-- 3 --}}

        <div class="row_flex">
        <div class="">
            <span style="color: rgb(100, 100, 100)"><b>Déroulement de la formation</b></span>
            <div class="marge_top">

            <div class="row_flex">
                <div class=" text_11">
                <span id="texte">Le formateur était-il clair et dynamique ?</span>
                </div>
                <div class=" circle_1">
                <div id="my-pie-chart4" class="circle " style="--test: {{ $res_q4[0]->pourcentage }}; --test2: {{ $res_q4[1]->pourcentage + $res_q4[0]->pourcentage}}; --test3: {{ $res_q4[0]->pourcentage + $res_q4[1]->pourcentage + $res_q4[2]->pourcentage}}; --test4: {{ $res_q4[3]->pourcentage + $res_q4[0]->pourcentage + $res_q4[1]->pourcentage + $res_q4[2]->pourcentage}}">
                    <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q4[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
                </div>
            </div>

            <div class="row_flex">
                <div class=" text_11">
                <span id="texte">Les exercices et activités étaient-ils pertinents ?</span>
                </div>
                <div class=" circle_1">
                <div id="my-pie-chart5" class="circle " style="--test: {{ $res_q5[0]->pourcentage }}; --test2: {{ $res_q5[1]->pourcentage + $res_q5[0]->pourcentage}}; --test3: {{ $res_q5[0]->pourcentage + $res_q5[1]->pourcentage + $res_q5[2]->pourcentage}}; --test4: {{ $res_q5[3]->pourcentage + $res_q5[0]->pourcentage + $res_q5[1]->pourcentage + $res_q5[2]->pourcentage}}">
                    <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q5[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
                </div>
            </div>

            <div class="row_flex">
                <div class=" text_11">
                <span id="texte">Le formateur a t-il adapté la formation aux stagiaires ?</span>
                </div>
                <div class=" circle_1">
                <div id="my-pie-chart6" class="circle " style="--test: {{ $res_q6[0]->pourcentage }}; --test2: {{ $res_q6[1]->pourcentage + $res_q6[0]->pourcentage}}; --test3: {{ $res_q6[0]->pourcentage + $res_q6[1]->pourcentage + $res_q6[2]->pourcentage}}; --test4: {{ $res_q6[3]->pourcentage + $res_q6[0]->pourcentage + $res_q6[1]->pourcentage + $res_q6[2]->pourcentage}}">
                    <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q6[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
                </div>
            </div>

            </div>
        </div>
        <div class="col-lg-4 placement_progress marge_top" id="texte_1">
            <div class="table-rating-bar justify-content-center" style="margin-bottom: 10px; margin-top: 20px">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-label">Totalement</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-16"
                                    style="--progress_bar: {{ $res_q4[0]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q4[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q3[0]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">En partie</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-17"
                                    style="--progress_bar: {{ $res_q4[1]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q4[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q4[1]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Insuffisament</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-18"
                                    style="--progress_bar: {{ $res_q4[2]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q4[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q4[2]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Pas du tout</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-19"
                                    style="--progress_bar: {{ $res_q4[3]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q4[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q4[3]->pourcentage }}%</span>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="table-rating-bar justify-content-center" style=" margin-top: 5px">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-label">Totalement</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-20"
                                    style="--progress_bar: {{ $res_q5[0]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q5[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q5[0]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">En partie</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-21"
                                    style="--progress_bar: {{ $res_q5[1]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q5[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q5[1]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Insuffisament</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-22"
                                    style="--progress_bar: {{ $res_q5[2]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q5[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q5[2]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Pas du tout</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-23"
                                    style="--progress_bar: {{ $res_q5[3]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q5[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q5[3]->pourcentage }}%</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="table-rating-bar justify-content-center" style=" margin-top: 5px">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-label">Totalement</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-24"
                                    style="--progress_bar: {{ $res_q6[0]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q6[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q6[0]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">En partie</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-25"
                                    style="--progress_bar: {{ $res_q6[1]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q6[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q6[1]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Insuffisament</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-26"
                                    style="--progress_bar: {{ $res_q6[2]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q6[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q6[2]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Pas du tout</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-27"
                                    style="--progress_bar: {{ $res_q6[3]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q6[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q6[3]->pourcentage }}%</span>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="table-rating-bar justify-content-center">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-28"
                                style="--progress_bar: {{ round(($note_10_q4[0]->note+$note_10_q5[0]->note+$note_10_q6[0]->note)*10/3,1) }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ round(($note_10_q4[0]->note+$note_10_q5[0]->note+$note_10_q6[0]->note)/3,1) }}</span><span class="text-muted">/10</span>
                    </td>
                </tr>
            </table>
            </div>
        </div>
        </div>
        <br>

    {{-- 4 --}}

    <div class="">
    <span style="color: rgb(100, 100, 100)"><b>Le rythme de la formation était-il ?</b></span>
    </div>
    <div class="col-lg-4">
    <div class="table-rating-bar justify-content-center " style="font-size: 13px; margin-top:8px">
        <table class="text-left mx-auto">
            <tr>
                <td class="rating-label" style="color: rgb(65, 65, 65)">Adapté</td>
                <td class="rating-bar">
                    <div class="bar-container">
                        <div class="bar-29"
                            style="--progress_bar: {{ $res_q7[0]->pourcentage }}%;">
                        </div>
                    </div>
                </td>
                <td class="text-right"><span class="rating-label">{{ $res_q7[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q7[0]->pourcentage }}%</span>
                </td>
            </tr>
        </table>
    </div>
    <div class="table-rating-bar justify-content-center marge_top" style="font-size: 13px;">
        <table class="text-left mx-auto">
            <tr>
                <td class="rating-label" style="color: rgb(65, 65, 65)">Trop rapide</td>
                <td class="rating-bar">
                    <div class="bar-container">
                        <div class="bar-30"
                            style="--progress_bar: {{ $res_q7[1]->pourcentage }}%;">
                        </div>
                    </div>
                </td>
                <td class="text-right"><span class="rating-label">{{ $res_q7[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q7[1]->pourcentage }}%</span>
                </td>
            </tr>
        </table>
    </div>
    <div class="table-rating-bar justify-content-center marge_top" style="font-size: 13px;">
        <table class="text-left mx-auto">
            <tr>
                <td class="rating-label" style="color: rgb(65, 65, 65)">Trop lent</td>
                <td class="rating-bar">
                    <div class="bar-container">
                        <div class="bar-31"
                            style="--progress_bar: {{ $res_q7[2]->pourcentage }}%;">
                        </div>
                    </div>
                </td>
                <td class="text-right"><span class="rating-label">{{ $res_q7[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q7[2]->pourcentage }}%</span>
                </td>
            </tr>
        </table>
    </div>
    </div>
    <br>

    {{-- 5 --}}

    <div class="row_flex">
        <div class="">
        <span style="color: rgb(100, 100, 100)"><b>Contenu de la formation </b></span>
        <div class="marge_top">

            <div class="row_flex">
            <div class=" text_11">
                <span id="texte">Le programme était-il clair et précis ?</span>
            </div>
            <div class=" circle_1">
                <div id="my-pie-chart7" class="circle " style="--test: {{ $res_q8[0]->pourcentage }}; --test2: {{ $res_q8[1]->pourcentage + $res_q8[0]->pourcentage}}; --test3: {{ $res_q8[0]->pourcentage + $res_q8[1]->pourcentage + $res_q8[2]->pourcentage}}; --test4: {{ $res_q8[3]->pourcentage + $res_q8[0]->pourcentage + $res_q8[1]->pourcentage + $res_q8[2]->pourcentage}}">
                <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q8[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
            </div>
            </div>

            <div class="row_flex">
            <div class=" text_11">
                <span id="texte">Le programme était-il adapté à vos besoins ?</span>
            </div>
            <div class=" circle_1">
                <div id="my-pie-chart8" class="circle " style="--test: {{ $res_q9[0]->pourcentage }}; --test2: {{ $res_q9[1]->pourcentage + $res_q9[0]->pourcentage}}; --test3: {{ $res_q9[0]->pourcentage + $res_q9[1]->pourcentage + $res_q9[2]->pourcentage}}; --test4: {{ $res_q9[3]->pourcentage + $res_q9[0]->pourcentage + $res_q9[1]->pourcentage + $res_q9[2]->pourcentage}}">
                <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q9[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
            </div>
            </div>

            <div class="row_flex">
            <div class=" text_11">
                <span id="texte">Les supports de formation étaient-ils clairs et utiles ?</span>
            </div>
            <div class=" circle_1">
                <div id="my-pie-chart9" class="circle " style="--test: {{ $res_q10[0]->pourcentage }}; --test2: {{ $res_q10[1]->pourcentage + $res_q10[0]->pourcentage}}; --test3: {{ $res_q10[0]->pourcentage + $res_q10[1]->pourcentage + $res_q10[2]->pourcentage}}; --test4: {{ $res_q10[3]->pourcentage + $res_q10[0]->pourcentage + $res_q10[1]->pourcentage + $res_q10[2]->pourcentage}}">
                <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q10[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
            </div>
            </div>

        </div>
        </div>
        <div class="col-lg-4 placement_progress marge_top" id="texte_1">
            <div class="table-rating-bar justify-content-center" style="margin-bottom: 10px; margin-top: 20px">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-label">Totalement</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-32"
                                style="--progress_bar: {{ $res_q8[0]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q8[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q8[0]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-33"
                                style="--progress_bar: {{ $res_q8[1]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q8[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q8[1]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-34"
                                style="--progress_bar: {{ $res_q8[2]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q8[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q8[2]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-35"
                                style="--progress_bar: {{ $res_q8[3]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q8[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q8[3]->pourcentage }}%</span>
                    </td>
                </tr>

            </table>
            </div>
            <div class="table-rating-bar justify-content-center" style=" margin-top: 5px">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-label">Totalement</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-36"
                                style="--progress_bar: {{ $res_q9[0]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q9[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q9[0]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-37"
                                style="--progress_bar: {{ $res_q9[1]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q9[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q9[1]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-38"
                                style="--progress_bar: {{ $res_q9[2]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q9[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q9[2]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-39"
                                style="--progress_bar: {{ $res_q9[3]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q9[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q9[0]->pourcentage }}%</span>
                    </td>
                </tr>
            </table>
            </div>
            <div class="table-rating-bar justify-content-center" style=" margin-top: 5px">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-label">Totalement</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-40"
                                style="--progress_bar: {{ $res_q10[0]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q10[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q10[0]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-41"
                                style="--progress_bar: {{ $res_q10[1]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q10[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q10[1]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-42"
                                style="--progress_bar: {{ $res_q10[2]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q10[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q10[2]->pourcentage }}%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-43"
                                style="--progress_bar: {{ $res_q10[3]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q10[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q10[3]->pourcentage }}%</span>
                    </td>
                </tr>
            </table>
            </div>

        </div>
        <div class="col-lg-4">
        <div class="table-rating-bar justify-content-center">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-44"
                                style="--progress_bar: {{ round(($note_10_q8[0]->note+$note_10_q9[0]->note+$note_10_q10[0]->note)*10/3,1) }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ round(($note_10_q8[0]->note+$note_10_q9[0]->note+$note_10_q10[0]->note)/3,1) }}</span><span class="text-muted">/10</span>
                    </td>
                </tr>
            </table>
        </div>
        </div>
    </div>
    <br>
    {{-- 6 --}}
        <div class="row_flex">
            <div class="">
            <span style="color: rgb(100, 100, 100)"><b>Efficacité de la formation</b></span>
            <div class="marge_top">

                <div class="row_flex">
                <div class=" text_11">
                    <span id="texte">Cette formation améliore t-elle vos compétences ?</span>
                </div>
                <div class=" circle_1">
                    <div id="my-pie-chart10" class="circle " style="--test: {{ $res_q11[0]->pourcentage }}; --test2: {{ $res_q11[1]->pourcentage + $res_q11[0]->pourcentage}}; --test3: {{ $res_q11[0]->pourcentage + $res_q11[1]->pourcentage + $res_q11[2]->pourcentage}}; --test4: {{ $res_q11[3]->pourcentage + $res_q11[0]->pourcentage + $res_q11[1]->pourcentage + $res_q11[2]->pourcentage}}">
                    <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q11[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                    </div>
                </div>
                </div>

                <div class="row_flex">
                <div class=" text_11">
                <span id="texte">Ces nouvelles compétences vont-elles être applicables dans votre travail ?</span>
                </div>
                <div class=" circle_1">
                <div id="my-pie-chart11" class="circle " style="--test: {{ $res_q12[0]->pourcentage }}; --test2: {{ $res_q12[1]->pourcentage + $res_q12[0]->pourcentage}}; --test3: {{ $res_q12[0]->pourcentage + $res_q12[1]->pourcentage + $res_q12[2]->pourcentage}}; --test4: {{ $res_q12[3]->pourcentage + $res_q12[0]->pourcentage + $res_q12[1]->pourcentage + $res_q12[2]->pourcentage}}">
                    <span class="center"> <span style="font-size: 12px;"><b> {{ $note_10_q12[0]->note }} </b></span> <span style="font-size: 10px"> / 10 </span></span>
                </div>
                </div>
            </div>

            </div>
            </div>
            <div class="col-lg-4 placement_progress marge_top" id="texte_1">
                <div class="table-rating-bar justify-content-center" style="margin-bottom: 10px; margin-top: 20px">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-label">Totalement</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-47"
                                    style="--progress_bar: {{ $res_q11[0]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q11[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q11[0]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">En partie</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-48"
                                    style="--progress_bar: {{ $res_q11[1]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q11[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q11[1]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Insuffisament</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-49"
                                    style="--progress_bar: {{ $res_q11[2]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q11[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q11[2]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Pas du tout</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-50"
                                    style="--progress_bar: {{ $res_q11[3]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q11[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q11[3]->pourcentage }}%</span>
                        </td>
                    </tr>

                </table>
                </div>
                <div class="table-rating-bar justify-content-center" style=" margin-top: 5px">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-label">Totalement</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-51"
                                    style="--progress_bar: {{ $res_q12[0]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q12[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q12[0]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">En partie</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-52"
                                    style="--progress_bar: {{ $res_q12[1]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q12[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q12[1]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Insuffisament</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-53"
                                    style="--progress_bar: {{ $res_q12[2]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q12[2]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q12[2]->pourcentage }}%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="rating-label">Pas du tout</td>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-54"
                                    style="--progress_bar: {{ $res_q12[3]->pourcentage }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ $res_q12[3]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q12[3]->pourcentage }}%</span>
                        </td>
                    </tr>
                </table>
                </div>

            </div>
            <div class="col-lg-4">
            <div class="table-rating-bar justify-content-center">
                <table class="text-left mx-auto">
                    <tr>
                        <td class="rating-bar">
                            <div class="bar-container">
                                <div class="bar-55"
                                    style="--progress_bar: {{ round(($note_10_q11[0]->note+$note_10_q12[0]->note)*10/2,1) }}%;">
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="rating-label">{{ round(($note_10_q11[0]->note+$note_10_q12[0]->note)/2,1) }}</span><span class="text-muted">/10</span>
                        </td>
                    </tr>
                </table>
            </div>
            </div>
        </div>
    {{-- end 6 --}}
    {{-- 7 RESULTAT EVALUATION A CHAUD, FORMATIONJ SST 30 SEPTEMBRE 2019 --}}

    {{-- </div> --}}

    </div>
    <div class="container_code col-lg-12">
        <div class="text_center">
            {{-- <span>RESULTAT EVALUATION A CHAUD, FORMATIONJ SST 30 SEPTEMBRE 2019</span> --}}
        </div>
        <div class="marge_top">
            <span style="color: rgb(100, 100, 100)"><b>Recommanderiez-vous cette formation ?</b></span>
        </div>
        <div class="col-lg-4">
            <div class="table-rating-bar justify-content-center" style="font-size: 13px; margin-top:7px">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-label" style="color: rgb(65, 65, 65)">OUI</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-45"
                                style="--progress_bar: {{ $res_q13[0]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q13[0]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q13[0]->pourcentage }}%</span>
                    </td>
                </tr>
            </table>
            </div>
            <div class="table-rating-bar justify-content-center marge_top" style="font-size: 13px;">
            <table class="text-left mx-auto">
                <tr>
                    <td class="rating-label" style="color: rgb(65, 65, 65)">NON</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-46"
                                style="--progress_bar: {{ $res_q13[1]->pourcentage }}%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">{{ $res_q13[1]->nombre_stg }}</span>&nbsp;<span class="text-muted">{{ $res_q13[1]->pourcentage }}%</span>
                    </td>
                </tr>
            </table>
            </div>
        </div>
        <div style="margin-top: 9px">
            <span style="color: rgb(100, 100, 100)"><b>Quels sont les points forts de cette formation ?</b></span>
        </div>
            @foreach ($res_q14 as $res)
                <div style="border:1px solid black; border-color:rgb(196, 195, 255); margin-top:8px">
                    <div style="margin-top: 6px; margin-left:8px;font-size:13px">{{ $res->stagiaire }}</div>
                    <div style="margin-top: 5px; margin-left:5px;font-size:15px">{{ $res->reponse_desc_champ }}</div>
                </div>
            @endforeach
        <br>
        <div style="margin-top: 9px">
            <span style="color: rgb(100, 100, 100)"><b>Quels sont les points faibles de cette formation ?</b></span>
        </div>
        @foreach ($res_q15 as $res)
                <div style="border:1px solid black; border-color:rgb(196, 195, 255); margin-top:8px">
                    <div style="margin-top: 6px; margin-left:8px;font-size:13px">{{ $res->stagiaire }}</div>
                    <div style="margin-top: 5px; margin-left:5px;font-size:15px">{{ $res->reponse_desc_champ }}</div>
                </div>
            @endforeach
    </div>
</div>

<div id="elementH"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    $(document).on('click','.get_pdf',function(){
        const rapport = document.getElementById('statistique');
        var opt = {
            margin: 0.3,
            width : 400,
            filename:'rapport_evaluation_a_chaud.pdf',
            pagebreak : { mode: ['avoid-all','css', 'legacy']},
            image:        { type: 'jpeg', quality: 0.98 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
        };
            html2pdf().set(opt).from(rapport).save();
    });

</script>
@endsection