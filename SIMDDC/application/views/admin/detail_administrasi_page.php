  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrasi
        <small>Informasi Administrasi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="#"> Administrasi</a></li>
        <li class="active"> Daftar Administrasi</li>
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

              <h3 class="box-title">Detail Administrasi</h3><br><br>
              <div class="row">
                <div class="col-sm-2">Nama Proyek</div>
                <div class="col-sm-3">: <?php echo $detail_proyek->nama;?></div>
              </div>
              <div class="row">
                <div class="col-sm-2">Harga</div>
                <div class="col-sm-3">: Rp <?php echo number_format($detail_proyek->harga, 2, ',', '.');?></div>
              </div>
              <div class="row">
                <div class="col-sm-2">Status</div>
                <div class="col-sm-3">: 
                  <?php 
                    if($detail_proyek->status==3){
                      echo "<span class='label label-default'>Akan Datang</span>";
                    }else if($detail_proyek->status==2){
                      echo "<span class='label label-primary'>Sedang Dikerjakan</span>";
                    }else if($detail_proyek->status==1){
                      echo "<span class='label label-success'>Selesai</span>";
                    }

                  ?>
                    
                  </div>
              </div>
              <br>
<?php if ($total_kekurangan <= 0) { //-- Sudah lunas -- ?>
    <button type="button" class="btn btn-primary" disabled>Tambah Pembayaran</button>   
<?php } else { ?>
    <button type="button" class="btn btn-primary" data-title='Form Pembayaran' data-toggle='modal' data-target='#form_input'>Tambah Pembayaran</button>
<?php } //------- ?>
            </div>

            <div class="box-body">
              <table id="example_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Harga Pembayaran</th>
                  <th>Keterangan</th>
                  <th width="160">Aksi</th>
                </tr>
                </thead>
                <tbody>
	                <?php 

                    if (isset($daftar_administrasi)){
                      $i = 1;
                      foreach ($daftar_administrasi as $_daftar_administrasi) {
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                      echo "<td>".$_daftar_administrasi->tanggal."</td>
                            <td>Rp ".number_format($_daftar_administrasi->harga_termin, 2, ',', '.')."</td>
                            <td>".$_daftar_administrasi->keterangan_termin."</td>
                          <td>
                          <form class='form-horizontal' method='POST' target='_blank' action='".base_url('admin/cetak_kwitansi')."'>
                              <button type='button' class='btn btn-primary' 
                                data-title='Form Edit Pembayaran' 
                                data-toggle='modal'
                                data-id_administrasi='".$_daftar_administrasi->id_administrasi."'
                                data-tanggal='".$_daftar_administrasi->tanggal."'
                                data-harga_termin='".$_daftar_administrasi->harga_termin."'
                                data-keterangan_termin='".$_daftar_administrasi->keterangan_termin."'
                                data-terbilang='".$_daftar_administrasi->terbilang."'
                                data-target='#form_edit'>Edit</button>
                                
                                  <input type='hidden' value='".$_daftar_administrasi->id_administrasi."' name='id_administrasi'>
                                  <input type='hidden' value='".$detail_proyek->id_proyek."' name='id_proyek'>
                                  <input type='hidden' value='".$detail_proyek->id_klien."' name='id_klien'>
                                  <input type='submit' name='submit' class='btn btn-primary' value='Cetak Kwitansi'/>
                            </form>
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
                  <th>Tanggal</th>
                  <th>Harga Pembayaran</th>
                  <th>Keterangan</th>
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
                  <form class="form-horizontal" method="POST" action="<?php echo base_url('admin/save_pembayaran')?>">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                          
                          <div class="form-group">
                            <label for="stopword" class="col-sm-3 control-label">Tanggal</label>
                              <div class="col-sm-6">
                                <input required type="date" name="tanggal" class="form-control" placeholder="01-01-2018"/>
                              </div>
                          </div>

                          <div class="form-group">  
                            <label for="stopword" class="col-sm-3 control-label">Pembayaran</label>
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                  <input required type="text" name="harga_termin" class="form-control" placeholder="1.000.000" data-a-dec="," data-a-sep="."/>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="stopword" class="col-sm-3 control-label">Keterangan Pembayaran</label>
                              <div class="col-sm-6">
                                <textarea class="form-control" rows="4" cols="50" placeholder="Pembayaran untuk termin I"style="min-width:270px;max-width:270px;min-height:50px;max-height:100px;" name="keterangan_termin"></textarea>
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="stopword" class="col-sm-3 control-label">Terbilang</label>
                              <div class="col-sm-6">
                                <div class="input-group">
                                <input required type="text" name="terbilang" class="form-control" placeholder="Satu juta rupiah"/>
                                </div>  
                              </div>
                          </div>
                          
                      </div>
                      <div class="modal-footer">
                          <input type="hidden" name="id_proyek" value="<?php echo $detail_proyek->id_proyek; ?>">
                          <input type="hidden" name="id_klien" value="<?php echo $detail_proyek->id_klien; ?>">
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
                  <form name="edit_form" class="form-horizontal" method="POST" action="<?php echo base_url('admin/update_pembayaran')?>">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="stopword" class="col-sm-3 control-label">Tanggal</label>
                              <div class="col-sm-6">
                                <input required type="date" name="tanggal" class="form-control" placeholder="01-01-2018"/>
                              </div>
                          </div>

                          <div class="form-group">  
                            <label for="stopword" class="col-sm-3 control-label">Pembayaran</label>
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                  <input required type="text" name="harga_termin" class="form-control" placeholder="1.000.000" data-a-dec="," data-a-sep="."/>
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="stopword" class="col-sm-3 control-label">Keterangan Pembayaran</label>
                              <div class="col-sm-6">
                                <textarea class="form-control" rows="4" cols="50" placeholder="Pembayaran untuk termin I"style="min-width:270px;max-width:270px;min-height:50px;max-height:100px;" name="keterangan_termin"></textarea>
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="stopword" class="col-sm-3 control-label">Terbilang</label>
                              <div class="col-sm-6">
                                <div class="input-group">
                                <input required type="text" name="terbilang" class="form-control" placeholder="Satu juta rupiah"/>
                                </div>  
                              </div>
                          </div>
                          
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="id_administrasi">
                          <input type="hidden" name="id_proyek" value="<?php echo $detail_proyek->id_proyek; ?>">
                          <input type="hidden" name="id_klien" value="<?php echo $detail_proyek->id_klien; ?>">
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
  <script src="<?php echo base_url('/assets/plugins/autonumeric.min.js'); ?>"></script>
  <script>
    var valKekurangan = <?php echo intval($total_kekurangan); ?>;
    $(document).ready(function(){
        var opt = AutoNumeric.getPredefinedOptions().commaDecimalCharDotSeparator;
        opt.decimalPlaces = 0;

          $("#form_input").on('show.bs.modal', function(event){
          var button = $(event.relatedTarget);  // Button that triggered the modal
          var titleData = button.data('title');
          $(this).find('.modal-title').text(titleData);

          var anElement1 = new AutoNumeric('#form_input input[name=harga_termin]', opt);

          var formElmt = $(this).find('form');
          $(formElmt).unbind().submit(function(e){
            var valHarga = $('input[name=harga_termin]').val();
            valHarga = valHarga.replace(/\./, '');

            if (valHarga > valKekurangan) {
              alert('Jumlah pembayaran melebihi harga proyek, mohon masukkan pembayaran lagi.');
              e.preventDefault();
            }
          });
        });

        $("#form_edit").on('show.bs.modal', function(event){
          var button = $(event.relatedTarget);  // Button that triggered the modal
          var titleData = button.data('title');
          $(this).find('.modal-title').text(titleData);
          var id_administrasi = button.data('id_administrasi');
          document.edit_form.id_administrasi.value = id_administrasi;
         
          var tanggal = button.data('tanggal');
          document.edit_form.tanggal.value = tanggal;
          var harga_termin = button.data('harga_termin');
          document.edit_form.harga_termin.value = harga_termin;
          var keterangan_termin = button.data('keterangan_termin');
          document.edit_form.keterangan_termin.value = keterangan_termin;
          var terbilang = button.data('terbilang');
          document.edit_form.terbilang.value = terbilang;

          var nilaiAwal = $('input[name=harga_termin]').val();
          nilaiAwal = nilaiAwal.replace(/\./, '');

          var anElement2 = new AutoNumeric('#form_edit input[name=harga_termin]', opt);
          var formElmt = $(this).find('form');
          $(formElmt).unbind().submit(function(e){
            var valHarga = $('input[name=harga_termin]').val();
            valHarga = valHarga.replace(/\./, '');

            if (valHarga > (valKekurangan + nilaiAwal)) {
              alert('Jumlah pembayaran melebihi harga proyek, mohon masukkan pembayaran lagi.');
              e.preventDefault();
            }
          });
        });

        $("#hapus_produk").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);  // Button that triggered the modal
            var titleData = button.data('title');
            $(this).find('.modal-title').text(titleData);
            var id_stopword = button.data('id_stopword');
            document.alert_hapus.id_stopword.value = id_stopword;
        });

        //Initialize Select2 Elements
        $('.select2').select2();

        
        
    })
  </script>

</div>