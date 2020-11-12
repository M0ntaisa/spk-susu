<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Peternak_model extends CI_Model {

    //Fungsi Lihat Data Alternatif
    public function getPeternak() {
        return $this->db->get('tb_alternatif')->result_array();
    }

    // Fungsi tambah kelompok ternak
    public function tambahKelpTernak($data, $kd_subkriteria)   
    {
        //Cek apakah ada kelompok ternak dengan Kode sama
        $filter = $this->db->select('*')->from('tb_alternatif')->where('kd_alternatif', $data['kd_alternatif'])->get()->num_rows();
        if ($filter < 1) {
            $insert = $this->db->insert('tb_alternatif', $data);
            if ($insert) {
                // mengambil data kriteria dalam database
                $kriteria = $this->db->select('id_kriteria')->from('tb_kriteria')->get()->result_array();
                // membuat array data evaluasi
                $data_eval = array();
                // menyusun data kriteria, material dan kelompok ternak dalam 1 array
                for ($j=0; $j < count($kriteria) ; $j++) { 
                    $x = array (
                        'kd_alternatif'    =>  $data['kd_alternatif'],
                        'id_kriteria'   =>  $kriteria[$j]['id_kriteria'],
                        'kd_subkriteria'=>  $kd_subkriteria[$j]
                    );
                    $data_eval[] = $x; 
                }

                // memasukkan semua data dalam array ke dalam tb_evaluasi
                $this->db->insert_batch('tb_evaluasi', $data_eval);
                
            }
        } else {
            // set flashdata
            $this->session->set_flashdata('gagal', 'Data Kelompok Ternak gagal ditambahkan.');
            redirect(base_url('admin/peternak'), 'refresh');
        }
        
        
    }

    // fungsi hapus kelp ternak
    public function hapusKlpTernak($kd_alternatif)
    {
        $this->db->delete('tb_alternatif', ['kd_alternatif' => $kd_alternatif]);
    }

}

/* End of file Peternak_model.php */
