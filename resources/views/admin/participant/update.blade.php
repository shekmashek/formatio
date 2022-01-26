@extends('./layouts/admin')
@section('content')
<br>

<div class="shadow p-3 mb-5 bg-body rounded">
  <div class="formation__item set-bg" id>
    <form  class="btn-submit" action="{{route('update_stagiaire',$stagiaire->id)}}" method="get" >
      @csrf
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="formation-service">
    <p style="font-size: 20px;" class="ms-5">Profiles</p>

              <div class="form-group">
                <label for="sary">Photo</label>
                 <input type="file" class="form-control-file" id="photo" name="image">
                                      
                              </div><br>
                      <div class="form-group">
                        <label for="name">Nom</label>
                          <input type="text" value="{{ $stagiaire->nom_stagiaire }}" class="form-control"  name="nom" placeholder="Nom">
                      </div> 
                  
                      <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" value="{{ $stagiaire->prenom_stagiaire }}"  name="prenom" placeholder="Prénom">
                      </div>
                      <div class="form-group">
                        <label for="genre">Genre</label>
                        <select name="genre" class="form-control" id="genre" onchange="" >
                          <option value="Homme" {{ ($stagiaire->genre_stagiaire == 1) ? 'selected' : '' }}>Homme</option>
                          <option value="Femme" {{ ($stagiaire->genre_stagiaire == 0) ? 'selected' : '' }}>Femme</option>
                          
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="titre">Titre</label>
                        <select name="titre" class="form-control" id="titre">
                            <option value="Monsieur">Mr</option>
                            <option value="Mme">Mme</option>
                            <option value="Mlle">Mlle</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                            <option value="Dir">Dir</option>
                            <option value="PDG">PDG</option>
                        </select>
                      </div>
                    
                      <div class="form-group">
                        <label for="date">Date de Naissance</label>
                        <input type="date" class="form-control" name="date" value="{{ $stagiaire->date_naissance }}">
                      </div>
                      <div class="form-group">
                        <label for="cin">CIN</label>
                          <input type="text" value="{{ $stagiaire->cin}}" class="form-control"  name="cin" >
                      </div> 
                      
                    </div>
                  </div>
        <div class="col-lg-4 col-md-6">
            <div class="formation-service">
    <p style="font-size: 20px;" class="ms-5">Informations Personnelles</p>
                        <div class="form-group">
                          <label for="adresse">Adresse</label>
                          <input type="adresse" class="form-control"  name="adresse" value="{{ $stagiaire->adresse }}">
                        </div>
                        <div class="form-group">
                          <label for="lot">Lot</label>
                          <input type="text" class="form-control" id="lot" name="lot" placeholder="Lot" value="{{ $stagiaire->lot}}">
                          
                      </div>
                      <div class="form-group">
                          <label for="rue">Rue</label>
                          <input type="text" class="form-control" id="rue" name="rue" placeholder="Rue" value="{{ $stagiaire->rue}}">
                         
                      </div>
                      <div class="form-group">
                          <label for="quartier">Quartier</label>
                          <input type="text" class="form-control" id="quartier" name="quartier" placeholder="Quartier" value="{{ $stagiaire->quartier}}">
                         
                      </div>
                      <div class="form-group">
                          <label for="code_postal">Code Postale</label>
                          <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="Code Postale" value="{{ $stagiaire->code_postal}}">
                       
                      </div>
                      <div class="form-group">
                          <label for="ville">Ville</label>
                          <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" value="{{ $stagiaire->ville}}">
                      </div>
                      <div class="form-group">
                          <label for="region">Region</label>
                          <input type="text" class="form-control" id="region" name="region" placeholder="Region" value="{{ $stagiaire->region}}">
                      </div>
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="email" class="form-control"  name="mail" value="{{ $stagiaire->mail_stagiaire }}" >
                </div>
                <div class="form-group">
                  <label for="phone">Téléphone</label>
                  <input type="text" class="form-control"  name="phone" value="{{ $stagiaire->telephone_stagiaire }}">
                </div>
                <div class="form-group">
                  <label for="niv_etude">Niveau d'étude</label>
                  <input type="text" class="form-control"  name="niv" value="{{ $stagiaire->niveau_etude }}">
                </div>
                <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" class="form-control" value=""  name="password" placeholder="">
                </div>
              </div>
             </div>
          <div class="col-lg-4 col-md-6">
            <div class="formation-service">
              <p style="font-size: 20px;" class="ms-5">Informations Professionnelles</p>
                <p>
                  <div class="form-group">
                    <label for="matr">Matricule</label>
                    <input type="text" value="{{ $stagiaire->matricule }}"  class="form-control"  name="matricule" placeholder="Matricule" readonly>
                </div>
                  <div class="form-group">
                    <label for="fonction">Fonction</label>
                    <input type="text" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $stagiaire->fonction_stagiaire }}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="fonction">Entreprise</label>
                    <input type="text" class="form-control"  name="entreprise"  value="{{ optional(optional($stagiaire)->entreprise)->nom_etp}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="matr">Branche</label>
                    <input type="text" value="{{ $stagiaire->lieu_travail }}"  class="form-control"  name="matricule" placeholder="Matricule" readonly>
                </div>
                  <div class="form-group">
                    <label for="fonction">Departement</label>
                    <input type="text" class="form-control"  name="departement" value="{{ optional(optional($stagiaire)->departement)->nom_departement }}" readonly>
                  </div>
            </div>
        </div>
            <div class="col-lg-1 col-md-6">

          </div>
        <div class="col-lg-11 col-md-6">
            <div class="formation-service">
                <h4><span class="lnr lnr-phone"></span>Formation suivie</h4>
                <p>
                   Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minima laboriosam repellat alias voluptate vel, sit maxime quaerat molestiae nemo in accusantium quos voluptates omnis! Amet laborum ab nemo veniam libero.</p>
                </p>
            </div>
        </div>
        <br>
            
      </div>
    </div>
    <button style="background-color: #801D68;color:white" class="btn modification "> Enregister</button>
        </form>
  </div>


        {{-- <form  class="btn-submit" action="{{route('update_stagiaire',$stagiaire->id)}}" method="get" >
            @csrf
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="matr">Matricule</label>
                <input type="text" value="{{ $stagiaire->matricule }}"  class="form-control"  name="matricule" placeholder="Matricule">
            </div>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" value="{{ $stagiaire->nom_stagiaire }}" class="form-control"  name="nom" placeholder="Nom">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom</label>
              <input type="text" class="form-control" value="{{ $stagiaire->prenom_stagiaire }}"  name="prenom" placeholder="Prénom">
            </div>
            <div class="form-group">
              <label for="date">Date de Naissance</label>
              <input type="date" class="form-control" name="date" value="{{ $stagiaire->date_naissance }}">
            </div>
            <div class="form-group">
              <label for="adresse">Adresse</label>
              <input type="adresse" class="form-control"  name="adresse" value="{{ $stagiaire->adresse }}">
            </div>

          </div>
        <div class="col-md-6">
          <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control"  name="mail" value="{{ $stagiaire->mail_stagiaire }}" >
            </div>
            <div class="form-group">
              <label for="phone">Téléphone</label>
              <input type="text" class="form-control"  name="phone" value="{{ $stagiaire->telephone_stagiaire }}">
            </div>
           
             <div class="form-group">
              <label for="niv_etude">Niveau d'étude</label>
              <input type="text" class="form-control"  name="niv" value="{{ $stagiaire->niveau_etude }}">
            </div>

            <div class="form-group">
              <label for="fonction">Fonction</label>
              <input type="text" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $stagiaire->fonction_stagiaire }}">
            </div>
             <div class="form-group">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control" value=""  name="password" placeholder="">
            </div>
        </div>
        </div>
          <br>
            <button class="btn btn-outline-success btn-lg modification "><span class = "glyphicon glyphicon-pencil"></span> Modifier</button>
        </form> --}}

@endsection
