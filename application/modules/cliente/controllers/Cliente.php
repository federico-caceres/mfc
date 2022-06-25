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
 * Controlador del paquete Cliente
 *
 * @package		Modules.Cliente.controllers
 * @subpackage          Cliente
 * @category            Controllers
 * @author		MTEL/SKYTEL-PARAGUAY  Team Juan Vallejos 
 * @link		http://salientes_2.0/user_guide/modules/cliente/Cliente.html
 */
class Cliente extends Mfcparaguay {
    public function __construct() {
        parent::__construct();
        $this->load->model('cliente/m_cliente');
    }

/*----------------------------------------------------------------------------*/    
 /*
 *   @name function:
 *   @params:
 *   @return:
 *   @description:
*/
 public function mostrarCliente(){
     
     //$data['list_cliente'] = $this->m_cliente->getCliente();
     $data['list_cliente'] = "Prueba";
     $this->load->view('list_cliente',$data);
 }
/*----------------------------------------------------------------------------*/
/*
 *   @name function:
 *   @params:
 *   @return:
 *   @description:
*/
 public function speechCampana($textContexto = '',$textDeriva = '',$hiddenspeech = '') {
      $idCliente = $this->session->userdata('cliente_active');
      $data['data_cliente'] = $this->m_cliente->getCliente(array($idCliente));
      $data['textContexto'] = $textContexto;
      $data['hiddenSpeech'] = $hiddenspeech;
      $data['textDeriva'] = $textDeriva;
      
      $this->load->view('speech_cliente',$data);
 }

}
