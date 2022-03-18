@extends('../layouts/menu')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mon compte</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Modifier mes informations
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form role="form">
                                    <div class="form-group">
                                      <label for="username">Nom d'utilisateur</label>
                                      <input type="text" class="form-control" id="nom" placeholder="Nom" value = "{{Auth::user()->name}}">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Adresse e-mail</label>
                                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Mail" value = {{Auth::user()->email}}>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Mot de passe</label>
                                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" value = "{{Auth::user()->password}}">
                                    </div>
                                    <button type="submit" class="btn btn-success">Modifier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection