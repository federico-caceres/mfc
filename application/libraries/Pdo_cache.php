<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Pdo_cache
 *
 * @author David A
 */
class Pdo_cache {

    private $obj;
    private $pathCache = APPPATH . 'cache/';
    private $fileCacheName = NULL;
    public $identifQuery;

    const RESULT_ALL_OBJ = 5;
    const RESULT_ALL_ARRAY = 2;
    const ROW_OBJ = 'row_obj';
    const SEPARADOR = '-|-';

    private $debug_mode;

    function Pdo_cache() {
        $this->obj = & get_instance();
        if ($path = config_item('cache_path')) {
            $this->pathCache = APPPATH . $path;
        }
        
        if (!$this->debug_mode) {
            $this->debug_mode = 'debug';
        }
        
        log_message($this->debug_mode, "<PDO_CACHE> Libreria Inicializada.");
    }
    
    function setDebug_mode($debug_mode) {
        $this->debug_mode = $debug_mode;
    }
    
    function __destruct() {
        $this->fileCacheName = NULL;
        log_message($this->debug_mode, "<PDO_CACHE> Libreria destruida.");
    }

    function cache_start($param = null) {
        $funcion = $param ? $param : json_encode(array($this->obj->router->fetch_class(), $this->obj->router->fetch_method()));
        $this->fileCacheName = 'da_' . md5($funcion);

        log_message($this->debug_mode, "<PDO_CACHE> CACHE START Utilizada -> $funcion");
    }

    function cache_end() {
        $this->fileCacheName = NULL;
        log_message($this->debug_mode, "<PDO_CACHE> CACHE END Utilizada.");
    }

    function consulta($procedure, $parametros) {
        
        log_message($this->debug_mode, "<PDO_CACHE> Funcion Consulta Utilizada -> $procedure - " . json_encode($parametros));

        $retorno = FALSE;
        $this->identifQuery = md5($procedure . json_encode($parametros));

        if ((($this->fileCacheName) && ($datos = read_file($this->pathCache . $this->fileCacheName)))) {
            $retorno = (bool) $this->_buscaResultadoEnCache($datos, $this->identifQuery);
        }

        return $retorno;
    }

    private function _buscaResultadoEnCache($datos, $spAndParam) {

        $reg = explode(PHP_EOL, $datos);
        $retorno = FALSE;
        foreach ($reg as $value) {

            $queryCacheada = explode(self::SEPARADOR, $value);

            if ($queryCacheada[0] == $spAndParam) {
                $retorno = $queryCacheada[1];

                break;
            }
        }

        return $retorno;
    }

    function getResul($intance, $retorno) {

        $this->obj->benchmark->mark('getResul_start');
        
        if ($this->fileCacheName) {

            if ($datos = read_file($this->pathCache . $this->fileCacheName)) {

                if ($queryReturn = $this->_buscaResultadoEnCache($datos, $this->identifQuery)) {
                    
                    $this->obj->benchmark->mark('getResulC_end');
                    log_message($this->debug_mode, "<PDO_CACHE> Se obtiene Resultado para archivo del CACHE " . $this->fileCacheName . " " . $this->identifQuery . " Tiempo total de ejecución: " . $this->obj->benchmark->elapsed_time('getResul_start', 'getResulC_end') . " seg.");
                    return $this->_retornoDatos(json_decode($queryReturn), $retorno);
                }
            }
        }

        $resul = ($retorno == self::ROW_OBJ) ? $intance->_pdo->fetchAll() : $intance->_pdo->fetchAll($retorno);

        if ($this->fileCacheName) {
            write_file($this->pathCache . $this->fileCacheName, $this->identifQuery . self::SEPARADOR . json_encode($resul) . PHP_EOL, 'a');
        }
//        $intance->_pdo->fetchAll($retorno);

        $this->obj->benchmark->mark('getResul_end');
        
        log_message($this->debug_mode, "<PDO_CACHE> Se obtiene Resultado para archivo " . $this->fileCacheName . " Identificador " . $this->identifQuery . " Tiempo total de ejecución: " . $this->obj->benchmark->elapsed_time('getResul_start', 'getResul_end') . " seg.");

        return $this->_retornoDatos($resul, $retorno);
    }

    private function _retornoDatos($resul, $retorno) {

        switch ($retorno) {

            case self::RESULT_ALL_ARRAY:

                if (is_array($resul)) {
                    $newRetorno = [];
                    foreach ($resul as $value) {
                        if (!is_array($value)) {
                            $newRetorno[] = (array) $value;
                        } else {
                            $newRetorno[] = $value;
                        }
                    }

                    $resul = $newRetorno;
                }

                break;

            case self::RESULT_ALL_OBJ:

                if (is_array($resul)) {

                    $newRetorno = [];
                    foreach ($resul as $value) {
                        if (!is_object($value)) {
                            $newRetorno[] = (object) $value;
                        } else {
                            $newRetorno[] = $value;
                        }
                    }

                    $resul = $newRetorno;
                }

                break;

            case self::ROW_OBJ:

                if (is_array($resul)) {

                    $resul = (object) $resul[0];
                }

                break;

            default:
                
                log_message('error', "<PDO_CACHE> El tipo de retorno es obligatorio, no fue definido o es invalido.");
                
                throw new \InvalidArgumentException("El tipo de retorno es obligatorio, no fue definido o es invalido.");
        }

        return $resul;
    }

}
