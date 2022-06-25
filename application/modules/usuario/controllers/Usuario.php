

<?php

/**
 * Description of Principal
 *
 * @author juan.vallejos
 */
class Usuario extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_general');
        $this->load->model('acceso/m_acceso');
        $this->load->model('matrimonio/m_matrimonio');
        $this->load->model('jovenes/m_joven');
        $this->load->model('usuario/m_usuario');
    }

    public function listaUsuario() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $cargo = $userData->cargo;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;

        $data = array(
            'usuarios' => $this->m_usuario->getUsuarios($nivel, $cargo, $idDiocesis, $idBase)
        );

        $vista['vista'] = $this->load->view('lista_usuario', $data, TRUE);

        echo json_encode($vista);
    }

    public function muestraFormCambia() {
        $userData = $this->session->userdata('userData');
        $idUsuario = ($this->input->post('idusuario') === "-1") ? $userData->idusuario : $this->input->post('idusuario');
        $datosUsuario = ($this->input->post('idusuario') === "-1") ? $userData : $this->getDatosUsuarioById($this->input->post('idusuario'));
        $data = array(
            'usuario' => $idUsuario,
            'datosUsuario' => $datosUsuario
        );

        $vista['vista'] = $this->load->view('cambia_password', $data, TRUE);

        echo json_encode($vista);
    }

    public function getUsuarioById($idUsuario) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $cargo = $userData->cargo;
        $idBase = ($nivel !== "3") ? "-1" : $userData->idbase;
        $idDiocesis = ($nivel == "1") ? "-1" : $userData->iddiocesis;
        $getGrupo = ($cargo == "6") ? $this->m_joven->getGrupos($idBase, "-1") : $this->m_matrimonio->getGrupos($idBase, "-1");
        $data = array(
            'usuario' => $this->m_usuario->getUsuarioById($idUsuario),
            'estados' => $this->m_matrimonio->getEstados("-1"),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $getGrupo
        );
        $vista["vista"] = $this->load->view('modal/form_usuario', $data, TRUE);
        echo json_encode($vista);
    }

    public function getDatosUsuarioById($idUsuario) {


        $resultado = $this->m_usuario->getUsuarioById(array($idUsuario));

        return $resultado;
    }

    public function guardaUsuario() {
        $accion = $this->input->post("accion");
        $idusuario = $this->input->post("idusuario");
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;
        $password = ($this->input->post("password")) ? $this->input->post("password") : "12345";
        $login1 = str_replace(" ", "_", $this->input->post("usuario"));
        $loginSn = $this->eliminar_simbolos($login1);

        $registros = array(
            "estado" => ($this->input->post("estado")) ? $this->input->post("estado") : "",
            "iddiocesis" => ($this->input->post("id_diocesis")) ? $this->input->post("id_diocesis") : "",
            "idbase" => ($this->input->post("id_base")) ? $this->input->post("id_base") : "",
            "idgrupo" => ($this->input->post("id_grupo")) ? $this->input->post("id_grupo") : "",
            "nombre" => ($this->input->post("nombre")) ? $this->input->post("nombre") : "",
            "login" => ($loginSn) ? $loginSn : "",
            "clave" => md5($password),
            "nrocedula" => ($this->input->post("nrocedula")) ? $this->input->post("nrocedula") : "",
            "mail" => ($this->input->post("mail")) ? $this->input->post("mail") : "",
            "nivel" => ($this->input->post("nivel")) ? $this->input->post("nivel") : "",
            "cargo" => ($this->input->post("cargo")) ? $this->input->post("cargo") : "",
        );
        $resultado = $this->m_usuario->guardaUsuario($accion, $idusuario, $registros);
        $data = array(
            'usuarios' => $this->m_usuario->getUsuarios($nivel, $idDiocesis, $idBase)
        );
        if ($resultado["success"]) {
            $idusuario = $resultado ["idUsuario"];
            if (!$this->m_usuario->verificaPassword($idusuario, $password)) {
                $this->m_usuario->cambiaPassword($idusuario, $password);
            }
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        $vista['vista'] = $this->load->view('lista_usuario', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaPassword() {
        $userData = $this->session->userdata('userData');
        $idUsuarioActual = $userData->idusuario;
        $idUsuarioCambio = ($this->input->post("idUsuario")) ? $this->input->post("idUsuario") : "";
        $password = ($this->input->post("nuevoPassword")) ? $this->input->post("nuevoPassword") : "";

        $resultado = $this->m_usuario->cambiaPassword($idUsuarioCambio, $password);

        $vista["idUsuarioCambio"] = $idUsuarioCambio;
        $vista["idUsuarioLogueado"] = $idUsuarioActual;

        if ($resultado) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        // $vista['vista'] = $this->load->view('central/centro');
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

    private function eliminar_simbolos($string) {

        $string = trim($string);

        $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

        $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

        $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

        $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

        $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

        $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string
        );

        $string = str_replace(
                array("\\", "¨", "º", "-", "~",
            "#", "@", "|", "!", "\"",
            "·", "$", "%", "&", "/",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "<code>", "]",
            "+", "}", "{", "¨", "´",
            ">", "< ", ";", ",", ":",
            ".", " "), ' ', $string
        );
        return $string;
    }

}
