

<?php

/**
 * Description of Principal
 *
 * @author juan.vallejos
 */
class Joven extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_general');
        $this->load->model('acceso/m_acceso');
        $this->load->model('jovenes/m_joven');
        $this->load->model('matrimonio/m_matrimonio');
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

    public function lista_joven() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;

        $data = array(
            'jovenes' => $this->m_joven->getJovenes($nivel, $idDiocesis, $idBase)
        );

        $vista['vista'] = $this->load->view('lista_joven', $data, TRUE);

        echo json_encode($vista);
    }

    public function getJovenById($idJoven) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;

        $jovenes = $this->m_joven->getJovenById($idJoven);
        $idDiocesis = (count($jovenes) > 0) ? $jovenes[0]->iddiocesis : (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (count($jovenes) > 0 && (isset($jovenes[0]->idbase) && !empty($jovenes[0]->idbase))) ? $jovenes[0]->idbase : (($nivel != 3) ? "-1" : $userData->idbase);
        $data = array(
            'joven' => $jovenes,
            'estados' => $this->m_matrimonio->getEstados("-1"),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_joven->getGrupos($idBase, "-1")
        );
        $vista["vista"] = $this->load->view('modal/form_joven', $data, TRUE);
        echo json_encode($vista);
    }

    public function verificaCedula() {
        $nroCedula = $this->input->post("cedula");
        $resultado = $this->m_joven->verificaCedula($nroCedula);
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

    public function guardaJoven() {
        $accion = $this->input->post("accion");
        $idjoven = $this->input->post("idjoven");
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;

        $registros = array(
            "estado" => ($this->input->post("estado")) ? $this->input->post("estado") : "",
            "iddiocesis" => ($this->input->post("id_diocesis")) ? $this->input->post("id_diocesis") : "",
            "idbase" => ($this->input->post("id_base")) ? $this->input->post("id_base") : "",
            "idgrupo" => ($this->input->post("id_grupo")) ? $this->input->post("id_grupo") : "",
            "fecha_inicio" => ($this->input->post("fecha_ingreso")) ? $this->formato_mysql($this->input->post("fecha_ingreso")) : "",
            "fecha_membresia" => ($this->input->post("fecha_membresia")) ? $this->formato_mysql($this->input->post("fecha_membresia")) : "",
            "fecha_encuentro" => ($this->input->post("fecha_encuentro")) ? $this->formato_mysql($this->input->post("fecha_encuentro")) : "",
            "nro_encuentro" => ($this->input->post("nro_encuentro")) ? $this->input->post("nro_encuentro") : "",
            "casa_retiro" => ($this->input->post("casa_retiro")) ? $this->input->post("casa_retiro") : "",
            "nombre" => (strtoupper($this->input->post("nombre"))) ? strtoupper($this->input->post("nombre")) : "",
            "apellidoP" => (strtoupper($this->input->post("apellidoP"))) ? strtoupper($this->input->post("apellidoP")) : "",
            "apellidoM" => (strtoupper($this->input->post("apellidoM"))) ? strtoupper($this->input->post("apellidoM")) : "",
            "cedula" => ($this->input->post("cedula")) ? $this->input->post("cedula") : "",
            "cel" => ($this->input->post("celular")) ? $this->input->post("celular") : "",
            "profesion" => (strtoupper($this->input->post("profesion"))) ? strtoupper($this->input->post("profesion")) : "",
            "fecha_nac" => ($this->input->post("fecha_nac")) ? $this->formato_mysql($this->input->post("fecha_nac")) : "",
            "correo" => (strtolower($this->input->post("correo"))) ? strtolower($this->input->post("correo")) : "",
            "nacionalidad" => (strtoupper($this->input->post("nacionalidad"))) ? strtoupper($this->input->post("nacionalidad")) : "",
            "lugar_nacimiento" => (addslashes(strtoupper($this->input->post("lugar_nacimiento")))) ? addslashes(strtoupper($this->input->post("lugar_nacimiento"))) : "",
            "tel_laboral" => ($this->input->post("tel_laboral")) ? $this->input->post("tel_laboral") : "",
            "lugar_trabajo" => ($this->input->post("lugar_trabajo")) ? $this->input->post("lugar_trabajo_el") : "",
            "grupo_sanguineo" => ($this->input->post("grupo_sanguineo")) ? $this->input->post("grupo_sanguineo") : "",
            "tipoJoven" => (strtoupper($this->input->post("tipoJoven"))) ? strtoupper($this->input->post("tipoJoven")) : "",
            "confirmado" => (strtoupper($this->input->post("confirmado"))) ? strtoupper($this->input->post("confirmado")) : "",
            "parroquia_confirmacion" => (strtoupper($this->input->post("parroquia_confirmacion"))) ? strtoupper($this->input->post("parroquia_confirmacion")) : "",
            "nombre_padre" => (strtoupper($this->input->post("nombre_padre"))) ? strtoupper($this->input->post("nombre_padre")) : "",
            "nombre_madre" => (strtoupper($this->input->post("nombre_madre"))) ? strtoupper($this->input->post("nombre_madre")) : "",
            "tel_padre" => ($this->input->post("tel_padre")) ? $this->input->post("tel_padre") : "",
            "tel_madre" => ($this->input->post("tel_madre")) ? strtolower($this->input->post("tel_madre")) : "",
            "correo_padre" => (strtoupper($this->input->post("correo_padre"))) ? strtoupper($this->input->post("correo_padre")) : "",
            "correo_madre" => (addslashes(strtoupper($this->input->post("correo_madre")))) ? addslashes(strtoupper($this->input->post("correo_madre"))) : "",
            "padres_pertecen_mfc" => ($this->input->post("padres_pertecen_mfc")) ? $this->input->post("padres_pertecen_mfc") : "",
            "calle" => (addslashes(strtoupper($this->input->post("calle")))) ? addslashes(strtoupper($this->input->post("calle"))) : "",
            "ciudad" => (addslashes(strtoupper($this->input->post("ciudad")))) ? addslashes(strtoupper($this->input->post("ciudad"))) : "",
            "barrio" => (addslashes(strtoupper($this->input->post("barrio")))) ? addslashes(strtoupper($this->input->post("barrio"))) : "",
            "telefono" => (strtoupper($this->input->post("telefono"))) ? strtoupper($this->input->post("telefono")) : ""
        );
        $resultado = $this->m_joven->guardaJoven($accion, $idjoven, $registros);
        $data = array(
            'jovenes' => $this->m_joven->getJovenes($nivel, $idDiocesis, $idBase)
        );
        if ($resultado) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        $vista['vista'] = $this->load->view('lista_joven', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaBaja() {

        $idjoven = $this->input->post("idJoven");
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;

        $registros = array(
            "motivo_baja" => (strtoupper($this->input->post('motivo_baja'))) ? strtoupper($this->input->post('motivo_baja')) : "",
            "tipo_baja" => (addslashes(strtoupper($this->input->post('tipo_baja')))) ? addslashes(strtoupper($this->input->post('tipo_baja'))) : "",
            "borrado" => 1,
            "fecha_baja" => date('Y-m-d H:i:s')
        );
        $resultado = $this->m_joven->guardaBaja($idjoven, $registros);
        $data = array(
            'jovenes' => $this->m_joven->getJovenes($nivel, $idDiocesis, $idBase)
        );
        if ($resultado) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
        }
        $vista['vista'] = $this->load->view('lista_joven', $data, TRUE);
        echo json_encode($vista);
    }

    public function bajaJoven($idJoven) {

        $idjoven = (isset($idJoven)) ? $this->input->post("idJoven") : $idJoven;


        $data = array(
            'idjoven' => $idjoven
        );

        $vista['vista'] = $this->load->view('modal/form_baja', $data, TRUE);
        echo json_encode($vista);
    }

    public function getBases() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $this->input->post('cod');
        $idBase = ($nivel !== "3") ? "-1" : $userData->idbase;
        //$cod = $this->input->post('cod');

        $bases = $this->m_matrimonio->getBases($idDiocesis, $idBase);

        $resul = Modules::run('componente/select', array('idSelect' => 'id_base', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $bases, 'nameSelect' => 'id_base', 'funcion' => 'getGrupoJuvenil(this)'));

        echo json_encode($resul);
    }

    public function getGrupos() {

        $idBase = $this->input->post('cod');
        $idGrupo = "-1";
        $grupos = $this->m_joven->getGrupos($idBase, $idGrupo);

        $resul = Modules::run('componente/select', array('idSelect' => 'id_grupo', "clase" => "chosenselect", 'view_flag' => 30, 'data_select' => $grupos, 'nameSelect' => 'id_grupo'));

        echo json_encode($resul);
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

    public function listaCursos($origen, $idJoven) {
        $idjoven = (!isset($idJoven)) ? $this->input->post("idjoven") : $idJoven;
        $data = array(
            'cursos' => $this->m_joven->getCursos($idjoven),
        );

        if ($origen == 1) {
            return $this->load->view('lista_cursos', $data);
        } else {
            $vista['vista'] = $this->load->view('lista_cursos', $data, TRUE);
            echo json_encode($vista);
        }
    }

    public function listaAportes($origen, $idJoven) {
        $idjoven = (!isset($idJoven)) ? $this->input->post("idjoven") : $idJoven;
        $data = array(
            'aportes' => $this->m_joven->getAportes($idjoven),
        );

        if ($origen == 1) {
            return $this->load->view('lista_aportes', $data);
        } else {
            $vista['vista'] = $this->load->view('lista_aportes', $data, TRUE);
            echo json_encode($vista);
        }
    }

    public function eliminaAporte() {

        $idJoven = $this->input->post('idJoven');
        $idAporte = $this->input->post('idAporte');

        $resultado = $this->m_joven->eliminaAporte($idJoven, $idAporte);
        $vista["idjoven"] = $idJoven;
        echo json_encode($vista);
    }

    public function guardaCurso() {

        $registros = array(
            "idcurso" => $this->input->post('idcurso'),
            "idjoven" => $this->input->post("idjoven"),
            "fecha" => $this->formato_mysql($this->input->post("fecha")),
            "lugar" => $this->input->post("lugar"),
            "disertante" => ($this->input->post("disertante")) ? $this->input->post("disertante") : ""
        );
        $resultado = $this->m_joven->guardaCurso($registros);

        $vista['idjoven'] = $this->input->post("idjoven");
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

        $idJoven = $this->input->post('idJoven');
        $idCurso = $this->input->post('idCurso');

        $resultado = $this->m_joven->eliminaCurso($idJoven, $idCurso);
        $vista["idjoven"] = $idJoven;
        echo json_encode($vista);
    }

    public function getJovenCursoById($idJoven) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;

        $sj02 = $this->m_joven->getSJ02ById($idJoven);
        $data = array(
            'sj02' => $sj02
        );
        $vista["vista"] = $this->load->view('modal/form_sj02', $data, TRUE);
        echo json_encode($vista);
    }

    public function getJovenAporteById($idJoven) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;

        $sj06 = $this->m_joven->getSJ02ById($idJoven);
        $data = array(
            'sj06' => $sj06
        );
        $vista["vista"] = $this->load->view('modal/form_sj06', $data, TRUE);
        echo json_encode($vista);
    }

    public function abreFormCurso() {

        $idJoven = ($this->input->post("idjoven")) ? $this->input->post("idjoven") : "-1";


        $data = array(
            'idjoven' => $idJoven,
            'cursos' => $this->m_joven->getCursosList("-1")
        );

        $vista['vista'] = $this->load->view('modal/form_cursos', $data, TRUE);
        echo json_encode($vista);
    }

    public function abreFormAporte() {

        $idJoven = ($this->input->post("idjoven")) ? $this->input->post("idjoven") : "-1";


        $data = array(
            'idjoven' => $idJoven,
            'conceptos_aporte' => $this->m_joven->getConceptosAporteList("-1")
        );

        $vista['vista'] = $this->load->view('modal/form_aportes', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaAporte() {

        $registros = array(
            "idconcepto_aporte" => $this->input->post('idconcepto_aporte'),
            "idjoven" => $this->input->post("idjoven"),
            "fecha_pago" => $this->formato_mysql($this->input->post("fecha_pago")),
            "monto" => $this->input->post("monto"),
            "ano" => ($this->input->post("ano")) ? $this->input->post("ano") : "",
            "nro_recibo" => ($this->input->post("nro_recibo")) ? $this->input->post("nro_recibo") : ""
        );
        $resultado = $this->m_joven->guardaAporte($registros);

        $vista['idjoven'] = $this->input->post("idjoven");
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

}
