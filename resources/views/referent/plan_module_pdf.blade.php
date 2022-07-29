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
        <h1 style="margin-left:-17px; ">Plan definitive {{$pl->AnneePlan}}</h1>
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
        <p style="margin-left:-17px;margin-top:40px;">Budget par module  du plan de formation &nbsp;{{$pl->AnneePlan}} :</p>
    </div>
    @endforeach
    @endforeach
    <table class="table table-hover"  style="width: 100%">
        <thead>
            <tr>
                
                <th>Module</th>
                <th class="text-center">Pax</th>
                <th>Budget</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($module as $modu)
            <tr>
               
                <td style="text-align: center">{{$modu->nom_formation}}</td>
                <td style="text-align: center">
                    @foreach($moduleC as $mod)
                    @if($mod->thematique_id == $modu->thematique_id)
                       {{ $mod->c}}
                        <?php $t=$mod->c ?>
                    @endif
                    @endforeach
                </td>
                <td style="text-align: center">
                    @if($modu->budget == null)
                        {{number_format(0, 0, ',', '.')}} Ar
                    @else
                        {{number_format($modu->budget, 0, ',', '.')}} Ar
                    @endif

                </td>
                
            </tr>
            
            @endforeach
            
        </tbody>
    </table>
</body>
</html>