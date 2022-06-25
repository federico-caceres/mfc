
localStorage.clear();
$(document).ready(function () {


    $("#idFormLogin").submit(function (e) {
        e.preventDefault();
        var base_url = $("#base_url").val();
        $.ajax({
            url: base_url + "acceso/Perform_acceso/login",
            type: 'POST',
            data: $("#idFormLogin").serialize(),
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                notificacion('Advertencia', jqXHR.statusText, 'error', 5000);
                var registro = new Array(this.url, jqXHR, textStatus, errorThrown);
                //registrar_log(registro);
            },
            beforeSend: function (xhr) {
                $("#box-login").addClass('hidden');
                $("#loading").empty();
                $("#contenidoLogin").removeClass('wrapper-ppal');
                $("#loading").html('<div align="center"><img src="' + base_url + 'assets/img/cargando.gif"></div>');
            },
            success: function (data) {
                if (data.success === true) {

                    var accessData = jQuery.parseJSON(data.access_data);
                    localStorage.base_url = data.base_url;
                    localStorage.access_data = data.access_data;
                    $("#userData").val(data.access_data);
                    $("#loading").empty();
                    $("#idform").submit();

                } else {
                    $("#box-login").removeClass('hidden');
                    $("#loading").empty();
                    $("#contenidoLogin").addClass('wrapper-ppal');
                    notificacion('Advertencia', data.msg, 'error', 7000);
                }
            }

        });
    });

    $("#idPanelLogin").click(function () {
        $("#idmsg").attr('hidden', true);
    });

    $("#interno").change(function () {
        if (this.value != "") {
            $("#clcontrasenhaNeotel").show();
        }
    });


});

function handlefunction(data) {
    if (data.success === true) {
        localStorage.base_url = data.base_url;
        localStorage.access_data = data.access_data;
        $("#userData").val(data.access_data);
        $("#idform").submit();

    } else {
        $("#idmsg").empty();
        $("#idmsg").html(data.msg);
        $("#idmsg").attr('hidden', false);
    }
}

function checkSelectLogin(data) {
    if (data.select) {
        $(".modal-body").empty();
        $(".modal-body").html(data.select_data);
        $("#modal_service").modal('show');
    } else {
        handlefunction(data);
    }

}

function notificacion(titulo, mensaje, tipo, tiempo) {
    new PNotify({
        title: titulo,
        text: mensaje,
        type: tipo,
        delay: tiempo
                //hide: false
    });
}
