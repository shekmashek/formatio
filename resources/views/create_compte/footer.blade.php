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

    $(document).on('change', '#cin_resp_cfp', function() {
        var result = $(this).val();
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
    });

    $(document).on('change', '#email_resp_cfp', function() {
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
                    document.getElementById("email_resp_cfp_err").innerHTML = "mail existe déjà";
                } else {
                    document.getElementById("email_resp_cfp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('change', '#tel_resp_cfp', function() {
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
                    document.getElementById("tel_resp_cfp_err").innerHTML = "Télephone existes déjà";
                } else {
                    document.getElementById("tel_resp_cfp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('change', '#nif_cfp', function() {
        var nif = $(this).val();
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
    });


    /*================= entreprise =====================*/

    $(document).on('change', '#cin_resp_etp', function() {
        var result = $(this).val();
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

    $(document).on('change', '#tel_resp_etp', function() {
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
