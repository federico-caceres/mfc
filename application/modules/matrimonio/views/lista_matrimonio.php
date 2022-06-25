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
$muestraS07 = ($cargo != "2") ? "hidden" : "";
$muestraS02 = ($cargo == "5" || $cargo == "7" || $cargo == "2") ? "" : "hidden";
$muestraS06 = ($cargo == "3" || ($nivel != "3" && $cargo == "2")) ? "" : "hidden";
$icono = ($cargo != "2") ? "glyphicon-search" : "glyphicon-pencil";
$lectura = ($cargo == "2" || $nivel != "3") ? "" : "readonly";
?>

<div id="div_btn_matrimonio_nuevo" align="left" style="padding-bottom: 10px" class="<?= $muestra ?>">
    <button title="Agregar Matrimonio S-01" type="button" id="btn_matrimonio_nuevo" class="btn btn-default"><span class="glyphicon glyphicon-new-window" style="color: green"></span> Agregar Matrimonio</button>
</div>

<table id="tablero_matrimonio" class="table table-striped">
    <thead>
        <tr>
            <th class="descarto">Nro. Cédula Esposa</th>
            <th>Nro. Cédula Esposo</th>
            <th>Nombre de la Pareja</th>
            <th>Diócesis</th>
            <th class="descarto">Base</th>
            <th class="descarto">Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($matrimonios) && sizeof($matrimonios) > 0) {
            foreach ($matrimonios as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idmatrimonio ?>'>
                    <td class="descarto"><?= $value->ella_cedula ?></td>
                    <td><?= $value->el_cedula ?></td>
                    <td><?= strtoupper($value->ella_nombre . " y " . $value->el_nombre . " " . $value->el_apellidos) ?></td>
                    <td><?= strtoupper($value->nombre) ?></td>
                    <td class="descarto"><?= strtoupper($value->bases) ?></td>
                    <td class="descarto"><?= ($value->estado == "1") ? "ACTIVO" : "INACTIVO"; ?></td>
                    <td id="botonesAccion">     

                        <button title="Editar Matrimonio" id="editarMatrimonio" data-idmatrimonio="<?= $value->idmatrimonio ?>" class="btn btn-default" onclick="nuevoMatrimonio('1', '<?= $value->idmatrimonio ?>')">
                            <span class="glyphicon <?= $icono ?>" style="color: blue"></span>
                        </button>
                        <?php if ($value->estado == "1") { ?>
                            <button title="Cargar S-02" id="cargaS02" data-idmatrimonio="<?= $value->idmatrimonio ?>" class="btn btn-default <?= $muestraS02 ?>" >
                                <span>
                                    <span class="glyphicon glyphicon-certificate" style="color: #005702"></span>
                                </span>
                            </button>

                            <button title="Cargar S-06" id="cargaS06" data-idmatrimonio="<?= $value->idmatrimonio ?>" class="btn btn-default <?= $muestraS06 ?>" >
                                <span>
                                    <span class="glyphicon glyphicon-credit-card" style="color: #005702"></span>
                                </span>
                            </button>
                        <?php } ?>        
                        <button title="Cargar S-07" id="bajaMatrimonio" data-idmatrimonio="<?= $value->idmatrimonio ?>" class="btn btn-default <?= $muestraS07 ?>" >
                            <span>
                                <span class="glyphicon glyphicon-remove-sign" style="color: #6c04d4"></span>
                            </span>
                        </button>


                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>

