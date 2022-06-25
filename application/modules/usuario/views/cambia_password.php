<?php
$request = ['assets' => array(['src' => 'assets/js/usuario/usuario.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

$edit = count($usuario);
?>
<div id="contieneFormCambiaPassword"class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formCambiaPassword" name="formCambiaPassword">
        <input id="idUsuario" name="idUsuario" type="hidden" value="<?= intval($edit > 0) ? $usuario : '-1' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL USUARIO - <?= (is_object($datosUsuario)) ? strtoupper($datosUsuario->nombre) : strtoupper($datosUsuario[0]->nombreUsuario); ?> </h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Nuevo Password</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="nuevoPassword" type="password" id="nuevoPassword" value=""></div>
        </div>
        <div class="col-sm-12">
            <button id="guardarPassword" class="btn btn-primary" type="submit">Guardar Password</button>
            <button id="cancelarUsuario" class="btn btn-danger">Cancelar</button>
        </div>
    </form>

</div>