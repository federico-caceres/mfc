<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table id="tablero_reporteSJ09" class="table table-striped responsive">
    <thead>
        <tr>
            <th style="width: 20%;">Jóven</th>
            <th style="width: 20%;">Diócesis</th>
            <th style="width: 20%;">Base</th>
            <th style="width: 10%;">Equipo</th>
            <th style="width: 10%;">Nro. Tema</th>
            <th style="width: 10%;">Fecha de Reunión</th>
        </tr>
    </thead>

    <tbody> <?php
        if (isset($ReporteS09) && sizeof($ReporteS09) > 0) {
            foreach ($ReporteS09 as $key => $value) {
                ?>
                <tr class="odd gradeX">
                    <td><?= $value->joven ?></td>
                    <td><?= $value->diocesis ?></td>
                    <td><?= $value->base ?></td>
                    <td><?= $value->grupo ?></td>
                    <td><?= $value->tema_nro ?></td>
                    <td><?= $value->fechaReunion ?></td>
                </tr> 
                <?php
            }
        }
        ?>
    </tbody>
</table>