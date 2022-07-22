@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">@lang('translation.Résultat')</h3>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h4 class="h4">@lang('translation.Résultat') @lang('translation.du') @lang('translation.filtre')</h4>
            </div>
            <div class="col-md-2">
                <a href="{{ route('employes') }}" class="btn btn-success btn-sm" style="width: 120px; background-color: #7635dc">@lang('translation.Précedent')</a>
            </div>
        </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>@lang('translation.Image')</th>
                <th>@lang('translation.Matricule')</th>
                <th>@lang('translation.Nom')</th>
                <th>@lang('translation.Prénom')</th>
                <th>@lang('translation.Fonction')</th>
                <th>@lang('translation.E-mail')</th>
                <th>@lang('translation.Téléphone')</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @forelse ($emps as $v)
                <tr>
                    <td>
                        @if($v->photos == null)
                        <center>
                            <p class="randomColor text-center"
                                style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;">
                                <span class=""
                                    style="position:relative; top: .9rem;"><b>{{$v->nom_stagiaire}}{{$v->prenom_stagiaire}}</b></span>
                            </p>
                        </center>
                        @else
                        <a href="{{asset('images/stagiaires/'.$v->photos)}}"><img
                                title="clicker pour voir l'image"
                                src="{{asset('images/stagiaires/'.$v->photos)}}"
                                style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                        {{-- <img src="/stagiaire-image/{{$stagiaires[$i]->photos}}" width="50"
                            height="50">
                        </td> --}}
                        @endif
                    </td>
                    <td>{{ $v->matricule }}</td>
                    <td>{{ $v->nom_stagiaire }}</td>
                    <td>{{ $v->prenom_stagiaire }}</td>
                    <td>{{ $v->fonction_stagiaire }}</td>
                    <td>{{ $v->mail_stagiaire }}</td>
                    <td>{{ $v->telephone_stagiaire }}</td>

                </tr>
            @empty
                <tr>
                    <td class="alert alert-danger" colspan="7">
                        @lang('translation.Aucun') @lang('translation.Résultat') @lang('translation.trouvé')
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <ul>

    </ul>

    </div>

@endsection
