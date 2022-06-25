<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;

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
?>
<h3>Listado de SJ05 del Equipo <?= $s05[0]->grupos ?></h3>

<div id = "div_btn_s05Joven_nuevo" align = "left" style = "padding-bottom: 10px">
    <button title = "Agregar SJ05" type = "button" id = "btn_s05Joven_nuevo" onclick="nuevoS05Joven('0', <?= (count($s05) > 0) ? $s05[0]->idgrupo : ""; ?>, '0')" data-idgrupo="<?= (count($s05) > 0) ? $s05[0]->idgrupo : ""; ?>" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar SJ05</button>
</div>

<table id = "tablero_listaS05Joven" class = "table table-striped">
    <thead>
        <tr>
            <th>Nro. Tema</th>
            <th>Tema Desarrollado</th>
            <th>Fecha de Reunión</th>
            <th>Hora planificado de Reunión</th>
            <th>Hora de inicio de reunión</th>
            <th>Casa de Reunión</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($s05) && sizeof($s05) > 0 && $s05[0]->idevaluacion != NULL) {
            foreach ($s05 as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idevaluacion ?>'>
                    <td><?= strtoupper($value->tema_nro) ?></td>
                    <td><?= strtoupper($value->tema_descripcion) ?></td>
                    <td><?= convertFecha($value->fechaReunion) ?></td>
                    <td><?= $value->horaPlanificado ?></td>
                    <td><?= $value->horaIniciado ?></td>
                    <td><?= strtoupper($value->casaReunion) ?></td>
                    <td id="botonesAccion">     

                        <button title="Editar S05" id="editars05Joven" class="btn btn-default" onclick="nuevoS05Joven('1', '<?= $value->idgrupo ?>', '<?= $value->idevaluacion ?> ')">
                            <span class="glyphicon glyphicon-pencil" style="color: blue"></span>
                        </button>

                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>
