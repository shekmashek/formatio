@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<section class="annuaire mb-5">
    <div class="container g-0 p-0 recherche">
        <div class="row g-0 m-0 p-3">
            <div class="col-3 logo_formation text-center">
                <img src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="logo" class="img-fluid">
            </div>
            <div class="col-9">
                <form action="">
                    <div class="form-row d-flex">
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control input" required name="organisme" id="organisme">
                                <label for="organisme" class="form-control-placeholder"><i
                                        class="bx bx-search me-3"></i>Numerika Center</label>
                            </div>
                        </div>
                        <div class="col-3 text-center">
                            <div class="form-group">
                                <button type="submit" class="btn_submit">Rechercher</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <h4 class="text-center mb-3">Les Organismes de Formations près de chez vous</h4>
            <div class="row mb-5">

                <div class="col-12 alphabet">
                    @foreach ($initial as $init)
                        <span title="{{$init->initial}}" class="lien_filtre" id="{{$init->initial}}" role="button">{{$init->initial}}</span>
                    @endforeach
                    {{-- @php
                        for($i ='A'; $i != 'AA'; $i++){
                            if ($init->initial == $i) {
                                echo '<span title="'.$init->initial.'" class="lien_filtre" id="'.$init->initial.'" role="button">'.$init->initial.'</span>';
                            }
                        }
                    @endphp --}}

                </div>
            </div>
            <div class="col-3 filtres">
                <h6>Filtrer les résultats</h6>
                <div class="row">
                    <p>Categories</p>
                </div>
            </div>
            <div class="col-9 justify-content-center">
                <div id="result">
                @foreach ($pagination as $cfp)
                <div class="row detail_content mb-5">
                    <div class="col-2 logo_content">
                        <a href="{{route('detail_cfp',$cfp->id)}}"><img src="{{asset("images/CFP/".$cfp->logo)}}" alt="logo" class="img-fliud logo_img"></a>
                    </div>
                    <div class="col-10 ">
                        <div class="row">
                            <h4><a href="{{route('detail_cfp',$cfp->id)}}">{{$cfp->nom}}</a></h4>
                            <p>{{$cfp->domaine_de_formation}}</p>
                            <div class="col d-flex flex-row mb-2">
                                <span class="btn_actions" role="button"><a href="#"><i
                                            class="bx bx-mail-send"></i>Email</a></span>
                                <span class="btn_actions ms-3 contact_action" role="button" data-bs-toggle="collapse"
                                    href="#contact_{{ $cfp->id }}" aria-expanded="false"
                                    aria-controls="collapseprojet"><i class="bx bx-phone"></i>Contact</span>
                                <span class="btn_actions ms-3" role="button"><a href="#"><i class="bx bx-globe"></i>Site
                                        Web</a></span>
                                <span class="btn_actions ms-3" role="button"><a href="#"><i
                                            class="bx bx-info-circle"></i>Plus d'infos</a></span>
                            </div>
                            <div class="contact collapse" id="contact_{{ $cfp->id }}">
                                <div class="col-6 phone_detail">
                                    <span class="text-muted">Téléphone</span>
                                    <p class="m-0">{{$cfp->telephone}}</p>
                                </div>
                            </div>
                        </div>
                        <p class="mt-1 adresse"><i class="bx bxs-map"></i>{{$cfp->adresse_lot}}&nbsp;{{$cfp->adresse_quartier}}&sbquo;&nbsp;{{$cfp->adresse_ville}}&nbsp;{{$cfp->adresse_code_postal}}&sbquo;&nbsp;{{$cfp->adresse_region}}
                        </p>
                    </div>
                </div>
                @endforeach
                </div>
            <div class="d-flex justify-content-center pagination">
                {!! $pagination->links() !!}
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function() {
    $(".lien_filtre").click(function(e) {
        let id_alpha = e.target.id;
        $.ajax({
            method: "get",
            url:"{{route('alphabet_filtre')}}",
            data: {
                Alpha: id_alpha,
            },
            dataType: "html",
            success: function(response) {
                let userData = JSON.parse(response);
                if (userData != null || undefined) {
                    let html = '';

                    for (let i = 0; i < userData.length; i++){
                        console.log(userData);
                        let url_detail_cfp = '{{ route("detail_cfp", ":id") }}';
                        url_detail_cfp =url_detail_cfp.replace(":id", userData[i]['id']);

                        html += '<div class="row detail_content mb-5">';
                        html +=     '<div class="col-2 logo_content">';
                        html +=         '<a href="'+url_detail_cfp+'"><img src="{{ asset("images/CFP/:?") }}" alt="logo" class="img-fliud logo_img"></a>';
                        html +=     '</div>';
                        html +=     '<div class="col-10 detail_cfp">';
                        html +=         '<div class="row">';
                        html +=             '<h4><a href="'+url_detail_cfp+'">'+userData[i]['nom']+'</a></h4>';
                        html +=             '<p>'+userData[i]['domaine_de_formation']+'</p>';
                        html +=             '<div class="col d-flex flex-row mb-2">';
                        html +=                 '<span class="btn_actions" role="button">';
                        html +=                     '<a href="#"><i class="bx bx-mail-send"></i>Email</a>';
                        html +=                 '</span>';
                        html +=                 '<span class="btn_actions ms-3 contact_action" role="button" data-bs-toggle="collapse"href="#contact_'+userData[i]['id']+'" aria-expanded="false" aria-controls="collapseprojet"><i class="bx bx-phone"></i>Contact</span>';
                        html +=                 '<span class="btn_actions ms-3" role="button">';
                        html +=                     '<a href="#"><i class="bx bx-globe"></i>Site Web</a>';
                        html +=                 '</span>';
                        html +=                 '<span class="btn_actions ms-3" role="button">';
                        html +=                     '<a href="#"><i class="bx bx-info-circle"></i>Plus d\'infos</a>';
                        html +=                 '</span>';
                        html +=             '</div>';
                        html +=             '<div class="contact collapse" id="contact_'+userData[i]['id']+'">';
                        html +=                 '<div class="col-6 phone_detail">';
                        html +=                     '<span class="text-muted">Téléphone</span>';
                        html +=                     '<p class="m-0">'+userData[i]['telephone']+'</p>';
                        html +=                 '</div>';
                        html +=             '</div>';
                        html +=             '<p class="mt-1 adresse"><i class="bx bxs-map"></i>'+userData[i]['adresse_lot']+'&nbsp;'+userData[i]['adresse_quartier']+'&sbquo;&nbsp;'+userData[i]['adresse_ville']+'&nbsp;'+userData[i]['adresse_code_postal']+'&sbquo;&nbsp;'+userData[i]['adresse_region']+'</p>';
                        html +=         '</div>';
                        html +=     '</div>';
                        html += '</div>';
                        html = html.replace(':?',userData[i]['logo']);
                }

                $("#result").empty();
                $("#result").append(html);
                $(".pagination").css('display','flex');

                } else {
                    alert('error');
                }
                if (userData == "") {
                    let page = '';
                    page += '<h4 class="text-center">Aucun organisme de formation commençant par ce lettre</h4>';
                    $("#result").empty();
                    $("#result").append(page);
                    $(".pagination").css('display','none');
                }
            },
            error: function(error) {
                console.log(error);
            },
        });
    });
});
</script>
@endsection