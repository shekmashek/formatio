@extends('./layouts/admin')

@section('title')
    <h3 class="text_categ m-0 mt-1">CV</h3>
@endsection


{{-- 
@section('cv-css')

@endsection --}}

@push('cv-css')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/cv_profil_formateur.css') }}">
    
@endpush


@section('content')
    <div class="resume-wrapper">


        <div class="cv-content">

            <div id="greeting" data-page="1" class="page text-center">
                <div id="photo">
                    <img src="http://seeme.ansonc.hk/images/anson.jpg"
                        class="img-responsive img-circle img-fluid rounded rounded-circle" />
                </div>
                <h2 id="name">
                    <span class="fullname">Anson Chow</span>
                </h2>

                <div class="row">
                    <div class="col-md-12">
                        <h5 id="role">
                            Web & Mobile App Developer
                        </h5>
                    </div>
                </div>

                <div id="email" class="text-lowercase info">
                    <span>Email:</span>
                    <a href="mailto:anson.chowsh@gmail.com" target="_blank">anson.chowsh@gmail.com</a>
                </div>



                <div id="" class="phone" class="text-lowercase">
                    <span>Téléphone:</span> <a href="mailto:anson.chowsh@gmail.com" target="_blank">+261 340 000 001</a>
                </div>

                <div id="social" class="h3">
                    <a href="mailto:anson.chowsh@gmail.com" target="_blank"><i class="fa-solid fa-envelope"></i></a> 
                    <a href="https://www.linkedin.com/in/anson-chow-32793463" target="_blank">
                        <i class="fa-brands fa-linkedin" aria-hidden="true"></i></a>
                </div>

                <div id="intro" class="">
                    Professional web and mobile app developer based on Hong Kong. Enjoy programming and any technology new
                    to me!
                    <p class="text-orange">On the way becoming a <strong>Full Stack Programmer!</strong></p>
                    <p>
                        Waiting for an opportunity to breakthough my technical skills!
                    </p>
                </div>

                <!-- Divider separator -->
                <div class="divider"></div>

            </div>

            <!-- Skills -->
            <div id="skills" class="page text-center">
                <div id="skills" class="skills" data-page="2" class="page">
                    <h2 class="title text-uppercase">
                        Skills
                    </h2>
                    <div class="caption">
                        For building a complete system, the entire stack knowledge will make life easier.
                    </div>
                    <div class="record-section">
                        <div class="record">
                            <div class="categ text-green title-container">
                                <i class="fa fa-code" aria-hidden="true"></i>
                                <span class="list-title text-green">
                                    CODE
                                </span>
                            </div>
                            <div class="content">
                                <span class="tag tag1">PHP</span>
                                <span class="tag tag1">SQL</span>
                                <span class="tag tag1">jQuery</span>
                                <span class="tag tag1">AJAX</span>
                                <span class="tag tag1">Javascript</span>
                                <span class="tag tag1">HTML5</span>
                                <span class="tag tag1">CSS</span>
                                <span class="tag tag1">JAVA</span>
                                <span class="tag tag1">Bootstrap</span>
                                <span class="tag tag1">JSON</span>
                                <span class="tag tag1">Phalcon</span>
                                <span class="tag tag1">Laravel</span>
                            </div>
                        </div>
                        <div class="record">
                            <div class="categ text-dark title-container">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                <span class="list-title text-dark">
                                    DATABASE
                                </span>
                            </div>
                            <div class="content">
                                <span class="tag tag2">MySQL</span>
                                <span class="tag tag2">PostgreSQL</span>
                                <span class="tag tag2">MSSQL</span>
                                <span class="tag tag2">Oracle</span>
                            </div>
                        </div>
                        <div class="record">
                            <div class="categ text-red title-container">
                                <i class="fa fa-mobile" aria-hidden="true"></i>

                                <span class="list-title text-red">
                                    Mobile development
                                </span>
                            </div>
                            <div class="content">
                                <span class="tag tag3">iOS</span>
                                <span class="tag tag3">Android</span>
                                <span class="tag tag3">Corodva</span>
                                <span class="tag tag3">AngualrJS</span>
                                <span class="tag tag3">jQueryMobile</span>
                                <span class="tag tag3">XCode</span>
                            </div>
                        </div>
                        <div class="record">
                            <div class="categ text-orange title-container">
                                <i class="fa fa-server" aria-hidden="true"></i>
                                <span class="list-title text-orange">
                                    Operating system
                                </span>
                            </div>
                            <div class="content">
                                <span class="tag tag4">Windows Server</span>
                                <span class="tag tag4">CentOS</span>
                                <span class="tag tag4">Ubuntu</span>
                                <span class="tag tag4">Mac</span>
                            </div>
                        </div>
                        <div class="record">
                            <div class="categ text-purple title-container">
                                <i class="fa fa fa-check" aria-hidden="true"></i>
                                <span class="list-title text-purple">
                                    Other
                                </span>
                            </div>
                            <div class="content">
                                <span class="tag tag5"><a href="#">Apache</a></span>
                                <a href="#" class="btn btn-info tag tag5 pt-0 pb-0 pr-2 pl-2 m-0">AWS</a>
                                <span class="tag tag5">Git</span>
                                <span class="tag tag5">Active Directory</span>
                                <span class="tag tag5">LDAP</span>
                                <span class="tag tag5">SSL</span>
                                <span class="tag tag5">DNS</span>
                            </div>
                        </div>

                        <div class="record">
                            <div class="categ text-blue title-container">
                                <i class="fa fa-language" aria-hidden="true"></i>

                                <span class="list-title text-blue">
                                    Langues
                            </div>
                            <div class="content">
                                <span class="tag tag6">Françcais</span>
                                <span class="tag tag6">Angrais</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="divider"></div>


            <!-- experiences -->

            <div id="experiences" class="container">
                <div class="row page">

                    <div class="container mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Latest News</h4>
                                <ul class="timeline">
                                    <li>
                                        <a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                                        <a href="#" class="float-right">21 March, 2014</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                                    </li>
                                    <li>
                                        <a href="#">21 000 Job Seekers</a>
                                        <a href="#" class="float-right">4 March, 2014</a>
                                        <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                                    </li>
                                    <li>
                                        <a href="#">Awesome Employers</a>
                                        <a href="#" class="float-right">1 April, 2014</a>
                                        <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>

            <div class="divider"></div>

            <!-- Educations -->

            <div id="educations" class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-uppercase text-center">
                            Educations
                        </h2>
                        <ul class="timeline ed-timeline">
                            <li>
                                <a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                                <a href="#" class="float-right">21 March, 2014</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non
                                    nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis
                                    sagittis ligula in sodales vehicula....</p>
                            </li>
                            <li>
                                <a href="#">21 000 Job Seekers</a>
                                <a href="#" class="float-right">4 March, 2014</a>
                                <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque
                                    felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                            </li>
                            <li>
                                <a href="#">Awesome Employers</a>
                                <a href="#" class="float-right">1 April, 2014</a>
                                <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae
                                    nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>


        </div>


    </div>


    {{-- extra js --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ=="crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @endsection
{{-- @section('extra-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"
        integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection --}}
