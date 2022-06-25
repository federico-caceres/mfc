<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_localDate($gmt) {
        
     $hora_local = time() - $gmt->gmt*3600;     //gmt del pais (Ej. PYST -> UTC -3:00 or PYT -> UTC -4:00 para Paraguay horario de verano y horario normal respectivamente)

     return ($hora_local);
}
function getDateCliente($idCliente, $format = 'Y-m-d H:i:s'){
            $CI = & get_instance();

            $CI->load->model('cliente/m_cliente');
            
            $result = $CI->m_cliente->getGmtCliente(array($idCliente));
            log_message('celiterinfo', json_encode($idCliente) . ' <== id cliente ---- resul array info ==> ' . json_encode($result));
            $hora_local = time() - $result->gmt*3600;
            
            return (gmdate($format, $hora_local));
            
}

function formatPrecio($format,$precio){
    return number_format($precio, ($format)? 2:0, ',', '.');
}