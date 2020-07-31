<div id="content-wrapper" class="d-flex flex-column">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="h3 mb-2 text-gray-800">WaliKelas || Nilai ke : <?php echo $nilai_ke ?></h1>
                <p class="mb-4">Masukkan Nilai pada Siswa : <?php echo $nama ?>.</p>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="margin-top: 30px">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Masukkan Nilai</h6>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <form action="<?php echo site_url('guru/guru/postNilaiWalas/') . $form . '/' . $id_nilai ?>" method="post">
                            <div class="input-group mb-3">
                                <input type="number" name="nilai" class="form-control">
                                <div class="input-group-append">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Selesai" />
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>