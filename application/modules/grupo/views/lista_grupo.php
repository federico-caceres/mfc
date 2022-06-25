<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestra = ($cargo== "2") ? "" : "hidden";
$muestraS05 = ($cargo == "2" || $cargo == "8") ? "" : "hidden";
$icono = ($cargo != "2") ? "glyphicon-search" : "glyphicon-pencil";
$lectura = ($cargo == "2") ? "" : "readonly";
?>

<div id = "div_btn_grupo_nuevo" align = "left" style = "padding-bottom: 10px" class="<?= $muestra ?>">
    <button title = "Agregar Equipo" type = "button" id = "btn_grupo_nuevo" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar Equipo</button>
</div>

<table id = "tablero_grupo" class = "table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre del Equipo</th>
            <th>Matrimonio Promotor</th>
            <th>Base</th>
            <th>Diócesis</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($grupos) && sizeof($grupos) > 0) {
            foreach ($grupos as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idgrupo ?>'>
                    <td><?= strtoupper($value->idgrupo) ?></td>
                    <td><?= strtoupper($value->grupos) ?></td>
                    <td><?= strtoupper($value->enlace) ?></td>
                    <td><?= strtoupper($value->bases) ?></td>
                    <td><?= strtoupper($value->diocesis) ?></td>
                    <td><?= ($value->estado == "1") ? "ACTIVO" : "INACTIVO"; ?></td>
                    <td id="botonesAccion">     

                        <button title="Editar Equipo" id="editargrupo" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" <?= $muestra ?> onclick="nuevoGrupo('1', '<?= $value->idgrupo ?>')">
                            <span class="glyphicon <?= $icono ?>" style="color: blue"></span>
                        </button>
                        <? if ($value->estado == "1") { ?>
                            <button title="Cargar S-05" id="cargaS05" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default <?= $muestraS05 ?>" onclick="listaS05('<?= $value->idgrupo ?>')">
                                <span class="glyphicon glyphicon-link" style="color: red"></span>
                            </button>

                            <button title="Asignar Miembros" id="asignaMiembro" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default <?= $muestra ?>" onclick="listaMiembros('<?= $value->idgrupo ?>')">
                                <span class="glyphicon glyphicon-user" style="color: #005702"></span>
                            </button>
                        <? } ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>
