var url = $('#url_b').val();
$(document).ready(function () {
    $('#contieneFormCambiaPassword').on('click', '#guardarPassword', function () {

        $.ajax({
            url: $('#url_b').val() + 'usuario/usuario/guardaPassword',
            data: {idUsuario: $("#idUsuario").val(), nuevoPassword: $("#nuevoPassword").val()},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
                $('#contenedor_central').empty();
                $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
                location.href = $('#url_b').val() + 'principal';
                notificacionGlobal('Mensaje', "No se pudo Guardar. Verifique por favor", 'error', 5000);


            },
            beforeSend: function (xhr) {
                $('#contenedor_central').empty();
                $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {
                var mobile = getDevice();
                $("#contenedor_central").empty();
                if (mobile === "1" || mobile === "2") {
                    $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 25%");
                    $("#contenedor_footer").empty();
                } else {
                    $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
                }
                limpiaForm("formCambiaPassword");
                if (data.message !== "") {
                    notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
                }
                if (data.idUsuarioCambio == data.idUsuarioLogueado) {
                    logout();
                } else {
                    listaUsuarios();
                }
            }
        });
    });
    //end usuario

});



