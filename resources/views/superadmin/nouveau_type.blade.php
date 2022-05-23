@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Abonnement</p>
@endsection
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
@section('content')
<div class="container-fluid">
    <div class="shadow p-5 mb-5 mx-auto bg-body w-50 mt-5" style="border-radius: 15px">
            @if (Session::has('message'))
                <div class="alert alert-success ms-4 me-4">
                    <ul>
                        <li>{!! \Session::get('message') !!}</li>
                    </ul>
                </div>
            @endif
            <form action="{{route('abonnement.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="row px-3">
                            <div class="form-group">
                                <select class="form-select selectP input" id="type_abonne" name="type_abonne" aria-label="Default select example">
                                    <option value="of">Organisme de Formation</option>
                                    <option value="etp">Entreprise</option>
                                </select>
                                <label class="form-control-placeholder" for="type_enregistrement">Type d'abonnés<strong style="color:#ff0000;">*</strong></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row px-3">
                            <div class="form-group">
                                <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type"  required>
                                <label for="nom" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                @error('nom')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="row px-3">
                            <div class="form-group">
                                <input type="text" autocomplete="off"  name="description" class="form-control input" id="description"  required />
                                <label for="description" class="form-control-placeholder" align="left">Description<strong style="color:#ff0000;">*</strong></label>
                                @error('description')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-4">
                    <div class="col-12">
                        <div class="row px-3">
                            <div class="form-group">
                                <input type="text" name="prix" class="form-control input" id="prix"  required />
                                <label for="prix" class="form-control-placeholder" align="left">Prix</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-4">
                    <div class="col-4">
                        <div class="row px-3">
                            <div class="form-group">
                                <input type="number" min="1" name="nb_utilisateur" class="form-control input" id="utilisateur" required />
                                <label for="utilisateur" class="form-control-placeholder" align="left">Nombre d'utilisateur<strong style="color:#ff0000;">*</strong></label>
                                @error('utilisateur')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row px-3">
                            <div class="form-group">
                                <input type="number" name="nb_formateur" min="1" class="form-control input" id="formateur"  required />
                                <label for="formateur" class="form-control-placeholder" align="left">Nombre de formateur<strong style="color:#ff0000;">*</strong></label>
                                @error('formateur')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check">
                            <input class="form-check-input utilisateur" name="illimite_utilisateur" type="checkbox" value="illimite" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                            Illimite
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row  mt-4">
                    <div class="col-4">
                        <div class="row px-3">
                            <div class="form-group">
                                <input type="number" class="form-control input" min="1" id="min_emp" name="min_emp" disabled required/>
                                <label for="min" class="form-control-placeholder" align="left">Nombre minimum d' employé<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="mail_err"></span>
                                @error('min')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input type="number" class="form-control input" id="max_emp" name="max_emp" disabled required/>
                            <label for="max" class="form-control-placeholder" align="left">Nombre maximum d' employé<strong style="color:#ff0000;">*</strong></label>
                            <span style="color:#ff0000;" id="mail_err"></span>
                            @error('max')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check">
                            <input class="form-check-input employe" name="illimite_etp" type="checkbox" value="illimite" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                              Illimite
                            </label>
                        </div>
                    </div>

                </div>
                <div class="row  mt-4">
                    <div class="col-6">
                        <div class="row px-3">
                            <div class="form-group">
                                <input type="number" name="nb_projet" class="form-control input" min="1" id="projet" required/>
                                <label for="projet" class="form-control-placeholder" align="left">Nombre de session<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="mail_err"></span>
                                @error('projet')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input projet" name="illimite_of" type="checkbox" value="illimite" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                            Illimite
                            </label>
                        </div>
                    </div>
                </div>
                <div class=" text-center">
                    <button type="submit" class="btn btn-lg btn_enregistrer">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $('#type_abonne').on("change",function(){
        if($(this).val() == "of"){
            $('#min_emp').attr('disabled',true);
            $('#max_emp').attr('disabled',true);
            $('#projet').attr('disabled',false);
        }
        else{
            $('#projet').attr('disabled',true);
            $('#min_emp').attr('disabled',false);
            $('#max_emp').attr('disabled',false);
        }
    });
    $(".utilisateur").on("change", function() {
        if ($(this).is(":checked")) {
            $('#utilisateur').attr('disabled',true);
            $('#formateur').attr('disabled',true);
        }
        else{
            $('#utilisateur').attr('disabled',false);
            $('#formateur').attr('disabled',false);
        }
    });
    $(".employe").on("change", function() {
        if ($(this).is(":checked")) {
            $('#min_emp').attr('disabled',true);
            $('#max_emp').attr('disabled',true);
        }
        else{
            $('#min_emp').attr('disabled',false);
            $('#max_emp').attr('disabled',false);
        }
    });
    $(".projet").on("change", function() {
        if ($(this).is(":checked")) {
            $('#projet').attr('disabled',true);
        }
        else{
            $('#projet').attr('disabled',false);
        }
    });
</script>
@endsection