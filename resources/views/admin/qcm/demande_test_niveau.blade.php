@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Aptitudes</p>
@endsection
@section('content')
<div class="page-wrapper">
    <div class="container bg-light">
        <div class="row g-0 align-items-center justify-content-center">
            <div class="col-lg-8">
                <h1>Demande de Test de niveau</h1>
                <form class="form-control" action="{{route('inserer_demande')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="py-2">
                        <label for="cfp" class="form-label">Centre de Formation</label>
                        <select class="form-select" id="centre_formation" name="centre" aria-label="centre" required>
                            <option value="">Choisissez une centre de formation...</option>
                            @foreach ($centre as $ctr)
                                <option value="{{$ctr->id}}">{{$ctr->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="py-2">
                        <label for="formation" class="form-label">Formation</label>
                        <select class="form-select" id="formations" name="formation" aria-label="centre" required>
                            @foreach ($formation as $frm)
                                <option value="{{$frm->id}}">{{$frm->nom_formation}}</option>
                            @endforeach
                        </select>
                    </div>
                    @canany(['isSuperAdmin','isAdmin'])
                    <div class="py-2">
                        <label for="cfp" class="form-label">Entreprise</label>
                        <select class="form-select" name="entreprise" aria-label="centre" required>
                            @foreach ($entreprises as $etp)
                                <option value="{{$etp->id}}">{{$etp->nom_etp}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endcanany
                    <div class="py-2">
                        <label for="cfp" class="form-label">Description de la demande</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="py-2" align="center">
                        <input type="submit" name="button" id="btn-soumettre" value="Soumettre" class="btn btn-warning text-white bouton">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $('#centre_formation').on('change', function(){
        $('#formations').empty();

        var id = $(this).val();
        $.ajax({
            url:'{{ route("formationCFP") }}',
            type:'get',
            data:{Id:id},
            success:function(response){
                var centerData=response;
                for (var $i = 0; $i < centerData.length; $i++) {
                    $('#formations').append('<option value="'+centerData[$i].id+'">'+centerData[$i].nom_formation+'</option>');
                }
            },
            error:function(error){
                  console.log(error);
            }
        });
    });
</script>

@endsection
