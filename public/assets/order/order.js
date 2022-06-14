$(function(){
    $("#order_etp").on("click", function(e) {
        e.preventDefault();
        var href_url = $(this).attr("href");
        console.log(href_url);
        $.ajax({
            type: "get",
            url: href_url,
            dataType:'json',
            success: function(data) {
                $('.table').html(data.output);
            },
            error: function(error) {
           /*  console.log(error); */
            },
        });
    });
});