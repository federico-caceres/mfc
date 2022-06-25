<?php

?>

<div class="modal" id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog <?= (!empty($type)) ? 'modal-'.$type : ''; ?>">
        <div class="modal-content">
            <div class="modal-header">
                <?php if (isset($cancel) && $cancel):?>
                <button type="button" class="close" id="close_modal_<?= $id ?>" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php endif;?>
                <h4 id="title_modal_<?= $id ?>" class="modal-title"><?= (!empty($title)) ? $title : ''; ?></h4>
            </div>
            <div class="modal-body">
                <?= (!empty($body)) ? $body : ''; ?>
            </div>
            <div class="modal-footer">
                <?= $info ?>
                <?php if (isset($cancel) && $cancel!=''):?>
                <button type="button" id="btn_cancel_<?= $id ?>" class="btn btn-default" data-dismiss="modal"><?=$cancel?></button>
                <?php endif;
                      if(!empty($alterButton)):?>
                    <button type="button" id="btn_conf_<?= $id ?>" <?= (!empty($nombre_funcion)) ? 'onclick="' . $nombre_funcion . '"' : '';  ?> class="btn bg-primary"><?= $alterButton ?></button>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
