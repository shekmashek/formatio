@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Liste des équipes administratives</h3>
@endsection
@section('content')
<style>
    .td_hover:hover{
        background: #d0cfcf;
        
    }
</style>
<div class="container-fluid px-5">
    <div class="row">
        <div class="col-lg-12">  
            <table class="mt-4 table  table-borderless table-lg">
                <thead  style="font-size: 12.5px; color: #676767; border-bottom: 0.5px solid rgb(103,103, 103); line-height: 20px">
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>E-mail</th>
                    <th>Téléphone</th>
                    <th>Fonction</th>
                    <th class="text-center">Réferent principale</th>
                </thead>
                <tbody id="data_collaboration" style="font-size: 11.5px;">
                    @foreach($cfp as $responsables_cfp)
                        <tr class="information" data-id="" >
                            @if($responsables_cfp->photos_resp_cfp == NULL or $responsables_cfp->photos_resp_cfp == '' or $responsables_cfp->photos_resp_cfp == 'XXXXXXX')
                                <td role="button" class="randomColor m-auto mt-2" style="width:40px;height:40px; border-radius:100%; color:white; display: grid; place-content: center" onclick="afficherInfos();"><span class=""> {{$responsables_cfp->nom}} {{$responsables_cfp->pr}} </span></td>
                            @else
                                <td class="td_hover" role="button"  onclick="afficherInfos();"><img src="{{asset("images/responsables/".$responsables_cfp->photos_resp_cfp)}}" style="width:45px;height:45px; border-radius:100%"></td>
                            @endif
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->nom_resp_cfp}}</td>
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->prenom_resp_cfp}}</td>
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->email_resp_cfp}}</td>
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->telephone_resp_cfp}}</td>
                            <td class="td_hover" role="button"  onclick="afficherInfos();" style="vertical-align: middle">{{$responsables_cfp->fonction_resp_cfp}}</td>
                            @if($responsables_cfp->prioriter == 1)
                                <td role="button" onclick="afficherInfos();" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i class='bx bxs-star'></i></td>
                            @else
                                <td role="button" onclick="afficherInfos();" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i class='bx bx-star' ></i></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(".randomColor").each(function() {
        //On change la couleur de fond au hasard
            $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16).slice(-6));
        })
</script>
@endsection