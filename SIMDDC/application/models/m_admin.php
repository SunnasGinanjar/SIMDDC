<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model{

    function __construct(){
	    parent::__construct();
	    $this->tbl_administrasi	= "administrasi";
	    $this->tbl_klien		= "klien";
	    $this->tbl_pengaturan	= "pengaturan";
	    $this->tbl_proyek		= "proyek";
	    $this->tbl_user			= "user";
    }

    function get_pengaturan(){
        $query = $this->db->query("SELECT * FROM $this->tbl_pengaturan");
        return $query->row();
    }

    function update_pengaturan($id_pengaturan,$nama_perusahaan,$alamat,$alamat2,$kontak,$website,$ceo,$tempat_ttd){
            $_query_data = array(
            'nama_perusahaan'	=> $nama_perusahaan,
            'alamat' 			=> $alamat,
            'alamat2' 			=> $alamat2,
            'kontak'   			=> $kontak,
            'website'   		=> $website,
            'tempat_ttd'   		=> $tempat_ttd,
            );
        $this->db->where('id_pengaturan', $id_pengaturan);
        $this->db->update($this->tbl_pengaturan, $_query_data);
            if ($this->db->affected_rows() == 0) return false;
            return true;
    }

 	function get_klien(){
        $query = $this->db->query("SELECT * FROM $this->tbl_klien ORDER BY nama ASC");
        return $query->result();
    }

    function get_detail_klien($id_klien){
        $query = $this->db->query("SELECT * FROM $this->tbl_klien WHERE id_klien='$id_klien'");
        return $query->row();
    }

     function save_klien($nama,$alamat,$kontak,$email){
        $query_data = array(
            'nama'   => $nama,
            'alamat' => $alamat,
            'kontak' => $kontak,
            'email'  => $email
        );
        $this->db->insert($this->tbl_klien,$query_data);
        if ($this->db->affected_rows() == 0) return false;
        return true;
    }

    function update_klien($id_klien,$nama,$alamat,$kontak,$email){
            $_query_data = array(
	            'nama'   => $nama,
	            'alamat' => $alamat,
	            'kontak' => $kontak,
	            'email'  => $email
            );
        $this->db->where('id_klien', $id_klien);
        $this->db->update($this->tbl_klien, $_query_data);
            if ($this->db->affected_rows() == 0) return false;
            return true;
    }

    function get_proyek(){
        $query = $this->db->query("SELECT *, IF (status=1,0,IF(status=3,1,2)) AS urutan FROM $this->tbl_proyek ORDER BY urutan DESC, selesai ASC");
        return $query->result();
    }

    function get_detail_proyek($id_proyek){
        $query = $this->db->query("SELECT * FROM $this->tbl_proyek WHERE id_proyek='$id_proyek'");
        return $query->row();
    }

    function get_termin(){
        $query = $this->db->query("SELECT * FROM $this->tbl_administrasi");
        return $query->result();
    }

    function save_proyek($id_klien,$nama,$deskripsi,$harga,$mulai,$selesai,$status){
        $query_data = array(
            'id_klien'  => $id_klien,
            'nama'		=> $nama,
            'deskripsi' => $deskripsi,
            'harga'  	=> $harga,
            'mulai'  	=> $mulai,
            'selesai'  	=> $selesai,
            'status'  	=> $status
        );
        $this->db->insert($this->tbl_proyek,$query_data);
        if ($this->db->affected_rows() == 0) return false;
        return true;
    }

    function update_proyek($id_proyek,$id_klien,$nama,$deskripsi,$harga,$mulai,$selesai,$status){
            $_query_data = array(
	            'id_klien'  => $id_klien,
	            'nama'		=> $nama,
	            'deskripsi' => $deskripsi,
	            'harga'  	=> $harga,
	            'mulai'  	=> $mulai,
	            'selesai'  	=> $selesai,
	            'status'  	=> $status
            );
        $this->db->where('id_proyek', $id_proyek);
        $this->db->update($this->tbl_proyek, $_query_data);
            if ($this->db->affected_rows() == 0) return false;
            return true;
    }

    function delete_proyek($id_proyek) {
        $query = $this->db->query("DELETE FROM $this->tbl_proyek WHERE id_proyek='$id_proyek'");
        return $query;
    }



    function get_administrasi($id_proyek){
        $query = $this->db->query("SELECT * FROM $this->tbl_administrasi WHERE id_proyek='$id_proyek'");
        return $query->result();
    }

    function get_rekap_administrasi(){
        $query = $this->db->query("
            SELECT proyek.id_proyek,klien.id_klien,proyek.nama AS nama_proyek, klien.nama AS nama_klien, proyek.harga, COUNT(administrasi.id_administrasi) AS jumlah_termin,
                SUM(administrasi.harga_termin) AS jumlah_bayar, 
                if (COUNT(administrasi.id_administrasi) = 0, proyek.harga, (proyek.harga-SUM(administrasi.harga_termin))) AS kekurangan, proyek.status,
                IF (status=1,0,IF(status=3,1,2)) AS urutan FROM proyek
            LEFT JOIN administrasi ON administrasi.id_proyek=proyek.id_proyek
            JOIN klien ON proyek.id_klien=klien.id_klien
            GROUP BY proyek.id_proyek ORDER BY urutan DESC");
        return $query->result();
    }

    function get_detail_administrasi($id_administrasi){
        $query = $this->db->query("SELECT * FROM $this->tbl_administrasi WHERE id_administrasi='$id_administrasi'");
        return $query->row();
    }

    function save_pembayaran($id_proyek,$tanggal,$harga_termin,$keterangan_termin,$terbilang){
        $query_data = array(
            'id_proyek'  		=> $id_proyek,
            'tanggal'			=> $tanggal,
            'harga_termin' 		=> $harga_termin,
            'keterangan_termin' => $keterangan_termin,
            'terbilang' 	 	=> $terbilang
        );
        $this->db->insert($this->tbl_administrasi,$query_data);
        if ($this->db->affected_rows() == 0) return false;
        return true;
    }

    function update_pembayaran($id_administrasi,$id_proyek,$tanggal,$harga_termin,$keterangan_termin,$terbilang){
        $query_data = array(
            'id_proyek'  		=> $id_proyek,
            'tanggal'			=> $tanggal,
            'harga_termin' 		=> $harga_termin,
            'keterangan_termin' => $keterangan_termin,
            'terbilang' 	 	=> $terbilang
        );
        $this->db->where('id_administrasi', $id_administrasi);
        $this->db->update($this->tbl_administrasi, $query_data);
            if ($this->db->affected_rows() == 0) return false;
            return true;
    }

    function get_count_proyek(){
        $query = $this->db->query("SELECT COUNT(*) AS JML FROM $this->tbl_proyek");
        return $query->row();
    }

    function get_count_klien(){
        $query = $this->db->query("SELECT COUNT(*) AS JML FROM $this->tbl_klien");
        return $query->row();
    }

    function get_total_harga_proyek(){
        $query = $this->db->query("SELECT SUM(harga) AS JML FROM $this->tbl_proyek");
        return $query->row();
    }

    function get_total_pembayaran(){
        $query = $this->db->query("SELECT SUM(harga_termin) AS JML FROM $this->tbl_administrasi");
        return $query->row();
    }

    function update_password_baru($u_name,$password_baru){
            $_query_data = array(
	            'u_paswd'   => $password_baru
            );
        $this->db->where('u_name', $u_name);
        $this->db->update($this->tbl_user, $_query_data);
            if ($this->db->affected_rows() == 0) return false;
            return true;
    }

    function get_total_pembayaran_by_proyek($id_proyek){
        $query = $this->db->query("SELECT SUM(harga_termin) AS JML FROM $this->tbl_administrasi WHERE id_proyek={$id_proyek}");
        return $query->row();
    }
}