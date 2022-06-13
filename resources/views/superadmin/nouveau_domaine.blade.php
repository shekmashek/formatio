@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Domaine</p>
@endsection
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
@section('content')
<div class="container-fluid">
    <div class="shadow p-5 mb-5 mx-auto bg-body w-50 mt-5" style="border-radius: 15px">
            @if(isset($message))
                <div class="alert alert-success ms-4 me-4">
                    <ul>
                        <li>{!! $message !!}</li>
                    </ul>
                </div>
            @endif
            <form action="{{route('creer_domaine')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <h4>Création d'un nouveau domaine: </h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="row px-3">
                            <div class="form-group">
                                <label for="nom"  align="left">Nom de domaine<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" autocomplete="off"  name="nom_domaine" class="form-control input" id="nom_type"  required>
                                @error('nom')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
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