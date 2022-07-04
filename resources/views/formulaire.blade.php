<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formation.mg</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css"
        integrity="sha512-8Vtie9oRR62i7vkmVUISvuwOeipGv8Jd+Sur/ORKDD5JiLgTGeBSkI3ISOhc730VGvA5VVQPwKIKlmi+zMZ71w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
    <link rel="shortcut icon" href="{{  asset('maquette/logo_fmg7635dc.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/formulaire_manquante.css')}}">

</head>

<body>
        <div class="row dashboard mt-5">
            <div class="row">
                <p class="text-center">Bonjour, vous allez bientôt accéder à votre espace.Aidez nous à paramétrer votre compte en fournissant les informations manquantes pour une meilleure utilisation de votre application.</p>
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li class="text-center">{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif
            </div>
            <br>
            <div class="row mt-4">
                <div class="container">
                    <div class="col-12">
                        <form action="{{route('remplir_information')}}" method="POST" class=" formulaire w-50" >
                            @csrf
                            <input type="hidden" name="id_stg" value="{{$testNull[0]->id}}">
                            <p class="text-center">Informations générales</p>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Nom<sup>*</sup></label>
                                <div class="col-sm-6">
                                    @if ($testNull[0]->nom_resp != null)
                                        <input type="text" readonly class="form-control" id="nom_stg" name="nom_stg" value="{{$testNull[0]->nom_resp}}">
                                    @else
                                        <input type="text" class="form-control" id="nom_stg" name="nom_stg" placeholder="nom responsable" required>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Prenom<sup>*</sup></label>
                                <div class="col-sm-9">
                                    @if ($testNull[0]->prenom_resp != null)
                                        <input type="text" readonly class="form-control" id="prenom_stg" name="prenom_stg" value="{{$testNull[0]->prenom_resp}}">
                                    @else
                                        <input type="text" class="form-control" id="prenom_stg" name="prenom_stg" placeholder="prenom responsable" required>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Date de naissance<sup>*</sup></label>
                                <div class="col-sm-4">
                                    @if ($testNull[0]->date_naissance_resp != null)
                                        <input type="text" readonly class="form-control" id="date_naissance_stg" name="date_naissance_stg" value="{{$testNull[0]->date_naissance_resp}}">
                                    @else
                                        <input type="text" class="form-control" id="date_naissance_stg" name="date_naissance_stg" placeholder="date" onfocus="(this.type='date')" required>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Genre<sup>*</sup></label>
                                <div class="col-sm-4">
                                    @if ($testNull[0]->sexe_resp != null)
                                        <input type="text" readonly class="form-control" id="genre_stg" name="genre_stg" value="{{$testNull[0]->sexe_resp}}">
                                    @else
                                        <select name="genre" class="form-select test" id="genre">
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <p class="text-center">Coordonnées</p>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Email<sup>*</sup></label>
                                <div class="col-sm-6">
                                    @if ($testNull[0]->email_resp != null)
                                        <input type="text" readonly class="form-control" id="email_stg" name="email_stg" value="{{$testNull[0]->email_resp}}">
                                    @else
                                        <input type="mail" class="form-control" id="email_stg" name="email_stg" required>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Téléphone<sup>*</sup></label>
                                <div class="col-sm-4">
                                    @if ($testNull[0]->telephone_resp != null)
                                        <input type="text" readonly class="form-control" id="tel_stg" name="tel_stg" value="{{$testNull[0]->telephone_resp}}">
                                    @else
                                        <input type="text" class="form-control" id="tel_stg" name="tel_stg" placeholder="téléphone" onfocus="(this.type='number')" required>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">CIN<sup>*</sup></label>
                                <div class="col-sm-4">
                                    @if ($testNull[0]->cin_resp != null)
                                        <input type="text" readonly class="form-control" id="cin_stg" name="cin_stg" value="{{$testNull[0]->cin_resp}}">
                                    @else
                                        <input type="text" class="form-control" id="cin_stg" name="cin_stg" placeholder="carte d'identité national" onfocus="(this.type='number')" min="0" required>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Adresse<sup>*</sup></label>
                                <div class="col-sm-9">
                                    @if ($testNull[0]->adresse_lot!=null and $testNull[0]->adresse_quartier!=null and $testNull[0]->adresse_ville!=null and $testNull[0]->adresse_code_postal!=null and $testNull[0]->adresse_region!=null )
                                        <input type="text" readonly class="form-control" id="" name="" value="{{$testNull[0]->adresse_lot}}&nbsp;{{$testNull[0]->adresse_quartier}}&sbquo;&nbsp;{{$testNull[0]->adresse_ville}}&nbsp;{{$testNull[0]->adresse_code_postal}}&sbquo;&nbsp;{{$testNull[0]->adresse_region}}">
                                    @else
                                        <div class="col-sm-5">
                                            @if ($testNull[0]->adresse_lot != null)
                                                <input type="text" readonly class="form-control mb-3" id="lot" name="lot" value="{{$testNull[0]->adresse_lot}}">
                                            @else

                                                <input type="text" class="form-control mb-3" id="lot" name="lot" placeholder="lot responsable" required>
                                            @endif
                                            @if ($testNull[0]->adresse_quartier != null)
                                                <input type="text" readonly class="form-control mb-3" id="quartier" name="quartier" value="{{$testNull[0]->adresse_quartier}}">
                                            @else
                                                <input type="text" class="form-control mb-3" id="quartier" name="quartier" placeholder="quartier responsable" required>
                                            @endif
                                            @if ($testNull[0]->adresse_ville != null)
                                                <input type="text" readonly class="form-control mb-3" id="ville" name="ville" value="{{$testNull[0]->adresse_ville}}">
                                            @else
                                                <input type="text" class="form-control mb-3" id="ville" name="ville" placeholder="ville responsable" required>
                                            @endif
                                            @if ($testNull[0]->adresse_code_postal != null)
                                                <input type="text" readonly class="form-control mb-3" id="code_postal" name="code_postal" value="{{$testNull[0]->adresse_code_postal}}">
                                            @else
                                                <input type="text" class="form-control mb-3" id="code_postal" name="code_postal" placeholder="code postal responsable" required>
                                            @endif
                                            @if ($testNull[0]->adresse_region != null)
                                                <input type="text" readonly class="form-control mb-3" id="region" name="region" value="{{$testNull[0]->adresse_region}}">
                                            @else
                                                <input type="text" class="form-control mb-3" id="region" name="region" placeholder="region responsable" required>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <p class="text-center">Informations professionnelles</p>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Entreprise</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="etp" name="etp" value="{{$entreprise[0]->nom_etp}}">
                                </div>
                            </div>
                            <div class="mb-3 row text-end">
                                <label for="nom" class="col-sm-3 col-form-label">Fonction</label>
                                <div class="col-sm-8">
                                    @if ($testNull[0]->fonction_resp != null)
                                        <input type="text" readonly class="form-control" id="fonction_stagiaire" name="fonction_stagiaire" value="{{$testNull[0]->fonction_resp}}">
                                    @else
                                        <input type="text"  class="form-control" id="fonction_stagiaire" name="fonction_stagiaire" value="{{$testNull[0]->fonction_resp}}" required>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <button type="submit" class="btn btn_enregistrer mx-auto mt-3 w-50"><i class='bx bx-check me-1'></i>Enregistrer</button>
                            </div>


                            {{-- <div class="form-control mb-5">
                                <p class="text-center">Informations générales</p>
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                    <input type="text" name="id_resp" style="float: right;" value="{{$testNull[0]->id}}" hidden>
                                    @if ($testNull[0]->nom_resp!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">NOM<span style="float: right;">{{$testNull[0]->nom_resp}} {{$testNull[0]->prenom_resp}} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                        <p class="p-1 m-0" style="font-size: 10px;">NOM<input type="text" name="nom_resp" style="float: right;"></p>
                                    @endif



                                </div>
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                    @if ($testNull[0]->date_naissance_resp!=null)
                                        <p class="p-1 m-0" style="font-size: 10px;">DATE DE NAISSANCE<span style="float: right;">{{date('j \\ F Y', strtotime($testNull[0]->date_naissance_resp))}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                        <p class="p-1 m-0" style="font-size: 10px;">DATE DE NAISSANCE<input type="date" name="date_naissance_resp" style="float: right;"></p>
                                    @endif


                                </div>
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                    @if ($testNull[0]->sexe_resp!=null)
                                        <p class="p-1 m-0" style="font-size: 10px;">GENRE<span style="float: right;">{{$testNull[0]->sexe_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                        </p>
                                    @else
                                        <select  value="" name="genre" class="form-select test input" id="genre"  >
                                            <option value="Homme"  >Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    @endif
                                </div>

                                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                            </div>

                            <div class="form-control mb-5">
                                <p class="text-center">Coordonnées</p>


                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if ($testNull[0]->email_resp!=null)
                                        <p class="p-1 m-0" style="font-size: 10px;">ADRESSE E-MAIL<span style="float: right;">{{$testNull[0]->email_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                        </p>
                                    @else
                                        <p class="p-1 m-0" style="font-size: 10px;">ADRESSE E-MAIL<input type="text" name="email_resp" style="float: right;"></p>
                                    @endif
                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if ($testNull[0]->telephone_resp!=null)
                                        <p class="p-1 m-0" style="font-size: 10px;">TELEPHONE<span style="float: right;">{{$testNull[0]->telephone_resp}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                                        </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">TELEPHONE<input type="text" name="tel_resp" style="float: right;"></p>
                                    @endif
                                </div>

                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if ($testNull[0]->cin_resp!=null)
                                        <p class="p-1 m-0" style="font-size: 10px;">CIN<span style="float: right;">{{$testNull[0]->cin_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                        </p>
                                    @else
                                        <p class="p-1 m-0" style="font-size: 10px;">CIN<input type="text" name="cin_resp" style="float: right;"></p>
                                    @endif
                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if ($testNull[0]->adresse_lot!=null and $testNull[0]->adresse_quartier!=null and $testNull[0]->adresse_ville!=null and $testNull[0]->adresse_code_postal!=null and $testNull[0]->adresse_region!=null )
                                    <p class="p-1 m-0" style="font-size: 10px;">ADRESSE<span style="float: right;">{{$testNull[0]->adresse_lot}} &nbsp;{{$testNull[0]->adresse_quartier}} &nbsp;{{$testNull[0]->adresse_ville}} &nbsp;{{$testNull[0]->adresse_code_postal}}&nbsp;{{$testNull[0]->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                    </p>
                                    @else
                                    @if($testNull[0]->adresse_lot==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">LOT<input type="text" name="lot" style="float: right;"></p>
                                    @endif
                                    @if($testNull[0]->adresse_quartier==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">QUARTIER<input type="text" name="quartier" style="float: right;"></p>
                                    @endif
                                    @if($testNull[0]->adresse_ville==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">VILLE<input type="text" name="ville" style="float: right;"></p>
                                    @endif
                                    @if($testNull[0]->adresse_code_postal==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">CODE POSTAL<input type="text" name="code_postal" style="float: right;"></p>
                                    @endif
                                    @if($testNull[0]->adresse_region==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">REGION<input type="text" name="region" style="float: right;"></p>
                                    @endif
                                    @endif

                                </div>



                                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                            </div>



                            <div class="form-control">
                                <p class="text-center">Informations professionnelles</p>


                                <div style="border-bottom: solid 1px #d399c2;" class="">

                                    <p class="p-1 m-0" style="font-size: 10px;">ENTREPRISE<span style="float: right;">{{$entreprise[0]->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                    </p>

                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">

                                    <p class="p-1 m-0" style="font-size: 10px;">FONCTION<span style="float: right;">{{$testNull[0]->fonction_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>

                                </div>


                                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                            </div><br>
                            <button type="submit" class="btn btn-primary">Envoyer</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

