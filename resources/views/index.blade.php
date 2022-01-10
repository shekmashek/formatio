<html>
<head>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('maquette/style.css') }}">
<link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
<title> formation.mg </title>
</head>
<body class="img-fluid">
<header>
	<nav class="navbar fixed-top navbar-expand-lg d-flex flex-rows justify-content-end pt-3 pe-5">
		<input type="search" class="form_control" placeholder="Rechercher ici ...">&nbsp; &nbsp; &nbsp;
		<a href="{{route('sign-in')}}" style="text-decoration: none"><button class="btn btn-default text-white btn_login"> <b>Login</b> </button>&nbsp; &nbsp; &nbsp;</a>
		<button class="btn btn-default text-gret btn_contactez_nous"> <b>Contactez-nous</b> </button>
	</nav>
</header>
<section  >
	<div class="section1 div_formation_mg">
		<p class="text-white foramtion_mg">Formation.mg</p>
		<p class="text-white-50 mot_section1">
			La première plateforme malagasy <br> de gestion de formation, outil <br> incontournable et innovateur du milieu professionnel.
			</p>
	</div>
	<div class="section1 logo_formation">
		<img class="img-fluid" src="{{ asset('maquette/logo_transparent.png') }}" width="200px" height="200px"><br>
		<p class="text-white ps-5 votre_partenaire"><i><b>Votre partenaire.</b></i></p>
	</div>
	<img src="{{ asset('maquette/img_back_section_1.jpg') }}" class="p-0 m-0" width="100%">
</section>
<section>
<div class="row">
	<div class="col-md-6">
		<img class="img-fluid" src="{{ asset('maquette/image_2.PNG') }}">

	</div>
	<div class="col-md-6 mot_section2">
	<p class="qui_sommes_nous ps-3"> Qui sommes-nous ?  </p>
		<font color="red">Formation.mg </font> est la première plateforme
		malagasy au service des professionnels de la
		formation. Nos solutions sont issues de la
		collaboration entre des dirigeants
		d'organismes de formation expérimentés et
		une équipe de développeurs spécialisés dans
		la création d'outils Web. Fort de cette double
		expertise, nous proposons des solutions
		cloud ergonomiques et innovantes conçues
		pour répondre aux besoins quotidiens des
		centres de formations.
	</div>
</div>
</section>
<section>
<div class="row">
	<div class="col-md-6 div_image_section_3">
	<p class="qui_sommes_nous">Pourquoi intégrer <font color="red"> Formation.mg</font> ?</p>
	<p class="mot_section2">
		Accroissez votre productivité,<font color="red">
		Formation.mg </font>  vous permet de
		travailler plus rapidement en
		rassemblant en lui plusieurs
		fonctions : la gestion de vos
		formations, la facturation, la
		gestion de devis, le mailing rapide,
		le dressage de vos catalogues
		professionnels, etc.
		</p>
	</div>
	<div class="col-md-6 div_image_section_3">
		<img class="img-fluid ps-4" src="{{ asset('maquette/image_3.PNG') }}">
	</div>
</div>
</section>

</body>
</html>
