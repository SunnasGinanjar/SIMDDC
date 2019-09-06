<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('m_user','m_admin'));
        if (!$this->session->userdata('u_name')) {
            redirect('login');
        }

    }

    function index() {
        //$this->load->view('admin/dashboard');
        $data['count_proyek'] = $this->m_admin->get_count_proyek()->JML;
        $data['count_klien'] = $this->m_admin->get_count_klien()->JML;

        $total_harga_proyek = $this->m_admin->get_total_harga_proyek()->JML;
        $total_pembayaran = $this->m_admin->get_total_pembayaran()->JML;
        $persen_administrasi = ($total_pembayaran/$total_harga_proyek)*100;
        $data_persen_administrasi = number_format((float)$persen_administrasi, 2, '.', '');
        $data['persen_administrasi'] =  $data_persen_administrasi;


        $this->load->template_website('template/content', $data);
    }

    function ubah_password() {
        $this->load->template_website('admin/ubah_password');
    }

    function save_password_baru() {
        $this->form_validation->set_rules('password_lama', 'password_lama', 'required|trim');
        $this->form_validation->set_rules('password_baru', 'password_baru', 'required|trim');
        $this->form_validation->set_rules('konfirmasi_password_baru', 'konfirmasi_password_baru', 'required|trim');

        if (!$this->form_validation->run() == FALSE) {
            $psw_lama = $this->input->post('password_lama');
            $psw_baru = $this->input->post('password_baru');
            $kon_psw_baru = $this->input->post('konfirmasi_password_baru');    

            $p = md5($psw_lama);
            $psw_lama_session = $this->session->userdata('u_pass');
            $u_name = $this->session->userdata('u_name');

            if ($p!=$psw_lama_session){
                $this->session->set_flashdata('result_password', '<br>Password lama yang anda masukkan salah.');
                redirect('admin/ubah_password');

            }else if($psw_baru!=$kon_psw_baru){       
                $this->session->set_flashdata('result_password', '<br>Password baru yang anda masukkan tidak sama.');
                redirect('admin/ubah_password');
            }else{
                $p_baru=md5($psw_baru);
                $this->m_admin->update_password_baru($u_name, $p_baru);

                $this->session->sess_destroy();
                $data["infos"]="<b>Silakan login dengan password yang baru.";
                $this->load->view('login_page', $data);
            }
        } 
    }

    function daftar_proyek() {
        //$this->load->view('admin/proyek_page');
        $data['daftar_klien']=$this->m_admin->get_klien();
        $data['daftar_proyek']=$this->m_admin->get_proyek();
        $this->load->template_website('admin/proyek_page', $data);
    }

    function daftar_klien() {
        $data['daftar_klien']=$this->m_admin->get_klien();
        $this->load->template_website('admin/klien_page', $data);
    }

    function daftar_administrasi() {
        $data['daftar_termin']=$this->m_admin->get_termin();

        $data['daftar_klien']=$this->m_admin->get_klien();
        $data['daftar_proyek']=$this->m_admin->get_rekap_administrasi();

        $this->load->template_website('admin/administrasi_page', $data);
    }

    function pengaturan() {
        $pengaturan = $this->m_admin->get_pengaturan();
        $data["pengaturan"]=$pengaturan;
        $this->load->template_website('admin/pengaturan_page', $data);
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    function cetak_kwitansi() {

        if (isset($_POST['submit'])){

            $id_proyek=$this->input->post("id_proyek");
            $id_klien=$this->input->post("id_klien");
            $id_administrasi=$this->input->post("id_administrasi");

            $data['detail_klien']=$this->m_admin->get_detail_klien($id_klien);
            $data['detail_proyek']=$this->m_admin->get_detail_proyek($id_proyek);
            $data['daftar_administrasi']=$this->m_admin->get_administrasi($id_proyek);
            $data['detail_administrasi']=$this->m_admin->get_detail_administrasi($id_administrasi);
            
            $pengaturan = $this->m_admin->get_pengaturan();
            $data["pengaturan"]=$pengaturan;

            $data['daftar_klien']=$this->m_admin->get_klien();
            $data['daftar_proyek']=$this->m_admin->get_proyek();
            $html = $this->load->view('admin/cetak_administrasi_page', $data, true);
            
            $mpdf = new \Mpdf\Mpdf(['format' => [190, 150]]);
            $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
            $mpdf->WriteHTML($html);
            $mpdf->Output();

        }
        
    }

    function detail_administrasi($id_proyek) {
        //$data['detail_klien']=$this->m_admin->get_detail_klien($id_klien);
        $data['detail_proyek']=$this->m_admin->get_detail_proyek($id_proyek);
        $data['daftar_administrasi']=$this->m_admin->get_administrasi($id_proyek);
        
        $data['daftar_klien']=$this->m_admin->get_klien();
        $data['daftar_proyek']=$this->m_admin->get_proyek();

        $data['total_pembayaran'] = $this->m_admin->get_total_pembayaran_by_proyek($id_proyek)->JML;
        $data['total_kekurangan'] = $data['detail_proyek']->harga - $data['total_pembayaran'];

        $this->load->template_website('admin/detail_administrasi_page', $data);
    }

    // Pengaturan
    public function update_pengaturan(){

        if (isset($_POST['submit'])){

            if (!$this->input->post('id_pengaturan') || !$this->input->post('nama_perusahaan') || !$this->input->post('alamat') || !$this->input->post('alamat2') || !$this->input->post('kontak') || !$this->input->post('website') || !$this->input->post('ceo') || !$this->input->post('tempat_ttd')){

                $data['errors'] = 'Mohon isi dengan lengkap bagian yang bersyarat..';

            }
            else {

               $_result = $this->m_admin->update_pengaturan(
                    $this->input->post('id_pengaturan'),
                    $this->input->post('nama_perusahaan'),
                    $this->input->post('alamat'),
                    $this->input->post('alamat2'),
                    $this->input->post('kontak'),
                    $this->input->post('website'),
                    $this->input->post('ceo'),
                    $this->input->post('tempat_ttd')
                );
                
                if ($_result) {
                    $data['infos']   = 'Profil baru berhasil disimpan.';
                }else $data['errors'] = 'Terjadi kesalahan. Silakan periksa konten dan ulangi lagi.';
                
            }
        }
        
        $data['pengaturan']=$this->m_admin->get_pengaturan();
        $this->load->template_website('admin/pengaturan_page', $data);

    }


    //Klien
    public function save_klien(){

        if (isset($_POST['submit'])){

            if (!$this->input->post('nama') || !$this->input->post('alamat') || !$this->input->post('kontak') || !$this->input->post('email')){

                $data['errors'] = 'Mohon isi dengan lengkap bagian yang bersyarat..';

            }
            else {

               $_result = $this->m_admin->save_klien(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('kontak'),
                    $this->input->post('email')
                );
                
                if ($_result) {
                    $data['infos']   = 'Penambahan berhasil disimpan.';
                }else $data['errors'] = 'Terjadi kesalahan. Silakan periksa konten dan ulangi lagi.';
                
            }
        }
        
        $data['daftar_klien']=$this->m_admin->get_klien();
        $this->load->template_website('admin/klien_page', $data);

    }

    public function update_klien(){

        if (isset($_POST['submit'])){

            if (!$this->input->post('id_klien') || !$this->input->post('nama') || !$this->input->post('alamat') || !$this->input->post('kontak') || !$this->input->post('email')){

                $data['errors'] = 'Mohon isi dengan lengkap bagian yang bersyarat..';

            }
            else {

               $_result = $this->m_admin->update_klien(
                    $this->input->post('id_klien'),
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('kontak'),
                    $this->input->post('email')
                );
                
                if ($_result) {
                    $data['infos']   = 'Penambahan berhasil disimpan.';
                }else $data['errors'] = 'Terjadi kesalahan. Silakan periksa konten dan ulangi lagi.';
                
            }
        }
        
        $data['daftar_klien']=$this->m_admin->get_klien();
        $this->load->template_website('admin/klien_page', $data);

    }

    //Proyek
    public function save_proyek(){

        if (isset($_POST['submit'])){

            if (!$this->input->post('id_klien') || !$this->input->post('nama') || !$this->input->post('deskripsi') || !$this->input->post('harga') || !$this->input->post('mulai') || !$this->input->post('selesai')){

                $data['errors'] = 'Mohon isi dengan lengkap bagian yang bersyarat..';

            }
            else {
                $harga = $this->input->post('harga');
                $harga = str_replace('.', '', $harga);
               $_result = $this->m_admin->save_proyek(
                    $this->input->post('id_klien'),
                    $this->input->post('nama'),
                    $this->input->post('deskripsi'),
                    $harga,
                    $this->input->post('mulai'),
                    $this->input->post('selesai'),
                    "3"
                );
                
                if ($_result) {
                    $data['infos']   = 'Penambahan berhasil disimpan.';
                }else $data['errors'] = 'Terjadi kesalahan. Silakan periksa konten dan ulangi lagi.';
                
            }
        }
        
        $data['daftar_klien']=$this->m_admin->get_klien();
        $data['daftar_proyek']=$this->m_admin->get_proyek();
        $this->load->template_website('admin/proyek_page', $data);

    }

    public function update_proyek(){

        if (isset($_POST['submit'])){

            if (!$this->input->post('id_proyek') || !$this->input->post('id_klien') || !$this->input->post('nama') || !$this->input->post('deskripsi') || !$this->input->post('harga') || !$this->input->post('mulai') || !$this->input->post('selesai') || !$this->input->post('status')){

                $data['errors'] = 'Mohon isi dengan lengkap bagian yang bersyarat..';

            }
            else {
                $harga = $this->input->post('harga');
                $harga = str_replace('.', '', $harga);
               $_result = $this->m_admin->update_proyek(
                    $this->input->post('id_proyek'),
                    $this->input->post('id_klien'),
                    $this->input->post('nama'),
                    $this->input->post('deskripsi'),
                    $harga,
                    $this->input->post('mulai'),
                    $this->input->post('selesai'),                    
                    $this->input->post('status')
                );
                
                if ($_result) {
                    $data['infos']   = 'Penambahan berhasil disimpan.';
                }else $data['errors'] = 'Terjadi kesalahan. Silakan periksa konten dan ulangi lagi.';
                
            }
        }
        
        $data['daftar_klien']=$this->m_admin->get_klien();
        $data['daftar_proyek']=$this->m_admin->get_proyek();
        $this->load->template_website('admin/proyek_page', $data);

    }

    public function delete_proyek(){
        if (isset($_POST['submit'])){
            $id_proyek = $this->input->post('id_proyek');

            $this->m_admin->delete_proyek($id_proyek);

            $data['infos'] = 'Data proyek berhasil dihapus...';
        }

        $data['daftar_klien']=$this->m_admin->get_klien();
        $data['daftar_proyek']=$this->m_admin->get_proyek();
        $this->load->template_website('admin/proyek_page', $data);
    }


    //Administrasi
    public function save_pembayaran(){
        $id_proyek = $this->input->post('id_proyek');
        $data['detail_proyek']=$this->m_admin->get_detail_proyek($id_proyek);

        if (isset($_POST['submit'])){

            if (!$this->input->post('id_klien') || !$this->input->post('id_proyek') || !$this->input->post('tanggal') || !$this->input->post('harga_termin') || !$this->input->post('keterangan_termin') || !$this->input->post('terbilang')){

                $data['errors'] = 'Mohon isi dengan lengkap bagian yang bersyarat..';

            }
            else {
                
                $harga = $this->input->post('harga_termin');
                $harga = str_replace('.', '', $harga);

                $data['total_pembayaran'] = $this->m_admin->get_total_pembayaran_by_proyek($id_proyek)->JML;
                $data['total_kekurangan'] = $data['detail_proyek']->harga - $data['total_pembayaran'];

                if ($harga > $data['total_kekurangan']) {
                    $data['errors'] = 'Jumlah pembayaran melebihi harga.';
                } else {
                    $_result = $this->m_admin->save_pembayaran(
                    $this->input->post('id_proyek'),
                        $this->input->post('tanggal'),
                        $harga,
                        $this->input->post('keterangan_termin'),
                        $this->input->post('terbilang')
                    );
                    
                    if ($_result) {
                        $data['infos']   = 'Penambahan berhasil disimpan.';
                    }else $data['errors'] = 'Terjadi kesalahan. Silakan periksa konten dan ulangi lagi.';
                }
            }
        }
        
        $id_klien=$this->input->post("id_klien");

        $data['detail_proyek']=$this->m_admin->get_detail_proyek($id_proyek);
        $data['detail_klien']=$this->m_admin->get_detail_klien($id_klien);
        $data['daftar_administrasi']=$this->m_admin->get_administrasi($id_proyek);

        $data['daftar_klien']=$this->m_admin->get_klien();
        $data['daftar_proyek']=$this->m_admin->get_proyek();

        $data['total_pembayaran'] = $this->m_admin->get_total_pembayaran_by_proyek($id_proyek)->JML;
        $data['total_kekurangan'] = $data['detail_proyek']->harga - $data['total_pembayaran'];

        $this->load->template_website('admin/detail_administrasi_page', $data);

    }

    public function update_pembayaran(){
        $id_proyek=$this->input->post("id_proyek");
        $data['detail_proyek']=$this->m_admin->get_detail_proyek($id_proyek);

        if (isset($_POST['submit'])){

            if (!$this->input->post('id_administrasi') ||!$this->input->post('id_proyek') || !$this->input->post('id_klien') || !$this->input->post('tanggal') || !$this->input->post('harga_termin') || !$this->input->post('keterangan_termin') || !$this->input->post('terbilang')){

                $data['errors'] = 'Mohon isi dengan lengkap bagian yang bersyarat..';

            }
            else {
                $harga = $this->input->post('harga_termin');
                $harga = str_replace('.', '', $harga);

                $data['total_pembayaran'] = $this->m_admin->get_total_pembayaran_by_proyek($id_proyek)->JML;
                $data['total_kekurangan'] = $data['detail_proyek']->harga - $data['total_pembayaran'];

               $_result = $this->m_admin->update_pembayaran(
                    $this->input->post('id_administrasi'),
                    $this->input->post('id_proyek'),
                    $this->input->post('tanggal'),
                    $harga,
                    $this->input->post('keterangan_termin'),
                    $this->input->post('terbilang')
                );
                
                if ($_result) {
                    $data['infos']   = 'Penambahan berhasil disimpan.';
                }else $data['errors'] = 'Terjadi kesalahan. Silakan periksa konten dan ulangi lagi.';
                
            }
        }
        
        $id_klien=$this->input->post("id_klien");
        $data['detail_klien']=$this->m_admin->get_detail_klien($id_klien);
        $data['detail_proyek']=$this->m_admin->get_detail_proyek($id_proyek);
        $data['daftar_administrasi']=$this->m_admin->get_administrasi($id_proyek);

        $data['daftar_klien']=$this->m_admin->get_klien();
        $data['daftar_proyek']=$this->m_admin->get_proyek();

        $data['total_pembayaran'] = $this->m_admin->get_total_pembayaran_by_proyek($id_proyek)->JML;
        $data['total_kekurangan'] = $data['detail_proyek']->harga - $data['total_pembayaran'];

        $this->load->template_website('admin/detail_administrasi_page', $data);

    }
   
}