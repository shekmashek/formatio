<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formation.mg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<style>
    @import url(//fonts.googleapis.com/css?family=Lato:300:400);

body {
  margin:0;
  font-family: 'Roboto',sans-serif;
}

h1 {
  font-family: 'Lato', sans-serif;
  font-weight:300;
  letter-spacing: 2px;
  font-size:48px;
}
p {

  letter-spacing: 1px;
  font-size:14px;
  color: #333333;
}

.header {
  position:relative;
  text-align:center;
  background: linear-gradient(60deg, rgba(84,58,183,1) 0%, rgba(0,172,193,1) 100%);
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

.contenue{
    background: rgba(0, 0, 0, 0.1);
    padding: 50px;
    text-align: center;
    letter-spacing: 2px;
    background-size: cover;


}

.contenue:hover{
    background-color: #7367f0;
    box-shadow: 0 0 20px 1px rgb(115 103 240 / 70%);


}

.contenue:hover h1{
    transform: scale(1.1);
    transition: 0.3s;

}
.contenue:hover span{
    color: black;
    text-transform: uppercase;
}
.contenue a{
    text-decoration: none;
    color: white;
}

</style>
<body>
    <div class="header">

        <!--Content before waves-->
        <div class="inner-header flex">
        <!--Just the logo.. Don't mind this-->

        {{-- <h1>Entreprise</h1>
        <h1>Organisme de formation</h1> --}}
        <div class="titre">
            <div class="row">
                <h3 style="margin-top:-40px;font-weight: lighter;">Inscrivez votre organisme de formation ou votre entreprise gratuitement sur notre plateforme</h3>
                <div class="col-md-5 contenue mt-5" style="margin-left: 9%">
                    <h1 class=""> <a href="{{route('create+compte+client/employeur')}}"><span>E</span>ntreprise</a></h1>
                </div>
                <div class="col-md-5 contenue mt-5" style="margin-left: 2px">
                    <h1> <a href="{{route('create+compte+client/OF')}}"><span>O</span>rganisme de <span>f</span>ormation</a></h1>
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
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
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
          <p style="font-size: 30px">Formation.mg / <a href="/" style="text-decoration: none">revenir à l'acceuil</a> </p>
        </div>
        <!--Content ends-->
</body>
</html>