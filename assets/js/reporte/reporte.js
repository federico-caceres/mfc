/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $.datepicker.regional['es'] =
            {
                closeText: 'Cerrar',
                prevText: 'Previo',
                nextText: 'Próximo',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                dateFormat: 'dd/mm/yy', firstDay: 0,
                initStatus: 'Selecciona la fecha', isRTL: false};

    $.datepicker.setDefaults($.datepicker.regional['es']);

    $("#id_ggDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_ggHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_ebDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_ebHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rtDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: "-1D",
        changeMonth: true,
        changeYear: true
    });
    $("#id_rtHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: "-1D",
        changeMonth: true,
        changeYear: true
    });
    $("#id_rEDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rEHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rVTDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rVTHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rVCardifDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rVCardifHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rVOcularDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rVOcularHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rAHaberesDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rAHaberesHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rAHaberesFAudit").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rSupervUnifDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rSupervUnifHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rPaqueteDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rPaqueteHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCordialUnifDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCordialUnifHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rSupervSegDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rSupervSegHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCobRaicesDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCobRaicesHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCobranzasDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCobranzasHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rAuditoriaDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rAuditoriaHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rDebAutomDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rDebAutomHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rTCAdicDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rTCAdicHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCobranzaGDesde").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });
    $("#id_rCobranzaGHasta").datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true,
        regional: 'es',
        orientation: 'bottom auto',
        todayBtn: 'linked',
        todayHighlight: true,
        //minDate: "-4M",
        maxDate: 0,
        changeMonth: true,
        changeYear: true
    });

});

$('[id^="Generic_btn_search_"]').click(function () {

    var tipo = $(this).attr('id').split('_');
    tipo = tipo[(tipo.length - 1)];
    $.ajax({
        url: $('#url_b').val() + 'reporte/Reporte_control/get_filtroReporte/' + $('#id_cliente').val() + '/' + $('#id_campana').val(),
        data: {
            nameReporte: tipo,
            fecha_desde: $('[id^="Generic_fec_desde_"]').val(),
            fecha_hasta: $('[id^="Generic_fec_hasta_"]').val()
        },
        type: 'POST',
        dataType: 'JSON',
        success: function (data, textStatus, jqXHR) {
            if (data.success) {
                $('#contenedorInferior').empty();
                $('#contenedorInferior').html(data.vista);
                $('[id^="Generic_btn_success_"]').attr('disabled', !data.thereIs);
            } else {
                notificacionGlobal('Alerta', data.msg, 'error', 3000);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
            $('#contenedorInferior').empty();
            $('#contenedorInferior').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/error.gif"></div>');
        },
        beforeSend: function (xhr) {
            $('#contenedorInferior').empty();
            $('#contenedorInferior').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        }
    });
});

$('[id^="Generic_btn_success_"]').click(function () {

    var tipo = $(this).attr('id').split('_');
    tipo = tipo[(tipo.length - 1)];
    $.ajax({
        url: $('#url_b').val() + 'reporte/Reporte_control/genera_reporte/' + $('#id_cliente').val() + '/' + $('#id_campana').val(),
        data: {
            nameReporte: tipo,
            fecha_desde: $('[id^="Generic_fec_desde_"]').val(),
            fecha_hasta: $('[id^="Generic_fec_hasta_"]').val()
        },
        type: 'POST',
        dataType: 'JSON',
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                (data.txt) ?
                        $('<a />', {
                            'href': data.ubicacion_archivo + data.nameFile,
                            'download': data.nameFile,
                            'text': "click"
                        }).hide().appendTo("body")[0].click() :
                        location.href = data.nameFile;

                notificacionGlobal('Archivo', "Generado correctamente", 'success', 4500);


            } else {
                notificacionGlobal('Alerta', data.msg, 'error', 3000);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/error.gif"></div>');
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        }
    })
});

$("#btn_search_GG").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idggDesde = $("#id_ggDesde").val();
    var idggHasta = $("#id_ggHasta").val();
    var id_ggDesde = idggDesde ? idggDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_ggHasta = idggHasta ? idggHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var myUrl = "reporte/Reporte_control/lstGestionesGenerales/" + id_cliente + "/" + id_campana + "/" + id_ggDesde + "/" + id_ggHasta;
    $.ajax({
        url: myUrl,
        data: {id_cliente: id_cliente, id_campana: id_campana},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ClientGGrales);
            _reiniciarTablero('tablero_gestionesGenerales');
            localStorage.activeDevice = data.device;
        }
    });
});

$("#btn_search_EB").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idebDesde = $("#id_ebDesde").val();
    var idebHasta = $("#id_ebHasta").val();
    var shot = $("#shot_txt").val();
    var id_ebDesde = idebDesde ? idebDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_ebHasta = idebHasta ? idebHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var myUrl = "reporte/Reporte_control/lstBases/" + id_cliente + "/" + id_campana + "/" + id_ebDesde + "/" + id_ebHasta;
    $.ajax({
        url: myUrl,
        data: {id_cliente: id_cliente, id_campana: id_campana, shot_txt: shot},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.bases);
            _reiniciarTablero('tablero_bases');

        }
    });
});
$("#btn_search_EB_Cordial").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idebDesde = $("#id_ebDesde").val();
    var idebHasta = $("#id_ebHasta").val();
    var id_ebDesde = idebDesde ? idebDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_ebHasta = idebHasta ? idebHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var myUrl = "reporte/Reporte_control/lstBasesCordial/" + id_cliente + "/" + id_campana + "/" + id_ebDesde + "/" + id_ebHasta;
    $.ajax({
        url: myUrl,
        data: {id_cliente: id_cliente, id_campana: id_campana},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.bases);
            _reiniciarTablero('tablero_bases');

        }
    });
});

$("#btn_search_HistGest").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idggDesde = $("#id_ggDesde").val();
    var idggHasta = $("#id_ggHasta").val();
    var id_ggDesde = idggDesde ? idggDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_ggHasta = idggHasta ? idggHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var myUrl = "reporte/Reporte_control/GetReporteHistGest/" + id_cliente + "/" + id_campana + "/" + id_ggDesde + "/" + id_ggHasta;
    $.ajax({
        url: myUrl,
        data: {id_cliente: id_cliente, id_campana: id_campana},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteHistGest);
            _reiniciarTablero('tablero_HistGest');
            localStorage.activeDevice = data.device;
        }
    });
});

$("#btn_search_RT").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrtDesde = $("#id_rtDesde").val();
    var idrtHasta = $("#id_rtHasta").val();
    var id_rtDesde = idrtDesde ? idrtDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rtHasta = idrtHasta ? idrtHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var myUrl = "reporte/Reporte_control/lstReporteTelefonia/" + id_cliente + "/" + id_campana + "/" + id_rtDesde + "/" + id_rtHasta;
    $.ajax({
        url: myUrl,
        data: {id_cliente: id_cliente, id_campana: id_campana},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.reporteTelefonia);
            _reiniciarTablero('tablero_reporteTelefonia');
        }
    });
});

$("#btn_search_VA").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrEDesde = $("#id_rEDesde").val();
    var idrEHasta = $("#id_rEHasta").val();
    var id_rEDesde = idrEDesde ? idrEDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rEHasta = idrEHasta ? idrEHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var myUrl = "reporte/Reporte_control/GetReporteVentasArticulos/" + id_cliente + "/" + id_campana + "/" + id_rEDesde + "/" + id_rEHasta;
    $.ajax({
        url: myUrl,
        data: {id_cliente: id_cliente, id_campana: id_campana},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteVentasArticulos);
            _reiniciarTablero('tablero_reporteVentasServicios');
        }
    });
});

$("#btn_search_V").click(function () {

    var url = $('#url_b').val();
    var logo_url = localStorage.url_logo;
    var id_cliente = $('#id_cliente').val();
    var id_campana = $('#id_campana').val();
    var fec_desdeV = $("#fec_desdeV").val();
    var fec_hastaV = $("#fec_hastaV").val();
    var fecDesdeV = fec_desdeV ? fec_desdeV.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var fecHastaV = fec_hastaV ? fec_hastaV.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: url + 'reporte/Reporte_control/viewVodafoneVenta',
        data: {id_cliente: id_cliente, id_campana: id_campana, logo_url: logo_url, fecDesdeV: fecDesdeV, fecHastaV: fecHastaV, campana: $('#id_campana option:selected').text(), idUsuario: idUsuario},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $("#contenedor_central").empty();
            $("#contenedor_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $("#contenedor_central").empty();
            $("#contenedor_central").html(data.vista);
            _reiniciarTablero('tablero_reporteVodafone');
        }
    });
});

$("#btn_search_Contigo").click(function () {

    var idType = $(this).attr("data-idType");
    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrCDesde = $("#id_rCDesde").val();
    var idrCHasta = $("#id_rCHasta").val();
    var id_rCDesde = idrCDesde ? idrCDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rCHasta = idrCHasta ? idrCHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesFAudit = $("#id_rAHaberesFAudit").val();
    var id_rAHaberesFAudit = id_rAHaberesFAudit ? id_rAHaberesFAudit.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var myUrl = "reporte/Reporte_control/GetReporteContigo/" + id_cliente + "/" + id_campana + "/" + id_rCDesde + "/" + id_rCHasta + "/" + id_rAHaberesFAudit;
    $.ajax({
        url: myUrl,
        data: {id_cliente: id_cliente, id_campana: id_campana, tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : '', 'idType': idType},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteContigo);
            _reiniciarTablero('tablero_reporteContigo');
        }
    });
});

$("#btn_search_Supervielle").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrVTDesde = $("#id_rVTDesde").val();
    var idrVTHasta = $("#id_rVTHasta").val();
    var id_rVTDesde = idrVTDesde ? idrVTDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rVTHasta = idrVTHasta ? idrVTHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesFAudit = $("#id_rAHaberesFAudit").val();
    var id_rAHaberesFAudit = id_rAHaberesFAudit ? id_rAHaberesFAudit.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt

    var myUrl = ((reportType === '1') ? "reporte/Reporte_control/GetReporteSupervielle/" : "reporte/Reporte_control/GetReporteSupervielleGestion/") + id_cliente + "/" + id_campana + "/" + id_rVTDesde + "/" + id_rVTHasta + "/" + id_rAHaberesFAudit;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : '', reportType: reportType},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            (data.reportType == '1') ? $("#contenedor_central").html(data.ReporteSupervielle) : $("#contenedor_central").html(data.ReporteSupervielleG);
            _reiniciarTablero('tablero_reporteSupervielle');
        }
    });
});

$("#btn_search_Cordial2").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrVCardifDesde = $("#id_rVCardifDesde").val();
    var idrVCardifHasta = $("#id_rVCardifHasta").val();
    var id_rVCardifDesde = idrVCardifDesde ? idrVCardifDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rVCardifHasta = idrVCardifHasta ? idrVCardifHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesFAudit = $("#id_rAHaberesFAudit").val();
    var id_rAHaberesFAudit = id_rAHaberesFAudit ? id_rAHaberesFAudit.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt

    var myUrl = ((reportType === '1') ? "reporte/Reporte_control/GetReporteCordial2/" : "reporte/Reporte_control/GetReporteCordial2Gestion/") + id_cliente + "/" + id_campana + "/" + id_rVCardifDesde + "/" + id_rVCardifHasta + "/" + id_rAHaberesFAudit;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : '', reportType: reportType},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            (data.reportType == '1') ? $("#contenedor_central").html(data.ReporteCordial2) : $("#contenedor_central").html(data.ReporteCordial2G);
            _reiniciarTablero('tablero_reporteCordial2');
        }
    });
});

$("#btn_search_Cordial3").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrVOcularDesde = $("#id_rVOcularDesde").val();
    var idrVOcularHasta = $("#id_rVOcularHasta").val();
    var id_rVOcularDesde = idrVOcularDesde ? idrVOcularDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rVOcularHasta = idrVOcularHasta ? idrVOcularHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteCordial3/" + id_cliente + "/" + id_campana + "/" + id_rVOcularDesde + "/" + id_rVOcularHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteCordial3);
            _reiniciarTablero('tablero_reporteCordial3');
        }
    });
});

$("#btn_search_AHaberes").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrAHaberesDesde = $("#id_rAHaberesDesde").val();
    var idrAHaberesHasta = $("#id_rAHaberesHasta").val();
    var id_rAHaberesDesde = idrAHaberesDesde ? idrAHaberesDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesHasta = idrAHaberesHasta ? idrAHaberesHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesFAudit = $("#id_rAHaberesFAudit").val();
    var id_rAHaberesFAudit = id_rAHaberesFAudit ? id_rAHaberesFAudit.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt 4-Otro

    var myUrl = ((reportType === '1') ? "reporte/Reporte_control/GetReporteAHaberes/" : "reporte/Reporte_control/GetReporteAHaberesGestion/") + id_cliente + "/" + id_campana + "/" + id_rAHaberesDesde + "/" + id_rAHaberesHasta + "/" + id_rAHaberesFAudit;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : '', reportType: reportType},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            (data.reportType == '1') ? $("#contenedor_central").html(data.ReporteAHaberes) : $("#contenedor_central").html(data.ReporteAHaberesG);
            _reiniciarTablero('tablero_reporteAHaberes');
        }
    });
});

$("#btn_search_DebAutom").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrDebAutomDesde = $("#id_rDebAutomDesde").val();
    var idrDebAutomHasta = $("#id_rDebAutomHasta").val();
    var id_rDebAutomDesde = idrDebAutomDesde ? idrDebAutomDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rDebAutomHasta = idrDebAutomHasta ? idrDebAutomHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt 4-Otro

    var myUrl = ((reportType === '1') ? "reporte/Reporte_control/GetReporteDebAutom/" : ((reportType === '2') ? "reporte/Reporte_control/GetReporteDebAutomGestion/" : "reporte/Reporte_control/GetReporteDebAutomGestion/")) + id_cliente + "/" + id_campana + "/" + id_rDebAutomDesde + "/" + id_rDebAutomHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : '', reportType: reportType},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            (data.reportType == '1') ? $("#contenedor_central").html(data.ReporteDebAutom) : $("#contenedor_central").html(data.ReporteDebAutomG);
            _reiniciarTablero('tablero_reporteDebAutom');
        }
    });
});

$("#btn_search_SupervUnif").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_rSupervUnifCampana").val();
    var idrSupervUnifDesde = $("#id_rSupervUnifDesde").val();
    var idrSupervUnifHasta = $("#id_rSupervUnifHasta").val();
    var id_rSupervUnifDesde = idrSupervUnifDesde ? idrSupervUnifDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rSupervUnifHasta = idrSupervUnifHasta ? idrSupervUnifHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesFAudit = $("#id_rAHaberesFAudit").val();
    var id_rAHaberesFAudit = id_rAHaberesFAudit ? id_rAHaberesFAudit.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteSupervUnif/" + id_cliente + "/" + id_campana + "/" + id_rSupervUnifDesde + "/" + id_rSupervUnifHasta + "/" + id_rAHaberesFAudit;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteSupervUnif);
            _reiniciarTablero('tablero_reporteSupervUnif');
        }
    });
});

$("#btn_search_Paquete").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrPaqueteDesde = $("#id_rPaqueteDesde").val();
    var idrPaqueteHasta = $("#id_rPaqueteHasta").val();
    var id_rPaqueteDesde = idrPaqueteDesde ? idrPaqueteDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rPaqueteHasta = idrPaqueteHasta ? idrPaqueteHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReportePaquete/" + id_cliente + "/" + id_campana + "/" + id_rPaqueteDesde + "/" + id_rPaqueteHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReportePaquete);
            _reiniciarTablero('tablero_reportePaquete');
        }
    });
});

$("#btn_search_CordialUnif").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrCordialUnifDesde = $("#id_rCordialUnifDesde").val();
    var idrCordialUnifHasta = $("#id_rCordialUnifHasta").val();
    var id_rshot = $("#id_rshot").val();
    var id_rsegmento = $("#id_rSegmento").val();
    var id_rCordialUnifDesde = idrCordialUnifDesde ? idrCordialUnifDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rCordialUnifHasta = idrCordialUnifHasta ? idrCordialUnifHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesFAudit = $("#id_rAHaberesFAudit").val();
    var id_rAHaberesFAudit = id_rAHaberesFAudit ? id_rAHaberesFAudit.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteCordialUnif/" + id_cliente + "/" + id_campana + "/" + id_rCordialUnifDesde + "/" + id_rCordialUnifHasta + "/" + id_rAHaberesFAudit;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : '', id_rshot: id_rshot, id_rsegmento: id_rsegmento, fecAudit: id_rAHaberesFAudit},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteCordialUnif);

            _reiniciarTablero('tablero_reporteCordialUnif');

            $('#id_rshot').chosen('destroy').val(id_rshot).chosen();
            $("#id_rshot").trigger("chosen:updated");
            $('#id_rSegmento').chosen('destroy').val(id_rsegmento).chosen();
            $("#id_rSegmento").trigger("chosen:updated");
        }
    });
});

$("#btn_search_TCAdic").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrTCAdicDesde = $("#id_rTCAdicDesde").val();
    var idrTCAdicHasta = $("#id_rTCAdicHasta").val();
    var id_rTCAdicDesde = idrTCAdicDesde ? idrTCAdicDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rTCAdicHasta = idrTCAdicHasta ? idrTCAdicHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteTCAdic/" + id_cliente + "/" + id_campana + "/" + id_rTCAdicDesde + "/" + id_rTCAdicHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteTCAdic);
            _reiniciarTablero('tablero_reporteTCAdic');
        }
    });
});

$("#btn_search_CobranzaG").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrCobranzaGDesde = $("#id_rCobranzaGDesde").val();
    var idrCobranzaGHasta = $("#id_rCobranzaGHasta").val();
    var id_rCobranzaGDesde = idrCobranzaGDesde ? idrCobranzaGDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rCobranzaGHasta = idrCobranzaGHasta ? idrCobranzaGHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteCobranzaG/" + id_cliente + "/" + id_campana + "/" + id_rCobranzaGDesde + "/" + id_rCobranzaGHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteCobranzaG);
            _reiniciarTablero('tablero_reporteCobranzaG');
        }
    });
});

$("#btn_search_SupervSeg").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrSupervSegDesde = $("#id_rSupervSegDesde").val();
    var idrSupervSegHasta = $("#id_rSupervSegHasta").val();
    var id_rSupervSegDesde = idrSupervSegDesde ? idrSupervSegDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rSupervSegHasta = idrSupervSegHasta ? idrSupervSegHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteSupervSeg/" + id_cliente + "/" + id_campana + "/" + id_rSupervSegDesde + "/" + id_rSupervSegHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteSupervSeg);
            _reiniciarTablero('tablero_reporteSupervSeg');
        }
    });
});

$("#btn_search_CobRaices").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrCobRaicesDesde = $("#id_rCobRaicesDesde").val();
    var idrCobRaicesHasta = $("#id_rCobRaicesHasta").val();
    var id_rCobRaicesDesde = idrCobRaicesDesde ? idrCobRaicesDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rCobRaicesHasta = idrCobRaicesHasta ? idrCobRaicesHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteCobRaices/" + id_cliente + "/" + id_campana + "/" + id_rCobRaicesDesde + "/" + id_rCobRaicesHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + localStorage.base_url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteCobRaices);
            _reiniciarTablero('tablero_reporteCobRaices');
        }
    });
});

$("#btn_search_Cobranzas").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrCobranzasDesde = $("#id_rCobranzasDesde").val();
    var idrCobranzasHasta = $("#id_rCobranzasHasta").val();
    var id_rCobranzasDesde = idrCobranzasDesde ? idrCobranzasDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rCobranzasHasta = idrCobranzasHasta ? idrCobranzasHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteRaices/" + id_cliente + "/" + id_campana + "/" + id_rCobranzasDesde + "/" + id_rCobranzasHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + localStorage.base_url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteCobranzas);
            _reiniciarTablero('tablero_reporteCobranzas');
        }
    });
});

$("#btn_search_Auditoria").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrAuditoriaDesde = $("#id_rAuditoriaDesde").val();
    var idrAuditoriaHasta = $("#id_rAuditoriaHasta").val();
    var id_rAuditoriaDesde = idrAuditoriaDesde ? idrAuditoriaDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAuditoriaHasta = idrAuditoriaHasta ? idrAuditoriaHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var myUrl = "reporte/Reporte_control/GetReporteAuditoria/" + id_cliente + "/" + id_campana + "/" + id_rAuditoriaDesde + "/" + id_rAuditoriaHasta;

    $.ajax({
        url: myUrl,
        data: {tipoProducto: localStorage.tipoProducto ? localStorage.tipoProducto : ''},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteAuditoria);
            _reiniciarTablero('tablero_reporteAuditoria');
        }
    });
});

$("#btn_search_RE").click(function () {

    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrEDesde = $("#id_rEDesde").val();
    var idrEHasta = $("#id_rEHasta").val();
    var id_rEDesde = idrEDesde ? idrEDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rEHasta = idrEHasta ? idrEHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var myUrl = "reporte/Reporte_control/GetReporteEncuestas/" + id_cliente + "/" + id_campana + "/" + id_rEDesde + "/" + id_rEHasta;
    $.ajax({
        url: myUrl,
        data: {id_cliente: id_cliente, id_campana: id_campana},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').empty();
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            $("#contenedor_central").empty();
            $('#getUpImg').empty();
            $("#contenedor_central").html(data.ReporteEncuestas);
            _reiniciarTablero('tablero_reporteEncuestas');
            localStorage.activeDevice = data.device;
        }
    });
});

$("#btn_excel_GG").click(function () {

    var data_flag = $(this).attr("data-flag");
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelListaGestiones/" + data_flag + '/' + idUsuario + '/' + localStorage.token,
        data: {campana: $('#id_campana option:selected').text()},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {
                location.href = data.ubicacion_archivo;
                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_EB").click(function () {

    var data_flag = $(this).attr("data-flag");
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelListaBases/" + data_flag + '/' + idUsuario + '/' + localStorage.token,
        data: {campana: $('#id_campana option:selected').text()},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {
                location.href = data.ubicacion_archivo;
                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_HistGest").click(function () {

    var data_flag = $(this).attr("data-flag");
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelHistGest/" + data_flag + '/' + idUsuario + '/' + localStorage.token,
        data: {campana: $('#id_campana option:selected').text()},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {
                location.href = data.ubicacion_archivo;
                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_Contigo").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    var idType = $(this).attr("data-idType");
    $.ajax({
        url: "reporte/Reporte_control/GetExcelContigo/" + ((idType === '4') ? '9999' : idUsuario) + '/' + localStorage.token,
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {
                location.href = data.ubicacion_archivo;
                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_Supervielle").click(function () {

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt 
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    
    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrVTDesde = $("#id_rVTDesde").val();
    var idrVTHasta = $("#id_rVTHasta").val();
    var id_rVTDesde = idrVTDesde ? idrVTDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rVTHasta = idrVTHasta ? idrVTHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesFAudit = $("#id_rAHaberesFAudit").val();
    var id_rAHaberesFAudit = id_rAHaberesFAudit ? id_rAHaberesFAudit.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt

    $.ajax({
        url: "reporte/Reporte_control/GetExcelSupervielle/" + idUsuario + '/' + localStorage.token,
        data: {reportType: reportType, id_cliente: id_cliente,id_campana: id_campana,id_rVTDesde: id_rVTDesde,id_rVTHasta: id_rVTHasta,id_rAHaberesFAudit: id_rAHaberesFAudit},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                (data.reportType === '3' || data.reportType === '5') ?
                        $('<a />', {
                            'href': data.ubicacion_archivo,
                            'download': data.nombre_archivo,
                            'text': "click"
                        }).hide().appendTo("body")[0].click() :
                        location.href = data.ubicacion_archivo;

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_Cordial2").click(function () {

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt 
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelCordial2/" + idUsuario + '/' + localStorage.token,
        data: {reportType: reportType},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                ((data.reportType === '3') || (data.reportType === '7')) ?
                        $('<a />', {
                            'href': data.ubicacion_archivo,
                            'download': data.nombre_archivo,
                            'text': "click"
                        }).hide().appendTo("body")[0].click() :
                        location.href = data.ubicacion_archivo;

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_Cordial3").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelCordial3/" + idUsuario + '/' + localStorage.token,
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {
                location.href = data.ubicacion_archivo;
                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_AHaberes").click(function () {

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt 4-Otro
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    
    var id_cliente = $("#id_cliente").val();
    var id_campana = $("#id_campana").val();
    var idrAHaberesDesde = $("#id_rAHaberesDesde").val();
    var idrAHaberesHasta = $("#id_rAHaberesHasta").val();
    var id_rAHaberesDesde = idrAHaberesDesde ? idrAHaberesDesde.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesHasta = idrAHaberesHasta ? idrAHaberesHasta.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var id_rAHaberesFAudit = $("#id_rAHaberesFAudit").val();
    var id_rAHaberesFAudit = id_rAHaberesFAudit ? id_rAHaberesFAudit.replace("/", "-", "g").replace("/", "-", "g") : '-1';

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt 4-Otro

    $.ajax({
        url: "reporte/Reporte_control/GetExcelAHaberes/" + idUsuario + '/' + localStorage.token,
        data: {reportType: reportType,id_cliente: id_cliente, id_campana: id_campana, id_rAHaberesDesde: id_rAHaberesDesde, id_rAHaberesHasta: id_rAHaberesHasta, id_rAHaberesFAudit: id_rAHaberesFAudit},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                (data.reportType === '3') ?
                        $('<a />', {
                            'href': data.ubicacion_archivo,
                            'download': data.nombre_archivo,
                            'text': "click"
                        }).hide().appendTo("body")[0].click() :
                        location.href = data.ubicacion_archivo;

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_DebAutom").click(function () {

    var reportType = $(this).attr("data-reportType");   //1-Ventas 2-Excel 3-Txt 4-Otro
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelDebAutom/" + idUsuario + '/' + localStorage.token,
        data: {reportType: reportType},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                ((data.reportType === '3') || (data.reportType === '7') || (data.reportType === '8')) ?
                        $('<a />', {
                            'href': data.ubicacion_archivo,
                            'download': data.nombre_archivo,
                            'text': "click"
                        }).hide().appendTo("body")[0].click() :
                        location.href = data.ubicacion_archivo;

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_SupervUnif").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelSupervUnif/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                $('<a />', {
                    'href': data.ubicacion_archivo,
                    'download': data.nombre_archivo,
                    'text': "click"
                }).hide().appendTo("body")[0].click();

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_Paquete").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelPaquete/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                $('<a />', {
                    'href': data.ubicacion_archivo,
                    'download': data.nombre_archivo,
                    'text': "click"
                }).hide().appendTo("body")[0].click();

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_CordialUnif").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelCordialUnif/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                $('<a />', {
                    'href': data.ubicacion_archivo,
                    'download': data.nombre_archivo,
                    'text': "click"
                }).hide().appendTo("body")[0].click();

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_SupervSeg").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelSupervSeg/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                $('<a />', {
                    'href': data.ubicacion_archivo,
                    'download': data.nombre_archivo,
                    'text': "click"
                }).hide().appendTo("body")[0].click();

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_CobRaices").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelCobRaices/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + localStorage.base_url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                $('<a />', {
                    'href': data.ubicacion_archivo,
                    'download': data.nombre_archivo,
                    'text': "click"
                }).hide().appendTo("body")[0].click();

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_Cobranzas").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelCobranzas/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + localStorage.base_url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                $('<a />', {
                    'href': data.ubicacion_archivo,
                    'download': data.nombre_archivo,
                    'text': "click"
                }).hide().appendTo("body")[0].click();

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_Auditoria").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelAuditoria/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                location.href = data.ubicacion_archivo;

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_TCAdic").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelTCAdic/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                location.href = data.ubicacion_archivo;

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_CobranzaG").click(function () {

    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelCobranzaG/" + idUsuario + '/' + localStorage.token,
        data: {reportType: 1},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {

                location.href = data.ubicacion_archivo;

                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_RT").click(function () {

    var data_flag = $(this).attr("data-flag");
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    $.ajax({
        url: "reporte/Reporte_control/GetExcelReporteTelefonia/" + data_flag + '/' + idUsuario + '/' + localStorage.token,
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {
                location.href = data.ubicacion_archivo;
                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_VA").click(function () {

    $.ajax({
        url: "reporte/Reporte_control/GetExcelListaVentasServicios/" + localStorage.token,
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {
                location.href = data.ubicacion_archivo;
                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});

$("#btn_excel_V").click(function () {

    var url = $('#url_b').val();
    var logo_url = localStorage.url_logo;
    var id_cliente = $('#id_cliente').val();
    var id_campana = $('#id_campana').val();
    var fec_desdeV = $("#fec_desdeV").val();
    var fec_hastaV = $("#fec_hastaV").val();
    var fecDesdeV = fec_desdeV ? fec_desdeV.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var fecHastaV = fec_hastaV ? fec_hastaV.replace("/", "-", "g").replace("/", "-", "g") : '-1';
    var idUsuario = JSON.parse(localStorage.access_data)[0].id;
    var flag = $(this).attr("data-flag");

    $.ajax({
        url: url + 'reporte/Reporte_control/excelVodafoneVenta',
        data: {flag: flag, id_cliente: id_cliente, id_campana: id_campana, logo_url: logo_url, fecDesdeV: fecDesdeV, fecHastaV: fecHastaV, campana: $('#id_campana option:selected').text(), idUsuario: idUsuario},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#getUpImg').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {
            $('#getUpImg').empty();
            if (data.success) {
                location.href = data.ubicacion_archivo;
                data.txt ? notificacionGlobal('Excel', data.txt, 'success', 4500) : '';
            } else {
                data.txt ? notificacionGlobal('Alerta', data.txt, 'error', 4500) : '';
            }
        }
    });
});
