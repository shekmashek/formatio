
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(document).ready(function() {

        $('td input').bind('paste', null, function(e) {
            $txt = $(this);
            setTimeout(function() {

                var values = $txt.val().split(/\s+/);
                // var values = $txt.val().split(/\t+/);
                var currentRowIndex = $txt.parent().parent().index();
                var currentColIndex = $txt.parent().index();

                var totalRows = $('#example tbody tr').length;
                var totalCols = $('#example thead th').length;

                var count = 0;

                for (var j = currentRowIndex; j < totalRows; j++) {
                    for (var i = currentColIndex; i < totalCols; i++) {

                        var value = values[count];

                        var inp = $('#example tbody tr').eq(j).find('td').eq(i).find('input');

                        count += 1;
                        inp.val(value);
                    }
                }
            }, 0);
        });
    });



    function verify_data_duplicate(verifyData, table) {
        var result = 0;
        for (var i = 0; i < table.length; i += 1) {
            if (verifyData == table[i]) {
                result += 1;
            }
        }
        return result;
    }

    function getDataMatricule(matriculeTab) {
        var result = [];
        for (var i = 0; i < matriculeTab.length; i += 1) {
            var verify = matriculeTab[i];
            result[i] = verify_data_duplicate(verify, matriculeTab);
        }
        return result;
    }

    function verify_email(mail_val) {
        var str = mail_val.split('');
        var result = false;
        for (var i = 0; i < str.length; i += 1) {
            if (str[i] == '@') {
                result = true;

            } else {
                result = false;
            }
        }
        return result;
    }


    $(function() {
        for (let i = 1; i <= 30; i += 1) {
            $("input[name='cin_" + i + "']").on('input', function(e) {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
        }
    });

    /*================================ verify champ inscription =====================================*/

    $(document).ready(function() {

        $('#formInsert input').keyup(function() {
            $('#saver_multi_stg').prop('disabled', false);

            var mail_err = document.getElementsByName("email_err[]");
            for (let i = 1; i <= 30; i += 1) {

                if ($("#matricule_" + i).val() != null) {
                    var matricule = $("#matricule_" + i).val();
                    if ($("#matricule_" + i).val() != "" && $("#matricule_" + i).val().length < 1 && $("#email_" + i).val() != "") {
                        document.getElementById("matricule_err_" + i).innerHTML = 'invalid';
                    } else {
                        document.getElementById("matricule_err_" + i).innerHTML = '';

                    }

                    $.ajax({
                        url: "{{route('employes.export.verify_matricule_stg')}}"
                        , type: 'get'
                        , data: {
                            valiny: matricule
                        }
                        , success: function(response) {
                            var userData = response;
                            if (userData.length > 0) {
                                document.getElementById("matricule_err_" + i).innerHTML = 'matricule existe déjà';
                                $('#saver_multi_stg').prop('disabled', true);
                            } else {
                                document.getElementById("matricule_err_" + i).innerHTML = '';
                            }
                        }
                        , error: function(error) {
                            console.log(error);
                        }
                    });
                    /*=============*/
                    if ($("#email_" + i).val() != null) {
                        var email = $("#email_" + i).val();

                        if ($("#matricule_" + i).val() != null && $("#matricule_" + i).val() != "") {
                            if (email.indexOf('@') == -1) {
                                document.getElementById("email_err_" + i).innerHTML = 'E-mail invalid';
                                $('#saver_multi_stg').prop('disabled', true);

                            } else {
                                document.getElementById("email_err_" + i).innerHTML = '';
                            }
                        }

                        $.ajax({
                            url: "{{route('employes.export.verify_email_stg')}}"
                            , type: 'get'
                            , data: {
                                valiny: email
                            }
                            , success: function(response) {
                                var userData = response;
                                if (userData.length > 0) {
                                    document.getElementById("email_err_" + i).innerHTML = 'E-mail existe déjà';
                                    $('#saver_multi_stg').prop('disabled', true);

                                }
                            }
                            , error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                    /*=============*/
                    if ($("#cin_" + i).val() != null) {
                        var cin = $("#cin_" + i).val();
                        document.getElementById("cin_err_" + i).innerHTML = '';

                        $.ajax({
                            url: "{{route('employes.export.verify_cin_stg')}}"
                            , type: 'get'
                            , data: {
                                valiny: cin
                            }
                            , success: function(response) {
                                var userData = response;

                                if (userData.length > 0) {
                                    document.getElementById("cin_err_" + i).innerHTML = "CIN existe déjà";
                                    $('#saver_multi_stg').prop('disabled', true);


                                } else {
                                    document.getElementById("cin_err_" + i).innerHTML = '';
                                }
                            }
                            , error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                }




            }
        });


    });

</script>