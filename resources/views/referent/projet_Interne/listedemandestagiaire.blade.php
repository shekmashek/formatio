@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h2{
        font-weight: 400;
        font-size: 25px;
    }
</style>
    <div class="container shadow-sm mt-5 p-4">
        <div class="row">
            <div class="col-md-12">
                <div class="float-start">
                    <h2>Liste global des demande de formation </h2>
                </div>
                <div class="float-end">

                    <a href="{{route('besoin.PDF',$ids)}}" class="btn btn-primary text-light">
                        Export PDF
                    </a>
                    <a href="/liste_demande_stagiaire" class="btn btn-dark text-light"><i class="fa-solid fa-caret-left"></i>&nbsp; Retour</a>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>IM</th>
                            <th>Nom stagiaire</th>
                            <th>Email</th>
                            <th>Fonction</th>
                            <th>domaine de formation</th>
                            <th>thematique</th>
                            <th>date prévisionnelle</th>
                            <th>Organisme</th>
                            <th>Priorité</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($stagiaire as $st)
                        <tr>
                            <td>
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
                            <td>
                                @foreach ($besoin as $be)
                                @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    <?php $email = $st->mail_stagiaire ?>
                                   
                                    
                                    @endif 
                                @endforeach
                                @if(isset($email)) 
                                {{ $email}}
                                @endif
                            </td>
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
                            <td>    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    &nbsp; {{$be->domaine->nom_domaine }} <br>
                                    @endif    
                                @endforeach
                            </td>
                            <td>    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    &nbsp; {{$be->formation->nom_formation }} <br>
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
                            @endforeach
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection