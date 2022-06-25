

<?php

/**
 * Description of Principal
 *
 * @author juan.vallejos
 */
class Base extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_general');
        $this->load->model('acceso/m_acceso');
        $this->load->model('matrimonio/m_matrimonio');
        $this->load->model('base/m_base');
    }

    public function viewCabeceraBases() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tablero_base' => Modules::run('base/Base/listaBases', array('-1', '-1', '1')),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('cabecera_lista', $datos, TRUE);

        echo json_encode($data);
    }

    public function listaBases($params) {

        $data = array(
            'bases' => $this->m_base->getBases($params)
        );

        $vista['vista'] = $this->load->view('lista_base', $data, TRUE);
        if ($params[2] == "1") {
            return $this->load->view('lista_base', $data, TRUE);
            ;
        } else {
            echo json_encode($vista);
        }
    }

    public function getBaseById($idBase) {
        $userData = $this->session->userdata('userData');
        $idDiocesis = ($userData->nivel === "1") ? "-1" : $userData->iddiocesis;
        $idbase = ($userData->nivel === "3") ? $userData->idbase : "-1";
        $data = array(
            'base' => $this->m_base->getBaseById($idBase),
            'estados' => $this->m_matrimonio->getEstados("-1"),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idbase),
            'matrimonios' => $this->m_matrimonio->getListaMatrimonios($idDiocesis, $idbase)
        );
        $vista["vista"] = $this->load->view('modal/form_base', $data, TRUE);
        echo json_encode($vista);
    }

    public function getDatosBaseById($idBase) {

        $resultado = $this->m_base->getBaseById(array($idBase));

        return $resultado;
    }

    public function guardaBase() {
        $accion = $this->input->post("accion");
        $idbase = $this->input->post("id_base");
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;


        $registros = array(
            "estado" => ($this->input->post("estado")) ? $this->input->post("estado") : "",
            "iddiocesis" => ($this->input->post("id_diocesis")) ? $this->input->post("id_diocesis") : "",
            "bases" => ($this->input->post("nombre")) ? $this->input->post("nombre") : "",
            "idmatrimonio" => ($this->input->post("coordinador")) ? $this->input->post("coordinador") : ""
        );
        $resultado = $this->m_base->guardaBase($accion, $idbase, $registros);

        $data = array(
            'tablero_base' => Modules::run('base/Base/listaBases', array('-1', '-1', '1')),
            'diocesis' => $this->m_matrimonio->getDiocesis($this->input->post("id_diocesis")),
            'bases' => $this->m_matrimonio->getBases($this->input->post("id_diocesis"), $idbase),
            'grupos' => $this->m_matrimonio->getGrupos($idbase, "-1")
        );

        if ($resultado["success"]) {
            $vista['success'] = true;
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['success'] = FALSE;
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        $vista['vista'] = $this->load->view('cabecera_lista', $data, TRUE);
        echo json_encode($vista);
    }

    public function getBases() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $this->input->post('cod');
        $idBase = ($nivel !== "3") ? "-1" : $userData->idbase;
        //$cod = $this->input->post('cod');

        $bases = $this->m_matrimonio->getBases($idDiocesis, $idBase);

        $resul = Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'funcion' => 'getGrupoDependiente(this)'));

        echo json_encode($resul);
    }

    public function getGrupos() {

        $idBase = $this->input->post('cod');
        $idGrupo = "-1";
        $grupos = $this->m_matrimonio->getGrupos($idBase, $idGrupo);

        $resul = Modules::run('componente/select', array('idSelect' => 'id_grupo', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $grupos, 'nameSelect' => 'id_grupo'));

        echo json_encode($resul);
    }

    public function getDevice() {
        $this->load->helper('mobile_detect_helper');
        $detect = new Mobile_Detect();
        $isMobile = $detect->isMobile();
        $isTable = $detect->isTablet();
        $retorno['mobile'] = ($isMobile) ? 1 : ($isTable ? 2 : 3);
        echo json_encode($retorno);
    }

    private function formato_mysql($param) {

        $param = ($param) ? $param : '-1';
        if ($param != '-1') { //04-02-1953
            $fecha = explode("/", ((strpos('/', $param) !== FALSE) ? $param : str_replace('-', '/', $param)));
            $retorno = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
        } else {
            $retorno = '-1';
        }
        return $retorno;
    }

}
