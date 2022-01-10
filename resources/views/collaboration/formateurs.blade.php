@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <br>
                <h5> Formateurs</h5>
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
                                          <a class="nav-link" href="#dmd" id="">Mes demandes</a>
                                         <div i="test"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#invitation"  tabindex="-1" aria-disabled="false">Mes invitations</a>
                                    </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Liste Formateurs</h5>
                                    <p class="card-text">
                                     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Formateur</th>
                                        <th>Adresse</th>
                                        <th colspan ="2">Actions</th>

                                    </tr>
                                </thead>
                                    <tbody >
                                    @foreach($formateur as $form)
                                    <tr>
                                        <td width = "200px">{{$form->nom_formateur}} <br>
                                    			{{$form->prenom_formateur}}</td>
                                                 <td>{{$form->adresse}} </td>


                                            <td>
                                                <form action="{{ route('create_formateur_etp') }}" method="POST">
                                                    @csrf
                                                    <input name="etp_id" type="hidden" value="{{ $entreprise_id }}">
                                                    <input name="formateur_id" type="hidden" value="{{ $form->id }}">
                                                    <button type="submit" class="btn btn-primary" id="demande">Collaborer</button>
                                                </form>


                                                 <div id="modifier_{{$form->id}}" class="collapse">
                                            {{-- @csrf --}}
                                            <hr>
                                                   <img src="{{asset('images/entreprises/'.$form->logo)}}" width="100" height="100">
                                                    Téléphone: {{$form->numero_formateur}} <br>
                                                    Email: {{$form->mail_formateur}} <br>

                                            </div>
                                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#modifier_{{$form->id}}">Voir Plus</button>

                                            </td></tr>

                                    </p>


                            </div>
                        </div>
         @endforeach

                        </table>
                            <center>
                                    <div id="dmd">
                                        <h2> Mes demandes</h2>
                                        <table class="text-center" id="dataTables-example">
                                            @foreach($demmande as $form)
                                                    <tr>
                                                    <td><a href="" data-toggle="collapse" data-target="#plus_{{$form->id}}"><img src="{{asset('images/entreprises/')}}" width="100" height="100"></a>
                                                    {{-- <div id="plus_{{$form->id}}" class="collapse">
                                                     @csrf
                                                        <hr> --}}
                                                    Specialité: {{$form->specialite_formateur}} <br>
                                                    Adresse: {{$form->adresse_etp}} <br>
                                                    Téléphone: {{'mbol static'}} <br>
                                                    Email: {{$form->mail_formateur}} <br>
                                                    {{$form->attente}} <br>


                                                     {{-- </div> --}}
                                                    </td>&nbsp;
                                                        <td width = "200px">{{$form->nom_formateur}} &nbsp;{{$form->prenom_formateur}}</td>

                                                <br>
                                                <br>
                                                    <td>
                                                        <a href="{{ route('delete_formateur_etp',$form->id) }}">
                                                            <button type="submit" class="btn btn-secondary" id="demande">Anuller</button>
                                                        </a>

                                                        {{-- <button type="submit" class="btn btn-secondary" id="demande">Anuller</button>
                                                        <div id="modifier_{{$form->id}}" class="collapse">
                                                    @csrf --}}


                                         @endforeach
                                  </table>

                                 </div>
                                  <br>
                                </center>
                                <center>
                                <h2>Mes invitations</h2>
                                        <div id="invitation">

                                        <table class="text-center" id="dataTables-example">
                                            @foreach($invitation as $form)
                                                    <tr>
                                                    <td><a href="" data-toggle="collapse" data-target="#info_{{$form->id}}"><img src="{{asset('images/entreprises/')}}" width="100" height="100"></a>
                                                     {{-- <div id="info_{{$form->id}}" class="collapse">
                                                     @csrf
                                                        <hr> --}}
                                                    Specialité: {{$form->specialite_formateur}} <br>
                                                    Adresse: {{$form->adresse_etp}} <br>
                                                    Téléphone: {{"$form->numero_formateur"}} <br>
                                                    Email: {{$form->mail_formateur}} <br>

                                                        {{-- </div> --}}
                                                    </td>
                                                        <td width = "200px">{{$form->nom_formateur}}  &nbsp;{{$form->prenom_formateur}}</td>
                                                       </td>

                                                    <td>
                                                        <button type="submit" class="btn btn-success" id="demande">Accepter</button>
                                                        <div id="modifier_{{$form->id}}" class="collapse">
                                                    @csrf
                                                    <hr>
                                                        </tr>

                                             @endforeach
                                        </table>

                                 </div>
                                <br>
                                </center>
@endsection
