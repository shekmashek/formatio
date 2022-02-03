
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    {{-- JQuery --}}
    <script src="{{asset('bootstrapCss/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('assets/js/boxicons.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/startmin.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('function js/programme/edit_programme.js') }}"></script>
    <script src="{{asset('js/qcmStep.js')}}"></script>

    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).on('change','#nif_cfp',function(){
var nif = $(this).val();
$.ajax({
            url:'{{route("verify_nif_cfp")}}',
            type:'get',
            data:{nif:nif },
            success:function(response){
                var userData=response;

                if(userData.length >0){
                    document.getElementById("nif_cfp_err").innerHTML = "NIF appartient déjà sur d'autre organisme de formation!";
                } else {
                    document.getElementById("nif_cfp_err").innerHTML = "";
                }

            },
            error:function(error){
                console.log(error);
            }
        });
});

        // ============ select type inscription cfp ou responsables
/*
        $(document).on('change', '#type_inscription', function() {
            var id = $(this).val();

            if (id == 1) { // ====== inscription de type CFP ou OF
                $('#changeCham').empty();
                $('#info_legale_cfp').empty();
                $('#info_nom_cfp').empty();

                var html3 = '';
                var html = '';
                var html2 = '';

                html3 += '<h3>Veuillez entrer le nom de votre organisation de formation</strong></h3>';
                html3 += '<label for="exampleFormControlInput1" class="form-label">Non<strong style="color:#ff0000;">*</strong></label>';
                html3 += '<input type="text" name="name_cfp" class="form-control" id="name_cfp_search" />';

                document.getElementById('phrase_inscription').innerHTML = 'Veuillez certifier vos domaine et information';


                html2 += '<label for="exampleFormControlInput1" class="form-label">NIF<strong style="color:#ff0000;">*</strong></label>';
                html2 += '<input type="text" name="nif" required class="form-control" id="name_entreprise" />';
                html2 += ' <label for="exampleFormControlInput1" required class="form-label">STAT<strong style="color:#ff0000;">*</strong></label>';
                html2 += '<input type="text" name="stat" required class="form-control" id="name_entreprise" />';
                html2 += ' <label for="exampleFormControlInput1" required class="form-label">RCS<strong style="color:#ff0000;">*</strong></label>';
                html2 += '<input type="text" name="rcs" required class="form-control" id="name_entreprise" />';
                html2 += '<label for="exampleFormControlInput1" required class="form-label">CIF<strong style="color:#ff0000;">*</strong></label>';
                html2 += '<input type="text" name="cif" required class="form-control" id="name_entreprise" />';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Domaine<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" required name="domaine_cfp" class="form-control" id="domaine_cfp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Lot<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="lot" class="form-control" id="lot" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Ville<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="ville" class="form-control" id="ville" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Région<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="region" class="form-control" id="region" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="email" required name="email_cfp" class="form-control" id="email_cfp" /></div>';


                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" max=10 required name="tel_cfp" class="form-control" id="tel_cfp"/></div>';
                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Web</label>';
                html += ' <input type="text"  name="web_cfp" class="form-control" id="web_cfp" /></div>';

                $('#info_nom_cfp').append(html3);
                $('#info_legale_cfp').append(html2);
                $('#changeCham').append(html);

            }

            if (id == 2) { // ====== inscription de type responsable de l'entreprise

                $('#changeCham').empty();
                $('#info_legale_cfp').empty();
                $('#info_nom_cfp').empty();

                document.getElementById('phrase_inscription').innerHTML = 'Veuillez certifier que vous etes le responsable de <strong id="name_entreprise_desc"></strong>';
                var html = '';
                var html3 = '';

                html3 += '<h3>Veuillez entrer le nom de votre entreprise</strong></h3>';
                html3 += '<label for="exampleFormControlInput1" class="form-label">Non<strong style="color:#ff0000;">*</strong></label>';
                html3 += '<input type="text" name="name_entreprise" class="form-control" id="name_entreprise_search" />';
                html3 += '<div id="teste_e"></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label " align="left">Non<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" required name="nom_resp" class="form-control" id="nom_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Prénom<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" required name="prenom_resp" class="form-control" id="prenom_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="function_resp" class="form-control" id="function_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="email" required name="email_resp" class="form-control" id="email_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" max=10 required name="tel_resp" class="form-control" id="tel_resp" /></div>';

                $('#info_nom_cfp').append(html3);
                $('#changeCham').append(html);
            }

        });
*/

        $(document).on('change', '#name_entreprise', function() {
            var id = $(this).val();
            // document.getElementById('name_entreprise_desc').value = id;
            document.getElementById('name_entreprise_desc').innerHTML = id;
            console.log(document.getElementById('name_entreprise_desc').value);
        });

        // ====== autoComplet Champs search nom entreprise

        $(document).ready(function() {


            $('#name_entreprise_search').autocomplete({


                source: function(request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , type: 'GET'
                        , url: "{{route('search_entreprise_referent')}}"
                        , data: {
                            search: request.term
                        }
                        , success: function(data) {
                            response(data);
                        }
                    });
                }
                , minlength: 1
                , autoFocus: true
                , select: function(e, ui) {
                    $('#name_entreprise_search').val(ui.item.nom_resp);
                }

            });


        });

    </script>



</body>
</html>