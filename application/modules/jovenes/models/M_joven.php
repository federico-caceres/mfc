<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_joven extends M_general {

    var $params = '';

    public function __construct() {
        parent::__construct();
    }

    public function getJovenes($nivel, $diocesis = 100, $base = 1000, $grupo = 0) {
        switch ($nivel) {
            case 1:
                $this->db->select("m.idjoven,m.cedula,m.nombre as nombreJoven,m.apellidoP,m.apellidoM,m.estado,d.nombre,d.nomenclatura,b.bases")
                        ->from("joven m")
                        ->join("diocesis d", "m.iddiocesis=d.iddiocesis")
                        ->join("bases b", "m.idbase=b.idbase")
                        ->where("m.borrado", 0)
                        ->order_by("m.nombre ASC");
                $q = $this->db->get();
                if ($q->num_rows() > 0) {
                    $resultado = $q->result();
                } else {
                    $resultado = array();
                }

                break;
            case 2:
                $this->db->select("m.idjoven,m.cedula,m.nombre as nombreJoven,m.apellidoP,m.apellidoM,m.estado,d.nombre,d.nomenclatura,b.bases")
                        ->from("joven m")
                        ->join("diocesis d", "m.iddiocesis=d.iddiocesis")
                        ->join("bases b", "m.idbase=b.idbase")
                        ->where("m.borrado", 0)
                        ->where("m.iddiocesis", $diocesis)
                        ->order_by("m.nombre ASC");
                $q = $this->db->get();
                if ($q->num_rows() > 0) {
                    $resultado = $q->result();
                } else {
                    $resultado = array();
                }

                break;
            case 3:

                $this->db->select("m.idjoven,m.cedula,m.nombre as nombreJoven,m.apellidoP,m.apellidoM,m.estado,d.nombre,d.nomenclatura,b.bases")
                        ->from("joven m")
                        ->join("diocesis d", "m.iddiocesis=d.iddiocesis")
                        ->join("bases b", "m.idbase=b.idbase")
                        ->where("m.borrado", 0)
                        ->where("m.iddiocesis", $diocesis)
                        ->where("m.idbase", $base)
                        ->order_by("m.nombre ASC");
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

    public function verificaCedula($nroCedula) {

        $this->db->select("*")
                ->from("joven m")
                ->where("m.borrado", 0)
                ->where("m.cedula = " . $nroCedula)
                ->order_by("m.idjoven ASC");
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }
        return $resultado;
    }

    public function getJovenById($idJoven) {

        if ($idJoven[0] != "-1") {
            $this->db->select("m.*,m.nombre as nombreJoven,d.*,b.*")
                    ->from("joven m")
                    ->join("diocesis d", "m.iddiocesis=d.iddiocesis")
                    ->join("bases b", "m.idbase=b.idbase")
                    ->join("grupos g", "m.idgrupo=g.idgrupo", "left")
                    ->where("m.borrado", 0)
                    ->where("m.idjoven", $idJoven[0])
                    ->order_by("m.idjoven ASC");
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

    public function guardaJoven($accion, $idjoven, $registros) {
        if ($accion === "0") {
            $result = $this->db->insert('joven', $registros);
        } else {
            $this->db->where('idjoven', $idjoven);
            $result = $this->db->update('joven', $registros);
        }
        return $result;
    }

    public function guardaBaja($idjoven, $registros) {
        $this->db->where('idjoven', $idjoven);
        $result = $this->db->update('joven', $registros);

        return $result;
    }

    public function getGrupos($idBase, $idGrupo) {
        if ($idGrupo == "-1" && $idBase == "-1") {
            $this->db->select("g.idgrupo as id,g.grupos as name")
                    ->from("grupos_jovenes g")
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
                    ->from("grupos_jovenes g")
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
                    ->from("grupos_jovenes g")
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

    public function getListaJovenes($idDiocesis, $idBase) {
        if ($idBase == "-1" && $idDiocesis == "-1") {
            $this->db->select("m.idjoven as id,concat(m.nombre,' ',m.apellidoP,' ', m.apellidoM) as name")
                    ->from("joven m")
                    ->join("diocesis d", "d.iddiocesis=m.iddiocesis")
                    ->where("m.borrado", 0)
                    ->where("m.estado", 1);

            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else if ($idBase == "-1" && $idDiocesis != "-1") {
            $this->db->select("m.idjoven as id,concat(m.nombre,' ',m.apellidoP,' ', m.apellidoM) as name")
                    ->from("joven m")
                    ->join("diocesis d", "d.iddiocesis=m.iddiocesis")
                    ->where("m.borrado=0 and m.estado=1 and m.iddiocesis=" . $idDiocesis);

            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("m.idjoven as id,concat(m.nombre,' ',m.apellidoP,' ', m.apellidoM) as name")
                    ->from("joven m")
                    ->join("diocesis d", "d.iddiocesis=m.iddiocesis")
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

    public function getListaJovenesGrupo($idGrupo) {
        $this->db->select("m.idjoven as id,concat(m.nombre,' ',m.apellidoP,' ', m.apellidoM) as name")
                ->from("joven m")
                ->join("diocesis d", "d.iddiocesis=m.iddiocesis")
                ->join("enlaces e", "e.idmatrimonio=m.idmatrimonio")
                ->join("miembros_grupo_jovenes mg", "mg.idgrupo=" . $idGrupo)
                ->where("m.borrado=0 and m.estado=1");

        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $resultado = $q->result();
        } else {
            $resultado = array();
        }


        return $resultado;
    }

    public function getSJ02ById($idJoven) {

        if ($idJoven[0] != "-1") {
            $this->db->select("m.idjoven,m.nombre,m.apellidoM,m.apellidoP,m.cel,m.correo,m.calle as direccion,m.ciudad,m.barrio,m.telefono,m.fecha_inicio as fecha_ingreso,m.fecha_membresia,m.fecha_encuentro,m.cedula,d.nombre as 'diocesis',d.nomenclatura,b.bases,g.grupos")
                    ->from("joven m")
                    ->join("diocesis d", "m.iddiocesis=d.iddiocesis")
                    ->join("bases b", "m.idbase=b.idbase")
                    ->join("grupos_jovenes g", "m.idgrupo=g.idgrupo", "left")
                    ->where("m.borrado", 0)
                    ->where("m.idjoven", $idJoven[0])
                    ->order_by("m.idjoven ASC");
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

    public function getCursos($idJoven) {

        if ($idJoven != "-1") {
            $this->db->select("e.*,c.nombre as curso")
                    ->from("estudio_cursado_jovenes e")
                    ->join("cursos_jovenes c", "c.idcurso=e.idcurso")
                    ->where("e.idjoven", $idJoven)
                    ->order_by("e.idjoven ASC");
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

    public function getAportes($idJoven) {

        if ($idJoven != "-1") {
            $this->db->select("e.*,c.name as concepto_pago")
                    ->from("aportes_jovenes e")
                    ->join("concepto_pago c", "c.id=e.idconcepto_aporte")
                    ->where("e.idjoven", $idJoven)
                    ->order_by("e.idjoven ASC");
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

    public function getCursosList($idCurso) {
        if ($idCurso == "-1") {
            $this->db->select("idcurso as id,nombre as name")
                    ->from("cursos_jovenes")
                    ->where("borrado", 0);
            $q = $this->db->get();
            if ($q->num_rows() > 0) {
                $resultado = $q->result();
            } else {
                $resultado = array();
            }
        } else {
            $this->db->select("idcurso as id,nombre as name")
                    ->from("cursos_jovenes")
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

    public function guardaCurso($registros) {

        $result = $this->db->insert('estudio_cursado_jovenes', $registros);

        return $result;
    }

    public function eliminaCurso($idJoven, $idCurso) {

        $this->db->where('idjoven', $idJoven);
        $this->db->where('idcurso', $idCurso);
        $resultado = $this->db->delete('estudio_cursado_jovenes');

        $result['success'] = $resultado;
        $result['idJoven'] = $idJoven;

        return $result;
    }

    public function eliminaAporte($idJoven, $idAporte) {

        $this->db->where('idjoven', $idJoven);
        $this->db->where('idaporte', $idAporte);
        $resultado = $this->db->delete('aportes_jovenes');

        $result['success'] = $resultado;
        $result['idJoven'] = $idJoven;

        return $result;
    }

    public function guardaAporte($registros) {

        $result = $this->db->insert('aportes_jovenes', $registros);

        return $result;
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

}
