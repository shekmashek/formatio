@extends('./layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="m-4">
                <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link btn_enregistrer" class=" active" id="tab_etp" data-bs-toggle="tab" href="#etp" type="button" role="tab" aria-controls="etp" aria-selected="true">
                            Entreprises</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn_enregistrer" class=" active" id="tab_of" data-bs-toggle="tab" href="#of" type="button" role="tab" aria-controls="of" aria-selected="true">
                            Organisme de Formation</a>
                    </li>
                </ul>
                <div class="tab-content mt-5" id="myTabContent">
                    {{-- entreprises --}}
                    <div class="tab-pane fade show active" id="etp" role="tabpanel" aria-labelledby="tab_etp">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-5"><div class="shadow p-3 mb-5 bg-body rounded ">
                                        <h4>Entreprises</h4>
                                        <div class="table-responsive text-center">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nom</th>
                                                        <th scope="col">Iframe</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($entreprise)>0)
                                                        @for($i = 0; $i < count($entreprise); $i++)
                                                        <tr>
                                                            <td>{{$entreprise[$i]->nom_etp}}</td>
                                                            @if($iframe_etp == null)
                                                                <td class="d-flex flex-row">
                                                                    <form action="enregistrer_iframe_etp" method="post" class="d-flex flex-row">
                                                                        @csrf
                                                                        <input type="hidden" name="entreprise_id" value={{$entreprise[$i]->id}}>
                                                                        <input type="text" name="iframe_url" class="form-control"><button class="btn btn_next" type="submit">Ajouter </button>
                                                                    </form>
                                                                </td>
                                                            @endif
                                                            @if($iframe_etp != null)
                                                                @for($j= 0; $j< count($iframe_etp); $j++)
                                                                    @if($iframe_etp[$j]->entreprise_id == $entreprise[$i]->id)
                                                                        <td> {{$iframe_etp[$j]->iframe}}</td>
                                                                    @endif
                                                                @endfor
                                                            @endif
                                                        </tr>
                                                        @endfor
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- organisme de formation --}}
                    <div class="tab-pane fade show" id="of" role="tabpanel" aria-labelledby="tab_of">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-5">

                                    <div class="shadow p-3 mb-5 bg-body rounded ">

                                        <h4>Organisme de formation</h4>

                                        <div class="table-responsive text-center">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nom</th>
                                                        <th scope="col">Iframe</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($of)>0)
                                                        @for($i = 0; $i < count($of); $i++) <tr>
                                                            <td>{{$of[$i]->nom}}</td>
                                                            @if($iframe_of == null)
                                                            <td class="d-flex flex-row">
                                                                <form action="enregistrer_iframe_cfp" method="post" class="d-flex flex-row">
                                                                    @csrf
                                                                    <input type="hidden" name="cfp_id" value={{$of[$i]->id}}>
                                                                    <input type="text" name="iframe_url" class="form-control w-50"><button class="btn btn_next" type="submit">Ajouter </button>
                                                                </form>
                                                            </td>
                                                            @else
                                                                @for($j= 0; $j< count($iframe_of); $j++) @if($iframe_of[$j]->cfp_id === $of[$i]->id)
                                                                    <td>{{$iframe_of[$j]->iframe}}</td>
                                                                    @else
                                                                        <td>
                                                                            <form action="enregistrer_iframe_cfp" method="post">
                                                                                @csrf
                                                                                <input type="hidden" name="cfp_id" value={{$of[$i]->id}}>
                                                                                <input type="text" name="iframe_url" class="form-control w-50"><button class="btn btn_next" type="submit">Ajouter </button>
                                                                            </form>
                                                                        </td>
                                                                    @endif
                                                                @endfor
                                                            @endif
                                                            </tr>
                                                        @endfor
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
