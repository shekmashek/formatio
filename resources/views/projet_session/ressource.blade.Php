<nav class="d-flex justify-content-between mb-1 ">
    <span class="titre_detail_session"><strong style="font-size: 14px">Gestion des resources pour la session</strong></span>
</nav>
<div class="mb-3 pe-5 ps-1 col-12 pb-5">
    <div class="row mt-0" style="border-bottom: 1px solid black; line-height: 20px">
        <div class="col-md-3">
            <span>
                <h6>Matériel nécessaire</h6>
            </span>
        </div>
        <div class="col-md-2 p-0">
            <span>
                <h6>Demandé(e) par </h6>
            </span>
        </div>
        <div class="col-md-2 p-0">
            <span>
                <h6>Pris en charge par </h6>
            </span>
        </div>
        <div class="col-md-3 p-0">
            <span>
                <h6>Note </h6>
            </span>
        </div>
    </div>
    <div class="row mt-0 align-content-center">
        <div id="affiche_ressource">
            @foreach ($ressource as $r)
                <div class="d-flex mt-1" id="ressource_{{ $r->id }}"
                    >
                    <div class="col-md-3">
                        <section>
                            <i class="far fa-check-circle"></i>&nbsp; {{ $r->description }}
                        </section>
                    </div>
                    <div class="col-md-2">
                        <section>
                            {{ $r->demandeur }}
                        </section>
                    </div>
                    <div class="col-md-2">
                        <section>
                            {{ $r->pris_en_charge }}
                        </section>
                    </div>
                    <div class="col-md-3">
                        <section>
                            {{ $r->note }}
                        </section>
                    </div>
                    <div class="col-md-2 text-center">
                        <section>
                            <button type="button" class="supprimer_ressource" data-id="{{ $r->id }}"><i
                                    class="bx bx-trash bx_supprimer" style="font-size: 1.1rem !important;"></i></button>
                        </section>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-3">
        <h6 class="p-0 ms-3">Ajouter une autre ressource </h6>
        <section class="row px-3">
            <div class="col-md-4  py-0 px-1">
                <label for="" class="ps-2"> Description </label>
            </div>
            <div class="col-md-3  py-0 px-1">
                <label for="" class="ps-2"> Pris en charge </label>
            </div>
            <div class="col-md-4  py-0 px-1">
                <label for="" class="ps-2"> Note </label>
            </div>

        </section>
        <form action="">
            <section class="row px-2 ms-0">
                <div class="col-md-4  py-0 px-1">
                    <input type="text" id="description_ressource" class="form-control ajout_form" placeholder="Description" required>
                </div>
                <div class="col-md-3  py-0 px-1">
                    <select class="form-select ajout_form" name="pris_en_charge" id="pris_en_charge" aria-label="Default select example">
                        <option value="">Choisissez le responsable</option>
                        <option value="Organisme de formation">Organisme de formation</option>
                        <option value="Entreprise">Entreprise</option>
                        <option value="Stagiaire">Stagiaire</option>
                    </select>
                </div>
                <div class="col-md-5  py-0 px-1">
                    <input type="text" id="note" class="form-control ajout_form" placeholder="Votre note" required>
                </div>
                <div class="col-md-1 p-0 ms-1">
                    <button type="button" id="ajouter_ressource" class="btn btn_nouveau"><i class="bx bx-plus-medical me-1"> </i>Ajouter </button>
                </div>
            </section>
        </form>
    </div>
</div>
{{-- @endif --}}
<style>
    .ajout_form:focus {
        outline: none;
        box-shadow: none;
        transition: all 0.2ms ease-in;
        /* box-shadow: 2px solid rgb(130,33,100); */
    }

    .btn-ajout {
        border: 2px solid rgb(130, 33, 100);
        border-radius: 1rem;
        padding: 0 6px;
        color: rgb(130, 33, 100);
        height: auto;
    }

</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $("#ajouter_ressource").on('click', function(e) {
        var ressource = $("#description_ressource").val();
        if (ressource === '') {
            return false;
        }
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        var pris_en_charge = $("#pris_en_charge").val();
        var note = $("#note").val();
        if (note === '') {
            note = '--';
        }
        if (pris_en_charge === '') {
            return false;
        }
        $.ajax({
            type: "GET",
            url: "{{ route('add_ressource') }}",
            data: {
                ressource: ressource,
                groupe: groupe_id,
                pris_en_charge : pris_en_charge,
                note : note
            },
            dataType: "html",
            success: function(response) {
                var userData = JSON.parse(response);
                $('#affiche_ressource').empty();
                $("#description_ressource").val('');
                var html = '';
                for (var i = 0; i < userData.length; i++) {
                    html += '<div class="d-flex mt-1 " id="ressource_' + userData[i].id + '">';

                    html += '<div class="col-md-3">';
                    html += '<section>';
                    html += '<i class="far fa-check-circle"></i>&nbsp;' + userData[i].description;
                    html += '</section>';
                    html += '</div>';

                    html += '<div class="col-md-2">';
                    html += '<section>';
                    html += userData[i].demandeur;
                    html += '</section>';
                    html += '</div>';
                    
                    html += '<div class="col-md-2">';
                    html += '<section>';
                    html += userData[i].pris_en_charge;
                    html += '</section>';
                    html += '</div>';

                    html += '<div class="col-md-3">';
                    html += '<section>';
                    html += userData[i].note;
                    html += '</section>';
                    html += '</div>';

                    html += '<div class="col-md-2 text-center">';
                    html += '<section>';
                    html += '<button type="button" class="supprimer_ressource" data-id="' +
                        userData[i].id + '"><i class="bx bx-trash bx_supprimer" style="font-size: 1.1rem !important;"></i></button>';
                    html += '</section>';
                    html += '</div>';

                    html += '';
                    html += '</div>';
                }
                $('#affiche_ressource').append(html);

            },
            error: function(error) {
                console.log(error)
            }
        });
    });

    $(".supprimer_ressource").on('click', function(e) {
        // var id = e.target.id;
        var id = $(this).data("id");
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        $.ajax({
            type: "GET",
            url: "{{ route('supprimer_ressource') }}",
            data: {
                Id: id,
                groupe: groupe_id
            },
            success: function(response) {
                if (response.success) {
                    var row = document.getElementById("ressource_" + id);
                    row.parentNode.removeChild(row);
                } else {
                    alert("Error")
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
</script>
