<div id="content-wrapper" class="d-flex flex-column">

 <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Guru Pengajar di Kelas : <?php echo $kelas->nama_kelas.$kelas->sub_kelas?></h1>
    <p class="mb-4">Daftar Guru Pengajar</p>
    
    <?php if($this->session->flashdata('success')!=""){?>
      <div id="notifikasi">
        <p>
          <div class="alert alert-primary"><b><?php echo $this->session->flashdata('success')?></b></div>
        </p>   
      </div>
    <?php } ?>

      <?php if($spinner !=null){?>
      <div class="row">
        <div class="col-md-4 col-lg-4">
          <form action="<?php echo site_url('administrator/admin/tambahGuruKelas/').$id?>" method="post">
            <div class="input-group mb-3">
              <select class="form-control" name="guru">
                <?php foreach ($spinner as $key) {?>
                <option value="<?php echo $key->id_guru?>"><?php echo $key->nama_guru.' - '.$key->nama_mapel?></option>
                <?php } ?>
              </select>
              <div class="input-group-append">
                <input type="submit" class="btn btn-primary btn-sm" value="Tambah" />
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php }?>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajar</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Guru</th>
                  <th>Mapel</th>
                  <th></th>
                </tr>
              </thead>
              
              <tbody>
              <?php $no=1; foreach ($data as $key){?>
                <tr>
                  <td><?php echo $no?></td>
                  <td><?php echo $key->nama_guru?></td>
                  <td><?php echo $key->nama_mapel?></td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#deleteModal<?php echo $key->id_guru?>" class="btn btn-danger btn-icon-split btn-sm">
                      <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                      </span>
                      <span class="text">Hapus</span>
                    </a>
                  </td>
                </tr>
              <?php $no++; }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>



<!-- Modal Delete -->
<?php foreach ($data as $key){?>
  <div class="modal fade" id="deleteModal<?php echo $key->id_guru?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah Ingin Menghapus?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Yakin ingin menghapus <?php echo $key->nama_guru?> dari daftar kelas <?php echo $kelas->nama_kelas.$kelas->sub_kelas?>?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo site_url('teacher/').$key->id_detail_kelas.'/'.$id?>">Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>