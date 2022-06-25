<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php if ($id_rol != '3') { ?>
    <div class="form-inline">
        <div title="Cantidad de Base Restante" id="CantBase">

            <div class="form-group" style="padding-left: 6px">
                <div class="input-group input-group-sm">

                    <input class="form-control text-center" type="text" name="InBase" id="InBase" value="0" disabled="" style="width: 70px">

                    <div class="input-group-addon">
                        <span>Registros en cola</span>
                    </div>                                        

                </div>
            </div>
        </div>

    </div>
<?php } ?>