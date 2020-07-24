<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

	public $postNilai = null;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_model');
		$this->load->model('guru/M_guru', 'M_guru');
		$this->load->config('foto');
		if ($this->session->userdata('status_guru') == null) {
			redirect('', 'refresh');
		}
	}

	/**
	 * Edit by MASRIZAL EKA YULIANTO
	 */
	public function changeImage($id)
	{
		$data['content'] = 'guru/ubah_gambar';
		$data['user'] = $this->M_guru->getDataGuru(decrypt_url($id))->row();
		$this->load->view('guru/index', $data);
	}

	public function doUploadImage()
	{
		$data = $this->M_guru->getDataGuru($this->session->userdata('id'))->row();

		// cek jika ada gambar
		$upload_image = $_FILES['image']['name'];
		if ($upload_image) {
			$config['allowed_types'] = $this->config->item('type_pp');
			$config['max_size']      = $this->config->item('max_pp');
			$config['upload_path'] = './assets/img/profile';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$old_image = $data->image;

				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				redirect('t/changeimage/' . encrypt_url($this->session->userdata('id')));
			}

			$this->db->where('id_guru', $data->id_guru);
			$this->db->update('tb_guru');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gambar profil berhasil di update</div>');
			redirect('t/changeimage/' . encrypt_url($this->session->userdata('id')));
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Input gagal, anda harus mengupload foto</div>');
			redirect('t/changeimage/' . encrypt_url($this->session->userdata('id')));
		}
	}



	/**End edit */

	public function index()
	{
		$id_guru = $this->session->userdata('id');
		$data['content'] = 'guru/dasbhoard';
		$data['tapel'] = $this->M_guru->getTapel()->row();
		$data['jml_siswa'] = $this->M_guru->hitungMurid($id_guru)->num_rows();
		$data['jml_kelas'] = $this->M_guru->hitungKelas($id_guru)->num_rows();
		$data['user'] = $this->M_guru->getDataGuru($this->session->userdata('id'))->row();
		$this->load->view('guru/index', $data);
	}

	function getKelas($id)
	{

		$data['data'] = $this->M_model->getKelasByGuru(decrypt_url($id));
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
		$data['tapel'] = $this->M_guru->getTapel()->row();
		$data['data'] = $this->M_model->getFormNilai(decrypt_url($id_guru), decrypt_url($id_kelas));
		$data['id_kelas'] = $id_kelas;
		$data['id_guru'] = $id_guru;
		$data['content'] = 'guru/nilai_siswa';
		$this->load->view('guru/index', $data);
	}

	public function cFormNilai()
	{
		$this->form_validation->set_rules('tapel', 'Tapel', 'required');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Inpu nilai gagal dilakukan</div>');
			redirect('t/changeimage/' . encrypt_url($this->session->userdata('id')));
		} else {
			$id_kelas = decrypt_url($this->input->post('id_kelas'));
			$id_guru = htmlspecialchars($this->input->post('id_guru', true));
			$semester = htmlspecialchars($this->input->post('semester', true));
			$tapel = htmlspecialchars($this->input->post('tapel', true));
			$id_mapel = $this->session->userdata('id_mapel');

			$where = array('id_kelas' => $id_kelas, 'status_siswa' => 'AKTIF');
			$this->db->where($where);
			$get = $this->db->get('tb_siswa')->result();

			foreach ($get as $key) {
				$this->db->query("INSERT INTO tb_nilai(id_siswa, 
				id_mapel, 
				id_kelas, 
				semester, 
				id_guru, 
				status_nilai,
				tapel)
				
				VALUES ('$key->id_siswa', 
				'$id_mapel', 
				'$id_kelas', 
				'$semester', 
				'$id_guru', 
				'AKTIF',
				'$tapel')");
			}

			$redirect = 'form/' . encrypt_url($id_guru) . '/' . encrypt_url($id_kelas);
			redirect($redirect, 'refresh');
		}
	}

	// function createFormNilai($class, $semester, $guru)
	// {
	// 	$id_kelas = decrypt_url($class);
	// 	$id_guru = decrypt_url($guru);

	// 	$id_mapel = $this->session->userdata('id_mapel');
	// 	// $id_guru = $this->session->userdata('id');

	// 	$where = array('id_kelas' => $id_kelas, 'status_siswa' => 'AKTIF');
	// 	$this->db->where($where);
	// 	$get = $this->db->get('tb_siswa')->result();
	// 	foreach ($get as $key) {
	// 		$this->db->query("INSERT INTO tb_nilai(id_siswa, 
	// 		id_mapel, 
	// 		id_kelas, 
	// 		semester, 
	// 		id_guru, 
	// 		status_nilai)

	// 		VALUES ('$key->id_siswa', 
	// 		'$id_mapel', 
	// 		'$id_kelas', 
	// 		'$semester', 
	// 		'$id_guru', 
	// 		'AKTIF')");
	// 	}

	// 	$redirect = 'form/' . $guru . '/' . $class;
	// 	redirect($redirect, 'refresh');
	// }


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