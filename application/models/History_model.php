<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {

    public function insertHistory($kd_material, $data_wp)
    {
        // kode history
        $a = '';
        for ($i = 0; $i<3; $i++) 
        {
            $a .= mt_rand(0,9);
        }
        $kd_history = "HS00".$a;

        $history = array();
        for ($i=0; $i < count($data_wp); $i++) { 
            $rank = $i+1;
            $history[$i]['kd_history'] = $kd_history;
            $history[$i]['kd_material'] = $kd_material;
            $history[$i]['kd_suplier'] = $data_wp[$i]['kd_suplier'];
            $history[$i]['nm_suplier'] = $data_wp[$i]['nm_suplier'];
            $history[$i]['vektor_v'] = $data_wp[$i]['vektor_v'];
            $history[$i]['rank'] = "Rank $rank";
        }
        // echo "<pre>";
        // print_r($history);exit;
        $this->db->where('kd_material', $kd_material);
        $this->db->delete('tb_history');

        if ($history == null) {
            // set flashdata
            $this->session->set_flashdata('warning', 'Tidak ada suplier yang menyuplai material yang anda pilih.');
            redirect(base_url('admin/alternatif/hasil_wp'));
        } else {
            $batch = $this->db->insert_batch('tb_history', $history);
        }
        
    }

    // mengambil history yang rank 1
    public function getHistoryByRank()
    {
        $this->db->select('*,tb_material.nama_material');
        $this->db->from('tb_history');
        $this->db->where('rank', 'Rank 1');
        $this->db->join('tb_material', 'tb_history.kd_material = tb_material.kd_material', 'left');
        
        
        $query = $this->db->get();
        return $query->result_array();
    }

    // mengambil history berdasarkan jenis material
    public function getHistoryByMaterial($kd_material)
    {
        return $this->db->select('*')->from('tb_history')->where('kd_material', $kd_material)->get()->result_array();
        
    }

}

/* End of file History_model.php */
