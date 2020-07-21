<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Profile</h1>
      <p class="mb-4">Ini adalah Profile Anda.</p>
      
      <?php if (isset($notif)){?>
      <div id="notifikasi">
        <p>
          <div class="alert alert-primary"><?php echo $notif?></div>
        </p>   
      </div>
      <?php }?>

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
                  <th width="50%">Kode Guru</th>
                  <td>TEACH-<?php echo $get->id_guru ?></td>
                </tr>

                <tr>
                  <th>Nama Guru</th>
                  <td><?php echo $get->nama_guru ?></td>
                </tr>
                <tr>
                  <th>Pendidikan</th>
                  <td><?php echo $get->pendidikan ?></td> 
                </tr>

                <tr>
                  <td><h4 class="text-danger">TIDAK DISARANKAN!</h4>Jika Anda Menghapus Data Guru, <br>maka daftar nilai siswa yang menjadi tanggung jawab dari <?php echo $get->nama_guru;?> akan terhapus juga!</td>
                  <td>
                    <a href="<?php echo site_url('delete/teacher/').$get->id_guru?>" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Tetap Hapus</span>
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