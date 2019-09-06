<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<style>
th, td {
    padding: 10px;
}
</style>
<div class="isi">
    <table width="100%" style="background-color: white">
        <tr>
            <th style="background-color: white;font-size: 12px">
                <b><?php echo $pengaturan->nama_perusahaan;?></b>
            <p style="background-color: white;font-size: 10px">
                <?php echo $pengaturan->alamat;?><br>
                <?php echo $pengaturan->alamat2;?><br>
                <?php echo $pengaturan->kontak;?>
            </th>
            <th align="right">
            	<img style="height: 60px" src="<?php echo base_url('assets/DDC.jpg'); ?>">
            </th>
        </tr>
        <tr>
            <th colspan="2" style="background-color: white;font-size: 24px">
                <center style="font-weight: bold"><u>Kwitansi Pembayaran</u></center>
                <center style="background-color: white;font-size:12px">
                <?php echo "No. P".$detail_administrasi->id_proyek."T".$detail_administrasi->id_administrasi.date('/m/Y',strtotime($detail_administrasi->tanggal)); ?>
                </center>
            </th>
        </tr>

    </table><br>
    <table class="table table-bordered" style="background-color: white;font-size: 12px">
        <tr>
            <th width="150">Sudah Terima Dari</th>
            <th><?php echo $detail_klien->nama; ?></th>
        </tr>
        <tr>
            <th width="150">Banyaknya Uang</th>
            <th><?php echo $detail_administrasi->terbilang; ?></th>
        </tr>
        <tr>
            <th width="150">Untuk Pembayaran</th>
            <th><?php echo $detail_administrasi->keterangan_termin; ?></th>
        </tr>
        
    </table>
    <table width="100%" style="background-color: white;font-size: 12px">
        <tr>
	        <td valign="top" style="background-color: white;font-size: 24px; font-weight: bold">Rp <?php echo number_format($detail_administrasi->harga_termin, 2, ',', '.'); ?></td>
	        
	        
            <td width="31%">
                <?php echo $pengaturan->tempat_ttd; ?>, 
                    <?php              
                        echo date('d')." ".convert_month(date('m'))." ".date('Y');
                    ?><br><br><br><br><br><br>
                <u><?php echo $pengaturan->ceo; ?></u><br>
                <?php echo "CEO ".$pengaturan->nama_perusahaan;?>
            </td>
	        
    	</tr>
    </table>
</div>

<?php
    function convert_month($kode){
        if($kode==1){
            return 'Januari';
        }else if($kode==2){
            return 'Februari';
        }else if($kode==3){
            return 'Maret';
        }else if($kode==4){
            return 'April';
        }else if($kode==5){
            return 'Mei';
        }else if($kode==6){
            return 'Juni';
        }else if($kode==7){
            return 'Juli';
        }else if($kode==8){
            return 'Agustus';
        }else if($kode==9){
            return 'September';
        }else if($kode==10){
            return 'Oktober';
        }else if($kode==11){
            return 'November';
        }else if($kode==12){
            return 'Desember';
        }
    } ?>
