  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Password
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?php echo base_url('admin/ubah_password');?>"> Ubah Password</a></li>
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
		        if (validation_errors() || $this->session->flashdata('result_password')) {
		            ?>
		            <div class="alert alert-error">
		                <button type="button" class="close" data-dismiss="alert">&times;</button>
		                <strong>Warning!</strong>
		                <?php echo validation_errors(); ?>
		                <?php echo $this->session->flashdata('result_password'); ?>
		            </div>    
		        <?php } ?>
              </div>
            </div>
            <!-- /.box-header -->
            <form role="form" method="POST" action="<?php echo base_url('admin/save_password_baru')?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Password Lama</label>
                  <input name="password_lama" type="password" class="form-control" id="exampleInputEmail1" placeholder="Password Lama">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password Baru</label>
                  <input name="password_baru" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password Baru" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Konfirmasi Password Baru</label>
                  <input name="konfirmasi_password_baru" type="password" class="form-control" id="exampleInputPassword1" placeholder="Konfirmasi Password Baru">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
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
  </div>