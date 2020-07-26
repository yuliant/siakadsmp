<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function getFormNilaiByAdmin($id_kelas)
    {
        $sql = "SELECT * FROM tb_siswa s 
    	JOIN tb_nilai n on s.id_siswa = n.id_siswa 
    	JOIN tb_mapel m on m.id_mapel = n.id_mapel
    	JOIN tbl_kelas k on n.id_kelas= k.id_kelas
    	WHERE n.id_kelas='$id_kelas' AND n.status_nilai ='AKTIF'";

        return $this->db->query($sql)->result();
    }

    public function hitungResource($hitung)
    {
        if ($hitung == 1) {
            # untuk menghitung siswa
            $this->db->from('tb_siswa');
        } elseif ($hitung == 2) {
            # untuk menghitung guru
            $this->db->from('tb_guru');
            $this->db->where('tugas ', 'GURU MAPEL');
        } elseif ($hitung == 3) {
            # untuk menghitung kelas
            $this->db->from('tbl_kelas');
        } else {
            # untuk menghitung mapel
            $this->db->from('tb_mapel');
        }
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
