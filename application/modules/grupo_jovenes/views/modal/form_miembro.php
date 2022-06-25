<?php
$request = ['assets' => array(['src' => 'assets/js/grupo/grupo_joven.js', 'type' => 'script'], ['src' => 'assets/js/gestion/joven.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

$edit = count($miembro);

?>
<div id="contieneFormMiembroJoven" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formMiembroJoven" name="formMiembroJoven">
        <input type="hidden" id="accion" name="accion" value="">
        <input type="hidden" id="id_grupo" name="id_grupo" value="<?= (intval($edit) > 0 && isset($grupo[0]->idgrupo)) ? $grupo[0]->idgrupo : '' ?>">
        <input type="hidden" id="id_diocesis" name="id_diocesis" value="<?= (intval($edit) > 0 && isset($grupo[0]->iddiocesis)) ? $grupo[0]->iddiocesis : '' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>AGREGA MIEMBRO AL EQUIPO <?= (isset($grupo[0]->nombreGrupo)) ? $grupo[0]->nombreGrupo : ''; ?></h3></div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2"><strong>Estado</strong></div>
            <div class="col-sm-2">
                <?php echo Modules::run('componente/select', array('idSelect' => 'estado', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $estados, 'nameSelect' => 'estado', 'msgSelect' => 'Elije..')); //'selected' => (intval($edit) > 0 && isset($miembro[0]->estado)) ? $miembro[0]->estado : '',  ?>
            </div>
        </div>

        <div class="form-group row">

            <div class="col-sm-2"><strong>Jóven</strong></div>
            <div class="col-sm-3">
                <?php echo Modules::run('componente/select', array('idSelect' => 'idjoven', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $jovenes, 'nameSelect' => 'idjoven', 'msgSelect' => 'Elije..')); //'selected' => (intval($edit) > 0 && isset($miembro[0]->idmatrimonio)) ? $miembro[0]->idmatrimonio : '-1', ?>
            </div>
        </div>

    </form>
    <div class="col-sm-12">
        <button id="guardarMiembroJoven" class="btn btn-primary" onclick="guardaMiembroJoven();">Guardar Miembro</button>
        <button id="cancelarMiembroJoven" data-idgrupo="<?= (intval($edit) > 0 && isset($grupo[0]->idgrupo)) ? $grupo[0]->idgrupo : '' ?>" class="btn btn-danger">Cancelar</button>
    </div>
</div>