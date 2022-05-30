<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    


    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="shortcut icon" href="{{ asset('maquette/real_logo.ico') }}" type="image/x-icon">
    <title> Formation.mg </title>


    <style>
        .form-control:focus, .adresse:focus {
        border-color: #7a27d894;
        box-shadow: 0 0 0 0.2rem rgba(122, 28, 185, 0.459);
        outline-style: none;
        }
        
        .form-control::placeholder {     
            transition: 0.3s;
        }
        .form-control:focus::placeholder {
        color: #7a27d8c4;
        transform: translateX(75%);
        /* float: right; */

        }

        .adresse_container{
            justify-content: space-between;
        }

        @media (max-width: 576px) {
            .adresse {
            width: 100%;

        }
        }
        .adresse::placeholder{
            transition: 0.3s;
        }

        .adresse:focus::placeholder{
            color: #7a27d8c4;
            float: right;
        }
        .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(122, 28, 185, 0.459);
            border-color: #7a27d894;
        }




    </style>

</head>


{{-- <div>
    <header>
        <nav class="navbar_accueil fixed-top d-flex justify-content-between mb-5">
            <div class="left_menu ms-2">
                <p class="titre_text m-2 p-0"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}"
                        width="60px" height="60px"> Formation.mg</p>
            </div>
            <div class="right_menu d-flex justify-content-end align-items-center">
                <div class="child_right_menu">
                    <a href="{{ url('contact') }}"><button class="btn_bordure_violet mx-2"><i
                                class="fa fa-phone-alt"></i>&nbsp; Contactez-nous</button></a>
                </div>
                <div class="child_right_menu">
                    <a href="{{ route('create+compte+client') }}"><button class="btn_bordure_violet mx-2"><i
                                class="fa fa-layer-plus"></i>&nbsp; Créer un compte</button></a>
                </div>
                <div class="child_right_menu">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn_bordure_violet mx-2"><i class="fa fa-sign-out-alt"></i>&nbsp;
                            Déconnexion</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
</div> --}}


<nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-3 mb-5 bg-body rounded">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('maquette/logo_fmg54Ko.png') }}" alt="" width="50" height="50">
        </a>
      <a class="navbar-brand" href="#">Informations supplémentaires</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" href="{{ url('contact') }}">Contact</a>
          {{-- <a class="nav-link" href="{{ route('create+compte+client') }}">Inscription</a> --}}
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-secondary" type="submit">&nbsp;Deconnexion</button>
        </form>
        </div>
      </div>
    </div>
  </nav>



<body class="m-50">

<div class="container align-middle mt-5">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('remplir_info_resp') }}" class="row g-3" method="POST">
        @csrf

        <div class="col-12">
            <input type="text" name="id_resp" value="{{ $testNull[0]->id }}" hidden>
        </div>

        @if ($testNull[0]->nom_resp != null)

        <div class="col-12 text-center">
            <label for="nom_prenom"  class="form-label text-center">Nom Prenom</label>
            <input readonly 
            name="nom_prenom" class="form-control bg-light p-2 m-auto text-center" 
            value="{{ $testNull[0]->nom_resp }} {{ $testNull[0]->prenom_resp }}"
            type="text" id="nom_prenom" style="border:1px solid #7a27d894; display:flex; width:auto;">
        </div>
        @else

        <div class="col-md-6">
          <label for="nom_resp" class="form-label">Nom</label>
          <input name="nom_resp" type="email" class="form-control" id="nom_resp">
        </div>
        <div class="col-md-6">
          <label for="prenom_resp" class="form-label">Prenom</label>
          <input name="prenom_resp" type="text" class="form-control" id="prenom_resp">
        </div>

        @endif



        <div class="col-6" id="datepicker">
          <label for="date_naissance_resp" class="form-label">Date de naissance</label>

            @if ($testNull[0]->date_naissance_resp != null)
            {{-- {{ dd($testNull[0]->email_resp) }} --}}
            <span class="form-control">{{ date('d M Y',strtotime($testNull[0]->date_naissance_resp)) }}</span>

            {{-- {{ dd(date('d F Y', strtotime($testNull[0]->date_naissance_resp)) ) }} --}}
            @else

            <input class="form-control" type="date" 
            id="datepicker" name="date_naissance_resp"
            onfocus="{{ date('d/m/Y',strtotime($testNull[0]->date_naissance_resp)) }}">
            
            @endif
            {{-- <input class="form-control" type="date" 
            id="datepicker" name="date_naissance_resp"
            onfocus="{{ date('d/m/Y',strtotime($testNull[0]->date_naissance_resp)) }}"> --}}

        </div>

        <div class="col-6">
            <label for="genre" class="form-label">Sexe</label>

            @if ($testNull[0]->sexe_resp != null && $testNull[0]->sexe_resp == "Homme")
            <select class="form-select" value="" id="genre" name="genre" aria-label="select">
                <option value="{{ $testNull[0]->sexe_resp }}" selected>{{ $testNull[0]->sexe_resp }}</option>
                <option value="Femme">Femme</option>

            </select>
            @elseif ($testNull[0]->sexe_resp != null && $testNull[0]->sexe_resp == "Femme")
            <select class="form-select" value="" id="genre" name="genre" aria-label="select">
                <option value="{{ $testNull[0]->sexe_resp }}" selected>{{ $testNull[0]->sexe_resp }}</option>
                <option value="Homme">Homme</option>

            </select>

            @else
            <select class=" form-select form-control " value="" id="genre" name="genre" aria-label="select">
                <option selected>Sexe</option>
                <option class="form-control" value="Homme">Homme</option>
                <option class="form-control" value="Femme">Femme</option>
    
            </select>
            @endif

        </div>

        <div class="col-md-6">
            <label for="email_resp" class="form-label">Email</label>
            
            @if ($testNull[0]->email_resp != null)
            <input class="form-control" id="email_resp" name="email_resp" type="email" value="{{ $testNull[0]->email_resp }}" placeholder="Entrez votre email" class="form-control" inputmode="email">
            @else
            <input class="form-control" id="email_resp" name="email_resp" type="email" placeholder="Entrez votre email" value="" class="form-control" inputmode="email">
            @endif
        
        
        </div>
  
          
          <div class="col-md-6">
            
            <label for="telephone_resp" class="form-label">N° téléphone</label>

            @if ($testNull[0]->telephone_resp != null)
            <input value="{{ $testNull[0]->telephone_resp }}" id="telephone_resp" name="telephone_resp" class="form-control" type="text" inputmode="numeric" >

            @else
            <input value="" placeholder="Telephone" id="telephone_resp" name="telephone_resp" class="form-control" type="text" inputmode="numeric" >

            @endif
          </div>

        <div class="col-md-6">
            <label for="cin_resp" class="form-label">CIN</label>
            
            @if ($testNull[0]->cin_resp != null)
            <input value="{{ $testNull[0]->cin_resp}}" id="cin_resp" 
            name="cin_resp" class="form-control" type="text" 
            placeholder="CIN" inputmode="numeric" >
            @else
          
            <input value="" placeholder="CIN" id="cin_resp" name="cin_resp" class="form-control" type="text" inputmode="numeric" >
            
            @endif

        </div>

        <div class="col-12">
          <label for="inputAddress2" class="">Address</label>
          
          {{-- @if ($testNull[0]->adresse_lot != null and $testNull[0]->adresse_quartier != null and $testNull[0]->adresse_ville != null and $testNull[0]->adresse_code_postal != null and $testNull[0]->adresse_region != null)
          <input name="adresse" type="text" class="form-control"
          value="{{ $testNull[0]->adresse_lot }} &nbsp;{{ $testNull[0]->adresse_quartier }} &nbsp;{{ $testNull[0]->adresse_ville }} &nbsp;{{ $testNull[0]->adresse_code_postal }}&nbsp;{{ $testNull[0]->adresse_region }}&nbsp;"
            id="inputAddress2" placeholder="">
          
            @endif --}}

        <div class="container col-md-12">
            <div class="row row-cols-6 adresse_container">
                    
                {{-- <label for="lot" class="form-label">Lot</label> --}}
                <input type="text" placeholder="Lot" class="p-1 m-1 border rounded adresse" name="lot" id="lot">
                
                {{-- <label for="quartier" class="form-label">Quartier</label> --}}
                <input type="text" placeholder="Quartier" class="p-1 m-1 border rounded adresse" name="quartier" id="quartier">
                
                {{-- <label for="ville" class="form-label">Ville</label> --}}
                <input type="text" placeholder="Ville" class="p-1 m-1 border rounded adresse" name="ville" id="ville">
                
                {{-- <label for="code_postal" class="form-label">Ville</label> --}}
                <input type="text" placeholder="code postale" class="p-1 m-1 border rounded adresse" name="code_postal" id="code_postal">
                
                {{-- <label for="region" class="form-label">Région</label> --}}
                <input type="text" placeholder="Région" class="p-1 m-1 border rounded adresse" name="region" id="region">
                
            </div>

        </div>


        
        <div class="col-md-6">
            <label for="cin_resp" class="form-label">Entreprise</label>
            
            <input readonly value="{{ $entreprise[0]->nom_etp}}" id="nom_etp" 
            name="nom_etp" class="form-control" type="text" 
            placeholder="Entreprise">


        </div>

                
        <div class="col-md-6">
            <label for="cin_resp" class="form-label">Fonction</label>
            
            <input value="{{ $testNull[0]->fonction_resp}}" id="nom_etp" 
            name="nom_etp" class="form-control" type="text" 
            placeholder="Fonction">


        </div>

{{-- 
          <div class="col-md-4">
            <label for="inputState" class="form-label">State</label>
            <select id="inputState" class="form-select">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div> --}}

          {{-- <div class="col-md-2">
            <label for="inputZip" class="form-label">Zip</label>
            <input type="text" class="form-control" id="inputZip">
          </div> --}}

          

        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </form>

</div>

</body> 


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}

<script>
    $(function(){
  $('#datepicker').datepicker();
}); 
</script>

</html>
