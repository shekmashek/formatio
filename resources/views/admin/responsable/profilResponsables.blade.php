@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1"></h3>
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
   
    .nav-link{
        background-color: #6610f2;
        margin-bottom: 10px;
        color: rgb(148, 140, 140);
	  box-shadow: none;
    }
    .nav-link:hover{
        background-color: #6610f2;
        color: white;
        box-shadow: 0 4px 18px -4px rgba(115,103,240,.65);
        margin-bottom: 10px;
    }
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #6610f2;
        width: 250px;
        margin-bottom: 10px;
        box-shadow: none;
    }
    .photo{
        width: 100px;
        height: 90px;
        background: rgb(240, 237, 237);
        border-radius: 10px;
    }
    .form-control{
	    width: 400px;
	    transition: all .1s linear;
	    border: gray 1px solid;
	    font-size: 12px;
	    color: gray;
    }
    .form-control:focus{
	    border: #6610f2 1px solid;
	    transition: all .1s linear;
	    outline: none;
    }
    label{
	    font-size: 12px;
	    color: gray;
    }
    a{
	    text-decoration: none;
    }
    
    @media screen and (max-width: 992px) {
	.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #6610f2;
        width: 150px;
        margin-bottom: 10px;
        box-shadow: none;
	}
	.photo,.up
	{
		display: none;
	}
	.form-control,.kepri,.kecen,.kefin{
		width: 500px;
	}
	}
	@media screen and (max-width: 1200px) {
		.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
		color: #fff;
		background-color: #6610f2;
		width: 200px;
		margin-bottom: 10px;
		box-shadow: none;
		}
		
		
		.form-control{
			width: 550px;
			
		}
	}
	@media screen and (max-width: 1900px) {
		
		.kepri{
			
			width: 250px;
		}
		
		}
		.kefin{
			width: 260px;
		}
		.kecen{
			width: 250px;
		}
	}
</style>
@foreach ($refs as $r)
<div class="container  mt-3">
	
    <div class="row">
	
        <div class="col-12 col-lg-12 p-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="#"><span class="iconify" data-icon="ep:setting"></span> &nbsp; Parametre du compte</a></li>
			  
			  <li class="breadcrumb-item active" id="test" aria-current="page">General &nbsp;</li>@if (\Session::has('error'))<p style="color:red;font-size:15px;font-family:'Roboto', sans-serif;">&nbsp;({!! \Session::get('error') !!})</p>@endif
			
		</nav>
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button onclick="mandeG();" class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><span class="iconify" style="font-size: 22px" data-icon="el:address-book-alt"></span>&nbsp;General</button>
                  <button onclick="mandeA();"class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><span class="iconify" style="font-size: 22px" data-icon="carbon:group-security"></span>&nbsp;Sécurité</button>
                  <button onclick="mandeC();" class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><span class="iconify" style="font-size: 22px" data-icon="bx:map"></span>&nbsp; Coordoneés</button>

                </div>
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active col-12 shadow-lg p-4 rounded" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="photo">
						
							@if($r->photos==null)
							<span>
							<div style="display: grid; place-content: center">
								<div class='randomColor photo_users' style="color:white; font-size: 25px; border: none; border-radius: 10px; height:90px; width:100px ; display: grid; place-content: center">
								</div>
							</div>
							</span>
							@else
							<img src="{{asset('images/responsables/'.$refs->photos)}}" class="photo">
							@endif
						
						
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 me-2">
                                <button class="btn up" style="color: white;background-color:#6610f2;font-size:12px;height:30px">Upload</button>
                            </div>
                        </div>
				<form action="{{route('responsabe.editG',$r->id)}}" method="post">
				@csrf
                        <div class="row">
                            <div class="col md-6">
                                <label for="">Noms :</label>
					  
                                <input type="text" value="{{$r->nom_resp}}" name="noms" class="form-control" >
					  <input type="hidden" name="user_id" value="{{$r->user_id}}"  required>
                            </div>
                            <div class="col md-6">
                                <label for="">Prenoms :</label>
                                <input type="text" value="{{$r->prenom_resp}}" name="prenoms" class="form-control" required>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-4 col-sm-12">
                                <label for="">CIN :</label>
                                <input  value="{{$r->cin_resp}}" type="text" name="CIN" class="kepri form-control  " required>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <label for="">Phone :</label>
                                <input type="text"  value="{{$r->telephone_resp}}" name="phone" class="form-control kecen" required>
                            </div>
				    <div class="col-lg-4 col-sm-12">
					<label for="">Email :</label>
					<input type="text"  value="{{$r->email_resp}}" name="email" class="form-control kefin" required>
				    </div>
                        </div>
				<div class="row ">
					<div class="col">
					    <label for="">Genre :</label>
					    <select name="genre" id="" class="form-control" required>
						<option value="{{$r->sexe_resp}}" selected >{{$r->sexe_resp}}</option>
						<option value="Homme" selected >Homme</option>
						<option value="Femme" selected >Femme</option>
					    </select>
					</div>
					<div class="col">
					    <label for="">Date de naissance :</label>
					    <input type="date" name="date" value="{{$r->date_naissance_resp}}" class="form-control" required>
					</div>
				  </div>
				  <div class="row">
					<div class="col-lg-2 me-3">
						<button class="btn mt-2 " style="color: white;background-color:#6610f2;font-size:12px;height:30px;width:150px;">Modifier</button>
					</div>
				  </div>
				</form> 
                      </div>
                  </div>
                  <div class="tab-pane fade shadow-lg p-4 rounded" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
				<form action="{{route('responsable.editM',$r->user_id)}}" method="post">
				@csrf
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<label for="">Mots de passe actuel :</label>
								<input type="password" name="actuel" class="form-control" required>
								<input type="hidden" name="user_id" value="{{$r->user_id}}" class="form-control">
								
							</div>
							<div class="col">
								<label for="">Nouveaux mots de passe :</label>
								<input type="password" name="nouveaux" class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2 me-3">
								<button class="btn mt-2 " style="color: white;background-color:#6610f2;font-size:12px;height:30px;width:150px;">Modifier</button>
							</div>
						</div>
					</div>
				</form>
			</div>
                  <div class="tab-pane fade shadow-lg p-4 rounded"  id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
				<div class="container">
					<form action="{{route('responsable.editA',$r->id)}}" method="post">
						@csrf
					<div class="row">
						
						<div class="col">
							<label for="">Lôt :</label>
							<input type="text" style="width: 250px" value="{{$r->adresse_lot}}" name="lot" class="form-control" required>
						</div>
						<div class="col">
							<label for="">Quartier :</label>
							<input type="text" style="width: 250px" value="{{$r->adresse_quartier}}" name="quartier" class="form-control" required>
						</div>
						<div class="col">
							<label for="">Quartier :</label>
							<input type="text" style="width: 250px" value="{{$r->adresse_quartier}}" name="quartier" class="form-control" required>
						</div>
					</div>
					<div class="row">
						  <div class="col">
							<label for="">Ville :</label>
							<input type="text" style="width: 250px" value="{{$r->adresse_ville}}" name="ville" class="form-control" required>
						  </div>
						  <div class="col">
							<label for="">Region:</label>
							<input type="text" style="width: 250px" value="{{$r->adresse_region}}" name="region" class="form-control" required>
						  </div>
						  <div class="col">
							<label for="">Code Postale :</label>
							<input type="text" style="width: 250px" value="{{$r->adresse_code_postal}}" name="cp" class="form-control" required>
						  </div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 me-3">
							<button class="btn mt-2 " style="color: white;background-color:#3f1f72;font-size:12px;height:30px;width:150px;">Modifier</button>
						</div>
						</form>
					  </div>
				</div>
			</div>
                  
                </div>
              </div>
              
        </div>
    </div>
</div>
@endforeach
<script>
	function mandeA(){
        document.getElementById('test').innerHTML ='Sécurités';
    }
    function mandeC(){
        document.getElementById('test').innerHTML ='Coordonées';
    }
    function mandeG(){
        document.getElementById('test').innerHTML ='General';
    };
</script>
@endsection
