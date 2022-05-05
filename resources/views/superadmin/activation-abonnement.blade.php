@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrapCss/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Activation || Abonnement</title>
</head>
@include('Views.superadmin.index-css')
<body class="bg-light"> --}}
    {{-- <div class="abonnement_header">
        <div class="row" style="color: white;">
            <div class="col-md-4 text-center">FORMATION.MG</div>
            <div class="col-md-4">
                <div class="bar">
                    <p> Pages  </p>
                    <p> Authentification </p>
                        <p>Application  </p>
                        <p>e-commerce  </p>
                </div>
            </div>
            <div class="col-md-4 text-center"><button class="buy_now"> BUY NOW </button></div>
        </div>
    </div> --}}

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card px-3">
                <table class="table table-hover">
                    <thead>
                        <th> Client &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" id="client" value="0"> <i class="fa icon_trie fa-arrow-down" ></i> </button></th>
                        <th>Type d'organisation &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th>Type d'abonnement &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Date d'inscription &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Début &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Fin &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Status &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Activation &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                    </thead>
                    <tbody>
                        @if($liste!=null)
                            @php $i = 0; @endphp
                            @foreach($liste as $listes)
                                    <tr>
                                        <td class="th_color"> {{$nom_entreprise[$i][0]->nom_etp}} </td>
                                        <td class="th_color">Entreprise</td>
                                        <td class="th_color"> {{$listes->nom_type}}</td>
                                        <td class="th_color">  {{$listes->date_demande}} </td>
                                        <td class="th_color"> <span id = "debut_{{$listes->abonnement_id}}" >{{$listes->date_debut}}</span> </td>
                                        <td class="th_color"><span id = "fin_{{$listes->abonnement_id}}" > {{$listes->date_fin}} </span> </td>
                                        @if($listes->status == "En attente")
                                            <td> <label class="label_orange" id = "label_statut_{{$listes->abonnement_id}}" > {{$listes->status}} </label> </td>
                                        @elseif ($listes->status == "Activé")
                                            <td> <label class="label_vert" id = "label_statut_{{$listes->abonnement_id}}"> {{$listes->status}} </label> </td>
                                        @else
                                            <td> <label class="label_rouge" id = "label_statut_{{$listes->abonnement_id}}"> {{$listes->status}} </label> </td>
                                        @endif
                                        <td>
                                            <!-- Default switch -->
                                            <div class="form-check form-switch">
                                                <input class="form-check-input activer" data-id="{{$listes->abonnement_id}}" type="checkbox" role="switch"/>
                                                <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_{{$listes->abonnement_id}}">Activer</label>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $i+=1; @endphp
                            @endforeach
                        @else
                            @php $i = 0; @endphp
                            @foreach ($cfpListe as $listes)
                                <tr>
                                    <td class="th_color"> {{$nom_cfp[$i][0]->nom}} </td>
                                    <td class="th_color">Organisme de formation</td>
                                    <td class="th_color"> {{$listes->nom_type}}</td>
                                    <td class="th_color">  {{$listes->date_demande}} </td>
                                    <td class="th_color"> <span id = "debut_{{$listes->id}}" >{{$listes->date_debut}}</span> </td>
                                    <td class="th_color"><span id = "fin_{{$listes->id}}" > {{$listes->date_fin}} </span> </td>
                                    @if($listes->status == "En attente")
                                        <td> <label class="label_orange" id = "label_statut_{{$listes->id}}" > {{$listes->status}} </label> </td>
                                    @elseif ($listes->status == "Activé")
                                        <td> <label class="label_vert" id = "label_statut_{{$listes->id}}"> {{$listes->status}} </label> </td>
                                    @else
                                        <td> <label class="label_rouge" id = "label_statut_{{$listes->id}}"> {{$listes->status}} </label> </td>
                                    @endif
                                     <td>
                                        <!-- Default switch -->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input activer" data-id="{{$listes->id}}" type="checkbox" role="switch"/>
                                            <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_{{$listes->id}}">Activer</label>
                                        </div>
                                    </td>
                                </tr>
                                @php $i+=1; @endphp
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-md-2"></div>
    </div>

</div>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    Date.prototype.addDays = function(noOfDays){
        var tmpDate = new Date(this.valueOf());
        tmpDate.setDate(tmpDate.getDate() + noOfDays);
        return tmpDate;
    }
    $( ".activer" ).on( "change", function() {
        var statut,idAbonnement;
        if($( this ).prop('checked')){
            statut = "Activé";
            idAbonnement = $(this).data('id');
        }
        else{
            statut = "Désactivé";
            idAbonnement = $(this).data('id');
        }


        $.ajax({
            type: "GET",
            url: "{{route('activer_compte')}}",
            data:{Id:idAbonnement,Statut:statut},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $('#span_statut').text(userData[$i].statut);
                    if (userData[$i].statut == "Activé") {
                        $('#label_statut_'+userData[$i].id).text(userData[$i].status);
                        $('#statut_'+userData[$i].id).text('Désactivé');
                    }
                    else{

                        $('#label_statut_'+userData[$i].id).text(userData[$i].status);

                        $('#statut_'+userData[$i].id).text('Activé');
                    }
                    $('#debut_'+userData[$i].id).text(userData[$i].date_debut);
                    $('#fin_'+userData[$i].id).text(userData[$i].date_fin);


                }
            },
            error:function(error){
                console.log(error)
            }
        });
    });
    $( "#client" ).on( "click", function() {
        //on supprime le contenu du tableau
        $('.table tbody').remove();
        $.ajax({
            type: "GET",
            url: "{{route('tri_client')}}",
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                
            },
            error:function(error){
                console.log(error)
            }
        });
    });
</script>

@endsection