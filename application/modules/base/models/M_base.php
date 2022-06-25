<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_base extends M_general {

    var $params = '';

    public function __construct() {
        parent::__construct();
    }

    public function getBases($params) {

        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        if ($params[0] == "-1" && $params[1] == "-1" && ($nivel == "1")) {
            $this->db->select("b.idbase,b.bases,b.estado,b.iddiocesis,d.nombre as 'diocesis',concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'coordinador'")
                    ->from("bases b")
                    ->join("diocesis d", "b.iddiocesis=d.iddiocesis")
                    ->join("matrimonio m", "b.idmatrimonio=m.idmatrimonio", "left")
                    ->where("b.borrado", 0)
                    ->group_by(array("b.idbase"));
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && ($nivel != "3 ")) {
            $this->db->select("b.idbase,b.bases,b.estado,b.iddiocesis,d.nombre as 'diocesis',concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'coordinador'")
                    ->from("bases b")
                    ->join("diocesis d", "b.iddiocesis=d.iddiocesis")
                    ->join("matrimonio m", "b.idmatrimonio=m.idmatrimonio", "left")
                    ->where("b.borrado", 0)
                    ->where("b.iddiocesis", $params[0])
                    ->group_by(array("b.idbase"));
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1") {
            $this->db->select("b.idbase,b.bases,b.estado,b.iddiocesis,d.nombre as 'diocesis',concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'coordinador'")
                    ->from("bases b")
                    ->join("diocesis d", "b.iddiocesis=d.iddiocesis")
                    ->join("matrimonio m", "b.idmatrimonio=m.idmatrimonio", "left")
                    ->where("b.borrado", 0)
                    ->where("b.iddiocesis", $params[0])
                    ->where("b.idbase", $params[1])
                    ->group_by(array("b.idbase"));
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
    }

    public function getBaseById($idBase) {

        if ((is_array($idBase) && $idBase[0] != "0") || $idBase != "0") {
            $idBase = (is_array($idBase)) ? $idBase[0] : $idBase;
            $this->db->select("b.idbase,b.idmatrimonio,b.bases as 'nombreBase',b.estado,b.iddiocesis,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'coordinador'")
                    ->from("bases b")
                    ->join("diocesis d", "b.iddiocesis=d.iddiocesis")
                    ->join("matrimonio m", "b.idmatrimonio=m.idmatrimonio", "left")
                    ->where("b.borrado", 0)
                    ->where("b.idbase", $idBase)
                    ->order_by("b.idbase ASC");
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

    public function guardaBase($accion, $idBase, $registros) {
        if ($accion === "0") {
            $resultado = $this->db->insert('bases', $registros);
            $idBase = $this->db->insert_id();
        } else {
            $this->db->where('idbase', $idBase);
            $resultado = $this->db->update('bases', $registros);
        }
        $result['success'] = $resultado;
        $result['idBase'] = $idBase;
        return $result;
    }

}
