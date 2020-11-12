<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Peternak extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        $this->auth->cek_login();
        // load model
        $this->load->model('Peternak_model');
        $this->load->model('Subkriteria_model');
    }

    public function index()
    {   
        // get data peternak
        $peternak = $this->Peternak_model->getPeternak();
        $st_kelompok = $this->Subkriteria_model->getSubkritEachKrit('KRT001');
        $st_bantuan = $this->Subkriteria_model->getSubkritEachKrit('KRT003');
        $sys_pemeliharaan = $this->Subkriteria_model->getSubkritEachKrit('KRT004');
        $pel_kesehatan = $this->Subkriteria_model->getSubkritEachKrit('KRT005');
        
        $data = array(  
            'title'     =>      'Peternak | Administrator',
            'subtitle'  =>      'Peternak',
            'peternak'  =>      $peternak,
            'st_kelompok'  =>      $st_kelompok,
            'st_bantuan'  =>      $st_bantuan,
            'sys_pemeliharaan'  =>      $sys_pemeliharaan,
            'pel_kesehatan'  =>      $pel_kesehatan,
            'isi'       =>      'admin/peternak/list' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // fungsi tambah data suplier
    public function tambah_klp_ternak()
    {
        
        if ($_POST['sertifi_ternak'] == "") {
            $sertifi = "SUB006";
        } else {
            $sertifi = "SUB005";
        }

        $kd_subkriteria = array(
            $_POST['st_kelompok'],
            $sertifi,
            $_POST['st_bantuan'],
            $_POST['sys_pemeliharaan'],
            $_POST['pel_kesehatan']
        );

        $data = array (
            'kd_alternatif'    =>  $this->input->post('kd_alternatif'),
            'nama'          =>  $this->input->post('kel_ternak'),
            'alamat'        =>  $this->input->post('alamat'),
            'Telepon'       =>  $this->input->post('telepon'),
            'sertifikat'       =>  $this->input->post('sertifi_ternak')
        );
        
        // tambah data ke table suplier
        $this->Peternak_model->tambahKelpTernak($data, $kd_subkriteria);

        // set flashdata
        $this->session->set_flashdata('sukses', 'Data Kelompok Ternak telah ditambahkan.');
        redirect(base_url('admin/peternak'), 'refresh');
        
        
        
    }

    // fungsi edit data suplier
    public function edit_klp_ternak()
    {
        if ($_POST['sertifi_ternak'] == "") {
            $sertifi = "SUB006";
        } else {
            $sertifi = "SUB005";
        }

        $kd_subkriteria = array(
            $_POST['st_kelompok'],
            $sertifi,
            $_POST['st_bantuan'],
            $_POST['sys_pemeliharaan'],
            $_POST['pel_kesehatan']
        );

        $data = array (
            'kd_alternatif'    =>  $this->input->post('kd_alternatif'),
            'nama'          =>  $this->input->post('kel_ternak'),
            'alamat'        =>  $this->input->post('alamat'),
            'Telepon'       =>  $this->input->post('telepon'),
            'sertifikat'       =>  $this->input->post('sertifi_ternak')
        );
        $this->Suplier_model->editSuplier($data);

        // hapus transmat
        $this->Suplier_model->hapusTransmat($data['kd_suplier']);
        // edit data ke table transmat
        for ($i=0; $i < count($arr_mat) ; $i++) { 

            $this->Suplier_model->tambahTransmat($data['kd_suplier'],$arr_mat[$i]);
            
        }
        // echo "keluar pak eko";exit;
        // set flashdata
        $this->session->set_flashdata('sukses', 'Data Suplier Telah Diedit');
        redirect(base_url('admin/suplier'));
        

    }

    // fungsi hapus suplier
    public function hapus_klp_ternak($kd_alternatif)
    {
        // proses hapus gambar
        // $suplier = $this->Suplier_model->getSuratUsaha($kd_suplier);
        // $image_path = realpath(APPPATH . '../assets/upload/image/surat_usaha');
        // unlink("$image_path/".$suplier[0]['surat_usaha']);
        // unlink("$image_path/thumbs/".$suplier[0]['surat_usaha']);

        // proses hapus suplier
        $this->Peternak_model->hapusKlpTernak($kd_alternatif);
        $this->session->set_flashdata('sukses', 'Data Kelompok Ternak Telah Dihapus');
        redirect(base_url('admin/peternak'), 'refresh');
        
    }

}

/* End of file Peternak.php */
