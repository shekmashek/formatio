@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Salle de formation</h3>
@endsection
@section('content')
    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="color: black">Liste des salles</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="color: black">Ajout d' une salle</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @if (Session::has('salle_error'))
                <div class="alert alert-danger ms-1 me-1">
                    <ul class="p-0">
                        <li>{!! Session::get('salle_error') !!}</li>
                    </ul>
                </div>
            @endif
            <table class="table table-hover table-borderless">
                <thead style="border-bottom: 1px solid black; line-height: 20px">
                  <tr>
                    <th>Salle de formation</th>
                    <th rowspan="2"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($salles as $salle)
                        <tr>
                            <td>{{ $salle->salle_formation }}</td>
                            <td><a href="" aria-current="page" data-bs-toggle="modal" data-bs-target="#modal_modifier_salle_{{ $salle->id }}"><i class="bx bx-edit"></i></a></td>
                            <td><a href="{{ route('supprimer_salle',[$salle->id]) }}"><i class="bx bx-trash"></i></a></td>
                        </tr>
                        <div class="modal fade"
                            id="modal_modifier_salle_{{ $salle->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content p-3">
                                    <div class="modal-title pt-3"
                                        style="height: 50px; align-items: center;">
                                        <h5 class="text-center my-auto">Modifier la salle de formation</h5>
                                    </div>
                                    <form action="{{ route('modifier_salle',[$salle->id]) }}" method="POST">
                                        @csrf
                                        <label for="exampleDataList" class="form-label">Salle de formation</label>
                                        <input class="form-control" name="salle" id="exampleDataList" value="{{ $salle->salle_formation }}">
                                        <button type="submit" class="btn btn_enregistrer mt-2">Modifier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container mt-1">
                <div class="row">
                    <div class="col-md-6">
                        @if (Session::has('salle_error'))
                            <div class="alert alert-danger ms-2 me-2">
                                <ul>
                                    <li>{!! Session::get('salle_error') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('enregistrer_salle_of') }}" method="POST">
                            @csrf
                            <label for="exampleDataList" class="form-label">Salle de formation</label>
                            <input class="form-control" name="salle" id="exampleDataList" placeholder="Salle de formation...">
                            <button type="submit" class="btn btn_enregistrer mt-2">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection