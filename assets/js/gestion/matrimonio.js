var url = $('#url_b').val();
$(document).ready(function () {
    $('body').on('click', '#cancelarMatrimonio', function () {
        listaMatrimonios();
    });

    $('#contieneFormMatrimonio').on('click', '#guardarMatrimonio', function () {
        var cedulael = $("#cedula_el").val();
        var cedulaella = $("#cedula_ella").val();

        if ($("#id_diocesis").val() == null || $("#id_diocesis").val() == "" || $("#id_diocesis").val() == "-1") {
            $("#id_diocesis").focus();
            notificacionGlobal('Mensaje', "Diocesis, es Obligatorio", 'error', 5000);
            return false;
        }
        if ($("#id_base").val() == null || $("#id_base").val() == "" || $("#id_base").val() == "-1") {
            $("#id_base").focus();
            notificacionGlobal('Mensaje', "Base, es Obligatorio", 'error', 5000);
            return false;
        }
        if ($("#nombre_el").val() == null || $("#nombre_el").val() == "") {
            $("#nombre_el").focus();
            notificacionGlobal('Mensaje', "Nombre del marido, es Obligatorio", 'error', 5000);
            return false;
        }
        if ($("#apellidos_el").val() == null || $("#apellidos_el").val() == "") {
            $("#apellidos_el").focus();
            notificacionGlobal('Mensaje', "Apellidos del marido, es Obligatorio", 'error', 5000);
            return false;
        }

        if ($("#nombre_ella").val() == null || $("#nombre_ella").val() == "") {
            $("#nombre_ella").focus();
            notificacionGlobal('Mensaje', "Nombre de la esposa, es Obligatorio", 'error', 5000);
            return false;
        }
        if ($("#apellidos_ella").val() == null || $("#apellidos_ella").val() == "") {
            $("#apellidos_ella").focus();
            notificacionGlobal('Mensaje', "Apellidos de la esposa, es Obligatorio", 'error', 5000);
            return false;
        }
        if ($("#cedula_el").val() == null || $("#cedula_el").val() == "" || $("#cedula_el").val().length <= "5" || ((cedulael + 1) == 1)) {
            $("#cedula_el").focus();
            $("#cedula_el").val("");
            notificacionGlobal('Mensaje', "Nro de Cédula del esposo, es Obligatorio", 'error', 5000);

            return false;
        }
        if ($("#cedula_ella").val() == null || $("#cedula_ella").val() == "" || $("#cedula_ella").val().length <= "5" || ((cedulaella + 1) == 1)) {
            $("#cedula_ella").focus();
            $("#cedula_ella").val("");
            notificacionGlobal('Mensaje', "Nro de Cédula de la esposa, es Obligatorio", 'error', 5000);

            return false;
        }

        $.ajax({
            url: url + 'matrimonio/matrimonio/guardaMatrimonio',
            // data: $("#formMatrimonio").serialize(),
            data: {accion: $('#accion').val(),
                idmatrimonio: $("#idmatrimonio").val(),
                estado: $("#estado").val(),
                id_diocesis: $("#id_diocesis").val(),
                id_base: $("#id_base").val(),
                id_grupo: $("#id_grupo").val(),
                fecha_ingreso: $("#fecha_ingreso").val(),
                fecha_membresia: $("#fecha_membresia").val(),
                fecha_encuentro: $("#fecha_encuentro").val(),
                nro_encuentro: $("#nro_encuentro").val(),
                casa_retiro: $("#casa_retiro").val(),
                nombre_el: $("#nombre_el").val(),
                apellidos_el: $("#apellidos_el").val(),
                cedula_el: $("#cedula_el").val(),
                celular_el: $("#celular_el").val(),
                profesion_el: $("#profesion_el").val(),
                fecha_nac_el: $("#fecha_nac_el").val(),
                correo_el: $("#correo_el").val(),
                nacionalidad_el: $("#nacionalidad_el").val(),
                lugar_nac_el: $("#lugar_nac_el").val(),
                tel_laboral_el: $("#tel_laboral_el").val(),
                lugar_trabajo_el: $("#lugar_trabajo_el").val(),
                grupo_san_el: $("#grupo_san_el").val(),
                nombre_ella: $("#nombre_ella").val(),
                apellidos_ella: $("#apellidos_ella").val(),
                cedula_ella: $("#cedula_ella").val(),
                celular_ella: $("#celular_ella").val(),
                profesion_ella: $("#profesion_ella").val(),
                fecha_nac_ella: $("#fecha_nac_ella").val(),
                correo_ella: $("#correo_ella").val(),
                nacionalidad_ella: $("#nacionalidad_ella").val(),
                lugar_nac_ella: $("#lugar_nac_ella").val(),
                tel_laboral_ella: $("#tel_laboral_ella").val(),
                lugar_trabajo_ella: $("#lugar_trabajo_ella").val(),
                grupo_san_ella: $("#grupo_san_ella").val(),
                direccion: $("#calle").val(),
                ciudad: $("#ciudad").val(),
                barrio: $("#barrio").val(),
                telefono: $("#telefono").val(),
                aniversario: $("#aniversario").val(),
                cant_personas: $('#cant_personas').val(),
                terceras_personas: $('#terceras_personas').val(),
                movilidad: $('#movilidad').val(),
                como_trasladan: $('#como_trasladan').val(),
                estado_marital: $('#estado_marital').val(),
                parroquia_boda: $('#parroquia_boda').val(),
                parroquia_capilla: $('#parroquia_capilla').val(),
                tipo_matrimonio: $('#tipo_matrimonio').val(),
                direccion_parroquia: $('#direccion_parroquia').val()
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
                _reiniciarTablero("tablero_matrimonio");

            }
        });
    });
    $('#contieneFormBaja').on('click', '#guardarBaja', function () {

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
            url: url + 'matrimonio/matrimonio/guardaBaja',
            data: {
                idmatrimonio: $('#idmatrimonio').val(),
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
                _reiniciarTablero("tablero_matrimonio");

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

function verificaCedula(elemento, param) {

    var cod = param.value;
    var url = $('#url_b').val();
    if (cod == null || cod == "" || cod == "0") {
        $("#" + elemento).focus();
        notificacionGlobal('Mensaje', "Nro de Cédula es Obligatorio", 'error', 5000);
        return false;
    }
    $.ajax({
        dataType: 'json',
        url: url + 'matrimonio/matrimonio/verificaCedula',
        data: {nroCedula: cod},
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
        url: url + 'matrimonio/matrimonio/getGrupos',
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

