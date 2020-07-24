<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_guru extends CI_Model
{
    public function getTapel($id = null)
    {
        $this->db->from('const_tapel');
        if ($id != null) {
            $this->db->where('id_tapel ', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getDataGuru($id)
    {
        $this->db->from('tb_guru');
        if ($id != null) {
            $this->db->where('id_guru ', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}

/* End of file M_guru.php */
