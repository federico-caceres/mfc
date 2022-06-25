<?php
if (isset($data_select)) {

    switch ($view_flag) {
        case 1:
            /*
             * @description:contruye un componente check segun los datos de $data_select
             */
            //$arrIntSelected
            
            foreach ($data_select as $orden=>$item) : ?>
                <div class="col-sm-2">
                    <input type="checkbox" <?= in_array($item->orden, $arrIntSelected) ? 'checked' : ''; ?> name="<?= $idCheck.'_'.$item->orden;?>" value="<?php echo $item->respuesta; ?>" id="idCheckItem-<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_'.$item->orden;?>" data-IdTextInput="idInputOtro_<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_'.$item->orden;?>" data-view_second="<?= $item->pro_view_second;?>"> <?php echo $item->respuesta; ?>
                    <input type="hidden" name="<?= $idCheck.'_'.$item->orden; ?>"> <?php
                    if($item->pro_view_second) {
                        switch ($item->pro_view_second) {
                            case 5:   //textarea ?>
                                <div id="idInputOtro_<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_'.$item->orden;?>" name="idInputOtro_<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_'.$item->orden;?>" style="display:none;">
                                    <input type="text" class="form-control col-sm-7" placeholder="Especifíque su respuesta."><br>
                                </div> <?php

                                break;
                            case 4:   //input ?>
                                <div id="idInputOtro_<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_'.$item->orden;?>" name="idInputOtro_<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_'.$item->orden;?>" style="display:none;">
                                    <textarea class="form-control" rows="3" placeholder="Especifíque su respuesta." style="margin-top: 0px; margin-bottom: 0px; height: 88px;"></textarea><br>
                                </div> <?php

                                break;
                            default:
                                break;
                        }
                    } ?>
                </div> <?php
            endforeach; ?>
            <br><br> <?php
            break;

        default:

            break;
    }
}

