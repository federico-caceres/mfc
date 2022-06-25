<?php
$request = ['assets' => array(['src' => 'assets/js/grupo/grupo.js', 'type' => 'script'], ['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

?>
<div id="contieneFormBaja" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formBaja" name="formBaja">
        
        <input type="hidden" id="idmatrimonio" name="idmatrimonio" value="<?= (isset($idmatrimonio)) ? $idmatrimonio[0] : '' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>BAJA DE MEMBRESIA</h3></div>
        </div>

        <div class="form-group row">

            <div class="col-sm-2"><strong>Motivo de Salida</strong></div>
            <div class="col-sm-3">
                <input class="form-control" id="motivo_baja" name="motiva_baja" value="">
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
        <button id="guardarBaja" class="btn btn-primary">Guardar Baja</button>
        <button id="cancelarBaja" class="btn btn-danger">Cancelar</button>
    </div>
</div>