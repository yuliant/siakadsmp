<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Guru</h1>
    <p class="mb-4">Formulir Edit Guru</p>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Guru</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">

          <!-- <form action="<?php echo site_url('administrator/admin/prosesEditGuru/') . $get->id_guru ?>" method="POST"> -->
          <?php echo form_open_multipart('administrator/admin/prosesEditGuru/' . $get->id_guru); ?>
          <div style="padding-left: 20px; padding-right: 20px; margin-bottom: 50px">

            <label>NIP <i>(Boleh kosong)</i></label>
            <input type="text" name="nip" value="<?php echo $get->nip ?>" class="form form-control input-upper" /><br>

            <label>NIGN (Nomor Induk Guru Nasional)</label>
            <input type="text" name="nign" value="<?php echo $get->nign ?>" class="form form-control input-upper" required /><br>

            <label>Nama Guru</label>
            <input type="text" name="nama" value="<?php echo $get->nama_guru ?>" class="form form-control input-upper" required /><br>

            <label>Agama</label>
            <select class="form form-control" name="agama">
              <?php if ($get->agama == 'PROTESTAN') {
                echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN" selected>KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
              } else if ($get->agama == 'ISLAM') {
                echo '<option value="ISLAM" selected>ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
              } elseif ($get->agama == 'KATOLIK') {
                echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK" selected>KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
              } elseif ($get->agama == 'KONGHUCU') {
                echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU" selected>KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
              } elseif ($siswa->agama == 'HINDU') {
                echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU" selected>HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
              } else {
                echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA" selected>BUDHA</option>';
              } ?>
            </select><br>

            <label>Jenis Kelamin</label>
            <select class="form form-control" name="kelamin">
              <?php if ($get->j_kelamin == 'LAKI LAKI') { ?>
                <option value="LAKI LAKI" selected>LAKI LAKI</option>
                <option value="PEREMPUAN">PEREMPUAN</option>
              <?php } else { ?>
                <option value="LAKI LAKI">LAKI LAKI</option>
                <option value="PEREMPUAN" selected>PEREMPUAN</option>
              <?php } ?>
            </select><br>

            <label>Tempat Lahir</label>
            <input type="text" name="tmp_lhr" value="<?php echo $get->tempat_lahir ?>" class="form form-control input-upper" required /><br>

            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lhr" value="<?php echo $get->tgl_lahir ?>" class="form form-control input-upper" required /><br>

            <label>Pendidikan</label>
            <input type="text" name="pendidikan" value="<?php echo $get->pendidikan ?>" class="form form-control input-upper" required /><br>

            <label>Alamat</label>
            <textarea class="form-control input-upper" name="alamat" required> <?php echo $get->alamat_guru ?></textarea><br>

            <label>Mata Pelajaran</label>
            <select class="form form-control" name="mapel">
              <?php foreach ($mapel as $key) {
                if ($key->id_mapel == $get->id_mapel) { ?>
                  <option selected value="<?php echo $key->id_mapel ?>"><?php echo $key->nama_mapel ?></option>
                <?php } else { ?>
                  <option value="<?php echo $key->id_mapel ?>"><?php echo $key->nama_mapel ?></option>

              <?php }
              } ?>
            </select><br>

            <label>Foto Guru</label>
            <div class="col-sm-10 mb-4">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?php echo base_url('assets/img/profile/') . $get->image; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                  </div>
                </div>
              </div>
            </div>

            <input type="submit" name="" value="Selesai" class="btn btn-primary">

          </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>