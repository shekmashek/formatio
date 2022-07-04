
<div class="row">
    @canany(['isCFP','isFormateur'])
        <nav class="d-flex justify-content-between mb-1 " style="border-bottom: 1px solid black; line-height: 20px">
            <span class="titre_detail_session"><strong style="font-size: 14px">Choisissez le(s) fichier(s) pour cette session</strong></span>
        </nav>
        <div class="col-12 d-flex flex-wrap">
            <form action="{{ route('save_documents') }}" method="post">
                @csrf
                <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
                <div class="d-flex flex-row">
                    @foreach ($documents as $docs)
                        <div class="form-check me-5">
                            <input class="form-check-input" type="checkbox" name="path[]" value="{{ $docs['path'] }}"
                                id="flexCheckDefault">
                            <input type="hidden" name="nom_doc[]" value="{{ $docs['filename'] }}">
                            <input type="hidden" name="extension[]" value="{{ $docs['extension'] }}">

                            <label class="form-check-label" for="flexCheckDefault">
                                <span>
                                    {{ $docs['filename'] . '.' . $docs['extension'] }} </a> </span>
                            </label>
                        </div>
                    @endforeach
                </div>
                @if (count($documents) > 0)
                <button type="submit" class="btn btn_enregistrer py-1"><i class="bx bx-check me-1"></i> Enregistrer</button>
                @endif

            </form>
        </div>
    @endcanany
    @canany(['isReferent','isManager'])
        <nav class="d-flex justify-content-between mb-1 " style="border-bottom: 1px solid black; line-height: 20px">
            <span class="titre_detail_session"><strong style="font-size: 14px">Les documents pour la session</strong></span>
        </nav>
        <div class="col-12 d-flex flex-wrap">
            <div class="d-flex flex-row">
                @foreach ($documents as $docs)
                    <div class="form-check me-5">
                        <span><i class="fa fa-file-download"></i>&nbsp; <a href="{{route('telecharger_fichier',['cfp'=>$projet[0]->nom_cfp,'filename'=>$docs->nom_doc,'extension'=>$docs->extension])}}"> {{$docs->nom_doc.'.'.$docs->extension}} </a> </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endcanany

</div>
