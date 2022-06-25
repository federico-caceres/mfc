<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * && open the template in the editor.
 */

/**
 * Description of M_general
 * @property Pdo_cache $pdo_cache 
 * @author dannyc
 */
class M_general extends CI_Model {
    #variables 

    var $_params = '';
    var $_pdo;
    var $_conn;

    #region contructor 

    public function __construct() {

        $CI = & get_instance();
        try {
            $this->_conn = new PDO('mysql:host=' . $CI->db->hostname . ';dbname=' . $CI->db->database . ';port=' . $CI->db->port . ';charset=' . $CI->db->char_set . ';', $CI->db->username, $CI->db->password);
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            log_message('error', "Error PDO -> " . $exc->getMessage());
            echo $exc->getTraceAsString();
        }
    }

    public function __destruct() {
        $this->_pdo = NULL;
        $this->_conn = NULL;
    }

    private function _setParams($data) {
        if (!empty($data) && is_array($data)) {
            $count = 1;
            foreach ($data as $item):
                $this->_pdo->bindValue($count, $item);
                $count++;
            endforeach;
        }
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    private function _preparedParams($data) {
        $this->_params = '';
        if (!empty($data) && is_array($data)) {
            $count = count($data);
            while ($count) {
                $this->_params .= '?,';
                $count --;
            }
        }
        $this->_params = substr($this->_params, 0, -1);
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function execProcedure($procedure, $params, $_connId = 0) {
        //$_connId = 0;
        if ($_connId) {

            $myDbConn = new stdClass();
            $myDbConn->hostName = '172.30.2.55';
            //$myDbConn->hostName = '172.30.2.70';
            $myDbConn->dbName = 'salientes_reportes';
            //$myDbConn->hostName = '172.30.2.56';
            //$myDbConn->dbName = 'salientes_v2';
            //$myDbConn->userName = 'celiter.reportes';
            $myDbConn->userName = 'pedro';
            //$myDbConn->password = 'BIQr22TODTlp';
            $myDbConn->password = 'pedro';
            $ipServerDB = $myDbConn->hostName;
            $CI = & get_instance();
            $this->_conn = new PDO('mysql:host=' . $myDbConn->hostName . ';dbname=' . $myDbConn->dbName . ';port=' . $CI->db->port . ';charset=' . $CI->db->char_set . ';', $myDbConn->userName, $myDbConn->password);
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } else {
            $CI = & get_instance();
            $ipServerDB = $CI->db->hostname;
        }


        try {
            $this->benchmark->mark('proc_start');
            $this->_preparedParams($params);

            $this->_pdo = $this->_conn->prepare("CALL $procedure($this->_params);");

            $this->_setParams($params);
            $horaEjecucionAntes = date('H:i:s');
            $result = $this->_pdo->execute();
            $horaEjecucionDespues = date('H:i:s');
            $tiempoEjecucion = strtotime($horaEjecucionDespues) - strtotime($horaEjecucionAntes);
            //$error = $this->_pdo->errorCode().'. '.$this->_pdo->errorInfo();
            if (is_array($params)) {
                $parametros = (count($params) > 0) ? implode(" - ", $params) : '';
            } else {
                $parametros = "";
            }
            $controlador = strtolower($this->router->fetch_class());
            $this->requestAction = strtolower($this->router->fetch_method());
            if ($this->_isLoggedIn()) {
                //$usuario = is_array($this->session->userdata('userData')) ? $this->session->userdata('userData')[0]->login : $this->session->userdata('userData')->login;
                $dataUser = $this->session->userdata('userData');
                if (is_array($dataUser)) {
                    $usuario = $dataUser[0]->login;
                } else if (is_object($dataUser)) {
                    $usuario = $dataUser->login;
                } else {
                    $usuario = '';
                }

                if ($controlador == "reporte_control" || $controlador == "csv_control") {
                    log_message('celiterinfo', 'Fin de ejecucion: ' . $this->requestAction . ' Procedimiento: ' . $procedure . ' Servidor:' . $ipServerDB . ' Hora fin ejecucion: ' . $horaEjecucionDespues . ' Tiempo de ejecucion: ' . $tiempoEjecucion . ' Parametros utilizados: ' . $parametros, $usuario);
                }
            }
            $this->benchmark->mark('proc_end');
            log_message("celiterinfo", "Tiempo de ejecución del $procedure - " . $this->benchmark->elapsed_time('proc_start', 'proc_end') . ' seg.');
            return $result;
        } catch (PDOException $exc) {
            $msg = $exc->getMessage();
            if ((!$procedure == "get_regCola") && ((strpos($msg, "SQLSTATE[23000]: Integrity constraint violation:")) !== FALSE)) {
                log_message('error', "Error en Procedimiento: " . $procedure . ' Servidor:' . $ipServerDB . " -> Parametros: --> " . json_encode($params) . " <-- >>> " . $msg);
            } else {
                $this->guarda_log("Error en Procedimiento: " . $procedure . " -> Parametros: --> " . json_encode($params) . " <-- >>> " . $msg);
            }
            return $exc;
        }
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function _result_all_array() {
        return $this->_pdo->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function _result_all_obj() {
        return $this->_pdo->fetchAll(PDO::FETCH_OBJ);
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function _result_obj() {
        return $this->_pdo->fetchObject();
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function _result_rowCount() {
        return $this->_pdo->rowCount();
    }

    public function guarda_log($param) {
        $usuario = $this->session->userdata('user');
        $nombre = 'log_' . date('Ymd') . '.txt';
        $file = fopen("./uploads/" . $nombre, "a");
        fwrite($file, PHP_EOL . "[" . date("H:i:s") . "] - [user:'" . $usuario . "'] " . $param);
        fclose($file);
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    function __llamar($numeroAgente, $destino, $prefijoSalida, $id_cuenta = '') {

        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/AMI.php';

        $ami = new \skytel\asteriskPBX\AMI(IP_PBX, USER_PBX, PASSW_PBX);

        //$result = $ami->llamarSIP($numeroAgente, $destino, $prefijoSalida, $contexto = "from-internal");
        $result = $ami->llamarAgenteSaliente($numeroAgente, $destino, $prefijoSalida);
        //$result = $ami->llamarSIPSaliente($numeroAgente, $destino, "1003", $prefijoSalida, $contexto = "from-internal");
        return $result;
    }

    public function llamarPBX($numeroAgente, $destino) {
        //hace la llamada
        log_message('celiterinfo', 'Inicio llamada Nro: ' . $destino . ' Agente: ' . $numeroAgente);
        require_once 'libs/phpagi-asmanager.php';
        $asm = new AGI_AsteriskManager();
        $conection = $asm->connect(IP_PBX, USER_PBX, PASSW_PBX);
        if ($conection == FALSE) {

            flush();
        } elseif ($conection == TRUE) {

            flush();
        }

        $res = $asm->Originate("agent/$numeroAgente"
                , "$destino", 'from-internal', 1);

        log_message('celiterinfo', 'Fin llamada Nro: ' . $destino . ' Agente: ' . $numeroAgente . ' - ' . implode('-', $res));
        flush();

        $asm->disconnect();
    }

    function verificarBlackList($destino, $id_cliente, $id_campana, $id_cuenta = 0) {

        $tipoServicio = NULL;
        getTipoServicioByUserData($this->session->userdata('userData'), $id_campana, $tipoServicio);
        if ($tipoServicio == '15' || $tipoServicio == '0' || $id_campana == "41") {
            $retorno['response'] = TRUE;
        } else {
            $blacklist = $this->execProcedure('exist_Blacklist', array((int) $destino, (int) $id_cuenta, (int) $id_cliente));
            $call = $this->_result_obj();
            $respuesta = (isset($call->retorno)) ? (bool) $call->retorno : FALSE;

            if (!$respuesta) {
                $retorno['response'] = TRUE;
            } else {
                $retorno['msg'] = 'El número marcado se encuentra dentro de la BlackList, llamada no realizada.';
                $retorno['response'] = FALSE;
            }
        }
        return $retorno;
    }

    function __VerificarOnCall($numeroAgente) {

        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/AMI.php';

        $ami = new \skytel\asteriskPBX\AMI(IP_PBX, USER_PBX, PASSW_PBX);

        //$result = $ami->llamarSIP($numeroAgente, $destino, $prefijoSalida, $contexto = "from-internal");
        $result = $ami->verificaLlamada($numeroAgente);
        //$result = $ami->llamarSIPSaliente($numeroAgente, $destino, "1003", $prefijoSalida, $contexto = "from-internal");
        return $result;
    }

    function __transferirDirecto($numeroAgente, $destino, $prefijoSalida) {

        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/AMI.php';

        $ami = new \skytel\asteriskPBX\AMI(IP_PBX, USER_PBX, PASSW_PBX);

        $result = $ami->transferirDirecto($numeroAgente, $destino, $prefijoSalida);

        return $result;
    }

    function __transferirAtendido($numeroAgente, $destino, $prefijoSalida) {

        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/AMI.php';

        $ami = new \skytel\asteriskPBX\AMI(IP_PBX, USER_PBX, PASSW_PBX);

        $result = $ami->transferir($numeroAgente, $destino, $prefijoSalida);

        return $result;
    }

    function __transferirLlamada($sExtension, $numeroAgente, $bAtxfer = TRUE) {
        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/ElastixService.php';
        $respuesta = array(
            'action' => 'transfer',
            'message' => '(no message)',
        );
        if (is_null($sExtension) || !ctype_digit($sExtension)) {
            $respuesta['action'] = 'error';
            $respuesta['message'] = 'Invalid or missing extension to transfer';
        } else {
            $elastix = new \skytel\asteriskPBX\ElastixService(IP_PBX, USER_DB_ELASTIX, PASSW_DB_ELASTIX, DB_NAME_ELASTIX);
            $bExito = $elastix->transferirLlamada($sExtension, $numeroAgente, in_array($bAtxfer, array('true', 'A')), IP_PBX, USER_ECCP_ELASTIX, PASSW_ECCP_ELASTIX);
            $respuesta['action'] = 'success';
            $respuesta['message'] = 'Llamada Transferida ' . $bExito;
            if (!$bExito) {
                $respuesta['action'] = 'error';
                $respuesta['message'] = 'Error while transferring call' . ' - ' . $elastix->errMsg;
            }
        }

        return $respuesta;
    }

    function __cortarLlamada($numeroAgente) {

        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/AMI.php';
        //$sExtension = $this->session->userdata('interno');
        $userData = $this->session->userdata('userData');
        $acd = $userData[0]->acd;
        $ami = new \skytel\asteriskPBX\AMI(IP_PBX, USER_PBX, PASSW_PBX);
        //$statusAgent = $this->getEstadoAgente($sExtension, $acd);
//        if (isset($statusAgent['extension'])) {
//            if ($statusAgent['extension'] == $sExtension) {
        $result = $ami->cortarSaliente($numeroAgente);
//            } else {
//                $result = $statusAgent;
//            }
//        } else {
//            $result = $statusAgent;
//        }
        return $result;
    }

    /**
     *
     * Obtiene el canal del "Direct Bridge" si el agente dado
     * tiene una llamada en curso, solo en ese caso puede tener
     * el atributo "Direct Bridge" que el canal correspondiente
     * de la llamada entrante que le cayo a este agente
     */
    public function cortarLlamadaPBX($agente) {
        require_once 'libs/phpagi-asmanager.php';

        $asm = new AGI_AsteriskManager();
        $conection = $asm->connect(IP_PBX, USER_PBX, PASSW_PBX);
        if ($conection == FALSE) {

            flush();
        } elseif ($conection == TRUE) {

            flush();
        }

        if (strlen($this->__getDirectBridgeChannelPBX("agent/$agente", $asm)) == 0) {
            //no hay llamada en curso
        }
        $asm->disconnect();
    }

    function __getDirectBridgeChannelPBX($agente, $asm) {

        $datos_canal = $asm->Command("core show  channel $agente");

        $expl = ($datos_canal) ? explode("level 1: channel=", $datos_canal['data']) : array();

        $expl2 = (isset($expl[1])) ? explode("\n", $expl[1]) : '';

        $direct_bridge = ($expl2) ? trim($expl2[0]) : '';

        ($direct_bridge) ? $asm->Hangup($direct_bridge) : '';

        return $direct_bridge;
    }

    public function Upd_bitacora($params) {
        $procedure = 'ins_bitacora';
        return ($this->execProcedure($procedure, $params)) ? TRUE : FALSE;
    }

    public function __getUniqueid($numeroAgente) {

        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/AMI.php';

        $ami = new \skytel\asteriskPBX\AMI(IP_PBX, USER_PBX, PASSW_PBX);

        $result = $ami->getUniqueid($numeroAgente);

        return $result;
    }

    function _getUniqueid($agente, $asm) {

        $datos_canal = $asm->Command("core show  channel $agente");


        $expl3 = ($datos_canal) ? explode("uniqueid=", $datos_canal['data']) : '';

        $expl4 = (isset($expl3[1])) ? explode("\n", $expl3[1]) : '';

        $ast_uniqueid = ($expl4) ? trim($expl4[0]) : '0';

        return $ast_uniqueid;
    }

    function ObtieneUniqueId($nro_agente) {
        require_once 'libs/phpagi-asmanager.php';

        $asm = new AGI_AsteriskManager();


        $st = $asm->connect(IP_PBX, USER_PBX, PASSW_PBX);
        if ($st == FALSE) {
            
        } elseif ($st == TRUE) {
            //echo ">> Conectado el sistema IP PBX.\n";
        }

        if (strlen($this->_getUniqueid("agent/" . $nro_agente . "", $asm)) == 0) {
            //echo "<br><b> NO EXISTE LLAMADA EN CURSO </b><br>";
            $unique_id = "0";
        } else {
            $unique_id = $this->_getUniqueid("agent/" . $nro_agente . "", $asm);
        }


        flush();

        $asm->disconnect();
        return $unique_id;
    }

    function ObtieneUniqueIdNeotel($acd) {
        $estadoLogeado = $this->getEstadoAgenteNeotel($acd);
        $estadoLogeado = explode('|', $estadoLogeado);
        foreach ($estadoLogeado as $key => $value) {
            $fore = explode("=", $value);
            foreach ($fore as $valor) {

                if (trim($fore[0]) == "IDLLAMADA") {
                    $uniqueid1 = trim($fore[1]);
                }
                if (trim($fore[0]) == "IDLLAMADA_ULT") {
                    $uniqueid2 = trim($fore[1]);
                }
            }
        }
        $uniqueid = isset($uniqueid1) ? $uniqueid1 : (isset($uniqueid2) ? $uniqueid2 : "0");
        if ($uniqueid == "0") {
            sleep(2);
            foreach ($estadoLogeado as $key => $value) {
                $fore = explode("=", $value);
                foreach ($fore as $valor) {

                    if (trim($fore[0]) == "IDLLAMADA") {
                        $uniqueid1 = trim($fore[1]);
                    }
                    if (trim($fore[0]) == "IDLLAMADA_ULT") {
                        $uniqueid2 = trim($fore[1]);
                    }
                }
            }
        }
        $uniqueid = isset($uniqueid1) ? $uniqueid1 : (isset($uniqueid2) ? $uniqueid2 : "0");
        return $uniqueid;
    }

    public function getEstadoAgente($sExtension, $acd) {
        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/ElastixService.php';
        $elastix = new \skytel\asteriskPBX\ElastixService(IP_PBX, USER_DB_ELASTIX, PASSW_DB_ELASTIX, DB_NAME_ELASTIX);
        $result = $elastix->estadoAgenteLogeado($sExtension, $acd, IP_PBX, USER_ECCP_ELASTIX, PASSW_ECCP_ELASTIX);
        return $result;
    }

    public function getEstadoAgenteNeotel($acdP) {

        $acd = $this->input->post('USUARIO');

        if ($acd == "" || $acd == "0") {
            $acd = $acdP;
        }
        $url = "http://172.30.2.63/neoapi/webservice.asmx?wsdl";
        try {
            $Client_nusoap = new SoapClient($url, array("trace" => 1, "exception" => 0));

            $params = [
                'USUARIO' => $acd
            ];

            $row = $Client_nusoap->Position($params);
        } catch (Exception $exc) {
            log_message('error', 'Mensaje desde Console: ' . $exc->getMessage());
            $row = "MESSAGE=" . $exc->getMessage() . "|STATUS = 0";
            $exc->getTraceAsString();
        }

        $datos = (is_object($row)) ? $row->PositionResult : $row;

        if (count($acdP) > 0 || $acd == NULL) {
            return $datos;
        } else {
            echo $datos;
        }
    }

    public function getCantRegCola($params) {
        $procedure = 'getCantRegCola';
        $result = $this->execProcedure($procedure, $params);
        $cant = $this->_result_obj();
        return ($result) ? $cant : FALSE;
    }

    function getAgentOnline() {

        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/AMI.php';

        $ami = new \skytel\asteriskPBX\AMI(IP_PBX, USER_PBX, PASSW_PBX);

        $result = $ami->listaAgentesActivos();

        return $result;
    }

    function manejarSesionActiva_transfer($module_name, $smarty, $sDirLocalPlantillas, $oPaloConsola, $estado) {
        $respuesta = array(
            'action' => 'transfer',
            'message' => '(no message)',
        );
        $sTransferExt = getParameter('extension');
        if (is_null($sTransferExt) || !ctype_digit($sTransferExt)) {
            $respuesta['action'] = 'error';
            $respuesta['message'] = _tr('Invalid or missing extension to transfer');
        } else {
            $bExito = $oPaloConsola->transferirLlamada($sTransferExt, in_array(getParameter('atxfer'), array('true', 'checked')));
            if (!$bExito) {
                $respuesta['action'] = 'error';
                $respuesta['message'] = _tr('Error while transferring call') . ' - ' . $oPaloConsola->errMsg;
            }
        }

        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }

    /**
     * Envia la información de la gestión a la BD de auditoria.
     * @param INT $id_cliente ID del cliente donde esta registrada la cuenta.
     * @param INT $id_campana ID de la campaña donde esta registrada la cuenta.
     * @param STRING $uniqueID ID de la llamada, registrada con la gestión.
     * @param INT $id_estado ID del Referencia de la gestión.
     * @param INT $id_atributo ID del Resultado de la gestión.  
     * @param INT $idUsuario ID del Usuario que realizo la Gestión
     * @param INT $tipoTipificacion Identifica el registro como una gestión satisfactoria.
     * @param BIGINT $nro_telefono Nro de Telefono al que se le llamo para gestionar.
     * @param INT $idGestion ID de la gestión a ser auditada.
     * @return BOOLEAN  Retorna el resultado del envio de la informacion a la plataforma de auditoria.
     * @throws Exception
     */
    public function agregarAuditoria($id_cliente, $id_campana, $uniqueID, $id_estado, $id_atributo, $idUsuario, $tipoTipificacion = 0, $nro_telefono, $idGestion) {
        require_once CONFIG_LIBS;
        require_once 'skytel/auditoria/RegistroSalientes.php';

        if ($tipoTipificacion == 2) {
            $tipoTipificacion = "1";
        } else {
            $tipoTipificacion = "0";
        }
        $cola = $this->getColaByCampana(array((int) $id_campana));
        $cola = $cola ? $cola->cola : 0;

        $nro_agente = $this->getACD(array($idUsuario));
        $acd = $nro_agente->acd;

        $estado = $this->getNombreEstado(array($id_estado));
        $referencia = $estado->name;

        $atributo = $this->getNombreAtributo(array($id_atributo));
        $resultado = $atributo->name;

        $stateAux = $referencia . " - " . $resultado;

        $PLATAFORMA_SALIENTES = 3; //Tabla plataforma, db auditoria_plataforma
        $now = date('Y-m-d H:i:s');

        $registroSaliente = new \skytel\auditoria\RegistroSalientes(DB_IP_AUDITORIA, DB_NAME_AUDITORIA, DB_USER_AUDITORIA, DB_PASSWORD_AUDITORIA);
        // $registroSaliente = new \skytel\auditoria\RegistroSalientes("localhost", DB_NAME_AUDITORIA, "root", DB_PASSWORD_AUDITORIA);


        $registroSaliente->setUniqueId($uniqueID ? $uniqueID : 'FALSE'); //Obligatorio
        $registroSaliente->setAgentNumber($acd); //Obligatorio
        $registroSaliente->setIdCliente($id_cliente);
        $registroSaliente->setIdCampana($id_campana);
        $registroSaliente->setState($stateAux); //Obligatorio
        $registroSaliente->setDate($now); //Obligatorio
        $registroSaliente->setPlatform($PLATAFORMA_SALIENTES); //Obligatorio        
        $registroSaliente->setTipoTipificacion($tipoTipificacion); //Obligatorio

        $registroSaliente->setCola($cola);
        $registroSaliente->setNroTelefono($nro_telefono);
        $registroSaliente->setIdGestion($idGestion);

        $result = $registroSaliente->saveDataSalientes();

        if ($result === FALSE) {
            throw new Exception("Error: " . $registroSaliente->getErrorMessage());
        }

        return $result;
    }

    public function getNombreEstado($params) {
        $procedure = 'getNombreEstadoById';
        $call = $this->execProcedure($procedure, $params);

        return ($call) ? $this->_result_obj() : FALSE;
    }

    public function getNombreAtributo($params) {
        $procedure = 'getNombreAtributoById';
        $call = $this->execProcedure($procedure, $params);

        return ($call) ? $this->_result_obj() : FALSE;
    }

    public function getACD($params) {
        $procedure = 'getAcdById';
        $call = $this->execProcedure($procedure, $params);

        return ($call) ? $this->_result_obj() : FALSE;
    }

    public function getColaByCampana($params) {
        $procedure = 'getColaByCampana';
        $call = $this->execProcedure($procedure, $params);

        return ($call) ? $this->_result_obj() : FALSE;
    }

    public function _isLoggedIn() {

        $user = $this->session->userdata('userData');

        if (!isset($user)) {
            return false;
        } else {
            return true;
        }
    }

    function reemplazarPrimero($buscar, $remplazar, $texto) {
        $pos = stripos($texto, $buscar);
        if ($pos !== false) {
            $texto = substr_replace($texto, $remplazar, $pos, strlen($buscar));
        }
        return $texto;
    }

    public function llamarNeotel($acd, $nroTelefono) {

        $url = "http://172.30.2.63/neoapi/webservice.asmx?wsdl";
        $Client_nusoap = new SoapClient($url, array("trace" => 1, "exception" => 0));

        $params = [
            'USUARIO' => $acd,
            'TELEFONO' => $nroTelefono
        ];
        try {
            $row = $Client_nusoap->Dial($params);
        } catch (Exception $exc) {
            $row = "MESSAGE=" . $exc->getMessage() . "|STATUS=0";
            $exc->getTraceAsString();
        }
        return $row;
    }

    public function cortarLlamarNeotel($acd) {

        $url = "http://172.30.2.63/neoapi/webservice.asmx?wsdl";
        $Client_nusoap = new SoapClient($url, array("trace" => 1, "exception" => 0));

        $params = [
            'USUARIO' => $acd
        ];
        try {
            $row = $Client_nusoap->Hangup($params);
        } catch (Exception $exc) {
            $row = "MESSAGE=" . $exc->getMessage() . "|STATUS=0";
            $exc->getTraceAsString();
        }
    }

    public function getFileNameAudio($params) {
        $procedure = 'getFileNameAudio';
        $result = $this->execProcedure($procedure, $params);
        $file = $this->_result_obj();
        return ($result) ? $file : FALSE;
    }

    public function getFileAudioShell($idLlamada, $idGestion = null) {
        $urlDescarga = BASE_URL . URL_AUDIOS;
        // Busca el nombre del audio en la base de datos para poder descargar directamente del FTP.
        $file = $this->getFileNameAudio(array($idLlamada));
        $fileDescarga = 'SIN AUDIO';
        // Si encuentra el audio
        if (isset($file->url_grabacion) && $file->url_grabacion != 'FALSE') {

            // Busca si alguna vez ya se descargo.
            $existe = file_exists(PATH_AUDIOS . $file->url_grabacion);

            $fileDescarga = BASE_URL . URL_AUDIOS . $file->url_grabacion;
            $idGestion = !$existe;

            log_message('celiterinfo', ($existe ? 'Audio encontrado en servidor local.' : 'El audio no esta guardado en el servidor local.'));
        }

        // si no esta localmente
        if (!isset($existe) || !$existe) {
            // si tiene el nombre del audio, descarga directamente del servidor.
            if ($file && (isset($file->url_grabacion) && $file->url_grabacion != 'FALSE')) {
                $flag = 0;
                $file_dest = PATH_AUDIOS . $file->url_grabacion;
                $file_orig = FTP_CARPETA_AUDIOS . $file->url_grabacion;
                $trozos = explode(".", $file_dest);
                $extensionFileDescarga = end($trozos);
                //$download = ftp_get($conn_id, $file_dest, $file_orig, FTP_ASCII);
                $command = "wget --no-passive-ftp --user=" . FTP_USER_NAME . " --password=" . FTP_USER_PASS . " ftp://" . FTP_SERVER . ":" . $file_orig . " -P " . PATH_AUDIOS;
                $download = shell_exec($command);
                $existe = file_exists(PATH_AUDIOS . $file->url_grabacion);
            } else {

                // si no tiene el nombre del audio
                $conn_id = ftp_connect(FTP_SERVER, FTP_PORT);
                if (!$conn_id) {
                    log_message("celiterinfo", "¡La conexión FTP a " . FTP_SERVER . " ha fallado!");
                    exit();
                } else {
                    log_message("celiterinfo", "Conexion exitosa con el servidor " . FTP_SERVER, "INFO");
                    $login_result = ftp_login($conn_id, FTP_USER_NAME, FTP_USER_PASS);
                    if (!$login_result) {
                        log_message("celiterinfo", "Se intentó conectar al " . FTP_SERVER . " por el usuario" . FTP_USER_NAME);
                        exit;
                    } else {
                        log_message("celiterinfo", "Logueado exitosamente con el servidor " . FTP_SERVER . " con el user" . FTP_USER_NAME);
                    }
                }

                // descarga la lista de audios del FTP
                ftp_pasv($conn_id, FALSE);
                $flag = 1;
                $this->benchmark->mark('fileFtp_start');
                $contents = ftp_nlist($conn_id, "/MONITOREO/");
                $this->benchmark->mark('fileFtp_end');
                log_message("celiterinfo", "Se obtuvo la lista de grabaciones, tiempo transcurrido: " . $this->benchmark->elapsed_time('fileFtp_start', 'fileFtp_end') . ' seg.');

                // recorre la lista de archivos y busca el audio por su unique ID
                foreach ($contents as $key => $value) {

                    // si encuentra el audio, descarga el archivo
                    if (strpos($value, "-" . $idLlamada . "-")) { // 2753625
                        $file = substr($value, 11);
                        $file_orig = FTP_CARPETA_AUDIOS . $file;
                        $trozos = explode(".", $file_orig);
                        $extensionFileDescarga = end($trozos);
                        $file_dest = PATH_AUDIOS . $file;
                        $command = "wget --no-passive-ftp --user=" . FTP_USER_NAME . " --password=" . FTP_USER_PASS . " ftp://" . FTP_SERVER . ":" . $file_orig . " -P " . PATH_AUDIOS;
                        $download = shell_exec($command);
                        $existe = file_exists(PATH_AUDIOS . $file);
                        $fileDescarga = $urlDescarga . $file;
                        log_message("celiterinfo", "Se encontro el audio, resultado de la descarga: " . $download . " resultado del 'file_exists': " . $existe . " Ubicacion del archivo: " . $fileDescarga);
                        break;
                    } else {
                        // si no encuentra, no pasa nada.
                        $file = false;
                        $file_dest = PATH_AUDIOS . $file;
                        $file_orig = FTP_CARPETA_AUDIOS . $file;
                        $existe = FALSE;
                    }
                }
                log_message("celiterinfo", "Termina de buscar en la lista de audios, resultado: " . $existe);
                ftp_close($conn_id);
                log_message("celiterinfo", "Conexión ftp " . FTP_SERVER . " cerrada");
            }

            // si no encuentra el audio o no descargo, intenta $i veces mas
            if (is_string($file) || (isset($file->url_grabacion) && $file->url_grabacion != 'FALSE')) {

                $i = 1;  //cantidad de intentos
                while (($i <= 5) && (!$existe)) {  //INTENTO Q SINCRONICE HASTA 5 VECES
                    $trozos = explode(".", $file_dest);
                    $extensionFileDescarga = end($trozos);
                    $command = "wget --no-passive-ftp --user=" . FTP_USER_NAME . " --password=" . FTP_USER_PASS . " ftp://" . FTP_SERVER . ":" . $file_orig . " -P " . PATH_AUDIOS;
                    $download = shell_exec($command);
                    $existe = file_exists(PATH_AUDIOS . $file->url_grabacion);
                    //$fileDescarga = rename(PATH_AUDIOS . $file, PATH_AUDIOS . $nombreFileDescarga . '.' . $extensionFileDescarga);
                    $i++;
                    if (!$existe) {

                        log_message("celiterinfo", "Archivo " . (($flag && is_string($file)) ? $file : (isset($file->url_grabacion) ? $file->url_grabacion : '')) . " no encontrado");
                    }
                    sleep(1);
                }
                if ($existe) {
                    log_message("celiterinfo", "Archivo " . (($flag && is_string($file)) ? $file : (isset($file->url_grabacion) ? $file->url_grabacion : '')) . " desacargado exitosamente al servidor " . FTP_SERVER);
//                    log_message("celiterinfo", "se eliminó: " . (($flag && is_string($file)) ? $file : $file->url_grabacion));
                }
            } else {
                $existe = FALSE;
                log_message("celiterinfo", "Archivo " . (($flag && is_string($file)) ? $file : (isset($file->url_grabacion) ? $file->url_grabacion : '') ) . " levantado exitosamente al servidor " . FTP_SERVER);
//                log_message("celiterinfo", "se eliminó: " . (($flag && is_string($file)) ? $file : $file->url_grabacion));
            }



            // si descargo y el proceso se cumplio correctamente, actualiza el nombre del audio para buscar directamente por el nombre la proxima vez

            if (isset($existe) && $existe) {
                ($idGestion && is_string($file)) ? $this->updUrlAudioByIdGestion(array($idGestion, $file)) : '';
                $this->benchmark->mark('getFileAudioFtp_end');
                log_message("celiterinfo", "Proceso recupera audio completo, tiempo transcurrido: " . $this->benchmark->elapsed_time('getFileAudioFtp_start', 'getFileAudioFtp_end') . ' seg.');
                return $fileDescarga;
            } else {
                $this->benchmark->mark('getFileAudioFtp_end');
                log_message("celiterinfo", "Proceso recupera audio completo, tiempo transcurrido: " . $this->benchmark->elapsed_time('getFileAudioFtp_start', 'getFileAudioFtp_end') . ' seg.');
                return FALSE;
            }
        }
        return $fileDescarga;
    }

    /**
     * Actualiza el nombre del audio en la tabla gestion
     * @param Array $param Array(idGestion, VnameAudio)
     * @return Boolean
     */
    public function updUrlAudioByIdGestion($param) {

        $call = $this->execProcedure('updNameAudioByIdGestion', $param);

        return ($call === TRUE);
    }

    public function importaBaseNeotel($idCampana) {

        $idCampanaNeotel = $this->getIdCampanaNeotel(array($idCampana));
        $url = "http://172.30.2.63/neoapi/webservice.asmx?wsdl";
        $Client_nusoap = new SoapClient($url, array("trace" => 1, "exception" => 0));

        $params = [
            'idTask' => '13',
            'param1' => $idCampanaNeotel->idPbxExterno
        ];
        try {
            $row = $Client_nusoap->ExecuteTask01($params);
        } catch (Exception $exc) {
            $row = "MESSAGE=" . $exc->getMessage() . "|STATUS=0";
            $exc->getTraceAsString();
        }
        return $row;
    }

    public function getIdCampanaNeotel($params) {
        $procedure = 'getIdCampanaNeotel';
        $result = $this->execProcedure($procedure, $params);
        $file = $this->_result_obj();
        return ($result) ? $file : FALSE;
    }

    public function getDataxml($params) {
        $procedure = 'getBaseNeotelByIdCuenta';
        $result = $this->execProcedure($procedure, $params);
        $file = $this->_result_obj();
        return ($result) ? $file : FALSE;
    }

    public function agendarNeotel($params) {

        $markingType = isset($params[13]) ? $params[13] : '';
        if ($markingType == '0') {
            unset($params[3]);
            unset($params[4]);
            unset($params[9]);
            unset($params[10]);
            unset($params[13]);
        } else {
            unset($params[14]);
            unset($params[15]);
            unset($params[16]);
        }
        $idCampana = $this->getIdCampanaNeotel(array($params[1]));
        $url = "http://172.30.2.63/neoapi/webservice.asmx?wsdl";
        $Client_nusoap = new SoapClient($url, array("trace" => 1, "exception" => 0));

        $dataXml = $this->getDataxml(array($params[0], $params[1], $params[2]));
        $xmlHeader = "<ROOT>";
        $xmlFooter = "</ROOT>";
        $xmlContent = "";
//        foreach ($dataXml as $value) {
        $xmlContent.="<ROW><FIELD>telTELEFONO1</FIELD><VALUE>" . $dataXml->telefono1 . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>telTELEFONO2</FIELD><VALUE>" . $dataXml->telefono2 . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>telTELEFONO3</FIELD><VALUE>" . $dataXml->telefono3 . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>telTELEFONO4</FIELD><VALUE>" . $dataXml->telefono4 . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>telTELEFONO5</FIELD><VALUE>" . $dataXml->telefono5 . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>telTELEFONO6</FIELD><VALUE>" . $dataXml->telefono6 . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>telTELEFONO7</FIELD><VALUE>" . $dataXml->telefono7 . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>telTELEFONO8</FIELD><VALUE>" . $dataXml->telefono8 . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>intIDCUENTA</FIELD><VALUE>" . $dataXml->id_cuenta . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>intIDCLIENTE</FIELD><VALUE>" . $dataXml->id_cliente . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>intIDCAMPANA</FIELD><VALUE>" . $dataXml->id_campana . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>txtNOMBRE</FIELD><VALUE>" . $dataXml->nombre . "</VALUE></ROW>";
        $xmlContent.="<ROW><FIELD>txtAPELLIDO</FIELD><VALUE>" . $dataXml->apellido . "</VALUE></ROW>";
        // }
        $xml = $xmlHeader . $xmlContent . $xmlFooter;

        //$fecha_agenda = DateTime::createFromFormat('Y-m-d H:i:s', $params[5] . " " . $params[7]);
        $fecha_agenda = $params[5] . "T" . $params[7];

        $params = [
            'CRM' => "2",
            'USUARIO' => $params[13], //acd de neotel
            'BASE' => $idCampana->idPbxExterno, //aqui va campaña de neotel
            'IDCONTACTO' => $params[2], //aqui va el idcontacto de neotel si hay, de lo contradio va el id cuenta de celiter
            'DATA' => $params[2], //id cuenta de celiter
            'SUBCATEGORIA' => "26", //la tipificacion de agendado
            'XML_UPDATE' => $xml, // el xml que va a insertar en caso de que no exista aun el IDCONTACTO
            'AGENDA' => TRUE,
            'FECHA_AGENDA' => $fecha_agenda, //debe ser datetime 0000-00-00 00:00:00
            'USUARIO_AGENDA' => $params[11], // va el usuario a quien le va agendar o **** si es para cualquiera 
            'TEL_AGENDA' => $params[4]
        ];
        try {
            $row = $Client_nusoap->UpdateContact($params);
        } catch (Exception $exc) {
            $row = "MESSAGE=" . $exc->getMessage() . " Parametros enviados: " . json_encode($params) . "|STATUS=0";
            log_message("Error", $row);
            $exc->getTraceAsString();
        }
        return $row;
    }

    public function getPaisByCliente($params) {
        $procedure = 'getPaisByIdCliente';
        $result = $this->execProcedure($procedure, $params);
        $cant = $this->_result_obj();
        return ($result) ? $cant : FALSE;
    }

}
