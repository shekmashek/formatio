@inject('groupe', 'App\groupe')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    h2{
        font-weight: 300;
    }
    table,tr,th,td{
        border-collapse: collapse;
        border: 1px solid black;
        padding: 4px ;
        font-size: 18px;
    }
    td{
        font-size: 15px;

    }
    th{
        font-size: 16px;
    }
</style>
<body>
    @foreach ($plan as $pl)
    <div class="container" style="display: flex;">
        <h1 style="margin-left:-17px; ">Plan Previsionnel {{$pl->AnneePlan}}</h1>
        @foreach($entreprise as $ent)
        <h1 style="margin-left:83%;margin-top:10px">{{ $ent->nom_etp}}</h1><br>
        <h1></h1>
    </div>
    <div style="margin-top:-160px;" >
        <h3><u>Adresse</u> :{{$ent->Adresse_quartier}}  </h3>
        <h3><u>Region</u>   &nbsp;:&nbsp;{{$ent->Adresse_region}} </h3>
        <h3><u>Email</u>&nbsp; &nbsp; : {{$ent->email_etp}} </h3>
       
    </div>
    <div style="height: 100px;width:150px;background-color:white;margin-left:81%;margin-top:-200px">
        {{-- <img src="{{ url('/images/CFP/Educ21-06-22.jpg') }}" /> --}}
        {{-- <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('/images/cfp/Educ21-06-22.jpg'))) }}"> --}}
        <img src="{{ public_path('images/CFP/cac.png') }}" style="width: 100%;height:100%">
        {{-- <img src="public/images/CFP/Educ21-06-22.jpg" style="width: 100%;height:100%"> --}}
       

    </div>
   
    <div>
        <p style="margin-left:-17px;margin-top:40px; ">Tableau recapitulatif des desoins global (validé ou non-validé par les N+) en formation &nbsp;{{$pl->AnneePlan}} :</p>
        @endforeach
        @endforeach
        <table style="margin-left: -20px;width:100%">
            <thead>
                <tr>
                    <th>IM</th>
                    <th >Nom </th>
                   
                    <th>Fonction</th>
                    
                    <th>Thematique</th>
                    <th>Date prévisionnelle</th>
                    <th>Organisme</th>
                    <th>Urgence</th>
                    <th>Démandé par</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($stagiaire as $st)
                <tr>
                    <td style="width: 50px">
                        @foreach ($besoin as $be)
                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                                <?php $mat = $be->stagiaire->matricule;
                                break;?>
                                
                            @else
                            <?php $mat = '';
                                
                            ?>
                            @endif
                       @endforeach
                        @if(isset($mat)) 
                            {{ $mat }}
                        @endif
                    </td>
                    <td>
                        @foreach ($besoin as $be)
                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                                <?php $nom = $be->stagiaire->nom_stagiaire;
                                break;?>
                                
                            @else
                            <?php $nom = '';
                                
                            ?>
                            @endif
                       @endforeach
                        @if(isset($nom)) 
                            {{ $nom }}
                        @endif
                    </td>
                    {{-- <td style="width: 150px">
                        @foreach ($besoin as $be)
                        @if ($be->stagiaire_id == $st->stagiaire_id)            
                         
                           
                            
                            @endif 
                        @endforeach
                        @if(isset($email)) 
                        {{ $email}}
                        @endif
                    </td> --}}
                    <td>
                        @foreach ($besoin as $be)
                        @if ($be->stagiaire_id == $st->stagiaire_id)            
                            <?php $fonc = $st->fonction_stagiaire ?>
                        @endif 
                        @endforeach
                        @if(isset($fonc)) 
                        {{ $fonc}}
                        @endif
                    </td>
                    <td >    
                        @foreach($besoin as $be)   
                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                            {{$be->formation->nom_formation }} <br>
                            @endif    
                        @endforeach
                    </td>
                    <td>    
                        @foreach($besoin as $be)   
                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                            &nbsp; @php echo(date('m-Y',strtotime($be->date_previsionnelle))) @endphp <br>
                            @endif    
                        @endforeach
                    </td>
                    <td>    
                        @foreach($besoin as $be)   
                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                             &nbsp; {{$be->organisme}} <br>
                            @endif    
                        @endforeach
                    </td>
                    <td>    
                        @foreach($besoin as $be)   
                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                             &nbsp; {{$be->type}} <br>
                            @endif    
                        @endforeach
                    </td>
                    <td>
                        @foreach($besoin as $be)   
                        @if ($be->stagiaire_id == $st->stagiaire_id)            
                        @if($be->reponse_stagiaire == '1')
                             collaborateur <br>
                        @elseif($be->reponse_stagiaire == '0')
                             Manager <br>

                        @else
                             RH <br>
                        @endif
                        @endif    
                    @endforeach
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
           
        </table>
    </div>
</body>
</html>