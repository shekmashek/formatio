@extends('create_compte.header')
@section('content')
<div class="container-fluid">
    <div class="row info_choix">
        <div class="col-6 choix_compte">
            <div class="row">
                <div class=" d-flex flex-row justify-content-center">
                    <div class="me-4">
                        <h3>UpSkills</h3>
                    </div>
                    <div>
                        {{-- <img src="{{asset('img/logo_formation/logo_fmg7635dc trans.png')}}" alt="logo" > --}}
                        <p class="separateur">|</p>
                    </div>
                    <div class="ms-4">
                        <h3>formation.mg</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <p class="flex-wrap text_inscript text-center">
                    Inscrivez votre organisme de formation et votre entreprise gratuitement sur notre plateforme
                </p>
            </div>
            <div class="row content_choice">
                <p class="text-center txt_commencer">Commençons votre inscription</p>
                <p class="mb-5"><span class="vous_etes">Vous êtes?</span><br>Plateforme pour les centres de formation. Si vous cherchez une formation inscrivez-vous en tant que entreprise.</p>

                <div class="col-6 text-center icon_choice">
                    <a href="{{route('create+compte+client/OF')}}" role="button">
                        <p class="txt_titre">Organisme de Formation</p>
                        <i class='bx bxs-home'></i>
                    </a>
                </div>
                <div class="col-6 text-center icon_choice">
                    <a href="{{route('create+compte+client/employeur')}}" class="" role="button">
                        <p class="txt_titre">Entreprise</p>
                        <i class='bx bxs-city'></i>
                    </a>
                </div>
                <div class="text-center">
                    <p style="font-size: 14px" class="mt-2">Vous avez un compte? Connectez-vous <a href="{{route('sign-in')}}" style="color: blue">ici.</a> Vous voulez revenir à l'accueil?  Appuyez sur <a href="{{route('accueil_perso')}}" style="color: blue">accueil</a></p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div>
                <img src="{{asset('img/logo_formation/logo_fmg7635dc trans.png')}}" alt="logo" class="img-fluid image_accueil">
            </div>
        </div>
    </div>
</div>
@endsection
