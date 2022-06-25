<?php
$request = ['assets' => array(['src' => 'assets/js/usuario/usuario.js', 'type' => 'script'], ['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

$edit = count($usuario);

function getCargo($id) {
    switch ($id) {
        case 1:
            $cargo = "Coordinación";
            break;
        case 2:
            $cargo = "Seguimiento";
            break;
        case 3:
            $cargo = "Tesoreria";
            break;
        case 4:
            $cargo = "Comunicación";
            break;
        case 5:
            $cargo = "Formación";
            break;
        case 6:
            $cargo = "Juvenil";
            break;
        case 7:
            $cargo = "Espiritualidad";
            break;
        case 8:
            $cargo = "Coord. Enlace";
            break;

        default:
            $cargo = "Seleccione";
            break;
    }
    return $cargo;
}

$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestra = ($cargo == "2" || ($cargo == "6" && $nivel == "2")) ? "" : "hidden";
$lectura = (($cargo == "2" || ($cargo == "6" && $nivel == "2")) || $nivel == "1") ? "" : "readonly disabled";
$getBase = ($cargo == "6") ? "getBaseJuvenil" : "getBaseDependiente";
$getGrupo = ($cargo == "6") ? "getGrupoJuvenil" : "getGrupoDependiente";
$cargoUsuario = (intval($edit) > 0 && isset($usuario[0]->cargo)) ? $usuario[0]->cargo : '0';
?>
<div id="contieneFormUsuario" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formUsuario" name="formUsuario">
        <input type="hidden" id="accion" name="accion" value="">
        <input type="hidden" id="id_grupo" name="id_grupo" value="0">
        <input type="hidden" id="idusuario" name="idusuario" value="<?= (intval($edit) > 0 && isset($usuario[0]->idusuario)) ? $usuario[0]->idusuario : '' ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL USUARIO </h3></div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2"><strong>Estado</strong></div>
            <div class="col-sm-2">
                <?php echo Modules::run('componente/select', array('idSelect' => 'estado', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $estados, 'nameSelect' => 'estado', 'selected' => (intval($edit) > 0 && isset($usuario[0]->estado)) ? $usuario[0]->estado : '', 'msgSelect' => 'Elije..')); ?>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Diocesis</strong></div>
            <div class="col-sm-2" id="divSelectDiocesis">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_diocesis', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $diocesis, 'nameSelect' => 'id_diocesis', 'selected' => (intval($edit) > 0 && isset($usuario[0]->iddiocesis)) ? $usuario[0]->iddiocesis : '', 'msgSelect' => 'Elije..', 'funcion' => "'.$getBase.'(this)'")); ?>
            </div>
            <div class="col-sm-1"><strong>Base</strong></div>
            <div class="col-sm-2" id="divSelectBase">
                <?php echo Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'selected' => (intval($edit) > 0 && isset($usuario[0]->idbase)) ? $usuario[0]->idbase : '-1', 'msgSelect' => 'Elije..', 'funcion' => "'.$getGrupo.'(this)'")); ?>
            </div>

<!--            <div class="col-sm-1"><strong>Grupo</strong></div>
            <div class="col-sm-2" id="divSelectGrupo">
            <?php //echo Modules::run('componente/select', array('idSelect' => 'id_grupo', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $grupos, 'nameSelect' => 'id_grupo', 'selected' => (intval($edit) > 0 && isset($usuario[0]->idgrupo)) ? $usuario[0]->idgrupo : '', 'msgSelect' => 'Elije..')); ?>
            </div>-->
        </div>
        <div class="form-group row">

            <div class="col-sm-3"><strong>Usuario</strong></div>
            <div class="col-sm-3"><input name="usuario" type="text" class="form-control" id="usuario" value="<?= (intval($edit) > 0 && (isset($usuario[0]->login))) ? $usuario[0]->login : ''; ?>" <?= ((intval($edit) > 0) && ($nivel > 2)) ? 'readonly' : ""; ?> required></div>
            <div class="col-sm-3"><strong>Nombre Completo</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="nombre" type="text" id="nombre" value="<?= (intval($edit) > 0 && isset($usuario[0]->nombreUsuario)) ? $usuario[0]->nombreUsuario : ''; ?>" required=""></div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-3"><strong>Nro. Cédula</strong></div>
            <div class="col-sm-3"><input name="nrocedula" type="text" class="form-control" id="nrocedula" value="<?= (intval($edit) > 0 && (isset($usuario[0]->nrocedula))) ? $usuario[0]->nrocedula : ""; ?>"></div>
            <div class="col-sm-3"><strong>Password</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="password" type="password" id="password" value=""></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Correo</strong></div>
            <div class="col-sm-3"><input name="mail" type="email" class="form-control" id="mail" value="<?= (intval($edit) > 0 && (isset($usuario[0]->mail))) ? $usuario[0]->mail : ''; ?>"></div>
            <div class="col-sm-3"><strong>Nivel de Acceso</strong></div>
            <div class="col-sm-3">
                <select class="form-control" name="nivel" id="nivel" required <?= $lectura ?>>
                    <option value="<?= (intval($edit) > 0 && isset($usuario[0]->nivel)) ? $usuario[0]->nivel : '' ?>"><?= (intval($edit) > 0 && isset($usuario[0]->nivel)) ? (($usuario[0]->nivel === '2') ? 'Arqui/Diocesano' : 'Base') : 'Seleccione'; ?>                                                                                  </option>
                    <option value="2">Arqui/Diocesano</option>
                    <option value="3">Base</option>
                </select>
            </div>
            <div class="col-sm-3"><strong>Rol</strong></div>
            <div class="col-sm-3">
                <select class="form-control" name="cargo" id="cargo" required <?= $lectura ?>>
                    <option value="<?= $cargoUsuario ?>"><?= getCargo($cargoUsuario) ?>                                                                                  </option>
                    <?php if ($cargo == "2") { ?>
                        <option value="1">Coordinación</option>
                        <option value="2">Seguimiento</option>
                        <option value="3">Tesoreria</option>
                        <option value="4">Comunicación</option>
                        <option value="5">Formación</option>
                        <option value="6">Juvenil</option>
                        <option value="7">Espiritualidad</option>
                        <option value="8">Coord. Enlace</option>
                    <?php } else { ?>
                        <option value="6">Juvenil</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <button id="guardarUsuario" class="btn btn-primary">Guardar Usuario</button>
            <button id="cancelarUsuario" class="btn btn-danger">Cancelar</button>
        </div>
    </form>

</div>