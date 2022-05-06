@extends('./layouts/admin')

@section('title')
    <h3 class="text_header m-0 mt-1">CV</h3>
@endsection



@section('cv-css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="{{asset('css/cv_profil_formateur.css')}}">
  
@endsection


@section('content')


<style>
  
  </style>

<div class="resume-wrapper">
        <section class="profile section-padding">
            <div class="container">
                <div class="picture-resume-wrapper">
                    <div class="picture-resume picture-box">

                      {{-- photo --}}
                        <img src="https://via.placeholder.com/300" alt="" />
                        <!-- <svg version="1.1" viewBox="0 0 350 350">
      
      <defs>
        <filter id="goo">
          <feGaussianBlur in="SourceGraphic" stdDeviation="8" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -9" result="cm" />
        </filter>
      </defs>
      
    </svg> -->
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="name-wrapper">
                    <h1>{{ $formateur[0]->nom_formateur }} <br />{{ $formateur[0]->prenom_formateur }}</h1>
                </div>
                <div class="clearfix"></div>
                <div class="contact-info clearfix">
                    <ul class="list-titles">
                        <li>Call</li>
                        <li>Mail</li>

                        <li>Home</li>
                        <li>Born</li>
                    </ul>
                    <ul class="list-content ">
                        <li>{{ $formateur[0]->numero_formateur }}</li>
                        <li>{{ $formateur[0]->mail_formateur }}</li>

                        <li>{{ $formateur[0]->adresse }}</li>
                        <li>{{ $formateur[0]->date_naissance }}</li>
                    </ul>
                </div>
                <div class="contact-presentation">
                    <p><span class="bold">Lorem</span> ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
                        euismod congue nisi, nec consequat quam. In consectetur faucibus turpis eget laoreet. Sed nec
                        imperdiet purus. </p>
                </div>
                <div class="contact-social clearfix">
                    <ul class="list-titles">
                        <li>Facebook</li>
                        <li>linkedIn</li>

                    </ul>
                    <ul class="list-content">
                        <li><a href="">@webdevtrick</a></li>
                        <li><a href="">@webdevtrick</a></li>

                    </ul>
                </div>
            </div>
        </section>

        <section class="experience section-padding">
            <div class="container">
                <h3 class="experience-title">Experience</h3>

                <div class="experience-wrapper">

                    @forelse ($experience as $exps)
                        <div class="company-wrapper clearfix">
                            <div class="experience-title">{{ $exps->nom_entreprise }}</div>
                            <div class="time">{{ $exps->debut_travail }}&nbsp; - &nbsp;{{ $exps->fin_travail }}
                            </div>
                        </div>

                        <div class="job-wrapper clearfix">
                            <div class="experience-title">&sbquo;&nbsp;{{ $exps->poste_occuper }}&nbsp;&nbsp;</div>
                            <div class="company-description">
                                <p>{{ $exps->taches }}</p>
                            </div>
                        </div>
                    @empty
                        {{-- a bootstrap centerd text --}}
                        <div class="text-center">
                            <h1>Aucune experience</h1>
                        </div>
                    @endforelse


                </div>

                <div class="section-wrapper clearfix">
                    <h3 class="section-title">Skills</h3>
                    <ul>
                        <li class="skill-percentage">HTML / HTML5</li>
                        <li class="skill-percentage">CSS / CSS3 / SASS / LESS</li>
                        <li class="skill-percentage">Javascript</li>
                        <li class="skill-percentage">Jquery</li>
                        <li class="skill-percentage">Wordpress</li>
                        <li class="skill-percentage">PHP</li>

                    </ul>

                </div>

                <div class="section-wrapper clearfix">
                    <h3 class="section-title">Spécialité</h3>
                    <p>
                        {{ $formateur[0]->specialite }}
                    </p>
                </div>

            </div>
        </section>

        <div class="clearfix"></div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js'></script>
    <script src="function.js"></script>
@endsection
