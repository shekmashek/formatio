$("#formation_id").on("change", function() {
    var id = $("#formation_id").val();
    $("#module_id option").remove();
    $.ajax({
        method: "GET",
        url: "{{ route('module_formation') }}",
        data: {
            id: id,
        },
        dataType: "html",
        _token: "{{ csrf_token() }}",
        success: function(response) {
            var data = JSON.parse(response);
            if (data.length <= 0) {
                document.getElementById("module_id_err").innerHTML =
                    "Aucun module a été détecter! veuillez choisir la formation";
            } else {
                document.getElementById("module_id_err").innerHTML = "";
                for (var $i = 0; $i < data.length; $i++) {
                    $("#module_id").append(
                        '<option value="' +
                            data[$i].id +
                            '">' +
                            data[$i].nom_module +
                            "</option>"
                    );
                }
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});
