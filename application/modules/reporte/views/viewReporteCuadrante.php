<?php
//$request = ['assets' => array(['src' => 'assets/js/gestion/cuenta.js', 'type' => 'script']), 'base' => base_url()];
//echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));
//
//$filtros_Selected = $this->session->userdata('filtrosReporteEncuestas');
//$today = ''; //date("d-m-Y");
//
//$countryName = 'Paraguay'; 
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
?>
<div class="row responsive well" id="contenedorSuperiorReporte">
    <div style="text-align: center">
        <h2>Cuadrante</h2>
    </div>
    <br>
    <input id="nivelUsuario" name="nivelUsuario" value="<?= $nivel ?>" hidden="">
    <div class="form-group row">
        <div class="col-sm-1"><strong>Diocesis</strong></div>
        <div class="col-sm-3" id="divSelectDiocesis">
            <?php echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => "", 'msgSelect' => 'Elije..', 'funcion' => 'getBaseDependiente(this)')); ?>
        </div>
        <div class="col-sm-2"><strong>Base</strong></div>
        <div class="col-sm-2" id="divSelectBase">
            <?php echo Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'selected' => '-1', 'msgSelect' => 'Elije..', 'funcion' => 'getGrupoDependiente(this)')); ?>
        </div>

        <div class="col-sm-2"><strong>Grupo</strong></div>
        <div class="col-sm-2" id="divSelectGrupo">
            <?php echo Modules::run('componente/select', array('idSelect' => 'id_grupo', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $grupos, 'nameSelect' => 'id_grupo', 'selected' => '', 'msgSelect' => 'Elije..')); ?>
        </div>
    </div>
    <div class="form row">
        <div class="col-sm-1"><strong>Nivel:</strong></div>
        <div class="col-sm-3" >
            <input type="number" id="nivel" name="nivel" class="" placeholder="Nivel" value="">
        </div>
        <div class="col-sm-2"><strong>Mes cumpleaños o aniversario:</strong></div>
        <div class="col-sm-2" >
            <input type="text" id="fec_desdeCV" name="fec_desdeCV" class="" placeholder="Mes cumpleaños o aniversario" value="">
        </div>
        <!--<div class="col-sm-2"><strong>Fecha Hasta:</strong></div>-->
<!--        <div class="col-sm-2">   
            <input type="text" id="fec_hastaCV" name="fec_hastaCV" class="datepicker" placeholder="Fecha Hasta" value="">

        </div>-->

    </div>
    <div class="form row">
        <div class="col-sm-3" id="botonesReporte">

            <button class="btn bg-primary" id='btn_search_Cuadrante' type="button"><span class="glyphicon glyphicon-filter">&nbsp;Filtrar</span></button>
            <button class="btn btn-default active" id='btn_excel_Cuadrante' data-flag="2" type="button"><span class="glyphicon glyphicon-download">&nbsp;Excel</span></button>

        </div>
    </div>
</div>

<br>

<div class="row responsive" id="contenedorInferiorReporte" style="padding: 10px; min-height: 25%;">
    <?= $tableroCuadrante ?>
</div>