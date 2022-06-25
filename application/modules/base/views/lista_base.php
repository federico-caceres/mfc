<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestra = ($cargo != "2") ? "hidden" : "";
$icono = ($cargo != "2") ? "glyphicon-search" : "glyphicon-pencil";
$lectura = ($cargo == "2") ? "" : "readonly";
?>

<div id = "div_btn_base_nuevo" align = "left" style = "padding-bottom: 10px" class="<?= $muestra ?>">
    <button title = "Agregar Base" type = "button" id = "btn_base_nuevo" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar Base</button>
</div>

<table id = "tablero_base" class = "table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre de la Base</th>
            <th>Matrimonio Coordinador</th>
            <th>Diócesis</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($bases) && sizeof($bases) > 0) {
            foreach ($bases as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idbase ?>'>
                    <td><?= strtoupper($value->idbase) ?></td>
                    <td><?= strtoupper($value->bases) ?></td>
                    <td><?= strtoupper($value->coordinador) ?></td>
                    <td><?= strtoupper($value->diocesis) ?></td>
                    <td><?= ($value->estado == "1") ? "ACTIVO" : "INACTIVO"; ?></td>
                    <td id="botonesAccion">     

                        <button title="Editar Base" id="editarbase" data-idbase="<?= $value->idbase ?>" class="btn btn-default" onclick="nuevaBase('1', '<?= $value->idbase ?>')">
                            <span class="glyphicon <?= $icono ?>" style="color: blue"></span>
                        </button>

                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>
