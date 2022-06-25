<?php
$request = ['assets' => array(['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

function getNomenclatura($idDiocesis, $diocesis) {
    foreach ($diocesis as $value) {
        if ($value->id === $idDiocesis) {
            $nomenclatura = $value->nomenclatura;
            break;
        } else {
            $nomenclatura = "";
        }
    }
    return $nomenclatura;
}

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

$edit = count($matrimonio);
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestra = ($cargo != "2") ? "hidden" : "";
$lectura = ($cargo == "2") ? "" : "readonly";
?>
<div id="contieneFormMatrimonio" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formMatrimonio" name="formMatrimonio">
        <input type="hidden" id="accion" name="accion" value="">
        <input type="hidden" id="idmatrimonio" name="idmatrimonio" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->idmatrimonio)) ? $matrimonio[0]->idmatrimonio : '' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DE MEMBRESIA </h3></div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2"><strong>Estado</strong></div>
            <div class="col-sm-2">
                <?php echo Modules::run('componente/select', array('idSelect' => 'estado', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $estados, 'nameSelect' => 'estado', 'selected' => (intval($edit) > 0 && isset($matrimonio[0]->estado)) ? $matrimonio[0]->estado : '', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Diocesis</strong></div>
            <div class="col-sm-2" id="divSelectDiocesis">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => (intval($edit) > 0 && (isset($matrimonio[0]->iddiocesis)) && ($matrimonio[0]->iddiocesis != "null" || $matrimonio[0]->iddiocesis == "-1")) ? $matrimonio[0]->iddiocesis : (($userData->nivel > 1) ? $userData->iddiocesis : "-1"), 'msgSelect' => 'Elije..', 'funcion' => 'getBaseDependiente(this)')); ?>
            </div>
            <div class="col-sm-1"><strong>Base</strong></div>
            <div class="col-sm-2" id="divSelectBase">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'selected' => (intval($edit) > 0 && (isset($matrimonio[0]->idbase)) && ($matrimonio[0]->idbase != "null" || $matrimonio[0]->idbase == "-1")) ? $matrimonio[0]->idbase : (($userData->nivel == 3) ? $userData->idbase : "-1"), 'msgSelect' => 'Elije..', 'funcion' => 'getGrupoDependiente(this)')); ?>
            </div>

            <div class="col-sm-1"><strong>Grupo</strong></div>
            <div class="col-sm-2" id="divSelectGrupo">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_grupo', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $grupos, 'nameSelect' => 'id_grupo', 'selected' => (intval($edit) > 0 && (isset($matrimonio[0]->idgrupo) && $matrimonio[0]->idgrupo != "-1")) ? $matrimonio[0]->idgrupo : '-1', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>
        <div class="form-group row">

            <div class="col-sm-3"><strong>Fecha de Ingreso</strong></div>
            <div class="col-sm-3"><input name="fecha_ingreso" type="text" class="datepicker form-control" id="fecha_ingreso" value="<?= (intval($edit) > 0 && (isset($matrimonio[0]->fecha_ingreso) || $matrimonio[0]->fecha_ingreso !== "0000-00-00" || $matrimonio[0]->fecha_ingreso != NULL)) ? convertFecha($matrimonio[0]->fecha_ingreso) : ''; ?>"></div>
            <div class="col-sm-3"><strong>Nro. Membresia</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="nro_membresia" type="text" id="nro_membresia" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_cedula)) ? $matrimonio[0]->el_cedula . '/' . getNomenclatura((($matrimonio[0]->iddiocesis != NULL) ? $matrimonio[0]->iddiocesis : ($userData->nivel == 2) ? $userData->iddiocesis : ''), $diocesis) : ''; ?>" readonly></div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-3"><strong>Fecha de Membresía Plena</strong></div>
            <div class="col-sm-3"><input name="fecha_membresia" type="text" class="datepicker form-control" id="fecha_membresia" value="<?= (intval($edit) > 0 && (isset($matrimonio[0]->fecha_membresia) || $matrimonio[0]->fecha_membresia !== "0000-00-00" || $matrimonio[0]->fecha_membresia != NULL)) ? convertFecha($matrimonio[0]->fecha_membresia) : ""; ?>"></div>
            <div class="col-sm-3"><strong>Nro. de Encuentro Conyugal</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="nro_encuentro" type="text" id="nro_encuentro" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->nro_encuentro)) ? $matrimonio[0]->nro_encuentro : '' ?>"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Fecha de Encuentro Conyugal</strong></div>
            <div class="col-sm-3"><input name="fecha_encuentro" type="text" class="datepicker form-control" id="fecha_encuentro" value="<?= (intval($edit) > 0 && (isset($matrimonio[0]->fecha_encuentro) || $matrimonio[0]->fecha_encuentro !== "0000-00-00" || $matrimonio[0]->fecha_encuentro != NULL)) ? convertFecha($matrimonio[0]->fecha_encuentro) : ''; ?>"></div>
            <div class="col-sm-3"><strong>Casa de Retiro</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="casa_retiro" type="text" id="casa_retiro" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->casa_retiro)) ? ucwords($matrimonio[0]->casa_retiro) : ''; ?>"></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL ESPOSO</h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Nombres</strong></div>
            <div class="col-sm-3"><input class="form-control" name="nombre_el" type="text" id="nombre_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_nombre)) ? ucwords($matrimonio[0]->el_nombre) : ''; ?>" required="" <?= $lectura ?> ></div>
            <div class="col-sm-3"><strong>Apellidos </strong></div>
            <div class="col-sm-3"><input class="form-control" name="apellidos_el" type="text" id="apellidos_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_apellidos)) ? ucwords($matrimonio[0]->el_apellidos) : ''; ?>" required="" <?= $lectura ?>></div>
            <div></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Nacionalidad</strong></div>
            <div class="col-sm-3"><input class="form-control" name="nacionalidad_el" type="text" id="nacionalidad_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_nacionalidad)) ? ucwords($matrimonio[0]->el_nacionalidad) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-3"><strong>Fecha de Nacimiento </strong></div>
            <div class="col-sm-3"><input class="form-control" name="fecha_nac_el" type="text" class="datepicker" id="fecha_nac_el" value="<?= (intval($edit) > 0 && (isset($matrimonio[0]->el_fecha_nac) || $matrimonio[0]->el_fecha_nac !== '0000-00-00' || $matrimonio[0]->el_fecha_nac != NULL)) ? convertFecha($matrimonio[0]->el_fecha_nac) : ''; ?>" required="" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Lugar de Nacimiento</strong></div>
            <div class="col-sm-3"><input class="form-control" name="lugar_nac_el" type="text" id="lugar_nac_el" value="<?= isset($matrimonio[0]->el_lugar_nac) ? ucwords($matrimonio[0]->el_lugar_nac) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Cédula</strong></div>
            <div class="col-sm-2"><input class="form-control" name="cedula_el" type="number" id="cedula_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_cedula)) ? strtoupper(trim($matrimonio[0]->el_cedula)) : ''; ?>" onblur="verificaCedula('cedula_el', this);" required <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Celular</strong></div>
            <div class="col-sm-2"><input class="form-control" name="celular_el" type="number" id="celular_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_cel)) ? $matrimonio[0]->el_cel : ''; ?>" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Lugar de Trabajo</strong></div>
            <div class="col-sm-3"><input class="form-control" name="lugar_trabajo_el" type="text" id="lugar_trabajo_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_lugar_trabajo)) ? ucwords($matrimonio[0]->el_lugar_trabajo) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Tel. Laboral</strong></div>
            <div class="col-sm-2"><input class="form-control" name="tel_laboral_el" type="number" id="tel_laboral_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_tel_laboral)) ? $matrimonio[0]->el_tel_laboral : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Profesión</strong></div>
            <div class="col-sm-2"><input class="form-control" name="profesion_el" type="text" id="profesion_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_profesion)) ? ucwords($matrimonio[0]->el_profesion) : ''; ?>" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Grupo Sanguineo </strong></div>
            <div class="col-sm-1"><input class="form-control" name="grupo_san_el" type="text" id="grupo_san_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_grupo_sanguineo)) ? $matrimonio[0]->el_grupo_sanguineo : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Correo</strong></div>
            <div class="col-sm-3">
                <input class="form-control" name="correo_el" type="email" id="correo_el" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->el_correo)) ? $matrimonio[0]->el_correo : ''; ?>" <?= $lectura ?>>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DE LA ESPOSA</h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Nombres</strong></div>
            <div class="col-sm-3"><input class="form-control" name="nombre_ella" type="text" id="nombre_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_nombre)) ? ucwords($matrimonio[0]->ella_nombre) : ''; ?>" required="" <?= $lectura ?>></div>
            <div class="col-sm-3"><strong>Apellidos </strong></div>
            <div class="col-sm-3"><input class="form-control" name="apellidos_ella" type="text" id="apellidos_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_apellidos)) ? ucwords($matrimonio[0]->ella_apellidos) : ''; ?>" required="" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Nacionalidad</strong></div>
            <div class="col-sm-3"><input class="form-control" name="nacionalidad_ella" type="text" id="nacionalidad_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_nacionalidad)) ? ucwords($matrimonio[0]->ella_nacionalidad) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-3"><strong>Fecha de Nacimiento </strong></div>
            <div class="col-sm-3"><input class="form-control" name="fecha_nac_ella" type="text" class="datepicker" id="fecha_nac_ella" value="<?= (intval($edit) > 0 && (isset($matrimonio[0]->ella_fecha_nac) || $matrimonio[0]->ella_fecha_nac !== '0000-00-00' || $matrimonio[0]->ella_fecha_nac != NULL)) ? convertFecha($matrimonio[0]->ella_fecha_nac) : ''; ?>" required="" <?= $lectura ?>></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Lugar de Nacimiento</strong></div>
            <div class="col-sm-3"><input class="form-control" name="lugar_nac_ella" type="text" id="lugar_nac_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_lugar_nac)) ? ucwords($matrimonio[0]->ella_lugar_nac) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Cédula</strong></div>
            <div class="col-sm-2"><input class="form-control" name="cedula_ella" type="number" id="cedula_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_cedula)) ? $matrimonio[0]->ella_cedula : ''; ?>" onblur="verificaCedula('cedula_ella', this);" required <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Celular</strong></div>
            <div class="col-sm-2"><input class="form-control" name="celular_ella" type="number" id="celular_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_cel)) ? $matrimonio[0]->ella_cel : ''; ?>" <?= $lectura ?>></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Lugar de Trabajo</strong></div>
            <div class="col-sm-3"><input class="form-control" name="lugar_trabajo_ella" type="text" id="lugar_trabajo_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_lugar_trabajo)) ? ucwords($matrimonio[0]->ella_lugar_trabajo) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Tel. Laboral</strong></div>
            <div class="col-sm-2"><input class="form-control" name="tel_laboral_ella" type="number" id="tel_laboral_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_tel_laboral)) ? $matrimonio[0]->ella_tel_laboral : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Profesión</strong></div>
            <div class="col-sm-2"><input class="form-control" name="profesion_ella" type="text" id="profesion_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_profesion)) ? ucwords($matrimonio[0]->ella_profesion) : ''; ?>" <?= $lectura ?>></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Grupo Sanguineo </strong></div>
            <div class="col-sm-1"><input class="form-control" name="grupo_san_ella" type="text" id="grupo_san_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_grupo_sanguineo)) ? $matrimonio[0]->ella_grupo_sanguineo : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Correo</strong></div>
            <div class="col-sm-3"><input class="form-control" name="correo_ella" type="email" id="correo_ella" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ella_correo)) ? $matrimonio[0]->ella_correo : ''; ?>" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DE LA PAREJA</h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-1"><strong>Calle</strong></div>
            <div class="col-sm-2"><input class="form-control" name="calle" type="text" id="calle" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->direccion)) ? ucwords($matrimonio[0]->direccion) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Ciudad</strong></div>
            <div class="col-sm-2"><input class="form-control" name="ciudad" type="text" id="ciudad" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->ciudad)) ? ucwords($matrimonio[0]->ciudad) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Barrio</strong></div>
            <div class="col-sm-2"><input class="form-control" NAME="barrio" type="text" id="barrio" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->barrio)) ? ucwords($matrimonio[0]->barrio) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Telefono</strong></div>
            <div class="col-sm-2"><input class="form-control" name="telefono" type="number" id="telefono" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->telefono)) ? $matrimonio[0]->telefono : ''; ?>" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Cantidad de familia</strong></div>
            <div class="col-sm-1"><input class="form-control" name="cant_personas" type="number" id="cant_personas" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->cant_personas)) ? $matrimonio[0]->cant_personas : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-2"><strong>Terceras Personas</strong></div>
            <div class="col-sm-1">
                <select class="form-control" name="terceras_personas" id="terceras_personas">
                    <option value="<?= isset($matrimonio[0]->terceras_personas) ? $matrimonio[0]->terceras_personas : '' ?>" <?= $lectura ?>><?= (intval($edit) > 0 && isset($matrimonio[0]->terceras_personas)) ? strtoupper($matrimonio[0]->terceras_personas) : 'Seleccione'; ?></option>
                    <option value="Si">SI</option>
                    <option value="No">NO</option>
                </select>
            </div>

            <div class="col-sm-1"><strong>Como se trasladan</strong></div>
            <div class="col-sm-2"><input class="form-control" name="como_trasladan" type="text" id="como_trasladan" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->como_trasladan)) ? ucwords($matrimonio[0]->como_trasladan) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Vehiculo Propio</strong></div>
            <div class="col-sm-1">
                <select class="form-control" name="movilidad" id="movilidad">
                    <option value="<?= isset($matrimonio[0]->movilidad) ? $matrimonio[0]->movilidad : '' ?>" <?= $lectura ?>><?= (intval($edit) > 0 && isset($matrimonio[0]->movilidad)) ? strtoupper($matrimonio[0]->movilidad) : 'Seleccione'; ?></option>
                    <option value="Si">SI</option>
                    <option value="No">NO</option>
                </select>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Fecha de matrimonio </strong></div>
            <div class="col-sm-2"><input class="form-control" id="aniversario" type="text" class="datepicker" name="aniversario" maxlength="10" value="<?= (intval($edit) > 0 && (isset($matrimonio[0]->aniversario) || $matrimonio[0]->aniversario !== '0000-00-00' || $matrimonio[0]->aniversario != NULL)) ? convertFecha($matrimonio[0]->aniversario) : ''; ?>" required="" <?= $lectura ?>></div>
            <div class="col-sm-2"><strong>Estado Marital</strong></div>
            <div class="col-sm-2"><input class="form-control" name="estado_marital" type="text" id="estado_marital" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->estado_marital)) ? ucwords($matrimonio[0]->estado_marital) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-2"><strong>Parroquia de la Boda</strong></div>
            <div class="col-sm-2"><input class="form-control" name="parroquia_boda" type="text" id="parroquia_boda" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->parroquia_boda)) ? ucwords($matrimonio[0]->parroquia_boda) : ''; ?>" <?= $lectura ?>></div>

        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Tipo de Matrimonio</strong></div>
            <div class="col-sm-2">
                <select class="form-control" name="tipo_matrimonio" id="tipo_matrimonio" required="">
                    <option value="<?= (intval($edit) > 0 && isset($matrimonio[0]->tipo_mat)) ? $matrimonio[0]->tipo_mat : '' ?>" <?= $lectura ?>><?= (intval($edit) > 0 && isset($matrimonio[0]->tipo_mat)) ? ucwords($matrimonio[0]->tipo_mat) : 'Seleccione'; ?></option>
                    <option value="Tradicional">Tradicional</option>
                    <option value="Jóven">Jóven</option>
                </select>
            </div>
            <div class="col-sm-2"><strong>Parroquia / Capilla donde pertenece</strong></div>
            <div class="col-sm-2"><input class="form-control" name="parroquia_capilla" type="text" id="parroquia_capilla" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->parroquia_capilla)) ? ucwords($matrimonio[0]->parroquia_capilla) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-2"><strong>Direccion Parroquia</strong></div>
            <div class="col-sm-2"><input class="form-control" name="direccion_parroquia" type="text" id="direccion_parroquia" value="<?= (intval($edit) > 0 && isset($matrimonio[0]->direccion_parroquia)) ? ucwords($matrimonio[0]->direccion_parroquia) : ''; ?>" <?= $lectura ?>></div>
        </div>
        <div class="col-sm-12">
            <button id="guardarMatrimonio" class="btn btn-primary <?= $muestra ?>" >Guardar Ficha</button>
            <button id="cancelarMatrimonio" class="btn btn-danger">Cancelar</button>
        </div>
    </form>

</div>