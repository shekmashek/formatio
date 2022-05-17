@if($vue == 1)
    @extends('layouts/admin_non_abonne')
@else
    @extends('layouts/admin')
@endif
@section('title')
    <p class="text_header m-0 mt-1">Business intelligent</p>
@endsection
@section('content')
<style>
    .bi-content{
        margin: 100px 100px 100px 400px;
    }
</style>
<div class="container-fluid pb-5">
    @can('isReferent')
        @if($iframe_etp->iframe == null)
           <div class="bi-content"><h1>Business Intelligence to give you the edge</h1><br><img src="{{asset('images/bi.png')}}" alt=""></div>
        @else
            <iframe src="{{$iframe_etp->iframe}} " height="1000" width="100%" name="demo">
            </iframe>
        @endif

    @endcan
    @can('isCFP')
        @if($iframe_cfp->iframe == null)
        <div class="bi-content"><h1>Business Intelligence to give you the edge</h1><br><img src="{{asset('images/bi.png')}}" alt=""></div>
        @else
            <iframe src="{{$iframe_cfp->iframe}} " height="1000" width="100%" name="demo">
            </iframe>
        @endif
    @endcan
</div>

@endsection