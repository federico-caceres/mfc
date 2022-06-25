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
<div id="contieneFormSJ02" class="col-sm-12 well" style="background-color:  #D8D8D8">

    <form id="formSJ02" name="formSJ02">
        <input type="hidden" id="accion" name="accion" value="">
        <input type="hidden" id="idjoven" name="idjoven" value="<?= $sj02[0]->idjoven ?>">

        <div class="form-group row">
            <div class="col-sm-12"><h3>DATOS DEL SJ02</h3></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2"><strong>Nombre del Jóven</strong></div>
            <div class="col-sm-4"><input class="form-control" name="nombre" type="text" id="nombre" value="<?= ucwords($sj02[0]->nombre . " " . $sj02[0]->apellidoP." ". $sj02[0]->apellidoM) ?>" readonly=""></div>
            <div class="col-sm-3"><strong>Celular</strong></div>
            <div class="col-sm-3"><input class="form-control" name="telefono_el" type="text" id="telefono_el" value="<?= $sj02[0]->cel ?>" readonly=""></div>

        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Correo</strong></div>
            <div class="col-sm-3">
                <input class="form-control" name="correo_el" type="email" id="correo_el" value="<?= $sj02[0]->correo ?>" readonly="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1"><strong>Calle</strong></div>
            <div class="col-sm-2"><input class="form-control" name="calle" type="text" id="calle" value="<?= ucwords($sj02[0]->direccion) ?>" readonly=""></div>
            <div class="col-sm-1"><strong>Ciudad</strong></div>
            <div class="col-sm-2"><input class="form-control" name="ciudad" type="text" id="ciudad" value="<?= ucwords($sj02[0]->ciudad) ?>" readonly=""></div>
            <div class="col-sm-1"><strong>Barrio</strong></div>
            <div class="col-sm-2"><input class="form-control" NAME="barrio" type="text" id="barrio" value="<?= ucwords($sj02[0]->barrio) ?>" readonly=""></div>
            <div class="col-sm-1"><strong>Telefono</strong></div>
            <div class="col-sm-2"><input class="form-control" name="telefono" type="number" id="telefono" value="<?= $sj02[0]->telefono ?>" readonly=""></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1"><strong>Diocesis</strong></div>
            <div class="col-sm-3">
                <input class="form-control" name='diocesis' id="diocesis" value="<?= $sj02[0]->diocesis ?>" readonly="">
            </div>
            <div class="col-sm-1"><strong>Base</strong></div>
            <div class="col-sm-3" id="divSelectBase">
                <input class="form-control" name='base' id="base" value="<?= $sj02[0]->bases ?>" readonly="">
            </div>

            <div class="col-sm-1"><strong>Equipo</strong></div>
            <div class="col-sm-3" id="divSelectGrupo">
                <input class="form-control" name='grupo' id="grupo" value="<?= $sj02[0]->grupos ?>" readonly="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><strong>Fecha de Ingreso</strong></div>
            <div class="col-sm-3"><input name="fecha_ingreso" type="text" class="datepicker form-control" id="fecha_ingreso" value="<?= convertFecha($sj02[0]->fecha_ingreso) ?>" readonly=""></div>
            <div class="col-sm-3"><strong>Nro. Membresia</strong></div>
            <div class="col-sm-3"><input class="form-control" NAME="nro_membresia" type="text" id="nro_membresia" value="<?= $sj02[0]->cedula . '/' . $sj02[0]->nomenclatura ?>" readonly></div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-3"><strong>Fecha de Membresía Plena</strong></div>
            <div class="col-sm-3"><input name="fecha_membresia" type="text" class="datepicker form-control" id="fecha_membresia" value="<?= convertFecha($sj02[0]->fecha_membresia) ?>" readonly=""></div>
            <div class="col-sm-3"><strong>Fecha de Retiro</strong></div>
            <div class="col-sm-3"><input name="fecha_encuentro" type="text" class="datepicker form-control" id="fecha_encuentro" value="<?= convertFecha($sj02[0]->fecha_encuentro) ?>" readonly=""></div>
        </div>
    </form>
    <div class="col-sm-12">
        <button id="guardarSJ02" data-idjoven="<?= $sj02[0]->idjoven ?>" class="btn btn-primary">Agregar cursos</button>
        <button id="cancelarJoven" class="btn btn-danger">Cancelar</button>
    </div>
</div>
<div id="contieneCursos">
    <?= Modules::run("jovenes/joven/listaCursos", 1, $sj02[0]->idjoven) ?>
</div>
