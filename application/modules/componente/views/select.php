<?php
if (isset($data_select)) {

    switch ($view_flag) {
        case 1:
            /*
             * @description:contruye un componente select segun los datos de $data_select
             */
            ?>  

            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="form-control" data-requerido="true" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" <?= $desactivar; ?> <?= (isset($required) && $required) ? 'required min="1"' : '' ?>>
                <option value="-1" > <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                selected="selected" <?php } ?> > <?php echo trim($item->name); ?></option> <?php endforeach; ?>
            </select> <?php
            break;
        case 6:
            /*
             * @description:contruye un componente select segun los datos de $data_select
             */
            ?>  

            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="form-control" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" style="width: 150px;" onchange="<?= $funcion ?>" disabled>
                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo $item->id; ?>"  <?= (isset($item->marcador) ? 'data-marcador="' . $item->marcador . '"' : '') ?> <?= (isset($item->prefijoPais) ? 'data-prefijoPais="' . $item->prefijoPais . '"' : '') ?> <?= (isset($item->whatsapp) ? 'data-whatsapp="' . $item->whatsapp . '"' : '') ?> <?php if (isset($selected) && $selected == $item->id) { ?>  
                                selected <?php }
                ?>
                            > <?php echo $item->name; ?>

                    </option> <?php endforeach; ?>
            </select> <?php
            break;
        case 67:
            /*
             * @description:contruye un componente select segun los datos de $data_select
             */
            ?>  

            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="form-control" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" style="width: 175px;" onchange="<?= $funcion ?>" disabled>
                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                selected <?php }
                ?>
                            > <?php echo $item->name; ?>

                    </option> <?php endforeach; ?>
            </select> <?php
            break;
        case 66:
            ?>
            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="form-control <?= (isset($clase) ? $clase : '') ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" style="width: 150px;" onchange="<?= $funcion ?>">
                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo $item->id; ?>" <?= (isset($item->prefijo) ? 'data-prefijo="' . $item->prefijo . '"' : '') ?> <?php if (isset($selected) && $selected == $item->id) { ?>  
                                selected <?php }
                ?>
                            > <?php echo $item->name; ?>
                    </option> <?php endforeach; ?>
            </select> <?php
            break;
        case 661:
            ?>
            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="form-control <?= (isset($clase) ? $clase : '') ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" onchange="<?= $funcion ?>">
                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo $item->id; ?>" <?= (isset($item->prefijo) ? 'data-prefijo="' . $item->prefijo . '"' : '') ?> <?= (isset($item->marcador) ? 'data-marcador="' . $item->marcador . '"' : '') ?> <?= (isset($item->prefijoPais) ? 'data-prefijoPais="' . $item->prefijoPais . '"' : '') ?> <?= (isset($item->whatsapp) ? 'data-whatsapp="' . $item->whatsapp . '"' : '') ?> <?php if (isset($selected) && $selected == $item->id) { ?>  
                                selected <?php }
                ?>
                            > <?php echo $item->name; ?>
                    </option> <?php endforeach; ?>
            </select> <?php
            break;
        case 33:
            $selectedValues = is_array($selected) ? $selected : array($selected);
            ?>
            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" multiple class="form-control <?= (isset($clase) ? $idSelect . $clase : '') ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" onchange="<?= $funcion ?>" style="width: 200px;">
                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo trim($item->id); ?>" <?php if (in_array(trim($item->id), $selectedValues)) { ?>  
                                selected <?php }
                ?>
                            > <?php echo trim($item->name); ?>
                    </option> <?php endforeach; ?>
            </select>

            <?= (isset($clase) ? '<script>$(".' . $idSelect . $clase . '").chosen({width: "100%",no_results_text: "No hay resultado..",placeholder_text_multiple:"Realice su selección"});</script>' : '') ?>
            <?php
            break;

        case 30:
            ?>
<select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="form-control <?= (isset($clase) ? $clase : '') ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" onchange="<?= $funcion ?>" <?= isset($desactivar) ? $desactivar : ''; ?> required="">
                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                                                                                         selected <?php }
                ?>
                                                                                                     > <?php echo $item->name; ?>
                    </option> <?php endforeach; ?>
            </select>

            <?= (isset($clase) ? '<script>$(".' . $clase . '").chosen({no_results_text: "No hay resultado para ",placeholder_text_single: "Seleccione una opción",placeholder_text_multiple:"Realice su selección"});</script>' : '') ?>
            <?php
            break;
        case 3001:
            $selectedValues = is_array($selected) ? $selected : array($selected);
            ?>
            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" multiple class="form-control <?= (isset($clase) ? $clase : '') ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" onchange="<?= $funcion ?>">
                <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo $item->id; ?>" <?php if (in_array($item->id, $selectedValues)) { ?>  
                                selected <?php }
                    ?>
                            > <?php echo $item->id; ?>
                    </option> <?php endforeach; ?>
            </select>

            <?= (isset($clase) ? '<script>$(".' . $clase . '").chosen({no_results_text: "No hay resultado..",placeholder_text_multiple:"Realice su selección"});</script>' : '') ?>
            <?php
            break;

        case 22: // Agrega el id y name normalmente, pero como adicional agrega data- de las columnas adicionales.
            ?>
            <select  id="<?= (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="form-control" name="<?= (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>">
                <option value="-1"><?= (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?></option>
                <?php foreach ($data_select as $item) { ?>
                    <?php
                    $data_add = '';
                    foreach ($item as $key => $value) {
                        ($key != 'id' && $key != 'name') ? $data_add.= 'data-' . $key . '="' . $value . '" ' : '';
                    }
                    ?>
                    <option <?= $data_add ?> value="<?= $item->id ?>" <?= ($selected == $item->id) ? 'selected' : '' ?>><?= $item->name ?></option>
                <?php } ?>
            </select>

            <?php
            break;

        case 2002:

            $ver_editar = isset($enabled) ? $enabled : '';
            $is_required = isset($required) ? $required : '';
            ?>
            <div class="col-sm-2">
                <select class="form-control input-md" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" name="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>"
                        <?php echo $ver_editar . ' ' . $is_required; ?> title="Seleccione <?php echo $msgLabel; ?>"
                        data-url="<?php echo ($data_url) ? $data_url : '' ?>" target-change="<?php echo ($target_change) ? $target_change : '' ?>"
                        data-blank = "<?php echo (isset($data_blank)) ? $data_blank : ''; ?>" width="200" style="width: 200px; height: 28px;">

                    <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item): ?>
                        <option value="<?php echo $item->pro_view_second; ?>idInputOtro_<?= $item->IdCuponProducto . '_' . $item->IdProducto . '_' . $item->orden; ?>" <?php if (isset($selected) && $selected == $item->orden) { ?>  
                                    selected <?php }
                            ?>
                                > <?php echo $item->respuesta; ?>

                        </option> <?php endforeach; ?>

                </select>
            </div> <?
            if ($item->pro_view_second) {
                switch ($item->pro_view_second) {
                    case 5:   //textarea 
                        ?>
                        <div class="col-sm-2 text-left" id="idInputOtro_<?= $item->IdCuponProducto . '_' . $item->IdProducto . '_' . $item->orden; ?>" name="idInputOtro_<?= $item->IdCuponProducto . '_' . $item->IdProducto . '_' . $item->orden; ?>" style="display:none;">
                            <input type="text" class="form-control col-sm-7" placeholder="Especifíque su respuesta."><br>
                        </div> <?
                        break;
                    case 4:   //input 
                        ?>
                        <div class="col-sm-2 text-left" id="idInputOtro_<?= $item->IdCuponProducto . '_' . $item->IdProducto . '_' . $item->orden; ?>" name="idInputOtro_<?= $item->IdCuponProducto . '_' . $item->IdProducto . '_' . $item->orden; ?>" style="display:none;">
                            <textarea class="form-control" rows="3" placeholder="Especifíque su respuesta." style="margin-top: 0px; margin-bottom: 0px; height: 88px;"></textarea><br>
                        </div> <?
                        break;
                    default:
                        break;
                }
                ?>
                <br><br><br> <? }
            ?>
            <?
            break;
        case 1901:

            $ver_editar = isset($enabled) ? $enabled : '';
            $is_required = isset($required) ? $required : '';
            $request['assets'] = array(['src' => 'assets/js/gestion/productoSelect.js', 'type' => 'script']);
            $request['base'] = base_url();
            echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));
            ?>

            <select class="form-control input-md productoChose" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>"
                    <?php echo $ver_editar . ' ' . $is_required; ?> title="Seleccione <?php echo $msgLabel; ?>"
                    data-url="<?php echo (isset($data_url) and $data_url) ? $data_url : '' ?>" target-change="<?php echo (isset($target_change) and $target_change) ? $target_change : '' ?>"
                    data-blank = "<?php echo (isset($data_blank)) ? $data_blank : ''; ?>">

                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item): ?>  
                    <option value="<?php echo $item->IdProducto; ?>" id="selectOpt-<?= $item->IdProducto; ?>" <?php if (isset($selected) && $selected == $item->IdProducto) { ?>  
                                selected <?php }
                        ?> data-cantidadRequerida="<?php echo $item->cantidadRequerida; ?>" data-cantidadMaxima="<?php echo $item->cantidadMaxima; ?>" data-obligatorio="<?php echo $item->obligatorio; ?>"> <?php echo $item->producto; ?>

                    </option> <?php endforeach; ?>

            </select> <?php
            break;
        case 1902:

            $ver_editar = isset($enabled) ? $enabled : '';
            $is_required = isset($required) ? $required : '';
            $request['assets'] = array(['src' => 'assets/js/gestion/productoSelect.js', 'type' => 'script']);
            $request['base'] = base_url();
            echo Modules::run('componente/js', array('js' => 'load_http', 'request' => $request));
            ?>

            <select class="form-control input-md productoChose" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>"
                    <?php echo $ver_editar . ' ' . $is_required; ?> title="Seleccione <?php echo $msgLabel; ?>"
                    data-url="<?php echo (isset($data_url) and $data_url) ? $data_url : '' ?>" target-change="<?php echo (isset($target_change) and $target_change) ? $target_change : '' ?>"
                    data-blank = "<?php echo (isset($data_blank)) ? $data_blank : ''; ?>" width="200" style="width: 200px; height: 28px;">

                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item): ?>  
                    <option value="<?php echo $item->IdProducto; ?>" id="selectOpt-<?= $item->IdProducto; ?>" <?php if (isset($selected) && $selected == $item->IdProducto) { ?>  
                                selected <?php }
                        ?> data-cantidadRequerida="<?php echo $item->cantidadRequerida; ?>" data-cantidadMaxima="<?php echo $item->cantidadMaxima; ?>" data-obligatorio="<?php echo $item->obligatorio; ?>"> <?php echo $item->producto; ?>

                    </option> <?php endforeach; ?>

            </select> <?php
            break;
        case 1903:

            $ver_editar = isset($enabled) ? $enabled : '';
            $is_required = isset($required) ? $required : '';
            ?>

            <select class="form-control input-md" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>"
                    <?php echo $ver_editar . ' ' . $is_required; ?> title="Seleccione <?php echo $msgLabel; ?>"
                    data-url="<?php echo (isset($data_url) and $data_url) ? $data_url : '' ?>" target-change="<?php echo ($target_change) ? $target_change : '' ?>"
                    data-blank = "<?php echo (isset($data_blank)) ? $data_blank : ''; ?>" width="<?= $width; ?>" style="width: <?= $width; ?>px;">

                <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item): ?>  
                    <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                selected <?php }
                        ?>
                            > <?php echo $item->name; ?>

                    </option> <?php endforeach; ?>

            </select> <?php
            break;
        case 1904:
            ?>  
            <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>
                <option value="<?php echo $item->id; ?>" <?php if (count($data_select) == 1) { ?>  
                            selected <?php }
                ?>
                        > <?php echo $item->name; ?> </option> <?php
                    endforeach;

                    break;
                case 2:
                    $ver_editar = isset($enabled) ? $enabled : '';

                    $is_required = isset($required) ? $required : '';
                    ?>

            <div class="form-group form-group-sm"> <?php if (isset($msgLabel) && $msgLabel) { ?>
                    <label for="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="col-sm-3 control-label small"> <?php echo $msgLabel; ?> </label> <?php }
                    ?>

                <div class="col-sm-9">  
                    <select class="form-control input-sm" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>"
                            <?php echo $ver_editar . ' ' . $is_required; ?> title="Seleccione <?php echo $msgLabel; ?>"
                            data-url="<?php echo (isset($data_url) and $data_url) ? $data_url : '' ?>" target-change="<?php echo (isset($target_change) and $target_change) ? $target_change : '' ?>"
                            data-blank = "<?php echo (isset($data_blank)) ? $data_blank : ''; ?>">

                        <option value=""> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item): ?>  
                            <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                        selected <?php }
                                ?>
                                    > <?php echo $item->name; ?>

                            </option> <?php endforeach; ?>

                    </select>
                </div>    
            </div> <?php
            break;
        case 3:
            /*
             * @description:contruye un componente select segun los datos de $data_select
             */
            ?>  
            <div class="form-group-sm">
                <select class="form-control-sm input-small" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>"  name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>">
                    <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item): ?>  
                        <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                    selected <?php }
                ?>
                                > <?php echo $item->name; ?>
                        </option> <?php endforeach; ?>
                </select>
            </div> <?php
            break;
        case 4:
            /*
             * @description:construye las option para un componente select
             */
            ?>  
            <option value=""> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>
                <option value="<?php echo $item->id; ?>" <?php if (count($data_select) == 1) { ?>  
                            selected <?php }
                ?>
                        > <?php echo $item->name; ?> </option> <?php
                    endforeach;

                    break;
                case 5:
                    ?>  
            <div class="pull-right">
                <select name="<?php echo (isset($nameSelect) ? $nameSelect : 'nmselect1'); ?>" 
                        id="<?php echo (isset($idSelect)) ? $idSelect : 'idSelect1'; ?>"  
                        class="form-control input-sm" style="height: 24px;">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15" >15</option>
                    <option value="20" >20</option>
                </select>
            </div>
            <?php
            break;
        case 665:
            /*
             * @description: construye las option para un componente select con onchange
             */

            $ver_editar = isset($enabled) ? $enabled : '';
            ?>  

            <div class="form-group form-group-sm"> <?php if (isset($msgLabel) && $msgLabel) { ?>
                    <label for="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="col-sm-3 control-label small"> <?php echo $msgLabel; ?> </label> <?php }
            ?>

                <div class="col-sm-8">  
                    <select class="form-control input-sm" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" <?php echo $ver_editar; ?>
                            data-url="<?php echo ($data_url) ? $data_url : '' ?>" target-change="<?php echo ($target_change) ? $target_change : '' ?>"
                            onchange="return check_callejero_data(this);" title="Seleccione <?php echo $msgLabel; ?>"
                            <?= ($idEmpresa == 10) ? 'disabled' : '' ?>>

                        <option value=""> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item): ?>  
                            <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                        selected <?php }
                                ?>
                                    > <?php echo $item->name; ?>

                            </option> <?php endforeach; ?>

                    </select>

                </div>
                <?php if ($idEmpresa != 10): ?>
                    <div class="col-sm-1" style="padding: 0">
                        <a href="#" id="adddireccion"><span class="glyphicon glyphicon-pencil color1" aria-hidden="true" title="Nueva Dirección"></span></a> 
                    </div>
                <?php endif; ?>
            </div> <?php
            break;

        case 666:
            ?>  
            <div class="form-group form-group-sm">
                <div class="col-sm-9">  
                    <select class="form-control input-sm" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>"
                            onchange="return act_ficha_data();">

                        <option value=""> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php
                        foreach ($data_select as $item) {

                            $dir = $item->ID_CLI . ' - ' . $item->nombre . ' ' . $item->apellidos . ', ' . $item->calle . ' ' . $item->altura;
                            ?>  

                            <option value="<?php echo $item->ID_CLI; ?>" > <?php echo $dir; ?> </option> <?php }
                        ?>

                    </select>
                </div>    
            </div> <?php
            break;

        case 111:
            $ver_editar = isset($enabled) ? $enabled : '';
            ?>  

            <div class="form-group form-group-sm"> <?php if (isset($msgLabel) && $msgLabel) { ?>
                    <label for="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="col-sm-4 control-label small"> <?php echo $msgLabel; ?> </label> <?php }
            ?>

                <div class="col-sm-7">  
                    <select class="form-control input-sm" id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" <?php echo $ver_editar; ?>
                            data-url="<?php echo ($data_url) ? $data_url : '' ?>" title="Seleccione <?php echo $msgLabel; ?>"
                            target-change="<?php echo ($target_change) ? $target_change : '' ?>">

                        <option value="-1"> <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item): ?>  
                            <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                        selected <?php }
                ?>
                                    > <?php echo $item->name; ?>

                            </option> <?php endforeach; ?>

                    </select>
                </div>    
            </div> <?php
            break;

        case 999:
            /*
             * @description:contruye un componente select segun los datos de $data_select
             */
            ?>  

            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>"  name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" <?= (isset($disabled) && ($disabled != '')) ? $disabled : '' ?>
                     class="form-control input-sm">
                         <?=
                         (isset($msgSelect) && ($msgSelect != "")) ? "<option value='-1'> $msgSelect </option> " : "";
                         foreach ($data_select as $item) :
                             ?>  
                    <option value="<?php echo $item->id; ?>" <?php if (isset($selected) && $selected == $item->id) { ?>  
                                selected <?php }
                             ?>
                            > <?php echo $item->name; ?>

                    </option> <?php endforeach; ?>
            </select> <?php
            break;

        case 6666:
            /*
             * @description:contruye un componente select segun los datos de $data_select
             */
            ?>  

            <select  id="<?php echo (isset($idSelect) and $idSelect) ? $idSelect : ''; ?>" class="form-control" name="<?php echo (isset($nameSelect) and $nameSelect) ? $nameSelect : ''; ?>" style="width: 150px;" <?= $desactivar; ?>>
                <option value="-1" > <?php echo (isset($msgSelect) and $msgSelect) ? $msgSelect : ''; ?> </option> <?php foreach ($data_select as $item) : ?>  
                    <option value="<?php echo $item->id; ?>" <?= (isset($item->id_rolSSO) ? 'data-rol="' . $item->id_rolSSO . '"' : '') ?> <?= (isset($item->tipo) ? 'data-tipo="' . $item->tipo . '"' : '') ?> <?= (isset($item->marcador) ? 'data-marcador="' . $item->marcador . '"' : '') ?> <?= (isset($item->prefijoPais) ? 'data-prefijoPais="' . $item->prefijoPais . '"' : '') ?> <?= (isset($item->whatsapp) ? 'data-whatsapp="' . $item->whatsapp . '"' : '') ?> <?= (isset($item->idCampanaPBX) ? 'data-idCampanaPBX="' . $item->idCampanaPBX . '"' : '') ?> <?php if (isset($selected) && $selected == $item->id) { ?>  
                                selected <?php }
                ?>
                            > <?php echo $item->name; ?>

                    </option> <?php endforeach; ?>
            </select> <?php
            break;
        default:

            break;
    }
}

