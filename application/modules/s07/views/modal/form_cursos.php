<?php
//$request = ['assets' => array(['src' => 'assets/js/grupo/grupo.js', 'type' => 'script'], ['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
//echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));
?>
<div id="contieneFormCurso" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formCurso" name="formCurso">
        <input type="hidden" id="Accion" name="Accion" value="0">
        <input type="hidden" id="idmatrimonio" name="idmatrimonio" value="<?= (count($idmatrimonio) > 0 && isset($idmatrimonio)) ? $idmatrimonio : '-1' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DE LOS CURSOS</h3></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1"><strong>Cursos</strong></div>
            <div class="col-sm-3">
                <?php echo Modules::run('componente/select', array('idSelect' => 'idcurso', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $cursos, 'nameSelect' => 'idcurso', 'selected' => '-1', 'msgSelect' => 'Elije..')); ?>
            </div>
            <div class="col-sm-1"><strong>Fecha</strong></div>
            <div class="col-sm-2"><input name="fecha" type="text" class="form-control required" id="fecha" value=""></div>
        </div>
        <div class="form-group row">
            
            <div class="col-sm-1"><strong>Lugar</strong></div>
            <div class="col-sm-3"><input name="lugar" type="text" class="form-control" id="lugar" value=""></div>
            <div class="col-sm-1"><strong>Disertante</strong></div>
            <div class="col-sm-3"><input name="disertante" type="text" class="form-control" id="disertante" value=""></div>
        </div> 
    </form>

    <div class="col-sm-12">
        <button id="guardarCurso" class="btn btn-primary" onclick="nuevoCurso()">Gurdar Curso</button>
        <button id="cancelarCurso" class="btn btn-danger" onclick="s02('<?= $idmatrimonio ?>')">Cancelar</button>
    </div>
    <br>
    <!--    <div id="contieneTablaListaEvaluacion" class="">
    <? //= Modules::run("grupo/grupo/listaEvaluacionesMiembros", 1, (intval($edit) > 0 && isset($evaluacion[0]->ideva_matrimonio)) ? $evaluacion[0]->ideva_matrimonio : '-1', $evaluacion[0]->idgrupo);  ?> 
        </div>-->
