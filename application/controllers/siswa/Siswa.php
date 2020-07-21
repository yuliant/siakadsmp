<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('siswa/M_siswa');

		if($this->session->userdata('status_siswa')==null){
			redirect('','refresh');
		}
	}

	public function index(){
		$data ['content'] = 'siswa/datasiswa';
		$this->load->view('siswa/index', $data);
	}

	public function getNilai($id){
		$data['data'] = $this->M_siswa->getDataNilaiByID(decrypt_url($id));
		if($data['data'] == null){
			$data['content'] = '404';
			$this->load->view('siswa/index', $data);
			return;
		}
		$data['content'] = 'siswa/nilai_siswa';
		$this->load->view('siswa/index', $data);
	}

	function getProfile($id){
		
		$data['data'] = $this->M_siswa->getProfileName(decrypt_url($id));
		if($data['data'] == null){
			$data['content'] = '404';
			$this->load->view('siswa/index', $data);
			return;
		}
		$data['content'] = 'siswa/profile';
		$this->load->view('siswa/index', $data);
	
	}

	function ubahPassword($id){
		$data['data'] = $this->M_siswa->getProfileName(decrypt_url($id));
		if($data['data']==null){
			$data['content'] = '404';
			$this->load->view('siswa/index', $data);
			return;
		}

		if($this->input->post('password') == null){
			$data['content'] = 'siswa/ubah_password';
			$this->load->view('siswa/index', $data);
		}else{
			$pass = sha1($this->input->post('password'));
			$id_siswa = decrypt_url($id);
			$sql = "UPDATE tb_siswa SET password ='$pass' WHERE id_siswa = '$id_siswa'";
			$this->db->query($sql);
			$this->session->set_flashdata('success', 'Berhasil Edit Password');
			redirect('s/profile/'.$id,'refresh');
		}
		
	}

}

/* End of file Siswa.php */
/* Location: ./application/controllers/siswa/Siswa.php */