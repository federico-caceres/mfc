<?php

/**
 * Description of Principal
 *
 * @author juan.vallejos
 */
class Central extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
//        $this->load->model('M_general');
//        $this->load->model('acceso/M_acceso');
    }

    public function centro() {

        $this->load->view('central');
    }

}
