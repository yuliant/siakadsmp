<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <h1 class="h3 mb-2 text-gray-800">Tabel Nilai</h1>
        <p class="mb-4">Daftar nilai siswa kelas.</p>
      </div>

      <!-- Form pembuatan smt -->
      <?php if ($data == null) { ?>
        <div class="col-md-12 col-lg-12">

          <button class="btn btn-danger btn-icon-split btn-sm" href="#" data-toggle="modal" data-target="#ganjilModal">
            <span class="icon text-white-50">
              <i class="fab fa-wpforms"></i>
            </span>
            <span class="text">Buat Form Smt. Ganjil</span>
          </button>

          <button class="btn btn-primary btn-icon-split btn-sm" href="#" data-toggle="modal" data-target="#genapModal">
            <span class="icon text-white-50">
              <i class="fab fa-wpforms"></i>
            </span>
            <span class="text">Buat Form Smt. Genap</span>
          </button>

        </div>
      <?php } else { ?>
        <div class="col-md-12 col-lg-12">
          <a class="btn btn-success btn-icon-split btn-sm" href="<?php echo base_url('guru/guru/exportNilaiExcel/') . $id_guru . '/' . $id_kelas ?>">
            <span class="icon text-white-50">
              <i class="fab fa-wpforms"></i>
            </span>
            <span class="text">Eksport data excel</span>
          </a>
        </div>
      <?php } ?>
    </div>

    <!-- Notifikasi -->
    <?php if ($this->session->flashdata('notif') != "") { ?>
      <div id="notifikasi">
        <p>
          <div class="alert alert-success"><b><?php echo $this->session->flashdata('notif') ?></b></div>
        </p>
      </div>
    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="margin-top: 30px">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Tahun Pelajaran</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Mata Pelajaran</th>
                <th>Nilai 1</th>
                <th>Nilai 2</th>
                <th>Nilai 3</th>
                <th>Nilai 4</th>
                <th>Nilai 5</th>
                <th>Nilai 6</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php $no = 1;
              foreach ($data as $key) { ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $tapel->tapel ?></td>
                  <td><?php echo $key->nama_siswa ?></td>
                  <td><?php echo $key->nama_kelas . $key->sub_kelas ?></td>
                  <td><?php echo $key->semester ?></td>
                  <td><?php echo $key->nama_mapel ?></td>
                  <!-- Nilai 1-->
                  <td>
                    <?php if ($key->nilai_1 == null) { ?>
                      <a href="<?php echo site_url('score/nilai_1/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-danger btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-plus"></i></span></a>
                    <?php } else { ?>
                      <a href="<?php echo site_url('score/nilai_1/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                        </span>
                        <span class="text"><?php echo $key->nilai_1 ?></span>
                      </a>
                    <?php } ?>
                  </td>

                  <!--Nilai 2-->
                  <td>
                    <?php if ($key->nilai_2 == null) { ?>
                      <a href="<?php echo site_url('score/nilai_2/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-danger btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-plus"></i></span></a>
                    <?php } else { ?>
                      <a href="<?php echo site_url('score/nilai_2/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                        </span>
                        <span class="text"><?php echo $key->nilai_2 ?></span>
                      </a>
                    <?php } ?>
                  </td>

                  <!--Nilai 3-->
                  <td>
                    <?php if ($key->nilai_3 == null) { ?>
                      <a href="<?php echo site_url('score/nilai_3/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-danger btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-plus"></i></span></a>
                    <?php } else { ?>
                      <a href="<?php echo site_url('score/nilai_3/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                        </span>
                        <span class="text"><?php echo $key->nilai_3 ?></span>
                      </a>
                    <?php } ?>
                  </td>

                  <!--Nilai 4-->
                  <td>
                    <?php if ($key->nilai_4 == null) { ?>
                      <a href="<?php echo site_url('score/nilai_4/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-danger btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-plus"></i></span></a>
                    <?php } else { ?>
                      <a href="<?php echo site_url('score/nilai_4/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                        </span>
                        <span class="text"><?php echo $key->nilai_4 ?></span>
                      </a>
                    <?php } ?>
                  </td>
                  <!--Nilai 5-->
                  <td>
                    <?php if ($key->nilai_5 == null) { ?>
                      <a href="<?php echo site_url('score/nilai_5/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-danger btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-plus"></i></span></a>
                    <?php } else { ?>
                      <a href="<?php echo site_url('score/nilai_5/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                        </span>
                        <span class="text"><?php echo $key->nilai_5 ?></span>
                      </a>
                    <?php } ?>
                  </td>

                  <!--Nilai 6-->
                  <td>
                    <?php if ($key->nilai_6 == null) { ?>
                      <a href="<?php echo site_url('score/nilai_6/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-danger btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-plus"></i></span></a>
                    <?php } else { ?>
                      <a href="<?php echo site_url('score/nilai_6/') . encrypt_url($key->id_nilai) . '/' . $id_kelas ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                        </span>
                        <span class="text"><?php echo $key->nilai_6 ?></span>
                      </a>
                    <?php } ?>
                  </td>

                  <td>
                    <a onclick="javascript:return confirm('Apakah anda yakin ingin menghapus siswa ini?')" href="<?php echo site_url('deletenilai/') . encrypt_url($key->id_nilai) . '/' . $id_guru . '/' . $id_kelas ?>" class="btn btn-danger btn-icon-split btn-sm">
                      <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                      </span>
                      <span class="text">Hapus</span>
                    </a>
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

<!-- Modal Ganjil -->
<div class="modal fade" id="ganjilModal" tabindex="-1" role="dialog" aria-labelledby="ganjilModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ganjilModalLabel">Input Nilai Semester Ganjil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- form tambah data menu -->
      <form class="" action="<?php echo base_url('form/create'); ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>">
          <input type="hidden" name="semester" value="<?php echo "GANJIL"; ?>">
          <input type="hidden" name="id_guru" value="<?php echo $this->session->userdata('id'); ?>">


          <div class="form-group">
            <label for="tapel">Tahun Pelajaran</label>
            <input type="text" class="form-control" id="tapel" name="tapel" value="<?= $tapel->tapel ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Input</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal Genap -->
<div class="modal fade" id="genapModal" tabindex="-1" role="dialog" aria-labelledby="genapModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="genapModalLabel">Input Nilai Semester Genap</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- form tambah data menu -->
      <form class="" action="<?php echo base_url('form/create'); ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>">
          <input type="hidden" name="semester" value="<?php echo "GENAP"; ?>">
          <input type="hidden" name="id_guru" value="<?php echo $this->session->userdata('id'); ?>">


          <div class="form-group">
            <label for="tapel">Tahun Pelajaran</label>
            <input type="text" class="form-control" id="tapel" name="tapel" value="<?= $tapel->tapel ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Input</button>
        </div>
      </form>

    </div>
  </div>
</div>