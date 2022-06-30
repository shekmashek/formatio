@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h2{
        font-weight: 400;
        font-size: 25px;
        color: gray;
    }
    .nav-tabs .nav-link.active {
    color: white;
    background-color: #7367f0;
    border-color: #dee2e6 #dee2e6 #fff;
}
</style>
    <div class="container shadow-sm mt-5 p-4">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active"  id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Validé</button>
              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Non validé</button>
              
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="float-start">
                            <h2>Liste des demande de formation validé par les N+ <span style="font-size:20px">👍🏻</span> </h2>
                        </div>
                        <div class="float-end">
        
                            <a style="background: #7367f0" class="btn  text-light">
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
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="float-start">
                            <h2>Liste des demande de formation non validé par les N+ <span style="font-size:20px">👎🏻</span> </h2>
                        </div>
                        <div class="float-end">
        
                            <a style="background: #7367f0" class="btn  text-light">
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
                                        @foreach ($besoinN as $be)
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
                                        @foreach ($besoinN as $be)
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
                                        @foreach ($besoinN as $be)
                                        @if ($be->stagiaire_id == $st->stagiaire_id)            
                                            <?php $email = $st->mail_stagiaire ?>
                                           
                                            
                                            @endif 
                                        @endforeach
                                        @if(isset($email)) 
                                        {{ $email}}
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($besoinN as $be)
                                        @if ($be->stagiaire_id == $st->stagiaire_id)            
                                            <?php $fonc = $st->fonction_stagiaire ?>
                                           
                                            
                                            @endif 
                                        @endforeach
                                        @if(isset($fonc)) 
                                        {{ $fonc}}
                                        @endif
                                    </td>
                                    
                                    <td>    
                                        @foreach($besoinN as $be)   
                                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                                            &nbsp; {{$be->formation->nom_formation }} <br>
                                            @endif    
                                        @endforeach
                                    </td>
                                    <td>    
                                        @foreach($besoinN as $be)   
                                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                                            &nbsp; @php echo(date('m-Y',strtotime($be->date_previsionnelle))) @endphp <br>
                                            @endif    
                                        @endforeach
                                    </td>
                                    <td>    
                                        @foreach($besoinN as $be)   
                                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                                             &nbsp; {{$be->organisme}} <br>
                                            @endif    
                                    @endforeach
                                    </td>
                                    <td>    
                                        @foreach($besoinN as $be)   
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
            
          </div>
        
    </div>

@endsection