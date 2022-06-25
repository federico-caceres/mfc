<?php
$request = ['assets' => array(['src' => 'assets/js/gestion/joven.js', 'type' => 'script']), 'base' => base_url()];
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

$edit = count($joven);
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestra = ($cargo != "2" && $cargo != "6") ? "hidden" : "";
$lectura = ($cargo == "2" || $cargo == "6") ? "" : "readonly";
?>
<div id="contieneFormJoven" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formJoven" name="formJoven">
        <input type="hidden" id="accion" name="accion" value="">
        <input type="hidden" id="idjoven" name="idjoven" value="<?= (intval($edit) > 0 && isset($joven[0]->idjoven)) ? $joven[0]->idjoven : '' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DE MEMBRESIA </h3></div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2"><strong>Estado</strong></div>
            <div class="col-sm-2">
                <?php echo Modules::run('componente/select', array('idSelect' => 'estado', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $estados, 'nameSelect' => 'estado', 'selected' => (intval($edit) > 0 && isset($joven[0]->estado)) ? $joven[0]->estado : '', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Diocesis</strong></div>
            <div class="col-sm-2" id="divSelectDiocesis">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => (intval($edit) > 0 && isset($joven[0]->iddiocesis)) ? $joven[0]->iddiocesis : '', 'msgSelect' => 'Elije..', 'funcion' => 'getBaseDependiente(this)')); ?>
            </div>
            <div class="col-sm-1"><strong>Base</strong></div>
            <div class="col-sm-2" id="divSelectBase">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'selected' => (intval($edit) > 0 && isset($joven[0]->idbase)) ? $joven[0]->idbase : '-1', 'msgSelect' => 'Elije..', 'funcion' => 'getGrupoDependiente(this)')); ?>
            </div>

            <div class="col-sm-1"><strong>Grupo</strong></div>
            <div class="col-sm-2" id="divSelectGrupo">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_grupo', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $grupos, 'nameSelect' => 'id_grupo', 'selected' => (intval($edit) > 0 && isset($joven[0]->idgrupo)) ? $joven[0]->idgrupo : '', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>
        <div class="form-group row">

            <div class="col-sm-3"><strong>Fecha de Ingreso</strong></div>
            <div class="col-sm-3"><input name="fecha_ingreso" type="text" class="datepicker form-control" id="fecha_ingreso" value="<?= (intval($edit) > 0 && (isset($joven[0]->fecha_inicio) || $joven[0]->fecha_inicio !== "0000-00-00" || $joven[0]->fecha_inicio != NULL)) ? convertFecha($joven[0]->fecha_inicio) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-3"><strong>Nro. Membresia</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="nro_membresia" type="text" id="nro_membresia" value="<?= (intval($edit) > 0 && isset($joven[0]->cedula)) ? $joven[0]->cedula . '/' . getNomenclatura($joven[0]->iddiocesis, $diocesis) : ''; ?>" readonly></div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-3"><strong>Fecha de Membresía Plena</strong></div>
            <div class="col-sm-3"><input name="fecha_membresia" type="text" class="datepicker form-control" id="fecha_membresia" value="<?= (intval($edit) > 0 && (isset($joven[0]->fecha_membresia) || $joven[0]->fecha_membresia !== "0000-00-00" || $joven[0]->fecha_membresia != NULL)) ? convertFecha($joven[0]->fecha_membresia) : ""; ?>" <?= $lectura ?>></div>
            <div class="col-sm-3"><strong>Nro. de Retiro</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="nro_encuentro" type="text" id="nro_encuentro" value="<?= (intval($edit) > 0 && isset($joven[0]->nro_encuentro)) ? $joven[0]->nro_encuentro : '' ?>"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Fecha de Retiro</strong></div>
            <div class="col-sm-3"><input name="fecha_encuentro" type="text" class="datepicker form-control" id="fecha_encuentro" value="<?= (intval($edit) > 0 && (isset($joven[0]->fecha_encuentro) || $joven[0]->fecha_encuentro !== "0000-00-00" || $joven[0]->fecha_encuentro != NULL)) ? convertFecha($joven[0]->fecha_encuentro) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-3"><strong>Casa de Retiro</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="casa_retiro" type="text" id="casa_retiro" value="<?= (intval($edit) > 0 && isset($joven[0]->casa_retiro)) ? ucwords($joven[0]->casa_retiro) : ''; ?>" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL JOVEN</h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Nombres</strong></div>
            <div class="col-sm-3"><input class="form-control" name="nombre" type="text" id="nombre" value="<?= (intval($edit) > 0 && isset($joven[0]->nombreJoven)) ? ucwords($joven[0]->nombreJoven) : ''; ?>" required="" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Apellido Paterno</strong></div>
            <div class="col-sm-2"><input class="form-control" name="apellidoP" type="text" id="apellidoP" value="<?= (intval($edit) > 0 && isset($joven[0]->apellidoP)) ? ucwords($joven[0]->apellidoP) : ''; ?>" required="" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Apellido Materno</strong></div>
            <div class="col-sm-2"><input class="form-control" name="apellidoM" type="text" id="apellidoM" value="<?= (intval($edit) > 0 && isset($joven[0]->apellidoM)) ? ucwords($joven[0]->apellidoM) : ''; ?>" required="" <?= $lectura ?>></div>
            <div></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Nacionalidad</strong></div>
            <div class="col-sm-3"><input class="form-control" name="nacionalidad" type="text" id="nacionalidad" value="<?= (intval($edit) > 0 && isset($joven[0]->nacionalidad)) ? ucwords($joven[0]->nacionalidad) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-3"><strong>Fecha de Nacimiento </strong></div>
            <div class="col-sm-3"><input class="form-control" name="fecha_nac" type="text" class="datepicker" id="fecha_nac" value="<?= (intval($edit) > 0 && (isset($joven[0]->fecha_nac) || $joven[0]->fecha_nac !== '0000-00-00' || $joven[0]->fecha_nac != NULL)) ? convertFecha($joven[0]->fecha_nac) : ''; ?>" required="" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Lugar de Nacimiento</strong></div>
            <div class="col-sm-3"><input class="form-control" name="lugar_nacimiento" type="text" id="lugar_nacimiento" value="<?= isset($joven[0]->lugar_nacimiento) ? ucwords($joven[0]->lugar_nacimiento) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Cédula</strong></div>
            <div class="col-sm-2"><input class="form-control" name="cedula" type="number" id="cedula" value="<?= (intval($edit) > 0 && isset($joven[0]->cedula)) ? strtoupper(trim($joven[0]->cedula)) : '0'; ?>" onblur="verificaCedulaJoven('cedula', this)" required <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Celular</strong></div>
            <div class="col-sm-2"><input class="form-control" name="celular" type="number" id="celular" value="<?= (intval($edit) > 0 && isset($joven[0]->cel)) ? $joven[0]->cel : ''; ?>" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Lugar de Trabajo</strong></div>
            <div class="col-sm-3"><input class="form-control" name="lugar_trabajo" type="text" id="lugar_trabajo" value="<?= (intval($edit) > 0 && isset($joven[0]->lugar_trabajo)) ? ucwords($joven[0]->lugar_trabajo) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Tel. Laboral</strong></div>
            <div class="col-sm-2"><input class="form-control" name="tel_laboral" type="number" id="tel_laboral" value="<?= (intval($edit) > 0 && isset($joven[0]->tel_laboral)) ? $joven[0]->tel_laboral : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Profesión</strong></div>
            <div class="col-sm-2"><input class="form-control" name="profesion" type="text" id="profesion" value="<?= (intval($edit) > 0 && isset($joven[0]->profesion)) ? ucwords($joven[0]->profesion) : ''; ?>" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Grupo Sanguineo </strong></div>
            <div class="col-sm-1"><input class="form-control" name="grupo_sansanguineo" type="text" id="grupo_sanguineo" value="<?= (intval($edit) > 0 && isset($joven[0]->grupo_sanguineo)) ? $joven[0]->grupo_sanguineo : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Correo</strong></div>
            <div class="col-sm-3">
                <input class="form-control" name="correo" type="email" id="correo" value="<?= (intval($edit) > 0 && isset($joven[0]->correo)) ? $joven[0]->correo : ''; ?>" <?= $lectura ?>>
            </div>
            <div class="col-sm-1"><strong>Tipo de Jóven</strong></div>
            <div class="col-sm-2">
                <select class="form-control" name="tipoJoven" id="tipoJoven" required="" <?= $lectura ?>>
                    <option value="<?= (intval($edit) > 0 && isset($joven[0]->tipoJoven)) ? $joven[0]->tipoJoven : '' ?>"><?= (intval($edit) > 0 && isset($joven[0]->tipoJoven)) ? ucwords($joven[0]->tipoJoven) : 'Seleccione'; ?></option>
                    <option value="Adolescente">Adolescente</option>
                    <option value="Jóven">Jóven</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Está Confirmado</strong></div>
            <div class="col-sm-2">
                <select class="form-control" name="confirmado" id="confirmado" required="" <?= $lectura ?>>
                    <option value="<?= (intval($edit) > 0 && isset($joven[0]->confirmado)) ? $joven[0]->confirmado : '' ?>"><?= (intval($edit) > 0 && isset($joven[0]->confirmado)) ? ucwords($joven[0]->confirmado) : 'Seleccione'; ?></option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
            </div> <div class="col-sm-2"><strong>Parroquia donde se Confirmó</strong></div>
            <div class="col-sm-3">
                <input class="form-control" name="parroquia_confirmacion" type="text" id="parroquia_confirmacion" value="<?= (intval($edit) > 0 && isset($joven[0]->parroquia_confirmacion)) ? $joven[0]->parroquia_confirmacion : ''; ?>" <?= $lectura ?>>
            </div>

        </div>

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DE LOS PADRES</h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Nombre y Apeelido del Padre</strong></div>
            <div class="col-sm-3"><input class="form-control" name="nombre_padre" type="text" id="nombre_padre" value="<?= (intval($edit) > 0 && isset($joven[0]->nombre_padre)) ? ucwords($joven[0]->nombre_padre) : ''; ?>" required="" <?= $lectura ?>></div>
            <div class="col-sm-3"><strong>Nombre y Apellido de la Madre </strong></div>
            <div class="col-sm-3"><input class="form-control" name="nombre_madre" type="text" id="nombre_madre" value="<?= (intval($edit) > 0 && isset($joven[0]->nombre_madre)) ? ucwords($joven[0]->nombre_madre) : ''; ?>" required="" <?= $lectura ?>></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3"><strong>Tel. del Padre</strong></div>
            <div class="col-sm-3"><input class="form-control" name="tel_padre" type="text" id="tel_padre" value="<?= (intval($edit) > 0 && isset($joven[0]->tel_padre)) ? ucwords($joven[0]->tel_padre) : ''; ?>"></div>
            <div class="col-sm-3"><strong>Tel. de la Madre </strong></div>
            <div class="col-sm-3"><input class="form-control" name="tel_madre" type="text" class="datepicker" id="tel_madre" value="<?= (intval($edit) > 0 && (isset($joven[0]->tel_madre))) ? $joven[0]->tel_madre : ''; ?>" required="" <?= $lectura ?>></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Correo Padre</strong></div>
            <div class="col-sm-3"><input class="form-control" name="correo_padre" type="mail" id="correo_padre" value="<?= (intval($edit) > 0 && isset($joven[0]->correo_padre)) ? ucwords($joven[0]->correo_padre) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Correo Madre</strong></div>
            <div class="col-sm-2"><input class="form-control" name="correo_madre" type="mail" id="correo_madre" value="<?= (intval($edit) > 0 && isset($joven[0]->correo_madre)) ? $joven[0]->correo_madre : ''; ?>" <?= $lectura ?>></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Pertenecen al MFC</strong></div>
            <div class="col-sm-1">
                <select class="form-control" name="padres_pertecen_mfc" id="padres_pertecen_mfc" <?= $lectura ?>>
                    <option value="<?= isset($joven[0]->padres_pertecen_mfc) ? $joven[0]->padres_pertecen_mfc : '' ?>"><?= (intval($edit) > 0 && isset($joven[0]->padres_pertecen_mfc)) ? strtoupper($joven[0]->padres_pertecen_mfc) : 'Seleccione'; ?></option>
                    <option value="Si">SI</option>
                    <option value="No">NO</option>
                </select>
            </div></div>

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL HOGAR</h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-1"><strong>Calle</strong></div>
            <div class="col-sm-2"><input class="form-control" name="calle" type="text" id="calle" value="<?= (intval($edit) > 0 && isset($joven[0]->calle)) ? ucwords($joven[0]->calle) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Ciudad</strong></div>
            <div class="col-sm-2"><input class="form-control" name="ciudad" type="text" id="ciudad" value="<?= (intval($edit) > 0 && isset($joven[0]->ciudad)) ? ucwords($joven[0]->ciudad) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Barrio</strong></div>
            <div class="col-sm-2"><input class="form-control" NAME="barrio" type="text" id="barrio" value="<?= (intval($edit) > 0 && isset($joven[0]->barrio)) ? ucwords($joven[0]->barrio) : ''; ?>" <?= $lectura ?>></div>
            <div class="col-sm-1"><strong>Telefono</strong></div>
            <div class="col-sm-2"><input class="form-control" name="telefono" type="number" id="telefono" value="<?= (intval($edit) > 0 && isset($joven[0]->telefono)) ? $joven[0]->telefono : ''; ?>" <?= $lectura ?>></div>
        </div>

        <div class="col-sm-12">
            <button id="guardarJoven" class="btn btn-primary <?= $muestra ?>" type="submit">Guardar Ficha</button>
            <button id="cancelarJoven" class="btn btn-danger">Cancelar</button>
        </div>
    </form>

</div>