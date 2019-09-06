  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profil
        <small>Informasi Perusahaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?php echo base_url('admin/pengaturan');?>"> Profil</a></li>
        <li class="active"> Informasi Perusahaan</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              

              <div id="info" class="pop-up">
                <?php
                if (isset($errors)) {
                    echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $errors . '</strong></div>';
                } else if (isset($infos)) {
                    echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $infos . '</strong></div>';
                }
                ?>
              </div>

              <h3 class="box-title">Data Perusahaan</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" method="POST" action="<?php echo base_url('admin/update_pengaturan')?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Perusahaan</label>
                  <input name="nama_perusahaan" type="text" class="form-control" id="exampleInputEmail1" placeholder="DRF Digital Creation" value="<?php echo $pengaturan->nama_perusahaan;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat</label>
                  <input name="alamat" type="text" class="form-control" id="exampleInputPassword1" placeholder="Jl. Abimanyu No. 12 Slerok" value="<?php echo $pengaturan->alamat;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat 2</label>
                  <input name="alamat2" type="text" class="form-control" id="exampleInputPassword1" placeholder="Tegal, Jawa Tengah" value="<?php echo $pengaturan->alamat2;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Kontak</label>
                  <input name="kontak" type="text" class="form-control" id="exampleInputPassword1" placeholder="085200969593" pattern="[0-9]{1,12}" title="Masukkan angka 0-9, 1-12 digit" value="<?php echo $pengaturan->kontak;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Website</label>
                  <input name="website" type="text" class="form-control" id="exampleInputPassword1" placeholder="www.digitalcreation.co.id" value="<?php echo $pengaturan->website;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">CEO</label>
                  <input name="ceo" type="text" class="form-control" id="exampleInputPassword1" placeholder="Dimas Abdulrobi, S.T." value="<?php echo $pengaturan->ceo;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Tempat ttd</label>
                  <input name="tempat_ttd" type="text" class="form-control" id="exampleInputPassword1" placeholder="Semarang" value="<?php echo $pengaturan->tempat_ttd;?>">
                </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="id_pengaturan" value="<?php echo $pengaturan->id_pengaturan;?>">
                <input name="submit" type="submit" class="btn btn-primary" value="Perbaharui">
              </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
