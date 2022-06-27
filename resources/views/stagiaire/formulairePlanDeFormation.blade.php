@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h1{
        font-weight: 400;
    }
</style>
<div id="page-wrapper">
    <div class="container shadow-sm mt-5 p-4">
        <div class="row">
            <h1>Reccueil besoin de formation</h1>
        </div>
        <div class="row mt-3 p-3">
            <table class="table text-center">
                <thead>
                    @foreach ($plan as $p)
                    <tr style="background: rgb(250, 248, 248)">
                        <td class="p"  colspan="1"><span style="padding-top: 30px">Années :{{$p->AnneePlan}}</span>  &nbsp;  Debut du recueil : {{ \Carbon\Carbon::parse($p->debut_rec)->format('d/m/Y')}} &nbsp; fin du recueil : {{ \Carbon\Carbon::parse($p->fin_rec)->format('d/m/Y')}} <a href="{{route('plan.demande',$p->id)}} " class="btn btn-info text-light" style="float: right">Demander un formation</a></th>
                        <th class="" colspan="0">
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample_{{$p->AnneePlan}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i style="color:white" class="fa-solid fa-arrow-down-long"></i>
                            </a>
                        </th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>
                               
                                    <div class="collapse" id="collapseExample_{{$p->AnneePlan}}">
                                        <div class="card card-body" style="width: 100%">
                                            <p>Vos demandes:</p>
                                            <table class="table table-hover">
                                                <thead>
                                                    
                                                    <th>Domaine de formation</th>
                                                    <th>Thematique</th>
                                                    <th>Date</th>
                                                    <th>Organisme sugére</th>
                                                    <th>Statut</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($besoin as $be)
                                                        @if ($be->anneePlan_id === $p->id)
                                                        <tr>
                                                            <td>{{$be->domaine->nom_domaine}}</td>
                                                            <td>{{$be->formation->nom_formation}}</td>
                                                            <td>@php echo(date('m-Y',strtotime($be->date_previsionnelle))) @endphp</td>
                                                            <td>{{$be->organisme}}</td>
                                                            <td><span class="badge bg-warning">En attente</span></td>
                                                            <td>
                                                                <a href="" class="btn btn-info text-light"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                <a href="" class="btn btn-danger text-light"><i class="fa-solid fa-trash-can"></i></a>
                                                            </td>
                                                        </tr>
                                                        @endif  
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    {{-- <tr style="background: rgb(250, 248, 248)">
                        <th >2021</th>
                        <th><span class="badge  " style="background: rgb(61, 158, 50)">Términer</span></th>
                        <th></th>
                        <th style="float: right"><i class="fa-solid fa-angle-down"></i></th>
                    </tr>
                    <tr style="background: rgb(250, 248, 248)">
                        <th >2020</th>
                        <th><span class="badge  " style="background: rgb(61, 158, 50)">Términer</span></th>
                        <th></th>
                        <th style="float: right"><i class="fa-solid fa-angle-down"></i></th>
                    </tr> --}}
                </thead>
                
            </table>
        </div>
    </div>
</div>
<script>
    
    $("#acf-domaine").change(function() {
        var id = $(this).val();
        $(".categ").empty();
        // $(".categ").append(
        //     '<option value="null" disable selected hidden>Choisissez la catégorie de formation ...</option>'
        // );

        $.ajax({
            url: "/get_formation",
            type: "get",
            data: {
                id: id,
            },
            success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("domaine_id_err").innerHTML = "";
                    for (var $i = 0; $i < userData.length; $i++) {
                        $(".categ").append(
                            '<option value="' +
                                userData[$i].id +
                                '" data-value="' +
                                userData[$i].nom_formation +
                                '" >' +
                                userData[$i].nom_formation +
                                "</option>"
                            'input name="nom_formation" type="hidden" value="'+userData[$i].nom_formation +
                                '" data-value="' +
                                userData[$i].nom_formation +
                                '" >' +
                                userData[$i].nom_formation +
                            "</input>"
                        );
                    }
                } else {
                    document.getElementById("domaine_id_err").innerHTML =
                        "choisir le type de domaine valide pour avoir ses formations";
                }
            },
            error: function(error) {
                console.log(error);
            },
        });
    });
</script>
@endsection
