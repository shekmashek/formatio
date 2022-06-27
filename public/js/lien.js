
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('collaboration', lien);
    });
    let Tabactive = localStorage.getItem('collaboration');
    if(Tabactive){
        $('#myTab a[href="' + Tabactive + '"]').tab('show');
    }

