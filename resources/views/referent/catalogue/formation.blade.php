@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<section class="formation mb-5">
    <div class="container-fluid g-0 m-0 p-0 justify-content-center ">
        <div class="row g-0 m-0 content_formation p-5">
            <div class="col-6 ">
                <h3 class="text-center mb-4">Que voulez-vous apprendre?</h3>
                <div class="row content_search text-center mb-5">
                    <form method="GET" action="{{route('result_formation')}}">
                        @csrf
                        <div class="form-row">
                            <div class="">
                                <input class="me-3" type="text" name=""
                                    placeholder="Rechercher par formations ex. Excel">
                                <button class="btn_search_formation" href="#">
                                    <i class="bx bx-search">
                                    </i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="d-flex flex-row flex-wrap ps-5">
                    @foreach ($categorie as $ctg )
                    <div class="content_domaines">
                        <button type="button" class="btn btn"><a href="{{route('select_par_formation',$ctg->id)}}">
                                {{$ctg->nom_formation}}</a></button>

                    </div>
                    @endforeach
                    <div class="content_domaines">
                        <a href="{{route('select_tous')}}">
                            <button type="button" class="btn btn_categ"><i class="bx bx-list-ul icon_categ"></i> Tous
                                les Thématiques</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 align-items-center justify-content-center">
                <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{asset('img/formation/rendue1.png')}}" alt="image"
                                class="d-block w-100 img-fluid">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('img/formation/rendue5.png')}}" alt="image"
                                class="d-block w-100 img-fluid">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('img/formation/rendue2.png')}}" alt="image"
                                class="d-block w-100 img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h3 class="mb-5">Les formations les plus recherchées </h3>
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-center">
                @foreach ($module as $mod)
                <div class="card_formation">
                    <div class="imageLogo text-center mb-2">
                         <img src="{{$mod->logo}}" alt="logo" class="img-fluid" title="organisme de formation"> 
                         <img src="{{asset('images/CFP/Numerika19-01-2022.png')}}" alt="logo" class="img-fluid"
                            title="organisme de formation">
                    </div>
                    <div class="titre_module">
                        <p class="text-capitalize text-">{{$mod->nom_module}}</p>
                    </div>
                    <div class="details_module">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-capitalize"><i class='bx bx-detail me-2'></i>{{$mod->nom_formation}}</p>
                                <p class="text-capitalize"><i class='bx bx-alarm me-2'></i>{{$mod->duree_jour}}
                                    jours/{{$mod->duree}}heures</p>
                                <p class="text-capitalize"><i
                                        class='bx bxs-notification me-2'></i>{{$mod->modalite_formation}}</p>
                            </div>
                            <div class="col-6 text-center">
                                <p class="text-capitalize"><span class="prix">{{$mod->prix}}&nbsp;AR&nbsp;<span class="text-muted">HT</span></span> </p>
                            </div>
                        </div>

                    </div>
                    <div class="plus_detail text-center ">
                        <button type="button" class="mt-3 btn_next"><a href="{{route('select_par_module',$mod->module_id)}}">Voir gratuitement</a></button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div> 
</section> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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