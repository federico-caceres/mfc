var url = $('#url_b').val();
$(document).ready(function () {
    $('body').on('click', '#cancelarJoven', function () {
        listaJovenes();
    });

    $('#contieneFormJoven').on('click', '#guardarJoven', function () {

        if ($("#cedula").val() == null || $("#cedula").val() == "" || $("#cedula").val() == "0") {
            $("#cedula").focus();
            notificacionGlobal('Mensaje', "Nro de Cédula, es Obligatorio", 'error', 5000);
            return false;
        }

        $.ajax({
            url: url + 'jovenes/joven/guardaJoven',
            // data: $("#formMatrimonio").serialize(),
            data: {accion: $('#accion').val(),
                idjoven: $("#idjoven").val(),
                estado: $("#estado").val(),
                id_diocesis: $("#id_diocesis").val(),
                id_base: $("#id_base").val(),
                id_grupo: $("#id_grupo").val(),
                fecha_ingreso: $("#fecha_ingreso").val(),
                fecha_membresia: $("#fecha_membresia").val(),
                fecha_encuentro: $("#fecha_encuentro").val(),
                nro_encuentro: $("#nro_encuentro").val(),
                casa_retiro: $("#casa_retiro").val(),
                nombre: $("#nombre").val(),
                apellidoP: $("#apellidoP").val(),
                apellidoM: $("#apellidoM").val(),
                cedula: $("#cedula").val(),
                celular: $("#celular").val(),
                profesion: $("#profesion").val(),
                fecha_nac: $("#fecha_nac").val(),
                correo: $("#correo").val(),
                nacionalidad: $("#nacionalidad").val(),
                lugar_nac: $("#lugar_nac").val(),
                tel_laboral: $("#tel_laboral").val(),
                lugar_trabajo: $("#lugar_trabajo").val(),
                grupo_sanguineo: $("#grupo_sanguineo").val(),
                nombre_padre: $("#nombre_padre").val(),
                nombre_madre: $("#nombre_madre").val(),
                tel_padre: $("#tel_padre").val(),
                tel_madre: $("#tel_madre").val(),
                padres_pertecen_mfc: $("#padres_pertecen_mfc").val(),
                correo_padre: $("#correo_padre").val(),
                correo_madre: $("#correo_madre").val(),
                calle: $("#calle").val(),
                ciudad: $("#ciudad").val(),
                barrio: $("#barrio").val(),
                telefono: $("#telefono").val(),
                confirmado: $("#confirmado").val(),
                fecha_confirmacion: $('#fecha_confirmacion').val(),
                parroquia_confirmacion: $('#parroquia_confirmacion').val()
            },
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
                $("#cargando_central").attr("hidden", true);
                $("#contenedor_central").attr("hidden", false)
                notificacionGlobal('Mensaje', "No se pudo Guardar. Verifique por favor", 'error', 5000);
            },
            beforeSend: function (xhr) {
                $("#contenedor_central").attr("hidden", true)
                $("#cargando_central").attr("hidden", false);
                $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {
                $("#contenedor_central").attr("hidden", false);
                $("#contenedor_central").empty();

                $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");

                limpiaForm("formMatrimonio");
                $("#cargando_central").attr("hidden", true);
                $("#contenedor_central").attr("hidden", false);
                $("#cargando_central").empty();
                if (data.message !== "") {
                    notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
                }
                $("#contenedor_central").html(data.vista);
                _reiniciarTablero("tablero_joven");

            }
        });
    });
    $('#contieneFormBajaJoven').on('click', '#guardarBajaJoven', function () {

        if ($("#motivo_baja").val() == null || $("#motivo_baja").val() == "" || $("#motivo_baja").val() == "0") {
            $("#motivo_baja").focus();
            notificacionGlobal('Mensaje', "El motivo de baja, es Obligatorio", 'error', 5000);
            return false;
        }
        if ($("#tipo_baja").val() == null || $("#tipo_baja").val() == "" || $("#tipo_baja").val() == "0") {
            $("#tipo_baja").focus();
            notificacionGlobal('Mensaje', "El tipo de baja, es Obligatorio", 'error', 5000);
            return false;
        }

        $.ajax({
            url: url + 'jovenes/joven/guardaBaja',

            data: {
                idJoven: $('#idjoven').val(),
                motivo_baja: $('#motivo_baja').val(),
                tipo_baja: $('#tipo_baja').val()
            },
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
                $("#cargando_central").attr("hidden", true);
                $("#contenedor_central").attr("hidden", false)
                notificacionGlobal('Mensaje', "No se pudo Guardar. Verifique por favor", 'error', 5000);
            },
            beforeSend: function (xhr) {
                $("#contenedor_central").attr("hidden", true)
                $("#cargando_central").attr("hidden", false);
                $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {
                $("#contenedor_central").attr("hidden", false);
                $("#contenedor_central").empty();

                $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");

                limpiaForm("formBaja");
                $("#cargando_central").attr("hidden", true);
                $("#contenedor_central").attr("hidden", false);
                $("#cargando_central").empty();
                if (data.message !== "") {
                    notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
                }
                $("#contenedor_central").html(data.vista);
                _reiniciarTablero("tablero_joven");

            }
        });
    });
});


function getBaseDependiente(param) {

    $('#id_base').val("-1");
    $('#divSelectBase').attr('disabled', true);
    var cod = param.value;
    var url = $('#url_b').val();
    $.ajax({
        dataType: 'json',
        url: url + 'matrimonio/matrimonio/getBases',
        data: {cod: cod},
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        success: function (data, textStatus, jqXHR) {

            $('#divSelectBase').empty();
            $('#divSelectBase').append(data);
        }

    });
}

function verificaCedulaJoven(elemento, param) {

    var cod = param.value;
    var url = $('#url_b').val();
    if (cod == null || cod == "" || cod == "0") {
        $("#" + elemento).focus();
        notificacionGlobal('Mensaje', "Nro de Cédula es Obligatorio", 'error', 5000);
        return false;
    }
    $.ajax({
        dataType: 'json',
        url: url + 'jovenes/joven/verificaCedula',
        data: {cedula: cod},
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        success: function (data) {

            if (data.success) {
                $('#' + elemento).focus();
                notificacionGlobal("Alerta", data.message, data.tipoMasagge, 5000);
            }


        }

    });
}

function getGrupoDependiente(param) {

    $('#id_grupo').val("-1");
    $('#divSelectGrupo').attr('disabled', false);

    var cod = param.value;
    var url = $('#url_b').val();
    $.ajax({
        dataType: 'json',
        url: url + 'jovenes/joven/getGrupos',
        data: {cod: cod},
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        success: function (data, textStatus, jqXHR) {

            $('#divSelectGrupo').empty();
            $('#divSelectGrupo').append(data);
        }

    });
}

