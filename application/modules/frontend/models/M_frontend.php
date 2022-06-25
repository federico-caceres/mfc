<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_gestion
 *
 * @author juan.vallejos
 */
class M_frontend extends M_general {

    var $params = '';

    public function __construct() {
        parent::__construct();
    }

    /* ---------------------------------------------------------------------------- */

    /**
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function get_menu($params) {
        $procedure = 'get_menu_xRol';
        $call = $this->execProcedure($procedure, $params);
        $result = $this->_result_all_obj();

        return ($call) ? $result : FALSE;
    }
    
    public function get_TipoProducto($params) {
        $procedure = 'get_TipoProducto';
        $call = $this->execProcedure($procedure, $params);
        $result = $this->_result_obj();

        return ($call) ? isset($result->tipoProducto) ? $result->tipoProducto : '' : FALSE;
    }


    //fin de modelo de convertir a excel ************************************************************

}
