//separateur de milliers javascript
function numStr(a, b) {
    a = '' + a;
    b = b || ' ';
    let c = ''
        , d = 0;
    while (a.match(/^0[0-9]/)) {
        a = a.substr(1);
    }
    for (let i = a.length - 1; i >= 0; i--) {
        c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
        d++;
    }
    return c;
}

$('#fermer', '.close').on('change', function(e) {
    let ul = document.getElementById('programme');
    ul.innerHTML = '';

});
$(".suppression_module").on('click', function(e) {
    let id = e.target.id;
    // alert(id);
    $.ajax({
        type: "get"
        , url: '/destroy_module'
        ,dataType: "json"
        , data: {
            Id: id
        }
        , success: function(response) {

            if (response.success) {
                window.location.reload();
            } else {
                alert("Error");
            }
        }
        , error: function(error) {
            console.log(JSON.parse(error));
            // console.log(JSON.stringify(error));
        }
    });
});

$(document).ready(function() {
    $("#reference_search").autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: "/searchReference"
                , type: 'get'
                , dataType: "json"
                , data: {
                    //    _token: CSRF_TOKEN,
                    search: request.term
                }
                , success: function(data) {
                    // alert("eto");
                    response(data);
                }
                , error: function(data) {
                    alert("error");
                    //alert(JSON.stringify(data));
                }
            });
        }
        , select: function(event, ui) {
            // Set selection
            $('#reference_search').val(ui.item.label); // display the selected text
            $('#stagiaireid').val(ui.item.value); // save selected id to input
            return false;
        }
    });
});
$(document).ready(function() {
    $("#categorie_search").autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: "/searchCategorie"
                , type: 'get'
                , dataType: "json"
                , data: {
                    //    _token: CSRF_TOKEN,
                    recheche: request.term
                }
                , success: function(data) {
                    // alert("eto");
                    response(data);
                }
                , error: function(data) {
                    alert("error");
                    //alert(JSON.stringify(data));
                }
            });
        }
        , select: function(event, ui) {
            // Set selection
            $('#categorie_search').val(ui.item.label); // display the selected text
            $('#stagiaireid').val(ui.item.value); // save selected id to input
            return false;
        }
    });
});

$(document).ready(function(){
    $("#myTab a:last").tab("show"); // show last tab
});

function resetForm() {
    document.getElementById("frm_modif_module").reset();
}


