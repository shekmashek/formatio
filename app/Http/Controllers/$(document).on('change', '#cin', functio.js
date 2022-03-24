$(document).on('change', '#cin', function() {
    document.getElementById("cin_err").innerHTML = "";

    var result = $(this).val();
   if ($(this).val().length > 12 || $(this).val().length < 12) {
        document.getElementById("cin_err").innerHTML = "Le CIN est invalid";

    } else {
        document.getElementById("cin_err").innerHTML = "";
        $.ajax({
            url: '{{route("verify_cin_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("cin_err").innerHTML = "CIN appartient déjà par un autre utilisateur";
                } else {
                    document.getElementById("cin_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    }
});

$(document).on('change', '#mail', function() {
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
                document.getElementById("mail_err").innerHTML = "mail existe déjà";
            } else {
                document.getElementById("mail_err").innerHTML = "";
            }
        }
        , error: function(error) {
            console.log(error);
        }
    });
});

$(document).on('change', '#phone', function() {
    var result = $(this).val();

    if ($(this).val().length > 13 || $(this).val().length < 10) {
        document.getElementById("phone_err").innerHTML = "le numéro du télephone n'est pas correct";
    } else {
        document.getElementById("phone_err").innerHTML = '';
        $.ajax({
            url: '{{route("verify_tel_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("phone_err").innerHTML = "le numéro du télephone existe déjà";
                } else {
                    document.getElementById("phone_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    }


});
