@extends('./layouts/admin')
@section('content')
    <section class="formation">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="formation__categories">
                        <div class="formation__categories__tous d-flex flex-row align-items-center">
                            <div><i class="bx bxs-grid"></i></div>
                            <div><span>Domaines de formation</span></div>
                        </div>
                        <div class="formation__list__box">
                            <dl class="fl__item fl__item__bureatique dropdown">
                                @foreach ($domaines as $domaine)
                                    <dt class="formation__name">
                                        <span>
                                            <a href="#" class="ms-2 domaine" data-toggle="dropdown" id="{{ $domaine->id }}" data-id="{{ $domaine->id }}" aria-haspopup="true" aria-expanded="false">{{ $domaine->nom_domaine }}</a>
                                        </span>
                                    </dt>
                                @endforeach
                                <div id="formation_resultat"></div>
                                 <dd class="sous-formation dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" data-path="f-bureatique-content" data-role="first-menu-main" style="display: none;">
                                    <div class="sous-formation-main">
                                        <div class="sous-formation-content d-flex flex-column flex-sm-row align-items-start">
                                                <div class="sous-formation-row dropdown-item ">

                                                </div>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="formation__search">
                        <div class="formation__search__form">
                            <form class="" method="GET" action="{{route('result_formation')}}">
                                <input type="text" id="reference_search" name="nom_formation" placeholder="Vous cherchez..." class="form-control" autocomplete="off">
                                <button type="submit" class="btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="formation__item set-bg" id>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="formation-service">
                                    <h4><span class="lnr lnr-user"></span>Formateurs Experts</h4>
                                    <p>
                                        Nos consultants-formateurs sont des experts dans leurs univers d'intervention en conseil et en formation. Leur expérience fait leur force. Ils évoluent avec les besoins de l'apprenant et les enjeux de l'entreprise. Ils sont sélectionnés selon un processus qualité strict.        </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="formation-service">
                                    <h4><span class="lnr lnr-license"></span>Services Professionnels</h4>
                                    <p>
                                        Avec Formation.mg, vous pouvez compter sur une expertise de pointe.
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="formation-service">
                                    <h4><span class="lnr lnr-phone"></span>Support de Formation</h4>
                                    <p>
                                        Nous mettons à la disposition des formateurs,  des supports de formation téléchargeables immédiatement.        </p>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="formation-service">
                                    <h4><span class="lnr lnr-rocket"></span>Compétence Téchnique</h4>
                                    <p>
                                        Les compétences techniques ont leur part d’importance pour décrocher un emploi. Nous vous disons pourquoi et comment les mettre en avant.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="formation-service">
                                    <h4><span class="lnr lnr-diamond"></span>Récommander </h4>
                                    <p>
                                        Formation en bureautique</p>
                                        <p>Formation en Langue</p>
                                        <p>Formation en développement personnel
                                    </p>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-6">
                                <div class="formation-service">
                                    <h4><span class="lnr lnr-bubble"></span>Des retours positives</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, doloremque. Neque asperiores enim dicta sapiente distinctio assumenda illum sit sunt commodi, cum vero optio adipisci soluta laboriosam nobis nemo nihil!                                    </p>
                                    </p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
        // CSRF Token

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
          $( "#reference_search" ).autocomplete({

            source: function( request, response ) {
              // Fetch data
              $.ajax({
                url:"{{route('search__formation')}}",
                type: 'get',
                dataType: "json",
                data: {
                //    _token: CSRF_TOKEN,
                   search: request.term
                },
                success: function( data ) {
                    // alert("eto");
                   response( data );

                },error:function(data){
                    alert("error");
                    //alert(JSON.stringify(data));
                }
              });
            },
            select: function (event, ui) {
           // Set selection
           $('#reference_search').val(ui.item.label); // display the selected text
           return false;
        }
          });
        });

    $(".domaine").on('mouseover',function(e){
        var id = $(this).data("id");
        $.ajax({
        method: "GET",
        url:  "{{route('domaine_formation')}}",
        data:{domaine_id:id},
        dataType: "html",
        success:function(response){
            var userData=JSON.parse(response);
            var formations = userData[0];
            var modules = userData[1];
            var domaine_id = userData[2];
            $('.sous-formation-row').html('');
            var html = '';
             for (let i = 0; i < formations.length; i++) {
                var url_formation = '{{ route("select_par_formation", ":id") }}';

                url_formation = url_formation.replace(':id', formations[i].id);

                html += '<dl class="sous-formation-items" data-role="two-menu">';
                html += '<dt><a href="'+url_formation+'">'+formations[i].nom_formation+'</a></dt>';
                html += '<dd class="d-flex flex-column">';
                    for (let j = 0; j < modules.length; j++) {
                        if (formations[i].id == modules[j].formation_id) {
                            var url_module_detail = '{{ route("select_par_module", ":id") }}';
                            url_module_detail = url_module_detail.replace(':id', modules[j].module_id);
                            html += '<a href="'+url_module_detail+'">'+(modules[j].nom_module)+'</a>';
                        }
                    }
                html += '</dd>';
                html += '</dl>';
            }
            $(".dropdown>.dropdown-menu").css("display", "block");
            $('.sous-formation-row').append(html);
        },
        error:function(error){
            console.log(error)
        }
        });
        $(".sous-formation-content").on('mouseleave',function(e){
            $(".dropdown>.dropdown-menu").css("display", "none");
        });
    });

</script>

@endsection
