<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of componente
 *
 * @author Renier
 */
class Componente extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_general');
        $this->load->model('componente/M_componente');
    }
    
    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:index
     *   @params:{$method type string},{$params  type array}
     *   @return:string
     *   @description:Funcion que devuleve el string de una vista imlplementada 
     *                 generica para poder ser usada en cualquier otra vista.
     */

    public function index($params = NULL) {
        $this->load->view($params['view'], $params);
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:index
     *   @params:{$method type string},{$params  type array}
     *   @return:string
     *   @description:Esta funcion devuelve un string de codigo javascript para 
     *              utilizar en una vista.
     */

    public function js($params = NULL) {
        
        //$versionJS = $this->M_componente->getVersionJS();
        $versionJS = rand(1, 100);
        
        foreach ($params['request'] as $key => $value) {
            if ($key != 'base') {
                foreach ($value as $indice => $valor) {
                    $params['request'][$key][$indice]['src'] .= '?'. $versionJS; //$versionJS->version;
                }
            }
        }

        if ($params['js']) {
            $this->load->view('js/' . $params['js'], $params);
        } else {
            return 'Not Found';
        }
    }

    public function select($params) {
        if (!array_key_exists('view_flag', $params)) {
            $params['view_flag'] = 1;
        }
        if (!array_key_exists('data_select', $params)) {
            $params['data_select'] = new stdClass();
        }
        if (!array_key_exists('nameSelect', $params)) {
            $params['nameSelect'] = '';
        }
        if (!array_key_exists('msgSelect', $params)) {
            $params['msgSelect'] = 'Seleccione...';
        }
        if (!array_key_exists('selected', $params)) {
            $params['selected'] = '';
        }
        if (!array_key_exists('funcion', $params)) {
            $params['funcion'] = '';
        }
        if (!array_key_exists('desactivar', $params)) {
            $params['desactivar'] = '';
        }

        $this->load->view('select', $params);
    }

    public function radio($params) {
        if (!array_key_exists('view_flag', $params)) {
            $params['view_flag'] = 1;
        }
        if (!array_key_exists('data_select', $params)) {
            $params['data_select'] = new stdClass();
        }
        if (!array_key_exists('nameSelect', $params)) {
            $params['nameSelect'] = '';
        }
        if (!array_key_exists('msgSelect', $params)) {
            $params['msgSelect'] = 'Seleccione...';
        }
        if (!array_key_exists('selected', $params)) {
            $params['selected'] = '';
        }
        if (!array_key_exists('funcion', $params)) {
            $params['funcion'] = '';
        }
        if (!array_key_exists('desactivar', $params)) {
            $params['desactivar'] = '';
        }

        $this->load->view('radio', $params);
    }

    public function check($params) {
        if (!array_key_exists('view_flag', $params)) {
            $params['view_flag'] = 1;
        }
        if (!array_key_exists('data_select', $params)) {
            $params['data_select'] = new stdClass();
        }
        if (!array_key_exists('nameSelect', $params)) {
            $params['nameSelect'] = '';
        }
        if (!array_key_exists('msgSelect', $params)) {
            $params['msgSelect'] = 'Seleccione...';
        }
        if (!array_key_exists('selected', $params)) {
            $params['selected'] = '';
        }
        if (!array_key_exists('funcion', $params)) {
            $params['funcion'] = '';
        }
        if (!array_key_exists('desactivar', $params)) {
            $params['desactivar'] = '';
        }

        $this->load->view('check', $params);
    }

    public function modal($params) {

        if (!array_key_exists('type', $params)) {
            $params['type'] = '';
        }
        if (!array_key_exists('cancel', $params)) {
            $params['cancel'] = '';
        }
        if (!array_key_exists('title', $params)) {
            $params['title'] = '';
        }
        if (!array_key_exists('body', $params)) {
            $params['body'] = '';
        }
        if (!array_key_exists('alterButton', $params)) {
            $params['alterButton'] = '';
        }
        if (!array_key_exists('nombre_funcion', $params)) {
            $params['nombre_funcion'] = '';
        }
        if (!array_key_exists('info', $params)) {
            $params['info'] = '';
        }

        $this->load->view('modal_view', $params);
    }

}
