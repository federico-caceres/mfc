

<?php

/**
 * Description of Principal
 *
 * @author juan.vallejos
 */
class Grupo extends Mfcparaguay {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_general');
        $this->load->model('acceso/m_acceso');
        $this->load->model('matrimonio/m_matrimonio');
        $this->load->model('grupo/m_grupo');
    }

    public function viewCabeceraEquipos() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tablero_grupo' => Modules::run('grupo/Grupo/listaGrupos', array('-1', '-1', '-1', '-1', "1")),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('cabecera_lista', $datos, TRUE);

        echo json_encode($data);
    }

    public function listaGrupos($params) {
//        $userData = $this->session->userdata('userData');
//        $nivel = $userData->nivel;
//        $idDiocesis = $userData->iddiocesis;
//        $idBase = $userData->idbase;

        $data = array(
            'grupos' => $this->m_grupo->getGrupos($params)
        );

        $vista['vista'] = $this->load->view('lista_grupo', $data, TRUE);

        if ($params[4] == "1") {
            return $this->load->view('lista_grupo', $data, TRUE);
        } else {
            echo json_encode($vista);
        }
    }

//    public function listaGrupos() {
//        $userData = $this->session->userdata('userData');
//        $nivel = $userData->nivel;
//        $idDiocesis = $userData->iddiocesis;
//        $idBase = $userData->idbase;
//
//        $data = array(
//            'grupos' => $this->m_grupo->getGrupos($nivel, $idDiocesis, $idBase)
//        );
//
//        $vista['vista'] = $this->load->view('lista_grupo', $data, TRUE);
//
//        echo json_encode($vista);
//    }

    public function listaMiembros() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;
        $idgrupo = $this->input->post('idgrupo');
        $data = array(
            'miembros' => $this->m_grupo->getMiembros($nivel, $idDiocesis, $idBase, $idgrupo)
        );

        $vista['vista'] = $this->load->view('lista_miembros', $data, TRUE);

        echo json_encode($vista);
    }

    public function listaEvaluaciones($origen = 0, $idEvaluacion, $idGrupo) {
        $idevaluacion = (!isset($idEvaluacion)) ? $this->input->post('idevaluacion') : $idEvaluacion;
        $idgrupo = (!isset($idGrupo)) ? $this->input->post("idgrupo") : $idGrupo;
        $data = array(
            'evaluaciones' => $this->m_grupo->getEvaluacionesMatrimonios($idevaluacion),
            'grupo' => $this->m_grupo->getGrupoById($idgrupo),
        );

        $vista['vista'] = $this->load->view('lista_evaluacion', $data, TRUE);
        if ($origen == 1) {
            return $this->load->view('lista_evaluacion', $data);
        } else {
            $vista['vista'] = $this->load->view('lista_evaluacion', $data, TRUE);
            echo json_encode($vista);
        }
    }

    public function getGrupoS05() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;
        $idgrupo = $this->input->post('idGrupo');
        $idEvaluacion = $this->input->post('idEvaluacion');
        $nivelEvaluacion = $this->input->post('nivelEvaluacion');
        $data = array(
            'grupoS05' => $this->m_grupo->getS05($idEvaluacion),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, $idgrupo),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'matrimonios' => $this->m_matrimonio->getListaMatrimonios($idDiocesis, $idBase),
            'temas' => $this->m_matrimonio->getTemasMatrimonios($nivelEvaluacion)
        );
        if ($idEvaluacion == "0") {
            //new stdClass($data["grupoS05"]); 
            $data["grupoS05"] = array(
                'idgrupo' => $idgrupo,
                'grupos' => $this->m_matrimonio->getGrupos($idBase, $idgrupo),
                'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
                'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
                'matrimonios' => $this->m_matrimonio->getListaMatrimonios($idDiocesis, $idBase));
        }


        //($idEvaluacion == "0") ? array_push($data, $idgrupo) : "";
        $vista['vista'] = $this->load->view('modal/form_s05', $data, TRUE);

        echo json_encode($vista);
    }

    public function getEvaluacion($idgrupo, $idEvaluacion) {

        $idgrupo = (!isset($idgrupo)) ? $this->input->post('idGrupo') : $idgrupo;
        $idEvaluacion = (!isset($idEvaluacion)) ? $this->input->post('idEvaluacion') : $idEvaluacion;
        $data = array(
            'evaluacion' => $this->m_grupo->getEvaluacion($idEvaluacion),
            'grupo' => $this->m_grupo->getGrupoById($idgrupo),
            'matrimonios' => $this->m_matrimonio->getListaMatrimoniosGrupo($idgrupo)
        );

        $vista['vista'] = $this->load->view('modal/form_evaluacion', $data, TRUE);

        return $vista;
    }

    public function ListaGrupoS05() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;
        $idgrupo = $this->input->post('idGrupo');
        $data = array(
            's05' => $this->m_grupo->getGrupoS05($idgrupo)
        );

        $vista['vista'] = $this->load->view('lista_s05', $data, TRUE);

        echo json_encode($vista);
    }

    public function getGrupoById($idGrupo) {
        $userData = $this->session->userdata('userData');
        $idDiocesis = ($userData->nivel === "1") ? "-1" : $userData->iddiocesis;
        $idBase = ($userData->nivel === "3") ? $userData->idbase : "-1";
        $data = array(
            'grupo' => $this->m_grupo->getGrupoById($idGrupo),
            'estados' => $this->m_matrimonio->getEstados("-1"),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'matrimonios' => $this->m_matrimonio->getListaMatrimonios($idDiocesis, $idBase)
        );
        $vista["vista"] = $this->load->view('modal/form_grupo', $data, TRUE);
        echo json_encode($vista);
    }

    public function getMiembroById($idGrupo) {
        $idGrupo[0] = (count($idGrupo) > 0) ? $idGrupo[0] : $this->input->post('idGrupo');
        $userData = $this->session->userdata('userData');
        $idDiocesis = ($userData->nivel === "1") ? "-1" : $userData->iddiocesis;
        $idBase = ($userData->nivel === "1") ? "-1" : $userData->idbase;
        $data = array(
            'miembro' => $this->m_grupo->getMiembroById($idGrupo),
            'estados' => $this->m_matrimonio->getEstados("-1"),
            'matrimonios' => $this->m_matrimonio->getListaMatrimonios($idDiocesis, $idBase),
            'grupo' => $this->m_grupo->getGrupoById($idGrupo)
        );
        $vista["vista"] = $this->load->view('modal/form_miembro', $data, TRUE);
        echo json_encode($vista);
    }

    public function getDatosGrupoById($idGrupo) {

        $resultado = $this->m_grupo->getGrupoById(array($idGrupo));

        return $resultado;
    }

    public function eliminaMiembroById() {

        $idGrupo = $this->input->post('idGrupo');
        $idMatrimonio = $this->input->post('idMatrimonio');
        $resultado = $this->m_grupo->eliminaMiembroById($idGrupo, $idMatrimonio);

        echo json_encode($resultado);
    }

    public function eliminaEvaluacionById() {

        $idEvaluacion = $this->input->post('idEvaluacion');
        $idGrupo = $this->input->post('idGrupo');
        $idEvaMatrimonio = $this->input->post('idEvaMatrimonio');
        $nivelEvaluacion = $this->input->post('nivelEvaluacion');

        $resultado = $this->m_grupo->eliminaEvaluacionById($idGrupo, $idEvaluacion, $idEvaMatrimonio, $nivelEvaluacion);

        echo json_encode($resultado);
    }

    public function guardaGrupo() {
        $accion = $this->input->post("accion");
        $idgrupo = $this->input->post("id_grupo");
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;

        $registros = array(
            "estado" => ($this->input->post("estado")) ? $this->input->post("estado") : "",
            "iddiocesis" => ($this->input->post("id_diocesis")) ? $this->input->post("id_diocesis") : "",
            "idbase" => ($this->input->post("id_base")) ? $this->input->post("id_base") : "",
            "grupos" => ($this->input->post("nombre")) ? $this->input->post("nombre") : "",
            "idmatrimonio" => ($this->input->post("enlace")) ? $this->input->post("enlace") : "",
        );
        $resultado = $this->m_grupo->guardaGrupo($accion, $idgrupo, $registros);

        $data = array(
            'grupos' => $this->m_grupo->getGrupos($nivel, $idDiocesis, $idBase)
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
        $vista['vista'] = $this->load->view('lista_grupo', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaMiembro() {
        $accion = $this->input->post("accion");
        $idgrupo = $this->input->post("id_grupo");
        $idmatrimonio = $this->input->post("idmatrimonio");
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;

        $registros = array(
            "estado" => ($this->input->post("estado")) ? $this->input->post("estado") : "",
            "iddiocesis" => ($this->input->post("id_diocesis")) ? $this->input->post("id_diocesis") : "",
            "idgrupo" => ($this->input->post("id_grupo")) ? $this->input->post("id_grupo") : "",
            "borrado" => 0,
            "idmatrimonio" => ($this->input->post("idmatrimonio")) ? $this->input->post("idmatrimonio") : "",
        );
        $resultado = $this->m_grupo->guardaMiembro($accion, $idgrupo, $idmatrimonio, $registros);

        $data = array(
            'miembros' => $this->m_grupo->getMiembros($nivel, $idDiocesis, $idBase, $idgrupo)
        );
        if ($resultado["success"]) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
            $vista['idgrupo'] = "$idgrupo";
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
            $vista['idgrupo'] = "$idgrupo";
        }
        $vista['vista'] = $this->load->view('lista_miembros', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaS05() {
        $datosJson = json_decode($this->input->post("datosJson"));
        $accion = $this->input->post("accion");
        $idgrupo = $this->input->post("idgrupo");
        $idevaluacion = ($datosJson[1]->value) ? $datosJson[1]->value : "";
        $idDiocesis = $this->input->post("iddiocesis");
        $idBase = $this->input->post("idbase");
        //$modal_body = $this->getEvaluacion($idgrupo, $idevaluacion);
        //'body_modal' => $modal_body

        $registros = array(
            "idbase" => $idBase,
            "iddiocesis" => $idDiocesis,
            "idgrupo" => $idgrupo,
            "tema_nro" => ($datosJson[8]->value) ? $datosJson[8]->value : "",
            "nivel" => ($datosJson[6]->value) ? $datosJson[6]->value : "",
            "tema_descripcion" => ($datosJson[9]->value) ? $datosJson[9]->value : "",
            "fechaReunion" => ($datosJson[10]->value) ? $this->formato_mysql($datosJson[10]->value) : "",
            "casaReunion" => ($datosJson[11]->value) ? $datosJson[11]->value : "",
            "asistenciaAsesor" => ($datosJson[12]->value) ? $datosJson[12]->value : "",
            "horaPlanificado" => ($datosJson[13]->value) ? $datosJson[13]->value : "",
            "horaIniciado" => ($datosJson[14]->value) ? $datosJson[14]->value : "",
            "horaTerminado" => ($datosJson[15]->value) ? $datosJson[15]->value : "",
            "observaciones" => ($datosJson[19]->value) ? $datosJson[19]->value : "",
            "accionSugerida" => ($datosJson[18]->value) ? $datosJson[18]->value : "",
            "proximaFechaReunion" => ($datosJson[16]->value) ? $this->formato_mysql($datosJson[16]->value) : "",
            "proximaCasaReunion" => ($datosJson[17]->value) ? $datosJson[17]->value : "",
            "borrado" => 0
        );
        $resultado = $this->m_grupo->guardaS05($accion, $idevaluacion, $registros);

        if ($resultado["success"]) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
            $vista['idevaluacion'] = $resultado["idEvaluacion"];
            $vista['idgrupo'] = $idgrupo;
            $vista['idDiocesis'] = $idDiocesis;
            $vista['idBase'] = $idBase;
            $idEvaluaciones = $resultado["idEvaluacion"];
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
            $vista['idevaluacion'] = $idevaluacion;
            $vista['idgrupo'] = $idgrupo;
            $vista['idDiocesis'] = $idDiocesis;
            $vista['idBase'] = $idBase;
            $idEvaluaciones = $idevaluacion;
        }
        $data = array(
            'evaluacion' => $this->m_grupo->getEvaluaciones($idEvaluaciones),
            'grupo' => $this->m_grupo->getGrupoById($idgrupo),
            'matrimonios' => $this->m_matrimonio->getListaMatrimonios($idDiocesis, $idBase)
        );

        $vista['vista'] = $this->load->view('modal/form_evaluacion', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaEvaluacion() {

        $accion = $this->input->post("accion");
        $idgrupo = $this->input->post("idgrupo");
        $idEvaluacion = $this->input->post("idEvaluacion");
        $idmatrimonio = $this->input->post("idmatrimonio");
        $idDiocesis = $this->input->post("iddiocesis");
        $idBase = $this->input->post("idbase");
        $nivelEvaluacion = $this->input->post("nivelEvaluacion");

        $registros = array(
            "idevaluacion" => $idEvaluacion,
            "idmatrimonio" => $idmatrimonio,
            "puntualidad_el" => $this->input->post("puntualidad_el"),
            "puntualidad_ella" => $this->input->post("puntualidad_ella"),
            "estudio_el" => $this->input->post("estudio_el"),
            "estudio_ella" => $this->input->post("estudio_ella"),
            "participacion_el" => $this->input->post("participacion_el"),
            "participacion_ella" => $this->input->post("participacion_ella"),
            "cumple_accion_sugerida_el" => $this->input->post("cumple_accion_sugerida_el"),
            "cumple_accion_sugerida_ella" => $this->input->post("cumple_accion_sugerida_ella"),
            "suma_total" => $this->input->post("suma_total"),
            "promedio" => $this->input->post("promedio")
        );
        $resultado = $this->m_grupo->guardaEvaluacion($accion, $idEvaluacion, $idmatrimonio, $registros);
        $data = array(
            'grupoS05' => $this->m_grupo->getS05($idEvaluacion),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, $idgrupo),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'matrimonios' => $this->m_matrimonio->getListaMatrimonios($idDiocesis, $idBase),
            'idevaluacion' => $idEvaluacion,
            'idgrupo' => $idgrupo,
            'temas' => $this->m_matrimonio->getTemasMatrimonios($nivelEvaluacion),
        );
        $vista["nivelEvaluacion"] = $nivelEvaluacion;
        if ($resultado["success"]) {
            $vista['message'] = "Registro guardado correctamente";
            $vista['tipoMasagge'] = "info";
            $vista['idevaluacion'] = $idEvaluacion;
            $vista['idgrupo'] = $idgrupo;
        } else {
            $vista['message'] = "Registro no fué guardado correctamente";
            $vista['tipoMasagge'] = "error";
            $vista['idevaluacion'] = $idEvaluacion;
            $vista['idgrupo'] = $idgrupo;
        }

        $vista['vista'] = $this->load->view('modal/form_s05', $data, TRUE);
        echo json_encode($vista);
    }

    public function guardaPassword() {
        $userData = $this->session->userdata('userData');
        $idUsuario = $userData->idusuario;
        $password = ($this->input->post("nuevoPassword")) ? $this->input->post("nuevoPassword") : "";

        $resultado = $this->m_usuario->cambiaPassword($idUsuario, $password);

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

}
