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

    public function getGrupos($nivel, $diocesis = 100, $base = 1000, $grupo = 0) {

        switch ($nivel) {
            case 1:
                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idjoven,g.idmatrimonio,d.nombre as 'diocesis',b.bases,concat(j.nombre,'  ',j.apellidoP,' ',j.apellidoM) as 'joven'")
                        ->from("grupos_jovenes g")
                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                        ->join("bases b", "g.idbase=b.idbase")
                        ->join("joven j", "g.idjoven=j.idjoven", "left")
                        ->where("g.borrado", 0)
                        ->order_by("g.grupos ASC");
                $q = $this->db->get();
                if ($q->num_rows() > 0) {
                    $resultado = $q->result();
                } else {
                    $resultado = array();
                }

                break;
            case 2:
                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idjoven,g.idmatrimonio,d.nombre as 'diocesis',b.bases,concat(j.nombre,'  ',j.apellidoP,' ',j.apellidoM) as 'joven'")
                        ->from("grupos_jovenes g")
                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                        ->join("bases b", "g.idbase=b.idbase")
                        ->join("joven j", "g.idjoven=j.idjoven", "left")
                        ->where("g.borrado", 0)
                        ->where("g.iddiocesis", $diocesis)
                        ->order_by("g.grupos ASC");
                $q = $this->db->get();
                if ($q->num_rows() > 0) {
                    $resultado = $q->result();
                } else {
                    $resultado = array();
                }

                break;
            case 3:
                $userData = $this->session->userdata('userData');
                $idBase = $userData->idbase;

                $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idjoven,g.idmatrimonio,d.nombre as 'diocesis',b.bases,concat(j.nombre,'  ',j.apellidoP,' ',j.apellidoM) as 'joven'")
                        ->from("grupos_jovenes g")
                        ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                        ->join("bases b", "g.idbase=b.idbase")
                        ->join("joven j", "g.idjoven=j.idjoven", "left")
                        ->where("g.borrado", 0)
                        ->where("g.idbase", $idBase)
                        ->order_by("g.grupos ASC");
                $q = $this->db->get();
                if ($q->num_rows() > 0) {
                    $resultado = $q->result();
                } else {
                    $resultado = array();
                }
                break;
        }

        return $resultado;
    }

    public function getMiembros($nivel, $diocesis = 100, $base = 1000, $grupo = 0) {

        $userData = $this->session->userdata('userData');
        $idBase = $userData->idbase;

        $this->db->select("g.idgrupo,g.grupos,g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.cedula,'/',d.nomenclatura) as membresia,concat(m.nombre,' ',m.apellidoP,' ',m.apellidoM) as joven,m.idjoven")
                ->from("grupos_jovenes g")
                ->join("miembros_grupo_jovenes mg", "g.idgrupo=mg.idgrupo and mg.estado=1 and mg.borrado=0", "left")
                ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                ->join("bases b", "g.idbase=b.idbase")
                ->join("joven m", "m.idjoven=mg.idjoven", "left")
//                        ->where("mg.estado", 1)
//                        ->where("mg.borrado", 0)
                ->where("g.idgrupo", $grupo)
                ->order_by("g.grupos ASC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }
//                break;
//        }

        return $resultado;
    }

    public function getEvaluaciones($idevaluacion = 0) {
///agregar aca la consulta para traer las
        $idevaluacion = (is_array($idevaluacion)) ? $idevaluacion[0] : $idevaluacion;
        $this->db->select("e.*,em.*,e.idgrupo,concat(m.nombre,' ',m.apellidoP,' ',m.apellidoM) as 'joven'")
                ->from("evaluacion_jovenes e")
                ->join("evaluacion_jovenes_detalle em", "em.idevaluacion=e.idevaluacion", "left")
                ->join("joven m", "m.idjoven=em.idjoven", "left")
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

    public function getEvaluacionesJovenes($idevaluacion = 0) {
///agregar aca la consulta para traer las
        $idevaluacion = (is_array($idevaluacion)) ? $idevaluacion[0] : $idevaluacion;
        $this->db->select("e.*,em.*,concat(m.nombre,' ',m.apellidoP,' ',m.apellidoM) as 'joven'")
                ->from("evaluacion_jovenes e")
                ->join("evaluacion_jovenes_detalle em", "em.idevaluacion=e.idevaluacion", "left")
                ->join("joven m", "m.idjoven=em.idjoven", "left")
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
                ->from("grupos_jovenes g")
                ->join("evaluacion_jovenes e", "g.idgrupo=g.idgrupo", "left")
                 ->join("temas_jovenes t", "t.idtema=e.tema_nro", "left")
                ->where("g.estado", 1)
                ->where("g.borrado", 0)
                ->where("g.idgrupo", $idgrupo)
                ->order_by("e.tema_nro DESC");
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
                ->from("evaluacion_jovenes e")
                ->join("grupos_jovenes g", "g.idgrupo=e.idgrupo", "left")
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

        $this->db->select("e.*,g.*,e.idevaluacion as 'idevaluacionS05',e.nivel as 'nivelEvaluacion',em.*,concat(m.nombre,' ',m.apellidoP,' ',m.apellidoM) as 'joven'")
                ->from("evaluacion_jovenes e")
                ->join("grupos_jovenes g", "g.idgrupo=e.idgrupo", "left")
                ->join("evaluacion_jovenes_detalle em", "em.idevaluacion=e.idevaluacion", "left")
                ->join("joven m", "m.idjoven=em.idjoven", "left")
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
            $this->db->select("g.idgrupo,g.idjoven,g.idmatrimonio,g.grupos as 'nombreGrupo',g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.nombre,' ',m.apellidoP,' ',m.apellidoM) as 'joven'")
                    ->from("grupos_jovenes g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("joven m", "g.idjoven=m.idjoven", "left")
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
            $this->db->select("g.idgrupo,g.idjoven,g.grupos as 'nombreGrupo',g.estado,g.iddiocesis,g.idbase,g.idgrupo,d.nombre as 'diocesis',b.bases,concat(m.nombre,' ',m.apellidoP,' ',m.apellidoM) as 'joven'")
                    ->from("grupos_jovenes g")
                    ->join("diocesis d", "g.iddiocesis=d.iddiocesis")
                    ->join("bases b", "g.idbase=b.idbase")
                    ->join("joven m", "g.idjoven=m.idjoven", "left")
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
            $resultado = $this->db->insert('grupos_jovenes', $registros);
            $idGrupo = $this->db->insert_id();
        } else {
            $this->db->where('idgrupo', $idGrupo);
            $resultado = $this->db->update('grupos_jovenes', $registros);
        }
        $result['success'] = $resultado;
        $result['idGrupo'] = $idGrupo;
        return $result;
    }

    public function guardaMiembro($accion, $idGrupo, $idjoven, $registros) {
        $existe = $this->verificamiembro($idjoven);

        if (($accion === "0") || ($existe === "0")) {
            $resultado = $this->db->insert('miembros_grupo_jovenes', $registros);
            //$idGrupo = $this->db->insert_id();
        } else {
            //$this->db->where('idgrupo', $idGrupo);
            $this->db->where('idjoven', $idjoven);
            $resultado = $this->db->update('miembros_grupo_jovenes', $registros);
        }
        $result['success'] = $resultado;
        $result['idGrupo'] = $idGrupo;
        return $result;
    }

    public function guardaS05($accion, $idEvaluacion, $registros) {

        if ($accion === "0") {
            $resultado = $this->db->insert('evaluacion_jovenes', $registros);
            $idEvaluacion = $this->db->insert_id();
        } else if ($accion === "1") {
            $this->db->where('idevaluacion', $idEvaluacion);
            $resultado = $this->db->update('evaluacion_jovenes', $registros);
        }
        $result['success'] = $resultado;
        $result['idEvaluacion'] = $idEvaluacion;
        return $result;
    }

    public function guardaEvaluacion($accion, $idEvaluacion, $idjoven, $registros) {

        if ($accion === "0") {
            $resultado = $this->db->insert('evaluacion_jovenes_detalle', $registros);
        } else if ($accion === "1") {
            $this->db->where('idevaluacion', $idEvaluacion);
            $this->db->where('idmatrimonio', $idjoven);
            $resultado = $this->db->update('evaluacion_jovenes_detalle', $registros);
        }
        $result['success'] = $resultado;
        return $result;
    }

    public function eliminaMiembroById($idGrupo, $idJoven) {

        $this->db->set('borrado', 1);
        $this->db->where('idgrupo', $idGrupo);
        $this->db->where('idjoven', $idJoven);
        $resultado = $this->db->update('miembros_grupo_jovenes');

        $result['success'] = $resultado;
        $result['idgrupo'] = $idGrupo;
        return $result;
    }

    public function eliminaEvaluacionById($idGrupo, $idEvaluacion, $idEvaJoven,$nivelEvaluacion) {

        $this->db->where('ideva_joven', $idEvaJoven);

        $resultado = $this->db->delete('evaluacion_jovenes_detalle');

        $result['success'] = $resultado;
        $result['idgrupo'] = $idGrupo;
        $result['idevaluacion'] = $idEvaluacion;
        $result['nivelEvaluacion'] = $nivelEvaluacion;
        return $result;
    }

    private function verificamiembro($idJoven) {
        $this->db->select("g.idgrupo")
                ->from("miembros_grupo_jovenes g")
                ->where("g.idjoven", $idJoven)
                ->order_by("g.idgrupo ASC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }
        return (count($resultado) > 0) ? "1" : "0";
    }
    public function getTemasJovenes($idNivel) {
        
        $this->db->select("t.nro_tema as id,t.tema as name")
                ->from("temas_jovenes t")
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
}
