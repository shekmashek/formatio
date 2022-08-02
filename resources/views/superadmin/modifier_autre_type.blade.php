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
            <form action="{{route('enregistrer_modification_autre_abonnement',$abonnement->id)}}" method="POST">
                @csrf
                    <input type="hidden" name="id" value="{{$abonnement->id}}" />
                    <div class="row">
                        <div class="col-12">
                            <div class="row px-3">
                                <div class="form-group text-center">
                                    <h3>
                                        @php
                                            echo ucfirst($abonnement->type_service);
                                        @endphp
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="row px-3">
                                <div class="form-group">
                                    <input type="number" autocomplete="off" min="1"  name="prix_fixe" class="form-control input" id="prix_fixe"  value="{{$abonnement->prix_fixe}}" required/>
                                    <label for="prix_fixe" class="form-control-placeholder" align="left">Prix fixe<strong style="color:#ff0000;">*</strong></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-4">
                        <div class="col-12">
                            <div class="row px-3">
                                <div class="form-group">
                                    <input type="number" autocomplete="off" min="1"  name="prix_employee" class="form-control input" id="prix_employee"  value="{{$abonnement->prix_par_employe}}" required/>
                                    <label for="prix_fixe" class="form-control-placeholder" align="left">Prix par employé<strong style="color:#ff0000;">*</strong></label>
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