@extends('./layouts/admin')
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<i class="far fa-caret-circle-down" data-toggle="collapse" href="#corps" role="button" aria-expanded="false"></i> <a href="#corps" role="button" aria-expanded="false" data-toggle="collapse"> Janvier 2022</a> <br><hr>
<div class="container-fluid px-3 collapse" id="corps">
    <div class="d-flex">
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Projets</b>&nbsp; &nbsp;<i class="fa fa-plus-hexagon clignote" style="font-size: 20px;"></i> </p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Logo</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Date</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Statut</b></p>   
        </div>
        {{-- <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Progression</b></p>
        </div> --}}
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Evaluation</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Session</b></p>
        </div>
    </div>

    @foreach ($data as $projet)
        <div class="bg-projet my-2">
            <div class="d-flex">
                <div class="enfant_flex_1">
                    <p class="text-center my-4"><b>{{ $projet->nom_projet }}</b></p>
                </div>
                <div class="enfant_flex_1">
                    <p class="text-center my-4">
                        <img src="{{ asset('img/images/'.$projet->logo_cfp) }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                    </p>
                </div>
                <div class="enfant_flex_1">
                    <p class="text-center my-4">
                        {{ date($projet->date_projet) }}
                    </p>
                </div>
                <div class="enfant_flex_1">
                    <p class="statut_en_cours text-center mx-5 my-4">{{ $projet->status }}</p>  
                </div>
                {{-- <div class="enfant_flex_1">
                    
                        <div class="progress my-4">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     
                </div>--}}
                <div class="enfant_flex_1">
                    <p class="text-center my-4">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </p>
                </div>
                <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
            </div>
        

            <div class="collapse" id="collapseExample">
                <div class="collapse_projet">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th class="text-center">Session</th>
                            <th class="text-center">Lieu</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Participants</th>
                            <th class="text-center">Status</th>
                        </thead>
                        <tbody>
                            @foreach ($infos as $info)
                                <tr>
                                    <td class="text-center">{{ $info->nom_groupe }}</td>
                                    <td class="text-center">{{ $info->lieu }}</td>
                                    <td class="text-center">{{ $info->date_debut }}/{{ $info->date_fin }}</td>
                                    <td width="40%" class="px-3">
                                        <center>
                                        @foreach ($stagiaires as $stg)
                                            @if ($info->groupe_id == $stg->groupe_id)
                                                <img class="image_session" src="{{ asset('images/stagiaires/'.$stg->photos) }}" alt="">
                                            @endif  
                                        @endforeach
                                        </center>
                                    </td>
                                    <td><p class="statut_en_cours text-center mx-5 my-4 px-2">{{ $info->status_groupe }}</p></td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table><br>
                </div>
            </div>
        </div>
    @endforeach
    <div class="ajouter_projet clignote">
        <i class="fa fa-folder-plus ms-5 " style="font-size: 20px; color:blue;"></i>&nbsp; Ajouter un nouveau projet
    </div>
    

</div>
<br>







<i class="far fa-caret-circle-down" data-toggle="collapse" href="#corps_2" role="button" aria-expanded="true"></i> Fevrier 2022 <br><hr>
<div class="container-fluid px-3 collapse" id="corps_2">
    <div class="d-flex">
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Projets</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Logo</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Date</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Statut</b></p>   
        </div>
        {{-- <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Progression</b></p>
        </div> --}}
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Evaluation</b></p>
        </div>
        <div class="enfant_flex">
            <p class="text-center my-2 text-white"><b>Session</b></p>
        </div>
    </div>


    <div class="bg-projet my-2">
        <div class="d-flex">
            <div class="enfant_flex_1">
                <p class="text-center my-4"><b>Projets 1</b></p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <img src="{{ asset('img/images/ok.png') }}" alt="" width="50px" height="50px" class="img-fluid image_logo_projet">
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <?php  echo date('l, j F Y '); ?>
                </p>
            </div>
            <div class="enfant_flex_1">
                <p class="statut_en_cours text-center mx-5 my-4">En cours</p>  
            </div>
            {{-- <div class="enfant_flex_1">
                
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                
            </div> --}}
            <div class="enfant_flex_1">
                <p class="text-center my-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </div>
            <div class="enfant_flex_1 my-4"> <center><i class="far fa-caret-circle-down" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"></i></center> </div>
        </div>
    

        <div class="collapse" id="collapseExample">
            <div class="collapse_projet">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>

    

</div>

<style>
    .enfant_flex{
        width: 100%;
        margin: 0 5px;
        background-color: rgb(211, 188, 188);
        border-radius: 2rem;
    }
    .enfant_flex_1{
        width: 100%;
        margin: 0 5px;
    }
    .statut_en_cours{
        background-color: rgb(143, 217, 240);
        color: blue;
        padding: 4px auto;
        border-radius: 4px;
    }
    .statut_termine{
        background-color: rgb(190, 236, 186);
        color: green;
        padding: 4px auto;
        border-radius: 4px;
    }
    .ajouter_projet{
        border: solid 1px grey;
        border-radius: 8px;
        padding: 10px auto;
    }
    .checked {
  color: orangered;
}
.image_logo_projet{
    border-radius: 50%;
}
.bg-projet{
    background-color: rgb(213, 213, 214);
}
.collapse_projet{
    background-color: #fff;
    margin:  2px 6px;
    border-radius: 8px;
}
.image_session{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-left: -20px;
}
.clignote {
  color:grey;
  animation: clignote 2s linear infinite;
}
@keyframes clignote {  
  50% { opacity: 0; }
}
</style>
<script>
    $(document).ready(function() {
  $('#rateMe3').mdbRate();
});
</script>
@endsection