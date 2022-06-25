<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * && open the template in the editor.
 */

/**
 * Description of MY_controller
 *
 * @author Juan
 */
class Mfcparaguay extends MX_Controller {

    protected $idUser;

    public function __construct() {
        parent::__construct();
        $this->load->model('acceso/M_acceso');
        $this->load->library('session');
        $this->requestController = strtolower($this->router->fetch_class());
        $this->requestAction = strtolower($this->router->fetch_method());
        $horaEjecucionAntes = date('H:i:s');
        $login = $this->checkLogin();
        $dataUser = $this->session->userdata('userData');
        if (is_array($dataUser)) {
            $usuario = $dataUser[0]->login;
            $this->idUser = $dataUser[0]->idusuario;
        } else if (is_object($dataUser)) {
            $usuario = $dataUser->login;
            $this->idUser = $dataUser->idusuario;
        } else {
            $usuario = '';
        }
        if ($this->requestController == "reporte_control" || $this->requestController == "csv_control") {
            log_message('celiterinfo', 'Función utilizada: ' . $this->requestAction . ' hora de ejecucion: ' . $horaEjecucionAntes, $usuario);
        }
    }

    public function __destruct() {
        $this->requestController = strtolower($this->router->fetch_class());
        $this->requestAction = strtolower($this->router->fetch_method());
        $horaEjecucionDespues = date('H:i:s');
        if ($this->__isLoggedIn()) {
            $dataUser = $this->session->userdata('userData');
            if (is_array($dataUser)) {
                $usuario = $dataUser[0]->login;
            } else if (is_object($dataUser)) {
                $usuario = $dataUser->login;
            } else {
                $usuario = '';
            }
            if ($this->requestController == "reporte_control" || $this->requestController == "csv_control") {
                log_message('celiterinfo', 'Función utilizada: ' . $this->requestAction . ' hora de ejecucion: ' . $horaEjecucionDespues, $usuario);
            }
        }
    }

    private function checkLogin() {
        log_message("celiterinfo", $this->requestController . " - " . $this->requestAction);
        if (in_array($this->requestController, array("inicio", "perform_acceso", "wsinsertcontact", "index", "console", "reporte_control", "landing"))) {
            return TRUE;
        }
        if ($this->session->userdata('userData')) {
            return TRUE;
        } else {
            //If no session, redirect to login page
            //$this->M_acceso->limpiaColaXagente(array($this->config->item('idUsuarioGlobal')));
            if ($this->input->is_ajax_request()) {
                exit('logout');
            } else {
                redirect();
            }
        }
    }

    public function __isLoggedIn() {

        $user = $this->session->userdata('userData');

        if (!isset($user)) {
            return false;
        } else {
            return true;
        }
    }

    public function _remap($method, $param) {
        if (method_exists($this, $method)) {
            $this->$method($param);
        } else {
            echo 'Error. No se encuentra el recurso solicitado';
        }
    }

    public function _result($response, $status) {
        $response['success'] = $status;
        echo json_encode($response);
    }

}
