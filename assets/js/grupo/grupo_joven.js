var url = $('#url_b').val();
$(document).ready(function () {
    $('body').on('click', '#cancelarGrupoJoven', function () {
        listaGruposJoven();
    });
    $('FormS05Jovej').on('click', '#cancelarS05', function () {
        var idGrupo = ($("#id_grupo").val() === "-1") ? $("#idGrupoS05").val() : $("#id_grupo").val();
        listaS05Joven(idGrupo);
    });
    $('body').on('click', '#cancelarMiembroJoven', function () {
        var idgrupo = $(this).attr("data-idgrupo");
        listaMiembrosJoven(idgrupo);
    });

});


