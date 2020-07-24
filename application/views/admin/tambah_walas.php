<div id="content-wrapper" class="d-flex flex-column">

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Input Wali Kelas</h1>
        <p class="mb-4">Input wali kelas untuk kelas <?php echo $kelas->nama_kelas . $kelas->sub_kelas ?></p>

        <div class="col-12 col-sm-8 col-lg-8">
            <?php echo $this->session->flashdata('message'); ?>
        </div>

        <div class="row">
            <div class="col-md-4 col-lg-4">
                <form action="<?php echo site_url('admin/inputwalas/') . $kelas->id_kelas ?>" method="post">
                    <div class="input-group mb-3">
                        <select class="form-control" name="walas">
                            <option value="">
                                -
                            </option>
                            <?php foreach ($guru_list as $key) { ?>
                                <option value="<?php echo $key->id_guru ?>">
                                    <?php echo $key->nama_guru ?>
                                </option>
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

    </div>
</div>