<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<br>
<!--<div class="col-sm-12 well">-->
<table id="tablero_aportes" class = "table table-striped">
    <thead>
        <tr>
            <th style="width: 30%">Concepto</th>
            <th style="width: 20%">Año</th>
            <th style="width: 20%">Fecha de Pago</th>
            <th style="width: 20%">Nro. Recibo</th>
            <th style="width: 10%">Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($aportes) && sizeof($aportes) > 0) {

            foreach ($aportes as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idaporte ?>'>
                    <td><?= strtoupper($value->concepto_pago) ?></td>
                    <td><?= $value->ano ?></td>
                    <td><?= $value->fecha_pago ?></td>
                    <td><?= $value->nro_recibo ?></td>
                    <td id="botonesAccion">     

                        <button title="Elimina Aporte" id="eliminarAporte" data-idaporte="<?= $value->idaporte ?>" data-idmatrimonio="<?= $value->idmatrimonio ?>" class="btn btn-default" onclick="eliminaAporte('<?= $value->idmatrimonio ?>', '<?= $value->idaporte ?>')">
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
    _reiniciarTablero("tablero_aportes");
</script>
?>