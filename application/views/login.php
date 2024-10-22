<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login | SMPN 2 Krembung</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">



</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <img style="width: 100%; height: 100%" src="<?php echo base_url() ?>/assets/img/login_back.jpg">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900">Selamat Datang di Siakad</h1>
                    <h1 class="h5 text-gray-900 mb-4">SMPN 2 Krembung</h1>
                  </div>
                  <form class="user" action="<?php echo site_url('welcome/login') ?>" method="post">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan Password">
                    </div>

                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login" />
                    <hr>

                    <a href="#" data-toggle="modal" data-target="#login">
                      <span class="text">Mau login?</span>
                    </a>

                    <?php if ($this->session->flashdata('failed') != "") { ?>
                      <div id="notifikasi">
                        <p>
                          <div class="alert alert-danger"><?php echo $this->session->flashdata('failed') ?></div>
                        </p>
                      </div>
                    <?php } ?>
                  </form>


                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Modal login -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginLabel">Mau login?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- form tambah data menu -->
        <div class="container">
          Admin : 23457 <br>
          Guru : 12030 <br>
          Siswa : 2019098908
        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>/assets/js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
    $('#notifikasi').slideDown('slow').delay(3000).slideUp('slow');
  </script>

</body>

</html>