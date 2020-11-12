<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria_model extends CI_Model {

    public function getKriteria()
    {
        return $this->db->get('tb_kriteria')->result_array();
        
    }

    // fungsi mengambil bobot pref kriteria
    public function getBobot()
    {
        return $this->db->select('bobot_pref')->from('tb_kriteria')->get()->result_array();
    }

}

/* End of file Kriteria_model.php */
