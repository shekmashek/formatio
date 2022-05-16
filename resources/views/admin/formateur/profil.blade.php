@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil</h3>
@endsection
@section('content')
<body class="bg-light" id="top">
    
  <div class="page-content">
    <div class="container">
      <div class="resume-container">
      <div class="shadow-1-strong bg-white my-5" id="intro">
        <div class="bg-info text-white">
          <div class="cover bg-image"><img src="{{asset('assets/CV/images/header-background.jpg')}}"/>
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);backdrop-filter: blur(2px);">
              <div class="text-center p-5">
                <div class="avatar p-1"><img class="img-thumbnail shadow-2-strong" src="{{asset('assets/CV/images/avatar.jpg')}}" width="160" height="160"/></div>
                <div class="header-bio mt-3">
                  <div data-aos="zoom-in" data-aos-delay="0">
                    <h2 class="h1">Safidy Mahafaly</h2>
                    <p>Fullstack Developer </p>
                  </div>
                  <div class="header-social mb-3 d-print-none mt-4" data-aos="zoom-in" data-aos-delay="200">
                    <nav role="navigation">
                      <ul class="nav justify-content-center">
                        <li class="nav-item"><a class="nav-link" href="https://twitter.com/templateflip" title="Twitter"><i class="fab fa-twitter"></i><span class="menu-title sr-only">Twitter</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="https://www.facebook.com/templateflip" title="Facebook"><i class="fab fa-facebook"></i><span class="menu-title sr-only">Facebook</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/templateflip" title="Instagram"><i class="fab fa-instagram"></i><span class="menu-title sr-only">Instagram</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="https://github.com/templateflip" title="Github"><i class="fab fa-github"></i><span class="menu-title sr-only">Github</span></a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="shadow-1-strong bg-white my-5 p-5" id="about">
        <div class="about-section">
          <div class="row">
            <div class="col-md-6">
              <h2 class="h2 fw-light mb-4">About Me</h2>
              <p>Hello! I’m Walter Patterson. I am passionate about UI/UX design and Web Design. I am a skilled <strong>front-end developer</strong> and master of graphic design tools such as Photoshop and Sketch. I am a quick learner and a team worker that gets the job done.</p>
              <p>I can easily capitalize on low hanging fruits and quickly maximize timely deliverables for real-time schemas.</p>
            </div>
            <div class="col-md-5 offset-lg-1">
              <div class="row mt-2">
                <h2 class="h2 fw-light mb-4">Bio</h2>
                <div class="col-sm-5">
                  <div class="pb-2 fw-bolder"><i class="far fa-calendar-alt pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Age</div>
                </div>
                <div class="col-sm-7">
                  <div class="pb-2">28</div>
                </div>
                <div class="col-sm-5">
                  <div class="pb-2 fw-bolder"><i class="far fa-envelope pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Email</div>
                </div>
                <div class="col-sm-7">
                  <div class="pb-2">walter@company.com</div>
                </div>
                <div class="col-sm-5">
                  <div class="pb-2 fw-bolder"><i class="fab fa-skype pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Skype</div>
                </div>
                <div class="col-sm-7">
                  <div class="pb-2">username@skype.com</div>
                </div>
                <div class="col-sm-5">
                  <div class="pb-2 fw-bolder"><i class="fas fa-phone pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Phone</div>
                </div>
                <div class="col-sm-7">
                  <div class="pb-2">+0718-111-0011</div>
                </div>
                <div class="col-sm-5">
                  <div class="pb-2 fw-bolder"><i class="fas fa-map-marker-alt pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Address</div>
                </div>
                <div class="col-sm-7">
                  <div class="pb-2">131 W, City Center, New York, U.S.A</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="shadow-1-strong bg-white my-5 p-5" id="skills">
        <div class="skills-section">
          <h2 class="h2 fw-light mb-4">Professional Skills</h2>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3"><span class="fw-bolder">HTML</span>
                <div class="progress my-2 rounded" style="height: 20px">
                  <div class="progress-bar bg-info" role="progressbar" data-aos="zoom-in-right" data-aos-delay="100" data-aos-anchor=".skills-section" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">Master</div>
                </div>
              </div>
              <div class="mb-3"><span class="fw-bolder">CSS</span>
                <div class="progress my-2 rounded" style="height: 20px">
                  <div class="progress-bar bg-info" role="progressbar" data-aos="zoom-in-right" data-aos-delay="200" data-aos-anchor=".skills-section" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">Expert</div>
                </div>
              </div>
              <div class="mb-3"><span class="fw-bolder">JavaScript</span>
                <div class="progress my-2 rounded" style="height: 20px">
                  <div class="progress-bar bg-info" role="progressbar" data-aos="zoom-in-right" data-aos-delay="300" data-aos-anchor=".skills-section" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Advance</div>
                </div>
              </div>
              <div class="mb-3"><span class="fw-bolder">WordPress</span>
                <div class="progress my-2 rounded" style="height: 20px">
                  <div class="progress-bar bg-info" role="progressbar" data-aos="zoom-in-right" data-aos-delay="300" data-aos-anchor=".skills-section" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Advance</div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3"><span class="fw-bolder">Adobe Photoshop</span>
                <div class="progress my-2 rounded" style="height: 20px">
                  <div class="progress-bar bg-secondary" role="progressbar" data-aos="zoom-in-right" data-aos-delay="400" data-aos-anchor=".skills-section" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">Master</div>
                </div>
              </div>
              <div class="mb-3"><span class="fw-bolder">Adobe Illustrator</span>
                <div class="progress my-2 rounded" style="height: 20px">
                  <div class="progress-bar bg-secondary" role="progressbar" data-aos="zoom-in-right" data-aos-delay="400" data-aos-anchor=".skills-section" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">Expert</div>
                </div>
              </div>
              <div class="mb-3"><span class="fw-bolder">Sketch</span>
                <div class="progress my-2 rounded" style="height: 20px">
                  <div class="progress-bar bg-secondary" role="progressbar" data-aos="zoom-in-right" data-aos-delay="500" data-aos-anchor=".skills-section" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">Expert</div>
                </div>
              </div>
              <div class="mb-3"><span class="fw-bolder">Adobe XD</span>
                <div class="progress my-2 rounded" style="height: 20px">
                  <div class="progress-bar bg-secondary" role="progressbar" data-aos="zoom-in-right" data-aos-delay="600" data-aos-anchor=".skills-section" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Beginner</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="shadow-1-strong bg-white my-5 p-5" id="education">
        <div class="education-section">
          <h2 class="h2 fw-light ">Langues</h2>
          <div class="timeline">
            <div class="timeline-card timeline-card-info" data-aos="fade-in" data-aos-delay="0">
                <div class="timeline-head px-4 pt-3">
                  <div class="h5">Francais</div>
                </div>
            </div>
          </div>
          <div class="timeline">
            <div class="timeline-card timeline-card-success" data-aos="fade-in" data-aos-delay="0">
                <div class="timeline-head px-4 pt-3">
                  <div class="h5">Anglais</div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="shadow-1-strong bg-white my-5 p-5" id="experience">
        <div class="work-experience-section">
          <h2 class="h2 fw-light mb-4">Work Experience</h2>
          <div class="timeline">
            <div class="timeline-card timeline-card-info" data-aos="fade-in" data-aos-delay="0">
              <div class="timeline-head px-4 pt-3">
                <div class="h5">Frontend Developer <span class="text-muted h6">at Creative Agency</span></div>
              </div>
              <div class="timeline-body px-4 pb-4">
                <div class="text-muted text-small mb-3">May, 2015 - Present</div>
                <div>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</div>
              </div>
            </div>
            <div class="timeline-card timeline-card-info" data-aos="fade-in" data-aos-delay="200">
              <div class="timeline-head px-4 pt-3">
                <div class="h5">Graphic Designer <span class="text-muted h6">at Design Studio</span></div>
              </div>
              <div class="timeline-body px-4 pb-4">
                <div class="text-muted text-small mb-3">June, 2013 - May, 2015</div>
                <div>Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</div>
              </div>
            </div>
            <div class="timeline-card timeline-card-info" data-aos="fade-in" data-aos-delay="400">
              <div class="timeline-head px-4 pt-3">
                <div class="h5">Junior Web Developer <span class="text-muted h6">at Indie Studio</span></div>
              </div>
              <div class="timeline-body px-4 pb-4">
                <div class="text-muted text-small mb-3">Jan, 2011 - May, 2013</div>
                <div>User generated content in real-time will have multiple touchpoints for offshoring. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="shadow-1-strong bg-white my-5 p-5" id="education">
        <div class="education-section">
          <h2 class="h2 fw-light mb-4">Education</h2>
          <div class="timeline">
            <div class="timeline-card timeline-card-success" data-aos="fade-in" data-aos-delay="0">
              <div class="timeline-head px-4 pt-3">
                <div class="h5">Masters in Information Technology <span class="text-muted h6">from International University</span>          </div>
              </div>
              <div class="timeline-body px-4 pb-4">
                <div class="text-muted text-small mb-3">2011 - 2013</div>
                <div>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</div>
              </div>
            </div>
            <div class="timeline-card timeline-card-success" data-aos="fade-in" data-aos-delay="200">
              <div class="timeline-head px-4 pt-3">
                <div class="h5">Bachelor of Computer Science <span class="text-muted h6">from Regional College</span>          </div>
              </div>
              <div class="timeline-body px-4 pb-4">
                <div class="text-muted text-small mb-3">2007 - 2011</div>
                <div>Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</div>
              </div>
            </div>
            <div class="timeline-card timeline-card-success" data-aos="fade-in" data-aos-delay="400">
              <div class="timeline-head px-4 pt-3">
                <div class="h5">Science and Mathematics <span class="text-muted h6">from Mt. High Scool</span>          </div>
              </div>
              <div class="timeline-body px-4 pb-4">
                <div class="text-muted text-small mb-3">1995 - 2007</div>
                <div>User generated content in real-time will have multiple touchpoints for offshoring. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      




        <script src="scripts/mdb.min.js?ver=1.2.1"></script>
        <script src="scripts/aos.js?ver=1.2.1"></script>
        <script src="scripts/main.js?ver=1.2.1"></script>
      </body>
@endsection
