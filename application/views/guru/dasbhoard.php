<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Selamat Datang, <?php echo $this->session->userdata('nama'); ?></h1>
    <p class="mb-4">
      Di Sistem Informasi Akademi SMPN 2 Krembung tahun pelajaran <?php echo $tapel->tapel; ?>
    </p>

    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Jumlah Siswa Yang Diajar
                </div>
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
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                  Jumlah Kelas Yang Diajar
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

    </div>

    <div class="card mb-3 col-lg-6">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img src="<?php echo base_url('assets/img/profile/') . $user->image ?>" class="card-img" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?php echo $user->nama_guru ?></h5>
            <p class="card-text"><?php echo "NIP. " . $user->nip ?></p>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>