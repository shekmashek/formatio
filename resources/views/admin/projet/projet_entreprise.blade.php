@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Entreprise</h3>
@endsection
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
            	<br>
                <h3>ENTREPRISE</h3>
            </div> --}}
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Nom de l'entreprise</th>
                                        <th>Nom projet</th>
                                        <th colspan ="2">Actions</th>

                                    </tr>
                                </thead>

                                <tbody id ='liste_etp'>
                                        @foreach($datas as $etp)
                                    		<tr>
                                                <td>
                                                    <img src="{{asset('storage/'.$etp->logo)}}" width="100" height="100">
                                                </td>
                                    			<td width = "200px">{{$etp->nom_etp}}</td>
                                    			<td>{{$etp->nom_projet}}</td>
                                                <td>
                                                    <form action="" method="POST">
                                                        @csrf
                                                        <input name="projet_id" type="hidden" value="{{ $etp->projet_id }}">
                                                        <input name="entreprise_id" type="hidden" value="{{ $etp->entreprise_id }}">
                                                        <button type="submit" class="btn btn-success">Facturation</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('encaissement') }}" method="POST">
                                                        @csrf
                                                        <input name="projet_id" type="hidden" value="{{ $etp->projet_id }}">
                                                        <input name="entreprise_id" type="hidden" value="{{ $etp->entreprise_id }}">
                                                        <button type="submit" class="btn btn-success">Encaissement</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    	@endforeach
                                        <input id="id_value" value="" style='display:none'>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
