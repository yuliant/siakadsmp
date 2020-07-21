<div id="content-wrapper" class="d-flex flex-column">

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Selamat Datang, <?php echo $this->session->userdata('nama');?>!</h1>
    <p class="mb-4">Ayo, segera periksa Murid Anda</p>

    <?php if($this->session->flashdata('success_add')!=""){?>
    <div id="notifikasi">
      <p>
        <div class="alert alert-primary"><?php echo $this->session->flashdata('success_add')?></div>
      </p>   
    </div>
    <?php } ?>

  
  </div>
</div>

