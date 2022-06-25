<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$edit = count($miembros) > 0;
($edit && isset($miembros[0]->grupos)) ? $miembros[0]->grupos : $miembros = array();

?>
<h3>Listado de Miembros del Equipo <?= (count($miembros) > 0 && isset($miembros[0]->grupos)) ? $miembros[0]->grupos : ""; ?></h3>

    <div id = "div_btn_miembroJoven_nuevo" align = "left" style = "padding-bottom: 10px">
        <button title = "Agregar Miembro" type = "button" id = "btn_miembroJoven_nuevo" data-idgrupo="<?= (isset($miembros[0]->idgrupo))?$miembros[0]->idgrupo:""; ?>" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar Miembro</button>
    </div>

<table id = "tablero_miembroJoven" class = "table table-striped">
    <thead>
        <tr>
            <th>Nro. Membresía</th>
            <th>Nombre del Equipo</th>
            <th>Nombre del Jóven</th>
            <th>Base</th>
            <th>Diócesis</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($miembros) && sizeof($miembros) > 0 && $miembros[0]->joven!=NULL) {
            foreach ($miembros as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idjoven ?>'>
                    <td><?= strtoupper($value->membresia) ?></td>
                    <td><?= strtoupper($value->grupos) ?></td>
                    <td><?= strtoupper($value->joven) ?></td>
                    <td><?= strtoupper($value->bases) ?></td>
                    <td><?= strtoupper($value->diocesis) ?></td>
                    <td><?= ($value->estado == "1") ? "ACTIVO" : "INACTIVO"; ?></td>
                    <td id="botonesAccion">     

                <!--                        <button title="Editar Miembro" id="editarMiembro" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="nuevoMiembro('1', '<?= $value->idgrupo ?>')">
                                            <span class="glyphicon glyphicon-pencil" style="color: blue"></span>
                                        </button>-->
                        <button title="Eliminar Miembro" id="eliminarMiembroJoven" data-idjoven="<?= $value->idjoven ?>" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="eliminaMiembroJoven('<?= $value->idgrupo ?>', '<?= $value->idjoven ?>')">
                            <span class="glyphicon glyphicon-trash" style="color: red"></span>
                        </button>

                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>
