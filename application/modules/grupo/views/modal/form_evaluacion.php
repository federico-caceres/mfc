<?php
//$request = ['assets' => array(['src' => 'assets/js/grupo/grupo.js', 'type' => 'script'], ['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
//echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

$edit = count($evaluacion);
$idevaluacion;
?>
<div id="contieneFormEvaluacion" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formEvaluacion" name="formEvaluacion">
        <input type="hidden" id="Accion" name="Accion" value="0">
        <input type="hidden" id="idgrupo" name="idgrupo" value="0">
        <input type="hidden" id="iddiocesis" name="iddiocesis" value="0">
        <input type="hidden" id="idbase" name="idbase" value="0">
        <input type="hidden" id="idEvaluacion" name="idEvaluacion" value="<?= (intval($edit) > 0 && isset($evaluacion[0]->idevaluacion)) ? $evaluacion[0]->idevaluacion : '-1' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL S05 del Equipo <?= (isset($grupo[0]->nombreGrupo)) ? $grupo[0]->nombreGrupo : ''; ?>  <?= (isset($evaluacion[0]->tema_nro)) ? "Tema Nro. " . $evaluacion[0]->tema_nro : ''; ?></h3></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Matrimonio Equipero</strong></div>
            <div class="col-sm-3">
                <?php echo Modules::run('componente/select', array('idSelect' => 'idmatrimonio', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $matrimonios, 'nameSelect' => 'idmatrimonio', 'selected' => '-1', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1"><strong>Puntualidad El</strong></div>
            <div class="col-sm-1"><input name="puntualidad_el" type="number" class="form-control" id="puntualidad_el" value="" required onchange="SumaPromedio()"></div>
            <div class="col-sm-1"><strong>Puntualidad Ella</strong></div>
            <div class="col-sm-1"><input name="puntualidad_ella" type="number" class="form-control" id="puntualidad_ella" value="" required onchange="SumaPromedio()"></div>
            <div class="col-sm-1"><strong>Estudio El</strong></div>
            <div class="col-sm-1"><input name="estudio_el" type="number" class="form-control" id="estudio_el" value="" required onchange="SumaPromedio()"></div>
            <div class="col-sm-1"><strong>Estudio Ella</strong></div>
            <div class="col-sm-1"><input name="estudio_ella" type="number" class="form-control" id="estudio_ella" value="" required onchange="SumaPromedio()"></div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-1"><strong>Participación El</strong></div>
            <div class="col-sm-1"><input name="participacion_el" type="number" class="form-control" id="participacion_el" value="" required onchange="SumaPromedio()"></div>
            <div class="col-sm-1"><strong>Participación Ella</strong></div>
            <div class="col-sm-1"><input name="participacion_ella" type="number" class="form-control" id="participacion_ella" value="" required onchange="SumaPromedio()"></div>
            <div class="col-sm-1"><strong>Cumple A. Sugerida El</strong></div>
            <div class="col-sm-1"><input name="cumple_accion_sugerida_el" type="number" class="form-control" id="cumple_accion_sugerida_el" value="" required onchange="SumaPromedio()"></div>
            <div class="col-sm-1"><strong>Cumple A. Sugerida Ella</strong></div>
            <div class="col-sm-1"><input name="cumple_accion_sugerida_ella" type="number" class="form-control" id="cumple_accion_sugerida_ella" value="" required onchange="SumaPromedio()"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Suma Total</strong></div>
            <div class="col-sm-1"><input id="suma_total" name="suma_total" type="text" class="form-control" value="" readonly=""></div> 
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Promedio</strong></div>
            <div class="col-sm-1"><input id="promedio" name="promedio" type="text" class="form-control" value="" readonly=""></div> 
        </div>

    </form>

    <div class="col-sm-12">
        <button id="guardarEvaluacion" class="btn btn-primary" onclick="nuevaEvaluacion('0', '<?= $evaluacion[0]->idevaluacion ?>','<?= $evaluacion[0]->nivel ?>')">Gurdar evaluaciones</button>
        <button id="cancelarEvaluacion" class="btn btn-danger" onclick="listaS05('<?= $grupo[0]->idgrupo ?>')">Cancelar</button>
    </div>
    <br>
    <!--    <div id="contieneTablaListaEvaluacion" class="">
    <? //= Modules::run("grupo/grupo/listaEvaluacionesMiembros", 1, (intval($edit) > 0 && isset($evaluacion[0]->ideva_matrimonio)) ? $evaluacion[0]->ideva_matrimonio : '-1', $evaluacion[0]->idgrupo); ?> 
        </div>-->
