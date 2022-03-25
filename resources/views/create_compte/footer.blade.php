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
<script src="{{asset('js/create_compte.js')}}"></script>

<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).on('change', '#name_entreprise', function() {
        var id = $(this).val();
        document.getElementById('name_entreprise_desc').innerHTML = id;
        console.log(document.getElementById('name_entreprise_desc').value);
    });


    $(document).ready(function() {

        $('.suivant_of_1').css('display', 'none');
       document.getElementById("nif_cfp_err").innerHTML = "NIF incomplète!";
     //  document.getElementById("email_resp_cfp_err").innerHTML = "email incomplète!";
     //   document.getElementById("tel_resp_cfp_err").innerHTML = "le numéro de votre télephone n'est pas correct";



        $('.suivant_of_confirmer').css('display', 'none');

   /*     document.getElementById("nif_etp_err").innerHTML = "NIF incomplète!";
        document.getElementById("fonction_resp_cfp_err").innerHTML = "fonction incomplète!";
*/

        $('.field input').keyup(function() {


            if ($('#name_cfp').val().length > 0 &&
                $('#nif_cfp').val().length > 0 &&
                $('#logo_cfp').val().length > 0) {

                if (document.getElementById("name_cfp_err").innerHTML == '' &&
                    document.getElementById("error_logo_cfp").innerHTML == '' &&
                    document.getElementById("nif_cfp_err").innerHTML == '') {
                    $('.suivant_of_1').css('display', 'block');
                } else {
                    $('.suivant_of_1').css('display', 'none');
                }
            }
        });

        $('.field2 input').keyup(function() {

        alert("nom: "+$('#nom_resp_cfp').val().length+" cin: "+$('#cin_resp_cfp').val().length + " fonction: "+$('#fonction_resp_cfp').val().length+ " email: "+$('#email_resp_cfp').val().length+" tel: "+$('#tel_resp_cfp').val().length);
   /*          if ($('#nom_resp_cfp').val().length > 0 &&
                $('#cin_resp_cfp').val().length > 0 &&
                $('#fonction_resp_cfp').val().length > 0 &&
                $('#email_resp_cfp').val().length > 0 &&
                $('#tel_resp_cfp').val().length > 0) {

                if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                    document.getElementById("cin_resp_cfp_err").innerHTML == '' &&
                    document.getElementById("fonction_resp_cfp_err").innerHTML == '' &&
                    document.getElementById("email_resp_cfp_err").innerHTML == '' &&
                    document.getElementById("tel_resp_cfp_err").innerHTML == '') {
                    $('.suivant_of_confirmer').css('display', 'block');
                } else {
                    $('.suivant_of_confirmer').css('display', 'none');
                }
            } */
        });


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

    /*-----------------------------------------------*/
    $(document).on('change', '#cin_resp_cfp', function() {
        var result = $(this).val();
        document.getElementById("cin_resp_cfp_err").innerHTML = "";

        if ($(this).val().length > 12 || $(this).val().length < 12) {
            document.getElementById("cin_resp_cfp_err").innerHTML = "Le CIN est invalid";
        } else {
            $.ajax({
                url: '{{route("verify_cin_user")}}'
                , type: 'get'
                , data: {
                    valiny: result
                }
                , success: function(response) {
                    var userData = response;

                    if (userData.length > 0) {
                        document.getElementById("cin_resp_cfp_err").innerHTML = "CIN appartient déjà par un autre utilisateur";
                    } else {
                        document.getElementById("cin_resp_cfp_err").innerHTML = "";
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }

    });

    $(document).on('change', '#email_resp_cfp', function() {
        var result = $(this).val();
        if(result.length<3){
            document.getElementById("email_resp_cfp_err").innerHTML = "mail invalide !";
        } else {
            document.getElementById("email_resp_cfp_err").innerHTML = "";

            $.ajax({
            url: '{{route("verify_mail_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("email_resp_cfp_err").innerHTML = "mail existe déjà";
                } else {
                    document.getElementById("email_resp_cfp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });

        }

    });

    $(document).on('change', '#fonction_resp_cfp', function() {
        var result = $(this).val();
        if(result.length<2){
            document.getElementById("fonction_resp_cfpp_err").innerHTML = "fonction invalide !";
        } else {
            document.getElementById("fonction_resp_cfpp_err").innerHTML = "";


        }

    });


    $(document).on('change', '#logo_cfp', function() {
        var test = $(this).val().split('.').pop();
        document.getElementById("error_logo_cfp").innerHTML = '';

        if ("" + test == "jpg" || "" + test == "jpeg" || "" + test == "png") {
            if (this.files[0].size > 6000) {
                document.getElementById("error_logo_cfp").innerHTML = "la taille de votre logo ne doit pas dépassé 60 Ko";
            } else {
                document.getElementById("error_logo_cfp").innerHTML = '';
            }
        } else {
            document.getElementById("error_logo_cfp").innerHTML = "les extension de type *.jpg, *.png et *.jpeg seulement sont autorisé";
        }
    });

    $(document).on('change', '#tel_resp_cfp', function() {
        if ($(this).val().length > 13 || $(this).val().length < 10) {
            document.getElementById("tel_resp_cfp_err").innerHTML = "le numéro de votre télephone n'est pas correct";
        } else {
            document.getElementById("tel_resp_cfp_err").innerHTML = '';
        }

    });



    $(document).on('change', '#nif_cfp', function() {
        var nif = $(this).val();
        if ($('#nif_cfp').val().length < 7) {
            document.getElementById("nif_cfp_err").innerHTML = "NIF incomplète!";
        } else {
            document.getElementById("nif_cfp_err").innerHTML = "";
            $.ajax({
                url: '{{route("verify_nif_cfp")}}'
                , type: 'get'
                , data: {
                    nif: nif
                }
                , success: function(response) {
                    var userData = response;

                    if (userData.length > 0) {
                        document.getElementById("nif_cfp_err").innerHTML = "NIF appartient déjà sur d'autre organisme de formation!";
                    } else {
                        document.getElementById("nif_cfp_err").innerHTML = "";
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }




    });


    /*================= entreprise =====================*/

    $(document).on('change', '#logo_etp', function() {
        var test = $(this).val().split('.').pop();
        document.getElementById("error_logo_etp").innerHTML = '';

        if ("" + test == "jpg" || "" + test == "jpeg" || "" + test == "png") {
            if (this.files[0].size > 6000) {
                document.getElementById("error_logo_etp").innerHTML = "la taille de votre logo ne doit pas dépassé 60 Ko";
            } else {
                document.getElementById("error_logo_etp").innerHTML = '';
            }
        } else {
            document.getElementById("error_logo_etp").innerHTML = "les extension de type *.jpg, *.png et *.jpeg seulement sont autorisé";
        }
    });

    $(document).on('change', '#tel_resp_etp', function() {
        if ($(this).val().length > 13 || $(this).val().length < 10) {
            document.getElementById("tel_resp_etp_err").innerHTML = "le numéro de votre télephone n'est pas correct";
        } else {
            document.getElementById("tel_resp_etp_err").innerHTML = '';
        }

    });

    $(document).on('change', '#cin_resp_etp', function() {
        var result = $(this).val();
        document.getElementById("cin_resp_etp_err").innerHTML = "";

        if ($(this).val().length > 12 || $(this).val().length < 12) {
            document.getElementById("cin_resp_etp_err").innerHTML = "Le CIN est invalid";
        } else {
            $.ajax({
                url: '{{route("verify_cin_user")}}'
                , type: 'get'
                , data: {
                    valiny: result
                }
                , success: function(response) {
                    var userData = response;
                    if (userData.length > 0) {
                        document.getElementById("cin_resp_etp_err").innerHTML = "CIN appartient déjà par un autre utilisateur";
                    } else {
                        document.getElementById("cin_resp_etp_err").innerHTML = "";
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }

    });

    $(document).on('change', '#email_resp_etp', function() {
        var result = $(this).val();
        $.ajax({
            url: '{{route("verify_mail_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;
                if (userData.length > 0) {
                    document.getElementById("email_resp_etp_err").innerHTML = "mail existe déjà";
                } else {
                    document.getElementById("email_resp_etp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    /*   $(document).on('change', '#tel_resp_etp', function() {
        var result = $(this).val();
        $.ajax({
            url: '{{route("verify_tel_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("tel_resp_etp_err").innerHTML = "Télephone existes déjà";
                } else {
                    document.getElementById("tel_resp_etp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });
*/

    $(document).on('change', '#nif_etp', function() {
        var nif = $(this).val();
        $.ajax({
            url: '{{route("verify_nif_etp")}}'
            , type: 'get'
            , data: {
                nif: nif
            }
            , success: function(response) {
                var userData = response;
                if (userData.length > 0) {
                    document.getElementById("nif_etp_err").innerHTML = "NIF appartient déjà sur d'autre entreprise!";
                } else {
                    document.getElementById("nif_etp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('change', '#name_entreprise', function() {
        var id = $(this).val();
        // document.getElementById('name_entreprise_desc').value = id;
        document.getElementById('name_entreprise_desc').innerHTML = id;
        console.log(document.getElementById('name_entreprise_desc').value);
    });

    // ====== recherche name cfp et entreprise
    $(document).on('change', '#name_cfp', function() {
        var result = $(this).val();

        $.ajax({
            url: '{{route("verify_name_cfp")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("name_cfp_err").innerHTML = "Entité existe déjà";
                } else {
                    document.getElementById("name_cfp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('change', '#name_etp', function() {
        var result = $(this).val();
        $.ajax({
            url: '{{route("verify_name_etp")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("name_etp_err").innerHTML = "Entité existe déjà";
                } else {
                    document.getElementById("name_etp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

</script>
</body>
</html>
