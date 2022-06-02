@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Style 'vonjy'</h3>
@endsection
@inject('groupe', 'App\groupe')
@section('content')
      <style>

        #texte{
          font-size: 13px;
        }

        #texte_1{
          font-size: 13px;
        }

        .text_11{
          margin-top: 5px;
        }

        .circle_1{
          margin-bottom: 20px;
          border-right: 1px solid rgb(203, 203, 203);
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
          width: fit-content;
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

.table-rating-bar .rating-label{
  padding-right: 10px;
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
  margin-top: 5px;
}

#my-pie-chart{
  margin-bottom: 20px
}

/* .table-rating-bar td {
    padding-bottom: 10px;
} */

      </style>

<div class="container_code">
  {{-- <div class="form-control"> --}}
    <div class="text_center">
      <span>RESULTATS EVALUATIONS A CHAUD, FORMATION DYNAMIQUE ETO (jours mois années)</span>
    </div>
    <div class="row_flex">
      <div class="">
        <span style="color: rgb(100, 100, 100)"><b>Préparation de la formation</b></span>
        <div class="marge_top">
          
          <div class="row_flex">
            <div class=" text_11">
              <span id="texte">Les objectifs de la formation ont-ils été clairement annoncés ?</span>
            </div>
            <div class=" circle_1">
              <div id="my-pie-chart" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
                <span class="center"> <span style="font-size: 12px;"><b> 5,5 </b></span> <span style="font-size: 10px"> / 10 </span></span>
              </div>
            </div>
          </div>

          <div class="row_flex">
          <div class=" text_11">
            <span id="texte">Avez-vous eu une discussion avec votre hiérarchie concernant  cette formation ?</span>
          </div>
          <div class=" circle_1">
            <div id="my-pie-chart2" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
              <span class="center"> <span style="font-size: 12px;"><b> 3 </b></span> <span style="font-size: 10px"> / 10 </span></span>
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
                                style="--progress_bar: 45%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">45%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-4"
                                style="--progress_bar: 60%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">5</span>&nbsp;<span class="text-muted">60%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-3"
                                style="--progress_bar: 50%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">2</span>&nbsp;<span class="text-muted">50%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-2"
                                style="--progress_bar: 75%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">9</span>&nbsp;<span class="text-muted">75%</span>
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
                            <div class="bar-5"
                                style="--progress_bar: 45%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">45%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-4"
                                style="--progress_bar: 60%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">5</span>&nbsp;<span class="text-muted">60%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-3"
                                style="--progress_bar: 50%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">2</span>&nbsp;<span class="text-muted">50%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-2"
                                style="--progress_bar: 75%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">9</span>&nbsp;<span class="text-muted">75%</span>
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
                          <div class="bar-5"
                              style="--progress_bar: 65%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">7</span>&nbsp;<span class="text-muted">80%</span>
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
            <div id="my-pie-chart3" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
              <span class="center"> <span style="font-size: 12px;"><b> 10 </b></span> <span style="font-size: 10px"> / 10 </span></span>
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
                                style="--progress_bar: 100%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">100%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-4"
                                style="--progress_bar: 0%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">0</span>&nbsp;<span class="text-muted">0%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-3"
                                style="--progress_bar: 0%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">0</span>&nbsp;<span class="text-muted">0%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-2"
                                style="--progress_bar: 0%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">0</span>&nbsp;<span class="text-muted">0%</span>
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
                          <div class="bar-5"
                              style="--progress_bar: 100%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">10</span>&nbsp;<span class="text-muted">100%</span>
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
              <div id="my-pie-chart" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
                <span class="center"> <span style="font-size: 12px;"><b> 5,5 </b></span> <span style="font-size: 10px"> / 10 </span></span>
              </div>
            </div>
          </div>

          <div class="row_flex">
            <div class=" text_11">
              <span id="texte">Les exercices et activités étaient-ils pertinents ?</span>
            </div>
            <div class=" circle_1">
              <div id="my-pie-chart2" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
                <span class="center"> <span style="font-size: 12px;"><b> 3 </b></span> <span style="font-size: 10px"> / 10 </span></span>
              </div>
            </div>
          </div>

          <div class="row_flex">
            <div class=" text_11">
              <span id="texte">Le formateur a t-il adapté la formation aux stagiaires ?</span>
            </div>
            <div class=" circle_1">
              <div id="my-pie-chart2" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
                <span class="center"> <span style="font-size: 12px;"><b> 3 </b></span> <span style="font-size: 10px"> / 10 </span></span>
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
                                style="--progress_bar: 45%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">45%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-4"
                                style="--progress_bar: 60%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">5</span>&nbsp;<span class="text-muted">60%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-3"
                                style="--progress_bar: 50%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">2</span>&nbsp;<span class="text-muted">50%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-2"
                                style="--progress_bar: 75%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">9</span>&nbsp;<span class="text-muted">75%</span>
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
                            <div class="bar-5"
                                style="--progress_bar: 45%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">45%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-4"
                                style="--progress_bar: 60%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">5</span>&nbsp;<span class="text-muted">60%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-3"
                                style="--progress_bar: 50%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">2</span>&nbsp;<span class="text-muted">50%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-2"
                                style="--progress_bar: 75%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">9</span>&nbsp;<span class="text-muted">75%</span>
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
                            <div class="bar-5"
                                style="--progress_bar: 45%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">45%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">En partie</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-4"
                                style="--progress_bar: 60%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">5</span>&nbsp;<span class="text-muted">60%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Insuffisament</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-3"
                                style="--progress_bar: 50%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">2</span>&nbsp;<span class="text-muted">50%</span>
                    </td>
                </tr>
                <tr>
                    <td class="rating-label">Pas du tout</td>
                    <td class="rating-bar">
                        <div class="bar-container">
                            <div class="bar-2"
                                style="--progress_bar: 75%;">
                            </div>
                        </div>
                    </td>
                    <td class="text-right"><span class="rating-label">9</span>&nbsp;<span class="text-muted">75%</span>
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
                          <div class="bar-5"
                              style="--progress_bar: 65%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">7</span>&nbsp;<span class="text-muted">80%</span>
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
  <div class="table-rating-bar justify-content-center marge_top" style="font-size: 13px;">
    <table class="text-left mx-auto">
        <tr>
            <td class="rating-label" style="color: rgb(65, 65, 65)">Adapté</td>
            <td class="rating-bar">
                <div class="bar-container">
                    <div class="bar-5"
                        style="--progress_bar: 100%;">
                    </div>
                </div>
            </td>
            <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">100%</span>
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
                    <div class="bar-5"
                        style="--progress_bar: 0%;">
                    </div>
                </div>
            </td>
            <td class="text-right"><span class="rating-label">0</span>&nbsp;<span class="text-muted">0%</span>
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
                    <div class="bar-5"
                        style="--progress_bar: 0%;">
                    </div>
                </div>
            </td>
            <td class="text-right"><span class="rating-label">0</span>&nbsp;<span class="text-muted">0%</span>
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
            <div id="my-pie-chart" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
              <span class="center"> <span style="font-size: 12px;"><b> 5,5 </b></span> <span style="font-size: 10px"> / 10 </span></span>
            </div>
          </div>
        </div>

        <div class="row_flex">
          <div class=" text_11">
            <span id="texte">Le programme était-il adapté à vos besoins ?</span>
          </div>
          <div class=" circle_1">
            <div id="my-pie-chart2" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
              <span class="center"> <span style="font-size: 12px;"><b> 3 </b></span> <span style="font-size: 10px"> / 10 </span></span>
            </div>
          </div>
        </div>

        <div class="row_flex">
          <div class=" text_11">
            <span id="texte">Les supports de formation étaient-ils clairs et utiles ?</span>
          </div>
          <div class=" circle_1">
            <div id="my-pie-chart2" class="circle " style="--test: 10; --test2: 65; --test3: 70; --test4: 85">
              <span class="center"> <span style="font-size: 12px;"><b> 3 </b></span> <span style="font-size: 10px"> / 10 </span></span>
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
                              style="--progress_bar: 45%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">45%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">En partie</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-4"
                              style="--progress_bar: 60%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">5</span>&nbsp;<span class="text-muted">60%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">Insuffisament</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-3"
                              style="--progress_bar: 50%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">2</span>&nbsp;<span class="text-muted">50%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">Pas du tout</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-2"
                              style="--progress_bar: 75%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">9</span>&nbsp;<span class="text-muted">75%</span>
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
                          <div class="bar-5"
                              style="--progress_bar: 45%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">45%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">En partie</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-4"
                              style="--progress_bar: 60%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">5</span>&nbsp;<span class="text-muted">60%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">Insuffisament</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-3"
                              style="--progress_bar: 50%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">2</span>&nbsp;<span class="text-muted">50%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">Pas du tout</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-2"
                              style="--progress_bar: 75%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">9</span>&nbsp;<span class="text-muted">75%</span>
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
                          <div class="bar-5"
                              style="--progress_bar: 45%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">45%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">En partie</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-4"
                              style="--progress_bar: 60%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">5</span>&nbsp;<span class="text-muted">60%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">Insuffisament</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-3"
                              style="--progress_bar: 50%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">2</span>&nbsp;<span class="text-muted">50%</span>
                  </td>
              </tr>
              <tr>
                  <td class="rating-label">Pas du tout</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-2"
                              style="--progress_bar: 75%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">9</span>&nbsp;<span class="text-muted">75%</span>
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
                        <div class="bar-5"
                            style="--progress_bar: 65%;">
                        </div>
                    </div>
                </td>
                <td class="text-right"><span class="rating-label">7</span>&nbsp;<span class="text-muted">80%</span>
                </td>
            </tr>
        </table>
      </div>
    </div>
  </div>
<br>

{{-- 6 RESULTAT EVALUATION A CHAUD, FORMATIONJ SST 30 SEPTEMBRE 2019 --}}



  {{-- </div> --}}
</div>
<div class="container_code">
    <div class="text_center">
        <span>RESULTAT EVALUATION A CHAUD, FORMATIONJ SST 30 SEPTEMBRE 2019</span>
    </div>
    <div class="">
        <span style="color: rgb(100, 100, 100)"><b>Recommanderiez-vous cette formation ?</b></span>
    </div>
      <div class="col-lg-4">
        <div class="table-rating-bar justify-content-center marge_top" style="font-size: 13px;">
          <table class="text-left mx-auto">
              <tr>
                  <td class="rating-label" style="color: rgb(65, 65, 65)">OUI</td>
                  <td class="rating-bar">
                      <div class="bar-container">
                          <div class="bar-5"
                              style="--progress_bar: 100%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">4</span>&nbsp;<span class="text-muted">100%</span>
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
                          <div class="bar-5"
                              style="--progress_bar: 0%;">
                          </div>
                      </div>
                  </td>
                  <td class="text-right"><span class="rating-label">0</span>&nbsp;<span class="text-muted">0%</span>
                  </td>
              </tr>
          </table>
        </div>
      </div>
      <div class="">
        <span style="color: rgb(100, 100, 100)"><b>Quels sont les points forts de cette formation ?</b></span>
      </div>
      
      <br>
</div>


@endsection