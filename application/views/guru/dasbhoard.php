<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Selamat Datang, <?php echo $this->session->userdata('nama'); ?></h1>
    <p class="mb-4">
      Di sistem akademi SMPN 2 Krembung tahun pelajaran <?php echo $tapel->tapel; ?>
    </p>

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