<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table id="tablero_reporteCuadranteMiembros" class="table table-striped responsive">
    <thead>
        <tr>
            <th style="width: 20%;">Matrimonio</th>
            <th style="width: 20%;">Diócesis</th>
            <th style="width: 20%;">Base</th>
            <th style="width: 10%;">Equipo</th>
            <th style="width: 10%;">Nro. Membresía</th>
            <th style="width: 10%;">Fecha de Aniversario</th>
        </tr>
    </thead>

    <tbody> <?php
        if (isset($ReporteCuadranteMiembros) && sizeof($ReporteCuadranteMiembros) > 0) {
            foreach ($ReporteCuadranteMiembros as $key => $value) {
                ?>
                <tr class="odd gradeX">
                    <td><?= $value->matrimonio ?></td>
                    <td><?= $value->diocesis ?></td>
                    <td><?= $value->base ?></td>
                    <td><?= $value->grupo ?></td>
                    <td><?= $value->membresia_pareja ?></td>
                    <td><?= $value->aniversario ?></td>
                </tr> 
                <?php
            }
        }
        ?>
    </tbody>
</table>