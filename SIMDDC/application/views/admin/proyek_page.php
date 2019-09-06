

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Proyek
        <small>Informasi Proyek</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin"); ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?php echo base_url("admin/daftar_proyek"); ?>"> Proyek</a></li>
        <li class="active">Daftar Proyek</li>
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


              <h3 class="box-title">Daftar Proyek</h3><br><br>
              <button type="button" class="btn btn-primary" data-title='Form Tambah Proyek' data-toggle='modal' data-target='#form_input'>Tambah Proyek</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Proyek</th>
                  <th>Klien</th>
                  <th style="width: 100px">Harga</th>
                  <th style="width: 50px">Mulai</th>
                  <th style="width: 50px">Selesai</th>
                  <th>Status</th>
                  <th style="width: 150px">Aksi</th>
                </tr>
                </thead>
                <tbody>
	                <?php 

                		if (isset($daftar_proyek)){
                			$i = 1;
                			foreach ($daftar_proyek as $_daftar_proyek) {
                				echo "<tr>";
                				echo "<td>".$i."</td>";
	            				echo "
	                  				<td>".$_daftar_proyek->nama."</td>
	                  				<td>";

	                  				if (isset($daftar_klien)){
										foreach ($daftar_klien as $_daftar_klien) {
											if ($_daftar_klien->id_klien==$_daftar_proyek->id_klien) {
												echo $_daftar_klien->nama;
											}
										}

	                  				} 
	                  				
	                  				echo "</td>
	                  				<td>Rp ".number_format($_daftar_proyek->harga, 2, ',', '.')."</td>
	                  				<td>".$_daftar_proyek->mulai."</td>
	                  				<td>".$_daftar_proyek->selesai."</td>
	                  				<td>";
	                  					if($_daftar_proyek->status==3){
	                  						echo "<span class='label label-default'>Akan Datang</span>";
	                  					}else if($_daftar_proyek->status==2){
	                  						echo "<span class='label label-primary'>Sedang Dikerjakan</span>";
	                  					}else if($_daftar_proyek->status==1){
	                  						echo "<span class='label label-success'>Selesai</span>";
	                  					}

	                  				echo "</td>
				                    <td>
				                  	 	<button type='button' class='btn btn-info'
				                  	 		data-title='Form Edit Proyek'
				                  	 		data-toggle='modal'
					                  		data-id_proyek='".$_daftar_proyek->id_proyek."'
					                  		data-nama='".$_daftar_proyek->nama."'
	                                        data-id_klien='".$_daftar_proyek->id_klien."'
	                                        data-deskripsi='".$_daftar_proyek->deskripsi."'
	                                        data-harga='".$_daftar_proyek->harga."'
	                                        data-mulai='".$_daftar_proyek->mulai."'
	                                        data-selesai='".$_daftar_proyek->selesai."'
	                                        data-status='".$_daftar_proyek->status."'
					                  		data-target='#form_edit'>Edit Proyek</button>";
					                 if ($_daftar_proyek->status==1) {
					                 	echo "
				                  	 	<button type='button' class='btn btn-danger' disabled>Hapus</button>";
					                 } else {
					                 	echo "
				                  	 	<button type='button' class='btn btn-danger' data-title='Hapus' data-toggle='modal' 
				                  	 		data-id_proyek='".$_daftar_proyek->id_proyek."'
				                  	 		data-target='#form_delete'>Hapus</button>";
					                 }
					                 
				                    echo "</td>";
                				echo "</tr>";
                				$i++;
                			}
                		}
	                		

                	?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Proyek</th>
                  <th>Klien</th>
                  <th>Harga</th>
                  <th>Mulai</th>
                  <th>Selesai</th>
                  <th>Status</th>
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
	                <form class="form-horizontal" method="POST" action="<?php echo base_url('admin/save_proyek')?>">
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
	                        	<label for="stopword" class="col-sm-3 control-label">Klien</label>
	                            <div class="col-sm-6">
	                              <select name="id_klien" class="form-control select2" style="width: 100%;">
	                              	<option value="0">-Pilih Klien-</option>
	                              	<?php
	                              		if (isset($daftar_klien)){
	                              			foreach ($daftar_klien as $_daftar_klien) {
	                              				echo "<option value='".$_daftar_klien->id_klien."'>".$_daftar_klien->nama."</option>";
	                              			}
	                              		}
	                              	?>
	                              </select>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Deskripsi</label>
	                            <div class="col-sm-6">
	                            	<textarea class="form-control" rows="4" cols="50" placeholder="Deskripsi Proyek"style="min-width:270px;max-width:270px;min-height:50px;max-height:100px;" name="deskripsi"></textarea>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Harga</label>
	                            <div class="col-sm-6">
	                            	<div class="input-group">
						                <span class="input-group-addon">Rp</span>
						                <input required type="text" name="harga" class="form-control" placeholder="1.000.000" data-a-dec="," data-a-sep="."/>
					              	</div>
	                              
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Mulai</label>
	                            <div class="col-sm-6">
	                              <input min="<?php echo date("Y-m-d");?>" required type="date" name="mulai" class="datepicker form-control" placeholder="01-01-2018"/>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Selesai</label>
	                            <div class="col-sm-6">
	                              <input min="<?php echo date("Y-m-d");?>" required type="date" name="selesai" class="form-control" placeholder="12-12-2018"/>
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
	    <div id="form_edit" class="modal fade" >
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <form name="edit_form" class="form-horizontal" method="POST" action="<?php echo base_url('admin/update_proyek')?>">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                        <h4 class="modal-title"></h4>
	                    </div>
	                    <div class="modal-body">
	                        
	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Nama</label>
	                            <div class="col-sm-6">
	                              <input required type="text" name="nama" class="form-control" placeholder="Nama"/>
	                            </div>
	                        </div>

							<div class="form-group">	
	                        	<label class="col-sm-3 control-label">Klien</label>
	                            <div class="col-sm-6">
	                              <select id="id_klien" name="id_klien" class="form-control select2" style="width: 100%;">
	                              	<option value="0">-Pilih Klien-</option>
	                              	<?php
	                              		if (isset($daftar_klien)){
	                              			foreach ($daftar_klien as $_daftar_klien) {
	                              				echo "<option value='".$_daftar_klien->id_klien."'>".$_daftar_klien->nama."</option>";
	                              			}
	                              		}
	                              	?>
	                              </select>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Deskripsi</label>
	                            <div class="col-sm-6">
	                            	<textarea class="form-control" rows="4" cols="50" placeholder="Deskripsi Proyek"style="min-width:270px;max-width:270px;min-height:50px;max-height:100px;" name="deskripsi"></textarea>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Harga</label>
	                            <div class="col-sm-6">
	                            	<div class="input-group">
						                <span class="input-group-addon">Rp</span>
						                <input required type="text" name="harga" class="form-control" placeholder="1.000.000" data-a-dec="," data-a-sep="."/>
					              	</div>
	                              
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Mulai</label>
	                            <div class="col-sm-6">
	                              <input required type="date" name="mulai" class="form-control" placeholder="01-01-2018"/>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                        	<label class="col-sm-3 control-label">Selesai</label>
	                            <div class="col-sm-6">
	                              <input required type="date" name="selesai" class="form-control" placeholder="12-12-2018"/>
	                            </div>
	                        </div>

	                        <div class="form-group">	
	                        	<label class="col-sm-3 control-label">Status</label>
	                            <div class="col-sm-6">
	                              <select id="status" name="status" class="form-control select2" style="width: 100%;">
	                              	<option value="0">-Pilih Status-</option>
	                              	<option value="3"> Akan Datang </option>
	                              	<option value="2"> Sedang Dikerjakan </option>
	                              	<option value="1"> Selesai </option>
	                              </select>
	                            </div>
	                        </div>
	                       

	                    </div>
	                    <div class="modal-footer">
	                    	<input type="hidden" name="id_proyek">
	                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan"/>
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <!-- form hapus-->
	    <div id="form_delete" class="modal fade">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title"></h4>
	                </div>
	                <div class="modal-body">
	                    <p>Apakah anda yakin akan menghapus data ini? </p>
	                </div>
	                <div class="modal-footer">
	                    <form name="alert_hapus" method="POST" action="<?php echo base_url('admin/delete_proyek')?>">
	                        <input type="hidden" name="id_proyek">
	                        <input type="submit" name="submit" class="btn btn-primary" value="Hapus"/>
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	  </div>
	</div>

	<script src="<?php echo base_url('/assets/plugins/autonumeric.min.js'); ?>"></script>
	<script>
		$(document).ready(function(){
			var opt = AutoNumeric.getPredefinedOptions().commaDecimalCharDotSeparator;
        	opt.decimalPlaces = 0;

	        $("#form_input").on('show.bs.modal', function(event){
		      var button = $(event.relatedTarget);  // Button that triggered the modal
		      var titleData = button.data('title');
		      $(this).find('.modal-title').text(titleData);
		      var anElement1 = new AutoNumeric('#form_input input[name=harga]', opt);
		    });

		    

		    $("#form_edit").on('show.bs.modal', function(event){
		      var button = $(event.relatedTarget);  // Button that triggered the modal
		      var titleData = button.data('title');
		      $(this).find('.modal-title').text(titleData);
		      var id_proyek = button.data('id_proyek');
		      document.edit_form.id_proyek.value = id_proyek;
		      var id_klien = button.data('id_klien');
		      document.edit_form.id_klien.value = id_klien;
			  $('#id_klien').select2().select2('val', ''+id_klien+'');
			  var status = button.data('status');

			  if (status!=3) {
			  	$('#form_edit select[name=status] option[value=3]').attr('disabled', 'disabled');
			  } else {
			  	$('#form_edit select[name=status] option[value=3]').removeAttr('disabled');
			  }
		      document.edit_form.status.value = status;
			  $('#status').select2().select2('val', ''+status+'');

		      var nama = button.data('nama');
		      document.edit_form.nama.value = nama;
		      //var klien = button.data('klien');
		      //document.edit_form.klien.value = klien;
		      var deskripsi = button.data('deskripsi');
		      document.edit_form.deskripsi.value = deskripsi;
		      var harga = button.data('harga');
		      document.edit_form.harga.value = harga;
		      var mulai = button.data('mulai');
		      document.edit_form.mulai.value = mulai;
		      var selesai = button.data('selesai');
		      document.edit_form.selesai.value = selesai;

		      var anElement2 = new AutoNumeric('#form_edit input[name=harga]', opt);
		    });

		    $("#form_delete").on('show.bs.modal', function (event) {
		        var button = $(event.relatedTarget);  // Button that triggered the modal
		        var titleData = button.data('title');
		        $(this).find('.modal-title').text(titleData);
		        var id_proyek = button.data('id_proyek');
		        document.alert_hapus.id_proyek.value = id_proyek;
		    });

		    //Initialize Select2 Elements
    		$('.select2').select2();

    		// Date
    		

		})
	</script>
