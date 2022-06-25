<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Files management class created by CodexWorld
 */
class Descarga extends Mfcparaguay {

    function __construct() {
        parent::__construct();
        $this->load->model('m_descarga');
        $this->load->helper('download');
    }

    public function download($id) {
        $iD = (isset($id)) ? $id : $this->input->post("id");
        if (!empty($iD)) {

            //get file info from database
            $fileInfo = $this->m_descarga->getRows($iD);

            //file path
            $file = 'download/' .$fileInfo[0]->file_name;

            //download file from directory
            //force_download($file, NULL);
            //header('content-type: application/json');
            $data="";
            $respuesta['vista'] = $this->load->view('central/central', $data, TRUE);
            $respuesta['DownloadPath'] = base_url() . $file;
                
            echo json_encode($respuesta);
        }
    }

}
