<?php

/**
 * Description of frontend
 *
 * @author Juan Vallejos
 */
class Frontend extends Mfcparaguay {
    # region constructor

    public function __construct() {
        parent::__construct();
        $this->load->model('cliente/m_cliente');
        $this->load->model('frontend/M_frontend');
    }

    # region metodos publicos
    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function front() {
        //$idCliente = $this->session->userdata('cliente_active');
        //$break = $this->m_cliente->_breakNeotel();
        //$body_modal = Modules::run('componente/select', array('idSelect' => 'id_break', 'view_flag' => 1, 'data_select' => $break, 'nameSelect' => 'id_break', 'msgSelect' => "Seleccione break..."));
        $data = array(
//            'data_cliente' => $this->m_cliente->getCliente(array($idCliente)),
            // 'body_modal' => $body_modal,
            'menu_lista' => $this->carga_menu(),
                //'menuCounter' => $this->carga_Contador()
        );
        $this->load->view('front');
    }

    /* ---------------------------------------------------------------------------- */
    /*
     *   @name function:
     *   @params:
     *   @return:
     *   @description:
     */

    public function end() {
        $this->load->view('end');
    }

    public function carga_menu() {

        $vista = $this->load->view('menu_list', TRUE);
        return $vista;
    }

    public function carga_Contador($idRol = 0) {

        $vista = $this->load->view('counterReg', array('id_rol' => $idRol), true);
        return $vista;
    }

    public function genera_menu() {

        //$lista_menu = $this->M_frontend->get_menu(array($id_rol, $tipo, $id_campana, (IP_SERVER_PRODUCCION == $_SERVER['SERVER_ADDR']) ? '1' : '0'));
        //$txtTipoProducto = $this->M_frontend->get_TipoProducto(array($idTipoServicio));
        $lista_menu = 1;
        $tipo = 2;
        if ($lista_menu) {
            switch ($tipo) {
                case '1':
                    //IF  {
                    $lista = '<button title="Reportes" class="dropdown-toggle grupo_menu disabled" id="idReportes" type="button" data-toggle="dropdown" data-submenu><a href="#" title="Reportes" id="idMenu" data-categ="IdMenu"><img src="assets/img/reporte.png"></a></button>';
                    //}
                    break;
                case '2':
                    $lista = '<button title="Cuentas" class="dropdown-toggle grupo_menu disabled" id="idConfig" type="button" data-toggle="dropdown" data-submenu><a href="#" title="Cuentas"><img src="assets/img/cuentas.png"></a></button>';

                    break;
                default:
                    break;
            }

            $lista .= '<ul class="dropdown-menu" style="left: 6px;">';
            $lista .= '</ul>';
        } else {
            $lista = '';
        }

        return $lista;
    }

}
