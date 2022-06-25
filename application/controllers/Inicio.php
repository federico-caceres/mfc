<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inicio
 *
 * @author dannyc
 */
class Inicio extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
    }

    public function index($msg = NULL) {

        
            $logout = $this->input->get('logout');

            if (empty($userData)) {
                $data['msg'] = ($logout == 'true') ? 'Se ha perdido la Sesión, ingrese nuevamente..' : '';
                $this->load->view("login", $data);
            } else {
                $this->load->model('acceso/m_acceso');
                if (is_object($userData)) {
                    $acd = $userData->acd;
                } else {
                    $acd = $userData[0]->acd;
                }
                //$status = $this->m_acceso->getAgentStatus($acd);
                $status = "0";
                //$status = $this->m_acceso->getAgentStatus($acd);
                echo Modules::run('principal/index', $status);
            }
       

    }

}
