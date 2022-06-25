<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
(count($miembros) > 0 && isset($miembros[0]->grupos)) ? $miembros[0]->grupos : $miembros = array();
?>
<h3>Listado de Miembros del Equipo <?= (count($miembros) > 0 && isset($miembros[0]->grupos)) ? $miembros[0]->grupos : ""; ?></h3>

    <div id = "div_btn_miembro_nuevo" align = "left" style = "padding-bottom: 10px">
        <button title = "Agregar Miembro" type = "button" id = "btn_miembro_nuevo" data-idgrupo="<?= $miembros[0]->idgrupo ?>" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar Miembro</button>
    </div>

<table id = "tablero_miembro" class = "table table-striped">
    <thead>
        <tr>
            <th>Nro. Membresía</th>
            <th>Nombre del Equipo</th>
            <th>Nombre Pareja</th>
            <th>Base</th>
            <th>Diócesis</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($miembros) && sizeof($miembros) > 0 && $miembros[0]->pareja!=NULL) {
            foreach ($miembros as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idmatrimonio ?>'>
                    <td><?= strtoupper($value->membresia) ?></td>
                    <td><?= strtoupper($value->grupos) ?></td>
                    <td><?= strtoupper($value->pareja) ?></td>
                    <td><?= strtoupper($value->bases) ?></td>
                    <td><?= strtoupper($value->diocesis) ?></td>
                    <td><?= ($value->estado == "1") ? "ACTIVO" : "INACTIVO"; ?></td>
                    <td id="botonesAccion">     

                <!--                        <button title="Editar Miembro" id="editarMiembro" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="nuevoMiembro('1', '<?= $value->idgrupo ?>')">
                                            <span class="glyphicon glyphicon-pencil" style="color: blue"></span>
                                        </button>-->
                        <button title="Eliminar Miembro" id="eliminarMiembro" data-idmatrimonio="<?= $value->idmatrimonio ?>" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="eliminaMiembro('<?= $value->idgrupo ?>', '<?= $value->idmatrimonio ?>')">
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
