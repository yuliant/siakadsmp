<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tabel Keseluruhan Nilai</h1>
      <p class="mb-4">Daftar Nilai Anda ada disini.</p>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Mata Pelajaran</th>
                  <th>Kelas</th>
                  <th>Semester</th>
                  <th>Guru Pengajar</th>
                  <th>Nilai 1</th>
                  <th>Nilai 2</th>
                  <th>Nilai 3</th>
                  <th>Nilai 4</th>
                  <th>Nilai 5</th>
                  <th>Nilai 6</th>
                </tr>
              </thead>
              
              <tbody>
              <?php $no=1;foreach ($data as $key){?>
                <tr>
                  <td><?php echo $no?></td>
                  <td><?php echo $key->nama_mapel?></td>
                  <td><?php echo $key->nama_kelas?></td>
                  <td><?php echo $key->semester?></td>
                  <td><?php echo $key->nama_guru?></td>
                  <td><?php echo $key->nilai_1?></td>
                  <td><?php echo $key->nilai_2?></td>
                  <td><?php echo $key->nilai_3?></td>
                  <td><?php echo $key->nilai_4?></td>
                  <td><?php echo $key->nilai_5?></td>
                  <td><?php echo $key->nilai_6?></td>
                </tr>
                <?php $no++; }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>