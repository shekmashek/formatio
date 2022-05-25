

            <script src="{{ asset('assets/js/jquery.js') }}"></script>
            <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}" />

            <script type="text/javascript">
                $(".matricule_filtre").on('click', function(e) {
                    if (
                        $(".matricule_filtre")
                        .find(".icon_trie")
                        .hasClass("bxs-chevron-down")
                    ) {
                        $(".matricule_filtre")
                            .find(".icon_trie")
                            .removeClass("bxs-chevron-down")
                            .addClass("bxs-chevron-up");
                    } else {
                        $(".matricule_filtre")
                            .find(".icon_trie")
                            .removeClass("bxs-chevron-up")
                            .addClass("bxs-chevron-down");
                    }
                });

                $(".email_filtre").on('click', function(e) {
                    if (
                        $(".email_filtre")
                        .find(".icon_trie")
                        .hasClass("bxs-chevron-down")
                    ) {
                        $(".email_filtre")
                            .find(".icon_trie")
                            .removeClass("bxs-chevron-down")
                            .addClass("bxs-chevron-up");
                    } else {
                        $(".email_filtre")
                            .find(".icon_trie")
                            .removeClass("bxs-chevron-up")
                            .addClass("bxs-chevron-down");
                    }
                });

                $(".activiter_filtre").on('click', function(e) {
                    if (
                        $(".activiter_filtre")
                        .find(".icon_trie")
                        .hasClass("bxs-chevron-down")
                    ) {
                        $(".activiter_filtre")
                            .find(".icon_trie")
                            .removeClass("bxs-chevron-down")
                            .addClass("bxs-chevron-up");
                    } else {
                        $(".activiter_filtre")
                            .find(".icon_trie")
                            .removeClass("bxs-chevron-up")
                            .addClass("bxs-chevron-down");
                    }
                });

                /*============ stg =================*/
                $(".desactiver_stg").on('click', function(e) {
                    var user_id = $(this).data("user-id");
                    var stg_id = $(this).val();
                    $.ajax({
                        type: "GET"
                        , url: "{{route('employes.liste.desactiver')}}"
                        , data: {
                            user_id: user_id
                            , emp_id: stg_id
                        }
                        , success: function(response) {
                            window.location.reload();
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });
                $(".activer_stg").on('click', function(e) {
                    var user_id = $(this).data("user-id");
                    var stg_id = $(this).val();
                    $.ajax({
                        type: "GET"
                        , url: "{{route('employes.liste.activer')}}"
                        , data: {
                            user_id: user_id
                            , emp_id: stg_id
                        }
                        , success: function(response) {
                            window.location.reload();
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });


                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function() {
                    'use strict'

                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.querySelectorAll('.needs-validation')

                    // Loop over them and prevent submission
                    Array.prototype.slice.call(forms)
                        .forEach(function(form) {
                            form.addEventListener('submit', function(event) {
                                if (!form.checkValidity()) {
                                    event.preventDefault()
                                    event.stopPropagation()
                                }

                                form.classList.add('was-validated')
                            }, false)
                        })
                })()

            </script>
