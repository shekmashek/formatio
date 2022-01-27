{{-- @if(count($stagiaire) == 0)
<h5>Précisez ici les exigeances matériels pour le projet</h5>
<section class="row px-3">
    <div class="col-md-4 p-0">
        <label for="" class="ps-2"> Titre </label>
        <input type="text" class="form-control ajout_form">
    </div>
    <div class="col-md-7  py-0 px-1">
        <label for="" class="ps-2"> Description </label>
        <input type="text" class="form-control ajout_form">
    </div>
    <div class="col-md-1 p-0">
        <label for="" class="ps-2">Action</label>
        <button class="btn-ajout mt-3"> Ajouter </button>
    </div>
</section> 
@endif  --}}
  
{{-- @if(count($stagiaire) != 0) --}}
  <div class="shadow mb-3 col-12 pb-5">
      @foreach ($ressource as $r)
          
      @endforeach
        <div class="row">
            <div class="col-md-6">
                <span> <h5>Matériel nécessaire</h5> </span>
                    <section>
                        <ul>
                            <li><i class="far fa-check-circle"></i>&nbsp; {{ $r->description }} </li>
                        </ul>
                    </section>
            </div>
            <div class="col-md-6">
                <span><h5>Demandé(e) par :</h5></span>
                    <section>
                        <ul>
                            <li>{{ $r->demandeur }}</li>
                        </ul>
                    </section>
            </div>
        </div><hr>
        <div >
            <h5>Autre(s)</h5>
            <section class="row px-3">
                <div class="col-md-4 p-0">
                    <label for="" class="ps-2"> Titre </label>
                </div>
                <div class="col-md-8  py-0 px-1">
                    <label for="" class="ps-2"> Description </label>
                </div>
            </section>
            <form action="">
                <section class="row px-3">
                    <div class="col-md-4 p-0">
                        <input type="text" class="form-control ajout_form">
                    </div>
                    <div class="col-md-7  py-0 px-1">
                        <input type="text" class="form-control ajout_form">
                    </div>
                    <div class="col-md-1 mt-3 p-0">
                        <button type="button" class="btn-ajout mb-1"> Ajouter </button>
                    </div>
                </section>
            </form>
        </div>
    </div>
{{-- @endif --}}
<style>
    .ajout_form:focus{
        outline: none;
        box-shadow: none;
        transition: all 0.2ms ease-in;
        /* box-shadow: 2px solid rgb(130,33,100); */
    }
    .btn-ajout{
        border: 2px solid rgb(130,33,100);
        border-radius: 1rem;
        padding: 0 6px;
        color: rgb(130,33,100);
        height: auto;
    }
</style>