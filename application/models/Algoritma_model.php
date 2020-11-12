<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Algoritma_model extends CI_Model {

    // fungsi get data evaluasi dengan
    public function getDataEval()
    {
        $query = $this->db->query("SELECT tb_evaluasi.*, tb_subkriteria.`value` 
                FROM tb_evaluasi 
                INNER JOIN tb_subkriteria ON tb_evaluasi.kd_subkriteria = tb_subkriteria.kd_subkriteria
                ORDER BY
                tb_evaluasi.kd_alternatif ASC,
                tb_evaluasi.id_kriteria ASC
                ");

        $X=array();
        $alternatif='';
        $m=0;
        foreach($query->result_array() as $row){
            if($row['kd_alternatif']!=$alternatif){
                $X[$row['kd_alternatif']]=array();
                $alternatif=$row['kd_alternatif'];
                ++$m;
            }
            $X[$row['kd_alternatif']][$row['id_kriteria']]=$row['value'];
        }
        return array($X,$m);
    }

    // fungsi mengambil bobot kriteria
    public function getBobotKriteria()
    {
        $query =$this->db->query("SELECT * FROM tb_kriteria ORDER BY id_kriteria");
    
        $criteria = array();
        foreach ($query->result_array() as $row) {
             
            $criteria[$row['id_kriteria']] = $row['weight'];

        }
        
        return $criteria;
    }

}

/* End of file Algoritma_model.php */
