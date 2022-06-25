<?php
/**
 * Salientes 
 *
 * Aplicacion Salientes.
 *
 * @package		Modules.Cliente.controllers
 * @author		MTEL/SKYTEL-PARAGUAY
 * @copyright		Copyright (c) 2012 - 2016, SKYTEL.
 * @license		http://salientes_2.0/user_guide/license.html
 * @link		http://salientes_2.0
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Controlador del paquete Cliente para peticiones ajax al servidor.
 *
 * @package		Modules.Cliente.controllers
 * @subpackage          Perform_cliente
 * @category            Controllers
 * @author		MTEL/SKYTEL-PARAGUAY  Team Juan Vallejos 
 * @link		http://salientes_2.0/user_guide/modules/cliente/Cliente.html
 */
class Perform_cliente extends Mfcparaguay{
    #region constructor
    public function __construct() {
        parent::__construct();
    }
 
 public function getClientesinSelect() {
        $this->load->model('cliente/m_cliente');
        $clientes = $this->m_cliente->getClientelst('');
        $data_view = array('view'=>'select','view_flag'=>6,'data_select'=>$clientes);
        $response['view'] = Modules::run('componente/index',$data_view);

        echo json_encode($response);
    }
}
