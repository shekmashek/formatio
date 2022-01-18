@extends('./layouts/admin')
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="card shadow mx-3 my-3 px-3 pt-3">
    <i class="far fa-caret-circle-down pb-3" data-toggle="collapse" href="#corps" role="button" aria-expanded="false"><a  data-toggle="collapse" href="#corps" role="button" aria-expanded="false" aria-controls="collapseExample"> Janvier </a> </i>
    <div class="collapse" id="corps">

    <div class="d-flex justify-content-end mb-3 me-2">
        <i class="fa fa-folder-plus ms-2" style="font-size: 22px; color:rgb(130,33,100);">&nbsp;<a class="m-0 p-0" style="font-size: 16px;"> Ajouter un nouveau projet </a></i>
    </div>

    <table class="table table-stroped m-0 p-0">
        <thead class="thead_projet">
            <th class="th_top_left" style="border-top: none;"> Projet </th>
            <th> Session </th>
            <th> Centre de formation </th>
            <th> Date </th>
            <th> Lieu </th>
            <th> Heure </th>
            <th> Statut </th>
            <th> Participants </th>
            <th class="th_top_right" style="border-top: none; border-right: none;"> Nouveau session </th>
        </thead>
        <tbody>
            <tr>
                <td> Projet 1 </td>
                <td> SES01 </td>
                <td> Numerika </td>
                <td> 11 janv au 25 janv </td>
                <td> Ampandrana </td>
                <td> 09 h à 10 H </td>
                <td> <p class="en_cours m-0 p-0">En cours</p> </td>
                <td> 
                    
                </td>
                <td> 
                    {{-- <i class="far fa-plus pb-3 i_carret" data-toggle="collapse" href="#session_id" role="button" aria-expanded="false" aria-controls="collapseExample"></i> --}}
                    <i class="far fa-plus pb-3 i_carret"></i>
                </td>
            </tr>
        </tbody> 
    </table>
            {{-- <div class="collapse mx-1" id="session_id">
                    <table class="table">
                        <thead>
                            <th> Session </th>
                            <th> Lieu </th>
                            <th> Heure </th>
                            <th> Date </th>
                            <th> Participants </th>
                            <th> Status </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SES01</td>
                                <td> Ampandrana </td>
                                <td> 09 H à 11 H</td>
                                <td> 11 janv </td>
                                <td>  </td>
                                <td> <p class="en_cours m-0 p-0">En cours</p> </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="shadow_personnel col-3">
                        <i class="fa fa-folder-plus ms-2" style="font-size: 20px; color:blue;">&nbsp;<a class="m-0 p-0" style="font-size: 12px;"> Ajouter une nouvelle session </a></i>
                    </div>
                </div>     --}}
            
    </div>
     
</div><br>




<style>
.table-stroped > tbody > tr:nth-child(2n+1) > td, .table-stroped > tbody > tr:nth-child(2n+1) > th {
   background-color: rgb(255,249,224);
}
.thead_projet{
    background-color: rgb(15,126,145);
    color: whitesmoke;
}
tr{
    font-size: 14px;
    padding-top: 4px;
}
.th_top_left{
    border-radius: 15px 0 0 0;
}
.th_top_right{
    border-radius: 0 15px 0 0;
}
th{
    border-right: 2px solid whitesmoke;
    text-align: center;
}
td{
    text-align: center;
}
.i_carret{
    color: rgb(130,33,100);
    transition: all 0.5s ease;
}
.i_carret:hover{
    color: rgb(130,33,100);
    transform: scale(1.1);
}
.en_cours{
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 2rem;
    color: blue;
    font-weight: bold;
    font-family: 'Open Sans';
    background-color: rgb(38,205,210);
}
</style>
<script>
</script>
@endsection