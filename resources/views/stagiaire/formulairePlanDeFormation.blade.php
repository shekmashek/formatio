@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h1{
        font-weight: lighter;
    }
</style>
<div id="page-wrapper">
    <div class="container shadow-sm mt-5 p-4">
        <div class="row">
            <h1>Reccueil besoin de formation</h1>
        </div>
        <div class="row mt-3 p-3">
            <table class="table text-center">
                <thead>
                    @foreach ($plan as $p)
                    <tr style="background: rgb(250, 248, 248)">
                        <th >{{$p->AnneePlan}}</th>
                        <th>Debut du recueil : {{ \Carbon\Carbon::parse($p->debut_rec)->format('d/m/Y')}}</th>
                        <th>Debut du recueil : {{ \Carbon\Carbon::parse($p->fin_rec)->format('d/m/Y')}}</th>
                        <th><a href="{{route('plan.demande',$p->id)}} " class="btn btn-info text-light" style="float: right">Demander un formation</a></th>
                    </tr>
                    @endforeach
                    {{-- <tr style="background: rgb(250, 248, 248)">
                        <th >2021</th>
                        <th><span class="badge  " style="background: rgb(61, 158, 50)">Términer</span></th>
                        <th></th>
                        <th style="float: right"><i class="fa-solid fa-angle-down"></i></th>
                    </tr>
                    <tr style="background: rgb(250, 248, 248)">
                        <th >2020</th>
                        <th><span class="badge  " style="background: rgb(61, 158, 50)">Términer</span></th>
                        <th></th>
                        <th style="float: right"><i class="fa-solid fa-angle-down"></i></th>
                    </tr> --}}
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
