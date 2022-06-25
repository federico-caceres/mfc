<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<br>
<!--<div class="col-sm-12 well">-->
<table id="tablero_cursos" class = "table table-striped">
    <thead>
        <tr>
            <th style="width: 30%">Curso</th>
            <th style="width: 20%">Fecha</th>
            <th style="width: 20%">Lugar</th>
            <th style="width: 20%">Disertante</th>
            <th style="width: 10%">Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($cursos) && sizeof($cursos) > 0) {

            foreach ($cursos as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idcurso ?>'>
                    <td><?= strtoupper($value->curso) ?></td>
                    <td><?= $value->fecha ?></td>
                    <td><?= $value->lugar ?></td>
                    <td><?= $value->disertante ?></td>
                    <td id="botonesAccion">     

                        <button title="Elimina Curso" id="eliminarCurso" data-idcurso="<?= $value->idcurso ?>" data-idmatrimonio="<?= $value->idmatrimonio ?>" class="btn btn-default" onclick="eliminaCurso('<?= $value->idmatrimonio ?>', '<?= $value->idcurso ?>')">
                            <span class="glyphicon glyphicon-trash" style="color: red"></span>
                        </button>

                    </td>
                </tr>
        <?php
    }
} else {
    ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
<?php } ?>
    </tbody>

</table>
<!--</div>-->
<script type="text/javascript">
    _reiniciarTablero("tablero_cursos");
</script>