<div>
    <h6>Choisissez le(s) fichier(s) pour la session</h6>
    <form action="{{ route('save_documents') }}" method="post">
        @csrf
        @foreach ($documents as $docs)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="path[]" value="{{ $docs['path'] }}" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">
                    <span><i class="fa fa-file-download"></i>&nbsp;  {{$docs['filename'].'.'.$docs['extension']}} </a> </span>  
                </label>
            </div> 
    @endforeach
    <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>