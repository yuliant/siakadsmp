<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa extends CI_Model {


	function getDataNilaiByID($id){
		$sql = "SELECT * FROM tb_siswa s JOIN tb_nilai n on s.id_siswa = n.id_siswa JOIN
				tb_mapel m on m.id_mapel = n.id_mapel JOIN tb_guru g on g.id_guru = n.id_guru
				JOIN tbl_kelas k on n.id_kelas= k.id_kelas
				WHERE n.id_siswa = '$id' ORDER BY k.nama_kelas";

		return $this->db->query($sql)->result();

	}


	function getProfileName($id){
		$this->db->where('s.id_siswa', $id);
		$this->db->join('tbl_kelas k', 's.id_kelas=k.id_kelas');
		return $this->db->get('tb_siswa s')->row();

	}
	

}

/* End of file M_siswa.php */
/* Location: ./application/models/siswa/M_siswa.php */