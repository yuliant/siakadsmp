<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('session');
		$this->load->model('M_login');
	}
	public function index()
	{
		$this->_ceksess();
		$this->load->view('login');
	}

	public function login()
	{
		$this->_ceksess();
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));

		$data = $this->M_login->getLogin($username, $password);

		if ($data == "siswa") {
			$this->db->where(array('nisn' => $username, 'password' => $password));
			$siswa = $this->db->get('tb_siswa')->row();

			//set session in siswa
			$this->session->set_userdata('status_siswa', $siswa);
			$sisw['id'] = $siswa->id_siswa;
			$sisw['nama'] = $siswa->nama_siswa;
			$this->session->set_userdata($sisw);

			redirect('s', 'refresh');
		} else if ($data == "guru") {
			$this->db->where(array('nign' => $username, 'password' => $password));
			$guru = $this->db->get('tb_guru')->row();

			//set session in siswa
			$this->session->set_userdata('status_guru', $guru);
			$teacher['id'] = $guru->id_guru;
			$teacher['nama'] = $guru->nama_guru;
			$teacher['id_mapel'] = $guru->id_mapel;
			$this->session->set_userdata($teacher);

			redirect('t', 'refresh');
		} else if ($data == "admin") {
			$this->db->where(array('nign' => $username, 'password' => $password));
			$guru = $this->db->get('tb_guru')->row();

			//set session in siswa
			$this->session->set_userdata('status_admin', $guru);
			$teacher['id'] = $guru->id_guru;
			$teacher['nama'] = $guru->nama_guru;
			$this->session->set_userdata($teacher);

			redirect('admin', 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Password/Username Salah');
			redirect('', 'refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}

	private function _ceksess()
	{
		if ($this->session->userdata('status_siswa') != null) {
			redirect('s', 'refresh');
		} elseif ($this->session->userdata('status_guru') != null) {
			redirect('t', 'refresh');
		} elseif ($this->session->userdata('status_admin') != null) {
			redirect('admin', 'refresh');
		}
	}
}
