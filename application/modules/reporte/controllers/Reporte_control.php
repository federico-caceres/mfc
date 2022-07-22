<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set("max_execution_time", '3000');
ini_set('memory_limit', '2048M');

class Reporte_control extends Mfcparaguay {

    private $remitente = array();

    public function __construct() {
        parent::__construct();

        $this->load->model('m_general');
        $this->load->model('reporte/m_reporte');
        $this->load->model('matrimonio/m_matrimonio');
        $this->load->model('jovenes/m_joven');
    }

    public function genera_excel($query, $registros, $fechaDesde, $fechaHasta, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

//      $query debe recibir un array de objetos

        $ubicacion = base_url() . 'reporte_file/';

        $nombre = $this->m_reporte->arma_excel($query, $registros, $fechaDesde, $fechaHasta, $titulos, $opciones, $fileName);

        $result_final = $ubicacion . $nombre;

        return $result_final;
    }

    public function genera_excelJuvenil($query, $registros, $fechaDesde, $fechaHasta, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

//      $query debe recibir un array de objetos

        $ubicacion = base_url() . 'reporte_file/';

        $nombre = $this->m_reporte->arma_excelJuvenil($query, $registros, $fechaDesde, $fechaHasta, $titulos, $opciones, $fileName);

        $result_final = $ubicacion . $nombre;

        return $result_final;
    }

    public function genera_excelCuadrante($query, $registros, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

//      $query debe recibir un array de objetos

        $ubicacion = base_url() . 'reporte_file/';

        $nombre = $this->m_reporte->arma_excelCuadrante($query, $registros, $titulos, $opciones, $fileName);

        $result_final = $ubicacion . $nombre;

        return $result_final;
    }
    public function genera_excelCuadranteMiembros($query, $registros, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

//      $query debe recibir un array de objetos

        $ubicacion = base_url() . 'reporte_file/';

        $nombre = $this->m_reporte->arma_excelCuadranteMiembros($query, $registros, $titulos, $opciones, $fileName);

        $result_final = $ubicacion . $nombre;

        return $result_final;
    }
    public function genera_excelCuadranteS07($query, $registros, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

//      $query debe recibir un array de objetos

        $ubicacion = base_url() . 'reporte_file/';

        $nombre = $this->m_reporte->arma_excelCuadranteS07($query, $registros, $titulos, $opciones, $fileName);

        $result_final = $ubicacion . $nombre;

        return $result_final;
    }

    public function genera_excelCuadranteJuvenil($query, $registros, $titulos = NULL, $opciones = NULL, $fileName = NULL) {

//      $query debe recibir un array de objetos

        $ubicacion = base_url() . 'reporte_file/';

        $nombre = $this->m_reporte->arma_excelCuadranteJuvenil($query, $registros, $titulos, $opciones, $fileName);

        $result_final = $ubicacion . $nombre;

        return $result_final;
    }

    public function viewReporteS09Busca() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tableroS09' => Modules::run('reporte/Reporte_control/viewReporteS09Tablero', array('-1', '-1', '-1', '-1', '-1', '-1')),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('viewReporteS09', $datos, TRUE);

        echo json_encode($data);
    }

    public function viewReporteSJ09Busca() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tableroSJ09' => Modules::run('reporte/Reporte_control/viewReporteSJ09Tablero', array('-1', '-1', '-1', '-1', '-1', '-1')),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_joven->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('viewReporteSJ09', $datos, TRUE);

        echo json_encode($data);
    }

    public function viewReporteCuadranteBusca() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tableroCuadrante' => Modules::run('reporte/Reporte_control/viewReporteCuadranteTablero', array('-1', '-1', '-1', '-1', '-1', '-1')),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('viewReporteCuadrante', $datos, TRUE);

        echo json_encode($data);
    }
    public function viewReporteCuadranteMiembrosBusca() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tableroCuadrante' => Modules::run('reporte/Reporte_control/viewReporteCuadranteTableroMiembros', array('-1', '-1', '-1', '-1', '-1', '-1')),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('viewReporteCuadranteMiembros', $datos, TRUE);

        echo json_encode($data);
    }

    public function viewReporteCursosMatrimonios() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tablaCursos' => Modules::run('reporte/Reporte_control/viewTableCursosMatrimonios'),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_matrimonio->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('vistaReporteCursosMatrimonios', $datos, TRUE);

        echo json_encode($data);
    }

    public function viewReporteCantidadMatrimonios() {

        $datos = array(
            'cantidades' => $this->m_reporte->getCantidadMatrimoniosPorDiocesis(),
            'total' => $this->m_reporte->getCantidadMatrimoniosTotal());

        $data['vista'] = $this->load->view('vistaReporteCantidadMatrimonios', $datos, TRUE);

        echo json_encode($data);
    }

    public function viewReporteCuadranteJuvenilBusca() {
        $userData = $this->session->userdata('userData');
        $nivel = $userData->nivel;
        $idDiocesis = (($nivel == 1) ? "-1" : $userData->iddiocesis);
        $idBase = (($nivel != 3) ? "-1" : $userData->idbase);

        $datos = array(
            'tableroCuadranteJuvenil' => Modules::run('reporte/Reporte_control/viewReporteCuadranteJuvenilTablero', array('-1', '-1', '-1', '-1', '-1', '-1')),
            'diocesis' => $this->m_matrimonio->getDiocesis($idDiocesis),
            'bases' => $this->m_matrimonio->getBases($idDiocesis, $idBase),
            'grupos' => $this->m_joven->getGrupos($idBase, "-1")
        );

        $data['vista'] = $this->load->view('viewReporteCuadranteJuvenil', $datos, TRUE);

        echo json_encode($data);
    }

    public function viewReporteS09Tablero($params) {

        $bd_Flag = (($params[4] !== '-1') and ( $params[5] !== '-1')) ? $this->checkDates($params[4], $params[5]) : 0;
        $registros = $this->m_reporte->get_infoReportS09(array($params[0], $params[1], $params[2], $params[3], $this->formato_mysql($params[4]), $this->formato_mysql($params[5])), $bd_Flag);
        //$mostrarReporte = array();

        $this->load->view('vistaReporteS09Tablero', array('ReporteS09' => $registros));
    }

    public function viewReporteSJ09Tablero($params) {

        $bd_Flag = (($params[4] !== '-1') and ( $params[5] !== '-1')) ? $this->checkDates($params[4], $params[5]) : 0;
        $registros = $this->m_reporte->get_infoReportSJ09(array($params[0], $params[1], $params[2], $params[3], $this->formato_mysql($params[4]), $this->formato_mysql($params[5])), $bd_Flag);
        //$mostrarReporte = array();

        $this->load->view('vistaReporteSJ09Tablero', array('ReporteSJ09' => $registros));
    }

    public function viewReporteCuadranteTablero($params) {

        $bd_Flag = ($params[4] !== '-1') ? $this->checkDates($params[4], "-1") : 0;
        $registros = $this->m_reporte->get_infoReportCuadrante(array($params[0], $params[1], $params[2], $params[3], $this->formato_mysql($params[4])), $bd_Flag);
        //$mostrarReporte = array();

        $this->load->view('vistaReporteCuadranteTablero', array('ReporteCuadrante' => $registros));
    }
    public function viewReporteCuadranteTableroMiembros($params) {

        $bd_Flag = ($params[4] !== '-1') ? $this->checkDates($params[4], "-1") : 0;
        $registros = $this->m_reporte->get_infoReportCuadranteMiembros(array($params[0], $params[1], $params[2], $params[3], $this->formato_mysql($params[4])), $bd_Flag);

        $this->load->view('vistaReporteCuadranteTableroMiembros', array('ReporteCuadranteMiembros' => $registros));
    }
    public function vistaReporteCursosMatrimonios($params) {

        $data = $this->m_reporte->getFilterCursosMatrimonios(array($params[0], $params[1], $params[2]));

        $this->load->view('tablaCursosMatrimonios', array('data' => $data));
    }

    public function viewTableCursosMatrimonios(){
        $data = $this->m_reporte->getCursosMatrimonios();
        $this->load->view('tablaCursosMatrimonios', array('data'=> $data));
    }

    public function viewReporteCuadranteJuvenilTablero($params) {

        //$bd_Flag = (($params[4] !== '-1') and ( $params[5] !== '-1')) ? $this->checkDates($params[4], $params[5]) : 0;
        $registros = $this->m_reporte->get_infoReportCuadranteJuvenil(array($params[0], $params[1], $params[2], $params[3]));
        //$mostrarReporte = array();

        $this->load->view('vistaReporteCuadranteJuvenilTablero', array('ReporteCuadranteJuvenil' => $registros));
    }

    public function generaReporteExcelS09($params) {
        $userData = $this->session->userdata('userData');

        $bd_Flag = (($params[4] !== '-1') and ( $params[5] !== '-1')) ? $this->checkDates($params[4], $params[5]) : 0;
        $fechaDesde = $this->formato_mysql($params[4]);
        $fechaHasta = $this->formato_mysql($params[5]);
        $registros = $this->m_reporte->get_infoReportS09(array($params[0], $params[1], $params[2], $params[3], $fechaDesde, $fechaHasta), $bd_Flag);
        $titulos = NULL;
        $detalleReporte = $this->_reporteS09($registros, $params);
        $result['name_archivo'] = $this->genera_excel($detalleReporte, $registros, $params[4], $params[5], $titulos, 'ReporteS09', 's09-' . $userData->idusuario . '-');
        $result['ubicacion_archivo'] = base_url() . 'reporte_file/';

        echo json_encode($result);
    }

    public function generaReporteExcelSJ09($params) {
        $userData = $this->session->userdata('userData');

        $bd_Flag = (($params[4] !== '-1') and ( $params[5] !== '-1')) ? $this->checkDates($params[4], $params[5]) : 0;
        $fechaDesde = $this->formato_mysql($params[4]);
        $fechaHasta = $this->formato_mysql($params[5]);
        $registros = $this->m_reporte->get_infoReportSJ09(array($params[0], $params[1], $params[2], $params[3], $fechaDesde, $fechaHasta), $bd_Flag);
        $titulos = NULL;
        $detalleReporte = $this->_reporteSJ09($registros, $params);
        $result['name_archivo'] = $this->genera_excelJuvenil($detalleReporte, $registros, $params[4], $params[5], $titulos, 'ReporteSJ09', 'sj09-' . $userData->idusuario . '-');
        $result['ubicacion_archivo'] = base_url() . 'reporte_file/';

        echo json_encode($result);
    }

    public function generaReporteExcelCuadrante($params) {
        $userData = $this->session->userdata('userData');

        $bd_Flag = ($params[4] !== '-1') ? $this->checkDates($params[4], "-1") : 0;
        //$fechaDesde = $this->formato_mysql($params[4]);
        //$fechaHasta = $this->formato_mysql($params[5]);
        $registros = $this->m_reporte->get_infoReportCuadrante(array($params[0], $params[1], $params[2], $params[3],  $this->formato_mysql($params[4])), $bd_Flag);
        $titulos = NULL;
        $detalleReporte = $this->_reporteCuadrante($registros, $params);
        $result['name_archivo'] = $this->genera_excelCuadrante($detalleReporte, $registros, $titulos, 'ReporteCuadrante', 'cuadrante-' . $userData->idusuario . '-');
        $result['ubicacion_archivo'] = base_url() . 'reporte_file/';

        echo json_encode($result);
    }
    public function generaReporteExcelCuadranteMiembros($params) {
        $userData = $this->session->userdata('userData');

        $bd_Flag = ($params[4] !== '-1') ? $this->checkDates($params[4], "-1") : 0;
        //$fechaDesde = $this->formato_mysql($params[4]);
        //$fechaHasta = $this->formato_mysql($params[5]);
        $registros = $this->m_reporte->get_infoReportCuadranteMiembros(array($params[0], $params[1], $params[2], $params[3],  $this->formato_mysql($params[4])), $bd_Flag);
        $titulos = NULL;
        $detalleReporte = $this->_reporteCuadranteMiembros($registros, $params);
        $result['name_archivo'] = $this->genera_excelCuadranteMiembros($detalleReporte, $registros, $titulos, 'ReporteCuadranteMiembros', 'cuadrante-' . $userData->idusuario . '-');
        $result['ubicacion_archivo'] = base_url() . 'reporte_file/';

        echo json_encode($result);
    }
    public function generaReporteExcelCuadranteS07($params) {
        $userData = $this->session->userdata('userData');

        $bd_Flag = ($params[4] !== '-1') ? $this->checkDates($params[4], "-1") : 0;
        //$fechaDesde = $this->formato_mysql($params[4]);
        //$fechaHasta = $this->formato_mysql($params[5]);
        $registros = $this->m_reporte->get_infoReportCuadranteS07(array($params[0], $params[1], $params[2], $params[3],  $this->formato_mysql($params[4])), $bd_Flag);
        $titulos = NULL;
        $detalleReporte = $this->_reporteCuadranteS07($registros, $params);
        $result['name_archivo'] = $this->genera_excelCuadranteS07($detalleReporte, $registros, $titulos, 'ReporteCuadrante', 'cuadrante-' . $userData->idusuario . '-');
        $result['ubicacion_archivo'] = base_url() . 'reporte_file/';

        echo json_encode($result);
    }
    public function generaReporteExcelCuadranteJuvenil($params) {
        $userData = $this->session->userdata('userData');

        //$bd_Flag = (($params[4] !== '-1') and ( $params[5] !== '-1')) ? $this->checkDates($params[4], $params[5]) : 0;
        //$fechaDesde = $this->formato_mysql($params[4]);
        //$fechaHasta = $this->formato_mysql($params[5]);
        $registros = $this->m_reporte->get_infoReportCuadranteJuvenil(array($params[0], $params[1], $params[2], $params[3]));
        $titulos = NULL;
        $detalleReporte = $this->_reporteCuadranteJuvenil($registros, $params);
        $result['name_archivo'] = $this->genera_excelCuadranteJuvenil($detalleReporte, $registros, $titulos, 'ReporteCuadranteJuvenil', 'cuadranteJuvenil-' . $userData->idusuario . '-');
        $result['ubicacion_archivo'] = base_url() . 'reporte_file/';

        echo json_encode($result);
    }

    private function checkDates($f1, $f2, $flag = 0) {

        $fecha1 = strtotime($f1 . ' 00:00:01');
        $fecha2 = strtotime($f2 . ' 00:00:01');

        $hoy = (strpos($f1, '/') !== FALSE) ? date("d/m/Y") : date("d-m-Y");

        $today = strtotime($hoy . ' 00:00:01');
        $cond1 = ($fecha1 < $today);
        $cond2 = ($fecha2 < $today);
        $cond3 = ($fecha1 === $today);
        $cond4 = ($fecha2 === $today);

        $valOut = $flag ? (($cond3 or $cond4) ? 0 : 1) : (($cond1 or $cond2) ? 1 : 0);
        return $valOut;
    }

    private function formato_mysql($param) {

        if (($param != '-1') and ( $param != NULL)) {
            $fecha = explode((strpos($param, '/') ? "/" : "-"), $param);
            $retorno = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
        } else {
            $retorno = '-1';
        }
        return $retorno;
    }

    private function _reporteS09($registros, $params) {

        $mostrarReporte = array();
        $arrRegistros = array();
        $ultimoMat = 0;
        foreach ($registros as $value) {
            if ($value->idmatrimonio != $ultimoMat) {
                $arrRegistros['matrimonio-' . $value->idmatrimonio] = $value->matrimonio;
                $ultimoMat = $value->idmatrimonio;
            }
            if ($value->idmatrimonio == $ultimoMat) {
                $arrRegistros['tema-' . $value->tema_nro . '-' . $value->idmatrimonio] = $value->tema_nro;
            }
        }
        $mostrarReporte[] = $arrRegistros;
        return $mostrarReporte;
    }

    private function _reporteSJ09($registros, $params) {

        $mostrarReporte = array();
        $arrRegistros = array();
        $ultimoMat = 0;
        foreach ($registros as $value) {
            if ($value->idjoven != $ultimoMat) {
                $arrRegistros['joven-' . $value->idjoven] = $value->joven;
                $ultimoMat = $value->idjoven;
            }
            if ($value->idjoven == $ultimoMat) {
                $arrRegistros['tema-' . $value->tema_nro . '-' . $value->idjoven] = $value->tema_nro;
            }
        }
        $mostrarReporte[] = $arrRegistros;
        return $mostrarReporte;
    }

    private function _reporteCuadrante($registros, $params) {

        $mostrarReporte = array();
        $arrRegistros = array();
        $ultimoMat = 0;
        $i = 0;
        foreach ($registros as $value) {

            $arrRegistros[$i]['matrimonio'] = $value->matrimonio;
            $arrRegistros[$i]['celular_el'] = $value->el_cel;
            $arrRegistros[$i]['celular_ella'] = $value->ella_cel;
            $arrRegistros[$i]['telefono'] = $value->telefono;
            $arrRegistros[$i]['fecha_nac_el'] = $value->el_fecha_nac;
            $arrRegistros[$i]['fecha_nac_ella'] = $value->ella_fecha_nac;
            $arrRegistros[$i]['aniversario'] = $value->aniversario;
            $arrRegistros[$i]['grupo'] = $value->grupo;
            $arrRegistros[$i]['membresia'] = $value->membresia_pareja;
            $i++;
        }
        $mostrarReporte[] = $arrRegistros;
        return $mostrarReporte;
    }
    private function _reporteCuadranteMiembros($registros, $params) {

        $mostrarReporte = array();
        $arrRegistros = array();
        $ultimoMat = 0;
        $i = 0;
        foreach ($registros as $value) {

            $arrRegistros[$i]['matrimonio'] = $value->matrimonio;
            $arrRegistros[$i]['celular_el'] = $value->el_cel;
            $arrRegistros[$i]['celular_ella'] = $value->ella_cel;
            $arrRegistros[$i]['telefono'] = $value->telefono;
            $arrRegistros[$i]['fecha_encuentro'] = $value->fecha_encuentro;
            $arrRegistros[$i]['fecha_membresia'] = $value->fecha_membresia;
            $arrRegistros[$i]['base'] = $value->base;
            $arrRegistros[$i]['grupo'] = $value->grupo;
            $arrRegistros[$i]['membresia'] = $value->membresia_pareja;
            $i++;
        }
        $mostrarReporte[] = $arrRegistros;
        return $mostrarReporte;
    }
    private function _reporteCuadranteS07($registros, $params) {

        $mostrarReporte = array();
        $arrRegistros = array();
        $ultimoMat = 0;
        $i = 0;
        foreach ($registros as $value) {

            $arrRegistros[$i]['matrimonio'] = $value->matrimonio;
            $arrRegistros[$i]['celular_el'] = $value->el_cel;
            $arrRegistros[$i]['celular_ella'] = $value->ella_cel;
            $arrRegistros[$i]['telefono'] = $value->telefono;
            $arrRegistros[$i]['fecha_nac_el'] = $value->el_fecha_nac;
            $arrRegistros[$i]['fecha_nac_ella'] = $value->ella_fecha_nac;
            $arrRegistros[$i]['aniversario'] = $value->aniversario;
            $arrRegistros[$i]['grupo'] = $value->grupo;
            $arrRegistros[$i]['membresia'] = $value->membresia_pareja;
            $arrRegistros[$i]['motivoSalida'] = $value->motivoSalida;
            $arrRegistros[$i]['fechaSalida'] = $value->fechaSalida;
            $i++;
        }
        $mostrarReporte[] = $arrRegistros;
        return $mostrarReporte;
    }
    
    private function _reporteCuadranteJuvenil($registros, $params) {

        $mostrarReporte = array();
        $arrRegistros = array();
        $ultimoMat = 0;
        $i = 0;
        foreach ($registros as $value) {

            $arrRegistros[$i]['joven'] = $value->joven;
            $arrRegistros[$i]['fecha_nac_el'] = $value->fecha_nac;
            $arrRegistros[$i]['celular_el'] = $value->cel;
            $arrRegistros[$i]['nombre_padre'] = $value->nombre_padre;
            $arrRegistros[$i]['nombre_madre'] = $value->nombre_madre;
            $arrRegistros[$i]['celular_padre'] = $value->tel_padre;
            $arrRegistros[$i]['celular_madre'] = $value->tel_madre;
            $arrRegistros[$i]['membresia'] = $value->membresia_joven;
            $i++;
        }
        $mostrarReporte[] = $arrRegistros;
        return $mostrarReporte;
    }

}
