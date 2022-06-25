<?php
$request = ['assets' => array(['src' => 'assets/js/gestion/matrimonio.js', 'type' => 'script']), 'base' => base_url()];
echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));

function convertFecha($fecha) {
# The 0th day of a month is the same as the last day of the month before
    if ($fecha == null || $fecha == "0000-00-00") {
        $return = "";
    } else {
        $fechaFormat = date_create($fecha);
        $return = date_format($fechaFormat, "d/m/Y");
    }

    return $return;
}
?>
<div id="contieneFormS02" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formS02" name="formS02">
        <input type="hidden" id="accion" name="accion" value="">
        <input type="hidden" id="idmatrimonio" name="idmatrimonio" value="<?= $s02[0]->idmatrimonio ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL S02</h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Nombre del Esposo</strong></div>
            <div class="col-sm-4"><input class="form-control" name="nombre_el" type="text" id="nombre_el" value="<?= ucwords($s02[0]->el_nombre . " " . $s02[0]->el_apellidos) ?>" readonly=""></div>
            <div class="col-sm-3"><strong>Celular</strong></div>
            <div class="col-sm-3"><input class="form-control" name="telefono_el" type="text" id="telefono_el" value="<?= $s02[0]->el_cel ?>" readonly=""></div>

        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Correo</strong></div>
            <div class="col-sm-3">
                <input class="form-control" name="correo_el" type="email" id="correo_el" value="<?= $s02[0]->el_correo ?>" readonly="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"><strong>Nombre de la Esposa</strong></div>
            <div class="col-sm-4"><input class="form-control" name="nombre_ella" type="text" id="nombre_el" value="<?= ucwords($s02[0]->ella_nombre . " " . $s02[0]->ella_apellidos) ?>" readonly=""></div>
            <div class="col-sm-3"><strong>Celular</strong></div>
            <div class="col-sm-3"><input class="form-control" name="telefono_ella" type="text" id="telefono_ella" value="<?= $s02[0]->ella_cel ?>" readonly=""></div>

        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Correo</strong></div>
            <div class="col-sm-3">
                <input class="form-control" name="correo_ella" type="email" id="correo_ella" value="<?= $s02[0]->ella_correo ?>" readonly="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1"><strong>Calle</strong></div>
            <div class="col-sm-2"><input class="form-control" name="calle" type="text" id="calle" value="<?= ucwords($s02[0]->direccion) ?>" readonly=""></div>
            <div class="col-sm-1"><strong>Ciudad</strong></div>
            <div class="col-sm-2"><input class="form-control" name="ciudad" type="text" id="ciudad" value="<?= ucwords($s02[0]->ciudad) ?>" readonly=""></div>
            <div class="col-sm-1"><strong>Barrio</strong></div>
            <div class="col-sm-2"><input class="form-control" NAME="barrio" type="text" id="barrio" value="<?= ucwords($s02[0]->barrio) ?>" readonly=""></div>
            <div class="col-sm-1"><strong>Telefono</strong></div>
            <div class="col-sm-2"><input class="form-control" name="telefono" type="number" id="telefono" value="<?= $s02[0]->telefono ?>" readonly=""></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1"><strong>Diocesis</strong></div>
            <div class="col-sm-3">
                <input class="form-control" name='diocesis' id="diocesis" value="<?= $s02[0]->diocesis ?>" readonly="">
            </div>
            <div class="col-sm-1"><strong>Base</strong></div>
            <div class="col-sm-3" id="divSelectBase">
                <input class="form-control" name='base' id="base" value="<?= $s02[0]->bases ?>" readonly="">
            </div>

            <div class="col-sm-1"><strong>Equipo</strong></div>
            <div class="col-sm-3" id="divSelectGrupo">
                <input class="form-control" name='grupo' id="grupo" value="<?= $s02[0]->grupos ?>" readonly="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Fecha de Ingreso</strong></div>
            <div class="col-sm-3"><input name="fecha_ingreso" type="text" class="datepicker form-control" id="fecha_ingreso" value="<?= convertFecha($s02[0]->fecha_ingreso) ?>" readonly=""></div>
            <div class="col-sm-3"><strong>Nro. Membresia</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="nro_membresia" type="text" id="nro_membresia" value="<?= $s02[0]->el_cedula . '/' . $s02[0]->nomenclatura ?>" readonly></div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-3"><strong>Fecha de Membresía Plena</strong></div>
            <div class="col-sm-3"><input name="fecha_membresia" type="text" class="datepicker form-control" id="fecha_membresia" value="<?= convertFecha($s02[0]->fecha_membresia) ?>" readonly=""></div>
            <div class="col-sm-3"><strong>Fecha de Encuentro Conyugal</strong></div>
            <div class="col-sm-3"><input name="fecha_encuentro" type="text" class="datepicker form-control" id="fecha_encuentro" value="<?= convertFecha($s02[0]->fecha_encuentro) ?>" readonly=""></div>
        </div>
    </form>
    <div class="col-sm-12">
        <button id="guardarS02" data-idmatrimonio="<?= $s02[0]->idmatrimonio ?>" class="btn btn-primary">Agregar cursos</button>
        <button id="cancelarMatrimonio" class="btn btn-danger">Cancelar</button>
    </div>
</div>
<div id="contieneCursos">
    <?= Modules::run("matrimonio/matrimonio/listaCursos", 1, $s02[0]->idmatrimonio) ?>
</div>
