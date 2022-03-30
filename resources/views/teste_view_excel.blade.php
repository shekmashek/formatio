@extends('./layouts/admin')
@section('content')

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

</head>

<body>
 {{-- dsvdvdv --}}
    <table id="example" class="display">
        <thead>
            <tr>
                {{-- <th></th> --}}
                <th>Name</th>
                <th>Prenom</th>
                <th>Sexe</th>
                <th>Nombre</th>
                <th>Nombre</th>
                <th>Nombre</th>
                <th>Nombre</th>
                <th>Nombre</th>
                <th>Nombre</th>
        </thead>
        <tbody id="newRowMontant">
            @for($i = 1; $i <= 50; $i++) <tr>
                <td><span class="input-group-text" id="basic-addon1">{{$i}}</span><input type="text"></td>
                <td><input type="text"></td>
                <td><input type="text"></td>
                <td><input type="number"></td>
                <td><input type="text"></td>
                <td><input type="text"></td>
                <td><input type="text"></td>
                <td><input type="text"></td>
                <td><input type="text"></td>
                </tr>
                @endfor
        </tbody>
    </table>
    <script>
        $(document).ready(function() {

            $('td input').bind('paste', null, function(e) {
                $txt = $(this);
                setTimeout(function() {

                    // var values = $txt.val().split(/\s+/);
                    var values = $txt.val().split(/\t+/);
                    var currentRowIndex = $txt.parent().parent().index();
                    var currentColIndex = $txt.parent().index();

                    var totalRows = $('#example tbody tr').length;
                    var totalCols = $('#example thead th').length;

                    var count = 0;

                    for (var j = currentRowIndex; j < totalRows; j++) {
                        for (var i = currentColIndex; i < totalCols; i++) {

                            var value = values[count];

                            var inp = $('#example tbody tr').eq(j).find('td').eq(i).find('input');

                            count += 1;
                            inp.val(value);
                        }
                    }
                }, 0);
            });
        });



        /*
           $(document).ready(function () {
            $('td input').bind('paste', null, function (e) {
                $txt = $(this);
                setTimeout(function () {
                    var values = $txt.val().split(/\s+/);
                    var currentRowIndex = $txt.parent().parent().index();
                    var currentColIndex = $txt.parent().index();

                    var totalRows = $('#example tbody tr').length;
                    var totalCols = $('#example thead th').length;
                    var count =0;
                    for (var i = currentColIndex; i < totalCols; i++) {
                        if (i != currentColIndex)
                            if (i != currentColIndex)
                                currentRowIndex = 0;
                        for (var j = currentRowIndex; j < totalRows; j++) {
                            var value = values[count];
                            var inp = $('#example tbody tr').eq(j).find('td').eq(i).find('input');
                            inp.val(value);
                            count++;

                        }
                    }


                }, 0);
            });
        });

        */

    </script>
@endsection
