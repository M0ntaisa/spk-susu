<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier_model extends CI_Model {

    //Fungsi Lihat Data Alternatif
    public function getSuplier() {
        return $this->db->get('tb_suplier')->result_array();
    }

    // fungsi get kd mat pada table transmat
    public function getSuratUsaha($kd_suplier)
    {
        $this->db->select('surat_usaha');
        $this->db->from('tb_suplier');
        $this->db->where('kd_suplier', $kd_suplier);
        $query = $this->db->get();
        return $query->result_array();
    }

    // fungsi get kd mat pada table transmat
    public function getTransmat($kd_suplier)
    {
        $this->db->select('kd_material');
        $this->db->from('tb_transmat');
        $this->db->where('kd_suplier', $kd_suplier);
        $query = $this->db->get();
        return $query->result_array();
    }

    // fungsi get material
    public function getMaterial($kd_material)
    {
        $this->db->distinct();
        $this->db->select('nama_material');
        $this->db->from('tb_material');
        $this->db->where('kd_material', $kd_material);
        $query = $this->db->get();
        $result = $query->row();
        return $result->nama_material;
    }

    // fungsi get kd and nama suplier
    public function getSupLike($match)
    {
        $this->db->select('kd_suplier, nm_suplier');
        $this->db->from('tb_suplier');
        $this->db->like('material', $match);

        $query = $this->db->get();
        return $query->result_array();
    }

    // Fungsi tambah suplier
    public function tambahSuplier($data)   
    {
        //Cek apakah ada Suplier dengan Kode sama
        $filter = $this->db->select('*')->from('tb_suplier')->where('kd_suplier', $data['kd_suplier'])->get()->num_rows();
        if ($filter < 1) {
            $insert = $this->db->insert('tb_suplier', $data);
            if ($insert) {
                // mengubah string material menjadi array
                $material = explode(" ,", $data['material']);
                // mengambil data kriteria dalam database
                $kriteria = $this->db->select('kd_kriteria')->from('tb_kriteria')->get()->result_array();
                // membuat array data evaluasi
                $data_eval = array();
                // menyusun data kriteria, material dan suplier dalam 1 array
                for ($i=0; $i < count($material) ; $i++) { 
                    for ($j=0; $j < count($kriteria) ; $j++) { 
                        $x = array (
                            'kd_material'   =>  $material[$i],
                            'kd_kriteria'   =>  $kriteria[$j]['kd_kriteria'],
                            'kd_suplier'    =>  $data['kd_suplier']
                        );
                        $data_eval[] = $x; 
                    }
                }

                // memasukkan semua data dalam array ke dalam tb_evaluasi
                $this->db->insert_batch('tb_evaluasi', $data_eval);
                
            }
        } else {
            // set flashdata
            $this->session->set_flashdata('gagal', 'Data Suplier gagal ditambahkan.');
            redirect(base_url('admin/suplier'), 'refresh');
        }
        
        
    }

    // fungsi tambah transmat
    public function tambahTransmat($kd_suplier, $kd_material)
    {
        $data = array(
            'kd_suplier'    =>  $kd_suplier,
            'kd_material'   =>  $kd_material
        );

        $this->db->insert('tb_transmat', $data);
        
    }

    // fungsi edit suplier
    public function editSuplier($data)
    {
        $this->db->where('kd_suplier', $data['kd_suplier']);
        $update = $this->db->update('tb_suplier', $data);
        if ($update) {
            // mengubah string material menjadi array
            $material = explode(" ,", $data['material']);
            // mengambil data kriteria dalam database
            $kriteria = $this->db->select('kd_kriteria')->from('tb_kriteria')->get()->result_array();
            // membuat array data evaluasi
            $data_eval = array();
            // menyusun data kriteria, material dan suplier dalam 1 array
            for ($i=0; $i < count($material) ; $i++) { 
                for ($j=0; $j < count($kriteria) ; $j++) { 
                    $x = array (
                        'kd_material'   =>  $material[$i],
                        'kd_kriteria'   =>  $kriteria[$j]['kd_kriteria'],
                        'kd_suplier'    =>  $data['kd_suplier']
                    );
                    $data_eval[] = $x; 
                }
            }
            // echo "<pre>";print_r($data_eval);exit;
            // menghapus data suplier sebelum diinput pada table evaluasi
            $this->db->where('kd_suplier', $data['kd_suplier']);
            $delete = $this->db->delete('tb_evaluasi');
            // memasukkan semua data dalam array ke dalam tb_evaluasi
            if ($delete) {
                $batch = $this->db->insert_batch('tb_evaluasi', $data_eval);
            }
        }
    }

    // fungsi hapus suplier
    public function hapusSuplier($kd_suplier)
    {
        $this->db->delete('tb_suplier', ['kd_suplier' => $kd_suplier]);
    }

    // fungsi hapus suplier
    public function hapusTransmat($kd_suplier)
    {
        $this->db->delete('tb_transmat', ['kd_suplier' => $kd_suplier]);
    }

}

/* End of file Suplier_model.php */
