<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * && open the template in the editor.
 */

/**
 * Description of M_acceso
 *
 * @author juan.vallejos
 */
class M_acceso extends M_general {

    var $params = '';

    public function __construct() {
        parent::__construct();
    }

    public function loginM($user, $pass) {

        $this->db->select("u.idusuario,u.login,u.nombre,u.nivel,u.iddiocesis,u.idbase,u.idgrupo,d.nombre as 'diocesis',b.bases,u.cargo")
                ->from("usuarios u")
                ->join("diocesis d","u.iddiocesis=d.iddiocesis","left")
                ->join("bases b","u.idbase=b.idbase","left")
                ->where("u.login", $user)
                ->where("u.clave", md5($pass));
        $q = $this->db->get();
        $result = $q->result();

        return $result;
    }

    public function get_permisosRoles() {
        $procedure = 'get_permisosRoles';
        $call = $this->execProcedure($procedure, array());
        return ($call) ? $this->_result_all_array() : FALSE;
    }

    /* ---------------------------------------------------------------------------- */

    /**
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */
    public function getRealIP() {
        return (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ? $_ENV['REMOTE_ADDR'] : "unknown" );
    }

}
