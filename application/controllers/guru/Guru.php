<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

	public $postNilai = null;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_model');
		if ($this->session->userdata('status_guru') == null) {
			redirect('', 'refresh');
		}
	}

	public function index()
	{

		$data['content'] = 'guru/dasbhoard';
		$this->load->view('guru/index', $data);
	}

	function getKelas($id)
	{

		$data['data'] = $this->M_model->getKelasByGuru(decrypt_url($id));
		// echo '<pre>' . var_export($data['data'], true) . '</pre>';
		// die;
		if ($data['data'] == null) {
			$data['content'] = '404';
			$this->load->view('guru/index', $data);
			return;
		}

		$data['content'] = 'guru/daftar_kelas';
		$this->load->view('guru/index', $data);
	}

	function getFormNilai($id_guru, $id_kelas)
	{

		$data['data'] = $this->M_model->getFormNilai(decrypt_url($id_guru), decrypt_url($id_kelas));
		$data['id_kelas'] = $id_kelas;
		$data['id_guru'] = $id_guru;
		$data['content'] = 'guru/nilai_siswa';
		$this->load->view('guru/index', $data);
	}

	function createFormNilai($class, $semester, $guru)
	{
		$id_kelas = decrypt_url($class);
		$id_guru = decrypt_url($guru);

		$id_mapel = $this->session->userdata('id_mapel');
		// $id_guru = $this->session->userdata('id');

		$where = array('id_kelas' => $id_kelas, 'status_siswa' => 'AKTIF');
		$this->db->where($where);
		$get = $this->db->get('tb_siswa')->result();
		foreach ($get as $key) {
			$this->db->query("INSERT INTO tb_nilai(id_siswa, id_mapel, id_kelas, semester, id_guru, status_nilai)
			VALUES ('$key->id_siswa', '$id_mapel', '$id_kelas', '$semester', '$id_guru', 'AKTIF')");
		}

		$redirect = 'form/' . $guru . '/' . $class;
		redirect($redirect, 'refresh');
	}


	function postNilai($form, $code_nilai, $kelas)
	{
		$id = decrypt_url($code_nilai);
		$id_kelas = decrypt_url($kelas);


		$get = $this->M_model->getSiswaByNilai($id);

		if ($this->input->post('nilai') == null) {
			$data['content'] = 'guru/input_nilai';
			$data['nama'] = $get->nama_siswa;
			$data['form'] = $form;
			$data['nilai_ke'] = substr($form, 6);
			$data['id_nilai'] = $code_nilai . '/' . $kelas;
			$this->load->view('guru/index', $data);
		} else {

			$nilai = $this->input->post('nilai');
			$sql = "UPDATE tb_nilai SET $form = '$nilai' WHERE id_nilai = '$id'";
			$this->db->query($sql);
			$id_guru = encrypt_url($this->session->userdata('id'));
			$this->session->set_flashdata('notif', 'Data Nilai Berhasil Diperbarui Menjadi : ' . $nilai);
			redirect('form/' . $id_guru . '/' . $kelas, 'refresh');
			$this->getKelas($id_guru);
		}
	}

	function profile($id)
	{
		$this->db->where('id_guru', decrypt_url($id));
		$data['data'] = $this->db->get('tb_guru')->row();
		if ($data['data'] == null) {
			$data['content'] = '404';
			$this->load->view('guru/index', $data);
			return;
		}
		$data['content'] = 'guru/profile';
		$this->load->view('guru/index', $data);
	}

	function ubahPassword($id_guru)
	{
		$id = decrypt_url($id_guru);

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {

			$this->db->where('id_guru', $id);
			$data['data'] = $this->db->get('tb_guru')->row();

			$data['content'] = 'guru/ubah_password';
			$this->load->view('guru/index', $data);
		} else {
			$update = array('password' => sha1($this->input->post('password')));
			$this->db->where('id_guru', $id);
			$this->db->update('tb_guru', $update);

			$this->session->set_flashdata('success', 'Password Sukses Diganti');
			redirect('t/profile/' . $id_guru, 'refresh');
		}
	}
}

/* End of file Guru.php */
/* Location: ./application/controllers/guru/Guru.php */