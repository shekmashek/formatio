<form action="">
    <div class="shadow mb-3 col-12 pb-5">
        <div class="row">
            <div class="col-md-3">
                <div class="frais_annexe">
                    Frais de déplacement
                </div>
            </div>
            <div class="col-md-9">
                <ul>
                    <li><input type="text" class="text-end" placeholder="0 ">&nbsp; Ar </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="frais_annexe">Hébergement</div>
            </div>
            <div class="col-md-9">
                <ul>
                    <li><input type="text" class="text-end" placeholder="0 ">&nbsp; Ar </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="frais_annexe">Restauration</div>
            </div>
            <div class="col-md-9">
                <ul>
                    <li><input type="text" class="text-end" placeholder="0 ">&nbsp; Ar </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="frais_annexe">Location de salle</div>
            </div>
            <div class="col-md-9">
                <ul>
                    <li><input type="text" class="text-end" placeholder="0 ">&nbsp; Ar </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="frais_annexe">Location matérielle</div>
            </div>
            <div class="col-md-9">
                <ul>
                    <li><input type="text" class="text-end" placeholder="0 ">&nbsp; Ar </li>
                </ul>
            </div>
        </div>
        <div id="newRow_frais">

        </div>
        <div class="row">
            <div class="col-md-3">
                <button type="button" id="addRow_frais"> Autre(s) <i class="fa fa-plus-circle"></i> </a>
            </div>
            <div class="col-md-9"></div>
        </div>


        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <input type="text" class="input_total_frais text-end pe-2" placeholder="0" disabled> <span>Total</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 align-items-center">
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </div>
    </div>
</form>
<style>
    ul {
        padding: 0 !important;
    }

    .frais_annexe {
        margin-top: .6rem;
    }

    .ajout_frais_annexe {
        border: 1px solid rgb(130, 33, 100);
        border-radius: 1rem;
        align-content: center;
        align-items: center;
    }

    .input_total_frais {
        background-color: #DADADA;
        border-radius: 1rem;
        border: none;
    }

    .test {
        height: 23.42px !important;
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).on('click', '#removeRow_frais', function() {
        $(this).closest('#inputFormRow_frais').remove();
    });

    $(document).on('click', '#addRow_frais', function() {
        $.ajax({

            success: function(response) {
                var userData = response;
                var html = '';
                html += '<div class="row" id="inputFormRow_frais">';
                html += '<div class="col-md-3">';
                html += '<input type="text" class="w-100 pe-2" required>';
                html += '</div>';
                html += '<div class="col-md-9">';
                html += '<ul>';
                html +=
                    '<li><input type="number" class="text-end test" placeholder="0 " required>&nbsp; Ar &nbsp; &nbsp; &nbsp;<button><i id="removeRow_frais" class="fal fa-minus-circle mx-5 mt-2"></i> </button></li>';
                html += '</ul>';
                html += '</div>';
                html += '</div>';

                $('#newRow_frais').append(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
