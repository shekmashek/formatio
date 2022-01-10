<!DOCTYPE html>
<html>
  <head>
    <title>Make Autocomplete search using jQuery UI in Laravel 7</title>

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/jqueryui/jquery-ui.min.css')}}">

    <!-- Script -->
    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>

  </head>
  <body>

    <!-- For defining autocomplete -->
    <input type="text" id='stagiaire_search'>

    <!-- For displaying selected option value from autocomplete suggestion -->
    <input type="text" id='stagiaireid' readonly>

    <!-- Script -->
    <script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#stagiaire_search" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('search')}}",
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
           $('#stagiaire_search').val(ui.item.label); // display the selected text
           $('#stagiaireid').val(ui.item.value); // save selected id to input
           return false;
        }
      });

    });
    </script>
  </body>
</html>
