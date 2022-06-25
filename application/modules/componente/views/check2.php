<?php
if (isset($data_select)) {
    $contR = 0 ;
    $cheks = "";
    $cheks2 = "";
    $ncheck = 0;
    $div = "";
    $mitad = 0;
    switch ($view_flag) {
        case 1:
            /*
             * @description:contruye un componente check segun los datos de $data_select
             */
            //$arrIntSelected

            foreach($data_select as $orden => $item){
                $addOtros = "";
                $contR = $contR + 1;
                $chkado = in_array($item->orden, $arrIntSelected) ? 'checked' : "";
                
                if($item->respuesta == "OTROS MOTIVOS"){
                    $addOtros = "<div class='form-check div_$dependencia'>
                                    <input type='checkbox' name='".$idCheck."_".$item->orden."' $chkado class='form-check-input chk_".$dependencia."' value='".$item->respuesta."' id='idCheckItem-".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."' data-IdTextInput='idInputOtro_".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."' data-view_second='".$item->pro_view_second."' onclick='habText(this.id, \"obs\");'>
                                    <label class='form-check-label' for='".$item->respuesta."'>".trim($item->respuesta)."</label>
                                    <input type='hidden' id='idTextItem-".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."_$dependencia' name='".$idCheck."_".$item->orden."' class='form-control'>
                                    <div class='col-xs-2'>
                                        <input type='text' id='text-".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."' name='ob_".$idCheck."_".$item->orden."' class='form-control input-sm obs_".$dependencia."' aria-label='Detalle Motivo' readonly style='display:none;' size='45' maxlength='45'>
                                    </div>
                                </div>";
                }else{
                    if($ncheck <= 4 ){
                        $cheks .="<div class='form-check'>
                            <input name='".$idCheck."_".$item->orden."' $chkado class='form-check-input chk_".$dependencia."'  type='checkbox' value='".$item->respuesta."' id='idCheckItem-".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."' data-IdTextInput='idInputOtro_".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."' data-view_second='".$item->pro_view_second."' onclick='habText(this.id, \"chk\");'>
                            <label class='form-check-label' for='".$item->respuesta."'>".$item->respuesta."</label>
                            <input type='hidden' id='idTextItem-".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."_$dependencia' name='".$idCheck."_".$item->orden."' class='form-control'>
                        </div>";
                    }else{
                        $cheks2 .="<div class='form-check'>
                            <input name='".$idCheck."_".$item->orden."' $chkado class='form-check-input chk_".$dependencia."'  type='checkbox' value='".$item->respuesta."' id='idCheckItem-".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."' data-IdTextInput='idInputOtro_".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."' data-view_second='".$item->pro_view_second."' onclick='habText(this.id,\"chk\");'>
                            <label class='form-check-label' for='".$item->respuesta."'>".$item->respuesta."</label>
                            <input type='hidden' id='idTextItem-".$item->IdCuponProducto."_".$item->IdProducto."_".$item->orden."_$dependencia' name='".$idCheck."_".$item->orden."' class='form-control'>
                        </div>";
                    }
                }
                $ncheck++;
            }
            
            $div = "<div id='collapse".$dependencia."_".$item->IdProducto."' class='collapse hide' aria-labelledby='headingOne' data-parent='#accordion_$dependencia'>
                    <h4 class='text-center font-weight-light color'>$pregunta</h4>
                    <div class='form-row spacer color small'>";
                    $div .= "<div class='form-group col-sm-6'>".$cheks."</div>";
                    $div .= "<div class='form-group col-sm-6'>".$cheks2.$addOtros."</div>
                    </div>
                    ";
            echo $div;
            break;
        default:

            break;
    }
}
