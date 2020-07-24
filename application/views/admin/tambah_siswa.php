<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Siswa Baru</h1>
    <p class="mb-4">Formulir Data Siswa Baru</p>

    <div class="col-12 col-sm-8 col-lg-8">
      <?php echo $this->session->flashdata('message'); ?>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Siswa</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">

          <?php echo form_open_multipart('administrator/admin/tambahSiswa'); ?>
          <div style="padding-left: 20px; padding-right: 20px; margin-bottom: 50px">

            <label>NISN</label>
            <input type="number" name="nisn" class="form form-control input-upper" required /><br>

            <label>Nama</label>
            <input type="text" onkeyup="this.value=this.value.toUpperCase()" name="nama" class="form form-control input-upper" required /><br>

            <label>Jenis Kelamin</label>
            <select class="form form-control" name="kelamin">
              <option value="LAKI LAKI">LAKI LAKI</option>
              <option value="PEREMPUAN">PEREMPUAN</option>
            </select><br>

            <label>Tempat Lahir</label>
            <input type="text" onkeyup="this.value=this.value.toUpperCase()" name="tmp_lhr" class="form form-control input-upper" required /><br>

            <label>Tanggal Lahir</label>
            <input type="date" onkeyup="this.value=this.value.toUpperCase()" name="tgl_lhr" class="form form-control input-upper" required /><br>

            <label>Nama Ayah</label>
            <input type="text" onkeyup="this.value=this.value.toUpperCase()" name="nm_ayah" class="form form-control input-upper" required /><br>

            <label>Nama Ibu</label>
            <input type="text" onkeyup="this.value=this.value.toUpperCase()" name="nm_ibu" class="form form-control input-upper" required /><br>

            <label>Telepon Orang Tua</label>
            <input type="text" onkeyup="this.value=this.value.toUpperCase()" name="tlp_ortu" class="form form-control input-upper" required /><br>

            <label>Pekerjaan Ayah</label>
            <input type="text" onkeyup="this.value=this.value.toUpperCase()" name="pk_ayah" class="form form-control input-upper" required /><br>

            <label>Pekerjaan Ibu</label>
            <input type="text" onkeyup="this.value=this.value.toUpperCase()" name="pk_ibu" class="form form-control input-upper" required /><br>

            <label>Agama</label>
            <select class="form form-control" name="agama">
              <option value="ISLAM">ISLAM</option>
              <option value="PROTESTAN">KRISTEN PROTESTAN</option>
              <option value="KATOLIK">KATOLIK</option>
              <option value="KONGHUCU">KONGHUCU</option>
              <option value="HINDU">HINDU</option>
              <option value="BUDHA">BUDHA</option>
            </select><br>

            <label>Alamat</label>
            <textarea class="form-control input-upper" onkeyup="this.value=this.value.toUpperCase()" name="alamat" required></textarea><br>

            <label>Kelas</label>
            <select class="form form-control" name="kelas">
              <?php foreach ($kelas as $key) { ?>
                <option value="<?php echo $key->id_kelas ?>"><?php echo $key->nama_kelas . $key->sub_kelas ?></option>
              <?php } ?>
            </select><br>

            <label>Foto Siswa</label>
            <div class="col-lg-8">
              <div class="custom-file mb-4">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="image">Choose file</label>
              </div>
            </div>

            <input type="submit" name="" value="SELESAI" class="btn btn-primary">
          </div>

          </form>
        </div>
      </div>
    </div>

  </div>
</div>