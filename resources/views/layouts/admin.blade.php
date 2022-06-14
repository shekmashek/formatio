<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        .body{
            background-color: #e6e6e6;
        }
        .page .sidebar{
            height: 100vh;
            width: 250px;
            background: linear-gradient(35deg,#66fcf1,#45a29e);
            top: 0;
            left: 0;
            position: fixed;
        }
        .page .content{

        }
        .sidebar-header{
            padding: 10px 15px;
        }
        .sidebar-logo-container{
            background: rgba(0,0,0,0.2);
            display: flex;
            border-radius: 8px;

        }
        .logo-container{
            max-width: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 8px;
            margin: 8px;
            padding: 6px 8px;
        }
        .logo-sidebar{
            width: 100%;
            height: auto;
        }
        .brand-name-container{
            padding: 0px;
            margin: 15px 10px 0px 5px;
        }
        .brand-name{
            color: white;
            line-height: 1rem;
            margin: 0;
            font-size: 16px;
            letter-spacing: 1px;
        }
        .navigation-list{
            list-style-type: none;
            padding: 0px 20px;
            margin-top:30px;
        }
        .navigation-list-item{
            
            padding: 10px 18px 10px 18px;
            border-radius: 8px;
            margin: 15px 0px;
        }
        .navigation-list-item:hover{
            background-color: rgb(0,0,0,0.1);
            box-shadow:0 0 0.4em rgd(0,0,0,0.1);
            
        }
        .navigation-list-item.active{
            background-color: rgb(0,0,0,0.1);
            boc-shadow:0 0 0.4em rgd(0,0,0,0.1);
            cursor: pointer;
        }
        .navigation-link{
            color: rgb(31,40,51,0.8);
            letter-spacing: 1px;
            font-family: "Roboto",sans-serif;
            font-weight: 400;
            font-size: 16px;
            text-decoration: none;
        }
        .navigation-link:hover{
            color: rgb(255, 255, 255,0.7);
        }
        .navigation-list-item:hover .navigation-link{
            color: rgb(255, 255, 255,0.7);
        }
        .navigation-list-item.active .navigation-link{
            color: rgb(255, 255, 255,0.8);
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo-container">
                    <div class="logo-container">
                        <img class="logo-sidebar" src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="brand-name-container">
                        <p class="brand-name">
                            Formation.mg
                        </p>
                    </div>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="navigation-list">
                    <li class="navigation-list-item">
                        <a href="" class="navigation-link">Dashboard</a>
                    </li>
                    <li class="navigation-list-item active">
                        <a href="" class="navigation-link ">Organisme</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">

        </div>
    </div>
</body>
</html>