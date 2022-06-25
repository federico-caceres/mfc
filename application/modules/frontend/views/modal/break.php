<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<form id="frm_modal_break" method="post" action="#">
    <input type="hidden" id="accion" name="accion">
    <input type="hidden" id="id_break_modal" name="id_break_modal">
    <input type="hidden" id="estado_modal_correo" name="estado_modal_correo">    
    <input type="hidden" id="primario_modal_correo" name="primario_modal_correo">
    <input type="hidden" id="enriquecido_modal_correo" name="enriquecido_modal_correo">
    <input type="hidden" id="estado_modal_correo" name="estado_modal_correo">
    
    <div class="form-group">
        <label for="modal_correo_input">Correo(<span style="color: red">*</span>):</label>
        <input type="email" class="form-control" id="modal_correo_input" name="modal_correo_input" placeholder="Correo">
    </div>

    <div class="form-group">
        <label for="observacion_modal_correo">Observación</label>
        <textarea id="observacion_modal_correo" name="observacion_modal_correo" rows="2" class="form-control" placeholder="Observación"></textarea>
    </div>

</form>