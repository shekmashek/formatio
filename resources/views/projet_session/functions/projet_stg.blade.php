<script type="text/javascript">
$(document).ready(function() {
    /* checkbox module */
    $('#module').on('change', function (e) {
        $.each($("input[name='module']:checked"), function(){
            var valueSelected = $(this).val();
            $(".nom_module").each(function( index ) {
                if($( this ).text()!=valueSelected){
                    if (!$( ".listes" ).eq( index ).hasClass("checked")) {
                        $( ".listes" ).eq( index ).css('display','none');
                    }
                }else if($( this ).text()==valueSelected){
                    $( ".listes" ).eq( index ).addClass('checked');
                    $( ".listes" ).eq( index ).css('display','flex');
                }
                if(valueSelected=='null'){
                    $( ".listes" ).css('display','flex');
                }
            });
        });
        $(".listes").removeClass("checked");
    });
    /* checkbox formation */
    $('#formation').on('change', function (e) {
        $.each($("input[name='formation']:checked"), function(){
            var valueSelected = $(this).val();
            $(".nom_formation").each(function( index ) {
                if($( this ).text()!=valueSelected){
                    if (!$( ".listes" ).eq( index ).hasClass("checked")) {
                        $( ".listes" ).eq( index ).css('display','none');
                    }
                }else if($( this ).text()==valueSelected){
                    $( ".listes" ).eq( index ).addClass('checked');
                    $( ".listes" ).eq( index ).css('display','flex');
                }
                if(valueSelected=='null'){
                    $( ".listes" ).css('display','flex');
                }
            });
        });
        $(".listes").removeClass("checked");
    });
    /* checkbox status */
    $('#status').on('change', function (e) {
        $.each($("input[name='status']:checked"), function(){
            var valueSelected = $(this).val();
            $(".nom_status").each(function( index ) {
                if($( this ).text()!=valueSelected){
                    if (!$( ".listes" ).eq( index ).hasClass("checked")) {
                        $( ".listes" ).eq( index ).css('display','none');
                    }
                }else if($( this ).text()==valueSelected){
                    $( ".listes" ).eq( index ).addClass('checked');
                    $( ".listes" ).eq( index ).css('display','flex');
                }
                if(valueSelected=='null'){
                    $( ".listes" ).css('display','flex');
                }
            });
        });
        $(".listes").removeClass("checked");
    });

    $("input[name='mois_all']").click(function(){
        if($("input[name='mois_all']").prop("checked") == true){
            $.each($("input[name='mois_all']:checked"), function(){
                $('input[name="mois"]:checkbox').not(this).prop('checked', true);
            });
        }else if($("input[name='mois_all']").prop("checked") == false){
            $('input[name="mois"]:checkbox').prop('checked', false);
            $(".listes").removeClass("checked");
            $( ".listes" ).css('display','flex');
        }
    });
    $("input[name='module_all']").click(function(){
        if($("input[name='module_all']").prop("checked") == true){
            $.each($("input[name='module_all']:checked"), function(){
                $('input[name="module"]:checkbox').not(this).prop('checked', true);
            });
        }else if($("input[name='module_all']").prop("checked") == false){
            $('input[name="module"]:checkbox').prop('checked', false);
            $(".listes").removeClass("checked");
            $( ".listes" ).css('display','flex');
        }
    });
    $("input[name='formation_all']").click(function(){
        if($("input[name='formation_all']").prop("checked") == true){
            $.each($("input[name='formation_all']:checked"), function(){
                $('input[name="formation"]:checkbox').not(this).prop('checked', true);
            });
        }else if($("input[name='formation_all']").prop("checked") == false){
            $('input[name="formation"]:checkbox').prop('checked', false);
            $(".listes").removeClass("checked");
            $( ".listes" ).css('display','flex');
        }
    });
    $("input[name='status_all']").click(function(){
        if($("input[name='status_all']").prop("checked") == true){
            $.each($("input[name='status_all']:checked"), function(){
                $('input[name="status"]:checkbox').not(this).prop('checked', true);
            });
        }else if($("input[name='status_all']").prop("checked") == false){
            $('input[name="status"]:checkbox').prop('checked', false);
            $(".listes").removeClass("checked");
            $( ".listes" ).css('display','flex');
        }
    });

    /* filtre date debut */
    $('#start_date').on('input', function (e) {
        var end = $('#end_date').val();
        if(end==''){
            $(".date_debut").each(function( index ) {
                var debut = $( this ).text();
                var start = $('#start_date').val();
                var split_date_debut = debut.split('-');
                var date_debut = new Date('20'+split_date_debut[2],split_date_debut[1],split_date_debut[0]);
                var split_date_start = start.split('-');
                var date_start = new Date(split_date_start[0],split_date_start[1],split_date_start[2]);
                if(date_debut<date_start){
                        $( ".listes" ).eq( index ).css('display','none');
                }else{
                    $( ".listes" ).eq( index ).css('display','flex');
                }
            });
        }else{
            $(".date_debut").each(function( index ) {
                var fin = $(".date_fin").eq( index ).text();
                var debut = $( this ).text();
                var start = $('#start_date').val();
                var split_date_debut = debut.split('-');
                var date_debut = new Date('20'+split_date_debut[2],split_date_debut[1],split_date_debut[0]);
                var split_date_start = start.split('-');
                var date_start = new Date(split_date_start[0],split_date_start[1],split_date_start[2]);
                var end = $('#end_date').val();
                var split_date_fin = fin.split('-');
                var date_fin = new Date('20'+split_date_fin[2],split_date_fin[1],split_date_fin[0]);
                var split_date_end = end.split('-');
                var date_end = new Date(split_date_end[0],split_date_end[1],split_date_end[2]);
                if(date_debut<date_start || date_fin>date_end){
                        $( ".listes" ).eq( index ).css('display','none');
                }else{
                    $( ".listes" ).eq( index ).css('display','flex');
                }
            });
        }
        
    });
     /* filtre date fin */
    $('#end_date').on('input', function (e) {
        var start = $('#start_date').val();
        if(start==''){
            $(".date_fin").each(function( index ) {
                var fin = $( this ).text();
                var end = $('#end_date').val();
                var split_date_fin = fin.split('-');
                var date_fin = new Date('20'+split_date_fin[2],split_date_fin[1],split_date_fin[0]);
                var split_date_end = end.split('-');
                var date_end = new Date(split_date_end[0],split_date_end[1],split_date_end[2]);
                if(date_fin>date_end){
                        $( ".listes" ).eq( index ).css('display','none');
                }else{
                    $( ".listes" ).eq( index ).css('display','flex');
                }
            });
        }else{
            $(".date_fin").each(function( index ) {
                var fin = $( this ).text();
                var debut = $(".date_debut").eq( index ).text();
                var end = $('#end_date').val();
                var split_date_fin = fin.split('-');
                var date_fin = new Date('20'+split_date_fin[2],split_date_fin[1],split_date_fin[0]);
                var split_date_end = end.split('-');
                var date_end = new Date(split_date_end[0],split_date_end[1],split_date_end[2]);
                var split_date_debut = debut.split('-');
                var date_debut = new Date('20'+split_date_debut[2],split_date_debut[1],split_date_debut[0]);
                var split_date_start = start.split('-');
                var date_start = new Date(split_date_start[0],split_date_start[1],split_date_start[2]);
                if(date_fin>date_end || date_debut<date_start){
                        $( ".listes" ).eq( index ).css('display','none');
                }else{
                    $( ".listes" ).eq( index ).css('display','flex');
                }
            });
        }
    });

    /* tri recherche */
    $('#recherche_module').on('input', function (e) {
        var recherche = $(this).val();
        $(".nom_module").each(function( index ) {
            if ($(this).text().toLowerCase().indexOf(recherche) < 0){
                $( ".listes" ).eq( index ).css('display','none');
            }else{
                $( ".listes" ).eq( index ).css('display','flex');
            }
        });
        
    });
    $('#recherche_formation').on('input', function (e) {
        var recherche = $(this).val();
        $(".nom_formation").each(function( index ) {
            if ($(this).text().toLowerCase().indexOf(recherche) < 0){
                $( ".listes" ).eq( index ).css('display','none');
            }else{
                $( ".listes" ).eq( index ).css('display','flex');
            }
        });
    });
    $('#recherche_status').on('input', function (e) {
        var recherche = $(this).val();
        $(".nom_status").each(function( index ) {
            if ($(this).text().toLowerCase().indexOf(recherche) < 0){
                $( ".listes" ).eq( index ).css('display','none');
            }else{
                $( ".listes" ).eq( index ).css('display','flex');
            }
        });
    });

});

</script>