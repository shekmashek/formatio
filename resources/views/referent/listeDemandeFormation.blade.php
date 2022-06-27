@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Plan de formation </p>
@endsection
@section('content')
<style>
    h4,label,p{
        font-weight: 400;
        color: gray;
    }
    .disabled > a {
    color: currentColor;
    display: inline-block;  /* For IE11/ MS Edge bug */
    pointer-events: none;
    text-decoration: none;
    }
    .disabled {
    cursor: not-allowed;
    opacity: 0.5;
    }
    input[type="text"]:disabled {
    background: rgb(245, 242, 242);
    }
</style>
<div id="page-wrapper">
    <div class="container mt-5 p-4" >
       <div class="row">
           <div class="col-md-12 ">
               <div class="float-start">
                    <h4>Plan de formation </h4>
               </div>
               <div class="float-end">
                    <button class="btn btn-info text-light text-sm" class="btn btn-primary" > <a href="{{route('ajout.plan',$entreprise_id)}}">Crée un nouveaux plan</a> </button>
               </div>
           </div>
       </div>
       <div class="row mt-4">
           <div class="col-md-12">
                @foreach ($plan as $p)
                    <table class="table " >
                        <thead>
                            <tr style="background: rgb(245, 242, 242);" >
                                <th style="border: none">{{$p->AnneePlan}}</th>
                                <th style="float: right;border:none">
                                    <a data-bs-toggle="collapse" href="#collapseExample_{{$p->AnneePlan}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr> 
                            <td>
                                <div  id="collapseExample_{{$p->AnneePlan}}">
                                    <div class="row">
                                        <div class="col-md-6 p-4">
                                            <h5>Plan Previsionnel</h5>
                                            <form action="{{route('plan.modifier',$p->id)}}" method="post">
                                                @csrf
                                                
                                                <div class="form-group">
                                                    <div class="input-groupe">
                                                        <label for="">Demande de recueil:</label>
                                                        <input type="date" value="{{$p->debut_rec}}" name="debut" class="form-control" id="inp" >
                                                    </div>
                                                    <div class="input-groupe">
                                                        <label for="">Fin de recueil:</label>
                                                        <input type="date" placeholder="test" value="{{ $p->fin_rec}}" name="fin" id="inp2" class="form-control" >
                                                    </div>
                                                    <div class="input-groupe">
                                                    <label for="">Salarie:</label>
                                                    <input type="text" class="form-control" value="{{$nombr}}" disabled>
                                                    <button type="submit" class="btn btn-info text-light mt-1" style="margin-left: 503px" >Editer</button>
                                                </div>
                                            </form>  
                                            <div style="display: flex"> 
                                            <button class="btn btn-info mt-3 text-light">Email de collecte</button>&nbsp;
                                            <p class="mt-4" style="font-weight: 400;font-size:12px;"> Envoie à tout les salarié une email pour reccueillir leur formation</p>
                                            </div>
                                            <div style="display: flex"> 
                                            <button class="btn btn-warning mt-2 text-light">Email de rappele</button>&nbsp;
                                            <p class="mt-3" style="font-weight: 400;font-size:12px;"> rappele par email pour reccueillir leur formation</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-4 ">
                                        <h5>Reccueil de besoins</h5>
                                        <div class="row ">
                                            <div class="col">
                                                <div class="float-start">
                                                    <p>Nombre de Salarie ayant exprimer</p>
                                                </div>
                                                <div class="float-end">
                                                    <p><input type="hidden" value="0" id="teste"> <span id="test">0</span>/{{$nombr}}</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row p-2" style="margin-top: -20px">
                                            <div class="progress ">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                                <div>
                                                    <span  class="te "><a href="{{route('liste.demande',$p->id)}}" class="btn btn-info mt-2 text-light" ><i class="fa-solid fa-eye"></i>&nbsp; Voir liste</a> </span>
                                                    <span class="te "> <a href="" class="btn btn-primary mt-2 text-light"> <i class="fa-solid fa-file-pdf" ></i>&nbsp; Export liste</a> </span>

                                            </div>
                                        </div>
                                        <div class="row " >
                                            <div class="col mt-3">
                                                <div class="float-start">
                                                    <p>Nombre valide par le N+</p>
                                                </div>
                                                <div class="float-end">
                                                    <p>0/{{$nombr}}</p>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="row p-2" style="margin-top: -20px">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                                            </div>
                                            <div>
                                                <a href="{{route('liste.demandeV')}}" class="btn btn-warning mt-2 text-light"><i class="fa-solid fa-eye"></i>&nbsp;Voir liste</a>
                                                <a href="" class="btn btn-primary mt-2 text-light"><i class="fa-solid fa-file-pdf"></i>&nbsp; Export liste</a>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                </div>
                                </div>
                            </td>
                            </tr>
                        </tbody>
                    </table>  
                @endforeach 
           </div>
       </div>
       
      
</div>
<script>
    var a = document.getElementById('teste').value;
    var b = document.getElementById('test').innerHTML = a;
    // var c = document.querySelector('.te');
    // if (a == 0){
       
    //     c.classList.add ('disabled');
    // }
    // else{
    //     c.classList.remove("disabled");
    // }
    //  function msokatra(){
    //     document.getElementById("inp").disabled = false;
    //     document.getElementById("inp2").disabled = false;
    //  }
</script>
@endsection
