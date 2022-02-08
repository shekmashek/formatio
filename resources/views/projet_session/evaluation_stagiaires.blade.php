<div class="row d-flex text-center">
    @if ($evaluation_apres == NULL || $evaluation_apres == 0)
        <div class="d-grid gap-2 col-6 mx-auto">
            @if ($evaluation_avant == null)
                <Label style="font: 14px">Pré evaluation</Label>
            @else
                <Label style="font: 14px">Evaluation des stagiaires</Label>
            @endif   
        </div>
        @if ($evaluation_avant == null)
            <form action="{{ route('insert_evaluation_stagiaire') }}" method="POST">
        @else
            <form action="{{ route('insert_evaluation_stagiaire_apres') }}" method="POST">
        @endif
            @csrf
            <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}"> 
            <input type="hidden" name="module" value="{{ $projet[0]->module_id }}"> 
            <div class="col-md-12 d-flex justify-content-around">
                <table class="table" >
                    <thead>
                    <tr style="border: 0">
                        <th></th>
                        @foreach ($competences as $cp)
                            <th align="center">{{ $cp->titre_competence }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($stagiaire as $stg)
                            <tr>
                                <td class="text-start"><input type="hidden" value="{{ $stg->stagiaire_id }}" name="stagiaire[{{ $stg->stagiaire_id }}]">{{ $stg->nom_stagiaire.' '.$stg->prenom_stagiaire }}</td>
                                @for ($i = 0; $i < count($competences); $i++)
                                    <td class="text-center"><input class="p-0 m-0" style="height: 1.563rem; width: 9rem;" type="number" min="1" max="10" placeholder="notes" name="note[{{ $stg->stagiaire_id }}][{{ $competences[$i]->id }}]" required></td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-success" type="submit">Sauvegarder</button>
            </div>
        </form>
    @else
        Eto ny radar!!!
    @endif
    
</div>