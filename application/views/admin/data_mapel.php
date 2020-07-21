<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tabel Mata Pelajaran</h1>
      <p class="mb-4">Daftar Semua Mata Pelajaran</p>

      <div class="row">
        <div class="col-md-4 col-lg-4">
          <form action="<?php echo site_url('addcourse')?>" method="post">
            <div class="input-group mb-3">
              <input type="text" onkeyup="this.value=this.value.toUpperCase()" name="mapel" class="form-control" placeholder="Mata Pelajaran"/>
              <div class="input-group-append">
                <input type="submit" class="btn btn-primary btn-sm" value="Tambah" />
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
      
      <br><br>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Mapel</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Mapel</th>
                  <th>Nama Mapel</th>
                  
                </tr>
              </thead>
              
              <tbody>
              <?php $no=1; foreach ($data as $key){?>
                <tr>
                  <td><?php echo $no?></td>
                  <td><?php echo 'PEL-'.$key->id_mapel?></td>
                  <td><?php echo $key->nama_mapel?></td>
                  
                </tr>
              <?php $no++; }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>