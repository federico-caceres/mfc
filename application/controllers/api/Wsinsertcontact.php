<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Wsinsertcontact extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['addContact_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['addContact_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['addContact_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->methods['addContactCola_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['addContactCola_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['addContactCola_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->methods['getGestionInfo_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['getGestionInfo_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['fileAudio_get']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['fileAudio_post']['limit'] = 100; // 100 requests per hour per user/key
    }

    public function index_get() {

        $this->load->view("indexWs");
    }

    public function textContact_get() {
        $this->load->view("textContact");
    }

    public function addContact_get() {
        // Users from a data store e.g. database
        $users = "{'data':{'success':true,'registros':[['27','41','','546321','Prueba de curso','prueba apellido','casado','M','2000-05-12','55','','Alta','1111','','','','','','','','','','','','','','981119973','','','','','','','','','','','','','',['0',1],[{'titulo':'pruaba1','info':'datos1'},{'titulo':'pruaba2','info':'datos2'}]]],'error':'Datos correctos'}}";

        $id = $this->input->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0) {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users)) {
            foreach ($users as $key => $value) {
                if (isset($value['id']) && $value['id'] === $id) {
                    $user = $value;
                }
            }
        }

        if (!empty($user)) {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function fileAudio_get() {
        $idLlamada = $this->input->get('idLlamada');
        $idGestion = $this->input->get('idGestion');
        //$urlDestino = $this->input->get('urlDestino');
        //$telefono = $this->input->get('telefono');
        //$urlValido = (file_exists($urlDestino)) ? TRUE : $this->__url_exists($urlDestino) ? TRUE : FALSE;


        $audioFile = FALSE;

        if ($idLlamada == NULL || strtoupper($idLlamada) == "NULL" || $idLlamada == "0" || $idLlamada == "") {
            $message = [
                'idLlamada' => $idLlamada,
                'audioFile' => $audioFile,
                'message' => 'El idLlamada es obligatorio..'
            ];
            $this->set_response($message, REST_Controller::HTTP_PARTIAL_CONTENT);
//        } 
////        else if (!$urlValido) {
////            $message = [
////                'idLlamada' => $idLlamada,
////                'audioFile' => $audioFile,
////                'message' => 'La url proveida es nula o incorrecta..'
////            ];
////            $this->set_response($message, REST_Controller::HTTP_PARTIAL_CONTENT);
        } else {
            //$audioFile = $this->__getFileAudioFtp($idLlamada);
            $audioFile = $this->m_general->getFileAudioShell($idLlamada, $idGestion);
            if (filter_var(trim($audioFile), FILTER_VALIDATE_URL)) {
                $message = [
                    'idLlamada' => $idLlamada,
                    'audioFile' => $audioFile,
                    'message' => 'El audio fue encontrado exitosamente'
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'idLlamada' => $idLlamada,
                    'audioFile' => $audioFile,
                    'message' => 'No fue encontrado audio para el IdLlamada ' . $idLlamada
                ];
                $this->set_response($message, REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        }
    }

    public function addContact_post(){

        try {
            log_message("celiterinfo", "Empieza WS - " . date("Y-m-d H:i:s"));
            $datos = $this->post('idCliente');
            $datosInfo = "No se recibieron datos por POST";
            if (isset($datos)) {
                $idCliente = ($this->post('idCliente')) ? $this->post('idCliente') : "";
                $idCampana = ($this->post('idCampana')) ? $this->post('idCampana') : "";
                $codeCliente = ($this->post('codeCliente')) ? $this->post('codeCliente') : "";
                $nroDoc = ($this->post('nroDoc')) ? $this->post('nroDoc') : "";
                $apellido = ($this->post('apellido')) ? $this->post('apellido') : "";
                $nombre = ($this->post('nombre')) ? $this->post('nombre') : "";
                $estadoCivil = ($this->post('estadoCivil')) ? $this->post('estadoCivil') : "";
                $sexo = ($this->post('sexo')) ? $this->post('sexo') : "";
                $fechaNac = ($this->post('fechaNac')) ? $this->post('fechaNac') : "-1";
                $edad = ($this->post('edad')) ? $this->post('edad') : "";
                $profesion = ($this->post('profesion')) ? $this->post('profesion') : "";
                $segmento = ($this->post('segmento')) ? $this->post('segmento') : "";
                $shot = ($this->post('shot')) ? $this->post('shot') : "0";
                $tarjeta = ($this->post('tarjeta')) ? $this->post('tarjeta') : "";
                $nroTarjeta = ($this->post('nroTarjeta')) ? $this->post('nroTarjeta') : "";
                $vtoTarjeta = ($this->post('vtoTarjeta')) ? $this->post('vtoTarjeta') : "";
                $calle = ($this->post('calle')) ? $this->post('calle') : "";
                $nroCasa = ($this->post('nroCasa')) ? $this->post('nroCasa') : "";
                $piso = ($this->post('piso')) ? $this->post('piso') : "";
                $dpto = ($this->post('dpto')) ? $this->post('dpto') : "";
                $localidad = ($this->post('localidad')) ? $this->post('localidad') : "";
                $ciudad = ($this->post('ciudad')) ? $this->post('ciudad') : "";
                $barrio = ($this->post('barrio')) ? $this->post('barrio') : "";
                $codPostal = ($this->post('codPostal')) ? $this->post('codPostal') : "";
                $provincia = ($this->post('provincia')) ? $this->post('provincia') : "";
                $prefijoTel1 = ($this->post('prefijoTel1')) ? $this->post('prefijoTel1') : "";
                $telefono1 = ($this->post('telefono1')) ? $this->post('telefono1') : "";
                $prefijoTel2 = ($this->post('prefijoTel2')) ? $this->post('prefijoTel2') : "";
                $telefono2 = ($this->post('telefono2')) ? $this->post('telefono2') : "";
                $prefijoTel3 = ($this->post('prefijoTel3')) ? $this->post('prefijoTel3') : "";
                $telefono3 = ($this->post('telefono3')) ? $this->post('telefono3') : "";
                $prefijoTel4 = ($this->post('prefijoTel4')) ? $this->post('prefijoTel4') : "";
                $telefono4 = ($this->post('telefono4')) ? $this->post('telefono4') : "";
                $prefijoTel5 = ($this->post('prefijoTel5')) ? $this->post('prefijoTel5') : "";
                $telefono5 = ($this->post('telefono5')) ? $this->post('telefono5') : "";
                $prefijoTel6 = ($this->post('prefijoTel6')) ? $this->post('prefijoTel6') : "";
                $telefono6 = ($this->post('telefono6')) ? $this->post('telefono6') : "";
                $correo1 = ($this->post('correo1')) ? $this->post('correo1') : "";
                $correo2 = ($this->post('correo2')) ? $this->post('correo2') : "";
                $obsCuenta = ($this->post('obsCuenta')) ? $this->post('obsCuenta') . " - WS" : "WS";
                $Adicionales = ($this->post('Adicionales')) ? $this->post('Adicionales') : array();
                
                for ($reg = 1; $reg <= count($Adicionales); $reg++) {
                    $datos_adicionalesTitulos = array();
                    $datos_adicionalesInfos = array();
                    $datos_adicionales = array();
                    for ($a = 0; $a < count($Adicionales); $a++) {
                        $aux = new stdClass();
                        $aux->titulo = $Adicionales[$a]['titulo'];
                        $aux->info = $Adicionales[$a]['info'];
                        $datos_adicionales[] = $aux;
                        $datos_adicionalesTitulos[] = $Adicionales[$a]['titulo'];
                        $datos_adicionalesInfos[] = $Adicionales[$a]['info'];
                    }
                }

                $datos_adicionalesTitulos = isset($datos_adicionalesTitulos) ? $datos_adicionalesTitulos : array();
                $datos_adicionalesInfos = isset($datos_adicionalesInfos) ? $datos_adicionalesInfos : array();
                $titulos = implode(';', $datos_adicionalesTitulos);
                $adicional = implode(';', $datos_adicionalesInfos);

                $datosTitulos = "codecliente; nro_doc; apellido; nombre; estado_civil; sexo; fecha_nac; edad; profesion; segmento; shot; tarjeta; nro_tarjeta; vto_tarjeta; calle; nro_casa; piso; depto; localidad; ciudad; barrio; cod_postal; provincia; prefijo_tel_1; telefono_1; prefijo_tel_2; telefono_2; prefijo_tel_3; telefono_3; prefijo_tel_4; telefono_4; prefijo_tel_5; telefono_5; prefijo_tel_6; telefono_6; correo1; correo2; obs_cuenta; " . $titulos;

                $datosInfo = "$codeCliente; $nroDoc; $apellido; $nombre; $estadoCivil; $sexo; $fechaNac; $edad; $profesion; $segmento; $shot; $tarjeta; $nroTarjeta; $vtoTarjeta; $calle; $nroCasa; $piso; $dpto; $localidad; $ciudad; $barrio; $codPostal; $provincia; $prefijoTel1; $telefono1; $prefijoTel2; $telefono2; $prefijoTel3; $telefono3; $prefijoTel4; $telefono4; $prefijoTel5; $telefono5; $prefijoTel6; $telefono6; $correo1; $correo2; $obsCuenta; $adicional";

                $errores = array();

                $tieneTelefono = ($telefono1 || $telefono2 || $telefono3 || $telefono4 || $telefono5 || $telefono6);
                if ($nroDoc == "" || count($nroDoc) <= 0 || $nroDoc == "Null") {
                    $resultado = array(
                        'success' => FALSE,
                        'registros' => $datosInfo,
                        'error' => 'El nro de documento es obligatorio'
                    );
                    //echo json_encode($resultado);                    
                    $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT); // (422)
                } else if (!$tieneTelefono && $idCampana != '41') {
                    $resultado = array(
                        'success' => FALSE,
                        'registros' => $datosInfo,
                        'error' => 'El nro de telefono es obligatorio'
                    );

                    $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT); // (422)
                } else {
                    log_message("celiterinfo", "Empieza a procesar WS - " . date("Y-m-d H:i:s"));
                    $this->load->model("csv/m_csv");
                    $procesaTitulos = $this->m_csv->procesarBasePost($datosTitulos, $idCliente, $idCampana);
                    $errores[] = $procesaTitulos['error'];
                    if (!$procesaTitulos['error']) {
                        $procesaInfo = $this->m_csv->procesarBasePost($datosInfo, $idCliente, $idCampana);
                    } else {
                        $resultado = array(
                            'success' => FALSE,
                            'registros' => $datosInfo,
                            'error' => 'Titulos incorrectos'
                        );
                    }
                    $errores[] = $procesaInfo['error'];

                    if (!$procesaInfo['error']) {

                        $registrosWS = array($idCliente, $idCampana, $codeCliente, $nroDoc, $apellido, $nombre, $estadoCivil, $sexo, $fechaNac, $edad, $profesion, $segmento, $shot, $tarjeta, $nroTarjeta
                            , $vtoTarjeta, $calle, $nroCasa, $piso, $dpto, $localidad, $ciudad, $barrio, $codPostal, $provincia, $prefijoTel1, $telefono1, $prefijoTel2
                            , $telefono2, $prefijoTel3, $telefono3, $prefijoTel4, $telefono4, $prefijoTel5, $telefono5, $prefijoTel6, $telefono6, $correo1, $correo2, $obsCuenta, $errores, $datos_adicionales);
                        $registros = array($registrosWS);
                        log_message("celiterinfo", "Empieza a proceso de levanta base WS - " . date("Y-m-d H:i:s") . " registro recibido: " . json_encode($registrosWS));
                        $levanta = $this->m_csv->levanta_a_base($registros, TRUE);
                        $errores = $levanta['error'];
                        if ($errores) {
                            $resultado = array(
                                'success' => FALSE,
                                'registros' => json_encode($levanta['registros']),
                                'error' => isset($levanta['msg']) ? $levanta['msg'] : 'Error no identificado'
                            );
                            $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT);
                        } else {
//                        if ($insertaCola) {
//                            $resultado = array(
//                                'success' => TRUE,
//                                'registros' => $levanta['registros'],
//                                'error' => 'Datos correctos'
//                            );
//                        } else {
                            $resultado = array(
                                'success' => TRUE,
                                'registros' => json_encode($levanta['registros']),
                                'error' => 'Datos correctos en base'
                            );
// }
                            log_message("celiterinfo", "Registro insertado desde WS: " . json_encode($registros));
                            $this->set_response($resultado, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
                        }
                    } else {
                        $resultado = array(
                            'success' => FALSE,
                            'registros' => $datosInfo,
                            'error' => 'Datos incorrectos'
                        );
                        $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT);
                    }
//                    $this->set_response($resultado, REST_Controller::HTTP_CONFLICT); // CREATED (201) being the HTTP response code
                }
            } else {
                $resultado = array(
                    'success' => FALSE,
                    'registros' => $datosInfo,
                    'error' => 'Datos incorrectos'
                );
                $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT); // CREATED (201) being the HTTP response code
            }
        } catch (Exception $exc) {
            log_message("error", "error en el webservice de insercion de base: " . $exc->getTraceAsString());
            //echo $exc->getTraceAsString();
            $this->set_response($exc->getTraceAsString(), REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // CREATED (201) being the HTTP response code
        }
    }

       public function formatNumero($localidad, $tipoTel, $telefono, $prefijo){
            $this->load->model("csv/m_csv");
            $numero ="";
            
            if($cero = substr($telefono,0,1) == "0"){
                $telefono = substr($telefono,strlen($cero), strlen($telefono));
            }elseif(substr($telefono,0,1) == "+"){
                $telefono = substr($telefono,1, strlen($telefono));
            }
            
            if(substr($telefono, 0,2)  == "54" && strlen($telefono) == 14){
                $telefono = substr($telefono,2, strlen($telefono)); 
            }elseif(substr($telefono, 0,3)  == "549" && strlen($telefono) == 15){
                $telefono = substr($telefono,3, strlen($telefono)); 
            }elseif(substr($telefono, 0,2)  == "54" && strlen($telefono) == 12){
                $telefono = substr($telefono,2, strlen($telefono)); 
            }elseif(substr($telefono, 0,3)  == "549" && strlen($telefono) == 13){
                $telefono = substr($telefono,3, strlen($telefono)); 
            }
                
            if(is_numeric(trim($localidad))){
               $prefijo = $localidad; 
            }
            
            if(!is_numeric($tipoTel)){
                ($tipoTel == "Celular") ? $tipoTel = "1" : $tipoTel = "0";
            }

            if(strlen($telefono) == 10){
                if($tipoTel !="1"){
                    $telefono = $telefono; 
                }
            }elseif(strlen($telefono) > 10){
                if(strlen($telefono) > 12){
                    $telefono = substr($telefono, strlen($telefono) - 10,strlen($telefono));
                }elseif(strlen($telefono) == 12){
                    $numero = $telefono;
                    return $numero;
                }
            }elseif(strlen($telefono) < 10 && $prefijo == "" && $prefijo !="0"){
               // echo "Numero Menor a 10";
                if(substr($telefono, 0,2) == "15" && $tipoTel == "1"){
                    if(strlen($telefono) - 2 >= 8){//YA TIENE EL 15 y SERIA UN NUMERO VALIDO
                        $telefono = $telefono;
                    }
                }else{
                    return false;
                }
            }elseif(strlen($telefono) < 10 && $prefijo != "" && $prefijo !="0"){
                if(substr($telefono, 0,2) == "15" && $tipoTel == "1"){
                    if(strlen($telefono) - 2 <= 8){//YA TIENE EL 15 y SERIA UN NUMERO VALIDO
                        return $prefijo.$telefono;
                    }
                }else{
                    $telefono = $prefijo.$telefono;
                }
            }else{
                return false;
            }
            
            $codTipo = ($tipoTel== "1") ? "15" : "";
            if($prefijo !="" && $prefijo !="0"){
                //validar prefijo
                $telefono = substr($telefono, strlen($prefijo), strlen($telefono)); 
                $numero = $prefijo.$codTipo.$telefono;
            }else{

                if(isset($localidad)){
                    //buscar codigo por localidad y provincia
                    if($arr = $this->m_csv->getPrefijoLocalidad($localidad)){
                        $prefijo = $arr[0]->codigo;
                    }else{
                        //echo "Error! No se encuentra localidad.";
                        $prefijo = "";
                    }
                    //SI PROVEE EL CODIGO -> BUSCAR EN LA CADENA Y VER SI EXISTE
                    if($prefijo != ""){
                        $pos = strpos($telefono, $prefijo);
                        if($pos !== false){//si existe entonces formar el numero
                           $telefono = substr($telefono, strlen($prefijo), strlen($telefono)); 
                            $numero = $prefijo.$codTipo.$telefono;
                        }else{
                            //echo "Error! El prefijo no corresponde a la Localidad!.";
                            $numero = $this->prefijoCadena($telefono, $codTipo);
                        }
                    }else{
                        //echo "Busqueda manual";
                       $numero = $this->prefijoCadena($telefono, $codTipo);
                    }
                }else{
                    $numero = $this->prefijoCadena($telefono, $codTipo);
                }
            }

        return $numero;
    }
    public function prefijoCadena($telefono, $tipo){
        $this->load->model("csv/m_csv");
        $prefijo ="";
        $numero ="";
        //busqueda manual del cod. area
            //BUSCAR LOS PRIMERO 3 digitos en la BD, sino existe continuar a los primeros 4 o el 11 solo
            if(strlen($telefono) == 10 && substr($telefono,0,2) == "11"){//buenos aires
               $prefijo = "11";	
            }else{
                $p3 = substr($telefono,0,3);
                if($arr_prefix3 = $this->m_csv->getPrefijoCodigo($p3)){
                    $prefijo = $arr_prefix3[0]->codigo;
                }else{
                    $p4 = substr($telefono,0,4);
                    if($arr_prefix4 = $this->m_csv->getPrefijoCodigo($p4)){
                        $prefijo = $arr_prefix4[0]->codigo;
                    }else{
                        return false;
                    }
                }
            }
        $telefono = substr($telefono, strlen($prefijo), strlen($telefono)); 
        $numero = $prefijo.$tipo.$telefono;
        return $numero;
    }
    
    public function addContactCobranzas_post() {

        try {
            log_message("celiterinfo", "Empieza WS - " . date("Y-m-d H:i:s"));
            $datos = $this->post('idCliente');
            $datosInfo = "No se recibieron datos por POST";
            if (isset($datos)) {
                $idCliente = ($this->post('idCliente')) ? $this->post('idCliente') : "";
                $idCampana = ($this->post('idCampana')) ? $this->post('idCampana') : "";
                $codeCliente = ($this->post('codeCliente')) ? $this->post('codeCliente') : "";
                $nroDoc = ($this->post('nroDoc')) ? $this->post('nroDoc') : "";
                $apellido = ($this->post('apellido')) ? $this->post('apellido') : "";
                $nombre = ($this->post('nombre')) ? $this->post('nombre') : "";
                $estadoCivil = ($this->post('estadoCivil')) ? $this->post('estadoCivil') : "";
                $sexo = ($this->post('sexo')) ? $this->post('sexo') : "";
                $fechaNac = ($this->post('fechaNac')) ? $this->post('fechaNac') : "-1";
                $edad = ($this->post('edad')) ? $this->post('edad') : "";
                $profesion = ($this->post('profesion')) ? $this->post('profesion') : "";
                $segmento = ($this->post('segmento')) ? $this->post('segmento') : "";
                $shot = ($this->post('shot')) ? $this->post('shot') : "0";
                $tarjeta = ($this->post('tarjeta')) ? $this->post('tarjeta') : "";
                $nroTarjeta = ($this->post('nroTarjeta')) ? $this->post('nroTarjeta') : "";
                $vtoTarjeta = ($this->post('vtoTarjeta')) ? $this->post('vtoTarjeta') : "";
                $calle = ($this->post('calle')) ? $this->post('calle') : "";
                $nroCasa = ($this->post('nroCasa')) ? $this->post('nroCasa') : "";
                $piso = ($this->post('piso')) ? $this->post('piso') : "";
                $dpto = ($this->post('dpto')) ? $this->post('dpto') : "";
                $localidad = ($this->post('localidad')) ? $this->post('localidad') : "";
                $ciudad = ($this->post('ciudad')) ? $this->post('ciudad') : "";
                $barrio = ($this->post('barrio')) ? $this->post('barrio') : "";
                $codPostal = ($this->post('codPostal')) ? $this->post('codPostal') : "";
                $provincia = ($this->post('provincia')) ? $this->post('provincia') : "";
                $prefijoTel1 = ($this->post('prefijoTel1')) ? $this->post('prefijoTel1') : "";
                $telefono1 = ($this->post('telefono1')) ? $this->post('telefono1') : "";
                $prefijoTel2 = ($this->post('prefijoTel2')) ? $this->post('prefijoTel2') : "";
                $telefono2 = ($this->post('telefono2')) ? $this->post('telefono2') : "";
                $prefijoTel3 = ($this->post('prefijoTel3')) ? $this->post('prefijoTel3') : "";
                $telefono3 = ($this->post('telefono3')) ? $this->post('telefono3') : "";
                $prefijoTel4 = ($this->post('prefijoTel4')) ? $this->post('prefijoTel4') : "";
                $telefono4 = ($this->post('telefono4')) ? $this->post('telefono4') : "";
                $prefijoTel5 = ($this->post('prefijoTel5')) ? $this->post('prefijoTel5') : "";
                $telefono5 = ($this->post('telefono5')) ? $this->post('telefono5') : "";
                $prefijoTel6 = ($this->post('prefijoTel6')) ? $this->post('prefijoTel6') : "";
                $telefono6 = ($this->post('telefono6')) ? $this->post('telefono6') : "";
                $correo1 = ($this->post('correo1')) ? $this->post('correo1') : "";
                $correo2 = ($this->post('correo2')) ? $this->post('correo2') : "";
                $obsCuenta = ($this->post('obsCuenta')) ? $this->post('obsCuenta') . " - WS" : "WS";

                $id_tramo = ($this->post('correo2')) ? $this->post('correo2') : "";
                $moneda = ($this->post('correo2')) ? $this->post('correo2') : "";
                $deuda_total = ($this->post('correo2')) ? $this->post('correo2') : "";
                $meses = ($this->post('correo2')) ? $this->post('correo2') : "";
                $fec_ult_pag = ($this->post('correo2')) ? $this->post('correo2') : "";
                $vencimiento_deuda = ($this->post('correo2')) ? $this->post('correo2') : "";
                $descuento = ($this->post('correo2')) ? $this->post('correo2') : "";
                $id_fraccion = ($this->post('correo2')) ? $this->post('correo2') : "";
                $id_manzana = ($this->post('correo2')) ? $this->post('correo2') : "";
                $id_lote = ($this->post('correo2')) ? $this->post('correo2') : "";
                $tipo_fraccion = ($this->post('correo2')) ? $this->post('correo2') : "";
                $zona = ($this->post('correo2')) ? $this->post('correo2') : "";

                $code_producto = $id_fraccion . '-' . $id_manzana . '-' . $id_lote . '-' . $id_tramo;

                $Adicionales = ($this->post('Adicionales')) ? $this->post('Adicionales') : array();

                for ($reg = 1; $reg <= count($Adicionales); $reg++) {
                    $datos_adicionalesTitulos = array();
                    $datos_adicionalesInfos = array();
                    $datos_adicionales = array();
                    for ($a = 0; $a < count($Adicionales); $a++) {
                        $aux = new stdClass();
                        $aux->titulo = $Adicionales[$a]['titulo'];
                        $aux->info = $Adicionales[$a]['info'];
                        $datos_adicionales[] = $aux;
                        $datos_adicionalesTitulos[] = $Adicionales[$a]['titulo'];
                        $datos_adicionalesInfos[] = $Adicionales[$a]['info'];
                    }
                }

                $detalleProducto = '[{"titulo":"id_fraccion","info":"' . $id_fraccion . '"},{"titulo":"id_manzana","info":"' . $id_manzana . '"},{"titulo":"id_lote","info":"' . $id_lote . '"},{"titulo":"tipo_fraccion","info":"' . $tipo_fraccion . '"},{"titulo":"zona","info":"' . $zona . '"}]';

                $titulos = (isset($datos_adicionalesTitulos) and $datos_adicionalesTitulos) ? implode(';', $datos_adicionalesTitulos) : '';
                $adicional = (isset($datos_adicionalesInfos) and $datos_adicionalesInfos) ? implode(';', $datos_adicionalesInfos) : '';

                $datosTitulos = "codecliente; nro_doc; apellido; nombre; estado_civil; sexo; fecha_nac; edad; profesion; segmento; shot; tarjeta; nro_tarjeta; vto_tarjeta; calle; nro_casa; piso; depto; localidad; ciudad; barrio; cod_postal; provincia; prefijo_tel_1; telefono_1; prefijo_tel_2; telefono_2; prefijo_tel_3; telefono_3; prefijo_tel_4; telefono_4; prefijo_tel_5; telefono_5; prefijo_tel_6; telefono_6; correo1; correo2; obs_cuenta; code_producto; id_tramo; moneda; deuda_total; meses; fec_ult_pag; vencimiento_deuda; descuento; id_fraccion; id_manzana; id_lote; tipo_fraccion; zona " . $titulos;
                $datosInfo = "$codeCliente; $nroDoc; $apellido; $nombre; $estadoCivil; $sexo; $fechaNac; $edad; $profesion; $segmento; $shot; $tarjeta; $nroTarjeta; $vtoTarjeta; $calle;"
                        . " $nroCasa; $piso; $dpto; $localidad; $ciudad; $barrio; $codPostal; $provincia; $prefijoTel1; $telefono1; $prefijoTel2; $telefono2; $prefijoTel3; $telefono3; $prefijoTel4;"
                        . " $telefono4; $prefijoTel5; $telefono5; $prefijoTel6; $telefono6; $correo1; $correo2; $obsCuenta; $code_producto; $id_tramo; $moneda; $deuda_total; $meses; $fec_ult_pag; $vencimiento_deuda;"
                        . " $descuento; $id_fraccion; $id_manzana; $id_lote; $tipo_fraccion; $zona ; $adicional";

                $errores = array();

                if ($nroDoc == "" || $nroDoc <= 0) {
                    $resultado['data'] = array(
                        'success' => FALSE,
                        'registros' => $datosInfo,
                        'error' => 'El nro de documento es obligatorio'
                    );

                    $this->set_response($resultado, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
                } else if ($telefono1 == "") {
                    $resultado['data'] = array(
                        'success' => FALSE,
                        'registros' => $datosInfo,
                        'error' => 'El nro de telefono es obligatorio'
                    );

                    $this->set_response($resultado, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
                } else {
                    log_message("celiterinfo", "Empieza a procesar WS - " . date("Y-m-d H:i:s"));
                    $errores[] = (count(explode(";", $datosInfo)) >= 47) ? 0 : 1;

                    if (!$errores[0]) {

                        $registrosWS = array($idCliente, $idCampana, $codeCliente, $nroDoc, $apellido, $nombre, $estadoCivil, $sexo, $fechaNac, $edad, $profesion, $segmento, $shot, $tarjeta, $nroTarjeta
                            , $vtoTarjeta, $calle, $nroCasa, $piso, $dpto, $localidad, $ciudad, $barrio, $codPostal, $provincia, $prefijoTel1, $telefono1, $prefijoTel2
                            , $telefono2, $prefijoTel3, $telefono3, $prefijoTel4, $telefono4, $prefijoTel5, $telefono5, $prefijoTel6, $telefono6, $correo1, $correo2
                            , $obsCuenta, $code_producto, $id_tramo, $moneda, $deuda_total, $meses, $fec_ult_pag, $vencimiento_deuda, $descuento, $errores, $detalleProducto, $datos_adicionales);
                        $registros = array($registrosWS);
                        log_message("celiterinfo", "Empieza a proceso de levanta base WS - " . date("Y-m-d H:i:s"));
                        $levanta = $this->m_csv->levanta_baseCobranzas($registros, 0, $idCampana); //$csvImportMode -> 0 - Actualizar Cuentas(Si existe se actualiza, sino se inserta), 1 - Insertar todas las cuentas como nuevas
                        $errores = $levanta['error'];
                        if ($errores) {
                            $resultado['data'] = array(
                                'success' => FALSE,
                                'registros' => $levanta['registros'],
                                'error' => 'Datos incorrectos'
                            );
                        } else {
                            $resultado['data'] = array(
                                'success' => TRUE,
                                'registros' => $levanta['registros'],
                                'error' => 'Datos correctos en base'
                            );
                            log_message("celiterinfo", "Registro insertado desde WS: " . json_encode($registros));
                        }
                    } else {
                        $resultado['data'] = array(
                            'success' => FALSE,
                            'registros' => $datosInfo,
                            'error' => 'Datos incorrectos'
                        );
                    }
                    $this->set_response($resultado, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
                }
            } else {
                $resultado['data'] = array(
                    'success' => FALSE,
                    'registros' => $datosInfo,
                    'error' => 'Datos incorrectos'
                );
                $this->set_response($resultado, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
            }
        } catch (Exception $exc) {
            log_message("error", "Error en el webservice de insercion de base: " . $exc->getTraceAsString());
            //echo $exc->getTraceAsString();
            $this->set_response($exc->getTraceAsString(), REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }
    }

    public function addContact_delete() {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function addContactCola_get() {
        // Users from a data store e.g. database
        $users = "{'data':{'success':true,'registros':[['27','41','','546321','Prueba de curso','prueba apellido','casado','M','2000-05-12','55','','Alta','1111','','','','','','','','','','','','','','981119973','','','','','','','','','','','','','',['0',1],[{'titulo':'pruaba1','info':'datos1'},{'titulo':'pruaba2','info':'datos2'}]]],'error':'Datos correctos'}}";

        $id = $this->input->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0) {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users)) {
            foreach ($users as $key => $value) {
                if (isset($value['id']) && $value['id'] === $id) {
                    $user = $value;
                }
            }
        }

        if (!empty($user)) {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function addContactCola_post() {

        try {
            log_message("celiterinfo", "Empieza WS - " . date("Y-m-d H:i:s"));
            $datos = $this->post('idCliente');
            $datosInfo = "No se recibieron datos por POST";
            if (isset($datos)) {
                $idCliente = ($this->post('idCliente')) ? $this->post('idCliente') : "";
                $idCampana = ($this->post('idCampana')) ? $this->post('idCampana') : "";
                $codeCliente = ($this->post('codeCliente')) ? $this->post('codeCliente') : "";
                $nroDoc = ($this->post('nroDoc')) ? $this->post('nroDoc') : "";
                $apellido = ($this->post('apellido')) ? $this->post('apellido') : "";
                $nombre = ($this->post('nombre')) ? $this->post('nombre') : "";
                $estadoCivil = ($this->post('estadoCivil')) ? $this->post('estadoCivil') : "";
                $sexo = ($this->post('sexo')) ? $this->post('sexo') : "";
                $fechaNac = ($this->post('fechaNac')) ? $this->post('fechaNac') : "-1";
                $edad = ($this->post('edad')) ? $this->post('edad') : "";
                $profesion = ($this->post('profesion')) ? $this->post('profesion') : "";
                $segmento = ($this->post('segmento')) ? $this->post('segmento') : "";
                $shot = ($this->post('shot')) ? $this->post('shot') : "0";
                $tarjeta = ($this->post('tarjeta')) ? $this->post('tarjeta') : "";
                $nroTarjeta = ($this->post('nroTarjeta')) ? $this->post('nroTarjeta') : "";
                $vtoTarjeta = ($this->post('vtoTarjeta')) ? $this->post('vtoTarjeta') : "";
                $calle = ($this->post('calle')) ? $this->post('calle') : "";
                $nroCasa = ($this->post('nroCasa')) ? $this->post('nroCasa') : "";
                $piso = ($this->post('piso')) ? $this->post('piso') : "";
                $dpto = ($this->post('dpto')) ? $this->post('dpto') : "";
                $localidad = ($this->post('localidad')) ? $this->post('localidad') : "";
                $ciudad = ($this->post('ciudad')) ? $this->post('ciudad') : "";
                $barrio = ($this->post('barrio')) ? $this->post('barrio') : "";
                $codPostal = ($this->post('codPostal')) ? $this->post('codPostal') : "";
                $provincia = ($this->post('provincia')) ? $this->post('provincia') : "";
                $prefijoTel1 = ($this->post('prefijoTel1')) ? $this->post('prefijoTel1') : "";
                $telefono1 = ($this->post('telefono1')) ? $this->post('telefono1') : "";
                $prefijoTel2 = ($this->post('prefijoTel2')) ? $this->post('prefijoTel2') : "";
                $telefono2 = ($this->post('telefono2')) ? $this->post('telefono2') : "";
                $prefijoTel3 = ($this->post('prefijoTel3')) ? $this->post('prefijoTel3') : "";
                $telefono3 = ($this->post('telefono3')) ? $this->post('telefono3') : "";
                $prefijoTel4 = ($this->post('prefijoTel4')) ? $this->post('prefijoTel4') : "";
                $telefono4 = ($this->post('telefono4')) ? $this->post('telefono4') : "";
                $prefijoTel5 = ($this->post('prefijoTel5')) ? $this->post('prefijoTel5') : "";
                $telefono5 = ($this->post('telefono5')) ? $this->post('telefono5') : "";
                $prefijoTel6 = ($this->post('prefijoTel6')) ? $this->post('prefijoTel6') : "";
                $telefono6 = ($this->post('telefono6')) ? $this->post('telefono6') : "";
                $correo1 = ($this->post('correo1')) ? $this->post('correo1') : "";
                $correo2 = ($this->post('correo2')) ? $this->post('correo2') : "";
                $obsCuenta = ($this->post('obsCuenta')) ? $this->post('obsCuenta') : "";
                $Adicionales = ($this->post('Adicionales')) ? $this->post('Adicionales') : array();
                $tipoTel = $Adicionales[0]["info"];//IMPORTANTE RECIBIR
                $this->load->model('m_general');
                $pais = $this->m_general->getPaisByCliente(array($idCliente));
                $cantTelefono = strlen($prefijoTel1 . $telefono1);
                //$cantTelefono = strlen($telefono1);
                $prefijoPais = substr($telefono1, 0, 3);     
                switch ($pais->pais) {
                    case "AR":
                        if ($prefijoPais == "+54") {
                            //aplicar reglas de marcado
                            if($numero = $this->formatNumero($localidad, $tipoTel, $telefono1, $prefijoTel1)){
                                $telefono1 = $numero;    
                            }
                        } 
                        break;

                    default:
                        break;
                }

                for ($reg = 1; $reg <= count($Adicionales); $reg++) {
                    $datos_adicionalesTitulos = array();
                    $datos_adicionalesInfos = array();
                    $datos_adicionales = array();
                    for ($a = 0; $a < count($Adicionales); $a++) {
                        $aux = new stdClass();
                        $aux->titulo = $Adicionales[$a]['titulo'];
                        $aux->info = $Adicionales[$a]['info'];
                        $datos_adicionales[] = $aux;
                        $datos_adicionalesTitulos[] = $Adicionales[$a]['titulo'];
                        $datos_adicionalesInfos[] = $Adicionales[$a]['info'];
                    }
                }
                $titulos = implode(';', $datos_adicionalesTitulos);
                $adicional = implode(';', $datos_adicionalesInfos);

                $datosTitulos = "codecliente; nro_doc; apellido; nombre; estado_civil; sexo; fecha_nac;edad; profesion; segmento; shot; tarjeta; nro_tarjeta; vto_tarjeta; calle; nro_casa; piso;depto; localidad; ciudad; barrio; cod_postal; provincia;prefijo_tel_1; telefono_1;prefijo_tel_2; telefono_2; prefijo_tel_3; telefono_3; prefijo_tel_4; telefono_4;prefijo_tel_5;telefono_5;prefijo_tel_6;telefono_6; correo1; correo2; obs_cuenta; " . $titulos;

                $datosInfo = "$codeCliente; $nroDoc; $apellido; $nombre; $estadoCivil; $sexo; $fechaNac; $edad; $profesion; $segmento; $shot; $tarjeta; $nroTarjeta; $vtoTarjeta; $calle; $nroCasa; $piso; $dpto; $localidad; $ciudad; $barrio; $codPostal; $provincia; $prefijoTel1; $telefono1; $prefijoTel2; $telefono2; $prefijoTel3; $telefono3; $prefijoTel4; $telefono4; $prefijoTel5; $telefono5; $prefijoTel6; $telefono6; $correo1; $correo2; $obsCuenta; $adicional";

                $errores = array();

                if (($nroDoc == "" || $nroDoc <= 0) && ($codeCliente == "" || $codeCliente <= 0)) {
                    $resultado['data'] = array(
                        'success' => FALSE,
                        'registros' => $datosInfo,
                        'error' => 'El nro de documento o codeCliente es obligatorio'
                    );
                    //echo json_encode($resultado);
                    $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT); // CREATED (201) being the HTTP response code
                } else if (($pais->pais == "AR" && $cantTelefono < 10) || $telefono1 == "0" || trim($telefono1) == "") {
                    $resultado['data'] = array(
                        'success' => FALSE,
                        'registros' => $datosInfo,
                        'error' => 'El nro de telefono es obligatorio'
                    );

                    $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT); // CREATED (201) being the HTTP response code
                } else {
                    log_message("celiterinfo", "Empieza a procesar WS - " . date("Y-m-d H:i:s"));
                    $this->load->model("csv/m_csv");
                    $procesaTitulos = $this->m_csv->procesarBasePost($datosTitulos, $idCliente, $idCampana);
                    $errores[] = $procesaTitulos['error'];
                    if (!$procesaTitulos['error']) {
                        $procesaInfo = $this->m_csv->procesarBasePost($datosInfo, $idCliente, $idCampana);
                    } else {
                        $resultado['data'] = array(
                            'success' => FALSE,
                            'registros' => $datosInfo,
                            'error' => 'Titulos incorrectos'
                        );
                    }
                    $errores[] = $procesaInfo['error'];

                    if (!$procesaInfo['error']) {

                        $registrosWS = array($idCliente, $idCampana, $codeCliente, $nroDoc, $apellido, $nombre, $estadoCivil, $sexo, $fechaNac, $edad, $profesion, $segmento, $shot, $tarjeta, $nroTarjeta
                            , $vtoTarjeta, $calle, $nroCasa, $piso, $dpto, $localidad, $ciudad, $barrio, $codPostal, $provincia, $prefijoTel1, $telefono1, $prefijoTel2
                            , $telefono2, $prefijoTel3, $telefono3, $prefijoTel4, $telefono4, $prefijoTel5, $telefono5, $prefijoTel6, $telefono6, $correo1, $correo2, $obsCuenta, $errores, $datos_adicionales);
                        $registros = array($registrosWS);
                        log_message("celiterinfo", "Empieza a proceso de levanta base WS - " . date("Y-m-d H:i:s"));
                        $levanta = $this->m_csv->levanta_a_base_ant($registros, '');
                        $errores = $levanta['error'];
                        if ($errores) {
                            $resultado['data'] = array(
                                'success' => FALSE,
                                'registros' => $levanta['registros'],
                                'error' => 'Datos incorrectos'
                            );
                            $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT);
                        } else {
                            log_message("celiterinfo", "Empieza a proceso de insertar en la cola WS - " . date("Y-m-d H:i:s"));
                            $insertaCola = $this->__insertaCcola($idCliente, $idCampana, $nroDoc, $shot);
                            if ($insertaCola) {
                                $resultado['data'] = array(
                                    'success' => TRUE,
                                    'registros' => $levanta['registros'],
                                    'error' => 'Datos correctos'
                                );
                            } else {
                                $resultado['data'] = array(
                                    'success' => TRUE,
                                    'registros' => $levanta['registros'],
                                    'error' => 'Datos correctos en base'
                                );
                            }
                            $this->set_response($resultado, REST_Controller::HTTP_OK);
                        }
                    } else {
                        $resultado['data'] = array(
                            'success' => FALSE,
                            'registros' => $datosInfo,
                            'error' => 'Datos incorrectos'
                        );
                        $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT);
                    }
                    // CREATED (201) being the HTTP response code
                }
            } else {
                $resultado['data'] = array(
                    'success' => FALSE,
                    'registros' => $datosInfo,
                    'error' => 'Datos incorrectos'
                );
                $this->set_response($resultado, REST_Controller::HTTP_PARTIAL_CONTENT); // CREATED (201) being the HTTP response code
            }
        } catch (Exception $exc) {
            log_message("error", "Error en el webservice de insercion de base: " . $exc->getTraceAsString());
            //echo $exc->getTraceAsString();
            $this->set_response($exc->getTraceAsString(), REST_Controller::HTTP_PARTIAL_CONTENT); // CREATED (201) being the HTTP response code
        }
    }

    public function addContactCola_delete() {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    private function __insertaCcola($idCliente, $idCampana, $nroDoc, $shot) {

        $procedimiento = "generaColaWs";
        $resul = $this->m_csv->_callProcedure($procedimiento, array($idCliente, $idCampana, $nroDoc, $shot));
        return ($resul) ? TRUE : FALSE;
    }

    private function __getFileAudioFtp($idLlamada) {


        $ftp_server = "172.30.2.63";

        $ftp_port = 21;

        $ftp_user_name = "client1";

        $ftp_user_pass = "neopass";

        $file = $this->__getFileNameAudio($idLlamada);

        //$localdir = "/var/www/salientes2.0/uploads/";
        $localdir = "D:\proyectos\salientes2.0\salientes2.0\uploads\audios\/";
        $urlDescarga = BASE_URL . "/uploads/audios/";
        $ftpdir = "/MONITOREO/";

        $conn_id = ftp_connect($ftp_server, $ftp_port);
        if (!$conn_id) {
            log_message("error", "¡La conexión FTP a $ftp_server ha fallado!");
            exit();
        } else {
            log_message("error", "Conexion exitosa con el servidor $ftp_server", "INFO");
            $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
            if (!$login_result) {
                log_message("error", "Se intentó conectar al $ftp_server por el usuario $ftp_user_name");
                exit;
            } else {
                log_message("error", "Logueado exitosamente con el servidor $ftp_server con el user $ftp_user_name");
            }
        }
        ftp_pasv($conn_id, FALSE);
        if ($file) {
            $flag = 0;
            $file_dest = $localdir . $file->url_grabacion;
            $file_orig = $ftpdir . $file->url_grabacion;
            $download = ftp_get($conn_id, $file_dest, $file_orig, FTP_ASCII);
        } else {
            $flag = 1;
            $contents = ftp_nlist($conn_id, "/MONITOREO/");
            foreach ($contents as $key => $value) {

                if (strpos($value, "-" . $idLlamada . "-")) {

                    $file = substr($value, 11);
                    $file_dest = $localdir . $file;
                    $file_orig = $ftpdir . $file;
                    $download = ftp_get($conn_id, $file_dest, $file_orig, FTP_ASCII);
                    break;
                } else {
                    $file = false;
                    $file_dest = $localdir . $file;
                    $file_orig = $ftpdir . $file;
                    $download = FALSE;
                }
            }
        }

        //$download = ftp_get($conn_id, $file_dest, $file_orig, FTP_ASCII);

        if (is_string($file)) {
            //log_message("error", "Archivo $file no se encontro");
            $i = 1;  //cantidad de intentos
            while (($i <= 5) && (!$download)) {  //INTENTO Q SINCRONICE HASTA 5 VECES
                $download = ftp_get($conn_id, $file_dest, $file_orig, FTP_ASCII);
                $i++;
                if (!$download) {

                    log_message("error", "Archivo " . $flag ? $file : $file->url_grabacion . " no encontrado");
                }
                sleep(1);
            }
            if ($download) {
                log_message("error", "Archivo " . $flag ? $file : $file->url_grabacion . " desacargado exitosamente al servidor $ftp_server");
                //unlink($localdir . $file->url_grabacion);
                log_message("error", "se eliminó: " . $flag ? $file : $file->url_grabacion);
            }
        } else {
            $download = FALSE;
            log_message("error", "Archivo " . $flag ? $file : $file->url_grabacion . " levantado exitosamente al servidor $ftp_server");
            //unlink($localdir . $file->url_grabacion);
            log_message("error", "se eliminó: " . $flag ? $file : $file->url_grabacion);
        }


        ftp_close($conn_id);
        log_message("error", "Conexión ftp $ftp_server cerrada");
        if ($download) {
            return $urlDescarga . $file;
        } else {
            return $download;
        }
    }

    private function __getFileAudioShell($idLlamada, $idGestion = null) {
        $urlDescarga = BASE_URL . URL_AUDIOS;
        $file = $this->__getFileNameAudio($idLlamada);
        if (isset($file->url_grabacion) && $file->url_grabacion != 'FALSE') {

            $existe = file_exists(PATH_AUDIOS . $file->url_grabacion);
            $fileDescarga = BASE_URL . URL_AUDIOS . $file->url_grabacion;
            $idGestion = !$existe;

            log_message('celiterinfo', ($existe ? 'Audio encontrado en servidor local.' : 'El audio no esta guardado en el servidor local.'));
        }

        if (!isset($existe) || !$existe) {
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
                ftp_pasv($conn_id, FALSE);
                $flag = 1;
                $this->benchmark->mark('fileFtp_start');
                $contents = ftp_nlist($conn_id, "/MONITOREO/");
                $this->benchmark->mark('fileFtp_end');
                log_message("celiterinfo", "Se obtuvo la lista de grabaciones, tiempo transcurrido: " . $this->benchmark->elapsed_time('fileFtp_start', 'fileFtp_end') . ' seg.');

                foreach ($contents as $key => $value) {

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
                        break;
                    } else {
                        $file = false;
                        $file_dest = PATH_AUDIOS . $file;
                        $file_orig = FTP_CARPETA_AUDIOS . $file;
                        $existe = FALSE;
                    }
                }
                ftp_close($conn_id);
                log_message("celiterinfo", "Conexión ftp " . FTP_SERVER . " cerrada");
            }
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

                        log_message("celiterinfo", "Archivo " . (($flag && is_string($file)) ? $file : $file->url_grabacion) . " no encontrado");
                    }
                    sleep(1);
                }
                if ($existe) {
                    log_message("celiterinfo", "Archivo " . (($flag && is_string($file)) ? $file : $file->url_grabacion) . " desacargado exitosamente al servidor " . FTP_SERVER);
                    log_message("celiterinfo", "se eliminó: " . (($flag && is_string($file)) ? $file : $file->url_grabacion));
                }
            } else {
                $existe = FALSE;
                log_message("celiterinfo", "Archivo " . (($flag && is_string($file)) ? $file : $file->url_grabacion) . " levantado exitosamente al servidor " . FTP_SERVER);
                log_message("celiterinfo", "se eliminó: " . (($flag && is_string($file)) ? $file : $file->url_grabacion));
            }




            if (isset($existe) && $existe) {
                ($idGestion && is_string($file)) ? $this->auditoria->updUrlAudioByIdGestion(array($idGestion, $file)) : '';
                $this->benchmark->mark('getFileAudioFtp_end');
                log_message("celiterinfo", "Proceso recupera audio completo, tiempo transcurrido: " . $this->benchmark->elapsed_time('getFileAudioFtp_start', 'getFileAudioFtp_end') . ' seg.');
                return $fileDescarga;
            } else {
                $this->benchmark->mark('getFileAudioFtp_end');
                log_message("celiterinfo", "Proceso recupera audio completo, tiempo transcurrido: " . $this->benchmark->elapsed_time('getFileAudioFtp_start', 'getFileAudioFtp_end') . ' seg.');
                return $fileDescarga;
            }
        }
        return $fileDescarga;
    }

    private function __getFileNameAudio($idLlamada) {
        $this->load->model('m_general');
        $resul = $this->m_general->getFileNameAudio(array($idLlamada));
        return $resul;
    }

    private function __url_exists($url = NULL) {

        if (empty($url)) {
            return false;
        }

        $ch = curl_init($url);

        //Establecer un tiempo de espera
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        //establecer NOBODY en true para hacer una solicitud tipo HEAD
        curl_setopt($ch, CURLOPT_NOBODY, true);
        //Permitir seguir redireccionamientos
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        //recibir la respuesta como string, no output
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);

        //Obtener el código de respuesta
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //cerrar conexión
        curl_close($ch);

        //Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array(200, 301, 302);
        if (in_array($httpcode, $accepted_response)) {
            return true;
        } else {
            return false;
        }
    }

    public function getGestionInfo_get() {

        log_message("celiterinfo", "Empieza WS - getGestionInfo_get - " . date("Y-m-d H:i:s"));
        $HTTP_RESULT = REST_Controller::HTTP_PARTIAL_CONTENT;
        $idGestion = $this->get('idGestion');

        if (($idGestion == "") || ($idGestion == "Null")) {
            $resultado = ['success' => FALSE, 'registro' => '', 'error' => 'El idGestion es obligatorio (?idGestion=5336858)'];
        } else {
            log_message("celiterinfo", "Empieza a procesar WS - " . date("Y-m-d H:i:s"));

            $this->load->model("gestion/m_gestion");
            $gestionData = $this->m_gestion->getGestionByIdAudit(array($idGestion));

            $resultado = (!$gestionData) ? ['success' => FALSE, 'registro' => '', 'error' => 'Id Gestion inexistente'] : ['success' => TRUE, 'registro' => json_encode($gestionData), 'error' => ''];

            $HTTP_RESULT = ($gestionData) ? REST_Controller::HTTP_OK : $HTTP_RESULT;
        }

        $this->set_response($resultado, $HTTP_RESULT);
    }

    public function getGestionInfo_post() {

        log_message("celiterinfo", "Empieza WS - getGestionInfo_post - " . date("Y-m-d H:i:s"));
        $datos = $this->post('idGestion');
        $HTTP_RESULT = REST_Controller::HTTP_PARTIAL_CONTENT;
        $resultado = ['success' => FALSE, 'registro' => '', 'error' => 'No se recibieron datos por POST'];

        if (isset($datos)) {
            $idGestion = $datos ? $datos : "";

            if (($idGestion == "") || ($idGestion == "Null")) {
                $resultado = ['success' => FALSE, 'registro' => '', 'error' => 'El idGestion es obligatorio'];
            } else {
                log_message("celiterinfo", "Empieza a procesar WS - " . date("Y-m-d H:i:s"));

                $this->load->model("gestion/m_gestion");
                $gestionData = $this->m_gestion->getGestionByIdAudit(array($idGestion));

                $resultado = (!$gestionData) ? ['success' => FALSE, 'registro' => '', 'error' => 'Id Gestion inexistente'] : ['success' => TRUE, 'registro' => json_encode($gestionData), 'error' => ''];

                $HTTP_RESULT = ($gestionData) ? REST_Controller::HTTP_OK : $HTTP_RESULT;
            }
        }

        $this->set_response($resultado, $HTTP_RESULT);
    }

}
