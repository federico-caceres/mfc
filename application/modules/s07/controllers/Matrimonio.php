

<?php

/**
 * Description of Principal
 *
 * @author juan.vallejos
 */
class Matrimonio extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_general');
        $this->load->model('acceso/m_acceso');
        $this->load->model('s07/m_matrimonio');
    }

    public function url_exists($url = NULL) { // Verifica que el url este disponible
        if (empty($url)) {
            return false;
        }

        $options['http'] = array(
            'method' => "HEAD",
            'ignore_errors' => 1,
            'max_redirects' => 0
        );
        $body = @file_get_contents($url, NULL, stream_context_create($options));

        if (isset($http_response_header)) {
            sscanf($http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode);

            //Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
            $accepted_response = array(200, 301, 302);
            if (in_array($httpcode, $accepted_response)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function viewCabeceraMatrimonios() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tablero_s07' => Modules::run('s07/Matrimonio/lista_matrimonio', array('-1', '-1', '-1', '-1', "1")),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('cabecera_lista', $datos, TRUE);

        echo json_encode($data);
    }

    public function lista_s07($params) {

        $data = array(
            'matrimonios' => $this->m_matrimonio->getS07($params)
        );

        $vista['vista'] = $this->load->view('lista_matrimonio', $data, TRUE);
        if ($params[4] == "1") {
            return $this->load->view('lista_matrimonio', $data, TRUE);
        } else {
            echo json_encode($vista);
        }
    }

    public function listaCursos($origen, $idMatrimonio) {
        $idmatrimonio = (!isset($idMatrimonio)) ? $this->input->post("idmatrimonio") : $idMatrimonio;
        $data = array(
            'cursos' => $this->m_matrimonio->getCursos($idmatrimonio),
        );

        if ($origen == 1) {
            return $this->load->view('lista_cursos', $data);
        } else {
            $vista['vista'] = $this->load->view('lista_cursos', $data, TRUE);
            echo json_encode($vista);
        }
    }

    public function listaAportes($origen, $idMatrimonio) {
        $idmatrimonio = (!isset($idMatrimonio)) ? $this->input->post("idmatrimonio") : $idMatrimonio;
        $data = array(
            'aportes' => $this->m_matrimonio->getAportes($idmatrimonio),
        );

        if ($origen == 1) {
            return $this->load->view('lista_aportes', $data);
        } else {
            $vista['vista'] = $this->load->view('lista_aportes', $data, TRUE);
            echo json_encode($vista);
        }
    }

    public function getMatrimonioById($idMatrimonio) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;

        $matrimonios = $this->m_matrimonio->getMatrimonioById($idMatrimonio);
        $idDiocesis = (count($matrimonios) > 0 && $matrimonios[0]->iddiocesis != NULL) ? $matrimonios[0]->iddiocesis : (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (count($matrimonios) > 0 && (isset($matrimonios[0]->idbase) && !empty($matrimonios[0]->idbase))) ? $matrimonios[0]->idbase : (($nivel != 3) ? "-1" : $userData->idbase);
        $data = array(
            'matrimonio' => $matrimonios,
            'estados' => $this->m_matrimonio->getEstados("-1"),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, "-1")
        );
        $vista["vista"] = $this->load->view('modal/form_matrimonio', $data, TRUE);
        echo json_encode($vista);
    }

    public function getMatrimonioCursoById($idMatrimonio) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;

        $s02 = $this->m_matrimonio->getS02ById($idMatrimonio);
        $data = array(
            's02' => $s02
        );
        $vista["vista"] = $this->load->view('modal/form_s02', $data, TRUE);
        echo json_encode($vista);
    }

    public function getMatrimonioAporteById($idMatrimonio) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;

        $s06 = $this->m_matrimonio->getS02ById($idMatrimonio);
        $data = array(
            's06' => $s06
        );
        $vista["vista"] = $this->load->view('modal/form_s06', $data, TRUE);
        echo json_encode($vista);
    }

    public function verificaCedula() {
        $nroCedula = $this->input->post("nroCedula");
        $resultado = $this->m_matrimonio->verificaCedula($nroCedula);
        if (count($resultado) > 0) {
            $vista['message'] = "Nro. de Cédula ya existe, por favor verifique.";
            $vista['tipoMasagge'] = "error";
            $vista['success'] = TRUE;
        } else {
            $vista['message'] = "";
            $vista['tipoMasagge'] = "";
            $vista['success'] = FALSE;
        }
        echo json_encode($vista);
    }

    public function guardaMatrimonio() {
        $accion = $this->input->post("accion");
        $idmatrimonio = $this->input->post("idmatrimonio");
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;

        $registros = array(
            "estado" => ($this->input->post("estado")) ? $this->input->post("estado") : "",
            "iddiocesis" => ($this->input->post("id_diocesis")) ? $this->input->post("id_diocesis") : "",
            "idbase" => ($this->input->post("id_base")) ? $this->input->post("id_base") : "",
            "idgrupo" => ($this->input->post("id_grupo")) ? $this->input->post("id_grupo") : "",
            "fecha_ingreso" => ($this->input->post("fecha_ingreso")) ? $this->formato_mysql($this->input->post("fecha_ingreso")) : "",
            "fecha_membresia" => ($this->input->post("fecha_membresia")) ? $this->formato_mysql($this->input->post("fecha_membresia")) : "",
            "fecha_encuentro" => ($this->input->post("fecha_encuentro")) ? $this->formato_mysql($this->input->post("fecha_encuentro")) : "",
            "nro_encuentro" => ($this->input->post("nro_encuentro")) ? $this->input->post("nro_encuentro") : "",
            "casa_retiro" => ($this->input->post("casa_retiro")) ? $this->input->post("casa_retiro") : "",
            "el_nombre" => (strtoupper($this->input->post("nombre_el"))) ? strtoupper($this->input->post("nombre_el")) : "",
            "el_apellidos" => (strtoupper($this->input->post("apellidos_el"))) ? strtoupper($this->input->post("apellidos_el")) : "",
            "el_cedula" => ($this->input->post("cedula_el")) ? $this->input->post("cedula_el") : "",
            "el_cel" => ($this->input->post("celular_el")) ? $this->input->post("celular_el") : "",
            "el_profesion" => (strtoupper($this->input->post("profesion_el"))) ? strtoupper($this->input->post("profesion_el")) : "",
            "el_fecha_nac" => ($this->input->post("fecha_nac_el")) ? $this->formato_mysql($this->input->post("fecha_nac_el")) : "",
            "el_correo" => (strtolower($this->input->post("correo_el"))) ? strtolower($this->input->post("correo_el")) : "",
            "el_nacionalidad" => (strtoupper($this->input->post("nacionalidad_el"))) ? strtoupper($this->input->post("nacionalidad_el")) : "",
            "el_lugar_nac" => (addslashes(strtoupper($this->input->post("lugar_nac_el")))) ? addslashes(strtoupper($this->input->post("lugar_nac_el"))) : "",
            "el_tel_laboral" => ($this->input->post("tel_laboral_el")) ? $this->input->post("tel_laboral_el") : "",
            "el_lugar_trabajo" => ($this->input->post("lugar_trabajo_el")) ? $this->input->post("lugar_trabajo_el") : "",
            "el_grupo_sanguineo" => ($this->input->post("grupo_san_el")) ? $this->input->post("grupo_san_el") : "",
            "ella_nombre" => (strtoupper($this->input->post("nombre_ella"))) ? strtoupper($this->input->post("nombre_ella")) : "",
            "ella_apellidos" => (strtoupper($this->input->post("apellidos_ella"))) ? strtoupper($this->input->post("apellidos_ella")) : "",
            "ella_cedula" => (strtoupper($this->input->post("cedula_ella"))) ? strtoupper($this->input->post("cedula_ella")) : "",
            "ella_cel" => (strtoupper($this->input->post("celular_ella"))) ? strtoupper($this->input->post("celular_ella")) : "",
            "ella_profesion" => (strtoupper($this->input->post("profesion_ella"))) ? strtoupper($this->input->post("profesion_ella")) : "",
            "ella_fecha_nac" => ($this->input->post("fecha_nac_ella")) ? $this->formato_mysql($this->input->post("fecha_nac_ella")) : "",
            "ella_correo" => ($this->input->post("correo_ella")) ? strtolower($this->input->post("correo_ella")) : "",
            "ella_nacionalidad" => (strtoupper($this->input->post("nacionalidad_ella"))) ? strtoupper($this->input->post("nacionalidad_ella")) : "",
            "ella_lugar_nac" => (addslashes(strtoupper($this->input->post("lugar_nac_ella")))) ? addslashes(strtoupper($this->input->post("lugar_nac_ella"))) : "",
            "ella_tel_laboral" => ($this->input->post("tel_laboral_ella")) ? $this->input->post("tel_laboral_ella") : "",
            "ella_lugar_trabajo" => ($this->input->post("lugar_trabajo_ella")) ? $this->input->post("lugar_trabajo_ella") : "",
            "ella_grupo_sanguineo" => ($this->input->post("grupo_san_ella")) ? $this->input->post("grupo_san_ella") : "",
            "direccion" => (addslashes(strtoupper($this->input->post("direccion")))) ? addslashes(strtoupper($this->input->post("direccion"))) : "",
            "ciudad" => (addslashes(strtoupper($this->input->post("ciudad")))) ? addslashes(strtoupper($this->input->post("ciudad"))) : "",
            "barrio" => (addslashes(strtoupper($this->input->post("barrio")))) ? addslashes(strtoupper($this->input->post("barrio"))) : "",
            "telefono" => (strtoupper($this->input->post("telefono"))) ? strtoupper($this->input->post("telefono")) : "",
            "aniversario" => ($this->input->post("aniversario")) ? $this->formato_mysql($this->input->post("aniversario")) : "",
            "cant_personas" => (strtoupper($this->input->post('cant_personas'))) ? strtoupper($this->input->post('cant_personas')) : "",
            "terceras_personas" => (strtoupper($this->input->post('terceras_personas'))) ? strtoupper($this->input->post('terceras_personas')) : "",
            "movilidad" => (strtoupper($this->input->post('movilidad'))) ? strtoupper($this->input->post('movilidad')) : "",
            "como_trasladan" => (strtoupper($this->input->post('como_trasladan'))) ? strtoupper($this->input->post('como_trasladan')) : "",
            "estado_marital" => (strtoupper($this->input->post('estado_marital'))) ? strtoupper($this->input->post('estado_marital')) : "",
            "parroquia_boda" => (strtoupper($this->input->post('parroquia_boda'))) ? strtoupper($this->input->post('parroquia_boda')) : "",
            "parroquia_capilla" => (strtoupper($this->input->post('parroquia_capilla'))) ? strtoupper($this->input->post('parroquia_capilla')) : "",
            "tipo_mat" => (strtoupper($this->input->post('tipo_matrimonio'))) ? strtoupper($this->input->post('tipo_matrimonio')) : "",
            "direccion_parroquia" => (addslashes(strtoupper($this->input->post('direccion_parroquia')))) ? addslashes(strtoupper($this->input->post('direccion_parroquia'))) : ""
        );
        $resultado = $this->m_matrimonio->guardaMatrimonio($accion, $idmatrimonio, $registros);
        $params = array($idDiocesis, ($this->input->post("id_base")) ? $this->input->post("id_base") : "-1", ($this->input->post("id_grupo")) ? $this->input->post("id_grupo") : "-1", "-1");
        $data = array(
            'matrimonios' => $this->m_matrimonio->getMatrimonios($params)
        );
        if ($resultado) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        $vista['vista'] = $this->load->view('lista_matrimonio', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaBaja() {

        $idmatrimonio = $this->input->post("idmatrimonio");
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = ($nivel == "2") ? $userData->idbase : "-1";

        $registros = array(
            "motivo_baja" => (strtoupper($this->input->post('motivo_baja'))) ? strtoupper($this->input->post('motivo_baja')) : "",
            "tipo_baja" => (addslashes(strtoupper($this->input->post('tipo_baja')))) ? addslashes(strtoupper($this->input->post('tipo_baja'))) : "",
            "borrado" => 1,
            "fecha_baja" => date('Y-m_d H:i:s')
        );
        $resultado = $this->m_matrimonio->guardaBaja($idmatrimonio, $registros);
        $params = array($idDiocesis, $idBase, ($this->input->post("id_grupo")) ? $this->input->post("id_grupo") : "-1", "-1");
        $data = array(
            'matrimonios' => $this->m_matrimonio->getMatrimonios($params)
        );
        if ($resultado) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        $vista['vista'] = $this->load->view('lista_matrimonio', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaCurso() {

        $registros = array(
            "idcurso" => $this->input->post('idcurso'),
            "idmatrimonio" => $this->input->post("idmatrimonio"),
            "fecha" => $this->formato_mysql($this->input->post("fecha")),
            "lugar" => $this->input->post("lugar"),
            "disertante" => ($this->input->post("disertante")) ? $this->input->post("disertante") : ""
        );
        $resultado = $this->m_matrimonio->guardaCurso($registros);

        $vista['idmatrimonio'] = $this->input->post("idmatrimonio");
        if ($resultado) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        //$vista['vista'] = $this->load->view('lista_matrimonio', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaAporte() {

        $registros = array(
            "idconcepto_aporte" => $this->input->post('idconcepto_aporte'),
            "idmatrimonio" => $this->input->post("idmatrimonio"),
            "fecha_pago" => $this->formato_mysql($this->input->post("fecha_pago")),
            "monto" => $this->input->post("monto"),
            "ano" => ($this->input->post("ano")) ? $this->input->post("ano") : "",
            "nro_recibo" => ($this->input->post("nro_recibo")) ? $this->input->post("nro_recibo") : ""
        );
        $resultado = $this->m_matrimonio->guardaAporte($registros);

        $vista['idmatrimonio'] = $this->input->post("idmatrimonio");
        if ($resultado) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        //$vista['vista'] = $this->load->view('lista_matrimonio', $data, TRUE);
        echo json_encode($vista);
    }

    public function eliminaCurso() {

        $idMatrimonio = $this->input->post('idMatrimonio');
        $idAporte = $this->input->post('idAporte');

        $resultado = $this->m_matrimonio->eliminaCurso($idMatrimonio, $idAporte);
        $vista["idmatrimonio"] = $idMatrimonio;
        echo json_encode($vista);
    }

    public function eliminaAporte() {

        $idMatrimonio = $this->input->post('idMatrimonio');
        $idAporte = $this->input->post('idAporte');

        $resultado = $this->m_matrimonio->eliminaAporte($idMatrimonio, $idAporte);
        $vista["idmatrimonio"] = $idMatrimonio;
        echo json_encode($vista);
    }

    public function bajaMatrimonio($idmatrimonio) {

        $idMatrimonio = (isset($idmatrimonio)) ? $idmatrimonio : $this->input->post("idmatrimonio");


        $data = array(
            'idmatrimonio' => $idMatrimonio
        );

        $vista['vista'] = $this->load->view('modal/form_baja', $data, TRUE);
        echo json_encode($vista);
    }

    public function abreFormCurso() {

        $idMatrimonio = ($this->input->post("idmatrimonio")) ? $this->input->post("idmatrimonio") : "-1";


        $data = array(
            'idmatrimonio' => $idMatrimonio,
            'cursos' => $this->m_matrimonio->getCursosList("-1")
        );

        $vista['vista'] = $this->load->view('modal/form_cursos', $data, TRUE);
        echo json_encode($vista);
    }

    public function abreFormAporte() {

        $idMatrimonio = ($this->input->post("idmatrimonio")) ? $this->input->post("idmatrimonio") : "-1";


        $data = array(
            'idmatrimonio' => $idMatrimonio,
            'conceptos_aporte' => $this->m_matrimonio->getConceptosAporteList("-1")
        );

        $vista['vista'] = $this->load->view('modal/form_aportes', $data, TRUE);
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

    public function getTemasMatrimonios() {

        $idNivel = $this->input->post('cod');

        $temas = $this->m_matrimonio->getTemasMatrimonios($idNivel);

        $resul = Modules::run('componente/select', array('idSelect' => 'tema_nro', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $temas, 'nameSelect' => 'tema_nro'));

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

    public function convertFecha($fecha) {
# The 0th day of a month is the same as the last day of the month before
        if ($fecha == null || $fecha == "0000-00-00") {
            $return = "";
        } else {
            $fechaFormat = date_create($fecha);
            $return = date_format($fechaFormat, "d/m/Y");
        }

        return $return;
    }

}
