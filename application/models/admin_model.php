<?php
if (!defined('BASEPATH'))
    die("No hay acceso directo a este script");

/*
 * Modelo para manejar datos defaults
 */

class Admin_model extends CI_Model
{

    var $tablas = array();

    function __construct()
    {
        parent::__construct();
        $this->load->config('tables', TRUE);
        $this->tablas = $this->config->item('tablas', 'tables');
    }


  

    function insertItem($tabla, $data)
    {
        $this->db->insert($this->tablas[$tabla], $data);
        $itemID = $this->db->insert_id();
        return $itemID;
    }

    function updateItem($itemID, $ID, $data, $tabla)
    {
        $this->db->where($itemID, $ID);
        $this->db->update($this->tablas[$tabla], $data);
        return true;
    }

    

    

    function deleteItem($idTabla, $id, $tabla)
    {
        $this->db->where($idTabla, $id);
        $this->db->delete($this->tablas[$tabla]);
        return true;
    }

    function getSingleItem($idTabla, $id, $tabla)
    {
        $this->db->where($idTabla, $id);
        $query = $this->db->get($this->tablas[$tabla]);
        if ($query->num_rows() == 1) {
            return $query->row();
        } elseif ($query->num_rows() > 1) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getSingleItems($idTabla, $id, $tabla)
    {
        $this->db->where($idTabla, $id);
        $query = $this->db->get($this->tablas[$tabla]);
        if ($query->num_rows() >= 1) {
            return $query->result();
        }
    }


}

?>