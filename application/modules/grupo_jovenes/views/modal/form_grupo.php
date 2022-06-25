<?php
$request = ['assets' => array(['src' => 'assets/js/grupo/grupo_joven.js', 'type' => 'script'], ['src' => 'assets/js/gestion/joven.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

$edit = count($grupo);
?>
<div id="contieneFormGrupoJoven" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formGrupoJoven" name="formGrupoJoven">
        <input type="hidden" id="accion" name="accion" value="">
        <input type="hidden" id="id_grupo" name="id_grupo" value="<?= (intval($edit) > 0 && isset($grupo[0]->idgrupo)) ? $grupo[0]->idgrupo : '' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL EQUIPO <?= (isset($grupo[0]->nombreGrupo)) ? $grupo[0]->nombreGrupo : ''; ?></h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Estado</strong></div>
            <div class="col-sm-2">
                <?php echo Modules::run('componente/select', array('idSelect' => 'estado', "clase" => "chosenselect", "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $estados, 'nameSelect' => 'estado', 'selected' => (intval($edit) > 0 && isset($grupo[0]->estado)) ? $grupo[0]->estado : '', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Diocesis</strong></div>
            <div class="col-sm-3" id="divSelectDiocesis">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => (intval($edit) > 0 && isset($grupo[0]->iddiocesis)) ? $grupo[0]->iddiocesis : '', 'msgSelect' => 'Elije..', 'funcion' => 'getBaseDependiente(this)')); ?>
            </div>
            <div class="col-sm-2"><strong>Base</strong></div>
            <div class="col-sm-3" id="divSelectBase">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'selected' => (intval($edit) > 0 && isset($grupo[0]->idbase)) ? $grupo[0]->idbase : '-1', 'msgSelect' => 'Elije..', 'funcion' => 'getGrupoDependiente(this)')); ?>
            </div>
            <!--
                        <div class="col-sm-1"><strong>Grupo</strong></div>
                        <div class="col-sm-2" id="divSelectGrupo">
            <?php //echo Modules::run('componente/select', array('idSelect' => 'id_grupo', 'view_flag' => 30, 'data_select' => $grupos, 'nameSelect' => 'id_grupo', 'selected' => (intval($edit) > 0 && isset($grupo[0]->idgrupo)) ? $grupo[0]->idgrupo : '', 'msgSelect' => 'Elije..')); ?>
                        </div>-->
        </div>
        <div class="form-group row">

            <div class="col-sm-2"><strong>Nombre del Equipo</strong></div>
            <div class="col-sm-3"><input name="grupo" type="text" class="form-control" id="grupo" value="<?= (intval($edit) > 0 && (isset($grupo[0]->nombreGrupo))) ? $grupo[0]->nombreGrupo : ''; ?>" required></div>
        </div> 
        <div class="form-group row">

            <div class="col-sm-2"><strong>Jóven Promotor</strong></div>
            <div class="col-sm-3">
                <?php echo Modules::run('componente/select', array('idSelect' => 'idjoven', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $jovenes, 'nameSelect' => 'idjoven', 'selected' => (intval($edit) > 0 && isset($grupo[0]->idjoven)) ? $grupo[0]->idjoven : '-1', 'msgSelect' => 'Elije..')); ?>
            </div>
            <div class="col-sm-2"><strong>Matrimonio Asesor</strong></div>
            <div class="col-sm-3">
                <?php echo Modules::run('componente/select', array('idSelect' => 'idmatrimonio', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $matrimonios, 'nameSelect' => 'idmatrimonio', 'selected' => (intval($edit) > 0 && isset($grupo[0]->idmatrimonio)) ? $grupo[0]->idmatrimonio : '-1', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>

    </form>
    <div class="col-sm-12">
        <button id="guardarGrupoJoven" class="btn btn-primary">Guardar Equipo</button>
        <button id="cancelarGrupoJoven" class="btn btn-danger">Cancelar</button>
    </div>
</div>