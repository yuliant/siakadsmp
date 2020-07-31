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

	public function exportNilaiExcelbyWalas($id_kelas)
	{
		// Load plugin PHPExcel nya
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$export = $this->M_model->getFormNilai(
			null,
			decrypt_url($id_kelas)
		);

		$this->_formatexport($export);
	}

	public function exportNilaiExcel($id_guru, $id_kelas)
	{
		// Load plugin PHPExcel nya
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$export = $this->M_model->getFormNilai(
			decrypt_url($id_guru),
			decrypt_url($id_kelas)
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

	function getWalas($id)
	{
		$data['data'] = $this->M_guru->getKelasByWalas(decrypt_url($id));
		if ($data['data'] == null) {
			$data['content'] = '404';
			$this->load->view('guru/index', $data);
			return;
		}

		$data['content'] = 'guru/walas_kelas';
		$this->load->view('guru/index', $data);
	}

	function getWalasFormNilai($id_guru, $id_kelas)
	{
		$data['tapel'] = $this->M_guru->getTapel()->row();
		$data['data'] = $this->M_guru->getFormNilaiByWalas(decrypt_url($id_kelas));
		$data['id_kelas'] = $id_kelas;
		$data['id_guru'] = $id_guru;
		$data['content'] = 'guru/nilai_siswa_f_walas';
		$this->load->view('guru/index', $data);
	}

	public function deleteDataNilai($nilai, $guru, $kelas)
	{
		$id_nilai = decrypt_url($nilai);
		$id_guru = decrypt_url($guru);
		$id_kelas = decrypt_url($kelas);

		$this->db->where('id_nilai', $id_nilai);
		$this->db->delete('tb_nilai');

		$this->session->set_flashdata('notif', 'Data nilai siswa berhasil dihapus secara keseluruhan');
		redirect('form/' . encrypt_url($id_guru) . '/' . encrypt_url($id_kelas));
	}

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
		}
	}

	function postNilaiWalas($form, $code_nilai, $kelas)
	{
		$id = decrypt_url($code_nilai);
		$id_kelas = decrypt_url($kelas);

		$get = $this->M_model->getSiswaByNilai($id);

		if ($this->input->post('nilai') == null) {
			$data['content'] = 'guru/input_nilai_f_walas';
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

			redirect('formwalas/' . $id_guru . '/' . $kelas, 'refresh');
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