@extends('./layouts/admin')
@section('content')
<div class="container-fluid pb-5">
    @can('isReferent')
        @if($iframe_etp->iframe == null)
            <img src="{{asset('images/construction.png')}}" alt="">
        @else
            <iframe src="{{$iframe_etp->iframe}} " height="1000" width="100%" name="demo">
            </iframe>
        @endif

    @endcan
    @can('isCFP')
        @if($iframe_cfp->iframe == null)
            <img src="{{asset('images/construction.png')}}" alt="">
        @else
            <iframe src="{{$iframe_cfp->iframe}} " height="1000" width="100%" name="demo">
            </iframe>
        @endif
    @endcan
</div>

@endsection