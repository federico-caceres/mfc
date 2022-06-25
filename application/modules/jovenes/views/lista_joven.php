<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$edit = count($jovenes);
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestraSJ02 = ($cargo == "5" || $cargo == "6" || $nivel <= "2") ? "" : "hidden";
$muestraSJ06 = ($cargo == "3" || $cargo == "6" || $nivel <= "2") ? "" : "hidden";
$muestraGrupo = ($cargo != "2" && $cargo != "6") ? "hidden" : "";
$icono = ($cargo != "2" && $cargo != "6") ? "glyphicon-search" : "glyphicon-pencil";
?>
<h3>Listado de Jovenes</h3>
<div id="div_btn_joven_nuevo" align="left" style="padding-bottom: 10px" class="<?= $muestraGrupo ?>">
    <button title="Agregar Jóven S-01" type="button" id="btn_joven_nuevo" class="btn btn-default"><span class="glyphicon glyphicon-new-window" style="color: green"></span> Agregar Jóven</button>
</div>

<table id="tablero_joven" class="table table-striped">
    <thead>
        <tr>
            <th>Nro. Cédula</th>
            <th>Nombre del Joven</th>
            <th>Diócesis</th>
            <th class="descarto">Base</th>
            <th class="descarto">Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($jovenes) && sizeof($jovenes) > 0 && $edit > 0) {
            foreach ($jovenes as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idjoven ?>'>
                    <td><?= $value->cedula ?></td>
                    <td><?= strtoupper($value->nombreJoven . " " . $value->apellidoP . " " . $value->apellidoM) ?></td>
                    <td><?= strtoupper($value->nombre) ?></td>
                    <td class="descarto"><?= strtoupper($value->bases) ?></td>
                    <td class="descarto"><?= ($value->estado == "1") ? "ACTIVO" : "INACTIVO"; ?></td>
                    <td id="botonesAccion">     

                        <button title="Editar Jóven" id="editarJoven" data-idjoven="<?= $value->idjoven ?>" class="btn btn-default" onclick="nuevoJoven('1', '<?= $value->idjoven ?>')">
                            <span class="glyphicon <?= $icono ?>" style="color: blue"></span>
                        </button>

                        <button title="Cargar SJ-02" id="cargaSJ02" data-idjoven="<?= $value->idjoven ?>" class="btn btn-default <?= $muestraSJ02 ?>" >
                            <span>
                                <span class="glyphicon glyphicon-certificate" style="color: #005702"></span>
                            </span>
                        </button>
                        <button title="Cargar SJ-06" id="cargaSJ06" data-idjoven="<?= $value->idjoven ?>" class="btn btn-default <?= $muestraSJ06 ?>" >
                            <span>
                                <span class="glyphicon glyphicon-credit-card" style="color: #005702"></span>
                            </span>
                        </button>
                        <button title="Cargar S-07" id="bajaJoven" data-idjoven="<?= $value->idjoven ?>" class="btn btn-default" >
                            <span>
                                <span class="glyphicon glyphicon-trash" style="color: #6c04d4"></span>
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

