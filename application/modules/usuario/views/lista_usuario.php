<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestra = ($cargo == "2" || (($cargo == "6" && $nivel == "2"))) ? "" : "hidden";
$icono = ($cargo == "2" || (($cargo == "6" && $nivel == "2"))) ? "glyphicon-pencil" : "glyphicon-search";
$lectura = ($cargo == "2" || (($cargo == "6" && $nivel == "2"))) ? "" : "readonly";
?>
<h3>Listado de Usuarios</h3>
<?php if ($nivel !== "3") { ?>
    <div id = "div_btn_usuario_nuevo" align = "left" style = "padding-bottom: 10px" class="<?= $muestra ?>">
        <button title = "Agregar Usuario" type = "button" id = "btn_usuario_nuevo" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar Usuario</button>
    </div>
<?php } ?>
<table id = "tablero_usuario" class = "table table-striped">
    <thead>
        <tr>
            <th>Nro. Cédula</th>
            <th>Usuario</th>
            <th>Nombre Completo</th>
            <th>Nivel Usuario</th>
            <th>Mail</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($usuarios) && sizeof($usuarios) > 0) {
            foreach ($usuarios as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idusuario ?>'>
                    <td><?= $value->nrocedula ?></td>
                    <td><?= $value->login ?></td>
                    <td><?= strtoupper($value->nombreUsuario) ?></td>
                    <td><?= ($value->nivel === "1") ? "Equipo Nacional" : ($value->nivel === "2") ? "Equipo Arqui/Diocesano" : "Usuario de Base"; ?></td>
                    <td><?= strtolower($value->mail) ?></td>
                    <td><?= ($value->estado == "1") ? "ACTIVO" : "INACTIVO"; ?></td>
                    <td id="botonesAccion">     

                        <button title="Editar Usuario" id="editarUsuario" data-idusuario="<?= $value->idusuario ?>" class="btn btn-default" onclick="nuevoUsuario('1', '<?= $value->idusuario ?>')">
                            <span class="glyphicon glyphicon-pencil" style="color: blue"></span>
                        </button>

                        <button title="Cambiar Pasword" id="cambiaPassword" data-idusuario="<?= $value->idusuario ?>" class="btn btn-default" onclick="cambiaPassword('<?= $value->idusuario ?>')">
                            <span class="glyphicon glyphicon-baby-formula" style="color: red"></span>
                        </button>

                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>
