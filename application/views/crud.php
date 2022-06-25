<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Crud con codeigniter</title>
        <meta charset="utf-8" />
        <link href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.css'; ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/jquery/css/jquery-ui-1.10.0.custom.css'; ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/pnotify/pnotify.custom.min.css'; ?>" type="text/css" rel="stylesheet" />
<!--        <link href="<?php echo base_url() . 'assets/css/main.css'; ?>" type="text/css" rel="stylesheet" />-->
<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/datepicker/js/jquery.datetimepicker.css' ?>" />-->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/bootstrap/toggle/css/bootstrap-toggle.min.css' ?>">
<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/bootstrap-submenu/css/bootstrap-submenu.css' ?>">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/bootstrap-timepicker/css/bootstrap-timepicker.min.css' ?>">

        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/data_tables/css/dataTables.bootstrap.css" media="screen" />

        <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery-2.1.3.min.js'; ?>"></script>

        <script type="text/javascript" src="<?= base_url() ?>assets/data_tables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/data_tables/js/dataTables.bootstrap.min.js"></script>
<!--        <script type="text/javascript" src="<?php echo base_url() ?>js/funciones.js"></script>-->
    </head>
    <body>

        <div class="container_12">
            <h1>Crud con codeigniter</h1>
            <div class="grid_12">

                <div class="col-sm-12" align="right" style="padding-bottom: 10px">
                    <button title="Agregar Correo" type="button" onclick="nuevo_correo()" id="btn_correo_nuevo" class="btn btn-default"><span class="glyphicon glyphicon-file" style="color: green"></span></button>
                </div>

                <table id="lista_matrimonio" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nro. Cédula Marido</th>
                            <th>Nombre y Apellido</th>
                            <th>Nro. Cédula Esposa</th>
                            <th>Acción</th>
                        </tr>
                    </thead> 
                    <tbody>

                        <?php
                        foreach ($users as $fila):
                            ?>
                            <tr id="fila_<?= $fila->idmatrimonio ?>">
                                <td class="grid_2" id="membresia<?= $fila->idmatrimonio ?>"><?= $fila->el_cedula ?></td>
                                <td class="grid_3" id="nombre<?= $fila->idmatrimonio ?>"><?= strtoupper($fila->ella_nombre . " y " . $fila->el_nombre . " " . $fila->el_apellidos) ?></td>
                                <td class="grid_2" id="fecha_ingreso<?= $fila->idmatrimonio ?>"><?= $fila->ella_cedula ?></div>
                                <td class="grid_2" id="eliminar"><input type="button" value="Eliminar" id="<?= $fila->idmatrimonio ?>" class="eliminar"></td>
                                <td class="grid_2" id="editar"><input type="button" value="Editar" id="<?= $fila->idmatrimonio ?>" class="editar"></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>  
                    </tbody>        
                </table>
            </div>
        </div>

    </body>
</html>