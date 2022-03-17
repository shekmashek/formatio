@extends('./layouts/admin')
@section('content')
<div class="container-fluid pb-5">
    @can('isReferent')
    <iframe src="{{$iframe_etp->iframe}} " height="1000" width="100%" name="demo">
    </iframe>
    @endcan
    @can('isCFP')
        <iframe src="{{$iframe_cfp->iframe}} " height="1000" width="100%" name="demo">
        </iframe>
    @endcan
</div>

@endsection