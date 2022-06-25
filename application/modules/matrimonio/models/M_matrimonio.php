<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_matrimonio extends M_general {

    var $params = '';

    public function __construct() {
        parent::__construct();
    }

    public function getMatrimonios($params) {

        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "1")) {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.borrado", 0)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "2")) {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $idDiocesis)
                    ->where("ma.borrado", 0)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "3")) {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado", 0)
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
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.borrado", 0)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado", 0)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("ma.borrado", 0)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
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
                    ->where("ma.borrado", 0)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    ->where("ma.borrado", 0)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    ->where("ma.borrado", 0)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("e.nivel", $params[3])
                    ->where("ma.borrado", 0)
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

    public function verificaCedula($nroCedula) {

        $this->db->select("*")
                ->from("matrimonio m")
                ->where("m.borrado", 0)
                ->where("m.el_cedula = " . $nroCedula . " or m.ella_cedula=" . $nroCedula)
                ->order_by("m.idmatrimonio ASC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }
        return $resultado;
    }

    public function getMatrimonioById($idMatrimonio) {

        if ($idMatrimonio[0] != "-1") {
            $this->db->select("*,m.idmatrimonio as idmatrimonio")
                    ->from("matrimonio m")
                    ->join("diocesis d", "m.iddiocesis=d.iddiocesis")
                    ->join("bases b", "m.idbase=b.idbase", "left")
                    ->join("grupos g", "m.idgrupo=g.idgrupo", "left")
                    //->where("m.borrado", 0)
                    ->where("m.idmatrimonio", $idMatrimonio[0])
                    ->order_by("m.idmatrimonio ASC");
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

    public function getS02ById($idMatrimonio) {

        if ($idMatrimonio[0] != "-1") {
            $this->db->select("m.idmatrimonio,m.el_nombre,m.el_apellidos,m.el_cel,m.ella_nombre,m.ella_apellidos,m.ella_cel,m.el_correo,m.ella_correo,m.direccion,m.ciudad,m.barrio,m.telefono,m.fecha_ingreso,m.fecha_membresia,m.fecha_encuentro,m.el_cedula,d.nombre as 'diocesis',d.nomenclatura,b.bases,g.grupos")
                    ->from("matrimonio m")
                    ->join("diocesis d", "m.iddiocesis=d.iddiocesis")
                    ->join("bases b", "m.idbase=b.idbase")
                    ->join("grupos g", "m.idgrupo=g.idgrupo", "left")
                    ->where("m.borrado", 0)
                    ->where("m.idmatrimonio", $idMatrimonio[0])
                    ->order_by("m.idmatrimonio ASC");
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

    public function getCursos($idMatrimonio) {

        if ($idMatrimonio != "-1") {
            $this->db->select("e.*,c.nombre as curso")
                    ->from("estudio_cursado_matrimonios e")
                    ->join("cursos c", "c.idcurso=e.idcurso")
                    ->where("e.idmatrimonio", $idMatrimonio)
                    ->order_by("e.idmatrimonio ASC");
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

    public function getAportes($idMatrimonio) {

        if ($idMatrimonio != "-1") {
            $this->db->select("e.*,c.name as concepto_pago")
                    ->from("aportes e")
                    ->join("concepto_pago c", "c.id=e.idconcepto_aporte")
                    ->where("e.idmatrimonio", $idMatrimonio)
                    ->order_by("e.idmatrimonio ASC");
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

    public function guardaMatrimonio($accion, $idmatrimonio, $registros) {
        if ($accion === "0") {
            $result = $this->db->insert('matrimonio', $registros);
        } else {
            $this->db->where('idmatrimonio', $idmatrimonio);
            $result = $this->db->update('matrimonio', $registros);
        }
        return $result;
    }

    public function guardaBaja($idmatrimonio, $registros) {
        $this->db->where('idmatrimonio', $idmatrimonio);
        $result = $this->db->update('matrimonio', $registros);

        return $result;
    }

    public function reactivarMatrimonio($idmatrimonio) {

        $this->db->set('borrado', '0');
        $this->db->set('estado', '1');
//        $registros = array(
//            'borrado' => 0,
//            'estado' => 1
//        );

        $this->db->where('idmatrimonio', $idmatrimonio[0]);
        $result = $this->db->update('matrimonio');
//        $result = $this->db->update('matrimonio', $registros);

        return $result;
    }

    public function guardaCurso($registros) {

        $result = $this->db->insert('estudio_cursado_matrimonios', $registros);

        return $result;
    }

    public function guardaAporte($registros) {

        $result = $this->db->insert('aportes', $registros);

        return $result;
    }

    public function getEstados($idEstado) {
        if ($idEstado == "-1") {
            $this->db->select("id,estado as name")
                    ->from("estado")
                    ->where("borrado", 0);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("id,estado as name")
                    ->from("estado")
                    ->where("borrado", 0)
                    ->where("id", $idEstado);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        }

        return $resultado;
    }

    public function getCursosList($idCurso) {
        if ($idCurso == "-1") {
            $this->db->select("idcurso as id,nombre as name")
                    ->from("cursos")
                    ->where("borrado", 0);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("idcurso as id,nombre as name")
                    ->from("cursos")
                    ->where("borrado", 0)
                    ->where("idcurso", $idCurso);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        }

        return $resultado;
    }

    public function getConceptosAporteList($idAporte) {
        if ($idAporte == "-1") {
            $this->db->select("id,name")
                    ->from("concepto_pago")
                    ->where("borrado", 0);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("id,name")
                    ->from("concepto_pago")
                    ->where("borrado", 0)
                    ->where("id", $idAporte);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        }

        return $resultado;
    }

    public function getDiocesis($idDiocesis) {
        if ($idDiocesis == "-1") {
            $this->db->select("iddiocesis as id,nombre as name,nomenclatura")
                    ->from("diocesis")
                    ->where("borrado", 0);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("iddiocesis as id,nombre as name,nomenclatura")
                    ->from("diocesis")
                    ->where("borrado", 0)
                    ->where("iddiocesis", $idDiocesis);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        }
        return $resultado;
    }

    public function getBases($idDiocesis, $idBase) {
        if ($idBase == "-1" && $idDiocesis == "-1") {
            $this->db->select("b.idbase as id,b.bases as name")
                    ->from("bases b")
                    ->join("diocesis d", "d.iddiocesis=b.iddiocesis")
                    ->where("b.borrado", 0);

            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else if ($idBase == "-1" && $idDiocesis != "-1") {
            $this->db->select("b.idbase as id,b.bases as name")
                    ->from("bases b")
                    ->join("diocesis d", "d.iddiocesis=b.iddiocesis")
                    ->where("b.borrado", 0)
                    ->where("d.iddiocesis", $idDiocesis);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("b.idbase as id,b.bases as name")
                    ->from("bases b")
                    ->join("diocesis d", "d.iddiocesis=b.iddiocesis")
                    ->where("b.borrado", 0)
                    ->where("b.idbase", $idBase);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        }

        return $resultado;
    }

    public function getGrupos($idBase, $idGrupo) {
        if ($idGrupo == "-1" && $idBase == "-1") {
            $this->db->select("g.idgrupo as id,g.grupos as name")
                    ->from("grupos g")
                    ->join("bases b", "b.idbase=g.idbase")
                    ->where("g.borrado", 0);

            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else if ($idGrupo == "-1" && $idBase != "-1") {
            $this->db->select("g.idgrupo as id,g.grupos as name")
                    ->from("grupos g")
                    ->join("bases b", "b.idbase=g.idbase")
                    ->where("g.borrado", 0)
                    ->where("b.idbase", $idBase);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("g.idgrupo as id,g.grupos as name")
                    ->from("grupos g")
                    ->join("bases b", "b.idbase=g.idbase")
                    ->where("g.borrado", 0)
                    ->where("g.idgrupo", $idGrupo);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        }

        return $resultado;
    }

    public function getListaMatrimonios($idDiocesis, $idBase) {
        if ($idBase == "-1" && $idDiocesis == "-1") {
            $this->db->select("m.idmatrimonio as id,concat(m.ella_nombre,' y ',m.el_nombre,' ', m.el_apellidos) as name")
                    ->from("matrimonio m")
                    ->join("diocesis d", "d.iddiocesis=m.iddiocesis")
                    ->join("enlaces e", "m.iddiocesis=e.iddiocesis")
                    ->where("m.borrado", 0)
                    ->where("m.estado", 1);

            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else if ($idBase == "-1" && $idDiocesis != "-1") {
            $this->db->select("m.idmatrimonio as id,concat(m.ella_nombre,' y ',m.el_nombre,' ', m.el_apellidos) as name")
                    ->from("matrimonio m")
                    ->join("diocesis d", "d.iddiocesis=m.iddiocesis")
                    ->join("enlaces e", "e.iddiocesis=m.iddiocesis")
                    ->where("m.borrado=0 and m.estado=1 and m.iddiocesis=" . $idDiocesis);

            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("m.idmatrimonio as id,concat(m.ella_nombre,' y ',m.el_nombre,' ', m.el_apellidos) as name")
                    ->from("matrimonio m")
                    ->join("diocesis d", "d.iddiocesis=m.iddiocesis")
                    ->join("enlaces e", "e.idmatrimonio=m.idmatrimonio", "left")
                    ->where("m.borrado=0 and m.estado=1 and m.idbase=" . $idBase);

            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        }

        return $resultado;
    }

    public function getListaMatrimoniosGrupo($idGrupo) {
        $this->db->select("m.idmatrimonio as id,concat(m.ella_nombre,' y ',m.el_nombre,' ', m.el_apellidos) as name")
                ->from("matrimonio m")
                ->join("diocesis d", "d.iddiocesis=m.iddiocesis")
                ->join("enlaces e", "e.idmatrimonio=m.idmatrimonio")
                ->join("miembros_grupo mg", "mg.idgrupo=" . $idGrupo)
                ->where("m.borrado=0 and m.estado=1");

        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }


        return $resultado;
    }

    public function getTemasMatrimonios($idNivel) {

        $this->db->select("t.nro_tema as id,t.tema as name")
                ->from("temas t")
                ->where("t.nivel", $idNivel)
                ->where("t.borrado=0 and t.estado=1");

        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }
        return $resultado;
    }

    public function eliminaCurso($idMatrimonio, $idCurso) {

        $this->db->where('idmatrimonio', $idMatrimonio);
        $this->db->where('idcurso', $idCurso);
        $resultado = $this->db->delete('estudio_cursado_matrimonios');

        $result['success'] = $resultado;
        $result['idMatrimonio'] = $idMatrimonio;

        return $result;
    }

    public function eliminaAporte($idMatrimonio, $idAporte) {

        $this->db->where('idmatrimonio', $idMatrimonio);
        $this->db->where('idaporte', $idAporte);
        $resultado = $this->db->delete('aportes');

        $result['success'] = $resultado;
        $result['idMatrimonio'] = $idMatrimonio;

        return $result;
    }
        public function getS07($params) {

        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = $userData->iddiocesis;
        $idBase = $userData->idbase;
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "1")) {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.borrado",1)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "2")) {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $idDiocesis)
                    ->where("ma.borrado",1)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] == "-1" && ($nivel == "3")) {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis")
                    ->join("bases b", "b.idbase=ma.idbase")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado",1)
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
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.borrado",1)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] == "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.borrado",1)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] == "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("ma.idgrupo", $params[2])
                    ->where("ma.borrado",1)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] != "-1" && $params[3] != "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
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
                    ->where("ma.borrado",1)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] != "-1" && $params[2] == "-1" && $params[3] != "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("ma.idbase", $params[1])
                    ->where("e.nivel", $params[3])
                    ->where("ma.borrado",1)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] != "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("ma.iddiocesis", $params[0])
                    ->where("e.nivel", $params[3])
                    ->where("ma.borrado",1)
                    ->group_by(array("ma.idmatrimonio"));

//where e.iddiocesis=1 and e.idbase=1 and e.idgrupo=16 and e.nivel=1 and e.fechaReunion between '2018-11-01' and '2018-11-20'
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                return $q->result();
            } else {
                return array();
            }
        }
        if ($params[0] == "-1" && $params[1] == "-1" && $params[2] == "-1" && $params[3] != "-1") {
            $this->db->select("ma.idmatrimonio,ma.el_cedula,ma.ella_cedula,ma.el_nombre,ma.el_apellidos,ma.ella_nombre,ma.tipo_baja as estado,d.nombre,d.nomenclatura,b.bases")
                    ->from("matrimonio ma")
                    ->join("evaluacion_matrimonios m", "m.idmatrimonio=ma.idmatrimonio", "left")
                    ->join("evaluacion e", "m.idevaluacion=e.idevaluacion", "left")
                    ->join("diocesis d", "d.iddiocesis=ma.iddiocesis", "left")
                    ->join("bases b", "b.idbase=ma.idbase", "left")
                    ->join("grupos g", "g.idgrupo=ma.idgrupo", "left")
                    ->where("e.nivel", $params[3])
                    ->where("ma.borrado",1)
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

}
