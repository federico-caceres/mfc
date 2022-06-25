<?php
$request = ['assets' => array(['src' => 'assets/js/grupo/grupo.js', 'type' => 'script'], ['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

function convertFecha($fecha) {
# The 0th day of a month is the same as the last day of the month before
    if ($fecha == null || $fecha == "0000-00-00") {
        $return = "";
    } else {
        $fechaFormat = date_create($fecha);
        $return = date_format($fechaFormat, "d/m/Y");
    }

    return $return;
}

$edit = count($grupoS05);
if ($edit > 0 && key($grupoS05) === "idgrupo") {
    $idGrupo = $grupoS05["idgrupo"];
    $idEvaluacion = "0";
    $nivelEvaluacion = "";
} else if ($edit > 0 && is_object($grupoS05[0])) {
    $idGrupo = $grupoS05[0]->idgrupo;
    $idEvaluacion = $grupoS05[0]->idevaluacion;
    $nivelEvaluacion = $grupoS05[0]->nivelEvaluacion;
} else {
    $idGrupo = "0";
    $idEvaluacion = "0";
    $nivelEvaluacion = "";
}
if ($nivelEvaluacion == "0") {
    $niveDescripcion = "Inicial MJ";
} else {
    $niveDescripcion = $nivelEvaluacion;
}
?>
<div id="contieneFormS05" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formS05" name="formS05">
        <input type="hidden" id="accion" name="accion" value="0">
        <input type="hidden" id="idevaluacion" name="idevaluacion" value="<?= $idEvaluacion ?>">
        <input type="hidden" id="idGrupoS05" name="idGrupoS05" value="<?= $idGrupo ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL S05 del Equipo <?= (isset($grupos[0]->name)) ? $grupos[0]->name : ''; ?>  <?= (isset($grupoS05[0]->tema_nro)) ? "Tema Nro. " . $grupoS05[0]->tema_nro : ''; ?></h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-1"><strong>Diocesis</strong></div>
            <div class="col-sm-2" id="divSelectDiocesis">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => (intval($edit) > 0 && isset($diocesis[0]->id)) ? $diocesis[0]->id : '', 'msgSelect' => 'Elije..', 'funcion' => 'getBaseDependiente(this)')); ?>
            </div>
            <div class="col-sm-1"><strong>Base Parroquial</strong></div>
            <div class="col-sm-2" id="divSelectBase">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'selected' => (intval($edit) > 0 && isset($bases[0]->id)) ? $bases[0]->id : '-1', 'msgSelect' => 'Elije..', 'funcion' => 'getGrupoDependiente(this)')); ?>
            </div>

            <div class="col-sm-1"><strong>Equipo Básico</strong></div>
            <div class="col-sm-2" id="divSelectGrupo">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_grupo', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $grupos, 'nameSelect' => 'id_grupo', 'selected' => $idGrupo, 'msgSelect' => 'Elije..')); ?>
            </div>
            <div class="col-sm-1"><strong>Nivel del Equipo</strong></div>
            <div class="col-sm-2">

                <select class="form-control" name="nivel" id="nivel" onblur="getTemaDependiente(this)" required>
                    <option value="<?= isset($nivelEvaluacion) ? $nivelEvaluacion : '' ?>"><?= $niveDescripcion ?></option>
                    <option value="0">Inicial MJ</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Matrimonio Promotor</strong></div>
            <div class="col-sm-3">
                <?php echo Modules::run('componente/select', array('idSelect' => 'idmatrimonio', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $matrimonios, 'nameSelect' => 'idmatrimonio', 'selected' => (intval($edit) > 0 && isset($grupoS05[0]->idmatrimonio)) ? $grupoS05[0]->idmatrimonio : '-1', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Tema desarrollado</strong></div>
            <!--<div class="col-sm-3"><input name="tema_nro" type="number" class="form-control" id="tema_nro" value="<? //= (intval($edit) > 0 && (isset($grupoS05[0]->tema_nro))) ? $grupoS05[0]->tema_nro : '';      ?>" required></div>-->
            <div class="col-sm-3" id="divTemaNro"><?php echo Modules::run('componente/select', array('idSelect' => 'tema_nro', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $temas, 'nameSelect' => 'tema_nro', 'selected' => (intval($edit) > 0 && isset($grupoS05[0]->tema_nro)) ? $grupoS05[0]->tema_nro : '-1', 'msgSelect' => 'Cargue primero nivel..')); ?></div>
            <!--<div class="col-sm-2"><strong>Tema desarrollado</strong></div>-->
            <div class="col-sm-3"><input  name="tema_descripcion" type="text" class="form-control hidden" id="tema_descripcion" value="<? //= (intval($edit) > 0 && (isset($grupoS05[0]->tema_descripcion))) ? $grupoS05[0]->tema_descripcion : '';      ?>"></div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-2"><strong>Fecha Reunión</strong></div>
            <div class="col-sm-2"><input name="fechaReunion" type="text" class="form-control datepicker" id="fechaReunion" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->fechaReunion))) ? convertFecha($grupoS05[0]->fechaReunion) : ''; ?>" required></div>
            <div class="col-sm-2"><strong>En casa de</strong></div>
            <div class="col-sm-2"><input name="casaReunion" type="text" class="form-control" id="casaReunion" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->casaReunion))) ? $grupoS05[0]->casaReunion : ''; ?>" required></div>
            <div class="col-sm-2"><strong>Asistencia del Asesor</strong></div>
            <div class="col-sm-2">
                <select class="form-control" name="asistenciaAsesor" id="asistenciaAsesor">
                    <option value="<?= isset($grupoS05[0]->asistenciaAsesor) ? $grupoS05[0]->asistenciaAsesor : '' ?>"><?= (intval($edit) > 0 && isset($grupoS05[0]->asistenciaAsesor)) ? strtoupper($grupoS05[0]->asistenciaAsesor) : 'Seleccione'; ?></option>
                    <option value="Si">SI</option>
                    <option value="No">NO</option>
                </select>
            </div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-2"><strong>Hora Planificada</strong></div>
            <div class="col-sm-2"><input name="horaPlanificado" type="time" class="form-control" id="horaPlanificado" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->horaPlanificado))) ? $grupoS05[0]->horaPlanificado : ''; ?>" required></div>
            <div class="col-sm-2"><strong>Hora Inicio</strong></div>
            <div class="col-sm-2"><input name="horaIniciado" type="time" class="form-control" id="horaIniciado" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->horaIniciado))) ? $grupoS05[0]->horaIniciado : ''; ?>" required></div>
            <div class="col-sm-2"><strong>Hora Finalizada</strong></div>
            <div class="col-sm-2"><input name="horaFinalizado" type="time" class="form-control" id="horaFinalizado" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->horaTerminado))) ? $grupoS05[0]->horaTerminado : ''; ?>" required></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Próximo Día Reunión</strong></div>
            <div class="col-sm-2"><input name="proximaFechaReunion" type="text" class="form-control datepicker" id="proximaFechaReunion" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->proximaFechaReunion))) ? convertFecha($grupoS05[0]->proximaFechaReunion) : ''; ?>" required></div>
            <div class="col-sm-2"><strong>Próxima en casa de</strong></div>
            <div class="col-sm-2"><input name="proximaCasaReunion" type="text" class="form-control" id="proximaCasaReunion" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->proximaCasaReunion))) ? $grupoS05[0]->proximaCasaReunion : ''; ?>" required></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Acción Sugerida</strong></div>
            <div class="col-sm-10"><textarea id="accionSugerida" name="accionSugerida" type="text" class="form-control" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->accionSugerida))) ? $grupoS05[0]->accionSugerida : ''; ?>"><?= (intval($edit) > 0 && (isset($grupoS05[0]->accionSugerida))) ? $grupoS05[0]->accionSugerida : ''; ?></textarea></div> 
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Observaciones</strong></div>
            <div class="col-sm-10"><textarea id="observaciones" name="observaciones" type="text" class="form-control" value="<?= (intval($edit) > 0 && (isset($grupoS05[0]->observaciones))) ? $grupoS05[0]->observaciones : ''; ?>"><?= (intval($edit) > 0 && (isset($grupoS05[0]->observaciones))) ? $grupoS05[0]->observaciones : ''; ?></textarea></div> 
        </div>

    </form>
    <div class="col-sm-12">
        <button id="guardarS05" class="btn btn-primary">Agregar evaluaciones</button>
        <button id="cancelarS05" class="btn btn-danger" onclick="listaS05('<?= $idGrupo ?>')">Cancelar</button>
    </div>
</div>
<div id="contieneEvaluaciones">
    <?= Modules::run("grupo/grupo/listaEvaluaciones", 1, $idEvaluacion, $idGrupo) ?>
</div>
