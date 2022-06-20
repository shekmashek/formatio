
    $(".nav .nav_linke").on("click", function(e){
        localStorage.setItem('indiceSidebar', this);
        $('a.active').removeClass('active');
    });

    $(".btn_racourcis a").on("click", function(e){
        localStorage.setItem('indiceSidebar', this);
        $('a.active').removeClass('active');
    });

    if(!(localStorage.getItem('indiceSidebar')))localStorage.setItem('indiceSidebar', document.getElementById("accueil").href);
    let Tabactive = localStorage.getItem('indiceSidebar');
    if(Tabactive){
        ($('a[href="' + Tabactive + '"]').closest('a')).addClass('active');
        ($('a[href="' + Tabactive + '"]').closest('div')).addClass('active');
    }