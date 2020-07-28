<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public $notifikasi = false;
	public $pesan = 'Nothing';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_model');
		$this->load->model('admin/M_admin', 'M_admin');
		$this->load->config('foto');
		$this->load->library('encryption');
		if ($this->session->userdata('status_admin') == null) {
			redirect('', 'refresh');
		}
	}

	/**
	 * Edit by MASRIZAL EKA YULIANTO
	 */

	public function changeImage($id)
	{
		$data['content'] = 'admin/ubah_gambar';
		$data['user'] = $this->M_admin->getDataGuru(decrypt_url($id))->row();
		$this->load->view('admin/index', $data);
	}

	public function doUploadImage()
	{
		$data = $this->M_admin->getDataGuru($this->session->userdata('id'))->row();

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
				redirect('admin/changeimage/' . encrypt_url($this->session->userdata('id')));
			}

			$this->db->where('id_guru', $data->id_guru);
			$this->db->update('tb_guru');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gambar profil berhasil di update</div>');
			redirect('admin/changeimage/' . encrypt_url($this->session->userdata('id')));
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Input gagal, anda harus mengupload foto</div>');
			redirect('admin/changeimage/' . encrypt_url($this->session->userdata('id')));
		}
	}

	public function inputWalas($id_kelas)
	{
		$data['guru_list'] = $this->M_admin->getDataGuru()->result();

		$this->form_validation->set_rules('walas', 'Walas', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['kelas'] = $this->M_model->getClassById($id_kelas);
			$data['content'] = 'admin/tambah_walas';
			$this->load->view('admin/index', $data);
		} else {
			$insert_data = array(
				'id_guru_walas' => $this->input->post('walas'),
			);

			$this->db->where('id_kelas', $id_kelas);
			$this->db->update('tbl_kelas', $insert_data);
			$this->notifikasi = true;
			$this->session->set_flashdata('success_add', "Wali kelas berhasil di tambahkan");
			redirect('admin', 'refresh');
		}
	}

	public function editWalas($id_kelas)
	{
		$data['guru_list'] = $this->M_admin->getDataGuru()->result();

		$this->form_validation->set_rules('walas', 'Walas', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['kelas'] = $this->M_model->getClassById($id_kelas);
			$data['content'] = 'admin/edit_walas';
			$this->load->view('admin/index', $data);
		} else {
			$update_data = array(
				'id_guru_walas' => $this->input->post('walas'),
			);

			$this->db->where('id_kelas', $id_kelas);
			$this->db->update('tbl_kelas', $update_data);
			$this->notifikasi = true;
			$this->session->set_flashdata('success_add', "Wali kelas berhasil di edit");
			redirect('admin', 'refresh');
		}
	}

	public function editTapel()
	{
		$update_data = array(
			'tapel' => $this->input->post('tapel'),
		);
		$this->db->where('id_tapel', '1');
		$this->db->update('const_tapel', $update_data);

		$this->session->set_flashdata('success_add', "Tahun pelajaran berhasil diupdate");
		redirect('admin', 'refresh');
	}

	function getAdminFormNilai($id_kelas)
	{
		$data['data'] = $this->M_admin->getFormNilaiByAdmin($id_kelas);
		$data['id_kelas'] = $id_kelas;
		$data['content'] = 'admin/nilai_siswa_f_admin';
		$this->load->view('admin/index', $data);
	}

	function postNilai($form, $code_nilai, $kelas)
	{
		$id = decrypt_url($code_nilai);
		$get = $this->M_model->getSiswaByNilai($id);

		if ($this->input->post('nilai') == null) {
			$data['content'] = 'admin/input_nilai_f_admin';
			$data['nama'] = $get->nama_siswa;
			$data['form'] = $form;
			$data['nilai_ke'] = substr($form, 6);
			$data['id_nilai'] = $code_nilai . '/' . $kelas;
			$this->load->view('admin/index', $data);
		} else {
			$nilai = $this->input->post('nilai');
			$sql = "UPDATE tb_nilai SET $form = '$nilai' WHERE id_nilai = '$id'";
			$this->db->query($sql);
			$this->session->set_flashdata('notif', 'Data Nilai Berhasil Diperbarui Menjadi : ' . $nilai);

			redirect('formadmin/' . $kelas, 'refresh');
		}
	}

	public function exportNilaiExcelbyAdmin($id_kelas)
	{
		// Load plugin PHPExcel nya
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$export = $this->M_model->getFormNilai(
			null,
			$id_kelas
		);

		$this->_formatexport($export);
	}

	private function _formatexport($export)
	{
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('Sistem Informasi Akademik')
			->setLastModifiedBy('Sistem Informasi Akademik')
			->setTitle("Data Nilai Sistem Informasi Akademik")
			->setSubject("Sistem Informasi Akademik")
			->setDescription("Laporan Semua Data Nilai Siswa")
			->setKeywords("Data Nilai Siswa");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DAFTAR NILAI SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:k1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "TAPEL"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA SISWA"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "KELAS"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "SEMESTER"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "NILAI 1"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "NILAI 2"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "NILAI 3"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "NILAI 4"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('J3', "NILAI 5"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('K3', "NILAI 6"); // Set kolom E3 dengan tulisan "ALAMAT"

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($export as $ex) { // Lakukan looping pada variabel siswa
			if ($ex->tapel == null) {
				$tapel_ex = "-";
			} else {
				$tapel_ex = $ex->tapel;
			}
			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $tapel_ex);
			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $ex->nama_siswa);
			$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $ex->nama_kelas . $ex->sub_kelas);
			$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $ex->semester);
			$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $ex->nilai_1);
			$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $ex->nilai_2);
			$excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $ex->nilai_3);
			$excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $ex->nilai_4);
			$excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $ex->nilai_5);
			$excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $ex->nilai_6);

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom E

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Nilai Siswa");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Nilai Siswa.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function deleteDataNilai($nilai, $id_kelas)
	{
		$id_nilai = decrypt_url($nilai);
		$this->db->where('id_nilai', $id_nilai);
		$this->db->delete('tb_nilai');

		$this->session->set_flashdata('notif', 'Data nilai siswa berhasil dihapus secara keseluruhan');
		redirect('formadmin/' . $id_kelas);
	}
	/**End edit */

	public function index()
	{
		$data['user'] = $this->M_admin->getDataGuru($this->session->userdata('id'))->row();
		if ($this->notifikasi) {
			$data['notif'] = "DATA SISWA BERHASIL DITAMBAHKAN";

			$data['content'] = 'admin/dasbhoard';
			$this->load->view('admin/index', $data);
		} else {
			$data['tapel'] = $this->M_admin->getTapel()->row();
			$data['jml_siswa'] = $this->M_admin->hitungResource(1)->num_rows();
			$data['jml_guru'] = $this->M_admin->hitungResource(2)->num_rows();
			$data['jml_kelas'] = $this->M_admin->hitungResource(3)->num_rows();
			$data['jml_mapel'] = $this->M_admin->hitungResource(4)->num_rows();

			$data['content'] = 'admin/dasbhoard';
			$this->load->view('admin/index', $data);
		}
	}

	function dataKelas7()
	{

		$data['data'] = $this->M_model->getSiswabyKelas(7);
		$data['content'] = 'admin/data_kelas_tujuh';
		$this->load->view('admin/index', $data);
	}

	function dataKelas8()
	{

		$data['data'] = $this->M_model->getSiswabyKelas(8);
		$data['content'] = 'admin/data_kelas_delapan';
		$this->load->view('admin/index', $data);
	}

	function dataKelas9()
	{

		$data['data'] = $this->M_model->getSiswabyKelas(9);
		$data['content'] = 'admin/data_kelas_sembilan';
		$this->load->view('admin/index', $data);
	}

	function dataAlumni()
	{
		$data['data'] = $this->M_model->getAlumni();
		$data['content'] = 'admin/data_alumni';
		$this->load->view('admin/index', $data);
	}

	function dataGuru()
	{
		$data['data'] = $this->M_model->getGuru();
		$data['content'] = 'admin/data_guru';
		$this->load->view('admin/index', $data);
	}

	function dataKelas()
	{
		$data['data'] = $this->M_model->getKelas();
		$data['content'] = 'admin/data_kelas';
		$this->load->view('admin/index', $data);
	}

	function mapel()
	{
		$data['data'] = $this->M_model->getMapel();
		$data['content'] = 'admin/data_mapel';
		$this->load->view('admin/index', $data);
	}

	function getGuru($id)
	{
		$array = array();

		$databykelas = $this->M_model->getGuruByKelas($id);

		foreach ($databykelas as $key) {
			array_push($array, $key->id_guru);
		}

		$in = '(' . implode(',', $array) . ')';

		if ($array != null) {
			$data['spinner'] = $this->db->query("SELECT * from tb_guru g JOIN tb_mapel m ON g.id_mapel = m.id_mapel WHERE tugas ='GURU MAPEL' AND id_guru NOT IN $in")->result();
		} else {
			$data['spinner'] = $this->db->query("SELECT * from tb_guru g JOIN tb_mapel m ON g.id_mapel = m.id_mapel WHERE tugas ='GURU MAPEL'")->result();
		}
		$data['id'] = $id;
		$data['kelas'] = $this->M_model->getClassById($id);
		$data['data'] = $this->M_model->getGuruByKelas($id);
		$data['content'] = 'admin/guru_pengajar';
		$this->load->view('admin/index', $data);
	}

	function tambahSiswa()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nisn', 'Nama', 'required');
		$this->form_validation->set_rules('nama', 'Nisn', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['kelas'] = $this->db->get('tbl_kelas')->result();

			$data['content'] = 'admin/tambah_siswa';
			$this->load->view('admin/index', $data);
		} else {
			// cek jika ada gambar
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = $this->config->item('type_pp');
				$config['max_size']      = $this->config->item('max_pp');
				$config['upload_path'] = './assets/img/profile';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('addstudent');
				}
			}

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
				'id_kelas' => $this->input->post('kelas'),
				'status_siswa' => 'AKTIF',
				'password' => sha1($this->input->post('nisn'))
			);

			$this->db->insert('tb_siswa', $insert_data);
			$this->notifikasi = true;
			$this->session->set_flashdata('success_add', 'Berhasil Ditambahkan');
			redirect('admin', 'refresh');
		}
	}

	function editSiswa($id_siswa, $kelas)
	{
		$this->db->where('id_siswa', $id_siswa);
		$data['siswa'] = $this->db->get('tb_siswa')->row();
		$data['kelas'] = $this->db->get('tbl_kelas')->result();
		$data['nama_kelas'] = $kelas;

		$data['content'] = 'admin/edit_siswa';
		$this->load->view('admin/index', $data);
	}

	function editSiswaProses($id_siswa, $kelas)
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nisn', 'Nama', 'required');
		$this->form_validation->set_rules('nama', 'Nisn', 'required');

		if ($this->form_validation->run() == FALSE) {
		} else {
			$data = $this->M_admin->getDataSiswa($id_siswa)->row();

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
					redirect('changestud/' . $id_siswa . '/' . $kelas);
				}
			}

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
				'id_kelas' => $this->input->post('kelas'),
				'status_siswa' => 'AKTIF'
			);
		}

		$this->db->where('id_siswa', $id_siswa);
		$this->db->update('tb_siswa', $insert_data);
		$this->notifikasi = true;
		if ($kelas == 7) {
			$this->notifikasi = true;
			$this->session->set_flashdata('success_edit', 'Berhasil Diperbarui');
			redirect('sevenclass', 'refresh');
		} else if ($kelas == 8) {

			$this->session->set_flashdata('success_edit', 'Berhasil Diperbarui');
			redirect('eightclass', 'refresh');
			// $this->dataKelas8();
		} else {

			$this->session->set_flashdata('success_edit', 'Berhasil Diperbarui');
			redirect('nineclass', 'refresh');
			//$this->dataKelas9();
		}
	}

	function hapusSiswa($kelas, $id)
	{
		$this->db->where('id_siswa', $id);
		$this->db->delete('tb_siswa');

		$this->db->where('id_siswa', $id);
		$this->db->delete('tb_nilai');

		$this->notifikasi = true;
		$this->pesan = "Data Berhasil dihapus";
		if ($kelas == 7) {
			redirect('sevenclass', 'refresh');
		} else if ($kelas == 8) {
			redirect('eightclass', 'refresh');
		} else {
			redirect('nineclass', 'refresh');
		}
	}


	function tambahMapel()
	{
		$array = array('nama_mapel' => $this->input->post('mapel'));
		$this->db->insert('tb_mapel', $array);
		redirect('course', 'refresh');
	}

	function izinPenilaian($id_kelas)
	{
		$this->db->where('id_kelas', $id_kelas);
		$array = array('access_nilai' => 'YES');
		$this->db->update('tbl_kelas', $array);

		redirect('classroom', 'refresh');
	}

	function tutupPenilaian($id_kelas)
	{
		$this->db->where('id_kelas', $id_kelas);
		$array = array('access_nilai' => 'NO');
		$this->db->update('tbl_kelas', $array);

		$this->db->where('id_kelas', $id_kelas);
		$array = array('status_nilai' => 'NON AKTIF');
		$this->db->update('tb_nilai', $array);
		redirect('classroom', 'refresh');
	}

	function dataKelasGuru($id)
	{
		$this->db->where('id_guru', $id);
		$data['guru'] = $this->db->get('tb_guru')->row();
		$data['data'] = $this->M_model->getKelasByGuru($id);
		$data['content'] = 'admin/data_kelas_guru';
		$this->load->view('admin/index', $data);
	}

	function tambahGuru()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nign', 'Nama', 'required');
		$this->form_validation->set_rules('nama', 'Nisn', 'required');

		if ($this->form_validation->run() == FALSE) {

			$data['mapel'] = $this->db->get('tb_mapel')->result();
			$data['content'] = 'admin/tambah_guru';
			$this->load->view('admin/index', $data);
		} else {

			// cek jika ada gambar
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = $this->config->item('type_pp');
				$config['max_size']      = $this->config->item('max_pp');
				$config['upload_path'] = './assets/img/profile';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('addteacher');
				}
			}
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
			redirect('teacher', 'refresh');
		}
	}

	function editGuru($id_guru)
	{
		$this->db->where('id_guru', $id_guru);
		$data['get'] = $this->db->get('tb_guru')->row();
		$data['mapel'] = $this->db->get('tb_mapel')->result();

		$data['content'] = 'admin/edit_guru';
		$this->load->view('admin/index', $data);
	}


	function prosesEditGuru($id)
	{
		$data = $this->M_admin->getDataGuru($id)->row();

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
				redirect('addteacher');
			}
		}

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
		redirect('teacher', 'refresh');
	}

	function hapusGuru($id)
	{
		$this->db->where('id_guru', $id);
		$data['get'] = $this->db->get('tb_guru')->row();
		$data['content'] = 'admin/hapus_guru';
		$this->load->view('admin/index', $data);
	}

	function prosesHapusGuru($id)
	{
		$this->db->where('id_guru', $id);
		$this->db->delete('tb_guru');

		$this->db->where('id_guru', $id);
		$this->db->delete('tb_nilai');

		$this->session->set_flashdata('add_guru', 'Data Guru Berhasil Dihapus');
		redirect('teacher', 'refresh');
	}

	function alumniStatus($id)
	{
		$edit = array('status_siswa' => 'ALUMNI');
		$this->db->where('id_siswa', $id);
		$this->db->update('tb_siswa', $edit);

		$this->session->set_flashdata('success_edit', 'Data Siswa Berubah Menjadi Alumni');
		redirect('nineclass', 'refresh');
	}

	function tambahGuruKelas($id)
	{
		$guru = $this->input->post('guru');
		$insert = array('id_guru' => $guru, 'id_kelas' => $id);
		$this->db->insert('tb_detail_kelas', $insert);
		$this->session->set_flashdata('success', 'Sukses Ditambahkan');
		redirect('teacher/' . $id, 'refresh');
	}

	function profile($id)
	{
		// echo $tes = $this->encryption->encrypt($id);
		// echo '<br>'.$this->encryption->decrypt($tes);
		$this->db->where('id_guru', decrypt_url($id));
		$admin = $this->db->get('tb_guru')->row();
		$data['data'] = $admin;
		if ($admin == null) {
			$data['content'] = '404';
			$this->load->view('admin/index', $data);
			return;
		}
		$data['content'] = 'admin/profile';
		$this->load->view('admin/index', $data);
	}

	function ubahPassword($id_admin)
	{
		$id = decrypt_url($id_admin);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {

			$this->db->where('id_guru', $id);
			$data['data'] = $this->db->get('tb_guru')->row();

			$data['content'] = 'admin/ubah_password';
			$this->load->view('admin/index', $data);
		} else {
			$update = array('password' => sha1($this->input->post('password')));
			$this->db->where('id_guru', $id);
			$this->db->update('tb_guru', $update);

			$this->session->set_flashdata('success', 'Password Sukses Diganti');
			redirect('admin/profile/' . $id_admin, 'refresh');
		}
	}

	function deleteTeacherByClass($id_detail_class, $id_kelas)
	{
		$this->db->where('id_detail_kelas', $id_detail_class);
		$this->db->delete('tb_detail_kelas');

		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('teacher/' . $id_kelas, 'refresh');
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/administrator/Admin.php */