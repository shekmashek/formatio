<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
    <title> Formation.mg </title>
</head>
<body>
    <div class="container">
        <h1>Contact-nous</h1>
        <br>
        <br>

        <div class="row">

            <div class="col-lg-4">
                Adresse
                <i class="fa fa-envelope-o" aria-hidden="true"></i>

            </div>
            <div class="col-lg-8">
                <h3>Pour nous contacter Veuillez remplir les formulaires ci-dessous</h3>
                <br>
                <br>
               
                <div class="row">
                    <div class="col-lg-6">
            <form method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Votre nom">
                     </div>
                     <br>
                     <div class="form-group">
                        <input type="text" class="form-control" placeholder="Entreprise">
                     </div>
                      <br>
                    </div>
                    <div class="col-lg-6">
                    
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email">
                     </div>
                      <br>
                      <div class="form-group">
                         <input type="text" class="form-control" placeholder="Objet">
                      </div>
                    </div>
                </div>
               
                 <br>
                 <div class="form-group">
                    <textarea type="text" class="form-control" placeholder="Votre message" height:400px></textarea>
                 </div>
                 <br>
                
                      <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Envoyer</button>
                      
                      </div>
            </div>
            </div>
        </form>
        </div>
    </div>     
    {{-- <footer class="footer_container">

        <div class="d-flex justify-content-center pt-3">
            <div class="bordure">&copy; Copyright 2022</div>
            <div class="bordure">Informations légales</div>
            <div class="bordure">Contactez-nous</div>
            <div class="bordure">Politique de confidentialités</div>
            <div class="bordure">Condition d'utilisation</div>
            <div class="bordure">Tarifs</div>
            <div class="bordure">Crédits</div>
            <div> &nbsp; Version 0.9</div>
        </div>
</footer>
                 --}}
</body>
</html>
