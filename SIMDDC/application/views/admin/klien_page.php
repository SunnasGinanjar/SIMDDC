
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Klien
        <small>Informasi Klien</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin")?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?php echo base_url("admin/daftar_klien")?>"> Klien</a></li>
        <li class="active"> Daftar Klien</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content" >
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

              <h3 class="box-title">Daftar Klien</h3><br><br>
              <button type="button" class="btn btn-primary" data-title='Form Tambah Klien' data-toggle='modal' data-target='#form_input'>Tambah Klien</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Kontak</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                	<?php 

                		if (isset($daftar_klien)){
                			$i = 1;
                			foreach ($daftar_klien as $_daftar_klien) {
                				echo "<tr>";
                				echo "<td>".$i."</td>";
	            				echo "<td>".$_daftar_klien->nama."</td>
									  <td>".$_daftar_klien->alamat."</td>
									  <td>".$_daftar_klien->kontak."</td>
									  <td>".$_daftar_klien->email."</td>
				                      <td>
				                  	    <button type='button' class='btn btn-primary' 
					                  		data-title='Form Edit Klien' 
					                  		data-toggle='modal'
					                  		data-id_klien='".$_daftar_klien->id_klien."'
	                                        data-nama='".$_daftar_klien->nama."'
	                                        data-alamat='".$_daftar_klien->alamat."'
	                                        data-kontak='".$_daftar_klien->kontak."'
					                  		data-email='".$_daftar_klien->email."'
					                  		data-target='#form_edit'>Edit Klien</button>
				                      </td>";
                				echo "</tr>";
                				$i++;
                			}
                		}
                	?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Kontak</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


    <div class="modals">
	    <!-- form tambah-->
	    <div id="form_input" class="modal fade" >
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <form class="form-horizontal" method="POST" action="<?php echo base_url('admin/save_klien')?>">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                        <h4 class="modal-title"></h4>
	                    </div>
	                    <div class="modal-body">
	                        <div class="form-group">
	                        	<label for="stopword" class="col-sm-3 control-label">Nama</label>
	                            <div class="col-sm-6">
	                              <input required type="text" name="nama" class="form-control" placeholder="Nama"/>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label for="stopword" class="col-sm-3 control-label">Alamat</label>
	                            <div class="col-sm-6">
	                              <input required type="text" name="alamat" class="form-control" placeholder="Alamat"/>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label for="stopword" class="col-sm-3 control-label">Kontak</label>
	                            <div class="col-sm-6">
	                              <input required type="text" name="kontak" class="form-control" placeholder="Kontak" pattern="[0-9]{1,12}" title="Masukkan angka 0-9, 1-12 digit" />
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label for="stopword" class="col-sm-3 control-label">Email</label>
	                            <div class="col-sm-6">
	                              <input required type="email" name="email" class="form-control" placeholder="email@gmail.com"/>
	                            </div>
	                        </div>
	                        
	                    </div>
	                    <div class="modal-footer">
	                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan"/>
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <!-- form edit -->
	    <div id="form_edit" class="modal fade">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <form name="edit_form" class="form-horizontal" method="POST" action="<?php echo base_url('admin/update_klien')?>">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                        <h4 class="modal-title"></h4>
	                    </div>
	                    <div class="modal-body">
	                        <div class="form-group">
	                        	<label for="stopword" class="col-sm-3 control-label">Nama</label>
	                            <div class="col-sm-6">
	                              <input required type="text" name="nama" class="form-control" placeholder="Nama"/>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label for="stopword" class="col-sm-3 control-label">Alamat</label>
	                            <div class="col-sm-6">
	                              <input required type="text" name="alamat" class="form-control" placeholder="Alamat"/>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label for="stopword" class="col-sm-3 control-label">Kontak</label>
	                            <div class="col-sm-6">
	                              <input required type="text" name="kontak" class="form-control" placeholder="Kontak" pattern="[0-9]{1,12}" title="Masukkan angka 0-9, 1-12 digit"/>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label for="stopword" class="col-sm-3 control-label">Email</label>
	                            <div class="col-sm-6">
	                              <input required type="email" name="email" class="form-control" placeholder="email@gmail.com"/>
	                            </div>
	                        </div>
	                        
	                    </div>
	                    <div class="modal-footer">
	                        <input type="hidden" name="id_klien">
	                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan"/>
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <!-- form hapus-->
	    <div id="hapus_produk" class="modal fade">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title"></h4>
	                </div>
	                <div class="modal-body">
	                    <p>Anda yakin akan menghapus data klien ini ? </p>
	                </div>
	                <div class="modal-footer">
	                    <form name="alert_hapus" method="POST" action="<?php echo base_url('index.php/admin/setting/delete_stopword') ?>">
	                        <input type="hidden" name="id_klien"/>
	                        <input type="submit" name="submit" class="btn btn-primary" value="Hapus"/>
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	  </div>
	</div>

	<script>
		$(document).ready(function(){
	        $("#form_input").on('show.bs.modal', function(event){
		      var button = $(event.relatedTarget);  // Button that triggered the modal
		      var titleData = button.data('title');
		      $(this).find('.modal-title').text(titleData);
		    });

		    $("#form_edit").on('show.bs.modal', function(event){
		      var button = $(event.relatedTarget);  // Button that triggered the modal
		      var titleData = button.data('title');
		      $(this).find('.modal-title').text(titleData);
		      var id_klien = button.data('id_klien');
		      document.edit_form.id_klien.value = id_klien;
		      var nama = button.data('nama');
		      document.edit_form.nama.value = nama;
		      var alamat = button.data('alamat');
		      document.edit_form.alamat.value = alamat;
		      var kontak = button.data('kontak');
		      document.edit_form.kontak.value = kontak;
		      var email = button.data('email');
		      document.edit_form.email.value = email;
		    });

		    $("#hapus_produk").on('show.bs.modal', function (event) {
		        var button = $(event.relatedTarget);  // Button that triggered the modal
		        var titleData = button.data('title');
		        $(this).find('.modal-title').text(titleData);
		        var id_stopword = button.data('id_stopword');
		        document.alert_hapus.id_stopword.value = id_stopword;
		    });
		})
	</script>

