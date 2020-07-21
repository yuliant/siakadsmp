<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Profile</h1>
      <p class="mb-4">Ini adalah Profile Anda.</p>
      
      <?php if($this->session->flashdata('success')!=""){?>
        <div id="notifikasi">
          <p>
            <div class="alert alert-primary"><b><?php echo $this->session->flashdata('success')?></b></div>
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
                  <th>Kode Admin</th>
                  <td>ADM-<?php echo $data->id_guru ?></td>
                </tr>

                <tr>
                  <th>Nama</th>
                  <td><?php echo $data->nama_guru ?></td>
                </tr>
                <tr>
                  <th>Tugas</th>
                  <td><?php echo $data->tugas ?></td> 
                </tr>
                <tr>
                  <th>Pendidikan</th>
                  <td><?php echo $data->pendidikan ?></td>
                </tr>
                <tr>
                  <th>Agama</th>
                  <td><?php echo $data->agama ?></td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td><?php echo $data->j_kelamin ?></td>
                </tr>
                <tr>
                  <th>Password</th>
                  <td>
                    <a href="<?php echo site_url('t/password/').encrypt_url($data->id_guru)?>" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-edit"></i>
                    </span>
                    <span class="text">Ubah Password</span>
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