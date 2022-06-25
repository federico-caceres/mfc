<?php
$request = ['assets' => array(['src' => 'assets/js/grupo/grupo.js', 'type' => 'script'], ['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
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
                    <option value="TRASLADO">TRASLADO</option>
                </select>
            </div>
        </div>
        <div class="form-group row" id="idTraslado" style="display: none">
            <div class="col-sm-2"><strong>Diocesis</strong></div>
            <div class="col-sm-3" id="divSelectDiocesis">
                <?php // echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => '-1', 'msgSelect' => 'Elije..', 'funcion' => 'getBaseDependiente(this)')); ?>
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => '-1', 'msgSelect' => 'Elije..', 'funcion' => 'getBaseDependiente(this)')); ?>
            </div>
            <div class="col-sm-2 "><strong>Base</strong></div>
            <div class="col-sm-3" id="divSelectBase">
                <?php //echo Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'selected' => '-1', 'msgSelect' => 'Elije..', 'funcion' => 'getGrupoDependiente(this)')); ?>
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_base', 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'selected' => '-1', 'msgSelect' => 'Elije..', 'funcion' => 'getGrupoDependiente(this)')); ?>
            </div>
        </div>


    </form>
    <div class="col-sm-12">
        <button id="guardarBaja" class="btn btn-primary">Guardar Baja</button>
        <button id="cancelarBaja" class="btn btn-danger">Cancelar</button>
    </div>
</div>