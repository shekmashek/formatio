<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<style>
    body{
        background: whitesmoke;
        direction: ltr;
        font-size: 14px;
        line-height: 1.4286;
        margin: 0;
        padding: 0;
        font-family: 'Roboto',sans-serif;
    }
    .contenue{
        width: 900px;
        height: 500px;
        background: #fff;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        position: absolute;
        padding: 20px;
        
    }
    h3{
        font-size: 24px;
        text-align: center;
    }
    .contenue .img{
        left: 50%;
        top:50%;
        
    }
</style>






<body>
    <div class="container">
        <div class="row">
            <div class="contenue">
                <h3>Félicitation,votre compte a été creer,vous pouvez maintenant vous connecter à l'aide des identifiant que nous avons envoyer par mail</h3>
                <div class="img">
                    <img  src="{{asset('images/maf.gif')}}" class="" style="width: 250px; heigth: 250px;margin-left:35%">
                    
                </div>
                <a  href="{{route('sign-in')}}">
                    <button type="button" style="background: #7635dc; padding: 15px 15px 15px 15px; color:white; border: none; border-radius: 5px;margin-top:100px;margin-left:43%">Terminé</button>
                </a>
            </div>
            
        </div>
    </div>
</body>
</html>





