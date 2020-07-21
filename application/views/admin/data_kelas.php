<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tabel Daftar Kelas</h1>
      <p class="mb-4">Daftar Semua Kelas</p>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Kelas</th>
                  <th>Nama Kelas</th>
                  <th>Total Siswa</th>
                  <th></th>
                </tr>
              </thead>
              
              <tbody>
              <?php $no=1; foreach ($data as $key){?>
                <tr>
                  <td><?php echo $no?></td>
                  <td><?php echo 'Kelas-'.$key->id_kelas?></td>
                  <td><?php echo $key->nama_kelas.$key->sub_kelas?></td>
                  <td><?php echo $key->total_siswa?></td>
                  <td>
                    <a href="<?php echo site_url('teacher/').$key->id_kelas?>" class="btn btn-warning btn-icon-split btn-sm">
                      <span class="icon text-white-50"><i class="fas fa-table"></i></span>
                      <span class="text">Guru Pengajar</span>
                    </a>
                    <?php if ($key->access_nilai=="YES") {?>
                    <a onclick="javascript:return confirm('Jika anda Menutup Penilaian, Maka formulir penilaian di kelas ini akan resmi berakhir!')" href="<?php echo site_url('closescore/').$key->id_kelas?>" class="btn btn-danger btn-icon-split btn-sm">
                      <span class="icon text-white-50"><i class="fas fa-times"></i></span>
                      <span class="text">Tutup Penilaian</span>
                    </a>
                    <?php } else {?>
                    <a href="<?php echo site_url('accessscore/').$key->id_kelas?>" class="btn btn-primary btn-icon-split btn-sm">
                      <span class="icon text-white-50"><i class="fas fa-check-square"></i></span>
                      <span class="text">Izinkan Penilaian</span>
                    </a>
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