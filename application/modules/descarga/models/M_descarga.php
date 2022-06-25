<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_descarga extends M_general {
    /*
     * get rows from the files table
     */

    function getRows($params) {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('status', '1');
        $this->db->order_by('created', 'desc');
        $this->db->where('id', $params[0]);
        //get records
        $query = $this->db->get();
        $result = ($query->num_rows() > 0) ? $query->result() : FALSE;

        //return fetched data
        return $result;
    }

}
