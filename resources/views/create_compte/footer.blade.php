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


    $(function() {
        $("input[name='cin_resp_etp']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
        $("input[name='cin_resp_cfp']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
        $("input[name='val_robot']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });


    $(document).ready(function() {

        $('#suivant_etp_1').prop('disabled', true);
        document.getElementById("nif_etp_err").innerHTML = "NIF incomplète!";
        document.getElementById("matricule_resp_etp_err").innerHTML = "Matricule ne doit pas être null!";
        $('#suivant_etp_confirmer').prop('disabled', true);

        // ========= field N°1 et N°2 pour entreprise inscription =================================

        $('.field-etp input').change(function() {

            if (document.getElementById("name_etp_err").innerHTML == '' &&
                document.getElementById("nif_etp_err").innerHTML == '') {
                $('#suivant_etp_1').prop('disabled', false);
            } else {
                $('#suivant_etp_1').prop('disabled', true);
            }

        });
        $('.field2-etp input').change(function() {
            if ($('#nom_resp_etp').val().length > 1 &&
                $('#cin_resp_etp').val().length > 4 &&
                $('#matricule_resp_etp').val().length > 1 &&
                $('#email_resp_etp').val().length > 5 &&
                $('#val_robot').val().length > 0) {

                if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                    document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                    document.getElementById("matricule_resp_etp_err").innerHTML == '' &&
                    document.getElementById("email_resp_etp_err").innerHTML == '') {
                    $('#suivant_etp_confirmer').prop('disabled', false);
                } else {
                    $('#suivant_etp_confirmer').prop('disabled', true);
                }
            }
        });

    });

    $(document).ready(function() {

        $('#suivant_of_1').prop('disabled', true);
        document.getElementById("nif_cfp_err").innerHTML = "NIF incomplète!";
        $('#suivant_of_confirmer').prop('disabled', true);

        $('.field-cfp input').change(function() {
            if ($("#name_cfp_err").html() == '' &&
                $("#nif_cfp_err").html() == '') {
                $('#suivant_of_1').prop('disabled', false);
            } else {
                $('#suivant_of_1').prop('disabled', true);
            }
        });

        $('.field2-cfp input').change(function() {
            if ($('#nom_resp_cfp').val().length > 1 &&
                $('#cin_resp_cfp').val().length > 4 &&
                $('#email_resp_cfp').val().length > 5 &&
                $('#value_confident').val() == 1 &&
                $('#val_robot').val().length > 0) {

                if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                    document.getElementById("cin_resp_cfp_err").innerHTML == '' &&
                    document.getElementById("email_resp_cfp_err").innerHTML == '') {
                    $('#suivant_of_confirmer').prop('disabled', false);

                } else {
                    $('#suivant_of_confirmer').prop('disabled', true);

                }
            }
        });

    });


    /*-----------------------------------------------*/

    $(document).on('keyup change', '#name_cfp', function() {
        var result = $(this).val();
        if (result.length < 2) {
            document.getElementById("name_cfp_err").innerHTML = "Veuillez indqué votre Raison sociale";

            if ($("#nif_cfp_err").html() == '') {
                $('#suivant_of_1').prop('disabled', false);
            } else {
                $('#suivant_of_1').prop('disabled', true);
            }

        } else {
            document.getElementById("name_cfp_err").innerHTML = "";

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

                        if ($("#nif_cfp_err").html() == '') {
                            $('#suivant_of_1').prop('disabled', false);
                        } else {
                            $('#suivant_of_1').prop('disabled', true);
                        }
                    } else {
                        document.getElementById("name_cfp_err").innerHTML = "";

                        if ($("#nif_cfp_err").html() == '') {
                            $('#suivant_of_1').prop('disabled', false);
                        } else {
                            $('#suivant_of_1').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    /*-----------------------------------------------*/

   $(document).on('keyup change', '#logo_cfp', function() {
        var test = $(this).val().split('.').pop();
        document.getElementById("error_logo_cfp").innerHTML = '';

        if ("" + test == "jpg" || "" + test == "jpeg" || "" + test == "png") {
            /**60 000*/
            if (this.files[0].size > 1692728) {
                document.getElementById("error_logo_cfp").innerHTML = "la taille de votre logo ne doit pas dépassé 1.7 MB";

                if ($("#name_cfp_err").html() == '' &&
                    $("#nif_cfp_err").html() == '') {
                    $('#suivant_of_1').prop('disabled', false);
                } else {
                    $('#suivant_of_1').prop('disabled', true);
                }
            } else {
                document.getElementById("error_logo_cfp").innerHTML = '';

                if ($("#name_cfp_err").html() == '' &&
                    $("#nif_cfp_err").html() == '') {
                    $('#suivant_of_1').prop('disabled', false);
                } else {
                    $('#suivant_of_1').prop('disabled', true);
                }
            }
        } else {
            document.getElementById("error_logo_cfp").innerHTML = "les extension de type *.jpg, *.png et *.jpeg seulement sont autorisé";

            if ($("#name_cfp_err").html() == '' &&
                $("#nif_cfp_err").html() == '') {
                $('#suivant_of_1').prop('disabled', false);
            } else {
                $('#suivant_of_1').prop('disabled', true);
            }
        }
    });

    /*-----------------------------------------------*/

    $(document).on('keyup change', '#nif_cfp', function() {
        var nif = $(this).val();
        if ($('#nif_cfp').val().length < 7) {
            document.getElementById("nif_cfp_err").innerHTML = "NIF incomplète!";

            if (document.getElementById("name_cfp_err").innerHTML == '') {
                $('#suivant_of_1').prop('disabled', false);
            } else {
                $('#suivant_of_1').prop('disabled', true);
            }

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

                        if ($("#name_cfp_err").html() == '') {
                            $('#suivant_of_1').prop('disabled', false);
                        } else {
                            $('#suivant_of_1').prop('disabled', true);
                        }

                    } else {
                        document.getElementById("nif_cfp_err").innerHTML = "";

                        if ($("#name_cfp_err").html() == '') {
                            $('#suivant_of_1').prop('disabled', false);
                        } else {
                            $('#suivant_of_1').prop('disabled', true);
                        }

                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });


    /*-----------------------------------------------*/

    $(document).on('keyup change', '#cin_resp_cfp', function() {
        var result = $(this).val();
        document.getElementById("cin_resp_cfp_err").innerHTML = "";


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

                    if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                        document.getElementById("email_resp_cfp_err").innerHTML == '') {
                        $('#suivant_of_confirmer').prop('disabled', false);
                    } else {
                        $('#suivant_of_confirmer').prop('disabled', true);
                    }
                } else {
                    document.getElementById("cin_resp_cfp_err").innerHTML = "";

                    if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                        document.getElementById("email_resp_cfp_err").innerHTML == '') {
                        $('#suivant_of_confirmer').prop('disabled', false);
                    } else {
                        $('#suivant_of_confirmer').prop('disabled', true);
                    }
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });


    });
    /*-----------------------------------------------*/
    $(document).on('keyup change', '#email_resp_cfp', function() {
        var result = $(this).val();
        if (result.length < 3) {
            document.getElementById("email_resp_cfp_err").innerHTML = "mail invalide !";

            if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                document.getElementById("cin_resp_cfp_err").innerHTML == '') {
                $('#suivant_of_confirmer').prop('disabled', false);
            } else {
                $('#suivant_of_confirmer').prop('disabled', true);
            }

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

                        if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                            document.getElementById("cin_resp_cfp_err").innerHTML == '') {
                            $('#suivant_of_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_of_confirmer').prop('disabled', true);
                        }

                    } else {
                        document.getElementById("email_resp_cfp_err").innerHTML = "";

                        if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                            document.getElementById("cin_resp_cfp_err").innerHTML == '') {
                            $('#suivant_of_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_of_confirmer').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });

        }

    });



    /*================= entreprise =====================*/


    /*-------------------------------------------------------------------------------------*/
    $(document).on('keyup change', '#name_etp', function() {
        var result = $(this).val();
        if (result.length < 2) {
            document.getElementById("name_etp_err").innerHTML = "Veuillez indqué votre Raison sociale";

            if (document.getElementById("nif_etp_err").innerHTML == '') {
                $('#suivant_etp_1').prop('disabled', false);
            } else {
                $('#suivant_etp_1').prop('disabled', true);
            }

        } else {
            document.getElementById("name_etp_err").innerHTML = "";


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

                        if (document.getElementById("nif_etp_err").innerHTML == '') {
                            $('#suivant_etp_1').prop('disabled', false);
                        } else {
                            $('#suivant_etp_1').prop('disabled', true);
                        }
                    } else {
                        document.getElementById("name_etp_err").innerHTML = "";

                        if (document.getElementById("nif_etp_err").innerHTML == '') {
                            $('#suivant_etp_1').prop('disabled', false);
                        } else {
                            $('#suivant_etp_1').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    /*-------------------------------------------------------------------*/
   $(document).on('keyup change', '#logo_etp', function() {
        var test = $(this).val().split('.').pop();
        document.getElementById("error_logo_etp").innerHTML = '';

        if ("" + test == "jpg" || "" + test == "jpeg" || "" + test == "png") {
            if (this.files[0].size > 1692728) {
                document.getElementById("error_logo_etp").innerHTML = "la taille de votre logo ne doit pas dépassé 1.7 MB";

                if (document.getElementById("name_etp_err").innerHTML == '' &&
                    document.getElementById("nif_etp_err").innerHTML == '') {
                    $('#suivant_etp_1').prop('disabled', false);
                } else {
                    $('#suivant_etp_1').prop('disabled', true);
                }

            } else {
                document.getElementById("error_logo_etp").innerHTML = '';

                if (document.getElementById("name_etp_err").innerHTML == '' &&
                    document.getElementById("nif_etp_err").innerHTML == '') {
                    $('#suivant_etp_1').prop('disabled', false);
                } else {
                    $('#suivant_etp_1').prop('disabled', true);
                }
            }
        } else {
            document.getElementById("error_logo_etp").innerHTML = "les extension de type *.jpg, *.png et *.jpeg seulement sont autorisé";

            if (document.getElementById("name_etp_err").innerHTML == '' &&
                document.getElementById("nif_etp_err").innerHTML == '') {
                $('#suivant_etp_1').prop('disabled', false);
            } else {
                $('#suivant_etp_1').prop('disabled', true);
            }
        }
    });


    /*-----------------------------------------------------------------------*/
    $(document).on('keyup change', '#nif_etp', function() {
        var nif = $(this).val();

        if (nif.length < 7) {
            document.getElementById("nif_etp_err").innerHTML = "NIF incomplète!";

            if (document.getElementById("name_etp_err").innerHTML == '') {
                $('#suivant_etp_1').prop('disabled', false);
            } else {
                $('#suivant_etp_1').prop('disabled', true);
            }

        } else {
            document.getElementById("nif_etp_err").innerHTML = "";

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

                        if (document.getElementById("name_etp_err").innerHTML == '') {
                            $('#suivant_etp_1').prop('disabled', false);
                        } else {
                            $('#suivant_etp_1').prop('disabled', true);
                        }
                    } else {
                        document.getElementById("nif_etp_err").innerHTML = "";

                        if (document.getElementById("name_etp_err").innerHTML == '') {
                            $('#suivant_etp_1').prop('disabled', false);
                        } else {
                            $('#suivant_etp_1').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    /*--------------------------------------------------------------------*/

    $(document).on('keyup change', '#matricule_resp_etp', function() {
        var result = $(this).val();
        if (result.length < 1) {
            document.getElementById("matricule_resp_etp_err").innerHTML = "Matricule ne doit pas être null";

            if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                document.getElementById("email_resp_etp_err").innerHTML == '') {
                $('#suivant_etp_confirmer').prop('disabled', false);
            } else {
                $('#suivant_etp_confirmer').prop('disabled', true);
            }

        } else {
            document.getElementById("matricule_resp_etp_err").innerHTML = "";

            if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                document.getElementById("email_resp_etp_err").innerHTML == '') {
                $('#suivant_etp_confirmer').prop('disabled', false);
            } else {
                $('#suivant_etp_confirmer').prop('disabled', true);
            }

        }
    });

    /*--------------------------------------------------------------------*/

    $(document).on('keyup change', '#cin_resp_etp', function() {
        var result = $(this).val();
        document.getElementById("cin_resp_etp_err").innerHTML = "";

        if (result.length < 4) {
            document.getElementById("cin_resp_etp_err").innerHTML = "Le CIN est invalide";

            if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                document.getElementById("matricule_resp_etp_err").innerHTML == '' &&
                document.getElementById("email_resp_etp_err").innerHTML == '') {
                $('#suivant_etp_confirmer').prop('disabled', false);
            } else {
                $('#suivant_etp_confirmer').prop('disabled', true);
            }

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

                        if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                            document.getElementById("matricule_resp_etp_err").innerHTML == '' &&
                            document.getElementById("email_resp_etp_err").innerHTML == '') {
                            $('#suivant_etp_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_etp_confirmer').prop('disabled', true);
                        }
                    } else {
                        document.getElementById("cin_resp_etp_err").innerHTML = "";

                        if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                            document.getElementById("matricule_resp_etp_err").innerHTML == '' &&
                            document.getElementById("email_resp_etp_err").innerHTML == '') {
                            $('#suivant_etp_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_etp_confirmer').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }

    });
    /*--------------------------------------------------------------------*/

    $(document).on('keyup change', '#email_resp_etp', function() {
        var result = $(this).val();
        if (result.length < 3) {
            document.getElementById("email_resp_etp_err").innerHTML = "mail invalide !";

            if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                document.getElementById("matricule_resp_etp_err").innerHTML == '') {
                $('#suivant_etp_confirmer').prop('disabled', false);
            } else {
                $('#suivant_etp_confirmer').prop('disabled', true);
            }

        } else {
            document.getElementById("email_resp_etp_err").innerHTML = "";

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

                        if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                            document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                            document.getElementById("matricule_resp_etp_err").innerHTML == '') {
                            $('#suivant_etp_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_etp_confirmer').prop('disabled', true);
                        }

                    } else {
                        document.getElementById("email_resp_etp_err").innerHTML = "";

                        if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                            document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                            document.getElementById("matricule_resp_etp_err").innerHTML == '') {
                            $('#suivant_etp_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_etp_confirmer').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

</script>
</body>
</html>
