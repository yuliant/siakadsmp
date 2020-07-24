<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Selamat Datang Admin, <?php echo $this->session->userdata('nama'); ?></h1>
    <p class="mb-4">Di sistem akademi SMPN 2 Krembung tahun pelajaran
      <?php //echo date('Y') . '/' . date('Y', strtotime("+12 months")); 
      ?>
      <?php echo $tapel->tapel; ?>
      <a href="#" data-toggle="modal" data-target="#changeTapelModal">
        <i class="fas fa-directions"></i>edit tapel
      </a>
    </p>

    <?php if ($this->session->flashdata('success_add') != "") { ?>
      <div id="notifikasi">
        <p>
          <div class="alert alert-primary"><?php echo $this->session->flashdata('success_add') ?></div>
        </p>
      </div>
    <?php } ?>

    <div class="card mb-3 col-lg-6">
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

<!-- Modal Ganjil -->
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