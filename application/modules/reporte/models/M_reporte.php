<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set("max_execution_time", '3000');
ini_set('memory_limit', '1024M');

class M_reporte extends M_general {

    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    public function get_infoReportS09($params, $flag) {

        IF ($flag == 0) {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',e.tema_nro,e.fechaReunion")
                    ->from("evaluacion e")
                    ->join("evaluacion_matrimonios m", "e.idevaluacion=m.idevaluacion")
                    ->join("matrimonio ma", "ma.idmatrimonio=m.idmatrimonio")
                    ->join("diocesis d", "d.iddiocesis=e.iddiocesis")
                    ->join("bases b", "b.idbase=e.idbase")
                    ->join("grupos g", "g.idgrupo=e.idgrupo")
                    ->where("e.iddiocesis", ($params[0] == "-1") ? TRUE : $params[0])
                    ->where("e.idbase", ($params[1] == "-1") ? TRUE : $params[1])
                    ->where("e.idgrupo", ($params[2] == "-1") ? TRUE : $params[2])
                    ->where("e.nivel", ($params[3] == "-1") ? TRUE : $params[3])
                    ->group_by(array("m.idmatrimonio", "e.tema_nro"));
        } else {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',e.tema_nro,e.fechaReunion")
                    ->from("evaluacion e")
                    ->join("evaluacion_matrimonios m", "e.idevaluacion=m.idevaluacion")
                    ->join("matrimonio ma", "ma.idmatrimonio=m.idmatrimonio")
                    ->join("diocesis d", "d.iddiocesis=e.iddiocesis")
                    ->join("bases b", "b.idbase=e.idbase")
                    ->join("grupos g", "g.idgrupo=e.idgrupo")
                    ->where("e.iddiocesis", ($params[0] == "-1") ? TRUE : $params[0])
                    ->where("e.idbase", ($params[1] == "-1") ? TRUE : $params[1])
                    ->where("e.idgrupo", ($params[2] == "-1") ? TRUE : $params[2])
                    ->where("e.nivel", ($params[3] == "-1") ? TRUE : $params[3])
                    ->where("e.fechaReunion between '" . $params[4] . "' and '" . $params[5] . "'")
                    ->group_by(array("m.idmatrimonio", "e.tema_nro"));
        }
//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return array();
        }
    }

    public function get_infoReportSJ09($params, $flag) {

        IF ($flag == 0) {
            $this->db->select("ma.idjoven,g.idjoven as 'idpromotor',e.nivel,concat(ma.nombre,' ',ma.apellidoP,' ',ma.apellidoM) as 'joven', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',e.tema_nro,e.fechaReunion")
                    ->from("evaluacion_jovenes e")
                    ->join("evaluacion_jovenes_detalle m", "e.idevaluacion=m.idevaluacion")
                    ->join("joven ma", "ma.idjoven=m.idjoven")
                    ->join("diocesis d", "d.iddiocesis=e.iddiocesis")
                    ->join("bases b", "b.idbase=e.idbase")
                    ->join("grupos_jovenes g", "g.idgrupo=e.idgrupo")
                    ->where("e.iddiocesis", ($params[0] == "-1") ? TRUE : $params[0])
                    ->where("e.idbase", ($params[1] == "-1") ? TRUE : $params[1])
                    ->where("e.idgrupo", ($params[2] == "-1") ? TRUE : $params[2])
                    ->where("e.nivel", ($params[3] == "-1") ? TRUE : $params[3])
                    ->group_by(array("m.idjoven", "e.tema_nro"));
        } else {
            $this->db->select("ma.idjoven,g.idjoven as 'idpromotor',e.nivel,concat(ma.nombre,' ',ma.apellidoP,' ',ma.apellidoM) as 'joven', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',e.tema_nro,e.fechaReunion")
                    ->from("evaluacion_jovenes e")
                    ->join("evaluacion_jovenes_detalle m", "e.idevaluacion=m.idevaluacion")
                    ->join("joven ma", "ma.idjoven=m.idjoven")
                    ->join("diocesis d", "d.iddiocesis=e.iddiocesis")
                    ->join("bases b", "b.idbase=e.idbase")
                    ->join("grupos_jovenes g", "g.idgrupo=e.idgrupo")
                    ->where("e.iddiocesis", ($params[0] == "-1") ? TRUE : $params[0])
                    ->where("e.idbase", ($params[1] == "-1") ? TRUE : $params[1])
                    ->where("e.idgrupo", ($params[2] == "-1") ? TRUE : $params[2])
                    ->where("e.nivel", ($params[3] == "-1") ? TRUE : $params[3])
                    ->where("e.fechaReunion between '" . $params[4] . "' and '" . $params[5] . "'")
                    ->group_by(array("m.idjoven", "e.tema_nro"));
        }
//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return array();
        }
    }

    public function get_infoReportCuadrante($params) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo")
                    ->where("ma.iddiocesis", ($params[0] == "-1") ? TRUE : $params[0])
                    ->where("ma.idbase", ($params[1] == "-1") ? TRUE : $params[1])
                    ->where("ma.idgrupo", ($params[2] == "-1") ? TRUE : $params[2])
                    ->where("e.nivel", ($params[3] == "-1") ? TRUE : $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if (($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1") && ($nivel != "3")) {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado","0")
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado","0")
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
    }

    public function getCursosMatrimonios(){

        $this->db->select("d.nombre as diocesis, b.bases as base, g.grupos, concat(m.ella_nombre, ' y ', m.el_nombre, ' ', el_apellidos) as matrimonio, c.nombre as curso, ecm.fecha, ecm.lugar")
        ->from("matrimonio m")
        ->join("estudio_cursado_matrimonios ecm","ecm.idmatrimonio = m.idmatrimonio")
        ->join("cursos c","c.idcurso = ecm.idcurso")
        ->join("diocesis d","d.iddiocesis = m.iddiocesis")
        ->join("bases b","b.idbase = m.idbase")
        ->join("grupos g", "g.idgrupo = m.idgrupo", "left");

        $q = $this->db->get();
        return array();
    }

    public function getFilterCursosMatrimonios($params){
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;

        $this->db->select("d.nombre as diocesis, b.bases as base, g.grupos, concat(m.ella_nombre, ' y ', m.el_nombre, ' ', el_apellidos) as matrimonio, c.nombre as curso, ecm.fecha, ecm.lugar")
        ->from("matrimonio m")
        ->join("estudio_cursado_matrimonios ecm","ecm.idmatrimonio = m.idmatrimonio")
        ->join("cursos c","c.idcurso = ecm.idcurso")
        ->join("diocesis d","d.iddiocesis = m.iddiocesis")
        ->join("bases b","b.idbase = m.idbase")
        ->join("grupos g", "g.idgrupo = m.idgrupo", "left");
        
        if ($params[0] != "-1") 
            $this->db->where("d.iddiocesis",$params[0]);
        if ($params[1] != "-1") 
            $this->db->where("b.idbase",$params[1]);
        if ($params[2] != "-1") 
            $this->db->where("g.idgrupo",$params[2]);

        $q = $this->db->get();
        return $q->result();
    }

    public function getCantidadMatrimoniosPorDiocesis(){
        $this->db->select("d.nombre, count(*) as cant")
        ->from("matrimonio m")
        ->join("diocesis d","d.iddiocesis = m.iddiocesis")
        // ->join("bases b","b.idbase = m.idbase")
        ->where("m.borrado", 0)
        ->group_by(array("d.nombre"))
        ->order_by("d.nombre", "asc");

        $q = $this->db->get();
        return $q->result();        
    }

    public function getCantidadMatrimoniosTotal(){
        $this->db->select("count(*) as cant")
        ->from("matrimonio m")
        ->join("diocesis d","d.iddiocesis = m.iddiocesis")
        ->where("m.borrado", 0);

        $q = $this->db->get();
        return $q->result();        
    }

    public function get_infoReportCuadranteMiembros($params) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo")
                    ->where("ma.iddiocesis", ($params[0] == "-1") ? TRUE : $params[0])
                    ->where("ma.idbase", ($params[1] == "-1") ? TRUE : $params[1])
                    ->where("ma.idgrupo", ($params[2] == "-1") ? TRUE : $params[2])
                    ->where("e.nivel", ($params[3] == "-1") ? TRUE : $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if (($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1") && ($nivel != "3")) {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado","0")
                    ->where("((MONTH(ma.fecha_encuentro)=MONTH('" . $params[4] . "')) or (MONTH(ma.fecha_membresia)=MONTH('" . $params[4] . "'))")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado","0")
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("((MONTH(ma.fecha_encuentro)=MONTH('" . $params[4] . "')) or (MONTH(ma.fecha_membresia)=MONTH('" . $params[4] . "'))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.fecha_encuentro)=MONTH('" . $params[4] . "')) or (MONTH(ma.fecha_membresia)=MONTH('" . $params[4] . "'))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.fecha_encuentro)=MONTH('" . $params[4] . "')) or (MONTH(ma.fecha_membresia)=MONTH('" . $params[4] . "'))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.fecha_encuentro)=MONTH('" . $params[4] . "')) or (MONTH(ma.fecha_membresia)=MONTH('" . $params[4] . "'))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.fecha_encuentro,ma.fecha_membresia,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.fecha_encuentro)=MONTH('" . $params[4] . "')) or (MONTH(ma.fecha_membresia)=MONTH('" . $params[4] . "'))")
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
    }
    public function get_infoReportCuadranteS07($params) {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo")
                    ->where("ma.iddiocesis", ($params[0] == "-1") ? TRUE : $params[0])
                    ->where("ma.idbase", ($params[1] == "-1") ? TRUE : $params[1])
                    ->where("ma.idgrupo", ($params[2] == "-1") ? TRUE : $params[2])
                    ->where("e.nivel", ($params[3] == "-1") ? TRUE : $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if (($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1") && ($nivel != "3")) {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado","0")
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado","1")
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] == "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("e.nivel", $params[3])
                    //->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1" && $params[4] != "-1") {
            $this->db->select("ma.idmatrimonio,g.idmatrimonio as 'idenlace',e.nivel,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'matrimonio', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.el_cel,ma.ella_cel,ma.telefono,ma.el_fecha_nac,ma.ella_fecha_nac,ma.aniversario,concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia_pareja',ma.motivo_baja as 'motivoSalida',ma.fecha_baja as 'fechaSalida'")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("e.nivel", $params[3])
                    ->where("((MONTH(ma.ella_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.el_fecha_nac)=MONTH('" . $params[4] . "')) or (MONTH(ma.aniversario)=MONTH('" . $params[4] . "')))")
                    ->where("ma.borrado","1")
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
    }
    
    public function get_infoReportCuadranteJuvenil($params) {

        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1") {
            $this->db->select("ma.idjoven,g.idjoven as 'idpromotor',e.nivel,concat(ma.nombre,' ',ma.apellidoP,' ',ma.apellidoM) as 'joven', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.cel,ma.fecha_nac,ma.nombre_padre,ma.nombre_madre,ma.tel_padre,ma.tel_madre,concat(ma.cedula,'/',d.nomenclatura) as 'membresia_joven'")
                    ->from("joven ma")
                    ->join("evaluacion_jovenes_detalle m", "m.idjoven=ma.idjoven", "left")
                    ->join("evaluacion_jovenes e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos_jovenes g", "g.idgrupo=ma.idgrupo")
                    ->where("ma.iddiocesis", ($params[0] == "-1") ? TRUE : $params[0])
                    ->where("ma.idbase", ($params[1] == "-1") ? TRUE : $params[1])
                    ->where("ma.idgrupo", ($params[2] == "-1") ? TRUE : $params[2])
                    ->where("e.nivel", ($params[3] == "-1") ? TRUE : $params[3])
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idjoven"));
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1") {
            $this->db->select("ma.idjoven,g.idjoven as 'idpromotor',e.nivel,concat(ma.nombre,' ',ma.apellidoP,' ',ma.apellidoM) as 'joven', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.cel,ma.fecha_nac,ma.nombre_padre,ma.nombre_madre,ma.tel_padre,ma.tel_madre,concat(ma.cedula,'/',d.nomenclatura) as 'membresia_joven'")
                    ->from("joven ma")
                    ->join("evaluacion_jovenes_detalle m", "m.idjoven=ma.idjoven", "left")
                    ->join("evaluacion_jovenes e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos_jovenes g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idjoven"));
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1") {
            $this->db->select("ma.idjoven,g.idjoven as 'idpromotor',e.nivel,concat(ma.nombre,' ',ma.apellidoP,' ',ma.apellidoM) as 'joven', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.cel,ma.fecha_nac,ma.nombre_padre,ma.nombre_madre,ma.tel_padre,ma.tel_madre,concat(ma.cedula,'/',d.nomenclatura) as 'membresia_joven'")
                    ->from("joven ma")
                    ->join("evaluacion_jovenes_detalle m", "m.idjoven=ma.idjoven", "left")
                    ->join("evaluacion_jovenes e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos_jovenes g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idjoven"));
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1") {
            $this->db->select("ma.idjoven,g.idjoven as 'idpromotor',e.nivel,concat(ma.nombre,' ',ma.apellidoP,' ',ma.apellidoM) as 'joven', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.cel,ma.fecha_nac,ma.nombre_padre,ma.nombre_madre,ma.tel_padre,ma.tel_madre,concat(ma.cedula,'/',d.nomenclatura) as 'membresia_joven'")
                    ->from("joven ma")
                    ->join("evaluacion_jovenes_detalle m", "m.idjoven=ma.idjoven", "left")
                    ->join("evaluacion_jovenes e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos_jovenes g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idjoven"));
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1") {
            $this->db->select("ma.idjoven,g.idjoven as 'idpromotor',e.nivel,concat(ma.nombre,' ',ma.apellidoP,' ',ma.apellidoM) as 'joven', d.nombre as 'diocesis', b.bases as 'base',g.grupos as 'grupo',ma.cel,ma.fecha_nac,ma.nombre_padre,ma.nombre_madre,ma.tel_padre,ma.tel_madre,concat(ma.cedula,'/',d.nomenclatura) as 'membresia_joven'")
                    ->from("joven ma")
                    ->join("evaluacion_jovenes_detalle m", "m.idjoven=ma.idjoven", "left")
                    ->join("evaluacion_jovenes e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos_jovenes g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("e.nivel", $params[3])
                    ->where("ma.borrado","0")
                    ->group_by(array("ma.idjoven"));
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
    }

    function arma_excel($query, $registros, $fechaDesde, $fechaHasta, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

        if ($query) {
            $columnas = range('A', 'Z');
            foreach ($columnas as $key => $value) {
                $columnas[] = $columnas[0] . $value;
            }

            $this->excel->setActiveSheetIndex(0);
            $idEnlace = (count($registros) > 0) ? $registros[0]->idenlace : "-1";
            $rowInicio = 1;
            if ($opciones) {
                $datosEnlace = $this->getEnlace($idEnlace);
                switch ($opciones) {

                    case 'ReporteS09':
                        $this->excel->setActiveSheetIndex(0)->mergeCells('A1:Y1');
                        $this->excel->getActiveSheet()->setCellValue('A1', 'Movimiento Familiar Cristiano');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("28"), "A1");
                        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                        $this->excel->setActiveSheetIndex(0)->mergeCells('A2:Y2');
                        $this->excel->getActiveSheet()->setCellValue('A2', 'Equipo Nacional');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("20"), "A2");
                        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('A6:Y6');
                        $this->excel->getActiveSheet()->setCellValue('A6', 'PLANILLA DE CONTROL DE ASITENCIA EN REUNIONES DEL EQUIPO BASICO - CBF');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("15"), "A6");
                        $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->getActiveSheet()->setCellValue('A9', 'Diócesis : ' . ((count($registros) > 0) ? $registros[0]->diocesis : ""));
                        $this->excel->getActiveSheet()->getStyle("A9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('H9', 'Base Parroquial : ' . ((count($registros) > 0) ? $registros[0]->base : ""));
                        $this->excel->getActiveSheet()->getStyle("H9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('U9', 'Ciudad : ');
                        $this->excel->getActiveSheet()->getStyle("U9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('A11', 'Nombre del Equipo Básico : ' . ((count($registros) > 0) ? $registros[0]->grupo : ""));
                        $this->excel->getActiveSheet()->getStyle("A11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('H11', 'Nivel : ' . ((count($registros) > 0) ? $registros[0]->nivel : ""));
                        $this->excel->getActiveSheet()->getStyle("H11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('L11', 'Fecha desde : ' . $fechaDesde);
                        $this->excel->getActiveSheet()->getStyle("L11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('U11', 'Fecha Hasta : ' . $fechaHasta);
                        $this->excel->getActiveSheet()->getStyle("U11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('A13', 'Matrimonio Promotor de Equipo Básico : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->enlace : ""));
                        $this->excel->getActiveSheet()->getStyle("A13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('K13', 'Nº de Membresía : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->membresia : ""));
                        $this->excel->getActiveSheet()->getStyle("K13")->getFont()->setBold(true);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('V13:Y13');
                        $this->excel->getActiveSheet()->setCellValue('V13', 'FORMULARIO  S - 09');
                        $this->excel->getActiveSheet()->getStyle("V13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('V13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('B15:R15');
                        $this->excel->getActiveSheet()->setCellValue('B15', 'ASISTENCIA A REUNIONES DE ESTUDIO');
                        $this->excel->getActiveSheet()->getStyle('B15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('S15:U15');
                        $this->excel->getActiveSheet()->setCellValue('S15', 'TIEMPOS FUERTES');
                        $this->excel->getActiveSheet()->getStyle('S15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('V15:X15');
                        $this->excel->getActiveSheet()->setCellValue('V15', 'REUNIONES GENERALES');
                        $this->excel->getActiveSheet()->getStyle('V15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->getActiveSheet()->setCellValue('Y15', 'OBS');
                        $this->excel->getActiveSheet()->setCellValue('A16', 'MATRIMONIO');
                        $this->excel->getActiveSheet()->getStyle('A16:Y16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle("A15:Y16")->getFont()->setBold(true);

                        //$this->excel->getActiveSheet()->getColumnDimension('B18:Y18')->setAutoSize(true);
                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(55);
                        $this->excel->getActiveSheet()->setCellValue('B16', '1');
                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('C16', '2');
                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('D16', '3');
                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('E16', '4');
                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('F16', '5');
                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('G16', '6');
                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('H16', '7');
                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('I16', '8');
                        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('J16', '9');
                        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('K16', '10');
                        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('L16', '11');
                        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('M16', '12');
                        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('N16', '13');
                        $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('O16', '14');
                        $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('P16', '15');
                        $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('Q16', '16');
                        $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('R16', '17');
                        $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('S16', 'KERYG');
                        $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('T16', 'ENC. C.');
                        $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('U16', 'ENC. F.');
                        $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('V16', 'CUARES');
                        $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('W16', 'PENT');
                        $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('X16', 'ADV');
                        $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('Y16', '');
                        $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(7);


                        $styleArray = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        );
                        $bordeSuperior = array(
                            'borders' => array(
                                'top' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THICK
                                )
                            )
                        );
//             $this->excel->getDefaultStyle()->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


                        $rowInicio = 17;
                        break;
                }

                $i = $rowInicio;
                $inicio = $rowInicio;
                foreach ($query as $key => $value) {
                    $subI = 0;
                    $idmatrimonioAnt = 0;
                    foreach ($value as $subIndice => $dato) {

                        $idMatrimonio = strrchr($subIndice, "-");
                        $int = intval($dato);
                        if ($int > 0) {
                            $dato = "P";
                        }

                        if (is_object($dato)) {
                            $dato = '';
                        }
                        if ($idMatrimonio != $idmatrimonioAnt && $idmatrimonioAnt != 0) {
                            $subI = 0;
                            $i++;
                            $idmatrimonioAnt = $idMatrimonio;
                            //$this->excel->getActiveSheet()->setCellValue($columnas[$subI] . $i, (is_string($dato) ? trim($dato) : $dato));
                            $this->excel->getActiveSheet()->setCellValue($columnas[$int] . $i, (is_string($dato) ? trim($dato) : $dato));
                            $subI++;
                            continue;
                        }
                        //$this->excel->getActiveSheet()->setCellValue($columnas[$subI] . $i, (is_string($dato) ? trim($dato) : $dato));
                        $this->excel->getActiveSheet()->setCellValue($columnas[$int] . $i, (is_string($dato) ? trim($dato) : $dato));

                        $subI++;

                        $idmatrimonioAnt = $idMatrimonio;
                    }
                }
            }

            if (!$opciones) {
                $this->excel->getActiveSheet()->setSharedStyle(
                        $this->colorAzulOscuro(), "A" . $rowInicio . ":" . $ultima_col . $rowInicio
                );
            }
            $this->excel->getActiveSheet()->getStyle("A15:Y" . $i)->applyFromArray($styleArray); //todos los bordes lados 
            $this->excel->getActiveSheet()->getStyle("A3:Y3")->applyFromArray($bordeSuperior);

            $this->excel->getActiveSheet()->getStyle('B17:Y' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //centra la celda
            $this->excel->getActiveSheet()->setShowGridlines(false); //oculta la cuadricula

            $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //orientacion de hoja horizontal
            $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //tamaño de papel
            //inserta el logo
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $logo = FCPATH . 'assets/img/logo.png'; // Provide path to your logo file
            $objDrawing->setPath($logo);
            $objDrawing->setOffsetX(150);    // setOffsetX works properly
            $objDrawing->setOffsetY(0);  //setOffsetY has no effect
            $objDrawing->setCoordinates('A1');
            $objDrawing->setHeight(75); // logo height
            $objDrawing->setWorksheet($this->excel->getActiveSheet());





            $hoy = date("Y-m-d");
            $fileName = "reporte_" . ($fileName ? $fileName : '') . $hoy . ".xlsx";

            ob_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('./reporte_file/' . $fileName);

            return $fileName;
        }
        return FALSE;
    }

    function arma_excelJuvenil($query, $registros, $fechaDesde, $fechaHasta, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

        if ($query) {
            $columnas = range('A', 'Z');
            foreach ($columnas as $key => $value) {
                $columnas[] = $columnas[0] . $value;
            }

            $this->excel->setActiveSheetIndex(0);
            $idPromotor = (count($registros) > 0) ? $registros[0]->idpromotor : "-1";
            $rowInicio = 1;
            if ($opciones) {
                $datosEnlace = $this->getPromotor($idPromotor);
                switch ($opciones) {

                    case 'ReporteSJ09':
                        $this->excel->setActiveSheetIndex(0)->mergeCells('A1:Y1');
                        $this->excel->getActiveSheet()->setCellValue('A1', 'Movimiento Familiar Cristiano');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("28"), "A1");
                        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                        $this->excel->setActiveSheetIndex(0)->mergeCells('A2:Y2');
                        $this->excel->getActiveSheet()->setCellValue('A2', 'Equipo Nacional');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("20"), "A2");
                        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('A6:Y6');
                        $this->excel->getActiveSheet()->setCellValue('A6', 'PLANILLA DE CONTROL DE ASITENCIA EN REUNIONES DEL EQUIPO BASICO - CBF');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("15"), "A6");
                        $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->getActiveSheet()->setCellValue('A9', 'Diócesis : ' . ((count($registros) > 0) ? $registros[0]->diocesis : ""));
                        $this->excel->getActiveSheet()->getStyle("A9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('H9', 'Base Parroquial : ' . ((count($registros) > 0) ? $registros[0]->base : ""));
                        $this->excel->getActiveSheet()->getStyle("H9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('U9', 'Ciudad : ');
                        $this->excel->getActiveSheet()->getStyle("U9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('A11', 'Nombre del Equipo Básico : ' . ((count($registros) > 0) ? $registros[0]->grupo : ""));
                        $this->excel->getActiveSheet()->getStyle("A11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('H11', 'Nivel : ' . ((count($registros) > 0) ? $registros[0]->nivel : ""));
                        $this->excel->getActiveSheet()->getStyle("H11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('L11', 'Fecha desde : ' . $fechaDesde);
                        $this->excel->getActiveSheet()->getStyle("L11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('U11', 'Fecha Hasta : ' . $fechaHasta);
                        $this->excel->getActiveSheet()->getStyle("U11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('A13', 'Joven Promotor de Equipo Básico : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->promotor : ""));
                        $this->excel->getActiveSheet()->getStyle("A13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('K13', 'Nº de Membresía : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->membresia : ""));
                        $this->excel->getActiveSheet()->getStyle("K13")->getFont()->setBold(true);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('V13:Y13');
                        $this->excel->getActiveSheet()->setCellValue('V13', 'FORMULARIO  S - 09');
                        $this->excel->getActiveSheet()->getStyle("V13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('V13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('B15:R15');
                        $this->excel->getActiveSheet()->setCellValue('B15', 'ASISTENCIA A REUNIONES DE ESTUDIO');
                        $this->excel->getActiveSheet()->getStyle('B15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('S15:U15');
                        $this->excel->getActiveSheet()->setCellValue('S15', 'TIEMPOS FUERTES');
                        $this->excel->getActiveSheet()->getStyle('S15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('V15:X15');
                        $this->excel->getActiveSheet()->setCellValue('V15', 'REUNIONES GENERALES');
                        $this->excel->getActiveSheet()->getStyle('V15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->getActiveSheet()->setCellValue('Y15', 'OBS');
                        $this->excel->getActiveSheet()->setCellValue('A16', 'JOVEN');
                        $this->excel->getActiveSheet()->getStyle('A16:Y16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle("A15:Y16")->getFont()->setBold(true);

                        //$this->excel->getActiveSheet()->getColumnDimension('B18:Y18')->setAutoSize(true);
                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(55);
                        $this->excel->getActiveSheet()->setCellValue('B16', '1');
                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('C16', '2');
                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('D16', '3');
                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('E16', '4');
                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('F16', '5');
                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('G16', '6');
                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('H16', '7');
                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('I16', '8');
                        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('J16', '9');
                        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('K16', '10');
                        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('L16', '11');
                        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('M16', '12');
                        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('N16', '13');
                        $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('O16', '14');
                        $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('P16', '15');
                        $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('Q16', '16');
                        $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('R16', '17');
                        $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(3);
                        $this->excel->getActiveSheet()->setCellValue('S16', 'KERYG');
                        $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('T16', 'ENC. C.');
                        $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('U16', 'ENC. F.');
                        $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('V16', 'CUARES');
                        $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('W16', 'PENT');
                        $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('X16', 'ADV');
                        $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(7);
                        $this->excel->getActiveSheet()->setCellValue('Y16', '');
                        $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(7);


                        $styleArray = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        );
                        $bordeSuperior = array(
                            'borders' => array(
                                'top' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THICK
                                )
                            )
                        );
//             $this->excel->getDefaultStyle()->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


                        $rowInicio = 17;
                        break;
                }

                $i = $rowInicio;
                $inicio = $rowInicio;
                foreach ($query as $key => $value) {
                    $subI = 0;
                    $idmatrimonioAnt = 0;
                    foreach ($value as $subIndice => $dato) {

                        $idMatrimonio = strrchr($subIndice, "-");
                        $int = intval($dato);
                        if ($int > 0) {
                            $dato = "P";
                        }

                        if (is_object($dato)) {
                            $dato = '';
                        }
                        if ($idMatrimonio != $idmatrimonioAnt && $idmatrimonioAnt != 0) {
                            $subI = 0;
                            $i++;
                            $idmatrimonioAnt = $idMatrimonio;
                            $this->excel->getActiveSheet()->setCellValue($columnas[$int] . $i, (is_string($dato) ? trim($dato) : $dato));
                            $subI++;
                            continue;
                        }
                        $this->excel->getActiveSheet()->setCellValue($columnas[$int] . $i, (is_string($dato) ? trim($dato) : $dato));

                        $subI++;

                        $idmatrimonioAnt = $idMatrimonio;
                    }
                }
            }

            if (!$opciones) {
                $this->excel->getActiveSheet()->setSharedStyle(
                        $this->colorAzulOscuro(), "A" . $rowInicio . ":" . $ultima_col . $rowInicio
                );
            }
            $this->excel->getActiveSheet()->getStyle("A15:Y" . $i)->applyFromArray($styleArray); //todos los bordes lados 
            $this->excel->getActiveSheet()->getStyle("A3:Y3")->applyFromArray($bordeSuperior);

            $this->excel->getActiveSheet()->getStyle('B17:Y' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //centra la celda
            $this->excel->getActiveSheet()->setShowGridlines(false); //oculta la cuadricula

            $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //orientacion de hoja horizontal
            $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //tamaño de papel
            //inserta el logo
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $logo = FCPATH . 'assets/img/logo.png'; // Provide path to your logo file
            $objDrawing->setPath($logo);
            $objDrawing->setOffsetX(150);    // setOffsetX works properly
            $objDrawing->setOffsetY(0);  //setOffsetY has no effect
            $objDrawing->setCoordinates('A1');
            $objDrawing->setHeight(75); // logo height
            $objDrawing->setWorksheet($this->excel->getActiveSheet());





            $hoy = date("Y-m-d");
            $fileName = "reporte_" . ($fileName ? $fileName : '') . $hoy . ".xlsx";

            ob_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('./reporte_file/' . $fileName);

            return $fileName;
        }
        return FALSE;
    }

    function arma_excelCuadrante($query, $registros, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

        if ($query) {
            $columnas = range('A', 'Z');
            foreach ($columnas as $key => $value) {
                $columnas[] = $columnas[0] . $value;
            }

            $this->excel->setActiveSheetIndex(0);
            $idEnlace = (count($registros) > 0) ? $registros[0]->idenlace : "-1";
            $rowInicio = 1;
            if ($opciones) {
                $datosEnlace = $this->getEnlace($idEnlace);
                switch ($opciones) {

                    case 'ReporteCuadrante':
                        $this->excel->setActiveSheetIndex(0)->mergeCells('A1:I1');
                        $this->excel->getActiveSheet()->setCellValue('A1', 'Movimiento Familiar Cristiano');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("28"), "A1");
                        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                        $this->excel->setActiveSheetIndex(0)->mergeCells('A2:I2');
                        $this->excel->getActiveSheet()->setCellValue('A2', 'Equipo Nacional');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("20"), "A2");
                        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('A6:I6');
                        $this->excel->getActiveSheet()->setCellValue('A6', 'PLANILLA DE CUADRANTE DEL EQUIPO BASICO');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("15"), "A6");
                        $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->getActiveSheet()->setCellValue('A9', 'Diócesis : ' . ((count($registros) > 0) ? $registros[0]->diocesis : ""));
                        $this->excel->getActiveSheet()->getStyle("A9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D9', 'Base Parroquial : ' . ((count($registros) > 0) ? $registros[0]->base : ""));
                        $this->excel->getActiveSheet()->getStyle("D9")->getFont()->setBold(true);

                        $this->excel->getActiveSheet()->setCellValue('A11', 'Nombre del Equipo Básico : ' . ((count($registros) > 0) ? $registros[0]->grupo : ""));
                        $this->excel->getActiveSheet()->getStyle("A11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D11', 'Nivel : ' . ((count($registros) > 0) ? $registros[0]->nivel : ""));
                        $this->excel->getActiveSheet()->getStyle("D11")->getFont()->setBold(true);

                        $this->excel->getActiveSheet()->setCellValue('A13', 'Matrimonio Promotor de Equipo Básico : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->enlace : ""));
                        $this->excel->getActiveSheet()->getStyle("A13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D13', 'Nº de Membresía : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->membresia : ""));
                        $this->excel->getActiveSheet()->getStyle("D13")->getFont()->setBold(true);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('G13:G13');
                        $this->excel->getActiveSheet()->setCellValue('G13', 'CUADRANTE');
                        $this->excel->getActiveSheet()->getStyle("G13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('G13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                        $this->excel->getActiveSheet()->setCellValue('A15', 'MATRIMONIO');
                        $this->excel->getActiveSheet()->getStyle('A15:I15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle("A15:I15")->getFont()->setBold(true);


                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(55);
                        $this->excel->getActiveSheet()->setCellValue('B15', 'Celular El');
                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('C15', 'Celular Ella');
                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('D15', 'Telefono');
                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('E15', 'Fecha Nac. El');
                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('F15', 'Fecha Nac. Ella');
                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('G15', 'Aniversario');
                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('H15', 'Grupo');
                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('I15', 'Nro. Membresía');
                        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);

                        $styleArray = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        );
                        $bordeSuperior = array(
                            'borders' => array(
                                'top' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THICK
                                )
                            )
                        );

                        $rowInicio = 16;
                        break;
                }

                $i = $rowInicio;


                foreach ($query[0] as $key => $value) {
                    $subI = 0;

                    foreach ($value as $subIndice => $dato) {



                        if (is_object($dato)) {
                            $dato = '';
                        }

                        $this->excel->getActiveSheet()->setCellValue($columnas[$subI] . $i, (is_string($dato) ? trim($dato) : $dato));

                        $subI++;
                    }
                    $i++;
                }
            }

            if (!$opciones) {
                $this->excel->getActiveSheet()->setSharedStyle(
                        $this->colorAzulOscuro(), "A" . $rowInicio . ":" . $ultima_col . $rowInicio
                );
            }
            $this->excel->getActiveSheet()->getStyle("A15:I" . $i)->applyFromArray($styleArray); //todos los bordes lados 
            $this->excel->getActiveSheet()->getStyle("A3:I3")->applyFromArray($bordeSuperior);

            $this->excel->getActiveSheet()->getStyle('B17:I' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //centra la celda
            $this->excel->getActiveSheet()->setShowGridlines(false); //oculta la cuadricula

            $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //orientacion de hoja horizontal
            $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //tamaño de papel
            //inserta el logo
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $logo = FCPATH . 'assets/img/logo.png'; // Provide path to your logo file
            $objDrawing->setPath($logo);
            $objDrawing->setOffsetX(150);    // setOffsetX works properly
            $objDrawing->setOffsetY(0);  //setOffsetY has no effect
            $objDrawing->setCoordinates('A1');
            $objDrawing->setHeight(75); // logo height
            $objDrawing->setWorksheet($this->excel->getActiveSheet());





            $hoy = date("Y-m-d");
            $fileName = "reporte_" . ($fileName ? $fileName : '') . $hoy . ".xlsx";

            ob_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('./reporte_file/' . $fileName);

            return $fileName;
        }
        return FALSE;
    }
    function arma_excelCuadranteMiembros($query, $registros, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

        if ($query) {
            $columnas = range('A', 'Z');
            foreach ($columnas as $key => $value) {
                $columnas[] = $columnas[0] . $value;
            }

            $this->excel->setActiveSheetIndex(0);
            $idEnlace = (count($registros) > 0) ? $registros[0]->idenlace : "-1";
            $rowInicio = 1;
            if ($opciones) {
                $datosEnlace = $this->getEnlace($idEnlace);
                switch ($opciones) {

                    case 'ReporteCuadranteMiembros':
                        $this->excel->setActiveSheetIndex(0)->mergeCells('A1:I1');
                        $this->excel->getActiveSheet()->setCellValue('A1', 'Movimiento Familiar Cristiano');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("28"), "A1");
                        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                        $this->excel->setActiveSheetIndex(0)->mergeCells('A2:I2');
                        $this->excel->getActiveSheet()->setCellValue('A2', 'Equipo Nacional');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("20"), "A2");
                        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('A6:I6');
                        $this->excel->getActiveSheet()->setCellValue('A6', 'PLANILLA DE CUADRANTE DEL EQUIPO BASICO');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("15"), "A6");
                        $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->getActiveSheet()->setCellValue('A9', 'Diócesis : ' . ((count($registros) > 0) ? $registros[0]->diocesis : ""));
                        $this->excel->getActiveSheet()->getStyle("A9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D9', 'Base Parroquial : ' . ((count($registros) > 0) ? $registros[0]->base : ""));
                        $this->excel->getActiveSheet()->getStyle("D9")->getFont()->setBold(true);

                        $this->excel->getActiveSheet()->setCellValue('A11', 'Nombre del Equipo Básico : ' . ((count($registros) > 0) ? $registros[0]->grupo : ""));
                        $this->excel->getActiveSheet()->getStyle("A11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D11', 'Nivel : ' . ((count($registros) > 0) ? $registros[0]->nivel : ""));
                        $this->excel->getActiveSheet()->getStyle("D11")->getFont()->setBold(true);

                        $this->excel->getActiveSheet()->setCellValue('A13', 'Matrimonio Promotor de Equipo Básico : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->enlace : ""));
                        $this->excel->getActiveSheet()->getStyle("A13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D13', 'Nº de Membresía : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->membresia : ""));
                        $this->excel->getActiveSheet()->getStyle("D13")->getFont()->setBold(true);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('G13:G13');
                        $this->excel->getActiveSheet()->setCellValue('G13', 'CUADRANTE MEMBRESIA');
                        $this->excel->getActiveSheet()->getStyle("G13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('G13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                        $this->excel->getActiveSheet()->setCellValue('A15', 'MATRIMONIO');
                        $this->excel->getActiveSheet()->getStyle('A15:I15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle("A15:I15")->getFont()->setBold(true);


                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(55);
                        $this->excel->getActiveSheet()->setCellValue('B15', 'Celular El');
                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('C15', 'Celular Ella');
                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('D15', 'Telefono');
                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('E15', 'Fecha Encuentro');
                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('F15', 'Fecha Membresia');
                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('G15', 'Base');
                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('H15', 'Grupo');
                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('I15', 'Nro. Membresía');
                        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);

                        $styleArray = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        );
                        $bordeSuperior = array(
                            'borders' => array(
                                'top' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THICK
                                )
                            )
                        );


                        $rowInicio = 16;
                        break;
                }

                $i = $rowInicio;


                foreach ($query[0] as $key => $value) {
                    $subI = 0;

                    foreach ($value as $subIndice => $dato) {



                        if (is_object($dato)) {
                            $dato = '';
                        }

                        $this->excel->getActiveSheet()->setCellValue($columnas[$subI] . $i, (is_string($dato) ? trim($dato) : $dato));

                        $subI++;
                    }
                    $i++;
                }
            }

            if (!$opciones) {
                $this->excel->getActiveSheet()->setSharedStyle(
                        $this->colorAzulOscuro(), "A" . $rowInicio . ":" . $ultima_col . $rowInicio
                );
            }
            $this->excel->getActiveSheet()->getStyle("A15:I" . $i)->applyFromArray($styleArray); //todos los bordes lados 
            $this->excel->getActiveSheet()->getStyle("A3:I3")->applyFromArray($bordeSuperior);

            $this->excel->getActiveSheet()->getStyle('B17:I' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //centra la celda
            $this->excel->getActiveSheet()->setShowGridlines(false); //oculta la cuadricula

            $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //orientacion de hoja horizontal
            $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //tamaño de papel
            //inserta el logo
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $logo = FCPATH . 'assets/img/logo.png'; // Provide path to your logo file
            $objDrawing->setPath($logo);
            $objDrawing->setOffsetX(150);    // setOffsetX works properly
            $objDrawing->setOffsetY(0);  //setOffsetY has no effect
            $objDrawing->setCoordinates('A1');
            $objDrawing->setHeight(75); // logo height
            $objDrawing->setWorksheet($this->excel->getActiveSheet());

            $hoy = date("Y-m-d");
            $fileName = "reporte_" . ($fileName ? $fileName : '') . $hoy . ".xlsx";

            ob_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('./reporte_file/' . $fileName);

            return $fileName;
        }
        return FALSE;
    }
    function arma_excelCuadranteS07($query, $registros, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

        if ($query) {
            $columnas = range('A', 'Z');
            foreach ($columnas as $key => $value) {
                $columnas[] = $columnas[0] . $value;
            }

            $this->excel->setActiveSheetIndex(0);
            $idEnlace = (count($registros) > 0) ? $registros[0]->idenlace : "-1";
            $rowInicio = 1;
            if ($opciones) {
                $datosEnlace = $this->getEnlace($idEnlace);
                switch ($opciones) {

                    case 'ReporteCuadrante':
                        $this->excel->setActiveSheetIndex(0)->mergeCells('A1:K1');
                        $this->excel->getActiveSheet()->setCellValue('A1', 'Movimiento Familiar Cristiano');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("28"), "A1");
                        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                        $this->excel->setActiveSheetIndex(0)->mergeCells('A2:I2');
                        $this->excel->getActiveSheet()->setCellValue('A2', 'Equipo Nacional');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("20"), "A2");
                        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('A6:I6');
                        $this->excel->getActiveSheet()->setCellValue('A6', 'PLANILLA DE CUADRANTE DEL EQUIPO BASICO CON S07');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("15"), "A6");
                        $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->getActiveSheet()->setCellValue('A9', 'Diócesis : ' . ((count($registros) > 0) ? $registros[0]->diocesis : ""));
                        $this->excel->getActiveSheet()->getStyle("A9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D9', 'Base Parroquial : ' . ((count($registros) > 0) ? $registros[0]->base : ""));
                        $this->excel->getActiveSheet()->getStyle("D9")->getFont()->setBold(true);

                        $this->excel->getActiveSheet()->setCellValue('A11', 'Nombre del Equipo Básico : ' . ((count($registros) > 0) ? $registros[0]->grupo : ""));
                        $this->excel->getActiveSheet()->getStyle("A11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D11', 'Nivel : ' . ((count($registros) > 0) ? $registros[0]->nivel : ""));
                        $this->excel->getActiveSheet()->getStyle("D11")->getFont()->setBold(true);

                        $this->excel->getActiveSheet()->setCellValue('A13', 'Matrimonio Promotor de Equipo Básico : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->enlace : ""));
                        $this->excel->getActiveSheet()->getStyle("A13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D13', 'Nº de Membresía : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->membresia : ""));
                        $this->excel->getActiveSheet()->getStyle("D13")->getFont()->setBold(true);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('G13:G13');
                        $this->excel->getActiveSheet()->setCellValue('G13', 'CUADRANTE');
                        $this->excel->getActiveSheet()->getStyle("G13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('G13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                        $this->excel->getActiveSheet()->setCellValue('A15', 'MATRIMONIO');
                        $this->excel->getActiveSheet()->getStyle('A15:K15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle("A15:K15")->getFont()->setBold(true);


                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(55);
                        $this->excel->getActiveSheet()->setCellValue('B15', 'Celular El');
                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('C15', 'Celular Ella');
                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('D15', 'Telefono');
                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('E15', 'Fecha Nac. El');
                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('F15', 'Fecha Nac. Ella');
                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('G15', 'Aniversario');
                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('H15', 'Grupo');
                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('I15', 'Nro. Membresía');
                        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('J15', 'Motivo de Salida');
                        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('K15', 'Fecha de Salida');
                        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);

                        $styleArray = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        );
                        $bordeSuperior = array(
                            'borders' => array(
                                'top' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THICK
                                )
                            )
                        );
//             $this->excel->getDefaultStyle()->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


                        $rowInicio = 16;
                        break;
                }

                $i = $rowInicio;


                foreach ($query[0] as $key => $value) {
                    $subI = 0;

                    foreach ($value as $subIndice => $dato) {



                        if (is_object($dato)) {
                            $dato = '';
                        }

                        $this->excel->getActiveSheet()->setCellValue($columnas[$subI] . $i, (is_string($dato) ? trim($dato) : $dato));

                        $subI++;
                    }
                    $i++;
                }
            }

            if (!$opciones) {
                $this->excel->getActiveSheet()->setSharedStyle(
                        $this->colorAzulOscuro(), "A" . $rowInicio . ":" . $ultima_col . $rowInicio
                );
            }
            $this->excel->getActiveSheet()->getStyle("A15:K" . $i)->applyFromArray($styleArray); //todos los bordes lados 
            $this->excel->getActiveSheet()->getStyle("A3:K3")->applyFromArray($bordeSuperior);

            $this->excel->getActiveSheet()->getStyle('B17:K' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //centra la celda
            $this->excel->getActiveSheet()->setShowGridlines(false); //oculta la cuadricula

            $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //orientacion de hoja horizontal
            $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //tamaño de papel
            //inserta el logo
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $logo = FCPATH . 'assets/img/logo.png'; // Provide path to your logo file
            $objDrawing->setPath($logo);
            $objDrawing->setOffsetX(150);    // setOffsetX works properly
            $objDrawing->setOffsetY(0);  //setOffsetY has no effect
            $objDrawing->setCoordinates('A1');
            $objDrawing->setHeight(75); // logo height
            $objDrawing->setWorksheet($this->excel->getActiveSheet());





            $hoy = date("Y-m-d");
            $fileName = "reporte_" . ($fileName ? $fileName : '') . $hoy . ".xlsx";

            ob_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('./reporte_file/' . $fileName);

            return $fileName;
        }
        return FALSE;
    }

    function arma_excelCuadranteJuvenil($query, $registros, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

        if ($query) {
            $columnas = range('A', 'Z');
            foreach ($columnas as $key => $value) {
                $columnas[] = $columnas[0] . $value;
            }

            $this->excel->setActiveSheetIndex(0);
            $idPromotor = (count($registros) > 0) ? $registros[0]->idpromotor : "-1";
            $rowInicio = 1;
            if ($opciones) {
                $datosEnlace = $this->getPromotor($idPromotor);
                switch ($opciones) {

                    case 'ReporteCuadranteJuvenil':
                        $this->excel->setActiveSheetIndex(0)->mergeCells('A1:H1');
                        $this->excel->getActiveSheet()->setCellValue('A1', 'Movimiento Familiar Cristiano');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("28"), "A1");
                        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                        $this->excel->setActiveSheetIndex(0)->mergeCells('A2:H2');
                        $this->excel->getActiveSheet()->setCellValue('A2', 'Equipo Nacional');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("20"), "A2");
                        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('A6:H6');
                        $this->excel->getActiveSheet()->setCellValue('A6', 'PLANILLA DE CUADRANTE DEL EQUIPO BASICO');
                        $this->excel->getActiveSheet()->setSharedStyle($this->sizeFontTitulo("15"), "A6");
                        $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $this->excel->getActiveSheet()->setCellValue('A9', 'Diócesis : ' . ((count($registros) > 0) ? $registros[0]->diocesis : ""));
                        $this->excel->getActiveSheet()->getStyle("A9")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D9', 'Base Parroquial : ' . ((count($registros) > 0) ? $registros[0]->base : ""));
                        $this->excel->getActiveSheet()->getStyle("D9")->getFont()->setBold(true);

                        $this->excel->getActiveSheet()->setCellValue('A11', 'Nombre del Equipo Básico : ' . ((count($registros) > 0) ? $registros[0]->grupo : ""));
                        $this->excel->getActiveSheet()->getStyle("A11")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D11', 'Nivel : ' . ((count($registros) > 0) ? $registros[0]->nivel : ""));
                        $this->excel->getActiveSheet()->getStyle("D11")->getFont()->setBold(true);

                        $this->excel->getActiveSheet()->setCellValue('A13', 'Joven Promotor de Equipo Básico : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->promotor : ""));
                        $this->excel->getActiveSheet()->getStyle("A13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->setCellValue('D13', 'Tios asesores : ' . ((count($datosEnlace) > 0) ? $datosEnlace[0]->asesor : ""));
                        $this->excel->getActiveSheet()->getStyle("D13")->getFont()->setBold(true);

                        $this->excel->setActiveSheetIndex(0)->mergeCells('G13:G13');
                        $this->excel->getActiveSheet()->setCellValue('G13', 'CUADRANTE');
                        $this->excel->getActiveSheet()->getStyle("G13")->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('G13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                        $this->excel->getActiveSheet()->setCellValue('A15', 'JOVEN');
                        $this->excel->getActiveSheet()->getStyle('A15:H15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle("A15:H15")->getFont()->setBold(true);


                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(55);
                        $this->excel->getActiveSheet()->setCellValue('B15', 'Fecha Nac.');
                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('C15', 'Celular');
                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('D15', 'Nombre del Padre');
                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('E15', 'Nombre de la Madre');
                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('F15', 'Tel. Padre');
                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('G15', 'Tel. Madre');
                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                        $this->excel->getActiveSheet()->setCellValue('H15', 'Nro. Membresía');
                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);


                        $styleArray = array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        );
                        $bordeSuperior = array(
                            'borders' => array(
                                'top' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THICK
                                )
                            )
                        );
//             $this->excel->getDefaultStyle()->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
//             $this->excel->getDefaultStyle()->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


                        $rowInicio = 16;
                        break;
                }

                $i = $rowInicio;


                foreach ($query[0] as $key => $value) {
                    $subI = 0;

                    foreach ($value as $subIndice => $dato) {



                        if (is_object($dato)) {
                            $dato = '';
                        }

                        $this->excel->getActiveSheet()->setCellValue($columnas[$subI] . $i, (is_string($dato) ? trim($dato) : $dato));

                        $subI++;
                    }
                    $i++;
                }
            }

            if (!$opciones) {
                $this->excel->getActiveSheet()->setSharedStyle(
                        $this->colorAzulOscuro(), "A" . $rowInicio . ":" . $ultima_col . $rowInicio
                );
            }
            $this->excel->getActiveSheet()->getStyle("A15:H" . $i)->applyFromArray($styleArray); //todos los bordes lados 
            $this->excel->getActiveSheet()->getStyle("A3:H3")->applyFromArray($bordeSuperior);

            $this->excel->getActiveSheet()->getStyle('B17:H' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //centra la celda
            $this->excel->getActiveSheet()->setShowGridlines(false); //oculta la cuadricula

            $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //orientacion de hoja horizontal
            $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //tamaño de papel
            //inserta el logo
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $logo = FCPATH . 'assets/img/logo.png'; // Provide path to your logo file
            $objDrawing->setPath($logo);
            $objDrawing->setOffsetX(150);    // setOffsetX works properly
            $objDrawing->setOffsetY(0);  //setOffsetY has no effect
            $objDrawing->setCoordinates('A1');
            $objDrawing->setHeight(75); // logo height
            $objDrawing->setWorksheet($this->excel->getActiveSheet());





            $hoy = date("Y-m-d");
            $fileName = "reporte_" . ($fileName ? $fileName : '') . $hoy . ".xlsx";

            ob_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            $objWriter->save('./reporte_file/' . $fileName);

            return $fileName;
        }
        return FALSE;
    }

    private function colorAzulOscuro() {
        return (new PHPExcel_Style())
                        ->applyFromArray([
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '153662')
                            ),
                            'font' => array(
                                'color' => array('rgb' => 'FFFFFF'),
                                'name' => 'Arial',
                                'size' => '10'
                            ),
        ]);
    }

    private function sizeFontTitulo($size) {
        return (new PHPExcel_Style())
                        ->applyFromArray([
                            'font' => array(
                                //'color' => array('rgb' => 'FFFFFF'),
                                'name' => 'Arial',
                                'size' => $size
                            ),
        ]);
    }

    private function getEnlace($idEnlace) {

        $this->db->select("concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace', concat(ma.el_cedula,'/',d.nomenclatura) as 'membresia'")
                ->from("matrimonio ma")
                ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                ->where("ma.idmatrimonio", $idEnlace);
//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return array();
        }
    }

    private function getPromotor($idPromotor) {

        $this->db->select("concat(ma.nombre,' ',ma.apellidoP,' ',ma.apellidoM) as 'promotor', concat(ma.cedula,'/',d.nomenclatura) as 'membresia',concat(ga.ella_nombre,' y ',ga.el_nombre,' ',ga.el_apellidos) as 'asesor'")
                ->from("joven ma")
                ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                ->join("grupos_jovenes g", "g.idgrupo=ma.idgrupo")
                ->join("matrimonio ga", "ga.idmatrimonio=g.idmatrimonio")
                ->where("ma.idjoven", $idPromotor);
//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return array();
        }
    }

}
