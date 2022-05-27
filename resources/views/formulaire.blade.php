<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<style>
   @import url(//fonts.googleapis.com/css?family=Lato:300:400);

body {
  margin:0;
}

h1 {
  font-family: 'Lato', sans-serif;
  font-weight:300;
  letter-spacing: 2px;
  font-size:48px;
}
p {
  font-family: 'Lato', sans-serif;
  letter-spacing: 1px;
  font-size:14px;
  color: #333333;
}

.header {
  position:relative;
  text-align:center;
  background: linear-gradient(60deg, rgb(65, 33, 192) 0%, rgb(62, 136, 185) 100%);
  color:white;
}
.logo {
  width:50px;
  fill:white;
  padding-right:15px;
  display:inline-block;
  vertical-align: middle;
}

.inner-header {
  height:65vh;
  width:100%;
  margin: 0;
  padding: 0;
}

.flex { /*Flexbox for containers*/
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.waves {
  position:relative;
  width: 100%;
  height:15vh;
  margin-bottom:-7px; /*Fix for safari gap*/
  min-height:100px;
  max-height:150px;
}

.content {
  position:relative;
  height:20vh;
  text-align:center;
  background-color: white;
}

/* Animation */

.parallax > use {
  animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
}
.parallax > use:nth-child(1) {
  animation-delay: -2s;
  animation-duration: 7s;
}
.parallax > use:nth-child(2) {
  animation-delay: -3s;
  animation-duration: 10s;
}
.parallax > use:nth-child(3) {
  animation-delay: -4s;
  animation-duration: 13s;
}
.parallax > use:nth-child(4) {
  animation-delay: -5s;
  animation-duration: 20s;
}
@keyframes move-forever {
  0% {
   transform: translate3d(-90px,0,0);
  }
  100% { 
    transform: translate3d(85px,0,0);
  }
}
/*Shrinking for mobile*/
@media (max-width: 768px) {
  .waves {
    height:40px;
    min-height:40px;
  }
  .content {
    height:30vh;
  }
  h1 {
    font-size:24px;
  }
}
.form{
    width: 1500px;
    height: 600px;
    
    z-index: 1;
    opacity: 1;
}
.form-control{
    background: white;
    width: 400px;
    color: white;
}
.form-control:focus{
    background: transparent;
    color: white;
}
input[type="text"]:disabled {
  background: white;
  color: black;
}
input[type="date"]:disabled {
  background: white;
  color: black;
}
.tsisy{
    border: red 1px solid;
}
.tsisy:focus{
    border: red 1px solid;
}
.tsisy::placeholder{
    color: red;
}
::placeholder {
  color: red;
  font-size: 15px;
}

</style>
<body>
    <!--Hey! This is the original version
of Simple CSS Waves-->

<div class="header">

    <!--Content before waves-->
    <div class="inner-header flex">
    <!--Just the logo.. Don't mind this-->
    <div class="container " >
        <div class="row">
            <div class="col-lg-12">
                <h1 style="margin-top: 300px;margin-left:-950px;font-size:30px;">&nbsp;Bienvenue chez formation.mg</h1>
                <button class="btn btn-outline-info" style="width:180px;color:white;margin-top:-78px;margin-left:1000px;"><i class="fa fa-phone-alt"></i>&nbsp; Nous contacter</button>
                <button class="btn btn-outline-info" style="width:180px;color:white;margin-top:-78px;margin-left:1200px;"><i class="fa fa-sign-in-alt"></i>&nbsp;Se deconecter</button>
            </div>
        </div>
        <form action="{{route('remplir_info_resp')}}" method="POST" >
          @csrf
        <div class="row">
           <div class="col-lg-4">
            <div class="form mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                      
                    </div>
                    
                  </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Noms &nbsp;</label><br>
                        <input type="text" class="form-control" value="{{$testNull[0]->nom_resp}}" disabled>
                    </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Prenoms &nbsp;</label><br>
                        <input type="text" value="{{$testNull[0]->prenom_resp}} " class="form-control" disabled>
                    </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">date de naissance &nbsp;</label><br>
                        <input type="date" value="{{$testNull[0]->date_naissance_resp}}" class="form-control" disabled>
                    </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Email &nbsp;</label><br>
                        <input type="text" value="{{$testNull[0]->email_resp}}" class="form-control" disabled>
                    </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Télephone &nbsp;</label><br>
                        @if ($testNull[0]->telephone_resp!=null)
                        <input type="text"  value="{{$testNull[0]->telephone_resp}}"  class="form-control" disabled> 
                        @else
                            <input type="text" placeholder="veillez remplir" class="form-control tsisy" >
                        @endif
                    </div>
                    
               </div>
           </div>
           <div class="col-lg-3">
            <div class="form mt-3">
                <div class="input-group">
                    
                    
                  </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">CIN &nbsp;</label><br>
                        @if ($testNull[0]->cin_resp!=null)
                            <input type="text"  value="{{$testNull[0]->cin_resp}}"  class="form-control">
                        @else
                            <input type="text" placeholder="veillez remplir" class="form-control tsisy" >
                        @endif
                    </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Lôt &nbsp;</label><br>
                        @if ($testNull[0]->adresse_lot!=null)
                        <input type="text"  value="{{$testNull[0]->adresse_lot}}"  class="form-control" disabled> 
                        @else
                            <input type="text" placeholder="veillez remplir" class="form-control tsisy" >
                        @endif
                    </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Quartier &nbsp;</label><br>
                        @if ($testNull[0]->adresse_quartier!=null)
                        <input type="text"  value="{{$testNull[0]->adresse_quartier}}"  class="form-control" disabled> 
                        @else
                            <input type="text" placeholder="veillez remplir" class="form-control tsisy" >
                        @endif
                    </div>
                    
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Ville &nbsp;</label><br>
                        @if ($testNull[0]->adresse_ville!=null)
                        <input type="text"  value="{{$testNull[0]->adresse_ville}}"  class="form-control" disabled> 
                        @else
                            <input type="text" placeholder="veillez remplir" class="form-control tsisy" >
                        @endif
                    </div>
               </div>
           </div>
           <div class="col-lg-3" style="margin-left:100px">
            <div class="form mt-3">
                <div class="input-group">
                    
                    
                  </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Code Postal &nbsp;</label><br>
                        @if ($testNull[0]->adresse_code_postal!=null)
                        <input type="text"  value="{{$testNull[0]->adresse_code_postal}}"  class="form-control" disabled> 
                        @else
                            <input type="text" placeholder="veillez remplir" class="form-control tsisy" >
                        @endif
                    </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Entreprise &nbsp;</label><br>
                        <input type="text" value="{{$entreprise[0]->nom_etp}} " class="form-control" disabled>
                    </div>
                    <div class="form-group mt-1">
                        <label for="" style="float: left">Fonction &nbsp;</label><br>
                        @if ($testNull[0]->fonction_resp!=null)
                        <input type="text"  value="{{$testNull[0]->fonction_resp}}"  class="form-control" disabled> 
                        @else
                            <input type="text" placeholder="veillez remplir" class="form-control tsisy" >
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-info" style="margin-left: -850px;width:150px;color:white;height:50px;">Envoyer </button>
                    </div>
                   
               </div>
              </form>
           </div>
           
        </div>
        
    </div>
    </div>
    
    <!--Waves Container-->
    <div>
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs>
    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,252,255,0.7" />
    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
    </g>
    </svg>
    </div>
    <!--Waves end-->
    
    </div>
    <!--Header ends-->
    
    <!--Content starts-->
    <div class="content flex">
      <p></p>
    </div>
    <!--Content ends-->
</body>
</html>