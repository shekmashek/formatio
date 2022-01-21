@extends('./layouts/admin')
@section('title')

    <p style="font-size: 20px; color:white" class="ms-5">Recherche de Formation</p>

@endsection
@section('content')
    <section class="formation">
        <div class="container-fluid">
          
                    {{-- <div class="formation__categories"> --}}
                        {{-- <div class="formation__categories__tous d-flex flex-row align-items-center"> --}}
                            {{-- <div><i class="bx bxs-grid"></i></div> --}}
                            {{-- <div><span>Domaines de formation</span></div>
                        </div>
                        <div class="formation__list__box">
                            <dl class="fl__item fl__item__bureatique dropdown">
                                @foreach ($domaines as $domaine)
                                    <dt class="formation__name">
                                        <span>
                                            <a href="#" class="ms-2 domaine" data-toggle="dropdown" id="{{ $domaine->id }}" data-id="{{ $domaine->id }}" aria-haspopup="true" aria-expanded="false">{{ $domaine->nom_domaine }}</a>
                                        </span>
                                    </dt>
                                @endforeach --}}
                                {{-- <div id="formation_resultat"></div>
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
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-lg-3">
                    </div>
                <div class="col-lg-9">
                 
                    <h3>Que voulez-vous apprendre?</h3>
                    <div class="formation__search">
                        <div class="formation__search__form">
                            <form class="" method="GET" action="{{route('result_formation')}}">
                                {{-- <form action="{{ route('search') }}" method="GET">
                                    <input type="text" name="search" class="form-control" required/>: --}}
                           @csrf
                                <input type="text" id="reference_search" name="nom_formation" placeholder="Recherche Formation par example excel" class="form-control" autocomplete="off">
                                <button type="submit" class="btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                  
 
                    @foreach ($categorie as $ctg )
                    <a href="{{route('select_par_module',$ctg->id)}}"><button type="button" class="btn btn" style="border-radius: 15px">{{$ctg->nom_formation}}</button></a>
                    @endforeach
                    <style>
                    
                        .btn{background-color: #801D68;color: white}
                        .btn:hover{color:white}
                    </style>
                       </div>   
                    </div>
                    <br>
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                        <div class="col-lg-9">
                    <div class="formation__item set-bg" id>
                        <h3>Les formations les plus recherchées </h3><br>
                    </div>
                     </div>
                     
                      
                            </div>
                        </div> 
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