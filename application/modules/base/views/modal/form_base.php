<?php
$request = ['assets' => array(['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

$edit = count($base);
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestra = ($cargo != "2") ? "hidden" : "";
$lectura = ($cargo == "2") ? "" : "readonly";
?>
<div id="contieneFormBase" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formBase" name="formBase">
        <input type="hidden" id="accion" name="accion" value="0">
        <input type="hidden" id="id_base" name="id_base" value="<?= (intval($edit) > 0 && isset($base[0]->idbase)) ? $base[0]->idbase : '' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DE LA BASE <?= (isset($base[0]->nombreBase)) ? $base[0]->nombreBase : ''; ?></h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Estado</strong></div>
            <div class="col-sm-2">
                <?php echo Modules::run('componente/select', array('idSelect' => 'estado', "clase" => "chosenselect", "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $estados, 'nameSelect' => 'estado', 'selected' => (intval($edit) > 0 && isset($base[0]->estado)) ? $base[0]->estado : '', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Diocesis</strong></div>
            <div class="col-sm-3" id="divSelectDiocesis">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => (intval($edit) > 0 && isset($base[0]->iddiocesis)) ? $base[0]->iddiocesis : '', 'msgSelect' => 'Elije..', 'funcion' => 'getBaseDependiente(this)')); ?>
            </div>
        </div>
        <div class="form-group row">

            <div class="col-sm-2"><strong>Nombre de la Base</strong></div>
            <div class="col-sm-3"><input name="base" type="text" class="form-control" id="base" value="<?= (intval($edit) > 0 && (isset($base[0]->nombreBase))) ? $base[0]->nombreBase : ''; ?>" required <?= $lectura ?>></div>
        </div> 
        <div class="form-group row">

            <div class="col-sm-2"><strong>Matrimonio Coordinador</strong></div>
            <div class="col-sm-3">
                <?php echo Modules::run('componente/select', array('idSelect' => 'idmatrimonio', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $matrimonios, 'nameSelect' => 'idmatrimonio', 'selected' => (intval($edit) > 0 && isset($base[0]->idmatrimonio)) ? $base[0]->idmatrimonio : '-1', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>

    </form>
    <div class="col-sm-12">
        <button id="guardarBase" class="btn btn-primary <?= $muestra ?>" >Guardar Base</button>
        <button id="cancelarBase" class="btn btn-danger">Cancelar</button>
    </div>
</div>