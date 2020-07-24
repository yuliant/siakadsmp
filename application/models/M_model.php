<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_model extends CI_Model
{
	function getKelasByGuru($id_guru)
	{
		$sql = "SELECT * FROM tb_detail_kelas tk JOIN tbl_kelas k ON tk.id_kelas = k.id_kelas
				WHERE tk.id_guru='$id_guru'";

		return $this->db->query($sql)->result();
	}

	function getGuru()
	{
		$this->db->where('tugas', 'GURU MAPEL');
		$this->db->join('tb_mapel m', 'm.id_mapel = g.id_mapel');
		return $this->db->get('tb_guru g')->result();
	}

	function getMapel()
	{
		return $this->db->get('tb_mapel')->result();
	}


	function getGuruByKelas($id_kelas)
	{
		$sql = "SELECT * FROM tb_detail_kelas tk JOIN tb_guru k ON tk.id_guru = k.id_guru 
				JOIN tb_mapel m ON k.id_mapel=m.id_mapel
				WHERE tk.id_kelas='$id_kelas' and k.tugas='GURU MAPEL'";

		return $this->db->query($sql)->result();
	}

	function getFormNilai($id_guru, $id_kelas)
	{
		$sql = "SELECT * FROM tb_siswa s JOIN tb_nilai n on s.id_siswa = n.id_siswa JOIN
				tb_mapel m on m.id_mapel = n.id_mapel
				JOIN tbl_kelas k on n.id_kelas= k.id_kelas
				WHERE n.id_kelas='$id_kelas' AND n.id_guru='$id_guru' AND n.status_nilai ='AKTIF'";

		return $this->db->query($sql)->result();
	}

	function getSiswaByNilai($id)
	{
		$sql = $this->db->query("SELECT * FROM tb_nilai n JOIN tb_siswa s on n.id_siswa = s.id_siswa WHERE n.id_nilai = '$id'");

		return $sql->row();
	}

	function getSiswaByKelas($id)
	{
		$sql = "SELECT * FROM tb_siswa s JOIN tbl_kelas k ON s.id_kelas = k.id_kelas WHERE k.nama_kelas='$id' AND s.status_siswa = 'AKTIF' ORDER BY k.sub_kelas ASC";

		return $this->db->query($sql)->result();
	}

	function getAlumni()
	{
		$sql = "SELECT * FROM tb_siswa s JOIN tbl_kelas k ON s.id_kelas = k.id_kelas WHERE s.status_siswa = 'ALUMNI' ORDER BY s.tgl_lahir";

		return $this->db->query($sql)->result();
	}


	function getKelas()
	{
		$sql = "SELECT k.id_kelas, 
		k.access_nilai,
		k.nama_kelas, 
		k.sub_kelas, 
		-- k.id_guru_walas,
		g.nama_guru,
		COUNT(s.id_siswa) as total_siswa 
		FROM tbl_kelas k 
		LEFT JOIN tb_siswa s ON k.id_kelas = s.id_kelas
		LEFT JOIN tb_guru g ON k.id_guru_walas = g.id_guru GROUP BY k.id_kelas ";
		return $this->db->query($sql)->result();
	}

	function getClassById($id)
	{
		$this->db->where('id_kelas', $id);
		return $this->db->get('tbl_kelas')->row();
	}
}

/* End of file M_model.php */
/* Location: ./application/models/M_model.php */