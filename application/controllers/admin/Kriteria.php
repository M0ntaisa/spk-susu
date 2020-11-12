<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        $this->auth->cek_login();
        // load model kriteria
        $this->load->model('Kriteria_model');
        
    }

    public function index()
    {
        $kriteria = $this->Kriteria_model->getKriteria();
        
        $data = array(  
            'title'     =>      'Kriteria | Administrator',
            'subtitle'  =>      'Data Kriteria',
            'kriteria'  =>      $kriteria,
            'isi'       =>      'admin/kriteria/data kriteria/list' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function subkriteria()
    {
        $data = array(  
            'title'     =>      'Kriteria | Administrator',
            'subtitle'  =>      'Subkriteria',
            'isi'       =>      'admin/kriteria/subkriteria/list' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

}

/* End of file Kriteria.php */
