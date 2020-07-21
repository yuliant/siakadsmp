<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public $notifikasi = false;
	public $pesan = 'Nothing';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_model');
		$this->load->library('encryption');
		if($this->session->userdata('status_admin')==null){
			redirect('','refresh');
		}
	}
	public function index()
	{
		if ($this->notifikasi) {
			$data['notif'] = "DATA SISWA BERHASIL DITAMBAHKAN";

			$data['content'] = 'admin/dasbhoard';
			$this->load->view('admin/index', $data);
		}else{

			$data['content'] = 'admin/dasbhoard';
			$this->load->view('admin/index', $data);
		}
	}

	function dataKelas7(){
		
		$data ['data'] = $this->M_model->getSiswabyKelas(7);
		$data['content'] = 'admin/data_kelas_tujuh';
		$this->load->view('admin/index', $data);
		
	}

	function dataKelas8(){
		
		$data ['data'] = $this->M_model->getSiswabyKelas(8);
		$data['content'] = 'admin/data_kelas_delapan';
		$this->load->view('admin/index', $data);
	
	}

	function dataKelas9(){
		
		$data ['data'] = $this->M_model->getSiswabyKelas(9);
		$data['content'] = 'admin/data_kelas_sembilan';
		$this->load->view('admin/index', $data);
		
	}

	function dataAlumni(){
		$data ['data'] = $this->M_model->getAlumni();
		$data['content'] = 'admin/data_alumni';
		$this->load->view('admin/index', $data);
	}

	function dataGuru(){
		$data['data'] = $this->M_model->getGuru();
		$data['content'] = 'admin/data_guru';
		$this->load->view('admin/index', $data);
	}

	function dataKelas(){
		$data ['data'] = $this->M_model->getKelas();
		$data['content'] = 'admin/data_kelas';
		$this->load->view('admin/index', $data);
	}

	function mapel(){
		$data ['data'] = $this->M_model->getMapel();
		$data['content'] = 'admin/data_mapel';
		$this->load->view('admin/index', $data);
	}

	function getGuru($id){
		$array = array();
		
		$databykelas = $this->M_model->getGuruByKelas($id);
		
		foreach ($databykelas as $key) {
			array_push($array, $key->id_guru);
		}

		$in ='('.implode(',', $array).')';
		
		if($array!=null){
			$data['spinner'] = $this->db->query("SELECT * from tb_guru g JOIN tb_mapel m ON g.id_mapel = m.id_mapel WHERE tugas ='GURU MAPEL' AND id_guru NOT IN $in")->result();
		}else{
			$data['spinner'] = $this->db->query("SELECT * from tb_guru g JOIN tb_mapel m ON g.id_mapel = m.id_mapel WHERE tugas ='GURU MAPEL'")->result();	
		}
		$data['id'] = $id;
		$data['kelas'] = $this->M_model->getClassById($id);
		$data['data'] = $this->M_model->getGuruByKelas($id);
		$data['content'] = 'admin/guru_pengajar';
		$this->load->view('admin/index', $data);
	}

	function tambahSiswa(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nisn', 'Nama', 'required');
        $this->form_validation->set_rules('nama', 'Nisn', 'required');

	    if ($this->form_validation->run() == FALSE)
	    {
	    	$data['kelas'] = $this->db->get('tbl_kelas')->result();

            $data['content'] = 'admin/tambah_siswa';
			$this->load->view('admin/index', $data);
	    }
	    else
	    {
	    	$insert_data = array(
	    		'nisn' => $this->input->post('nisn'),
	    		'j_kelamin' => $this->input->post('kelamin'),
	    		'nama_siswa' => $this->input->post('nama'),
	    		'tmp_lahir' => $this->input->post('tmp_lhr'),
	    		'nama_ayah' => $this->input->post('nm_ayah'),
	    		'tgl_lahir' => $this->input->post('tgl_lhr'),
	    		'nama_ibu' => $this->input->post('nm_ibu'),
	    		'telp_ortu' => $this->input->post('tlp_ortu'),
	    		'pekerjaan_ayah' => $this->input->post('pk_ayah'),
	    		'pekerjaan_ibu' => $this->input->post('pk_ibu'),
	    		'agama' => $this->input->post('agama'),
	    		'alamat_siswa' => $this->input->post('alamat'),
	    		'id_kelas' =>$this->input->post('kelas'),
	    		'status_siswa' => 'AKTIF',
	    		'password' => sha1($this->input->post('nisn'))
	    		);

	    	$this->db->insert('tb_siswa', $insert_data);
	    	$this->notifikasi = true;
	    	$this->session->set_flashdata('success_add', 'Berhasil Ditambahkan');
	    	redirect('admin','refresh');
	        
	      
	    }
	}

	function editSiswa($id_siswa, $kelas){
		$this->db->where('id_siswa', $id_siswa);
		$data['siswa'] = $this->db->get('tb_siswa')->row();
		$data['kelas'] = $this->db->get('tbl_kelas')->result();
		$data['nama_kelas'] = $kelas;

        $data['content'] = 'admin/edit_siswa';
		$this->load->view('admin/index', $data);
	}

	function editSiswaProses($id_siswa, $kelas){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nisn', 'Nama', 'required');
        $this->form_validation->set_rules('nama', 'Nisn', 'required');

	    if ($this->form_validation->run() == FALSE)
	    {

	    }else{
			$insert_data = array(
				'nisn' => $this->input->post('nisn'),
				'j_kelamin' => $this->input->post('kelamin'),
				'nama_siswa' => $this->input->post('nama'),
				'tmp_lahir' => $this->input->post('tmp_lhr'),
				'nama_ayah' => $this->input->post('nm_ayah'),
				'tgl_lahir' => $this->input->post('tgl_lhr'),
				'nama_ibu' => $this->input->post('nm_ibu'),
				'telp_ortu' => $this->input->post('tlp_ortu'),
				'pekerjaan_ayah' => $this->input->post('pk_ayah'),
				'pekerjaan_ibu' => $this->input->post('pk_ibu'),
				'agama' => $this->input->post('agama'),
				'alamat_siswa' => $this->input->post('alamat'),
				'id_kelas' =>$this->input->post('kelas'),
				'status_siswa' => 'AKTIF'
			);
		}

		$this->db->where('id_siswa', $id_siswa);
    	$this->db->update('tb_siswa', $insert_data);
    	$this->notifikasi = true;
    	if($kelas==7){
    		$this->notifikasi = true;
    		$this->session->set_flashdata('success_edit', 'Berhasil Diperbarui');
    		redirect('sevenclass','refresh');
    	}else if($kelas==8){
    		
    		$this->session->set_flashdata('success_edit', 'Berhasil Diperbarui');
    		redirect('eightclass','refresh');
    		// $this->dataKelas8();
    	}else{
    		
    		$this->session->set_flashdata('success_edit', 'Berhasil Diperbarui');
    		redirect('nineclass','refresh');
    		//$this->dataKelas9();
    	}
    	
	}

	function hapusSiswa($kelas, $id){
		$this->db->where('id_siswa', $id);
		$this->db->delete('tb_siswa');

		$this->db->where('id_siswa', $id);
		$this->db->delete('tb_nilai');

		$this->notifikasi = true;
		$this->pesan = "Data Berhasil dihapus";
		if($kelas == 7){
			redirect('sevenclass','refresh');
		}else if($kelas == 8){
			redirect('eightclass','refresh');
		}else{
			redirect('nineclass','refresh');
		}
	}


	function tambahMapel(){
		$array = array('nama_mapel'=>$this->input->post('mapel'));
		$this->db->insert('tb_mapel', $array);
		redirect('course','refresh');
	}

	function izinPenilaian($id_kelas){
		$this->db->where('id_kelas', $id_kelas);
		$array = array('access_nilai'=> 'YES');
		$this->db->update('tbl_kelas', $array);

		redirect('classroom','refresh');
	}

	function tutupPenilaian($id_kelas){
		$this->db->where('id_kelas', $id_kelas);
		$array = array('access_nilai'=> 'NO');
		$this->db->update('tbl_kelas', $array);

		$this->db->where('id_kelas', $id_kelas);
		$array = array('status_nilai'=> 'NON AKTIF');
		$this->db->update('tb_nilai', $array);
		redirect('classroom','refresh');
	}

	function dataKelasGuru($id){
		$this->db->where('id_guru', $id);
		$data['guru'] = $this->db->get('tb_guru')->row();
		$data['data'] = $this->M_model->getKelasByGuru($id);
		$data['content'] = 'admin/data_kelas_guru';
		$this->load->view('admin/index', $data);
	}

	function tambahGuru(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nign', 'Nama', 'required');
        $this->form_validation->set_rules('nama', 'Nisn', 'required');

	    if ($this->form_validation->run() == FALSE){

			$data['mapel'] = $this->db->get('tb_mapel')->result();
			$data['content'] = 'admin/tambah_guru';
			$this->load->view('admin/index', $data);
		}else{
			$data_insert = array(
				'nip' => $this->input->post('nip'),
				'nign' => $this->input->post('nign'),
				'nama_guru' => $this->input->post('nama'),
				'agama' => $this->input->post('agama'),
				'j_kelamin' => $this->input->post('kelamin'),
				'tgl_lahir' => $this->input->post('tgl_lhr'),
				'tempat_lahir' => $this->input->post('tmp_lhr'),
				'pendidikan' => $this->input->post('pendidikan'),
				'tugas' => 'GURU MAPEL',
				'alamat_guru' => $this->input->post('alamat'),
				'id_mapel' => $this->input->post('mapel'),
				'password' => sha1($this->input->post('nign'))

			);

			$this->db->insert('tb_guru', $data_insert);
			$this->session->set_flashdata('add_guru', 'Data Guru Berhasil Ditambahkan');
			redirect('teacher','refresh');
		}
	}

	function editGuru($id_guru){
		$this->db->where('id_guru', $id_guru);
		$data['get'] = $this->db->get('tb_guru')->row();
		$data['mapel'] = $this->db->get('tb_mapel')->result();

		$data['content'] = 'admin/edit_guru';
		$this->load->view('admin/index', $data);
	}


	function prosesEditGuru($id){
		$data_insert = array(
			'nip' => $this->input->post('nip'),
			'nign' => $this->input->post('nign'),
			'nama_guru' => $this->input->post('nama'),
			'agama' => $this->input->post('agama'),
			'j_kelamin' => $this->input->post('kelamin'),
			'tgl_lahir' => $this->input->post('tgl_lhr'),
			'tempat_lahir' => $this->input->post('tmp_lhr'),
			'pendidikan' => $this->input->post('pendidikan'),
			'alamat_guru' => $this->input->post('alamat'),
			'id_mapel' => $this->input->post('mapel'),
		);

		$this->db->where('id_guru', $id);
		$this->db->update('tb_guru', $data_insert);
		$this->session->set_flashdata('add_guru', 'Data Guru Berhasil Diedit');
		redirect('teacher','refresh');
	}

	function hapusGuru($id){
		$this->db->where('id_guru', $id);
		$data['get'] = $this->db->get('tb_guru')->row();
		$data['content'] = 'admin/hapus_guru';
		$this->load->view('admin/index', $data);
	}

	function prosesHapusGuru($id){
		$this->db->where('id_guru', $id);
		$this->db->delete('tb_guru');

		$this->db->where('id_guru', $id);
		$this->db->delete('tb_nilai');

		$this->session->set_flashdata('add_guru', 'Data Guru Berhasil Dihapus');
		redirect('teacher','refresh');
	}

	function alumniStatus($id){
		$edit = array('status_siswa'=>'ALUMNI');
		$this->db->where('id_siswa', $id);
		$this->db->update('tb_siswa', $edit);

		$this->session->set_flashdata('success_edit', 'Data Siswa Berubah Menjadi Alumni');
		redirect('nineclass','refresh');
	}

	function tambahGuruKelas($id){
		$guru = $this->input->post('guru');
		$insert = array('id_guru' => $guru, 'id_kelas' => $id);
		$this->db->insert('tb_detail_kelas', $insert);
		$this->session->set_flashdata('success', 'Sukses Ditambahkan');
		redirect('teacher/'.$id,'refresh');
	}

	function profile($id){
		// echo $tes = $this->encryption->encrypt($id);
		// echo '<br>'.$this->encryption->decrypt($tes);
		$this->db->where('id_guru', decrypt_url($id));
		$admin = $this->db->get('tb_guru')->row();
		$data['data'] = $admin;
		if($admin == null){
			$data['content'] = '404';
			$this->load->view('admin/index', $data);
			return;
		}
		$data['content'] = 'admin/profile';
		$this->load->view('admin/index', $data);
	}

	function ubahPassword($id_admin){
		$id = decrypt_url($id_admin);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required');

	    if ($this->form_validation->run() == FALSE){
	    	
	    	$this->db->where('id_guru', $id);
	    	$data['data'] = $this->db->get('tb_guru')->row();

			$data['content'] = 'admin/ubah_password';
			$this->load->view('admin/index', $data);
		}else{
			$update = array('password' => sha1($this->input->post('password')));
			$this->db->where('id_guru', $id);
			$this->db->update('tb_guru', $update);

			$this->session->set_flashdata('success', 'Password Sukses Diganti');
			redirect('admin/profile/'.$id_admin,'refresh');
		}
	}

	function deleteTeacherByClass($id_detail_class, $id_kelas){
		$this->db->where('id_detail_kelas', $id_detail_class);
		$this->db->delete('tb_detail_kelas');

		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('teacher/'.$id_kelas,'refresh');
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/administrator/Admin.php */