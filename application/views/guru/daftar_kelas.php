<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tabel Kelas</h1>
      <p class="mb-4">Daftar Kelas Anda ada disini.</p>
      
      <?php if (isset($notif)){?>
      <div id="notifikasi">
        <p>
          <div class="alert alert-success"><b><?php echo $notif?></b></div>
        </p>   
      </div>
      <?php }?>
      
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kelas</th>
                  <th>Action</th>
                </tr>
              </thead>
              
              <tbody>
              <?php $no=1;foreach ($data as $key){?>
                <tr>
                  <td><?php echo $no?></td>
                  <td><?php echo $key->nama_kelas.$key->sub_kelas?></td>
                  <td>
                  <?php if ($key->access_nilai == 'YES'){?>
                  <a href="<?php echo site_url('form/').encrypt_url($this->session->userdata('id')).'/'.encrypt_url($key->id_kelas)?>" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-eye"></i>
                    </span>
                    <span class="text">Rincian</span>
                  </a>
                  <?php } else{?>
                  <span class="btn-secondary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-eye"></i>
                    </span>
                    <span class="text">Belum Ada Akses</span>
                  </span>
                  <?php }?>
                  </td>
                </tr>
                <?php $no++; }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>