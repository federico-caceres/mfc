<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
(count($evaluaciones) > 0 && isset($grupo[0]->nombreGrupo)) ? $grupo[0]->nombreGrupo : $grupo = array();
?>
<!--<h3>Listado de Evaluaciones del Grupo <? //= (count($grupo) > 0 && isset($grupo[0]->nombreGrupo)) ? $grupo[0]->nombreGrupo : "";  ?></h3>-->

<!--    <div id = "div_btn_evaluacion_nuevo" align = "left" style = "padding-bottom: 10px">
        <button title = "Agregar Evaluacion" type = "button" id = "btn_evaluacion_nuevo" data-idevaluacion="<? //= $evaluaciones[0]->idevaluacion  ?>" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar Evaluación</button>
    </div>-->
<!--(E = 5) EXCELENTE           (B = 4) BUENA      (R = 3) REGULAR     (D = 2) DEFICIENTE       (N = 0) NULA-->
<!--<br>
<br>-->
<br>
<!--<div class="col-sm-12 well">-->
<table id = "tablero_evaluacion" class = "table table-striped">
    <thead>
        <tr>
            <th style="width: 20%">Matrimonio</th>
            <th style="width: 7%">P. El</th>
            <th style="width: 7%">P. Ella</th>
            <th style="width: 7%">E. El</th>
            <th style="width: 7%">E. Ella</th>
            <th style="width: 7%">Pa. El</th>
            <th style="width: 7%">Pa.Ella</th>
            <th style="width: 7%">C. El</th>
            <th style="width: 7%">C. Ella</th>
            <th style="width: 7%">Suma</th>
            <th style="width: 7%">Prom.</th>
            <th style="width: 10%">Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $sumaTotal = 0;
        if (isset($evaluaciones) && sizeof($evaluaciones) > 0) {

            foreach ($evaluaciones as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idmatrimonio ?>'>
                    <td><?= strtoupper($value->pareja) ?></td>
                    <td><?= $value->puntualidad_el ?></td>
                    <td><?= $value->puntualidad_ella ?></td>
                    <td><?= $value->estudio_el ?></td>
                    <td><?= $value->estudio_ella ?></td>
                    <td><?= $value->participacion_el ?></td>
                    <td><?= $value->participacion_ella ?></td>
                    <td><?= $value->cumple_accion_sugerida_el ?></td>
                    <td><?= $value->cumple_accion_sugerida_ella ?></td>
                    <td><?= $value->suma_total ?></td>
                    <td><?= $value->promedio ?></td>
                    <td id="botonesAccion">     

                        <button title="Elimina Evaluación" id="liminarEvaluacion" data-idevaluacion="<?= $value->idevaluacion ?>" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="eliminaEvaluacion('<?= $value->idgrupo ?>', '<?= $value->idevaluacion ?>', '<?= $value->ideva_matrimonio ?>', '<?= $value->nivel ?>')">
                            <span class="glyphicon glyphicon-trash" style="color: red"></span>
                        </button>

                    </td>
                </tr>
                <?php
                $sumaTotal += $value->suma_total;
            }
        } else {
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Tot.</td>
                <td><?= $sumaTotal ?></td>
                <td><?= $sumaTotal / 8 ?></td> 
                <td></td> 
            </tr>
        <? } ?>
    </tbody>

</table>
<!--</div>-->
<script type="text/javascript">
    _reiniciarTablero("tablero_evaluacion");
</script>