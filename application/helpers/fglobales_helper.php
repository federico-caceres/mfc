<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function myUnsetGlobal($array, $indice) {

    $tmpArr = array();
    foreach ($array as $key => $value) {
        if ($key != $indice) {
            $tmpArr[] = $value;
        }
    }
    return $tmpArr;
}

function formato_mysql($param) {

    $param = ($param) ? $param : '-1';
    if (($param != '-1') and (strpos('/', $param) !== FALSE)) {
        $fecha = explode("/", $param);
        $retorno = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
    } else {
        $retorno = '-1';
    }
    $param = ($param and (strpos('/', $param) === FALSE)) ? substr($param, 0, 10) : $param;
    return ($param and (strpos('/', $param) === FALSE)) ? $param : $retorno;
}

function utf8_converter($array) {

    array_walk_recursive($array, function(&$item, $key) {
        if (is_object($item)) {
            foreach ($item as $key => $value) {
                toUTF8($item->$key);
            }
        } else {
            $item = toUTF8($item);
        }
    });

    return $array;
}

function toUTF8(&$item) {    
    
    if (!mb_detect_encoding($item, 'utf-8', true)) {
        $item = utf8_encode($item);
    } 
//    return $item;
}
/**
 * 
 *  Devuelve el tipo de servicio de la campaña desde el listado de credenciales que se recibe de SSO.
 * 
 * @param Array() $userData (Obligatorio) Lista de Credenciales obtenidos de SSO
 * @param INT $id_campana  (Obligatorio) ID de la campaña a buscar
 * @param INT $index  (no necesario) Variable donde va a retornar el id del tipo de servicio, en caso de ser encontrado.
 * 
 */
function getTipoServicioByUserData($userData, $id_campana, &$index = NULL) {
    if(is_object($userData)) {
        $index = $userData->id_tipo_servicio;
    }
    else {
        foreach ($userData as $key => $value) {
            if ($value->id_servicio === $id_campana){
                $index = $value->id_tipo_servicio;
            }
        }
    }
}