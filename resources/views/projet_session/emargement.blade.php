<style>
    #faire_presence:hover{
        cursor: pointer;
    }
</style>
<div class="container">
    <div class="row m-0">
        <div class="col-md-2 text-center">Module</div>
        <div class="col-md-4 text-center">Lieu</div>
        <div class="col-md-2 text-center">Date</div>
        <div class="col-md-1 text-center">Début</div>
        <div class="col-md-1 text-center">Fin</div>
        <div class="col-md-2 text-center">Action</div>
        <hr class="m-2 p-0">
    </div>
    @foreach ($datas as $dt)
    <div id="presence_stagiaire">
        <div class="row m-0 p-0">
            <div class="col-md-2 text-center">{{ $dt->nom_module }}</div>
            <div class="col-md-4 text-center">{{ $dt->lieu }}</div>
            <div class="col-md-2 text-center">{{ $dt->date_detail }}</div>
            <div class="col-md-1 text-center">{{ $dt->h_debut }}</div>
            <div class="col-md-1 text-center">{{ $dt->h_fin }}</div>
            <div class="col-md-2 text-center"><i id="faire_presence" data-toggle="collapse" href="#stagiaire_presence_{{ $dt->detail_id }}" class="fa fa-edit">Emargement</i></div>
        </div>
        <hr class="m-2 p-0">
        <div class="collapse" id="stagiaire_presence_{{ $dt->detail_id }}">
            <div class="row m-0 p-0">
            {{-- <form action="{{ route('insert_presence') }}" id="myform" method="post" role="form"> --}}
                @foreach ($stagiaire as $liste)
                        <div class="col-md-1 text-center">{{ $liste->matricule }}</div>
                        <div class="col-md-2 text-center">{{ $liste->nom_stagiaire }}</div>
                        <div class="col-md-2 text-center">{{ $liste->prenom_stagiaire }}</div>
                        {{-- <div class="col-md-1">
                        <input type="submit" class="btn btn-primary pointage" id = "{{$liste->stagiaire_id}}" value = "Pointage">
                    </div class="col-md-1"> --}}
                        <div class="col-md-2 text-center m-0">
                            <input type="text" class="m-0" name="h_entree" placeholder="Heure entrée" style="width: 150px" onfocus="(this.type='time')">
                        </div>
                        <div class="col-md-2 text-center m-0">
                            <input type="text" class="m-0" name="h_sortie" placeholder="Heure sortie" style="width: 150px" onfocus="(this.type='time')">
                        </div>
                        <div class="col-md-3 text-center">
                            {{-- @if ($message != '')
                        <label>{{ $liste->status }}</label>
                        @else --}}
                            @csrf
                            {{-- <div class="radio"> --}}
                            <label style="color: green;">
                                <input class="m-2" type="radio"
                                    name="attendance[{{ $liste->stagiaire_id }}]" value="Présent">
                                Présent
                            </label>
                            <label style="color: red;">
                                <input class="m-2" type="radio"
                                    name="attendance[{{ $liste->stagiaire_id }}]" value="Absent">
                                Absent
                            </label>
                            {{-- </div> --}}
                            {{-- @endif --}}
                        </div>
                    </tr>
                @endforeach

                <input type="hidden" name="detail_id" value="{{ $dt->detail_id }}">



                        {{-- </form> --}}
                   
                {{-- @if ($message == '')
                    <button class="btn btn-success form-control" form="myform"  name="add_attendance">Ajouter</button>
                @else
                    <a href="{{ route('modifier',[$datas[0]->detail_id]) }}"><button class="btn btn-primary form-control">Modifier</button></a>
                @endif --}}
            </div>
        </div>
    </div>
    @endforeach
</div>