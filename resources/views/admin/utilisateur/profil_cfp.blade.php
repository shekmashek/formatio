@extends('./layouts/admin')
@section('content')
    <div class="page-content page-container" id="page-content">
        @foreach ($liste_cfps as $cfp)


        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-2 m-r-2">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center">
                                    <div class="m-b-25">
                                        {{-- <img src="/dynamic-image/{{$cfp->logo}}" width="30%" height="30%"> --}}
                                        <img src="{{asset('images/CFP/'.$cfp->logo)}}" width="30%" height="30%">
                                    </div>
                                    <h4 class="f-w-600 mt-5">{{ $cfp->nom }}</h4>
                                    <p></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                    <p></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-6">
                                    <h6 class="m-b-20  f-w-600">Centre de formaton</h6>
                                            <hr>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Adresse</p>
                                            <h6 class="text-muted f-w-400">
                                                lot:
                                                @if($cfp->adresse_lot==NULL)
                                                <strong style="color: red">incomplète</strong>
                                                @else
                                                {{ $cfp->adresse_lot }}
                                                @endif
                                            </h6>
                                            <h6 class="text-muted f-w-400">
                                                quartier:
                                                @if($cfp->adresse_quartier==NULL)
                                                <strong style="color: red">incomplète</strong>
                                                @else
                                                {{ $cfp->adresse_quartier }}
                                                @endif
                                            </h6>
                                            <h6 class="text-muted f-w-400">
                                                ville:
                                                @if($cfp->adresse_ville==NULL)
                                                <strong style="color: red">incomplète</strong>
                                                @else
                                                {{ $cfp->adresse_ville }}
                                                @endif
                                            </h6>

                                            <h6 class="text-muted f-w-400">
                                                region:
                                                @if($cfp->adresse_region==NULL)
                                                <strong style="color: red">incomplète</strong>
                                                @else
                                                {{ strtoupper($cfp->adresse_region) }}
                                                @endif
                                            </h6>

                                            <p class="m-b-10 m-t-2 f-w-600"><i class="bx bx-envelope"></i>&nbsp;Email</p>
                                            <h6 class="text-muted f-w-400">{{ $cfp->email }}</h6>

                                            <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{ $cfp->telephone }}</h6>
                                        </div>

                                        <div class="col-lg-6">
                                            <br><br>
                                        <p class="m-b-10 f-w-600"><i  class="bx bxs-graduation"></i>&nbsp; Domaine de formation</p>
                                            <h6 class="text-muted f-w-400">
                                                @if ($cfp->domaine_de_formation==NULL)
                                                <strong style="color: red">incomplète</strong>
                                                @else
                                                {{ $cfp->domaine_de_formation }}
                                                @endif
                                            </h6>
                                              <p class="m-b-10 f-w-600"><i  class="fa fa-globe"></i>&nbsp; Site web officiel</p>
                                            <h6 class="text-muted f-w-400">
                                                @if ($cfp->site_cfp==NULL)
                                                <strong style="color: rgb(202, 98, 98)">aucun site a été mentionner</strong>
                                                @else
                                                {{ $cfp->site_cfp }}
                                                @endif
                                            </h6>
                                     </div>
                                    </div>

                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
