<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_guru extends CI_Model
{
    function getFormNilaiByWalas($id_kelas)
    {
        $sql = "SELECT * FROM tb_siswa s 
    	JOIN tb_nilai n on s.id_siswa = n.id_siswa 
    	JOIN tb_mapel m on m.id_mapel = n.id_mapel
    	JOIN tbl_kelas k on n.id_kelas= k.id_kelas
    	WHERE n.id_kelas='$id_kelas' AND n.status_nilai ='AKTIF'";

        return $this->db->query($sql)->result();
    }

    function getKelasByWalas($id_guru)
    {
        $sql = "SELECT * FROM tbl_kelas WHERE id_guru_walas='$id_guru'";
        return $this->db->query($sql)->result();
    }

    public function hitungKelas($id_guru)
    {
        $this->db->from('tb_detail_kelas');
        $this->db->where([
            'id_guru ' => $id_guru,
        ]);
        $query = $this->db->get();
        return $query;
    }

    public function hitungMurid($id_guru)
    {
        $this->db->from('tb_nilai');
        $this->db->where([
            'id_guru ' => $id_guru,
            'status_nilai ' => 'AKTIF',
        ]);
        $query = $this->db->get();
        return $query;
    }

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
