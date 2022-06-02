@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Coupon
</p>
@endsection
@section('content')
<form action="{{route('enregistrer_coupon')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h4 class="text-center"></h4>
    <div class="row mt-4">
        <div class="col-md-4  text-end">
            <label class="mt-2">Coupon<strong style="color:#ff0000;">*</strong></label>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" autocomplete="off" required name="coupon" class="form-control input w-50" id="coupon" placeholder="Coupon"/>
            </div>
        </div>
        <div class="col-md-4  text-end mt-4">
            <label class="mt-2">Valeur<strong style="color:#ff0000;">*</strong></label>
        </div>
        <div class="col-md-8 mt-4">
            <div class="form-group">
                <input type="number" min="1" max="100" autocomplete="off" required name="valeur" class="form-control input w-50" id="coupon" placeholder="Valeur (%)"/>
            </div>
        </div>
        <div class="col-md-8 mt-4">
            <div class=" text-center mt-3">
                <button type="submit" class="btn btn_enregistrer" id="saver_stg">Enregistrer</button>
            </div>
        </div>
    </div>
</form>
@endsection