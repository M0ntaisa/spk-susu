<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        $this->auth->cek_login();
        // load model
        $this->load->model('History_model');
        $this->load->model('Kriteria_model');
        $this->load->model('Pasien_model');
        $this->load->model('Evaluasi_model');
    }

    public function index()
    {
        // ambil data history
        $top_rank = $this->History_model->getHistoryByRank();

        $data = array(  
            'title'     =>      'Laporan | Administrator',
            'subtitle'  =>      'History Laporan',
            'top_rank'  =>      $top_rank,
            'isi'       =>      'admin/laporan/list' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function detail_laporan()
    {
        // get kd_alternatif
        $kd_alternatif = $_GET['kd_alternatif'];

        // mengambil nilai data kelompok dan kriteria dengan nilai evaluasinya
        $kriteria = $this->Kriteria_model->getKriteria();
        $klp_ternak = $this->Peternak_model->getEachKdNama($kd_alternatif);
        $rank = $this->History_model->getEachHistory($kd_alternatif);

        $eval_klp_ternak = array();
        for ($i=0; $i < count($klp_ternak); $i++) { 
            $eval_klp_ternak[] = $this->Evaluasi_model->getEvalEachAlt($kd_alternatif);
        }

        for ($i=0; $i < count($klp_ternak) ; $i++) { 
            $klp_ternak[$i]['evaluasi'] = $eval_klp_ternak[$i];
        }
        
        $data = array(  
            'title'     =>      'Detail | Administrator',
            'subtitle'  =>      'History Laporan',
            'kriteria'  =>      $kriteria,
            'klp_ternak'=>      $klp_ternak,
            'rank'      =>      $rank,      
            'isi'       =>      'admin/laporan/detail' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function cetak_laporan()
    {
        // get kd_alternatif
        $kd_alternatif = $_GET['kd_alternatif'];

        // mengambil nilai data kelompok dan kriteria dengan nilai evaluasinya
        $kriteria = $this->Kriteria_model->getKriteria();
        $klp_ternak = $this->Peternak_model->getEachKdNama($kd_alternatif);
        $rank = $this->History_model->getEachHistory($kd_alternatif);

        $eval_klp_ternak = array();
        for ($i=0; $i < count($klp_ternak); $i++) { 
            $eval_klp_ternak[] = $this->Evaluasi_model->getEvalEachAlt($kd_alternatif);
        }

        for ($i=0; $i < count($klp_ternak) ; $i++) { 
            $klp_ternak[$i]['evaluasi'] = $eval_klp_ternak[$i];
        }
        
        $data = array(  
            'title'     =>      'Detail | Administrator',
            'subtitle'  =>      'History Laporan',
            'kriteria'  =>      $kriteria,
            'klp_ternak'=>      $klp_ternak,
            'rank'      =>      $rank,      
            'isi'       =>      'admin/laporan/cetak_laporan/cetak' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function unduh_laporan()
    {
        // get kd_alternatif
        $kd_alternatif = $_GET['kd_alternatif'];

        // mengambil nilai data kelompok dan kriteria dengan nilai evaluasinya
        $kriteria = $this->Kriteria_model->getKriteria();
        $klp_ternak = $this->Peternak_model->getEachKdNama($kd_alternatif);
        $rank = $this->History_model->getEachHistory($kd_alternatif);

        // echo "<pre>";
        // print_r($klp_ternak);die;
        $eval_klp_ternak = array();
        for ($i=0; $i < count($klp_ternak); $i++) { 
            $eval_klp_ternak[] = $this->Evaluasi_model->getEvalEachAlt($kd_alternatif);
        }

        for ($i=0; $i < count($klp_ternak) ; $i++) { 
            $klp_ternak[$i]['evaluasi'] = $eval_klp_ternak[$i];
        }
        
        $data = array(  
            'title'     =>      'Detail | Administrator',
            'subtitle'  =>      'History Laporan',
            'kriteria'  =>      $kriteria,
            'klp_ternak'=>      $klp_ternak,
            'rank'      =>      $rank,      
            'isi'       =>      'admin/laporan/cetak_laporan/cetak' 
        );

        $nama_klp = $klp_ternak[0]['nama'];

        $html = $this->load->view('admin/laporan/unduh_laporan/isi', $data, TRUE);
        // Create an instance of the class:
        $mpdf = new \Mpdf\Mpdf();

        // Define the Header before writing anything so they appear on the first page
        $mpdf->SetHTMLHeader($this->load->view('admin/laporan/unduh_laporan/header', $data, TRUE));
        // Write some HTML code:
        $mpdf->WriteHTML($html);
        // Define the Footer 
        $mpdf->SetHTMLFooter($this->load->view('admin/laporan/unduh_laporan/footer', $data, TRUE));

        // Output a PDF file directly to the browser
        $nama_file_pdf = url_title("Laporan Hasil $nama_klp",'dash','true').'-'.date('j-m-y').'.pdf';
        $mpdf->Output($nama_file_pdf,'I');

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

}

/* End of file Laporan.php */
