<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_grupo extends M_general {

    var $params = '';

    public function __construct() {
        parent::__construct();
    }

    public function getGrupos($params) {

        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "1")) {
            $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->where("g.borrado", 0)
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "2")) {
            $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->where("g.borrado", 0)
                    ->where("g.iddiocesis", $idDiocesis)
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "3")) {
            $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->where("g.borrado", 0)
                    ->where("g.idbase", $params[1])
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if (($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1") && ($nivel != "3")) {
            $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->where("g.borrado", 0)
                    ->where("g.iddiocesis", $params[0])
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1") {
            $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->where("g.borrado", 0)
                    ->where("g.iddiocesis", $params[0])
                    ->where("g.idbase", $params[1])
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1") {
            $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                     ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->where("g.borrado", 0)
                    ->where("g.iddiocesis", $params[0])
                    ->where("g.idbase", $params[1])
                    ->where("g.idgrupo", $params[2])
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1") {
            $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->where("g.borrado", 0)
                    ->where("g.iddiocesis", $params[0])
                    ->where("g.idbase", $params[1])
                    ->where("g.idgrupo", $params[2])
                    ->where("e.nivel", $params[3])
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1") {
                        $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->where("g.borrado", 0)
                    ->where("g.iddiocesis", $params[0])
                    ->where("g.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1") {
                        $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->where("g.borrado", 0)
                    ->where("g.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1") {
                        $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(ma.ella_nombre,' y ',ma.el_nombre,' ',ma.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio ma", "g.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->where("g.borrado", 0)
                    ->where("e.nivel", $params[3])
                    ->group_by(array("g.idgrupo"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
    }

//    public function getGrupos($nivel, $diocesis = 100, $base = 1000, $grupo = 0) {
//
//        switch ($nivel) {
//            case 1:
//                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'enlace'")
//                        ->from("grupos g")
//                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
//                        ->join("bases b", "g.idbase=b.idbase")
//                        ->join("matrimonio m", "g.idmatrimonio=m.idmatrimonio", "left")
//                        ->where("g.borrado", 0)
//                        ->order_by("g.grupos ASC");
//                $q = $this->db->get();
//                if ($q->num_rows() > 0) {
//                    $resultado = $q->result();
//                } else {
//                    $resultado = array();
//                }
//
//                break;
//            case 2:
//                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'enlace'")
//                        ->from("grupos g")
//                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
//                        ->join("bases b", "g.idbase=b.idbase")
//                        ->join("matrimonio m", "g.idmatrimonio=m.idmatrimonio", "left")
//                        ->where("g.borrado", 0)
//                        ->where("g.iddiocesis", $diocesis)
//                        ->order_by("g.grupos ASC");
//                $q = $this->db->get();
//                if ($q->num_rows() > 0) {
//                    $resultado = $q->result();
//                } else {
//                    $resultado = array();
//                }
//
//                break;
//            case 3:
//                $userData = $this->session->userdata('userData');
//                $idBase = $userData->idbase;
//
//                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'enlace'")
//                        ->from("grupos g")
//                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
//                        ->join("bases b", "g.idbase=b.idbase")
//                        ->join("matrimonio m", "g.idmatrimonio=m.idmatrimonio", "left")
//                        ->where("g.borrado", 0)
//                        ->where("g.idbase", $idBase)
//                        ->order_by("g.grupos ASC");
//                $q = $this->db->get();
//                if ($q->num_rows() > 0) {
//                    $resultado = $q->result();
//                } else {
//                    $resultado = array();
//                }
//                break;
//        }
//
//        return $resultado;
//    }
//    public function getGrupos($nivel, $diocesis = 100, $base = 1000, $grupo = 0) {
//
//        switch ($nivel) {
//            case 1:
//                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'enlace'")
//                        ->from("grupos g")
//                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
//                        ->join("bases b", "g.idbase=b.idbase")
//                        ->join("matrimonio m", "g.idmatrimonio=m.idmatrimonio", "left")
//                        ->where("g.borrado", 0)
//                        ->order_by("g.grupos ASC");
//                $q = $this->db->get();
//                if ($q->num_rows() > 0) {
//                    $resultado = $q->result();
//                } else {
//                    $resultado = array();
//                }
//
//                break;
//            case 2:
//                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'enlace'")
//                        ->from("grupos g")
//                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
//                        ->join("bases b", "g.idbase=b.idbase")
//                        ->join("matrimonio m", "g.idmatrimonio=m.idmatrimonio", "left")
//                        ->where("g.borrado", 0)
//                        ->where("g.iddiocesis", $diocesis)
//                        ->order_by("g.grupos ASC");
//                $q = $this->db->get();
//                if ($q->num_rows() > 0) {
//                    $resultado = $q->result();
//                } else {
//                    $resultado = array();
//                }
//
//                break;
//            case 3:
//                $userData = $this->session->userdata('userData');
//                $idBase = $userData->idbase;
//
//                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'enlace'")
//                        ->from("grupos g")
//                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
//                        ->join("bases b", "g.idbase=b.idbase")
//                        ->join("matrimonio m", "g.idmatrimonio=m.idmatrimonio", "left")
//                        ->where("g.borrado", 0)
//                        ->where("g.idbase", $idBase)
//                        ->order_by("g.grupos ASC");
//                $q = $this->db->get();
//                if ($q->num_rows() > 0) {
//                    $resultado = $q->result();
//                } else {
//                    $resultado = array();
//                }
//                break;
//        }
//
//        return $resultado;
//    }

    public function getMiembros($nivel, $diocesis = 100, $base = 1000, $grupo = 0) {

        $userData = $this->session->userdata('userData');
        $idBase = $userData->idbase;

        $row = $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.el_cedula,'/',d.nomenclatura) as membresia,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as pareja,m.idmatrimonio")
                ->from("grupos g")
                ->join("miembros_grupo mg", "g.idgrupo=mg.idgrupo and mg.estado=1 and mg.borrado=0", "left")
                ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                ->join("bases b", "g.idbase=b.idbase")
                ->join("matrimonio m", "m.idmatrimonio=mg.idmatrimonio", "left")
                ->where("g.idgrupo", $grupo)
                ->order_by("g.grupos ASC")
                ->get()
                ->result();
        if (count($row) > 0) {
            $resultado = $row;
        } else {
            $resultado = array();
        }


        return $resultado;
    }

    public function getEvaluaciones($idevaluacion = 0) {
///agregar aca la consulta para traer las
        $idevaluacion = (is_array($idevaluacion)) ? $idevaluacion[0] : $idevaluacion;
        $this->db->select("e.*,em.*,e.idgrupo,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'pareja'")
                ->from("evaluacion e")
                ->join("evaluacion_matrimonios em", "em.idevaluacion=e.idevaluacion", "left")
                ->join("matrimonio m", "m.idmatrimonio=em.idmatrimonio", "left")
                ->where("e.estado", 1)
                ->where("e.borrado", 0)
                ->where("e.idevaluacion", $idevaluacion)
                ->order_by("e.tema_nro DESC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }



        return $resultado;
    }

    public function getEvaluacionesMatrimonios($idevaluacion = 0) {
///agregar aca la consulta para traer las
        $idevaluacion = (is_array($idevaluacion)) ? $idevaluacion[0] : $idevaluacion;
        $this->db->select("e.*,em.*,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'pareja'")
                ->from("evaluacion e")
                ->join("evaluacion_matrimonios em", "em.idevaluacion=e.idevaluacion", "left")
                ->join("matrimonio m", "m.idmatrimonio=em.idmatrimonio", "left")
                ->where("e.estado", 1)
                ->where("e.borrado", 0)
                ->where("e.idevaluacion", $idevaluacion)
                ->order_by("e.tema_nro DESC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }



        return $resultado;
    }

    public function getGrupoS05($idgrupo = 0) {

        $this->db->select("e.*,g.*,e.nivel as nivelEvaluacion,t.tema")
                ->from("grupos g")
                ->join("evaluacion e", "e.idgrupo = g.idgrupo", "left")
                ->join("temas t", "t.nro_tema = e.tema_nro and t.nivel=e.nivel", "left")
                ->where("g.estado", 1)
                ->where("g.borrado", 0)
                ->where("g.idgrupo", $idgrupo)
                ->order_by("e.tema_nro", "DESC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }

        return $resultado;
    }

    public function getS05($idevaluacion = 0) {

        $this->db->select("e.*,g.*,e.nivel as nivelEvaluacion")
                ->from("evaluacion e")
                ->join("grupos g", "g.idgrupo=e.idgrupo", "left")
                ->where("e.estado", 1)
                ->where("e.borrado", 0)
                ->where("e.idevaluacion", $idevaluacion)
                ->order_by("e.tema_nro ASC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }

        return $resultado;
    }

    public function getEvaluacion($idevaluacion = 0) {

        $this->db->select("e.*,g.*,e.idevaluacion as 'idevaluacionS05',e.nivel as 'nivelEvaluacion',em.*,concat(m.ella_nombre,' Y ',m.el_nombre,' ',m.el_apellidos) as 'pareja'")
                ->from("evaluacion e")
                ->join("grupos g", "g.idgrupo=e.idgrupo", "left")
                ->join("evaluacion_matrimonios em", "em.idevaluacion=e.idevaluacion", "left")
                ->join("matrimonio m", "m.idmatrimonio=em.idmatrimonio", "left")
                ->where("g.estado", 1)
                ->where("g.borrado", 0)
                ->where("e.idevaluacion", $idevaluacion)
                ->order_by("e.tema_nro DESC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }

        return $resultado;
    }

    public function getGrupoById($idGrupo) {

        if ((is_array($idGrupo) && $idGrupo[0] != "0") || $idGrupo != "0") {
            $idGrupo = (is_array($idGrupo)) ? $idGrupo[0] : $idGrupo;
            $this->db->select("g.idgrupo,g.idmatrimonio,g.grupos as 'nombreGrupo',g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'enlace'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio m", "g.idmatrimonio=m.idmatrimonio", "left")
                    ->where("g.borrado", 0)
                    ->where("g.idgrupo", $idGrupo)
                    ->order_by("g.idgrupo ASC");
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

    public function getMiembroById($idGrupo) {
        if ($idGrupo[0] != "0") {
            $this->db->select("g.idgrupo,g.idmatrimonio,g.grupos as 'nombreGrupo',g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.ella_nombre,' y ',m.el_nombre,' ',m.el_apellidos) as 'pareja'")
                    ->from("grupos g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("matrimonio m", "g.idmatrimonio=m.idmatrimonio", "left")
                    ->where("g.borrado", 0)
                    ->where("g.idgrupo", $idGrupo[0])
                    ->order_by("g.idgrupo ASC");
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

    public function guardaGrupo($accion, $idGrupo, $registros) {
        if ($accion === "0") {
            $resultado = $this->db->insert('grupos', $registros);
            $idGrupo = $this->db->insert_id();
        } else {
            $this->db->where('idgrupo', $idGrupo);
            $resultado = $this->db->update('grupos', $registros);
        }
        $result['success'] = $resultado;
        $result['idGrupo'] = $idGrupo;
        return $result;
    }

    public function guardaMiembro($accion, $idGrupo, $idmatrimonio, $registros) {
        $existe = $this->verificamiembro($idmatrimonio);

        if (($accion === "0") || ($existe === "0")) {
            $resultado = $this->db->insert('miembros_grupo', $registros);
            //$idGrupo = $this->db->insert_id();
        } else {
            //$this->db->where('idgrupo', $idGrupo);
            $this->db->where('idmatrimonio', $idmatrimonio);
            $resultado = $this->db->update('miembros_grupo', $registros);
        }
        $result['success'] = $resultado;
        $result['idGrupo'] = $idGrupo;
        return $result;
    }

    public function guardaS05($accion, $idEvaluacion, $registros) {

        if ($accion === "0") {
            $resultado = $this->db->insert('evaluacion', $registros);
            $idEvaluacion = $this->db->insert_id();
        } else if ($accion === "1") {
            $this->db->where('idevaluacion', $idEvaluacion);
            $resultado = $this->db->update('evaluacion', $registros);
        }
        $result['success'] = $resultado;
        $result['idEvaluacion'] = $idEvaluacion;
        return $result;
    }

    public function guardaEvaluacion($accion, $idEvaluacion, $idmatrimonio, $registros) {

        if ($accion === "0") {
            $resultado = $this->db->insert('evaluacion_matrimonios', $registros);
        } else if ($accion === "1") {
            $this->db->where('idevaluacion', $idEvaluacion);
            $this->db->where('idmatrimonio', $idmatrimonio);
            $resultado = $this->db->update('evaluacion_matrimonios', $registros);
        }
        $result['success'] = $resultado;
        return $result;
    }

    public function eliminaMiembroById($idGrupo, $idMatrimonio) {

        $this->db->set('borrado', 1);
        $this->db->where('idgrupo', $idGrupo);
        $this->db->where('idmatrimonio', $idMatrimonio);
        $resultado = $this->db->update('miembros_grupo');

        $result['success'] = $resultado;
        $result['idgrupo'] = $idGrupo;
        return $result;
    }

    public function eliminaEvaluacionById($idGrupo, $idEvaluacion, $idEvaMatrimonio, $nivelEvaluacion) {

        $this->db->where('ideva_matrimonio', $idEvaMatrimonio);

        $resultado = $this->db->delete('evaluacion_matrimonios');

        $result['success'] = $resultado;
        $result['idgrupo'] = $idGrupo;
        $result['idevaluacion'] = $idEvaluacion;
        $result['nivelEvaluacion'] = $nivelEvaluacion;
        return $result;
    }

    private function verificamiembro($idMatrimonio) {
        $this->db->select("g.idgrupo")
                ->from("miembros_grupo g")
                ->where("g.idmatrimonio", $idMatrimonio)
                ->order_by("g.idgrupo ASC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }
        return (count($resultado) > 0) ? "1" : "0";
    }

}
