<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
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

    function addWalas($id_kelas)
    {
        # code...
    }

    public function getDataGuru($id = null)
    {
        $this->db->from('tb_guru');
        if ($id != null) {
            $this->db->where('id_guru ', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getDataSiswa($id = null)
    {
        $this->db->from('tb_siswa');
        if ($id != null) {
            $this->db->where('id_siswa', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}

/* End of file M_admin.php */
