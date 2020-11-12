<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        // $this->auth->cek_login();
        // load model
        $this->load->model('Suplier_model');
        $this->load->model('Evaluasi_model');
        $this->load->database();
    }

    public function index()
    {
        $data = array(
            'title'     =>  "Suplier",
            'isi'       =>  "suplier/list"
        );

        $this->load->view('layout/wrapper', $data, FALSE);
        
    }

    // fungsi tambah data suplier
    public function tambah_suplier()
    {

        if ($this->input->post('material[]') == null) {
            // set flashdata
            $this->session->set_flashdata('gagal', 'Anda Belum Memilih Jenis Material.');
            redirect(base_url('suplier'), 'refresh');
        } else {

            // upload surat usaha
            $image_path = realpath(APPPATH . '../assets/upload/image/surat_usaha');
            $config['upload_path']   = $image_path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['max_width']     = 2040;
            $config['max_height']    = 2040;
            
            $this->load->library('upload', $config);
            // echo "<pre>";print_r($_FILES);exit;
            if( ! $this->upload->do_upload('surat_usaha') ) {
                // echo $this->upload->display_errors();
                // var_dump($this->upload->display_errors('', ''));
                // var_dump($_FILES);exit;

                // set flashdata
                $this->session->set_flashdata('upload_fail', $this->upload->display_errors());
                redirect(base_url("suplier/"), 'refresh');

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

                $arr_mat = $this->input->post('material[]');
                // gabung jenis material
                $material = implode(" ,", $arr_mat);
                $kd_suplier = $this->input->post('kd_suplier');
                $data = array (
                    'kd_suplier'    =>  $kd_suplier,
                    'nm_suplier'    =>  $this->input->post('suplier'),
                    'email'         =>  $this->input->post('email'),
                    'Telepon'       =>  $this->input->post('telepon'),
                    'material'      =>  $material,
                    'alamat'        =>  $this->input->post('alamat'),
                    'surat_usaha'   =>  $upload_gambar['upload_data']['file_name']
                );
                
                // tambah data ke table suplier
                $this->Suplier_model->tambahSuplier($data);

                // tambah data ke table transmat
                for ($i=0; $i < count($arr_mat) ; $i++) { 

                    $this->Suplier_model->tambahTransmat($data['kd_suplier'],$arr_mat[$i]);
                    
                }

                // set flashdata
                $this->session->set_flashdata('sukses', 'Silahkan lengkapi data dari setiap material.');
                redirect(base_url("suplier/evaluasi?kd_suplier=$kd_suplier"), 'refresh');
            }
            
        }
        
        
    }

    public function evaluasi()
    {
        $kd_suplier = $_GET['kd_suplier'];
        $eval_harga = $this->Evaluasi_model->getDataEvalHarga($kd_suplier);
        $eval_kual = $this->Evaluasi_model->getDataEvalKualitas($kd_suplier);
        $eval_kuan = $this->Evaluasi_model->getDataEvalKuantitas($kd_suplier);
        $eval_harga_chunk = array_chunk($eval_harga, 3);
        $eval_kual_chunk = array_chunk($eval_kual, 3);
        $eval_kuan_chunk = array_chunk($eval_kuan, 3);
        // echo "<pre>";
        // print_r($eval_harga_chunk);
        // print_r($eval_kual);
        // print_r($eval_kuan);
        // array harga
        $harga_all['batu_bara'] = [];
        $harga_all['silica'] = [];
        $harga_all['gypsum'] = [];
        $harga_all['clay'] = [];
        $harga_all['chipping'] = [];
        // array kualitas
        $kual_all['batu_bara'] = [];
        $kual_all['silica'] = [];
        $kual_all['gypsum'] = [];
        $kual_all['clay'] = [];
        $kual_all['chipping'] = [];
        // array kuantitas
        $kuan_all['batu_bara'] = [];
        $kuan_all['silica'] = [];
        $kuan_all['gypsum'] = [];
        $kuan_all['clay'] = [];
        $kuan_all['chipping'] = [];
        // print_r($harga_all);exit;

        // memasukkan value array evaluasi harga ke array baru untuk mengidentifikasi material
        for ($i=0; $i < count($eval_harga_chunk) ; $i++) { 
            for ($j=0; $j < 3; $j++) { 
                if ($eval_harga_chunk[$i][$j]['kd_material'] == "mtr-001") {
                    $harga_all['batu_bara'][$j] = [
                        "kd_material"    =>  $eval_harga_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_harga_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_harga_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_harga_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_harga_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_harga_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_harga_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_harga_chunk[$i][$j]['kd_material'] == "mtr-002") {
                    $harga_all['silica'][$j] = [
                        "kd_material"    =>  $eval_harga_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_harga_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_harga_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_harga_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_harga_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_harga_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_harga_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_harga_chunk[$i][$j]['kd_material'] == "mtr-003") {
                    $harga_all['gypsum'][$j] = [
                        "kd_material"    =>  $eval_harga_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_harga_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_harga_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_harga_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_harga_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_harga_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_harga_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_harga_chunk[$i][$j]['kd_material'] == "mtr-004") {
                    $harga_all['clay'][$j] = [
                        "kd_material"    =>  $eval_harga_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_harga_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_harga_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_harga_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_harga_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_harga_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_harga_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_harga_chunk[$i][$j]['kd_material'] == "mtr-005") {
                    $harga_all['chipping'][$j] = [
                        "kd_material"    =>  $eval_harga_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_harga_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_harga_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_harga_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_harga_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_harga_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_harga_chunk[$i][$j]['ket']
                    ];
                } else {
                    
                }
            }
        }
        // memasukkan value array evaluasi kualitas ke array baru untuk mengidentifikasi material
        for ($i=0; $i < count($eval_kual_chunk) ; $i++) { 
            for ($j=0; $j < 3; $j++) { 
                if ($eval_kual_chunk[$i][$j]['kd_material'] == "mtr-001") {
                    $kual_all['batu_bara'][$j] = [
                        "kd_material"    =>  $eval_kual_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kual_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kual_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kual_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kual_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kual_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kual_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_kual_chunk[$i][$j]['kd_material'] == "mtr-002") {
                    $kual_all['silica'][$j] = [
                        "kd_material"    =>  $eval_kual_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kual_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kual_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kual_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kual_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kual_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kual_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_kual_chunk[$i][$j]['kd_material'] == "mtr-003") {
                    $kual_all['gypsum'][$j] = [
                        "kd_material"    =>  $eval_kual_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kual_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kual_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kual_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kual_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kual_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kual_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_kual_chunk[$i][$j]['kd_material'] == "mtr-004") {
                    $kual_all['clay'][$j] = [
                        "kd_material"    =>  $eval_kual_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kual_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kual_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kual_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kual_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kual_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kual_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_kual_chunk[$i][$j]['kd_material'] == "mtr-005") {
                    $kual_all['chipping'][$j] = [
                        "kd_material"    =>  $eval_kual_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kual_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kual_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kual_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kual_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kual_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kual_chunk[$i][$j]['ket']
                    ];
                } else {
                    
                }
                
            }
        }

        // memasukkan value array evaluasi kuantita ke array baru untuk mengidentifikasi material
        for ($i=0; $i < count($eval_kuan_chunk) ; $i++) { 
            for ($j=0; $j < 3; $j++) { 
                if ($eval_kuan_chunk[$i][$j]['kd_material'] == "mtr-001") {
                    $kuan_all['batu_bara'][$j] = [
                        "kd_material"    =>  $eval_kuan_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kuan_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kuan_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kuan_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kuan_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kuan_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kuan_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_kuan_chunk[$i][$j]['kd_material'] == "mtr-002") {
                    $kuan_all['silica'][$j] = [
                        "kd_material"    =>  $eval_kuan_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kuan_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kuan_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kuan_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kuan_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kuan_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kuan_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_kuan_chunk[$i][$j]['kd_material'] == "mtr-003") {
                    $kuan_all['gypsum'][$j] = [
                        "kd_material"    =>  $eval_kuan_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kuan_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kuan_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kuan_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kuan_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kuan_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kuan_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_kuan_chunk[$i][$j]['kd_material'] == "mtr-004") {
                    $kuan_all['clay'][$j] = [
                        "kd_material"    =>  $eval_kuan_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kuan_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kuan_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kuan_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kuan_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kuan_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kuan_chunk[$i][$j]['ket']
                    ];
                } elseif ($eval_kuan_chunk[$i][$j]['kd_material'] == "mtr-005") {
                    $kuan_all['chipping'][$j] = [
                        "kd_material"    =>  $eval_kuan_chunk[$i][$j]['kd_material'],
                        "kd_kriteria"    =>  $eval_kuan_chunk[$i][$j]['kd_kriteria'],
                        "kd_suplier"     =>  $eval_kuan_chunk[$i][$j]['kd_suplier'],
                        "nm_kriteria"    =>  $eval_kuan_chunk[$i][$j]['nm_kriteria'],
                        "value"          =>  $eval_kuan_chunk[$i][$j]['value'],
                        "nilai"          =>  $eval_kuan_chunk[$i][$j]['nilai'],
                        "ket"            =>  $eval_kuan_chunk[$i][$j]['ket']
                    ];
                } else {
                    
                }

                
            }
        }
        // echo "<pre>";
        // print_r($harga_all);
        // print_r($kual_all);
        // print_r($kuan_all);
        // exit;

        $data = array(
            'title'         =>  "Evaluasi",
            'isi'           =>  "suplier/evaluasi",
            "harga"         =>  $harga_all,
            "kualitas"      =>  $kual_all,
            "kuantitas"     =>  $kuan_all,
        );

        $this->load->view('layout/wrapper', $data, FALSE);
        
    }


    public function update_eval()
    {
        // echo "<pre>";

        $data = $_POST;
        // print_r($data);

        // proses update nilai kriteria harga pada evaluasi disetiap material 
        if ($data['harga']['batubara'] != 0) {
            $kd_material = "mtr-001";
            $nm_material = "batubara";
            $this->Evaluasi_model->updateNilaiHargaSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['harga']['silica'] != 0) {
            $kd_material = "mtr-002";
            $nm_material = "silica";
            $this->Evaluasi_model->updateNilaiHargaSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['harga']['gypsum'] != 0) {
            $kd_material = "mtr-003";
            $nm_material = "gypsum";
            $this->Evaluasi_model->updateNilaiHargaSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['harga']['clay'] != 0) {
            $kd_material = "mtr-004";
            $nm_material = "clay";
            $this->Evaluasi_model->updateNilaiHargaSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['harga']['chipping'] != 0) {
            $kd_material = "mtr-005";
            $nm_material = "chipping";
            $this->Evaluasi_model->updateNilaiHargaSup($data, $kd_material, $nm_material);
        } else {
        }

        // proses update nilai kriteria kualitas pada evaluasi disetiap material 
        if ($data['kualitas']['batubara'] != 0) {
            $kd_material = "mtr-001";
            $nm_material = "batubara";
            $this->Evaluasi_model->updateNilaiKualitasSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['kualitas']['silica'] != 0) {
            $kd_material = "mtr-002";
            $nm_material = "silica";
            $this->Evaluasi_model->updateNilaiKualitasSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['kualitas']['gypsum'] != 0) {
            $kd_material = "mtr-003";
            $nm_material = "gypsum";
            $this->Evaluasi_model->updateNilaiKualitasSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['kualitas']['clay'] != 0) {
            $kd_material = "mtr-004";
            $nm_material = "clay";
            $this->Evaluasi_model->updateNilaiKualitasSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['kualitas']['chipping'] != 0) {
            $kd_material = "mtr-005";
            $nm_material = "chipping";
            $this->Evaluasi_model->updateNilaiKualitasSup($data, $kd_material, $nm_material);
        } else {
        }

        // proses update nilai kriteria kuantitas pada evaluasi disetiap material 
        if ($data['kuantitas']['batubara'] != 0) {
            $kd_material = "mtr-001";
            $nm_material = "batubara";
            $this->Evaluasi_model->updateNilaiKuantitasSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['kuantitas']['silica'] != 0) {
            $kd_material = "mtr-002";
            $nm_material = "silica";
            $this->Evaluasi_model->updateNilaiKuantitasSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['kuantitas']['gypsum'] != 0) {
            $kd_material = "mtr-003";
            $nm_material = "gypsum";
            $this->Evaluasi_model->updateNilaiKuantitasSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['kuantitas']['clay'] != 0) {
            $kd_material = "mtr-004";
            $nm_material = "clay";
            $this->Evaluasi_model->updateNilaiKuantitasSup($data, $kd_material, $nm_material);
        } else {
        }

        if ($data['kuantitas']['chipping'] != 0) {
            $kd_material = "mtr-005";
            $nm_material = "chipping";
            $this->Evaluasi_model->updateNilaiKuantitasSup($data, $kd_material, $nm_material);
        } else {
        }

        $data = array(
            'title'         =>  "Selesai",
            'isi'           =>  "suplier/informasi"
        );

        $this->load->view('layout/wrapper', $data, FALSE);

    }

}

/* End of file Suplier.php */
