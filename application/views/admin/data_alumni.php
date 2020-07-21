<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tabel Alumni</h1>
      <p class="mb-4">Daftar Siswa Alumni</p>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Alumni</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NISN</th>
                  <th>Nama Siswa</th>
                  <th>Jenis Kelamin</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Nama Ayah</th>
                  <th>Nama Ibu</th>
                  <th>Telepon</th>
                  <th>Pekerjaan Ayah</th>
                  <th>Pekerjaan Ibu</th>
                  <th>Agama</th>
                  <th>Alamat</th>
                  <th>Kelas</th>
                </tr>
              </thead>
              
              <tbody>
              
                <?php $no=1; foreach ($data as $key) {?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $key->nisn;?></td>
                  <td><?php echo $key->nama_siswa;?></td>
                  <td><?php echo $key->j_kelamin;?></td>
                  <td><?php echo $key->tmp_lahir;?></td>
                  <td><?php echo $key->tgl_lahir;?></td>
                  <td><?php echo $key->nama_ayah;?></td>
                  <td><?php echo $key->nama_ibu;?></td>
                  <td><?php echo $key->telp_ortu;?></td>
                  <td><?php echo $key->pekerjaan_ayah?></td>
                  <td><?php echo $key->pekerjaan_ibu;?></td>
                  <td><?php echo $key->agama;?></td>
                  <td><?php echo $key->alamat_siswa;?></td>
                  <td><?php echo $key->nama_kelas.$key->sub_kelas;?></td>
                </tr>
                <?php $no++; }?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>