<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * && open the template in the editor.
 */

/**
 * Description of Perform_acceso
 *
 * @author juan.vallejos
 */
class Perform_acceso extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_general');
        $this->load->library('session');
        $this->load->model('M_acceso');
    }

    public function login() {
        $data['user'] = $this->input->post('nm_usuario');
        $data['passw'] = $this->input->post('nm_clave');

        $resul = $this->M_acceso->loginM($data['user'], $data['passw']);

        if (count($resul)) {
            $this->session->set_userdata('userData', $resul[0]);
            $response['success'] = TRUE;
            $response['msg'] = "Usted se ha logueado correctamente.";
            $response['access_data'] = json_encode($resul[0]);
        } else {
            $resul[0]="";
            $response['success'] = FALSE;
            $response['msg'] = "Error de autenticacion. Favor verifique Usuario y Password.";
            $response['access_data'] = json_encode($resul[0]);
        }

        echo json_encode($response);
    }

    public function logout() {

        if ($this->session->sess_destroy()) {
            return TRUE;
        }
    }

    public function registrar_log() {

        $info = $this->input->post('info');

        $this->M_general->guarda_log($info);
    }

}
