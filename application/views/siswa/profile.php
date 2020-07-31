<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Profile</h1>
    <p class="mb-4">Ini adalah Profile Anda.</p>

    <?php if ($this->session->flashdata('success') != "") { ?>
      <div id="notifikasi">
        <p>
          <div class="alert alert-primary"><b><?php echo $this->session->flashdata('success') ?></b></div>
        </p>
      </div>
    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Kode Siswa</th>
                <td>SIS-<?php echo $data->id_siswa ?></td>
              </tr>

              <tr>
                <th>Nama</th>
                <td><?php echo $data->nama_siswa ?></td>
              </tr>
              <tr>
                <th>Kelas</th>
                <td><?php echo $data->nama_kelas . $data->sub_kelas ?></td>
              </tr>
              <tr>
                <th>Tempat Lahir</th>
                <td><?php echo $data->tmp_lahir ?></td>
              </tr>
              <tr>
                <th>Tanggal Lahir</th>
                <td><?php echo date("d-m-Y", strtotime($data->tgl_lahir)) ?></td>
              </tr>
              <tr>
                <th>Nama Ayah</th>
                <td><?php echo $data->nama_ayah ?></td>
              </tr>
              <tr>
                <th>Nama Ibu</th>
                <td><?php echo $data->nama_ibu ?></td>
              </tr>
              <tr>
                <th>Pekerjaan Ayah</th>
                <td><?php echo $data->pekerjaan_ayah ?></td>
              </tr>
              <tr>
                <th>Pekerjaan Ibu</th>
                <td><?php echo $data->pekerjaan_ibu ?></td>
              </tr>
              <tr>
                <th>Telepon Orang Tua</th>
                <td><?php echo $data->telp_ortu ?></td>
              </tr>
              <tr>
                <th>Password</th>
                <td>
                  <a href="<?php echo site_url('s/password/') . encrypt_url($data->id_siswa) ?>" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-edit"></i>
                    </span>
                    <span class="text">Ubah Password</span>
                  </a>
                </td>
              </tr>
              <tr>
                <th>Image</th>
                <td>
                  <div class="col-lg-4">
                    <img src="<?php echo base_url('assets/img/profile/') . $data->image ?>" class="card-img" alt="...">
                  </div>
                  <a href="<?php echo site_url('s/changeimage/') . encrypt_url($data->id_siswa) ?>" class="btn btn-primary btn-icon-split btn-sm mt-2">
                    <span class="icon text-white-50">
                      <i class="fas fa-edit"></i>
                    </span>
                    <span class="text">Ubah Gambar</span>
                  </a>
                </td>
              </tr>

            </thead>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>