<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        $this->auth->cek_login();
        // load model
        $this->load->model('Pasien_model');
        $this->load->model('Subkriteria_model');
        $this->load->model('Evaluasi_model');
    }

    public function index()
    {   
        // get data pasien
        $pasien = $this->Pasien_model->getPasien();
        $st_kelompok = $this->Subkriteria_model->getSubkritEachKrit('KRT001');
        $st_bantuan = $this->Subkriteria_model->getSubkritEachKrit('KRT003');
        $sys_pemeliharaan = $this->Subkriteria_model->getSubkritEachKrit('KRT004');
        $pel_kesehatan = $this->Subkriteria_model->getSubkritEachKrit('KRT005');

        for ($i=0; $i < count($pasien) ; $i++) { 
            $pasien[$i]['eval']['st_kelompok'] = $this->Evaluasi_model->getDataEval($pasien[$i]['kd_alternatif'], "1");
            $pasien[$i]['eval']['sertifi'] = $this->Evaluasi_model->getDataEval($pasien[$i]['kd_alternatif'], "2");
            $pasien[$i]['eval']['st_bantuan'] = $this->Evaluasi_model->getDataEval($pasien[$i]['kd_alternatif'], "3");
            $pasien[$i]['eval']['sys_pem'] = $this->Evaluasi_model->getDataEval($pasien[$i]['kd_alternatif'], "4");
            $pasien[$i]['eval']['sys_kes'] = $this->Evaluasi_model->getDataEval($pasien[$i]['kd_alternatif'], "5");
        }

        $data = array(  
            'title'     =>      'Pasien | Administrator',
            'subtitle'  =>      'Pasien',
            'pasien'  =>      $pasien,
            'st_kelompok'  =>      $st_kelompok,
            'st_bantuan'  =>      $st_bantuan,
            'sys_pemeliharaan'  =>      $sys_pemeliharaan,
            'pel_kesehatan'  =>      $pel_kesehatan,
            'isi'       =>      'admin/pasien/list' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // fungsi tambah data suplier
    public function tambah_klp_ternak()
    {
        
        if ($_FILES['sertifi_ternak']['size'] == 0) {
            $sertifi = "SUB006";

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
                'Telepon'       =>  $this->input->post('telepon')
            );
            
            // tambah data ke table suplier
            $this->Pasien_model->tambahKelpTernak($data, $kd_subkriteria);
    
            // set flashdata
            $this->session->set_flashdata('sukses', 'Data Kelompok Ternak telah ditambahkan.');
            redirect(base_url('admin/pasien'), 'refresh');
        } else {
            $sertifi = "SUB005";

            $kd_subkriteria = array(
                $_POST['st_kelompok'],
                $sertifi,
                $_POST['st_bantuan'],
                $_POST['sys_pemeliharaan'],
                $_POST['pel_kesehatan']
            );

            // upload sertifikat ternak
            $image_path = realpath(APPPATH . '../assets/upload/image/sertifikat');
            $config['upload_path']   = $image_path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['max_width']     = 2040;
            $config['max_height']    = 2040;
            
            $this->load->library('upload', $config);
            // echo "<pre>";print_r($_FILES);exit;
            if( ! $this->upload->do_upload('sertifi_ternak') ) {
                // echo $this->upload->display_errors();
                // var_dump($this->upload->display_errors('', ''));
                // var_dump($_FILES);exit;

                // set flashdata
                $this->session->set_flashdata('upload_fail', $this->upload->display_errors());
                redirect(base_url("admin/pasien/"), 'refresh');

            } else {
                
                // var_dump($this->input->post('kode_transaksi'));exit;
                // $this->Pelanggan_model->addStruk();
                // $this->session->set_flashdata('sukses', 'Ditambahkan');
                // redirect(base_url('belanja/pemberitahuan'));
                $upload_gambar = ["upload_data" => $this->upload->data()];
                
                // create thumbnail gambar
                $config['image_library']    = 'gd2';
                $config['source_image']     = "$image_path/".$upload_gambar['upload_data']['file_name'];
                // lokasi folder thumbnail
                $config['new_image']        = "$image_path/thumbs";
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 75;
                $config['height']           = 50;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
                // end create thumbnail
    
                $data = array (
                    'kd_alternatif'    =>  $this->input->post('kd_alternatif'),
                    'nama'          =>  $this->input->post('kel_ternak'),
                    'alamat'        =>  $this->input->post('alamat'),
                    'Telepon'       =>  $this->input->post('telepon'),
                    'sertifikat'       =>  $upload_gambar['upload_data']['file_name']
                );
                
                // tambah data ke table suplier
                $this->Pasien_model->tambahKelpTernak($data, $kd_subkriteria);
        
                // set flashdata
                $this->session->set_flashdata('sukses', 'Data Kelompok Ternak telah ditambahkan.');
                redirect(base_url('admin/pasien'), 'refresh');
            }
        
        } 
        
    }


    // fungsi edit data kelompok ternak
    public function edit_klp_ternak()
    {

        if ($_FILES == NULL) {
            
            // echo "<pre>";
            // print_r($_FILES);die;
            $kd_subkriteria = array(
                $_POST['st_kelompok'],
                "SUB005",
                $_POST['st_bantuan'],
                $_POST['sys_pemeliharaan'],
                $_POST['pel_kesehatan']
            );

            $data = array (
                'kd_alternatif' =>  $this->input->post('kd_alternatif'),
                'nama'          =>  $this->input->post('kel_ternak'),
                'alamat'        =>  $this->input->post('alamat'),
                'Telepon'       =>  $this->input->post('telepon')
            );
            
            // edit data kelompok ternak
            $this->Pasien_model->editPasien($data, $kd_subkriteria);

            // set flashdata
            $this->session->set_flashdata('sukses', 'Data Kelompok Ternak telah diubah.');
            redirect(base_url('admin/pasien'), 'refresh');

        } else {
            
            if ($_FILES['sertifi_ternak']['size'] == 0) {
            
                // echo "file size 0";
                // echo "<pre>";
                // print_r($_FILES);die;
                $kd_subkriteria = array(
                    $_POST['st_kelompok'],
                    "SUB006",
                    $_POST['st_bantuan'],
                    $_POST['sys_pemeliharaan'],
                    $_POST['pel_kesehatan']
                );
    
                $data = array (
                    'kd_alternatif' =>  $this->input->post('kd_alternatif'),
                    'nama'          =>  $this->input->post('kel_ternak'),
                    'alamat'        =>  $this->input->post('alamat'),
                    'Telepon'       =>  $this->input->post('telepon')
                );

                // edit data kelompok ternak
                $this->Pasien_model->editPasien($data, $kd_subkriteria);

                // set flashdata
                $this->session->set_flashdata('sukses', 'Data Kelompok Ternak telah diubah.');
                redirect(base_url('admin/pasien'), 'refresh');
    
            } else {
    
                // echo "file not 0";die;
                $kd_subkriteria = array(
                    $_POST['st_kelompok'],
                    "SUB005",
                    $_POST['st_bantuan'],
                    $_POST['sys_pemeliharaan'],
                    $_POST['pel_kesehatan']
                );

                // upload sertifikat ternak
                $image_path = realpath(APPPATH . '../assets/upload/image/sertifikat');
                $config['upload_path']   = $image_path;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = 2048;
                $config['max_width']     = 2040;
                $config['max_height']    = 2040;
                
                $this->load->library('upload', $config);
                // echo "<pre>";print_r($_FILES);exit;
                if( ! $this->upload->do_upload('sertifi_ternak') ) {
                    // echo $this->upload->display_errors();
                    // var_dump($this->upload->display_errors('', ''));
                    // var_dump($_FILES);exit;

                    // set flashdata
                    $this->session->set_flashdata('upload_fail', $this->upload->display_errors());
                    redirect(base_url("admin/pasien/"), 'refresh');

                } else {
                    
                    // var_dump($this->input->post('kode_transaksi'));exit;
                    // $this->Pelanggan_model->addStruk();
                    // $this->session->set_flashdata('sukses', 'Ditambahkan');
                    // redirect(base_url('belanja/pemberitahuan'));
                    $upload_gambar = ["upload_data" => $this->upload->data()];
                    
                    // create thumbnail gambar
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = "$image_path/".$upload_gambar['upload_data']['file_name'];
                    // lokasi folder thumbnail
                    $config['new_image']        = "$image_path/thumbs";
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 75;
                    $config['height']           = 50;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();
                    // end create thumbnail
        
                    $data = array (
                        'kd_alternatif' =>  $this->input->post('kd_alternatif'),
                        'nama'          =>  $this->input->post('kel_ternak'),
                        'alamat'        =>  $this->input->post('alamat'),
                        'Telepon'       =>  $this->input->post('telepon'),
                        'sertifikat'    =>  $upload_gambar['upload_data']['file_name']
                    );

                    // edit data kelompok ternak
                    $this->Pasien_model->editPasien($data, $kd_subkriteria);

                    // set flashdata
                    $this->session->set_flashdata('sukses', 'Data Kelompok Ternak telah diubah.');
                    redirect(base_url('admin/pasien'), 'refresh');
        
                }

            }
        }

    }

    // fungsi hapus suplier
    public function hapus_klp_ternak($kd_alternatif)
    {
        // // proses hapus gambar
        // $suplier = $this->Suplier_model->getSuratUsaha($kd_suplier);
        // $image_path = realpath(APPPATH . '../assets/upload/image/surat_usaha');
        // unlink("$image_path/".$suplier[0]['surat_usaha']);
        // unlink("$image_path/thumbs/".$suplier[0]['surat_usaha']);

        // proses hapus suplier
        $this->Pasien_model->hapusKlpTernak($kd_alternatif);
        $this->session->set_flashdata('sukses', 'Data Kelompok Ternak Telah Dihapus');
        redirect(base_url('admin/pasien'), 'refresh');
        
    }

}

/* End of file Pasien.php */
