var path_tablero;
var stack_context = undefined;
$(document).ready(function () {
    $(".dropdown-menu")
            .mouseenter(function () {
                $(this).parent('li').addClass('active');
            })
            .mouseleave(function () {
                $(this).parent('li').removeClass('active');
            });

    $("#contenedor_menu").on("click", "#menuLogout", function (e) {
        logout();
    });

    $('body').on('click', '#cancelarGrupo', function () {
        listaGrupos();
    });
    $('body').on('click', '#cancelarBase', function () {
        listaBases();
    });

    $('body').on('click', '#cancelarS05', function () {
        var idGrupo = ($("#id_grupo").val() === "-1") ? $("#idGrupoS05").val() : $("#id_grupo").val();
        listaS05(idGrupo);
    });

    $('body').on('change', '#tipo_baja', function () {

        if ($("#tipo_baja").val() === "TRASLADO")
        {
            $("#idTraslado").css("display", "block");


        } else {
            $("#idTraslado").css("display", "none");

        }

    });

    $('body').on('click', '#cancelarMiembro', function () {
        var idgrupo = $(this).attr("data-idgrupo");
        listaMiembros(idgrupo);
    });

    $('body').on('click', '#cancelarJoven', function () {
        listaJovenes();
    });

    $('#btn_inicio').click(function () {
        location.href = $('#url_b').val() + 'principal';
    });

    $('#contenedor_menu').on('click', '#menuMatrimonios', function () {
        listaMatrimonios();
    });

    $('#contenedor_menu').on('click', '#menuS07', function () {
        listaS07();
    });

    $('body').on('click', '#cancelarBaja', function () {
        listaMatrimonios();
    });

    $('body').on('click', '#cancelarBajaJoven', function () {
        listaJovenes();
    });

    $('#contenedor_general').on('click', '#btn_matrimonio_nuevo', function () {
        nuevoMatrimonio("0", "-1");
    });

    $('#botonesAccion').on('click', '#editarMatrimonio', function () {
        var idmatrimonio = $(this).attr("data-idmatrimonio");
        nuevoMatrimonio("1", idmatrimonio);
    });

    $('#contenedor_menu').on('click', '#menuJovenes', function () {
        listaJovenes();
    });

    $('#contenedor_general').on('click', '#btn_joven_nuevo', function () {
        nuevoJoven("0", "-1");
    });

    $('#botonesAccion').on('click', '#editarJoven', function () {
        var idjoven = $(this).attr("data-idjoven");
        nuevoJoven("1", idjoven);
    });

    $('#div_contenedor_menu').on('click', '#menuUsuarios', function () {
        listaUsuarios();
    });

    $('#contenedor_general').on('click', '#btn_usuario_nuevo', function () {
        nuevoUsuario("0", "-1");
    });
    $('#botonesAccion').on('click', '#editarUsuario', function () {

        var idusuario = $(this).attr("data-idusuario");
        nuevoUsuario("1", idusuario);
    });

    $('#div_contenedor_menu').on('click', '#menuCambiaPassword', function () {
        cambiaPassword("-1");
    });
    $('#botonesAccion').on('click', '#cambiaPassword', function () {
        var idusuario = $(this).attr("data-idusuario");
        cambiaPassword(idusuario);
    });

    //grupos

    $('#div_contenedor_menu').on('click', '#menuGrupos', function () {
        listaGrupos();
    });

    $('#div_contenedor_menu').on('click', '#menuBases', function () {
        listaBases();
    });

    $('#contenedor_general').on('click', '#btn_grupo_nuevo', function () {
        nuevoGrupo("0", "-1");
    });
    $('#contenedor_general').on('click', '#btn_base_nuevo', function () {
        nuevaBase("0", "-1");
    });

    $('#botonesAccion').on('click', '#editarGrupo', function () {
        var idgrupo = $(this).attr("data-idgrupo");
        nuevoGrupo("1", idgrupo);
    });
    $('#botonesAccion').on('click', '#editarBase', function () {
        var idbase = $(this).attr("data-idbase");
        nuevaBase("1", idbase);
    });

    $('#contenedor_general').on('click', '#btn_miembro_nuevo', function () {
        var idgrupo = $(this).attr("data-idgrupo");
        nuevoMiembro("0", idgrupo);
    });

    $('#botonesAccion').on('click', '#eliminarMiembro', function () {
        var idgrupo = $(this).attr("data-idgrupo");
        var idmatrimonio = $(this).attr("data-idmatrimonio");
        eliminaMiembro(idgrupo, idmatrimonio);
    });

    $('#contenedor_general').on('click', '#guardarS05', function () {
        guardaS05();
    });

    $('#contenedor_central').on('click', '#guardarGrupo', function () {
        guardaGrupo();
    });
    $('#contenedor_central').on('click', '#guardarBase', function () {
        guardaBase();
    });
    //grupos jovenes

    $('#div_contenedor_menu').on('click', '#menuGruposJovenes', function () {
        listaGruposJoven();
    });

    $('#contenedor_general').on('click', '#btn_grupoJoven_nuevo', function () {
        nuevoGrupoJoven("0", "-1");
    });

    $('#botonesAccion').on('click', '#editarGrupoJoven', function () {
        var idgrupoJoven = $(this).attr("data-idgrupo");
        nuevoGrupoJoven("1", idgrupoJoven);
    });

    $('#contenedor_general').on('click', '#btn_miembroJoven_nuevo', function () {
        var idgrupoJoven = $(this).attr("data-idgrupo");
        nuevoMiembroJoven("0", idgrupoJoven);
    });

    $('#botonesAccion').on('click', '#eliminarMiembroJoven', function () {
        var idgrupoJoven = $(this).attr("data-idgrupoJoven");
        var idjoven = $(this).attr("data-idjoven");
        eliminaMiembroJoven(idgrupoJoven, idjoven);
    });

    $('#contenedor_general').on('click', '#guardarS05Joven', function () {
        guardaS05Joven();
    });
    $('#contenedor_general').on('click', '#guardarS02', function () {
        var idmatrimonio = $(this).attr("data-idmatrimonio");
        agregaCurso(idmatrimonio);
    });
    $('#contenedor_general').on('click', '#guardarS06', function () {
        var idmatrimonio = $(this).attr("data-idmatrimonio");
        agregaAporte(idmatrimonio);
    });
    $('#contenedor_general').on('click', '#guardarSJ06', function () {
        var idjoven = $(this).attr("data-idjoven");
        agregaAporteJovenes(idjoven);
    });
    $('#contenedor_general').on('click', '#guardarSJ02', function () {
        var idjoven = $(this).attr("data-idjoven");
        agregaCursoJovenes(idjoven);
    });

    $('#contenedor_central').on('click', '#guardarGrupoJoven', function () {
        guardaGrupoJoven();
    });

    $('body').on('click', '#bajaJoven', function () {
        var idjoven = $(this).attr("data-idjoven");
        bajaJoven(idjoven);
    });
    $('body').on('click', '#bajaMatrimonio', function () {
        var idmatrimonio = $(this).attr("data-idmatrimonio");
        bajaMatrimonio(idmatrimonio);
    });
    $('body').on('click', '#reactivarMatrimonio', function () {
        var idmatrimonio = $(this).attr("data-idmatrimonio");
        reactivarMatrimonio(idmatrimonio);
    });
    $('body').on('click', '#cargaS02', function () {
        var idmatrimonio = $(this).attr("data-idmatrimonio");
        s02(idmatrimonio);
    });
    $('body').on('click', '#cargaS06', function () {
        var idmatrimonio = $(this).attr("data-idmatrimonio");
        s06(idmatrimonio);
    });
    $('body').on('click', '#cargaSJ06', function () {
        var idjoven = $(this).attr("data-idjoven");
        sj06(idjoven);
    });
    $('body').on('click', '#cargaSJ02', function () {
        var idjoven = $(this).attr("data-idjoven");
        sj02(idjoven);
    });

    $('#div_contenedor_menu').on('click', '#sj01', function () {
        descargaFormulario("11");
    });
    $('#div_contenedor_menu').on('click', '#sj02', function () {
        descargaFormulario("12");
    });
    $('#div_contenedor_menu').on('click', '#sj03', function () {
        descargaFormulario("13");
    });
    $('#div_contenedor_menu').on('click', '#sj04', function () {
        descargaFormulario("14");
    });
    $('#div_contenedor_menu').on('click', '#sj05', function () {
        descargaFormulario("22");
    });
    $('#div_contenedor_menu').on('click', '#sj06', function () {
        descargaFormulario("15");
    });
    $('#div_contenedor_menu').on('click', '#sj07', function () {
        descargaFormulario("16");
    });
    $('#div_contenedor_menu').on('click', '#sj08', function () {
        descargaFormulario("17");
    });
    $('#div_contenedor_menu').on('click', '#sj09', function () {
        descargaFormulario("18");
    });
    $('#div_contenedor_menu').on('click', '#sj10', function () {
        descargaFormulario("19");
    });
    $('#div_contenedor_menu').on('click', '#s01', function () {
        descargaFormulario("1");
    });
    $('#div_contenedor_menu').on('click', '#s02', function () {
        descargaFormulario("2");
    });
    $('#div_contenedor_menu').on('click', '#s03', function () {
        descargaFormulario("3");
    });
    $('#div_contenedor_menu').on('click', '#s04', function () {
        descargaFormulario("4");
    });
    $('#div_contenedor_menu').on('click', '#s05', function () {
        descargaFormulario("5");
    });
    $('#div_contenedor_menu').on('click', '#s06', function () {
        descargaFormulario("6");
    });
    $('#div_contenedor_menu').on('click', '#s07', function () {
        descargaFormulario("7");
    });
    $('#div_contenedor_menu').on('click', '#s08', function () {
        descargaFormulario("8");
    });
    $('#div_contenedor_menu').on('click', '#s09', function () {
        descargaFormulario("9");
    });
    $('#div_contenedor_menu').on('click', '#s10', function () {
        descargaFormulario("10");
    });
    $('#div_contenedor_menu').on('click', '#estatuto', function () {
        descargaFormulario("21");
    });
    $('#div_contenedor_menu').on('click', '#reglamento', function () {
        descargaFormulario("20");
    });
    $('#div_contenedor_menu').on('click', '#menuS09', function () {
        viewReporteS09Busca();
    });
    $('#div_contenedor_menu').on('click', '#menuCuadrante', function () {
        viewReporteCuadranteBusca();
    });
    $('#div_contenedor_menu').on('click', '#menuCuadranteMiembros', function () {
        viewReporteCuadranteMiembrosBusca();
    });
    $('#div_contenedor_menu').on('click', '#menuSJ09', function () {
        viewReporteSJ09Busca();
    });
    $('#div_contenedor_menu').on('click', '#menuCuadranteJuvenil', function () {
        viewReporteCuadranteJuvenilBusca();
    });

    $('body').on('click', '#btn_search_CV', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($('#fec_desdeCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_desdeCV').val().replace("/", "-").replace("/", "-") : '-1';
        var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';
        var url_function = 'reporte/Reporte_control/viewReporteS09Tablero/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde + '/' + Fhasta;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data);
                _reiniciarTablero('tablero_reporteS09');

            }
        });
    });
    $('body').on('click', '#btn_search_CVJuvenil', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($('#fec_desdeCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_desdeCV').val().replace("/", "-").replace("/", "-") : '-1';
        var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';
        var url_function = 'reporte/Reporte_control/viewReporteSJ09Tablero/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde + '/' + Fhasta;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data);
                _reiniciarTablero('tablero_reporteSJ09');

            }
        });
    });

    $('body').on('click', '#btn_search_Cuadrante', function () {
        var nivelUsuario = $("#nivelUsuario").val();
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($('#fec_desdeCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_desdeCV').val().replace("/", "-").replace("/", "-") : '-1';
        //var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';

        if (nivelUsuario == "3" && (id_diocesis == "-1" || id_base == "-1")) {
            notificacionGlobal("Atención", "Diocesis y base son obligatorios para su nivel de acceso", "error", 5000);
            return false;
        } else {

        }
        var url_function = 'reporte/Reporte_control/viewReporteCuadranteTablero/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data);
                _reiniciarTablero('tablero_reporteCuadrante');

            }
        });
    });
    $('body').on('click', '#btn_search_CuadranteMiembros', function () {
        var nivelUsuario = $("#nivelUsuario").val();
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($('#fec_desdeCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_desdeCV').val().replace("/", "-").replace("/", "-") : '-1';
        //var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';

        if (nivelUsuario == "3" && (id_diocesis == "-1" || id_base == "-1")) {
            notificacionGlobal("Atención", "Diocesis y base son obligatorios para su nivel de acceso", "error", 5000);
            return false;
        } else {

        }
        var url_function = 'reporte/Reporte_control/viewReporteCuadranteTableroMiembros/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data);
                _reiniciarTablero('tablero_reporteCuadranteMiembros');

            }
        });
    });

    $('body').on('click', '#btn_search_ListaMatrimonios', function () {
        var nivelUsuario = $("#nivelUsuario").val();
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        if (nivelUsuario == "3" && (id_diocesis == "-1" || id_base == "-1")) {
            notificacionGlobal("Atención", "Diocesis y base son obligatorios para su nivel de acceso", "error", 5000);
            return false;
        } else {

        }
        var flag = "0";
        var url_function = 'matrimonio/Matrimonio/lista_matrimonio/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + flag;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data.vista);
                _reiniciarTablero('tablero_matrimonio');

            }
        });
    });
    $('body').on('click', '#btn_search_ListaS07', function () {
        var nivelUsuario = $("#nivelUsuario").val();
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        if (nivelUsuario == "3" && (id_diocesis == "-1" || id_base == "-1")) {
            notificacionGlobal("Atención", "Diocesis y base son obligatorios para su nivel de acceso", "error", 5000);
            return false;
        } else {

        }
        var flag = "0";
        var url_function = 's07/Matrimonio/lista_s07/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + flag;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data.vista);
                _reiniciarTablero('tablero_s07');

            }
        });
    });

    $('body').on('click', '#btn_search_ListaEquipos', function () {
        var nivelUsuario = $("#nivelUsuario").val();
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        if (nivelUsuario == "3" && (id_diocesis == "-1" || id_base == "-1")) {
            notificacionGlobal("Atención", "Diocesis y base son obligatorios para su nivel de acceso", "error", 5000);
            return false;
        } else {

        }
        var flag = "0";
        var url_function = 'grupo/Grupo/listaGrupos/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + flag;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data.vista);
                _reiniciarTablero('tablero_grupo');

            }
        });
    });
    $('body').on('click', '#btn_search_ListaBases', function () {
        var nivelUsuario = $("#nivelUsuario").val();
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        if (nivelUsuario == "3" && (id_diocesis == "-1" || id_base == "-1")) {
            notificacionGlobal("Atención", "Diocesis y base son obligatorios para su nivel de acceso", "error", 5000);
            return false;
        } else {

        }
        var flag = "0";
        var url_function = 'base/Base/listaBases/' + id_diocesis + '/' + id_base + '/' + flag;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data.vista);
                _reiniciarTablero('tablero_base');

            }
        });
    });

    $('body').on('click', '#btn_search_CuadranteJuvenil', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();

        var url_function = 'reporte/Reporte_control/viewReporteCuadranteJuvenilTablero/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel;
        $.ajax({
            url: url_function,
            //data: {reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function () {
                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {

                $("#contenedorInferiorReporte").empty();
                $("#contenedorInferiorReporte").html(data);
                _reiniciarTablero('tablero_reporteCuadranteJuvenil');

            }
        });
    });

    $('body').on('click', '#btn_excel_CV', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($('#fec_desdeCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_desdeCV').val().replace("/", "-").replace("/", "-") : '-1';
        //var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';
        var url_function = 'reporte/Reporte_control/generaReporteExcelS09/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde;


        $.ajax({
            url: url_function,
            //data: {campana: $('#id_campana option:selected').text(), flag: flag, reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function (xhr) {
                $('#contenedorInferiorReporte').attr("hidden", true);
                $('#contenedor_inferior').empty();
                $('#contenedor_inferior').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data, textStatus, jqXHR) {
                $('#contenedorInferiorReporte').attr("hidden", false);
                $('#contenedor_inferior').empty();
                location.href = data.name_archivo;
            }
        });
    });
    $('body').on('click', '#btn_excel_CVJuvenil', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($('#fec_desdeCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_desdeCV').val().replace("/", "-").replace("/", "-") : '-1';
        var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';
        var url_function = 'reporte/Reporte_control/generaReporteExcelSJ09/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde + '/' + Fhasta;


        $.ajax({
            url: url_function,
            //data: {campana: $('#id_campana option:selected').text(), flag: flag, reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function (xhr) {
                $('#contenedorInferiorReporte').attr("hidden", true);
                $('#contenedor_inferior').empty();
                $('#contenedor_inferior').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data, textStatus, jqXHR) {
                $('#contenedorInferiorReporte').attr("hidden", false);
                $('#contenedor_inferior').empty();
                location.href = data.name_archivo;
            }
        });
    });

    $('body').on('click', '#btn_excel_Cuadrante', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($("#fec_desdeCV").val().replace("/", "-").replace("/", "-")) ? ($("#fec_desdeCV").val().replace("/", "-").replace("/", "-")) : '-1';
        //var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';

        var url_function = 'reporte/Reporte_control/generaReporteExcelCuadrante/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde;
        $.ajax({
            url: url_function,
            //data: {campana: $('#id_campana option:selected').text(), flag: flag, reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function (xhr) {
                $('#contenedorInferiorReporte').attr("hidden", true);
                $('#contenedor_inferior').empty();
                $('#contenedor_inferior').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data, textStatus, jqXHR) {
                $('#contenedorInferiorReporte').attr("hidden", false);
                $('#contenedor_inferior').empty();
                location.href = data.name_archivo;
            }
        });
    });
    $('body').on('click', '#btn_excel_CuadranteMiembros', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($("#fec_desdeCV").val().replace("/", "-").replace("/", "-")) ? ($("#fec_desdeCV").val().replace("/", "-").replace("/", "-")) : '-1';
        //var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';

        var url_function = 'reporte/Reporte_control/generaReporteExcelCuadranteMiembros/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde;
        $.ajax({
            url: url_function,
            //data: {campana: $('#id_campana option:selected').text(), flag: flag, reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function (xhr) {
                $('#contenedorInferiorReporte').attr("hidden", true);
                $('#contenedor_inferior').empty();
                $('#contenedor_inferior').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data, textStatus, jqXHR) {
                $('#contenedorInferiorReporte').attr("hidden", false);
                $('#contenedor_inferior').empty();
                location.href = data.name_archivo;
            }
        });
    });
    $('body').on('click', '#btn_excel_CuadranteS07', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();
        var Fdesde = ($("#fec_desdeCV").val().replace("/", "-").replace("/", "-")) ? ($("#fec_desdeCV").val().replace("/", "-").replace("/", "-")) : '-1';
        //var Fhasta = ($('#fec_hastaCV').val().replace("/", "-").replace("/", "-")) ? $('#fec_hastaCV').val().replace("/", "-").replace("/", "-") : '-1';

        var url_function = 'reporte/Reporte_control/generaReporteExcelCuadranteS07/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel + '/' + Fdesde;
        $.ajax({
            url: url_function,
            //data: {campana: $('#id_campana option:selected').text(), flag: flag, reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function (xhr) {
                $('#contenedorInferiorReporte').attr("hidden", true);
                $('#contenedor_inferior').empty();
                $('#contenedor_inferior').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data, textStatus, jqXHR) {
                $('#contenedorInferiorReporte').attr("hidden", false);
                $('#contenedor_inferior').empty();
                location.href = data.name_archivo;
            }
        });
    });
    $('body').on('click', '#btn_excel_CuadranteJuvenil', function () {
        var id_diocesis = ($("#id_diocesis").val() == "") ? "-1" : $("#id_diocesis").val();
        var id_base = ($("#id_base").val() == "") ? "-1" : $("#id_base").val();
        var id_grupo = ($("#id_grupo").val() == "") ? "-1" : $("#id_grupo").val();
        var nivel = ($("#nivel").val() == "") ? "-1" : $("#nivel").val();

        var url_function = 'reporte/Reporte_control/generaReporteExcelCuadranteJuvenil/' + id_diocesis + '/' + id_base + '/' + id_grupo + '/' + nivel;
        $.ajax({
            url: url_function,
            //data: {campana: $('#id_campana option:selected').text(), flag: flag, reportType: localStorage.reportType ? '13' : '0'},
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
            },
            beforeSend: function (xhr) {
                $('#contenedorInferiorReporte').attr("hidden", true);
                $('#contenedor_inferior').empty();
                $('#contenedor_inferior').html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data, textStatus, jqXHR) {
                $('#contenedorInferiorReporte').attr("hidden", false);
                $('#contenedor_inferior').empty();
                location.href = data.name_archivo;
            }
        });
    });
    //usuario
    $('body').on('click', '#cancelarUsuario', function () {
        listaUsuarios();
    });

    $('body').on('click', '#guardarUsuario', function () {
        $.ajax({
            url: $('#url_b').val() + 'usuario/usuario/guardaUsuario',
            // data: $("#formMatrimonio").serialize(),
            data: {accion: $('#accion').val(),
                idusuario: $("#idusuario").val(),
                estado: $("#estado").val(),
                id_diocesis: $("#id_diocesis").val(),
                id_base: $("#id_base").val(),
                id_grupo: $("#id_grupo").val(),
                usuario: $("#usuario").val(),
                nombre: $("#nombre").val(),
                nrocedula: $("#nrocedula").val(),
                password: $("#password").val(),
                mail: $("#mail").val(),
                nivel: $("#nivel").val(),
                cargo: $("#cargo").val()
            },
            type: 'POST',
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                registrar_log(registro);
                $("#cargando_central").attr("hidden", true);
                $("#contenedor_central").empty();
                notificacionGlobal('Mensaje', "No se pudo Guardar. Verifique por favor", 'error', 5000);
            },
            beforeSend: function () {
                $("#contenedor_central").empty();
                $("#contenedor_central").empty();
                $("#cargando_central").attr("hidden", false);
                $("#cargando_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {
                $("#contenedor_central").empty();
                $("#cargando_central").attr("hidden", true);
                $("#cargando_central").empty();
                $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");

                //limpiaForm("formUsuario");



                if (data.message !== "") {
                    notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
                }
                listaUsuarios();

            }
        });
    });
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
function getBaseJuvenil(param) {

    $('#id_base').val("-1");
    $('#divSelectBase').attr('disabled', true);
    var cod = param.value;
    var url = $('#url_b').val();
    $.ajax({
        dataType: 'json',
        url: url + 'jovenes/joven/getBases',
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

function getTemaDependiente(param) {

    var cod = param.value;
    var url = $('#url_b').val();
    $.ajax({
        dataType: 'json',
        url: url + 'matrimonio/matrimonio/getTemasMatrimonios',
        data: {cod: cod},
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        success: function (data, textStatus, jqXHR) {

            $('#divTemaNro').empty();
            $('#divTemaNro').append(data);
        }

    });
}
function getTemaDependienteJovenes(param) {

    var cod = param.value;
    var url = $('#url_b').val();
    $.ajax({
        dataType: 'json',
        url: url + 'grupo_jovenes/grupo/getTemasJovenes',
        data: {cod: cod},
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        success: function (data, textStatus, jqXHR) {

            $('#divTemaNro').empty();
            $('#divTemaNro').append(data);
        }

    });
}

function getGrupoJuvenil(param) {

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

function viewReporteS09Busca() {

    $.ajax({
        url: $('#url_b').val() + 'reporte/Reporte_control/viewReporteS09Busca',
        //data: {iddiocesis: iddiocesis, idbase: idbase, idgrupo: idgrupo, fechaDesde: fechaDesde, fechaHasta: fechaHasta},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $("#contenedor_central").empty();
            $("#contenedor_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');

        },
        success: function (data) {

            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            _reiniciarTablero('tablero_reporteS09');
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

            $("#fec_desdeCV").datepicker({
                dateFormat: 'mm',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: "-3M",
                maxDate: "2M"
            });

            $("#fec_hastaCV").datepicker({
                dateFormat: 'mm',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: "-3M",
                maxDate: "2M"
            });

        }
    });
}
function viewReporteSJ09Busca() {

    $.ajax({
        url: $('#url_b').val() + 'reporte/Reporte_control/viewReporteSJ09Busca',
        //data: {iddiocesis: iddiocesis, idbase: idbase, idgrupo: idgrupo, fechaDesde: fechaDesde, fechaHasta: fechaHasta},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $("#contenedor_central").empty();
            $("#contenedor_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');

        },
        success: function (data) {

            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            _reiniciarTablero('tablero_reporteSJ09');
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

            $("#fec_desdeCV").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: "-3M",
                maxDate: 0
            });

            $("#fec_hastaCV").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: "-3M",
                maxDate: 0
            });

        }
    });
}
function viewReporteCuadranteBusca() {

    $.ajax({
        url: $('#url_b').val() + 'reporte/Reporte_control/viewReporteCuadranteBusca',
        //data: {iddiocesis: iddiocesis, idbase: idbase, idgrupo: idgrupo, fechaDesde: fechaDesde, fechaHasta: fechaHasta},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $("#contenedor_central").empty();
            $("#contenedor_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');

        },
        success: function (data) {

            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            _reiniciarTablero('tablero_reporteCuadrante');
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

            $("#fec_desdeCV").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: "-3M",
                maxDate: 0
            });

            $("#fec_hastaCV").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: "-3M",
                maxDate: 0
            });
        }
    });
}
function viewReporteCuadranteMiembrosBusca() {

    $.ajax({
        url: $('#url_b').val() + 'reporte/Reporte_control/viewReporteCuadranteMiembrosBusca',
        //data: {iddiocesis: iddiocesis, idbase: idbase, idgrupo: idgrupo, fechaDesde: fechaDesde, fechaHasta: fechaHasta},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $("#contenedor_central").empty();
            $("#contenedor_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');

        },
        success: function (data) {

            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            _reiniciarTablero('tablero_reporteCuadranteMiembros');
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

            $("#fec_desdeCV").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: "-3M",
                maxDate: 0
            });

            $("#fec_hastaCV").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: "-3M",
                maxDate: 0
            });
        }
    });
}
function viewReporteCuadranteJuvenilBusca() {

    $.ajax({
        url: $('#url_b').val() + 'reporte/Reporte_control/viewReporteCuadranteJuvenilBusca',
        //data: {iddiocesis: iddiocesis, idbase: idbase, idgrupo: idgrupo, fechaDesde: fechaDesde, fechaHasta: fechaHasta},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $("#contenedor_central").empty();
            $("#contenedor_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');

        },
        success: function (data) {

            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            _reiniciarTablero('tablero_reporteCuadranteJuvenil');

        }
    });
}


function guardaMiembro() {
    $.ajax({
        url: $('#url_b').val() + 'grupo/grupo/guardaMiembro',
        // data: $("#formMatrimonio").serialize(),
        data: {accion: $('#accion').val(),
            estado: $("#estado").val(),
            id_diocesis: $("#id_diocesis").val(),
            id_grupo: $("#id_grupo").val(),
            idmatrimonio: $("#idmatrimonio").val()

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
        beforeSend: function () {
            $("#contenedor_central").attr("hidden", true)
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $("#contenedor_central").attr("hidden", false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#cargando_central").attr("hidden", true);
            $("#cargando_central").empty();
            //$("#contenedor_central").html(data.vista);
            if (data.message !== "") {
                notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
            }
            listaMiembros(data.idgrupo);
        }
    });
    _reiniciarTablero("tablero_miembro");
}
function guardaMiembroJoven() {
    $.ajax({
        url: $('#url_b').val() + 'grupo_jovenes/grupo/guardaMiembro',
        // data: $("#formMatrimonio").serialize(),
        data: {accion: $('#accion').val(),
            estado: $("#estado").val(),
            id_diocesis: $("#id_diocesis").val(),
            id_grupo: $("#id_grupo").val(),
            idjoven: $("#idjoven").val()

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
        beforeSend: function () {
            $("#contenedor_central").attr("hidden", true)
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $("#contenedor_central").attr("hidden", false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#cargando_central").attr("hidden", true);
            $("#cargando_central").empty();
            //$("#contenedor_central").html(data.vista);
            if (data.message !== "") {
                notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
            }
            listaMiembrosJoven(data.idgrupo);
            _reiniciarTablero("tablero_miembroJoven");
        }
    });

}
function guardaGrupo() {
    $.ajax({
        url: $('#url_b').val() + 'grupo/grupo/guardaGrupo',
        // data: $("#formMatrimonio").serialize(),
        data: {accion: $('#accion').val(),
            estado: $("#estado").val(),
            id_diocesis: $("#id_diocesis").val(),
            id_base: $("#id_base").val(),
            id_grupo: $("#id_grupo").val(),
            enlace: $("#idmatrimonio").val(),
            nombre: $("#grupo").val(),
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
            $("#cargando_central").attr("hidden", true);
            $("#contenedor_central").attr("hidden", false);
            notificacionGlobal('Mensaje', "No se pudo Guardar. Verifique por favor", 'error', 5000);
        },
        beforeSend: function () {
            $("#contenedor_central").attr("hidden", true);
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $("#contenedor_central").attr("hidden", false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#cargando_central").attr("hidden", true);
            $("#cargando_central").empty();
            $("#contenedor_central").html(data.vista);
            if (data.message !== "") {
                notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
            }
            _reiniciarTablero("tablero_grupo");
        }
    });

}
function guardaBase() {
    $.ajax({
        url: $('#url_b').val() + 'base/base/guardaBase',
        // data: $("#formMatrimonio").serialize(),
        data: {accion: $('#accion').val(),
            estado: $("#estado").val(),
            id_diocesis: $("#id_diocesis").val(),
            id_base: $("#id_base").val(),
            coordinador: $("#idmatrimonio").val(),
            nombre: $("#base").val(),
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
            $("#cargando_central").attr("hidden", true);
            $("#contenedor_central").attr("hidden", false);
            notificacionGlobal('Mensaje', "No se pudo Guardar. Verifique por favor", 'error', 5000);
        },
        beforeSend: function () {
            $("#contenedor_central").attr("hidden", true);
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $("#contenedor_central").attr("hidden", false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#cargando_central").attr("hidden", true);
            $("#cargando_central").empty();
            $("#contenedor_central").html(data.vista);
            if (data.message !== "") {
                notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
            }
            _reiniciarTablero("tablero_base");
        }
    });

}

function guardaGrupoJoven() {
    $.ajax({
        url: $('#url_b').val() + 'grupo_jovenes/grupo/guardaGrupo',
        // data: $("#formMatrimonio").serialize(),
        data: {accion: $('#accion').val(),
            estado: $("#estado").val(),
            id_diocesis: $("#id_diocesis").val(),
            id_base: $("#id_base").val(),
            id_grupo: $("#id_grupo").val(),
            idjoven: $("#idjoven").val(),
            nombre: $("#grupo").val(),
            idmatrimonio: $("#idmatrimonio").val(),
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
            $("#cargando_central").attr("hidden", true);
            $("#contenedor_central").attr("hidden", false);
            notificacionGlobal('Mensaje', "No se pudo Guardar. Verifique por favor", 'error', 5000);
        },
        beforeSend: function () {
            $("#contenedor_central").attr("hidden", true);
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $("#contenedor_central").attr("hidden", false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#cargando_central").attr("hidden", true);
            $("#cargando_central").empty();
            $("#contenedor_central").html(data.vista);
            if (data.message !== "") {
                notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
            }
            _reiniciarTablero("tablero_grupoJoven");
        }
    });

}
function guardaS05() {
    if ($("#id_diocesis").val() === "-1") {
        $("#id_diocesis").focus();
        notificacionGlobal('Mensaje', "Diocesis es obligatorio", 'error', 5000);
        return false;
    }
    if ($("#id_base").val() === "-1") {
        $("#id_base").focus();
        notificacionGlobal('Mensaje', "Base es obligatorio", 'error', 5000);
        return false;
    }
    if ($("#id_grupo").val() === "-1") {
        $("#id_grupo").focus();
        notificacionGlobal('Mensaje', "Grupo es obligatorio", 'error', 5000);
        return false;
    }
    if ($("#tema_nro").val() === "-1") {
        $("#tema_nro").focus();
        notificacionGlobal('Mensaje', "Tema es obligatorio", 'error', 5000);
        return false;
    }
    if ($("#fechaReunion").val() === "") {
        $("#fechaReunion").focus();
        notificacionGlobal('Mensaje', "Fecha de Reunión es obligatorio", 'error', 5000);
        return false;
    }

    var datos = $("#formS05").serializeArray();
    var datosJson = JSON.stringify(datos);
    $.ajax({
        url: $('#url_b').val() + 'grupo/grupo/guardaS05',
        data: {accion: $('#accion').val(),
            datosJson: datosJson,
            iddiocesis: $("#id_diocesis").val(),
            idgrupo: $("#id_grupo").val(),
            idbase: $("#id_base").val()

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
        beforeSend: function () {
            $("#contenedor_central").attr("hidden", true)
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#cargando_central").attr("hidden", true);
            $("#contenedor_central").attr("hidden", true);
            $("#contenedor_central").empty();
            if (data.message !== "") {
                notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
            }
            $("#contenedor_inferior").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_inferior").html(data.vista);
            $("#idEvaluacion").val(data.idevaluacion);
            $("#idgrupo").val(data.idgrupo);
            $("#iddiocesis").val(data.idDiocesis);
            $("#idbase").val(data.idBase);

        }
    });
}
function guardaS05Joven() {
    if ($("#id_diocesis").val() === "-1") {
        $("#id_diocesis").focus();
        notificacionGlobal('Mensaje', "Diocesis es obligatorio", 'error', 5000);
        return false;
    }
    if ($("#id_base").val() === "-1") {
        $("#id_base").focus();
        notificacionGlobal('Mensaje', "Base es obligatorio", 'error', 5000);
        return false;
    }
    if ($("#id_grupo").val() === "-1") {
        $("#id_grupo").focus();
        notificacionGlobal('Mensaje', "Grupo es obligatorio", 'error', 5000);
        return false;
    }
    var datos = $("#formS05Joven").serializeArray();
    var datosJson = JSON.stringify(datos);
    $.ajax({
        url: $('#url_b').val() + 'grupo_jovenes/grupo/guardaS05',
        data: {accion: $('#accion').val(),
            datosJson: datosJson,
            iddiocesis: $("#id_diocesis").val(),
            idgrupo: $("#id_grupo").val(),
            idbase: $("#id_base").val()

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
        beforeSend: function () {
            $("#contenedor_central").attr("hidden", true)
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#cargando_central").attr("hidden", true);
            $("#contenedor_central").attr("hidden", true);
            $("#contenedor_central").empty();
            if (data.message !== "") {
                notificacionGlobal('Mensaje', data.message, data.tipoMessage, 5000);
            }
            $("#contenedor_inferior").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_inferior").html(data.vista);
            $("#idEvaluacion").val(data.idevaluacion);
            $("#idgrupo").val(data.idgrupo);
            $("#iddiocesis").val(data.idDiocesis);
            $("#idbase").val(data.idBase);

        }
    });
}
function agregaCurso(idMatrimonio) {

    $.ajax({
        url: $('#url_b').val() + 'matrimonio/matrimonio/abreFormCurso',
        data: {
            idmatrimonio: idMatrimonio
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
        beforeSend: function () {
            //$("#contenedor_central").attr("hidden", true)
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#cargando_central").attr("hidden", true);
            //$("#contenedor_central").attr("hidden", true);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            $("#fecha").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
        }
    });
}
function agregaAporte(idMatrimonio) {

    $.ajax({
        url: $('#url_b').val() + 'matrimonio/matrimonio/abreFormAporte',
        data: {
            idmatrimonio: idMatrimonio
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
        beforeSend: function () {
            //$("#contenedor_central").attr("hidden", true)
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#cargando_central").attr("hidden", true);
            //$("#contenedor_central").attr("hidden", true);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            $("#fecha_pago").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#ano").datepicker({
                dateFormat: 'yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
        }
    });
}
function agregaAporteJovenes(idjoven) {

    $.ajax({
        url: $('#url_b').val() + 'jovenes/joven/abreFormAporte',
        data: {
            idjoven: idjoven
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
        beforeSend: function () {
            //$("#contenedor_central").attr("hidden", true)
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#cargando_central").attr("hidden", true);
            //$("#contenedor_central").attr("hidden", true);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            $("#fecha_pago").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#ano").datepicker({
                dateFormat: 'yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
        }
    });
}

function agregaCursoJovenes(idJoven) {

    $.ajax({
        url: $('#url_b').val() + 'jovenes/joven/abreFormCurso',
        data: {
            idjoven: idJoven
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
        beforeSend: function () {
            //$("#contenedor_central").attr("hidden", true)
            $("#cargando_central").attr("hidden", false);
            $("#cargando_central").html('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#cargando_central").attr("hidden", true);
            //$("#contenedor_central").attr("hidden", true);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").html(data.vista);
            $("#fecha").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
        }
    });
}

function cambiaPassword(idusuario) {

    var urlFunction = $('#url_b').val() + "usuario/usuario/muestraFormCambia";
    $.ajax({
        url: urlFunction,
        data: {idusuario: idusuario},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
            $("#contenedor_central").append(data.vista);
        }
    });
}

function nuevoUsuario(accion, idUsuario) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "usuario/usuario/getUsuarioById/" + idUsuario;

    $.ajax({
        url: urlFunction,
        //data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");

            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idUsuario === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }

        }
    });
}
function nuevoGrupo(accion, idGrupo) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "grupo/grupo/getGrupoById/" + idGrupo;

    $.ajax({
        url: urlFunction,
        //data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");

            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idGrupo === "-1") {
                $("#id_base").attr("disabled", true).trigger("liszt: updated");
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }

        }
    });
}
function nuevaBase(accion, idBase) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "base/base/getBaseById/" + idBase;

    $.ajax({
        url: urlFunction,
        //data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");

            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idBase === "-1") {
                $("#id_base").attr("disabled", true).trigger("liszt: updated");
                $("#id_base").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_base").attr("disabled", false);
                $("#accion").val("1");
            }

        }
    });
}

function nuevoGrupoJoven(accion, idGrupo) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/getGrupoById/" + idGrupo;

    $.ajax({
        url: urlFunction,
        //data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");

            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idGrupo === "-1") {
                $("#id_base").attr("disabled", true).trigger("liszt: updated");
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }

        }
    });
}
function nuevoMiembro(accion, idGrupo) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "grupo/grupo/getMiembroById/" + idGrupo;

    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idGrupo === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }

        }
    });
}
function bajaJoven(idJoven) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "jovenes/joven/bajaJoven/" + idJoven;

    $.ajax({
        url: urlFunction,
        data: {idJoven: idJoven},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            _reiniciarTablero("tablero_joven");
        }
    });
}
function bajaMatrimonio(idMatrimonio) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/bajaMatrimonio/" + idMatrimonio;

    $.ajax({
        url: urlFunction,
        data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            _reiniciarTablero("tablero_s07");
        }
    });
}
function reactivarMatrimonio(idMatrimonio) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/reactivarMatrimonio/" + idMatrimonio;

    $.ajax({
        url: urlFunction,
        data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            listaS07();
            //$("#contenedor_central").html(data.vista);
            //_reiniciarTablero("tablero_s07");
        }
    });
}
function s02(idMatrimonio) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/getMatrimonioCursoById/" + idMatrimonio;

    $.ajax({
        url: urlFunction,
        data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //_reiniciarTablero("tablero_cursos");
        }
    });
}
function s06(idMatrimonio) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/getMatrimonioAporteById/" + idMatrimonio;

    $.ajax({
        url: urlFunction,
        data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //_reiniciarTablero("tablero_cursos");
        }
    });
}
function sj06(idJoven) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "jovenes/joven/getJovenAporteById/" + idJoven;

    $.ajax({
        url: urlFunction,
        data: {idJoven: idJoven},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //_reiniciarTablero("tablero_cursos");
        }
    });
}
function sj02(idJoven) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "jovenes/joven/getJovenCursoById/" + idJoven;

    $.ajax({
        url: urlFunction,
        data: {idJoven: idJoven},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //_reiniciarTablero("tablero_cursos");
        }
    });
}
function nuevoMiembroJoven(accion, idGrupo) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/getMiembroById/" + idGrupo;

    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idGrupo === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }

        }
    });
}
function nuevoS05(accion, idGrupo, idEvaluacion, nivelEvaluacion) {


    var urlFunction = $('#url_b').val() + "grupo/grupo/getGrupoS05";

    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo, idEvaluacion: idEvaluacion, nivelEvaluacion: nivelEvaluacion},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idGrupo === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }
            $("#fechaReunion").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#proximaFechaReunion").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
        }
    });
}
function nuevoS05Joven(accion, idGrupo, idEvaluacion, nivelEvaluacion) {


    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/getGrupoS05";

    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo, idEvaluacion: idEvaluacion, nivelEvaluacion: nivelEvaluacion},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idGrupo === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }
            $("#fechaReunion").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#proximaFechaReunion").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
        }
    });
}
function nuevaEvaluacion(accion, idEvaluacion, nivelEvaluacion) {

    var idEvaluacion = (idEvaluacion === "") ? $("#idEvaluacion").val() : idEvaluacion;
    var accion = (accion === "") ? $("#accion").val() : accion;
    var urlFunction = $('#url_b').val() + "grupo/grupo/guardaEvaluacion";
    var idGrupo = $("#idgrupo").val();
    $.ajax({
        url: urlFunction,
        data: {accion: accion, idEvaluacion: idEvaluacion,
            idgrupo: $("#idgrupo").val(),
            iddiocesis: $("#iddiocesis").val(),
            idbase: $("#idbase").val(),
            idmatrimonio: $("#idmatrimonio").val(),
            puntualidad_el: $("#puntualidad_el").val(),
            puntualidad_ella: $("#puntualidad_ella").val(),
            estudio_el: $("#estudio_el").val(),
            estudio_ella: $("#estudio_ella").val(),
            participacion_el: $("#participacion_el").val(),
            participacion_ella: $("#participacion_ella").val(),
            cumple_accion_sugerida_el: $("#cumple_accion_sugerida_el").val(),
            cumple_accion_sugerida_ella: $("#cumple_accion_sugerida_ella").val(),
            suma_total: $("#suma_total").val(),
            promedio: $("#promedio").val(),
            nivelEvaluacion: nivelEvaluacion
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {


            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $('#contenedor_central').attr('hidden', false);
            $("#contenedor_central").empty();

            $("#contenedor_inferior").empty();
            //$("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            if (accion === "0" && idGrupo === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }
            //listaMatrimoniosS05(idEvaluacion,idGrupo);
            nuevoS05('1', data.idgrupo, data.idevaluacion, data.nivelEvaluacion);
        }
    });
}
function nuevoCurso() {
    validarFormulario("formCurso");
    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/guardaCurso";
    $.ajax({
        url: urlFunction,
        data: {
            idmatrimonio: $("#idmatrimonio").val(),
            idcurso: $("#idcurso").val(),
            fecha: $("#fecha").val(),
            lugar: $("#lugar").val(),
            disertante: $("#disertante").val()
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $('#contenedor_central').attr('hidden', false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            s02(data.idmatrimonio);
            _reiniciarTablero("tablero_cursos");
        }
    });
}
function nuevoAporte() {
    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/guardaAporte";
    $.ajax({
        url: urlFunction,
        data: {
            idmatrimonio: $("#idmatrimonio").val(),
            idconcepto_aporte: $("#idconcepto_aporte").val(),
            monto: $("#monto").val(),
            ano: $("#ano").val(),
            fecha_pago: $("#fecha_pago").val(),
            nro_recibo: $("#nro_recibo").val()
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $('#contenedor_central').attr('hidden', false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            s06(data.idmatrimonio);
            _reiniciarTablero("tablero_aportes");
        }
    });
}
function nuevoAporteJovenes() {
    var urlFunction = $('#url_b').val() + "jovenes/joven/guardaAporte";
    $.ajax({
        url: urlFunction,
        data: {
            idjoven: $("#idjoven").val(),
            idconcepto_aporte: $("#idconcepto_aporte").val(),
            monto: $("#monto").val(),
            ano: $("#ano").val(),
            fecha_pago: $("#fecha_pago").val(),
            nro_recibo: $("#nro_recibo").val()
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $('#contenedor_central').attr('hidden', false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            sj06(data.idjoven);
            _reiniciarTablero("tablero_aportes");
        }
    });
}
function nuevCursoJoven() {
    var urlFunction = $('#url_b').val() + "jovenes/joven/guardaCurso";
    $.ajax({
        url: urlFunction,
        data: {
            idjoven: $("#idjoven").val(),
            idcurso: $("#idcurso").val(),
            fecha: $("#fecha").val(),
            lugar: $("#lugar").val(),
            disertante: $("#disertante").val()
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $('#contenedor_central').attr('hidden', false);
            $("#contenedor_central").empty();
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            sj02(data.idjoven);
            _reiniciarTablero("tablero_cursosJovenes");
        }
    });
}
function nuevaEvaluacionJoven(accion, idEvaluacion) {

    var idEvaluacion = (idEvaluacion === "") ? $("#idEvaluacion").val() : idEvaluacion;
    var accion = (accion === "") ? $("#accion").val() : accion;
    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/guardaEvaluacion";
    var idGrupo = $("#idgrupo").val();
    $.ajax({
        url: urlFunction,
        data: {accion: accion, idEvaluacion: idEvaluacion,
            idgrupo: $("#idgrupo").val(),
            iddiocesis: $("#iddiocesis").val(),
            idbase: $("#idbase").val(),
            idjoven: $("#idjoven").val(),
            puntualidad: $("#puntualidad").val(),
            estudio: $("#estudio").val(),
            participacion: $("#participacion").val(),
            cumple_accion_sugerida: $("#cumple_accion_sugerida").val(),
            suma_total: $("#suma_total").val(),
            promedio: $("#promedio").val()
        },
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {


            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $('#contenedor_central').attr('hidden', false);
            $("#contenedor_central").empty();

            $("#contenedor_inferior").empty();
            //$("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            if (accion === "0" && idGrupo === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }
            //listaMatrimoniosS05(idEvaluacion,idGrupo);
            nuevoS05Joven('1', data.idgrupo, data.idevaluacion, data.nivelEvaluacion);
        }
    });
}

function eliminaMiembro(idGrupo, idMatrimonio) {

    var urlFunction = $('#url_b').val() + "grupo/grupo/eliminaMiembroById";

    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo, idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            listaMiembros(data.idgrupo);

        }
    });
}
function eliminaCurso(idMatrimonio, idCurso) {

    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/eliminaCurso";

    $.ajax({
        url: urlFunction,
        data: {idCurso: idCurso, idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            s02(data.idmatrimonio);
            _reiniciarTablero("tablero_cursos");

        }
    });
}
function eliminaAporte(idMatrimonio, idAporte) {

    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/eliminaAporte";

    $.ajax({
        url: urlFunction,
        data: {idAporte: idAporte, idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            s06(data.idmatrimonio);
            _reiniciarTablero("tablero_aportes");

        }
    });
}
function eliminaAporteJovenes(idJoven, idAporte) {

    var urlFunction = $('#url_b').val() + "jovenes/joven/eliminaAporte";

    $.ajax({
        url: urlFunction,
        data: {idAporte: idAporte, idJoven: idJoven},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            sj06(data.idjoven);
            _reiniciarTablero("tablero_aportes");

        }
    });
}
function eliminaCursoJovenes(idJoven, idCurso) {

    var urlFunction = $('#url_b').val() + "jovenes/joven/eliminaCurso";

    $.ajax({
        url: urlFunction,
        data: {idCurso: idCurso, idJoven: idJoven},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");
            sj02(data.idjoven);
            _reiniciarTablero("tablero_cursosJovenes");

        }
    });
}

function eliminaMiembroJoven(idGrupo, idJoven) {

    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/eliminaMiembroById";

    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo, idJoven: idJoven},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            listaMiembrosJoven(data.idgrupo);

        }
    });
}
function eliminaEvaluacion(idGrupo, idEvaluacion, idEvaMatrimonio, nivelEvaluacion) {

    var urlFunction = $('#url_b').val() + "grupo/grupo/eliminaEvaluacionById";

    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo, idEvaluacion: idEvaluacion, idEvaMatrimonio: idEvaMatrimonio, nivelEvaluacion: nivelEvaluacion},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            nuevoS05('1', data.idgrupo, data.idevaluacion, data.nivelEvaluacion);

        }
    });
}
function eliminaEvaluacionJoven(idGrupo, idEvaluacion, idEvaJoven, nivelEvaluacion) {

    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/eliminaEvaluacionById";

    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo, idEvaluacion: idEvaluacion, idEvaJoven: idEvaJoven, nivelEvaluacion: nivelEvaluacion},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            nuevoS05Joven('1', data.idgrupo, data.idevaluacion, data.nivelEvaluacion);

        }
    });
}

function nuevoMatrimonio(accion, idMatrimonio) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/getMatrimonioById/" + idMatrimonio;

    $.ajax({
        url: urlFunction,
        //data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idMatrimonio === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }

            $("#fecha_ingreso").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#fecha_membresia").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#fecha_encuentro").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#fecha_nac_el").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#fecha_nac_ella").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#aniversario").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
        }
    });
}
function nuevoJoven(accion, idJoven) {

    //$('#matrimonio_modal').modal('show');
    var urlFunction = $('#url_b').val() + "jovenes/joven/getJovenById/" + idJoven;

    $.ajax({
        url: urlFunction,
        //data: {idMatrimonio: idMatrimonio},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%; margin-left:10%;margin-right:10%");


            $("#contenedor_central").html(data.vista);
            //cuando la accion es 0 es nuevo si es diferente es edicion
            if (accion === "0" && idJoven === "-1") {
                $("#id_base").attr("disabled", true);
                $("#id_grupo").attr("disabled", true);
                $("#accion").val("0");
            } else if (accion === "1") {
                $("#id_base").attr("disabled", false);
                $("#id_grupo").attr("disabled", false);
                $("#accion").val("1");
            }

            $("#fecha_ingreso").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#fecha_membresia").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#fecha_encuentro").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
            $("#fecha_nac").datepicker({
                dateFormat: 'dd/mm/yy',
                autoclose: true,
                regional: 'es',
                orientation: 'bottom auto',
                todayBtn: 'linked',
                todayHighlight: true,
                //minDate: 0,
                maxDate: 0,
                changeMonth: true,
                changeYear: true
            });
        }
    });
    _reiniciarTablero("tablero_grupoJoven");
}
function listaMatrimonios() {
    var urlFunction = $('#url_b').val() + "matrimonio/matrimonio/viewCabeceraMatrimonios";
    $.ajax({
        url: urlFunction,
        //data: {params: params},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_matrimonio");
        }
    });
}
function listaS07() {
    var urlFunction = $('#url_b').val() + "s07/matrimonio/viewCabeceraMatrimonios";
    $.ajax({
        url: urlFunction,
        //data: {params: params},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_s07");
        }
    });
}

function listaJovenes() {
    var urlFunction = $('#url_b').val() + "jovenes/joven/lista_joven";
    $.ajax({
        url: urlFunction,
        //data: {params: params},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_joven");
        }
    });
}

function listaUsuarios() {
    var urlFunction = $('#url_b').val() + "usuario/usuario/listaUsuario";
    $.ajax({
        url: urlFunction,
        //data: {params: params},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_usuario");
        }
    });
}
function listaGrupos() {
    var urlFunction = $('#url_b').val() + "grupo/grupo/viewCabeceraEquipos";
    $.ajax({
        url: urlFunction,
        //data: {params: params},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_grupo");
        }
    });
}
//function listaGrupos() {
//    var urlFunction = $('#url_b').val() + "grupo/grupo/listaGrupos";
//    $.ajax({
//        url: urlFunction,
//        //data: {params: params},
//        type: 'POST',
//        dataType: 'json',
//        error: function (jqXHR, textStatus, errorThrown) {
//            $('#contenedor_central').empty();
//            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
//            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
//            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
//            registrar_log(registro);
//        },
//        beforeSend: function () {
//            $('#contenedor_central').empty();
//            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
//        },
//        success: function (data) {
//
//            $("#contenedor_central").empty();
//
//            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
//
//
//            $("#contenedor_central").append(data.vista);
//            _reiniciarTablero("tablero_grupo");
//        }
//    });
//}
function listaBases() {
    var urlFunction = $('#url_b').val() + "base/base/viewCabeceraBases";
    $.ajax({
        url: urlFunction,
        //data: {params: params},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");

            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_base");
        }
    });
}

function descargaFormulario(id) {
    var urlFunction = $('#url_b').val() + "descarga/descarga/download/" + id;
    $.ajax({
        url: urlFunction,
        data: {id: id},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            // using the iframe method
            $("#contenedor_central").empty();

            // using the [removed].href method
            window.open(data.DownloadPath, data.DownloadPath);
            $('#contenedor_central').html(data.vista);
            //window.location = data.DownloadPath;
//            $("#contenedor_central").empty();
//
//            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");
//
//
//            $("#contenedor_central").append(data.vista);
//            _reiniciarTablero("tablero_grupoJoven");
        }
    });
}
function listaGruposJoven() {
    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/listaGrupos";
    $.ajax({
        url: urlFunction,
        //data: {params: params},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_grupoJoven");
        }
    });
}
function listaMiembros(idGrupo) {
    var urlFunction = $('#url_b').val() + "grupo/grupo/listaMiembros";
    $.ajax({
        url: urlFunction,
        data: {idgrupo: idGrupo},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_miembro");
        }
    });
}
function listaMiembrosJoven(idGrupo) {
    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/listaMiembros";
    $.ajax({
        url: urlFunction,
        data: {idgrupo: idGrupo},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            $("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_miembroJoven");
        }
    });
}
function listaMatrimoniosS05(idevaluacion, idgrupo) {
    var urlFunction = $('#url_b').val() + "grupo/grupo/listaEvaluaciones/0";
    $.ajax({
        url: urlFunction,
        data: {idevaluacion: idevaluacion, idgrupo: idgrupo},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            //$('#contenedor_central').empty();
            //$('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            //$('#contenedor_central').empty();
            //$('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            //$("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#tablaEvaluaciones").append(data.vista);
            _reiniciarTablero("tablero_evaluaciones");
        }
    });
}
function listaJovenesS05(idevaluacion, idgrupo) {
    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/listaEvaluaciones/0";
    $.ajax({
        url: urlFunction,
        data: {idevaluacion: idevaluacion, idgrupo: idgrupo},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            //$('#contenedor_central').empty();
            //$('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            //$('#contenedor_central').empty();
            //$('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            //$("#contenedor_central").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#tablaEvaluacionesJoven").append(data.vista);
            _reiniciarTablero("tablero_evaluaciones");
        }
    });
}
function listaS05(idGrupo) {
    var idGrupo = (idGrupo == "") ? $("#idGrupoS05").val() : idGrupo;
    var urlFunction = $('#url_b').val() + "grupo/grupo/ListaGrupoS05";
    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $('#contenedor_central').attr('hidden', false);
            $("#contenedor_central").empty();
            $("#contenedor_inferior").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_listaS05");
        }
    });
}
function listaS05Joven(idGrupo) {
    var idGrupo = (idGrupo == "") ? $("#idGrupoS05").val() : idGrupo;
    var urlFunction = $('#url_b').val() + "grupo_jovenes/grupo/ListaGrupoS05";
    $.ajax({
        url: urlFunction,
        data: {idGrupo: idGrupo},
        type: 'POST',
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
            notificacionGlobal('Alerta', 'Ocurrio un error al generar la vista, consulte con el Administrador', 'error', 3500);
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            $('#contenedor_central').empty();
            $('#contenedor_central').append('<div align="center"><img src="' + $('#url_b').val() + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {
            $('#contenedor_central').attr('hidden', false);
            $("#contenedor_central").empty();
            $("#contenedor_inferior").empty();

            $("#contenedor_central").attr("style", "margin-bottom: 10%; margin-top: 5%");


            $("#contenedor_central").append(data.vista);
            _reiniciarTablero("tablero_listaS05Joven");
        }
    });
}

function number_format(number, decimals, dec_point, thousands_sep) {
    number = number * 1;//makes sure `number` is numeric value
    var str = number.toFixed(decimals ? decimals : 0).toString().split('.');
    var parts = [];
    for (var i = str[0].length; i > 0; i -= 3) {
        parts.unshift(str[0].substring(Math.max(0, i - 3), i));
    }
    str[0] = parts.join(thousands_sep ? thousands_sep : ',');
    return str.join(dec_point ? dec_point : '.');
}



function sumarDias(fecha, dias) {
    fecha.setDate(fecha.getDate() + dias);
    return fecha;
}


function registrar_log(info) {
    var url = $('#url_b').val();
    var xhr = info[1];
    var mensaje = 'Su sesión ha expirado, Debe ingresar de vuelta al sistema.';
    if ($.trim(xhr.responseText) == "logout") {
        notificacionGlobal('Alerta', mensaje, 'error', 3500);
        window.location.href = url + 'inicio?logout=true';
    }

    $.ajax({
        url: $('#url_b').val() + "acceso/Perform_acceso/registrar_log",
        data: {info: JSON.stringify(info)},
        type: 'POST',
        dataType: 'JSON'
    });

}



function limpiaForm(miForm) {
    // recorremos todos los campos que tiene el formulario
    $(':input', miForm).each(function () {
        var type = this.type;
        var tag = this.tagName.toLowerCase();
        //limpiamos los valores de los campos
        if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'email' || type == 'number' || type == 'hidden')
            this.value = "";
        // excepto de los checkboxes y radios, le quitamos el checked
        // pero su valor no debe ser cambiado
        else if (type == 'checkbox' || type == 'radio')
            this.checked = false;
        // los selects le ponesmos el indice a -
        else if (tag == 'select')
            this.selectedIndex = -1;
    });
}


function logout() {

    var url = $('#url_b').val();

    $.ajax({
        url: url + 'acceso/perform_acceso/logout',
        //data: {cod: "ok", token: localStorage.token, idUsuario: idUsuario},
        type: 'POST',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function (xhr) {
            $('#tab_direccion').empty();
            $('#tab_direccion').append('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data, textStatus, jqXHR) {

            window.location.href = url + 'inicio';
        }

    });
}


function _reiniciarTablero(objeto_tabla, orden, guardar_estado, ascDesc) {

    (path_tablero == undefined) ? '' : localStorage.removeItem(path_tablero);
    path_tablero = "DataTables_" + objeto_tabla + "_" + window.location.pathname;

    var nro = (typeof orden == 'undefined') ? 0 : parseInt(orden);
    var guardar_est = (typeof guardar_estado == 'undefined') ? true : (guardar_estado == 'true');
    var tipoOrden = (typeof ascDesc == 'undefined') ? 'desc' : ascDesc;

    tablero = $('#' + objeto_tabla).DataTable({
        "order": [[nro, tipoOrden]],
        stateSave: guardar_est, //Permite que al recargar la vista se posicione en la pagina que estaba la tabla.
        responsive: true, //Adaptable segun tamaño de la pantalla del dispositivo
        "lengthMenu": [[5, 15, 25, 50, -1], [5, 15, 25, 50, "Todo"]],
        language: {
            processing: "Cargando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ elementos por página",
            info: "Mostrando _START_ - _END_ de _TOTAL_",
            infoEmpty: "No existen elementos para mostrar",
            infoFiltered: "(Filtrado de _MAX_ en total)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No existen elementos para mostrar",
            emptyTable: "Sin datos para mostrar",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "último"
            },
            aria: {
                sortAscending: ": Activar párrafo Ordenar la columna de Manera ascendente",
                sortDescending: ": Activar párrafo Ordenar la columna de Manera descendente"
            }
        }
    });
}

function getDevice() {
    var url = $('#url_b').val();

    $.ajax({
        url: url + 'matrimonio/matrimonio/getDevice',
        type: 'POST',
        dataType: 'JSON',
        error: function (jqXHR, textStatus, errorThrown) {
            var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
            registrar_log(registro);
        },
        beforeSend: function () {
            //    $('#tab_direccion').empty();
            //    $('#tab_direccion').append('<div align="center"><img src="' + url + 'assets/img/cargando.gif"></div>');
        },
        success: function (data) {

            return data.mobile;
        }

    });
}

function notificacionGlobal(titulo, mensaje, tipo, tiempo) {

    new PNotify({
        title: titulo,
        text: mensaje,
        type: tipo,
        delay: tiempo
                //hide: false
    });

}



function SumaPromedio() {
    function sumaTotal() {
        var puntualidad_el = (isNaN(parseInt($("#puntualidad_el").val()))) ? 0 : parseInt($("#puntualidad_el").val());
        var puntualidad_ella = (isNaN(parseInt($("#puntualidad_ella").val()))) ? 0 : parseInt($("#puntualidad_ella").val());
        var estudio_el = (isNaN(parseInt($("#estudio_el").val()))) ? 0 : parseInt($("#estudio_el").val());
        var estudio_ella = (isNaN(parseInt($("#estudio_ella").val()))) ? 0 : parseInt($("#estudio_ella").val());
        var participacion_el = (isNaN(parseInt($("#participacion_ella").val()))) ? 0 : parseInt($("#participacion_ella").val());
        var participacion_ella = (isNaN(parseInt($("#participacion_ella").val()))) ? 0 : parseInt($("#participacion_ella").val());
        var cumple_accion_sugerida_el = (isNaN(parseInt($("#cumple_accion_sugerida_el").val()))) ? 0 : parseInt($("#cumple_accion_sugerida_el").val());
        var cumple_accion_sugerida_ella = (isNaN(parseInt($("#cumple_accion_sugerida_ella").val()))) ? 0 : parseInt($("#cumple_accion_sugerida_ella").val());

        var sumaTotal = puntualidad_el + puntualidad_ella + estudio_el + estudio_ella + participacion_el + participacion_ella + cumple_accion_sugerida_el + cumple_accion_sugerida_ella;
        $("#suma_total").val(sumaTotal);
        return sumaTotal;
    }
    function promedio(sumaTotal) {
        var promedio = sumaTotal / 8;
        $("#promedio").val(promedio);
    }
    var sumaTotal = sumaTotal();
    promedio(sumaTotal);
}
function SumaPromedioJoven() {
    function sumaTotal() {
        var puntualidad = (isNaN(parseInt($("#puntualidad").val()))) ? 0 : parseInt($("#puntualidad").val());

        var estudio = (isNaN(parseInt($("#estudio").val()))) ? 0 : parseInt($("#estudio").val());

        var participacion = (isNaN(parseInt($("#participacion").val()))) ? 0 : parseInt($("#participacion").val());

        var cumple_accion_sugerida = (isNaN(parseInt($("#cumple_accion_sugerida").val()))) ? 0 : parseInt($("#cumple_accion_sugerida").val());

        var sumaTotal = puntualidad + estudio + participacion + cumple_accion_sugerida;
        $("#suma_total").val(sumaTotal);
        return sumaTotal;
    }
    function promedio(sumaTotal) {
        var promedio = sumaTotal / 4;
        $("#promedio").val(promedio);
    }
    var sumaTotal = sumaTotal();
    promedio(sumaTotal);
}
function validarFormulario(idForm) {
    $("#" + idForm).validate();
}
