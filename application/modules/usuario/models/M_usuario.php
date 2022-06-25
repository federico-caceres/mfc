<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_usuario extends M_general {

    var $params = '';

    public function __construct() {
        parent::__construct();
    }

    public function getUsuarios($nivel, $cargo, $diocesis = 100, $base = 1000, $grupo = 0) {
        if ($cargo == "2"||$cargo == "6") {
            switch ($nivel) {
                case 1:
                    $this->db->select("u.idusuario,u.cargo,u.login,u.nivel,u.nrocedula,u.mail,u.nombre as 'nombreUsuario',u.estado,u.iddiocesis,u.idbase,,u.idgrupo,d.nombre as 'diocesis',b.bases")
                            ->from("usuarios u")
                            ->join("diocesis d", "u.iddiocesis=d.iddiocesis", "left")
                            ->join("bases b", "u.idbase=b.idbase", "left")
                            ->where("u.borrado", 0)
                            ->where("u.idusuario!=32")
                            ->order_by("u.nombre ASC");
                    $q = $this->db->get();
                    if ($q->num_rows() > 0) {
                        $resultado = $q->result();
                    } else {
                        $resultado = array();
                    }

                    break;
                case 2:
                    if($cargo=="2"){
                    $this->db->select("u.idusuario,u.cargo,u.login,u.nivel,u.nrocedula,u.mail,u.nombre as 'nombreUsuario',u.estado,u.iddiocesis,u.idbase,,u.idgrupo,d.nombre as 'diocesis',b.bases")
                            ->from("usuarios u")
                            ->join("diocesis d", "u.iddiocesis=d.iddiocesis")
                            ->join("bases b", "u.idbase=b.idbase", "left")
                            ->where("u.borrado", 0)
                            ->where("u.idusuario!=32")
                            ->where("u.iddiocesis", $diocesis)
                            ->order_by("u.nombre ASC");
                    $q = $this->db->get();
                    if ($q->num_rows() > 0) {
                        $resultado = $q->result();
                    } else {
                        $resultado = array();
                    }
                    } else {
                        $this->db->select("u.idusuario,u.cargo,u.login,u.nivel,u.nrocedula,u.mail,u.nombre as 'nombreUsuario',u.estado,u.iddiocesis,u.idbase,,u.idgrupo,d.nombre as 'diocesis',b.bases")
                            ->from("usuarios u")
                            ->join("diocesis d", "u.iddiocesis=d.iddiocesis")
                            ->join("bases b", "u.idbase=b.idbase", "left")
                            ->where("u.borrado", 0)
                            ->where("u.idusuario!=32")
                            ->where("u.iddiocesis", $diocesis)
                            ->where("u.cargo", $cargo)    
                            ->order_by("u.nombre ASC");
                    $q = $this->db->get();
                    if ($q->num_rows() > 0) {
                        $resultado = $q->result();
                    } else {
                        $resultado = array();
                    }
                    }

                    break;
                case 3:
                    $userData = $this->session->userdata('userData');
                    $idUsuario = $userData->idusuario;

                    $this->db->select("u.idusuario,u.cargo,u.login,u.nivel,u.nrocedula,u.mail,u.nombre as 'nombreUsuario',u.estado,u.iddiocesis,u.idbase,,u.idgrupo,d.nombre as 'diocesis',b.bases")
                            ->from("usuarios u")
                            ->join("diocesis d", "u.iddiocesis=d.iddiocesis")
                            ->join("bases b", "u.idbase=b.idbase", "left")
                            ->where("u.borrado", 0)
                            ->where("u.idusuario!=32")
                            ->where("u.idusuario", $idUsuario)
                            ->order_by("u.nombre ASC");
                    $q = $this->db->get();
                    if ($q->num_rows() > 0) {
                        $resultado = $q->result();
                    } else {
                        $resultado = array();
                    }
                    break;
            }
        } else {
            $userData = $this->session->userdata('userData');
            $idUsuario = $userData->idusuario;

            $this->db->select("u.idusuario,u.cargo,u.login,u.nivel,u.nrocedula,u.mail,u.nombre as 'nombreUsuario',u.estado,u.iddiocesis,u.idbase,,u.idgrupo,d.nombre as 'diocesis',b.bases")
                    ->from("usuarios u")
                    ->join("diocesis d", "u.iddiocesis=d.iddiocesis")
                    ->join("bases b", "u.idbase=b.idbase")
                    ->where("u.borrado", 0)
                    ->where("u.idusuario", $idUsuario)
                    ->order_by("u.nombre ASC");
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        }
        return $resultado;
    }

    public function getUsuarioById($idUsuario) {
        if ($idUsuario[0] != "0") {
            $this->db->select("u.idusuario,u.cargo,u.login,u.nivel,u.nrocedula,u.mail,u.nombre as 'nombreUsuario',u.estado,u.iddiocesis,u.idbase,u.idgrupo,d.nombre as 'diocesis',b.bases")
                    ->from("usuarios u")
                    ->join("diocesis d", "u.iddiocesis=d.iddiocesis")
                    ->join("bases b", "u.idbase=b.idbase", "left")
                    ->join("grupos g", "u.idgrupo=g.idgrupo", "left")
                    ->where("u.borrado", 0)
                    ->where("u.idusuario!=32")
                    ->where("u.idusuario", $idUsuario[0])
                    ->order_by("u.idusuario ASC");
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $resultado = array();
        }


        return $resultado;
    }

    public function guardaUsuario($accion, $idUsuario, $registros) {
        if ($accion === "0") {
            $resultado = $this->db->insert('usuarios', $registros);
            $idUsuario = $this->db->insert_id();
        } else {
            $this->db->where('idusuario', $idUsuario);
            $resultado = $this->db->update('usuarios', $registros);
        }
        $result['success'] = $resultado;
        $result['idUsuario'] = $idUsuario;
        return $result;
    }

    public function cambiaPassword($idUsuario, $newPassword) {
        $this->db->set('clave', md5($newPassword));
        $this->db->where('idusuario', $idUsuario);
        $result = $this->db->update('usuarios');
        return $result;
    }

    public function verificaPassword($idUsuario, $newPassword) {
        if ($idUsuario[0] != "0") {
            $this->db->select("u.clave")
                    ->from("usuarios u")
                    ->where("u.borrado", 0)
                    ->where("u.idusuario", $idUsuario[0])
                    ->order_by("u.idusuario ASC");
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
                $passwordIdenticos = ($newPassword === $resultado[0]->clave) ? TRUE : FALSE;
            } else {

                $passwordIdenticos = FALSE;
            }
        } else {

            $passwordIdenticos = FALSE;
        }
        return $passwordIdenticos;
    }

}
