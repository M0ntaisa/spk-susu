<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {

    public function insertHistory($history, $detail_history)
    {
        
        //Cek apakah ada history dengan Kode sama
        $filter = $this->db->select('*')->from('tb_history')->where('kd_history', $history['kd_history'])->get()->num_rows();
        if ($filter < 1) {

            $insert = $this->db->insert('tb_history', $history);
            if ($insert) {
                // memasukkan semua data dalam array ke dalam tb_detail_history
                $this->db->insert_batch('tb_detail_history', $detail_history);
            } else {
               // set flashdata
                $this->session->set_flashdata('warning', 'Terjadi Kesahalan Saat Insert Detail History.');
                redirect(base_url('admin/algoritma'));
            }
            
        } else {
            // set flashdata
            $this->session->set_flashdata('warning', 'Data History Dobel.');
            redirect(base_url('admin/algoritma'));
        }
        
    }

    // mengambil history yang rank 1
    public function getHistoryByRank()
    {
        $query = $this->db->query("SELECT
        tb_history.id_history,
        tb_history.kd_history,
        tb_history.time_proc,
        tb_detail_history.kd_alternatif,
        tb_alternatif.nama,
        tb_detail_history.point
        FROM
        tb_history
        INNER JOIN tb_detail_history ON tb_detail_history.kd_history = tb_history.kd_history
        INNER JOIN tb_alternatif ON tb_alternatif.kd_alternatif = tb_detail_history.kd_alternatif
        WHERE
        tb_detail_history.rank = '1'
        ORDER BY
        tb_history.id_history ASC
        ");
        
        return $query->result_array();
    }

    // mengambil history berdasarkan alternatif
    public function getEachHistory($kd_alternatif)
    {
        $query = $this->db->query("SELECT
        tb_history.id_history,
        tb_history.kd_history,
        tb_history.time_proc,
        tb_detail_history.kd_alternatif,
        tb_alternatif.nama,
        tb_detail_history.point,
        tb_detail_history.rank
        FROM
        tb_history
        INNER JOIN tb_detail_history ON tb_detail_history.kd_history = tb_history.kd_history
        INNER JOIN tb_alternatif ON tb_alternatif.kd_alternatif = tb_detail_history.kd_alternatif
        WHERE
        tb_detail_history.kd_alternatif = '$kd_alternatif'
        ORDER BY
        tb_history.id_history ASC
        ");
        
        return $query->result_array();
        
    }

}

/* End of file History_model.php */
