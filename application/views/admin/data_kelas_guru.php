<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tabel Daftar Dari : <?php echo $guru->nama_guru?></h1>
      <p class="mb-4">Daftar Semua Kelas </p>

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
                  
                </tr>
              </thead>
              
              <tbody>
              <?php $no=1; foreach ($data as $key){?>
                <tr>
                  <td><?php echo $no?></td>
                  <td><?php echo 'Kelas-'.$key->id_kelas?></td>
                  <td><?php echo $key->nama_kelas.$key->sub_kelas?></td>
                </tr>
              <?php $no++; }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>