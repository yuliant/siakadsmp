<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tabel Guru Pengajar</h1>
      <p class="mb-4">Daftar Semua Guru Pengajar</p>
      <a href="<?php echo site_url('addteacher')?>" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
        <span class="text">Tambah Guru</span>
      </a>

      <?php if($this->session->flashdata('add_guru') != ""){?>
    <div id="notifikasi">
      <p>
        <div class="alert alert-primary"><?php echo $this->session->flashdata('add_guru')?></div>
      </p>   
    </div>
    <?php } ?>
      <br><br>


      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>NIGN</th>
                  <th>Nama Guru</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Agama</th>
                  <th>Pendidikan</th>
                  <th>Tugas</th>
                  <th>Alamat</th>
                  <th>Mapel</th>
                  <th></th>
                  
                </tr>
              </thead>
              
              <tbody>
              <?php $nomor=1; foreach ($data as $key) {?>
                <tr>
                  <td><?php echo $nomor?></td>
                  <td><?php echo $key->nip?></td>
                  <td><?php echo $key->nign?></td>
                  <td><?php echo $key->nama_guru?></td>
                  <td><?php echo $key->tempat_lahir?></td>
                  <td><?php echo $key->tgl_lahir?></td>
                  <td><?php echo $key->j_kelamin?></td>
                  <td><?php echo $key->agama?></td>
                  <td><?php echo $key->pendidikan?></td>
                  <td><?php echo $key->tugas?></td>
                  <td><?php echo $key->alamat_guru?></td>
                  <td><?php echo $key->nama_mapel?></td>
                  <td>
                    <a href="<?php echo site_url('updteacher/').$key->id_guru;?>" class="btn btn-warning btn-icon-split btn-sm">
                      <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                      <span class="text">Edit</span>
                    </a>

                    <a href="<?php echo site_url('deleteteacher/').$key->id_guru;?>" class="btn btn-danger btn-icon-split btn-sm">
                      <span class="icon text-white-50"><i class="fas fa-trash"></i></span>
                      <span class="text">Hapus</span>
                    </a>

                    <a href="<?php echo site_url('class/').$key->id_guru?>" class="btn btn-primary btn-icon-split btn-sm">
                      <span class="icon text-white-50"><i class="fas fa-table"></i></span>
                      <span class="text">Kelas</span>
                    </a>
                  </td>
                <?php $nomor++;}?>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>