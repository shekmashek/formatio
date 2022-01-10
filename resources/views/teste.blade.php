<! DOCTYPE html>
<html>
<head>
	<title>Laravel 7 Generate PDF From View Example Tutorial - NiceSnippets</title>
</head>
<body>
    <li class ="{{ Route::currentRouteNamed('imprime_calalogue') || Route::currentRouteNamed('imprime_calalogue') ? 'active' : '' }}"><a href="{{route('imprime_calalogue')}}" ><span class="glyphicon glyphicon-download-alt"></span>  Imprimer Catalogue </a></li>

    <h1>Welcome to Nicesnippets.com - {{ $title }}</h1>
    <p>NiceSnippets Blog provides you latest Code Tutorials on PHP, Laravel, Codeigniter,
    JQuery, Node js, React js, Vue js, PHP, and Javascript. Mobile technologies like Android,
    React Native, Ionic etc.</p>
</body>
</html>
