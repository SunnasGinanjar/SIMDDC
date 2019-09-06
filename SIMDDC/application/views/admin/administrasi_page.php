

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
              <h3 class="box-title">Daftar Administrasi</h3>
            </div>

            <div class="box-body">
              <table id="example_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Proyek</th>
                  <th>Klien</th>
                  <th>Harga</th>
                  <th>Jumlah Termin</th>
                  <th>Total Pembayaran</th>
                  <th>Kekurangan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
	                <?php 

                		if (isset($daftar_proyek)){
                			$i = 1;
                      $statusProyek = null;
                			foreach ($daftar_proyek as $_daftar_proyek) {
                				echo "<tr>";
                				echo "<td>".$i."</td>";

                        switch ($_daftar_proyek->status) {
                          case 1: {$statusProyek = 'Selesai'; break;}
                          case 2: {$statusProyek = 'Dikerjakan'; break;}
                          case 3: {$statusProyek = 'Akan datang'; break;}
                          default: {$statusProyek = '-';}
                        }

	            				echo "<td>".$_daftar_proyek->nama_proyek." (".$statusProyek.")</td><td>";
                        echo $_daftar_proyek->nama_klien;
	                  				
	                  				
	                  				echo "</td>
	                  				<td>Rp ".number_format($_daftar_proyek->harga, 2, ',', '.')."</td>";
	                  				echo "<td>";
	                  					
                  						echo $_daftar_proyek->jumlah_termin;
	                  				echo "</td>";
	                  				echo "<td>Rp ";
                  						echo number_format($_daftar_proyek->jumlah_bayar, 2, ',', '.');
	                  				echo "</td>";
	                  				echo "<td> Rp ";
                              $kekurangan = intval($_daftar_proyek->harga) - $_daftar_proyek->jumlah_bayar;
                  						echo number_format($kekurangan, 2, ',', '.');
	                  				echo "</td>";
				                echo "<td>
                          <a href='".base_url('admin/detail_administrasi/'.$_daftar_proyek->id_proyek)."' class='btn btn-primary'>Rincian</a></td>";
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
  </div>


