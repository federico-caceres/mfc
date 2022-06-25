<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table id="tablero_reporteCuadranteJuvenil" class="table table-striped responsive">
    <thead>
        <tr>
            <th style="width: 20%;">Jóven</th>
            <th style="width: 20%;">Diócesis</th>
            <th style="width: 20%;">Base</th>
            <th style="width: 10%;">Equipo</th>
            <th style="width: 10%;">Nro. Membresía</th>
            <th style="width: 10%;">Fecha de Nacimiento</th>
        </tr>
    </thead>

    <tbody> <?php
        if (isset($ReporteCuadranteJuvenil) && sizeof($ReporteCuadranteJuvenil) > 0) {
            foreach ($ReporteCuadranteJuvenil as $key => $value) {
                ?>
                <tr class="odd gradeX">
                    <td><?= $value->joven ?></td>
                    <td><?= $value->diocesis ?></td>
                    <td><?= $value->base ?></td>
                    <td><?= $value->grupo ?></td>
                    <td><?= $value->membresia_joven ?></td>
                    <td><?= $value->fecha_nac ?></td>
                </tr> 
                <?php
            }
        }
        ?>
    </tbody>
</table>