@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h5> Entreprise</h5>
            </div>
                    <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                     <div class="card text-center">
                                    <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="true" href="#">Faire une Demande</a>
                                    </li>
                                    <li class="nav-item">
                                          <a class="nav-link" href="#demande" id="">Mes demandes</a>
                                         <div i="test"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#invitation"  tabindex="-1" aria-disabled="false">Mes invitations</a>
                                    </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Liste Enteprises</h5>
                                    <p class="card-text">
                                     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Entreprise</th>
                                        <th>Lieu</th>
                                        <th colspan ="2">Actions</th>
                                    </tr>
                                </thead>
                                    <tbody >
                                    @foreach($entreprises as $etp)
                                    <tr>
                                        <td width = "200px">{{$etp->nom_etp}}</td>
                                    			<td>{{$etp->adresse}}</td>


                                            <td>
                                                <form action="{{ route('create_etp_formateur') }}" method="POST">
                                                    @csrf
                                                    <input name="etp_id" type="hidden" value="{{ $etp->id }}">
                                                    <input name="formateur_id" type="hidden" value="{{ $formateur_id }}">
                                                    <button type="submit" class="btn btn-primary" id="demande">Collaborer</button>
                                                </form>

                                                 <div id="modifier_{{$etp->id}}" class="collapse">
                                            @csrf
                                            <hr>
                                                   <img src="{{asset('images/entreprises/'.$etp->logo)}}" width="100" height="100">
                                                    Activités: {{$etp->Secteur_activite}} <br>
                                                    Téléphone: {{$etp->phone}} <br>
                                                    Email: {{$etp->mail}} <br>

                                            </div>
                                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#modifier_{{$etp->id}}">Voir Plus</button>

                                            </td></tr>

                                    </p>


                            </div>
                        </div>
                 @endforeach
                        </table>
                <center>
                                    <div id="demande ">
                                        <h2> Mes demandes</h2>
                                        <table class="text-center" id="dataTables-example">
                                            @foreach($entreprises as $etp)
                                            <tr class="my-5">
                                             <td>


                                                   <a href="" data-toggle="collapse" data-target="#plus_{{$etp->id}}"><img src="{{asset('images/entreprises/'.$etp->logo)}}" width="100" height="100"></a>
                                                <div id="plus_{{$etp->id}}" class="collapse">
                                                     @csrf
                                                        <hr>
                                                    Activités: {{$etp->Secteur_activite}} <br>
                                                    Email: {{$etp->adresse}} <br>
                                                    Téléphone: {{$etp->phone}} <br>
                                                    Email: {{$etp->mail}} <br>

                                                     </div>
                                                    </td>
                                                        <td width = "200px">{{$etp->nom_etp}}</td>
                                                    <td>

                                                        <button type="submit" class="btn btn-secondary" id="demande">Anuller</button>
                                                        <div id="modifier_{{$etp->id}}" class="collapse">
                                                    @csrf
                                         @endforeach
                                         </tr>
                                  </table>

                                 </div>
                                  <br>
                            </center>
                            <center>
                            <div class="invitation" >
                                <h2>Mes invitations</h2>
                                        <div id="invitation">

                                        <table class="text-center" id="dataTables-example">
                                            @foreach($entreprises as $etp)
                                                    <tr>

                                                    <td>
                                                <a href="" data-toggle="collapse" data-target="#info_{{$etp->id}}"><img src="{{asset('images/entreprises/'.$etp->logo)}}" width="100" height="100"></a>
                                                 <div id="info_{{$etp->id}}" class="collapse">
                                                     @csrf
                                                        <hr>
                                                    Activités: {{$etp->Secteur_activite}} <br>
                                                    Email: {{$etp->adresse}} <br>
                                                    Téléphone: {{$etp->phone}} <br>
                                                    Email: {{$etp->mail}} <br>
                                                     </div>

                                                </td>         <td width = "200px">{{$etp->nom_etp}}</td>
                                                    <td>
                                                        <button type="submit" class="btn btn-success" id="demande">Accepter</button>
                                                        <div id="modifier_{{$etp->id}}" class="collapse">
                                                    @csrf

                                             @endforeach
                                        </table>
                                 </div>
                                <br>
                                 </div>


@endsection
