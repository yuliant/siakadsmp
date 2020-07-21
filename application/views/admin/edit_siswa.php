<div id="content-wrapper" class="d-flex flex-column">

   <div class="container-fluid">

          <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Siswa</h1>
      <p class="mb-4">Formulir Ubah Data Siswa</p>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Ubah Data Siswa</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <form action="<?php echo site_url('administrator/admin/editSiswaProses/').$siswa->id_siswa.'/'.$nama_kelas?>" method="POST">
              <div style="padding-left: 20px; padding-right: 20px; margin-bottom: 50px">
                <label>NISN</label>
                <input type="number" value="<?php echo $siswa->nisn?>" name="nisn" class="form form-control input-upper" required/><br>
                <label>Nama</label>
                <input type="text" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo $siswa->nama_siswa?>" name="nama" class="form form-control input-upper" required/><br>
                <label>Jenis Kelamin</label>
                <select class="form form-control" name="kelamin">
                <?php if ($siswa->j_kelamin == 'LAKI LAKI'){?>
                  <option value="LAKI LAKI" selected>LAKI LAKI</option>
                  <option value="PEREMPUAN">PEREMPUAN</option>
                <?php } else {?>
                  <option value="LAKI LAKI">LAKI LAKI</option>
                  <option value="PEREMPUAN" selected>PEREMPUAN</option>
                <?php } ?>
                </select><br>
                <label>Tempat Lahir</label>
                <input type="text" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo $siswa->tmp_lahir?>" name="tmp_lhr" class="form form-control input-upper" required/><br>
                <label>Tanggal Lahir</label>
                <input type="date" value="<?php echo $siswa->tgl_lahir?>" name="tgl_lhr" class="form form-control input-upper" required/><br>
                <label>Nama Ayah</label>
                <input type="text" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo $siswa->nama_ayah?>" name="nm_ayah" class="form form-control input-upper" required/><br>
                <label>Nama Ibu</label>
                <input type="text" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo $siswa->nama_ibu?>" name="nm_ibu" class="form form-control input-upper" required/><br>
                <label>Telepon Orang Tua</label>
                <input type="text" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo $siswa->telp_ortu?>" name="tlp_ortu" class="form form-control input-upper" required/><br>
                <label>Pekerjaan Ayah</label>
                <input type="text" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo $siswa->pekerjaan_ayah?>" name="pk_ayah" class="form form-control input-upper" required/><br>
                <label>Pekerjaan Ibu</label>
                <input type="text" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo $siswa->pekerjaan_ibu?>" name="pk_ibu" class="form form-control input-upper" required/><br>
                <label>Agama</label>
                <select class="form form-control" name="agama">
                <?php if($siswa->agama=='PROTESTAN'){
                  echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN" selected>KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
                }else if ($siswa->agama == 'ISLAM'){
                  echo '<option value="ISLAM" selected>ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
                }elseif ($siswa->agama == 'KATOLIK') {
                  echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK" selected>KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
                }elseif ($siswa->agama == 'KONGHUCU') {
                  echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU" selected>KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
                }elseif ($siswa->agama == 'HINDU') {
                  echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU" selected>HINDU</option>
                  <option value="BUDHA">BUDHA</option>';
                }else{
                  echo '<option value="ISLAM">ISLAM</option>
                  <option value="PROTESTAN">KRISTEN PROTESTAN</option>
                  <option value="KATOLIK">KATOLIK</option>
                  <option value="KONGHUCU">KONGHUCU</option>
                  <option value="HINDU">HINDU</option>
                  <option value="BUDHA" selected>BUDHA</option>';
                }?>
                  
                </select><br>
                <label>Alamat</label>
                <textarea onkeyup="this.value=this.value.toUpperCase()" class="form-control input-upper" name="alamat" required><?php echo $siswa->alamat_siswa?></textarea><br>
                <label>Kelas</label>
                <select class="form form-control" name="kelas">
                <?php foreach ($kelas as $key) {
                  if($key->id_kelas == $siswa->id_kelas){?>
                    <option value="<?php echo $key->id_kelas?>" selected><?php echo $key->nama_kelas.$key->sub_kelas?></option>
                  <?php } 
                  else {?>
                    <option value="<?php echo $key->id_kelas?>"><?php echo $key->nama_kelas.$key->sub_kelas?></option>
                <?php } }?>
                </select><br>
                <input type="submit" name="" value="SELESAI" class="btn btn-primary">
              </div>
              
            </form>
          </div>
        </div>
      </div>
  </div>
</div>