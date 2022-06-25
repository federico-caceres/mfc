<?php

/**
 * Salientes 
 *
 * Aplicacion Salientes 2.0.
 *
 * @package		Modules.Empresa.models
 * @author		MTEL/SKYTEL-PARAGUAY
 * @copyright		Copyright (c) 2012 - 2015, SKYTEL.
 * @license		http://salientes_2.0/user_guide/license.html
 * @link		http://salientes_2.0
 * @since		Version 2.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Modelo del paquete Empresa.
 *
 * Esta clase es una entidad que gestiona toda la informacion desde la BD.
 * 
 * @package		Modules.Cliente.models
 * @subpackage          M_Cliente
 * @category            Models
 * @author		MTEL/SKYTEL-PARAGUAY  Team Juan Vallejos 
 * @link		http://salientes_2.0/user_guide/modules/cliente/Cliente.html
 */
class M_Cliente extends M_general {

    public function __construct() {
        parent::__construct();
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function getCliente($params) {
        $procedure = 'get_cliente';
        return ($this->execProcedure($procedure, $params)) ? $this->_result_obj() : FALSE;
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function getClientelst($params) {
        $procedure = 'get_cliente1';
        return ($this->execProcedure($procedure, $params)) ? $this->_result_all_obj() : FALSE;
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description: Selecciona las campañas del cliente proporcionado
     */

    public function getCampanalst($params) {
        $procedure = 'get_campanas';
        $call = $this->execProcedure($procedure, $params);
        $result = $this->_result_all_obj();
        return ($call) ? $result : FALSE;
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description: Selecciona las campañas del cliente proporcionado
     */

    public function getCampana($params) {
        $procedure = 'get_campanas_byIDCliente';
        $call = $this->execProcedure($procedure, $params);
        $result = $this->_result_all_obj();
        return ($call) ? $result : FALSE;
    }

    public function ins_campana($params) {
        $procedure = 'ins_campana';
        $call = $this->execProcedure($procedure, $params);
        return ($call) ? TRUE : FALSE;
    }

    public function getMarcador($params) {
        $procedure = 'getMarcador';
        $call = $this->execProcedure($procedure, $params);
        $result = $this->_result_obj();
        return ($call) ? $result : FALSE;
    }

    public function getIdCampanaPBX($params) {
        $procedure = 'getCampanaPbx';
        $call = $this->execProcedure($procedure, $params);
        $result = $this->_result_obj();
        return ($call) ? $result : FALSE;
    }

    public function getPrefijoPais($params) {
        $procedure = 'getPrefijoPais';
        $call = $this->execProcedure($procedure, $params);
        $result = $this->_result_obj();
        return ($call) ? $result : FALSE;
    }

    public function getOnWhatsapp($params) {
        $procedure = 'getOnWhatsapp';
        $call = $this->execProcedure($procedure, $params);
        $result = $this->_result_obj();
        return ($call) ? $result : FALSE;
    }

    public function returnSelectCampana($data, $userdata) {
        $data_select = array();
        $c = count($userdata);
        $userdata = $userdata ? $userdata : [];
        foreach ($userdata as $key => $value) {
            if ($value->id_cuenta == $data) {

                $aux = new stdClass();
                $aux->id = $value->id_servicio;
                $aux->name = $value->servicio;
                $aux->id_rolSSO = $value->id_rol;
                $marcador = $this->getMarcador(array($value->id_servicio));
                $aux->marcador = $marcador ? $marcador->marcador : '';
                $idCampanaPBX = $this->getIdCampanaPBX(array($value->id_servicio));
                $aux->idCampanaPBX = ($idCampanaPBX->idPbxExterno === NULL) ? '0' : $idCampanaPBX->idPbxExterno;
                $prefijoPais = $this->getPrefijoPais(array($value->id_servicio));
                $aux->prefijoPais = ($prefijoPais->prefijoPais) ? $prefijoPais->prefijoPais : '';
                $onWhatsapp = $this->getOnWhatsapp(array($value->id_servicio));
                $aux->whatsapp = ($onWhatsapp->whatsapp) ? $onWhatsapp->whatsapp : '';
                // Verifica si el servicio ya fue agregado al Select
                $cargado = TRUE;
                foreach ($data_select as $key => $reg) {
                    if ($reg->id === $aux->id) {
                        $cargado = FALSE;
                    }
                }

                // Si todavia no fue ingresado, lo ingresa
                if ($cargado) {
                    $this->ins_campana(array($value->id_cuenta, $value->id_servicio, $value->servicio));
                    $data_select[] = $aux;
                }
            }
        }

        return $data_select;
    }

//    public function returnSelectBreak($data, $userdata) {
//        include '';
//        $data_select = array();
//        $c = count($userdata);
//        foreach ($userdata as $key => $value) {
//            if ($value->id_cuenta == $data) {
//
//                $aux = new stdClass();
//                $aux->id = $value->id_servicio;
//                $aux->name = $value->servicio;
//
//                // Verifica si el servicio ya fue agregado al Select
//                $cargado = TRUE;
//                foreach ($data_select as $key => $reg) {
//                    if ($reg->id === $aux->id) {
//                        $cargado = FALSE;
//                    }
//                }
//
//                // Si todavia no fue ingresado, lo ingresa
//                if ($cargado) {
//                    $data_select[] = $aux;
//                }
//            }
//        }
//
//        return $data_select;
//    }

    public function _break() {
        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/ElastixService.php';

        $elastix = new \skytel\asteriskPBX\ElastixService(IP_PBX, USER_DB_ELASTIX, PASSW_DB_ELASTIX, DB_NAME_ELASTIX);
        $result = $elastix->getBreak();
        $data_select = array();
        while ($obj = $result->fetch_object()) {
            $aux = new stdClass();
            $aux->id = $obj->id;
            $aux->name = $obj->name;

            // Verifica si el cliente ya fue agregado al Select
            $cargado = TRUE;
            foreach ($data_select as $key => $reg) {
                if ($reg->id === $aux->id) {
                    $cargado = FALSE;
                }
            }

            // Si todavia no fue ingresado, lo ingresa
            if ($cargado) {
                $data_select[] = $aux;
            }
        }
        return $data_select;
    }

    public function _breakNeotel() {

        $procedure = 'getPausas';
        $call = $this->execProcedure($procedure, '');
        $result = $this->_result_all_obj();
        return ($call) ? $result : FALSE;
    }

    public function GestionaBreak($acd, $idBreak = 0) {
        require_once CONFIG_LIBS;
        require_once 'skytel/asteriskPBX/ElastixService.php';

        $elastix = new \skytel\asteriskPBX\ElastixService(IP_PBX, USER_DB_ELASTIX, PASSW_DB_ELASTIX, DB_NAME_ELASTIX);
        $result = $elastix->getAgentStatus($acd, IP_PBX, USER_ECCP_ELASTIX, PASSW_ECCP_ELASTIX);
        $data_return = array();
        foreach ($result as $key => $value) {
            $status = $value->status;
            $error = $value->failure;
            $n = count($error);
            if ($n > 0) {
                foreach ($error as $key => $value) {
                    $code = $value->code;
                    $msg = $value->message;
                    $data_return['error'] = TRUE;
                    $data_return['code'] = $code;
                    $data_return['msg'] = $msg;
                }
            } else if ($status[0] == "offline") {
                $data_return['error'] = FALSE;
                $data_return['status'] = "offline";
                $data_return['msg'] = "El agente no esta en linea";
//            } else if ($status[0]=="oncall"){
//                $data_return['error'] = FALSE;
//                $data_return['status'] = "oncall";
//                $data_return['msg'] = "El agente se encuentra en una llamada";
            } else if ($status[0] == "online" || $status[0] == "oncall") {
                $data_return['error'] = FALSE;
                $data_return['status'] = "paused";
                $pause = $elastix->pauseAgent($acd, IP_PBX, USER_ECCP_ELASTIX, PASSW_ECCP_ELASTIX, $idBreak);
                $data_return['msg'] = "El agente se puso en break";
            } else if ($status[0] == "paused") {
                $data_return['error'] = FALSE;
                $data_return['status'] = "online";
                $unpause = $elastix->unPauseAgent($acd, IP_PBX, USER_ECCP_ELASTIX, PASSW_ECCP_ELASTIX);
                $data_return['msg'] = "El agente salió de pausa";
            }
        }

        return $data_return;
    }

    public function GestionaBreakNeotel($acd, $idBreak = 0) {
        $url = "http://172.30.2.63/neoapi/webservice.asmx?wsdl";
        $Client_nusoap = new SoapClient($url, array("trace" => 1, "exception" => 0));

        $params = [
            'USUARIO' => $acd,
            'SUBTIPO_DESCANSO' => $idBreak
        ];
        try {
            $row = $Client_nusoap->Pause($params);
            $data_return['error'] = FALSE;
            $data_return['status'] = "paused";
            $data_return['msg'] = "El agente se puso en break";
        } catch (Exception $exc) {
            $data_return['error'] = TRUE;
            $data_return['status'] = "online";
            $data_return['msg'] = $exc->getMessage();
            $exc->getTraceAsString();
        }
        return $data_return;
    }

    public function unBreakNeotel($acd) {
        $url = "http://172.30.2.63/neoapi/webservice.asmx?wsdl";
        $Client_nusoap = new SoapClient($url, array("trace" => 1, "exception" => 0));

        $params = [
            'USUARIO' => $acd
        ];
        try {
            $row = $Client_nusoap->Unpause($params);
            $data_return['error'] = FALSE;
            $data_return['status'] = "online";
            $data_return['msg'] = "El agente salió de break";
        } catch (Exception $exc) {
            $data_return['error'] = TRUE;
            $data_return['status'] = "paused";
            $data_return['msg'] = $exc->getMessage();
            $exc->getTraceAsString();
        }
        return $data_return;
    }

    public function returnTipoServicio($data, $userdata) {
//        $data_select = array();
        $c = count($userdata);
        foreach ($userdata as $key => $value) {
            if ($value->id_servicio == $data) {

                $aux = new stdClass();
                $aux->idTipoServicio = $value->id_tipo_servicio;
//                $aux->name = $value->servicio;
                // Verifica si el servicio ya fue agregado al Select
                $cargado = TRUE;
                break;
//                foreach ($data_select as $key => $reg) {
//                    if ($reg->id === $aux->id) {
//                        $cargado = FALSE;
//                    }
//                }
                // Si todavia no fue ingresado, lo ingresa
//                if ($cargado) {
//                    $data_select[] = $aux;
//                }
            } else {
                $aux = new stdClass();
                $aux->idTipoServicio = $data;
            }
        }

        return $aux;
    }

    public function getGmtCliente($params) {
        $procedure = 'get_gmt_cliente';
        return ($this->execProcedure($procedure, $params)) ? $this->_result_obj() : FALSE;
    }

}
