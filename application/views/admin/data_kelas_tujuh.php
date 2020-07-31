<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Siswa Kelas 7</h1>
    <p class="mb-4">Daftar Siswa Kelas 7</p>

    <?php if ($this->session->flashdata('success_edit') != "") { ?>
      <div id="notifikasi">
        <p>
          <div class="alert alert-primary"><?php echo $this->session->flashdata('success_edit') ?></div>
        </p>
      </div>
    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Telepon</th>
                <th>Pekerjaan Ayah</th>
                <th>Pekerjaan Ibu</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>Tahun Pelajaran</th>
                <th>Kelas</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <?php $no = 1;
              foreach ($data as $key) { ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $key->nisn; ?></td>
                  <td><?php echo $key->nama_siswa; ?></td>
                  <td><?php echo $key->j_kelamin; ?></td>
                  <td><?php echo $key->tmp_lahir; ?></td>
                  <td><?php echo $key->tgl_lahir; ?></td>
                  <td><?php echo $key->nama_ayah; ?></td>
                  <td><?php echo $key->nama_ibu; ?></td>
                  <td><?php echo $key->telp_ortu; ?></td>
                  <td><?php echo $key->pekerjaan_ayah ?></td>
                  <td><?php echo $key->pekerjaan_ibu; ?></td>
                  <td><?php echo $key->agama; ?></td>
                  <td><?php echo $key->alamat_siswa; ?></td>
                  <td><?php echo $tapel->tapel; ?></td>
                  <td><?php echo $key->nama_kelas . $key->sub_kelas; ?></td>
                  <td>
                    <a href="<?php echo site_url('changestud/') . $key->id_siswa . '/7' ?>" class="btn btn-warning btn-icon-split btn-sm">
                      <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                      <span class="text">Edit</span>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#hapusModal<?php echo $key->id_siswa ?>" class="btn btn-danger btn-icon-split btn-sm">
                      <span class="icon text-white-50"><i class="fas fa-trash"></i></span>
                      <span class="text">Hapus</span>
                    </a>
                  </td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Hapus Modal-->
<?php foreach ($data as $key) { ?>
  <div class="modal fade" id="hapusModal<?php echo $key->id_siswa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda ingin Menghapus data? Jika Anda hapus, maka semua data dari siswa ini akan terhapus!!</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i></button>
          <a class="btn btn-primary" href="<?php echo site_url('delete/student/7/') . $key->id_siswa ?>"><i class="fas fa-trash"></i></a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>