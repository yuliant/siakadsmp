<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('siswa/M_siswa');
		$this->load->config('foto');
		if ($this->session->userdata('status_siswa') == null) {
			redirect('', 'refresh');
		}
	}

	/**
	 * Edit by MASRIZAL EKA YULIANTO
	 */


	public function changeImage($id)
	{
		$data['content'] = 'siswa/ubah_gambar';
		$data['user'] = $this->M_siswa->getDataSiswa(decrypt_url($id))->row();
		$this->load->view('siswa/index', $data);
	}

	public function doUploadImage()
	{
		$data = $this->M_siswa->getDataSiswa($this->session->userdata('id'))->row();

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
				redirect('s/changeimage/' . encrypt_url($this->session->userdata('id')));
			}

			$this->db->where('id_siswa ', $data->id_siswa);
			$this->db->update('tb_siswa');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gambar profil berhasil di update</div>');
			redirect('s/changeimage/' . encrypt_url($this->session->userdata('id')));
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Input gagal, anda harus mengupload foto</div>');
			redirect('s/changeimage/' . encrypt_url($this->session->userdata('id')));
		}
	}

	/**End edit */

	public function index()
	{
		$data['content'] = 'siswa/datasiswa';
		$data['user'] = $this->M_siswa->getDataSiswa($this->session->userdata('id'))->row();
		$this->load->view('siswa/index', $data);
	}

	public function getNilai($id)
	{
		$data['data'] = $this->M_siswa->getDataNilaiByID(decrypt_url($id));
		if ($data['data'] == null) {
			$data['content'] = '404';
			$this->load->view('siswa/index', $data);
			return;
		}
		$data['content'] = 'siswa/nilai_siswa';
		$this->load->view('siswa/index', $data);
	}

	function getProfile($id)
	{

		$data['data'] = $this->M_siswa->getProfileName(decrypt_url($id));
		if ($data['data'] == null) {
			$data['content'] = '404';
			$this->load->view('siswa/index', $data);
			return;
		}
		$data['content'] = 'siswa/profile';
		$this->load->view('siswa/index', $data);
	}

	function ubahPassword($id)
	{
		$data['data'] = $this->M_siswa->getProfileName(decrypt_url($id));
		if ($data['data'] == null) {
			$data['content'] = '404';
			$this->load->view('siswa/index', $data);
			return;
		}

		if ($this->input->post('password') == null) {
			$data['content'] = 'siswa/ubah_password';
			$this->load->view('siswa/index', $data);
		} else {
			$pass = sha1($this->input->post('password'));
			$id_siswa = decrypt_url($id);
			$sql = "UPDATE tb_siswa SET password ='$pass' WHERE id_siswa = '$id_siswa'";
			$this->db->query($sql);
			$this->session->set_flashdata('success', 'Berhasil Edit Password');
			redirect('s/profile/' . $id, 'refresh');
		}
	}
}

/* End of file Siswa.php */
/* Location: ./application/controllers/siswa/Siswa.php */