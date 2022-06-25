<?php
$request = ['assets' => array(['src' => 'assets/js/grupo/grupo_joven.js', 'type' => 'script'], ['src' => 'assets/js/gestion/joven.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

?>
<div id="contieneFormBajaJoven" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formBajaJoven" name="formBajaJoven">
       
        <input type="hidden" id="idjoven" name="idjoven" value="<?= (isset($idjoven)) ? $idjoven : '' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>BAJA DE MEMBRESIA</h3></div>
        </div>

        <div class="form-group row">

            <div class="col-sm-2"><strong>Motivo de Salida</strong></div>
            <div class="col-sm-3">
                <input class="form-control" id="motivo_baja" name="motivo_baja" value="">
            </div>
            <div class="col-sm-2"><strong>Tipo de Baja</strong></div>
            <div class="col-sm-3">
                                <select class="form-control" name="tipo_baja" id="tipo_baja">
                    <option value="0">Elige..</option>
                    <option value="TEMPORAL">TEMPORAL</option>
                    <option value="DEFINITIVO">DEFINITIVO</option>
                </select>
            </div>
        </div>

    </form>
    <div class="col-sm-12">
        <button id="guardarBajaJoven" class="btn btn-primary">Guardar Baja</button>
        <button id="cancelarBajaJoven" class="btn btn-danger">Cancelar</button>
    </div>
</div>