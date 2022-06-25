<?php
if (isset($data_select)) {

    switch ($view_flag) {
        case 1:
            /*
             * @description:contruye un componente radio segun los datos de $data_select
             */
            $tmpArr = explode('|',$arrNoGoQuestionTotal);
            $hideQuestions = $tmpArr[0] ? explode(',',$tmpArr[1]) : array();
            foreach ($data_select as $item) : ?>
                <div class="col-sm-2 text-left" id="idDivRadio-<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_'.$item->orden;?>" 
                     data-IdTextInputRest="idInputOtro_<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_';?>" 
                     data-IdTextInput="idInputOtro_<?= $item->IdCuponProducto.'_'.$item->IdProducto.'_'.$item->orden;?>" data-view_second="<?= $item->pro_view_second;?>"
                     data-thisQuestion="<?= ($orden); ?>" data-hideQuestion="<?= (($item->orden === $tmpArr[0]) ? $tmpArr[1] : ''); ?>"
                     data-idInput="<?= $idRadio.'_'.$item->orden; ?>">
                    <input type="radio"  <?= (isset($arrIntSelected[0]) and $arrIntSelected[0] == $item->orden) ? 'checked' : ''; ?> id="<?= $idRadio.'_'.$item->orden; ?>"
                           value="<?php echo $item->respuesta; ?>" name="<?= $idRadio; ?>">
                    <input type="hidden" name="<?= $idRadio.'_'.$item->orden; ?>"> <?php
                    
                    echo $item->respuesta;
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

