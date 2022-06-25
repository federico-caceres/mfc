<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
?>
<h3>Listado de Equipos</h3>

    <div id = "div_btn_grupoJoven_nuevo" align = "left" style = "padding-bottom: 10px">
        <button title = "Agregar Equipo" type = "button" id = "btn_grupoJoven_nuevo" class = "btn btn-default"><span class = "glyphicon glyphicon-new-window" style = "color: green"></span> Agregar Equipo</button>
    </div>

<table id="tablero_grupoJoven" class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre del Equipo</th>
            <th>Jóven Promotor</th>
            <th>Base</th>
            <th>Diócesis</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($grupos) && sizeof($grupos) > 0) {
            foreach ($grupos as $key => $value) {
                ?>
                <tr id='fila_<?= $value->idgrupo ?>'>
                    <td><?= strtoupper($value->idgrupo) ?></td>
                    <td><?= strtoupper($value->grupos) ?></td>
                    <td><?= strtoupper($value->joven) ?></td>
                    <td><?= strtoupper($value->bases) ?></td>
                    <td><?=  strtoupper($value->diocesis)?></td>
                    <td><?= ($value->estado == "1") ? "ACTIVO" : "INACTIVO"; ?></td>
                    <td id="botonesAccion">     

                        <button title="Editar Equipo" id="editargrupoJoven" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="nuevoGrupoJoven('1', '<?= $value->idgrupo ?>')">
                            <span class="glyphicon glyphicon-pencil" style="color: blue"></span>
                        </button>

                        <button title="Cargar S-05" id="cargaS05Joven" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="listaS05Joven('<?= $value->idgrupo ?>')">
                            <span class="glyphicon glyphicon-link" style="color: red"></span>
                        </button>
                        
                        <button title="Asignar Miembros" id="asignaMiembroJoven" data-idgrupo="<?= $value->idgrupo ?>" class="btn btn-default" onclick="listaMiembrosJoven('<?= $value->idgrupo ?>')">
                            <span class="glyphicon glyphicon-user" style="color: #005702"></span>
                        </button>

                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>
