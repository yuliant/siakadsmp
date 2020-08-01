<?php
function predikat($nilai)
{
  if ($nilai <= 100 && $nilai > 89) {
    return "A";
  } elseif ($nilai <= 89 && $nilai > 79) {
    return "B";
  } elseif ($nilai <= 79 && $nilai > 69) {
    return "C";
  } elseif ($nilai <= 69 && $nilai > 59) {
    return "D";
  } else {
    return "E";
  }
}

function comulative_value($nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6)
{
  return ($nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6) / 6;
}
?>
<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Keseluruhan Nilai</h1>
    <p class="mb-1">Daftar Nilai Anda ada disini.</p>

    <a class="btn btn-primary mb-4" href="
    <?php echo base_url('siswa/siswa/laporan_pdf/' .
      encrypt_url($this->session->userdata('id'))) ?>">Cetak Nilai PDF</a>

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
                <th>Tahun Pelajaran</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Guru Pengajar</th>
                <th>Nilai 1</th>
                <th></th>
                <th>Nilai 2</th>
                <th></th>
                <th>Nilai 3</th>
                <th></th>
                <th>Nilai 4</th>
                <th></th>
                <th>Nilai 5</th>
                <th></th>
                <th>Nilai 6</th>
                <th></th>
                <th>Nilai Komulatif</th>
              </tr>
            </thead>

            <tbody>
              <?php $no = 1;
              foreach ($data as $key) { ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $key->tapel ?></td>
                  <td><?php echo $key->nama_mapel ?></td>
                  <td><?php echo $key->nama_kelas . $key->sub_kelas ?></td>
                  <td><?php echo $key->semester ?></td>
                  <td><?php echo $key->nama_guru ?></td>

                  <td>
                    <?php echo $key->nilai_1 ?>
                  </td>
                  <td><?php echo predikat($key->nilai_1) ?></td>

                  <td>
                    <?php echo $key->nilai_2 ?>
                  </td>
                  <td><?php echo predikat($key->nilai_2) ?></td>

                  <td>
                    <?php echo $key->nilai_3 ?>
                  </td>
                  <td><?php echo predikat($key->nilai_3) ?></td>

                  <td>
                    <?php echo $key->nilai_4 ?>
                  </td>
                  <td><?php echo predikat($key->nilai_4) ?></td>

                  <td>
                    <?php echo $key->nilai_5 ?>
                  </td>
                  <td><?php echo predikat($key->nilai_5) ?></td>

                  <td>
                    <?php echo $key->nilai_6 ?>
                  </td>
                  <td><?php echo predikat($key->nilai_6) ?></td>

                  <td>
                    <?php echo predikat(comulative_value($key->nilai_1, $key->nilai_2, $key->nilai_3, $key->nilai_4, $key->nilai_5, $key->nilai_6)) ?>
                  </td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>