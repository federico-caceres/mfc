<?php
//$request = ['assets' => array(['src' => 'assets/js/grupo/grupo.js', 'type' => 'script'], ['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
//echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));
?>
<div id="contieneFormAporte" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formAporte" name="formAporte">
        <input type="hidden" id="Accion" name="Accion" value="0">
        <input type="hidden" id="idjoven" name="idjoven" value="<?= (count($idjoven) > 0 && isset($idjoven)) ? $idjoven : '-1' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DE LOS APORTES</h3></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1"><strong>Concepto</strong></div>
            <div class="col-sm-3">
                <?php echo Modules::run('componente/select', array('idSelect' => 'idconcepto_aporte', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $conceptos_aporte, 'nameSelect' => 'idconcepto_aporte', 'selected' => '-1', 'msgSelect' => 'Elije..')); ?>
            </div>
            <div class="col-sm-1"><strong>Año</strong></div>
            <div class="col-sm-2"><input name="ano" type="text" class="form-control" id="ano" value=""></div>
        </div>
        <div class="form-group row">
            
            <div class="col-sm-1"><strong>Monto</strong></div>
            <div class="col-sm-3"><input name="monto" type="number" class="form-control" id="monto" value=""></div>
            <div class="col-sm-1"><strong>Fecha de Pago</strong></div>
            <div class="col-sm-3"><input name="fecha_pago" type="text" class="form-control" id="fecha_pago" value=""></div>
            <div class="col-sm-1"><strong>Nro. Recibo</strong></div>
            <div class="col-sm-3"><input name="nro_recibo" type="number" class="form-control" id="nro_recibo" value=""></div>
        </div> 
    </form>

    <div class="col-sm-12">
        <button id="guardarAporteJovenes" class="btn btn-primary" onclick="nuevoAporteJovenes()">Gurdar Aporte</button>
        <button id="cancelarAporte" class="btn btn-danger" onclick="sj06('<?= $idjoven ?>')">Cancelar</button>
    </div>
    <br>
    <!--    <div id="contieneTablaListaEvaluacion" class="">
    <? //= Modules::run("grupo/grupo/listaEvaluacionesMiembros", 1, (intval($edit) > 0 && isset($evaluacion[0]->ideva_matrimonio)) ? $evaluacion[0]->ideva_matrimonio : '-1', $evaluacion[0]->idgrupo);  ?> 
        </div>-->
