         // modal
            // var myModal = document.getElementById('form-ajout')
            // var myInput = document.getElementById('myInput')

            // myModal.addEventListener('shown.bs.modal', function() {
            //     myInput.focus()
            // })

            // dataTables
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    responsive: true,
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
                    },
                });

                new $.fn.dataTable.FixedHeader(table);
            });
            $(document).ready(function() {
                var table = $('#liste_referents').DataTable({
                    responsive: true,
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
                    },
                });

                new $.fn.dataTable.FixedHeader(table);
            });


            // changer le status de référent -> activer
            $(".activer_referent").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "employes.setReferent",
                    data: {
                        user_id: user_id,
                        emp_id: stg_id
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function(response) {
                        console.log(error);
                        console.log('erreur');
                    }
                });
            });

            // changer le status de référent à désactiver
            $(".desactiver_referent").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "employes.unsetReferent",
                    data: {
                        user_id: user_id,
                        emp_id: stg_id
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function(response) {
                        console.log(error);
                    }
                })
            })

            // desactiver/activer stagiaire
            $(".desactiver_stg").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('employes.liste.desactiver') }}",
                    data: {
                        user_id: user_id,
                        emp_id: stg_id
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });
            $(".activer_stg").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('employes.liste.activer') }}",
                    data: {
                        user_id: user_id,
                        emp_id: stg_id
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });

            // verification à l'ajout 


            // Valeur numerique cin/tel
            $(function() {
                $("input[name='phone']").on('input', function(e) {

                    //   bolck the input to accept only numbers     
                    this.value = this.value.replace(/[^+0-9]/g, '');

                    // $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
                $("input[name='cin']").on('input', function(e) {
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
            });


            $(document).on('change', '#cin', function() {
                document.getElementById("cin_err").innerHTML = "";

                var result = $(this).val();
                if ($(this).val().length < 5) {
                    console.log('cin trop court');
                    document.getElementById("cin_err").innerHTML = "n°CIN invalid";

                } else {
                    document.getElementById("cin_err").innerHTML = "";
                    $.ajax({
                        url: '{{ route('verify_cin_user') }}',
                        type: 'get',
                        data: {
                            valiny: result
                        },
                        success: function(response) {
                            var userData = response;

                            if (userData.length > 0) {
                                document.getElementById("cin_err").innerHTML =
                                    "CIN appartient déjà par un autre utilisateur";
                            } else {
                                document.getElementById("cin_err").innerHTML = "";
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });

            $(document).on('change', '#mail', function() {
                var result = $(this).val();
                $.ajax({
                    url: '{{ route('verify_mail_user') }}',
                    type: 'get',
                    data: {
                        valiny: result
                    },
                    success: function(response) {
                        var userData = response;

                        if (userData.length > 0) {
                            document.getElementById("mail_err").innerHTML =
                                "l'email est déjà associé à un compte";
                        } else {
                            document.getElementById("mail_err").innerHTML = "";
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $(document).on('change', '#phone', function() {
                var result = $(this).val();

                if ($(this).val().length < 7) {
                    document.getElementById("phone_err").innerHTML = "numéro télephone invalide";
                } else {
                    document.getElementById("phone_err").innerHTML = '';
                    $.ajax({
                          url: '{{ route('verify_tel_user') }}'
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

            /*---------------------------------------------------------*/
            $('#liste_etp').on('change', function() {
                $('#liste_dep').empty();
                var id = $(this).val();
                $.ajax({
                    url: "{{ route('show_dep') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var userData = response;
                        console.log(userData);
                        for (var $i = 0; $i < userData.length; $i++) {
                            $("#liste_dep").append('<option value="' + userData[$i].departement.id + '">' +
                                userData[$i].departement.nom_departement + '</option>');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });


            