<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Selamat Datang Admin, <?php echo $this->session->userdata('nama'); ?></h1>
    <p class="mb-4">
      Anda sekarang berada di dashboard admin
    </p>

    <?php if ($this->session->flashdata('success_add') != "") { ?>
      <div id="notifikasi">
        <p>
          <div class="alert alert-primary"><?php echo $this->session->flashdata('success_add') ?></div>
        </p>
      </div>
    <?php } ?>

    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Siswa</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php echo $jml_siswa ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Guru</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php echo $jml_guru ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                  Jumlah Kelas
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php echo $jml_kelas ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Jumlah Mata Pelajaran
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php echo $jml_mapel ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row">

      <div class="col-lg-6">
        <!-- Illustrations -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ilustrasi</h6>
          </div>
          <div class="card-body">
            <p>
              Sistem Informasi Akademi SMPN 2 Krembung tahun pelajaran <?php echo $tapel->tapel; ?>
            </p>
            <a href="#" data-toggle="modal" data-target="#changeTapelModal">
              Edit Tahun Pelajaran &rarr;
            </a>
          </div>
        </div>
      </div>

      <div class="card shadow mb-3 col-lg-5">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?php echo base_url('assets/img/profile/') . $user->image ?>" class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php echo $user->nama_guru ?></h5>
              <?php if ($user->nip == null) {
                echo "Tidak ada data NIP";
              } else { ?>
                <p class="card-text"><?php echo "NIP. " . $user->nip ?></p>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

<!-- Modal Change Tapel -->
<div class="modal fade" id="changeTapelModal" tabindex="-1" role="dialog" aria-labelledby="changeTapelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeTapelModalLabel">Ubah Tahun Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- form tambah data menu -->
      <form class="" action="<?php echo base_url('administrator/admin/editTapel'); ?>" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label for="tapel">Tahun Pelajaran</label>
            <input type="text" class="form-control" id="tapel" name="tapel">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Input</button>
        </div>
      </form>

    </div>
  </div>
</div>