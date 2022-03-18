jQuery(document).ready(function(){


    //===================== ajout information a modifier
    $(".modifier").on('click',function(e){
        $(".list_module option").remove();
        // $('.list_module').append($('<option selected>', {value:1, text:"Noam"}));
        var id = $(this).data("id");
        $.ajax({
        method: "GET",
        url:  "edit_programme",
        data:{id:id},
        dataType: "html",
        _token: "{{ csrf_token() }}",
        success:function(response)
        {
            var data=JSON.parse(response);
            $("#titre_progamme").val(data.info.titre_programme);
            $("#id_programme").val(data.info.id_programme);



            $.each( data.option, function(key, value) {
                    $('#list_module').append($('<option>', {value:key, text:value}));
            });

        },
            error:function(error){
                console.log(error)
            }
        });
	});



    // ======================================= modifier

    jQuery('#modif_programme').click(function(e){
        e.preventDefault();
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var id = $('#id_programme').val();
        var titre_programme = $('#titre_progamme').val();
        var module_id = $('#list_module').val();

        jQuery.ajax({

            url:"update_programme/"+id,
            method: 'post',
            _token: "{{ csrf_token() }}",
            data:$('#form_update_data').serialize(),

            success: function(data){
                window.location.reload();

                    if($.isEmptyObject(data.error)){
                        $('#success_titre_programme').val("ok");
                        document.getElementById("success_titre_programme").innerHTML=data.success;
                    }


            },
        error: function(error){

            var userData=JSON.parse(error.responseText);

                if(userData.errors!=null){
                    userData.errors.titre_progamme ?
                        document.getElementById("error_titre_programme").innerHTML=userData.errors.titre_progamme
                    :
                        document.getElementById("error_titre_programme").innerHTML='';

            }

        }
    });
});

// =============================== Supprimer


jQuery(".supprime_programme").click(function(e){
    e.preventDefault();
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");


     $.ajax({
    type: "post",
    url: "destroy_programme/"+id,
    data:{id:id,_token: token,},
    success:function(response){
        if(response.success){
            document.getElementById("delete_ok").innerHTML=response.success;
            window.location.reload();
        }

    },
    error:function(error){
            document.getElementById("delete_error").innerHTML=error.errors;
        }
    });
});

});
