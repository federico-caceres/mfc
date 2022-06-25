<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * && open the template in the editor.
 */

/**
 * Description of Principal
 *
 * @author juan.vallejos
 */
class Principal extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_general');
        $this->load->model('cliente/m_cliente');
    }

    public function index($status) {
        $this->load->model('acceso/m_acceso');
        $userData = $this->session->userdata('userData');

        if (!empty($userData)) {
            if (count($userData) > 1) {
                $data['flag'] = "login";
                $data['userData'] = $userData[0];
                $this->load->view('principal_view', $data);
            } else {
                $data['flag'] = "login";
                $data['userData'] = $userData;
                $this->load->view('principal_view', $data);
            }
        } else {
            redirect(base_url());
        }
    }



}
