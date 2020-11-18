<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi_model extends CI_Model {

    // fungsi get data evaluasi dengan kd_suplier
    public function getDataEval($kd_alternatif, $id_kriteria)
    {
        $query = $this->db->query("SELECT
        kd_subkriteria
        FROM
        tb_evaluasi
        WHERE
        tb_evaluasi.kd_alternatif = '$kd_alternatif' AND tb_evaluasi.id_kriteria = '$id_kriteria'
        ORDER BY
        tb_evaluasi.id_evaluasi ASC
        ");
        return $query->row_array();
    }

    // fungsi get data evaluasi dengan kd_suplier
    public function getEvalEachAlt($kd_alternatif)
    {
        $query = $this->db->query("SELECT
        tb_evaluasi.id_evaluasi,
        tb_evaluasi.kd_subkriteria,
        tb_subkriteria.kd_kriteria,
        tb_kriteria.nm_kriteria,
        tb_subkriteria.nm_subkriteria
        FROM
        tb_evaluasi
        INNER JOIN tb_subkriteria ON tb_subkriteria.kd_subkriteria = tb_evaluasi.kd_subkriteria
        INNER JOIN tb_kriteria ON tb_kriteria.kd_kriteria = tb_subkriteria.kd_kriteria
        WHERE
        tb_evaluasi.kd_alternatif = '$kd_alternatif'
        ORDER BY
        tb_evaluasi.id_evaluasi ASC
        ");
        return $query->result_array();
    }

    // fungsi get data evaluasi dengan kd_suplier
    public function getDataEvalKuantitas($kd_suplier)
    {
        $query = $this->db->query("SELECT
        tb_evaluasi.id_evaluasi,
        tb_evaluasi.kd_material,
        tb_evaluasi.kd_kriteria,
        tb_evaluasi.kd_suplier,
        tb_evaluasi.nilai,
        tb_material.nama_material,
        tb_kriteria.nm_kriteria,
        tb_subkriteria.`value`,
        tb_subkriteria.ket
        FROM
        tb_evaluasi
        INNER JOIN tb_material ON tb_evaluasi.kd_material = tb_material.kd_material
        INNER JOIN tb_kriteria ON tb_evaluasi.kd_kriteria = tb_kriteria.kd_kriteria
        INNER JOIN tb_subkriteria ON tb_subkriteria.kd_kriteria = tb_kriteria.kd_kriteria AND tb_subkriteria.kd_material = tb_material.kd_material
        WHERE
        tb_evaluasi.kd_suplier = '$kd_suplier'AND tb_evaluasi.kd_kriteria = 'krt-003'
        ORDER BY
        tb_evaluasi.id_evaluasi ASC
        ");
        return $query->result_array();
    }

    public function getEvalWhere($kd_material, $kd_suplier)
    {
        $this->db->select('kd_kriteria, nilai');
        $this->db->from('tb_evaluasi');
        $this->db->where('kd_suplier', $kd_suplier);
        $this->db->where('kd_material', $kd_material);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    // fungsi update nilai pada tabel evaluasi admin
    public function updateNilaiHarga($data)
    {
        $harga = array(
            'nilai'     =>  $data['harga']
        );

        $this->db->where('kd_suplier', $data['kd_suplier']);
        $this->db->where('kd_material', $data['kd_material']);
        $this->db->where('kd_kriteria', 'krt-001');
        $this->db->update('tb_evaluasi', $harga);
    }
    public function updateNilaiKualitas($data)
    {
        $kualitas = array(
            'nilai'     =>  $data['kualitas']
        );

        $this->db->where('kd_suplier', $data['kd_suplier']);
        $this->db->where('kd_material', $data['kd_material']);
        $this->db->where('kd_kriteria', 'krt-002');
        $this->db->update('tb_evaluasi', $kualitas);
    }
    public function updateNilaiKuantitas($data)
    {
        $kuantitas = array(
            'nilai'     =>  $data['kuantitas']
        );

        $this->db->where('kd_suplier', $data['kd_suplier']);
        $this->db->where('kd_material', $data['kd_material']);
        $this->db->where('kd_kriteria', 'krt-003');
        $this->db->update('tb_evaluasi', $kuantitas);
    }

    // fungsi update nilai pada tabel evaluasi suplier
    public function updateNilaiHargaSup($data, $kd_material, $nm_material)
    {
        $harga = array(
            'nilai'     =>  $data['harga']["$nm_material"]
        );

        $this->db->where('kd_suplier', $data['kd_suplier']);
        $this->db->where('kd_material', $kd_material);
        $this->db->where('kd_kriteria', 'krt-001');
        $this->db->update('tb_evaluasi', $harga);
    }
    public function updateNilaiKualitasSup($data, $kd_material, $nm_material)
    {
        $kualitas = array(
            'nilai'     =>  $data['kualitas']["$nm_material"]
        );

        $this->db->where('kd_suplier', $data['kd_suplier']);
        $this->db->where('kd_material', $kd_material);
        $this->db->where('kd_kriteria', 'krt-002');
        $this->db->update('tb_evaluasi', $kualitas);
    }
    public function updateNilaiKuantitasSup($data, $kd_material, $nm_material)
    {
        $kuantitas = array(
            'nilai'     =>  $data['kuantitas']["$nm_material"]
        );

        $this->db->where('kd_suplier', $data['kd_suplier']);
        $this->db->where('kd_material', $kd_material);
        $this->db->where('kd_kriteria', 'krt-003');
        $this->db->update('tb_evaluasi', $kuantitas);
    }

    // mengambil data evaluasi where kd_material
    public function getEvalHarga($kd_material,$kd_harga)
    {
        $query = $this->db->select('tb_evaluasi.kd_suplier,tb_suplier.nm_suplier, tb_evaluasi.nilai')->from('tb_evaluasi')->join('tb_suplier', 'tb_evaluasi.kd_suplier=tb_suplier.kd_suplier')->where('kd_material', $kd_material)->where('kd_kriteria', $kd_harga)->get();

        return $query->result_array();
        
    }
    public function getEvalKualitas($kd_material,$kd_kualitas)
    {
        $query = $this->db->select('tb_evaluasi.kd_suplier,tb_suplier.nm_suplier, tb_evaluasi.nilai')->from('tb_evaluasi')->join('tb_suplier', 'tb_evaluasi.kd_suplier=tb_suplier.kd_suplier')->where('kd_material', $kd_material)->where('kd_kriteria', $kd_kualitas)->get();

        return $query->result_array();
        
    }
    public function getEvalKuantitas($kd_material,$kd_kuantitas)
    {
        $query = $this->db->select('tb_evaluasi.kd_suplier,tb_suplier.nm_suplier, tb_evaluasi.nilai')->from('tb_evaluasi')->join('tb_suplier', 'tb_evaluasi.kd_suplier=tb_suplier.kd_suplier')->where('kd_material', $kd_material)->where('kd_kriteria', $kd_kuantitas)->get();

        return $query->result_array();
        
    }

}

/* End of file Evaluasi_model.php */
