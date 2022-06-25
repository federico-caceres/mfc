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
<!--<h3>Listado de Evaluaciones del Grupo <?= (count($grupo) > 0 && isset($grupo[0]->nombreGrupo)) ? $grupo[0]->nombreGrupo : ""; ?></h3>-->

<!--    <div id = "div_btn_evaluacion_nuevo" align = "left" style = "padding-bottom: 10px">
        <button title = "Agregar Evaluacion" type = "button" id = "btn_evaluacion_nuevo" data-idevaluacion="<?= $evaluaciones[0]->idevaluacion ?>" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar Evaluación</button>
    </div>-->
<!--(E = 5) EXCELENTE           (B = 4) BUENA      (R = 3) REGULAR     (D = 2) DEFICIENTE       (N = 0) NULA-->
<br>
<br>
<br>
 
    <table id = "tablero_evaluacionJoven" class = "table table-striped">
        <thead>
            <tr>
                <th style="width: 30%">Jóven</th>
                <th></th>
                <th style="width: 10%">Punt.</th>
                <th></th>
                <th style="width: 10%">Estudio</th>
                <th></th>
                <th style="width: 10%">Part.</th>
                <th></th>
                <th style="width: 10%">Cumple</th>
                <th style="width: 10%">Suma</th>
                <th style="width: 10%">Promedio</th>
                <th style="width: 10%">Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $sumaTotal = 0;
            if (isset($evaluaciones) && sizeof($evaluaciones) > 0) {

                foreach ($evaluaciones as $key => $value) {
                    ?>
                    <tr id='fila_<?= $value->idjoven ?>'>
                        <td><?= strtoupper($value->joven) ?></td>
                        <td></td>
                        <td><?= $value->puntualidad ?></td>
                        <td></td>
                        <td><?= $value->estudio ?></td>
                        <td></td>
                        <td><?= $value->participacion ?></td>
                        <td></td>
                        <td><?= $value->cumple_accion_sugerida ?></td>
                        <td><?= $value->suma_total ?></td>
                        <td><?= $value->promedio ?></td>
                        <td id="botonesAccion">     

                            <button title="Elimina Evaluación" id="liminarEvaluacionJoven" data-idevaluacion="<?= $value->idevaluacion ?>" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="eliminaEvaluacionJoven('<?= $value->idgrupo ?>', '<?= $value->idevaluacion ?>', '<?= $value->ideva_joven ?>', '<?= $value->nivel ?>')">
                                <span class="glyphicon glyphicon-trash" style="color: red"></span>
                            </button>

                        </td>
                    </tr>
                    <?php
                    $sumaTotal += $value->suma_total;
                }
            }
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
                <td>Totales</td>
                <td><?= $sumaTotal ?></td>
                <td><?= $sumaTotal / 8 ?></td> 
                <td></td> 
            </tr>
        </tbody>

    </table>
 
<script type="text/javascript">
    _reiniciarTablero("tablero_evaluacionJoven");
</script>