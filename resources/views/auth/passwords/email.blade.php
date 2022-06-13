<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="style.css"> --}}
    <title>Formation.mg</title>
</head>
<style>
    .pass{
        margin-top: 250px;
        color: gray;
    }
    .pass h2{
        font-size: 30px;
    }
    p{
        font-size: 15px;
    }
    .form-control:focus{
       border: #7367f0 1px solid;
       box-shadow: 0 5px 30px rgba(0, 0, 0, .1);
       
    }
</style>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mt-5">
                <div class="row">
                    <div class="col-lg-8 mt-0">
                        
                    </div>
                </div>
                <div class="img" style="margin-top: 5%;margin-left:10%"> 
                    <img class="img-fluid forgot"  src="{{asset('images/forgot-password-v2.9faba3c1.svg')}}" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-4 " style="padding-right: 120px;">
                <form method="POST" action="{{ route('password.email') }}">
                @csrf
                    <div class="pass">
                        <h2>Mot de passe oubliés? <span style="font-size:25px">🔒</span> </h2>
                        <p>Entrez votre email et nous vous enverrons des instructions pour réinitialiser votre mot de passe</p>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse e-Mail') }}</label>
                            <input type="text" class="form-control index @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                        <button type="submit" role="button" class="btn btn-block mt-4" style="background-color: #7367f0;color: white;width: 100%;">Envoyer le lien de réinitialisation</button>
                        
                    </div>
                    <div class="mt-3" style="text-align: center;"><a href="/sign-in"  style="text-decoration: none;color:#7367f0;font-size: 15px;"> Retour à la connexion</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>