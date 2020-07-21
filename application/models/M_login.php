<<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function getLogin($username, $password){
		$siswa = $this->db->query("SELECT *  FROM tb_siswa WHERE nisn = '$username' AND password ='$password'")->row();
		$guru = $this->db->query("SELECT *  FROM tb_guru WHERE nign = '$username' AND password ='$password'")->row();

		if($siswa != null){
			return 'siswa';
		}else if($guru  != null && $guru->tugas == 'GURU MAPEL'){
			return 'guru';
		}else if($guru != null && $guru->tugas== 'ADMINISTRATOR'){
			return 'admin';
		}else{
			return 'false';
		}
	}

}

/* End of file M_login.php */
/* Location: ./application/models/M_login.php */