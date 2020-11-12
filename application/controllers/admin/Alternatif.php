<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        $this->auth->cek_login();

        // load model
        $this->load->model('Suplier_model');
        $this->load->model('Evaluasi_model');
        $this->load->model('Kriteria_model');
        $this->load->model('Subkriteria_model');
        $this->load->model('History_model');

        // load helper
        $this->load->helper('date');
        
    }

    public function index()
    {
        // $material = $this->Suplier_model->getMaterial();
        if ($_POST) {

            $match = $this->input->post('material');
            // mengambil data suplier sesuai dengan kd_material
            $suplier = $this->Suplier_model->getSupLike($match);
            // membuat array evaluasi
            $eval = array();
            // memanggil data pada table evaluasi dan memasukkannya ke dalam array
            for ($i=0; $i < count($suplier); $i++) { 
                $x = $this->Evaluasi_model->getEvalWhere($match, $suplier[$i]['kd_suplier']);
                $eval[] = $x;
            }

            // membuat var subkriteria
            $subkrit = array();
            // memanggil data dari table subkriteria
            for ($i=0; $i < count($suplier) ; $i++) { 
                for ($j=0; $j < 3 ; $j++) { 
                    $y = $this->Subkriteria_model->getSubkriteria($eval[$i][$j]['kd_kriteria'], $match);
                    $subkrit[$i][] = $y;
                }
            }

            // membuat array hasil
            $hasil = array();
            // menjadikan value kd_kriteria sebagai key dan value nilai menjadi valuenya kemudian memasukkan ke array hasil
            for ($i=0; $i < count($eval) ; $i++) { 
                for ($j=0; $j < 3; $j++) { 
                    $x = $eval[$i][$j]['kd_kriteria'];
                    $y = $eval[$i][$j]['nilai'];
                    $z = array(
                        "$x"    => $y
                    );
                    $hasil[$i][] = $z;
                }
            }

            // menggabung array hasil dengan array subkriteria
            for ($i=0; $i < count($suplier) ; $i++) { 
                    $x = array_merge($hasil[$i], $subkrit[$i]);
                    $hasil_1[$i][] = $x;
            }

            // membuat array arr
            $arr = array();
            // menggabungkan array suplier dengan array hasil lalu memasukkannya ke dalam array arr
            for ($i=0; $i < count($suplier) ; $i++) { 
                    $campur = array_merge($suplier[$i],$hasil_1[$i]);
                    $arr[] = $campur;
            }
            
            if (count($arr) == 0) {
                // set flashdata
                $this->session->set_flashdata('warning', 'Tidak ada suplier yang menyuplai material yang anda pilih.');
                redirect(base_url('admin/alternatif'));
            } else {
                $data = array(  
                    'title'     =>      'Alternatif | Administrator',
                    'subtitle'  =>      'Evaluasi',
                    'suplier'   =>      $arr,
                    'material'  =>      $match,
                    'isi'       =>      'admin/alternatif/evaluasi/data_sup' 
                );
        
                $this->load->view('admin/layout/wrapper', $data, FALSE);
            }
            
        }

        $data = array(  
            'title'     =>      'Alternatif | Administrator',
            'subtitle'  =>      'Evaluasi',
            'isi'       =>      'admin/alternatif/evaluasi/list' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // fungsi update nilai pada table evaluasi
    public function update_nilai()
    {
        
        $data = array (
            'kd_suplier'    =>  $this->input->post('kd_suplier'),
            'kd_material'   =>  $this->input->post('kd_material'),
            'harga'         =>  $this->input->post('harga'),
            'kualitas'      =>  $this->input->post('kualitas'),
            'kuantitas'     =>  $this->input->post('kuantitas')
        );
        
        $harga      = $this->Evaluasi_model->updateNilaiHarga($data);
        $kualitas   = $this->Evaluasi_model->updateNilaiKualitas($data);
        $kuantitas  = $this->Evaluasi_model->updateNilaiKuantitas($data);

            $match = $this->input->post('kd_material');
            // mengambil data suplier sesuai dengan kd_material
            $suplier = $this->Suplier_model->getSupLike($match);
            
            // membuat array evaluasi
            $eval = array();
            // memanggil data pada table evaluasi dan memasukkannya ke dalam array
            for ($i=0; $i < count($suplier); $i++) { 
                $x = $this->Evaluasi_model->getEvalWhere($match, $suplier[$i]['kd_suplier']);
                $eval[] = $x;
            }
            
            // membuat var subkriteria
            $subkrit = array();
            // memanggil data dari table subkriteria
            for ($i=0; $i < count($suplier) ; $i++) { 
                for ($j=0; $j < 3 ; $j++) { 
                    $y = $this->Subkriteria_model->getSubkriteria($eval[$i][$j]['kd_kriteria'], $match);
                    $subkrit[$i][] = $y;
                }
            }
            
            // membuat array hasil
            $hasil = array();
            // menjadikan value kd_kriteria sebagai key dan value nilai menjadi valuenya kemudian memasukkan ke array hasil
            for ($i=0; $i < count($eval) ; $i++) { 
                for ($j=0; $j < 3; $j++) { 
                    $x = $eval[$i][$j]['kd_kriteria'];
                    $y = $eval[$i][$j]['nilai'];
                    $z = array(
                        "$x"    => $y
                    );
                    $hasil[$i][] = $z;
                }
            }
            
            $hasil_1 = array();
            // menggabung array hasil dengan array subkriteria
            for ($i=0; $i < count($suplier) ; $i++) { 
                    $x = array_merge($hasil[$i], $subkrit[$i]);
                    $hasil_1[$i][] = $x;
            }
            
            // membuat array arr
            $arr = array();
            // menggabungkan array suplier dengan array hasil lalu memasukkannya ke dalam array arr
            for ($i=0; $i < count($suplier) ; $i++) { 
                    $campur = array_merge($suplier[$i],$hasil_1[$i]);
                    $arr[] = $campur;
            }
            
            $data = array(  
                'title'     =>      'Alternatif | Administrator',
                'subtitle'  =>      'Evaluasi',
                'suplier'   =>      $arr,
                'material'  =>      $match,
                'isi'       =>      'admin/alternatif/evaluasi/data_sup' 
            );
            
            // set flashdata
            $this->session->set_flashdata('sukses', 'Data Evaluasi Telah Diupdate');
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        
        // set flashdata
        // $this->session->set_flashdata('sukses', 'Data Evaluasi Telah Diupdate');
        // redirect(base_url('admin/alternatif'));
    }

    public function hasil_wp()
    {
        // jika material telah dipilih
        if ($_POST) {
            
            // ambil kode material yang telah dipilih
            $kd_material = $this->input->post('material');
            // mengambil bobot preferensi pada table kriteria
            $bobot_pref = $this->Kriteria_model->getBobot();

            $kd_harga       = 'krt-001';
            $kd_kualitas    = 'krt-002';
            $kd_kuantitas   = 'krt-003';
            
            // mengambil nilai masing material
            $eval_harga     = $this->Evaluasi_model->getEvalHarga($kd_material,$kd_harga);
            $eval_kualitas  = $this->Evaluasi_model->getEvalKualitas($kd_material,$kd_kualitas);
            $eval_kuantitas = $this->Evaluasi_model->getEvalkuantitas($kd_material,$kd_kuantitas);
            
            // membuat array pangkat setiap material dan memangkatkan nilai material dengan bobot pref
            $pangkat_harga = array();
            $pangkat_kualitas = array();
            $pangkat_kuantitas = array();
            for ($i=0; $i < count($eval_harga) ; $i++) { 
                $pangkat_harga[$i]['hasil'] = pow($eval_harga[$i]['nilai'],$bobot_pref[0]['bobot_pref']);
            }
            for ($i=0; $i < count($eval_harga) ; $i++) { 
                $pangkat_kualitas[$i]['hasil'] = pow($eval_kualitas[$i]['nilai'],$bobot_pref[1]['bobot_pref']);
            }
            for ($i=0; $i < count($eval_harga) ; $i++) { 
                $pangkat_kuantitas[$i]['hasil'] = pow($eval_kuantitas[$i]['nilai'],$bobot_pref[2]['bobot_pref']);
            }

            // membuat array vektor s dan mencari nilai vektor s setiap suplier
            $vektor_s = array();
            for ($i=0; $i < count($pangkat_harga) ; $i++) { 
                $vektor_s[$i]['hasil'] = $pangkat_harga[$i]['hasil']*$pangkat_kualitas[$i]['hasil']*$pangkat_kuantitas[$i]['hasil'];
            }

            //Menghitung Total Nilai Vektor S
            $total_vektor_s = 0;
            foreach ($vektor_s as $num => $values) {
                $total_vektor_s += $values['hasil'];
            }

            if ($total_vektor_s == 0) {
                // set flashdata
                $this->session->set_flashdata('warning', 'Tidak ada suplier yang menyuplai material yang anda pilih.');
                redirect(base_url('admin/alternatif/hasil_wp'));
            }

            //Menghitung Nilai Vektor V dengan Membagi Nilai Vektor S suplier dengan Total Vektor S
            $vektor_v = array();
            for($x=0;$x<count($vektor_s);$x++){
                $vektor_v[$x]['hasil'] = $vektor_s[$x]['hasil']/$total_vektor_s;
            }
            
            // memasukkan semua data suplier, vektor s dan vektor v ke dalam array
            $data_wp = array();
            for ($i=0; $i < count($eval_harga); $i++) { 
                $data_wp[$i]['kd_suplier'] = $eval_harga[$i]['kd_suplier'];
                $data_wp[$i]['nm_suplier'] = $eval_harga[$i]['nm_suplier'];
                $data_wp[$i]['vektor_s'] = $vektor_s[$i]['hasil'];
                $data_wp[$i]['vektor_v'] = $vektor_v[$i]['hasil'];
            }
            
            // mengurutkan nilai vektor v dari yg lbh tinggi ke rendah.
            usort($data_wp, function($a, $b) {
                if ($a['vektor_v'] == $b['vektor_v'])
                    return 0;
                return $a['vektor_v'] < $b['vektor_v'] ? 1 : -1;
            });
            
            $this->History_model->insertHistory($kd_material, $data_wp);

            // echo "<pre>";
            // print_r($data_wp);
            // print_r($history);exit;
            if (count($data_wp) == 0) {
                // set flashdata
                $this->session->set_flashdata('warning', 'Tidak ada suplier yang menyuplai material yang anda pilih.');
                redirect(base_url('admin/alternatif/hasil_wp'));
            } else {
                $data = array(  
                    'title'     =>      'Alternatif | Administrator',
                    'subtitle'  =>      'Evaluasi',
                    'data_wp'   =>      $data_wp,
                    'material'  =>      $kd_material,
                    'isi'       =>      'admin/alternatif/hasil wp/data_hasil' 
                );
        
                $this->load->view('admin/layout/wrapper', $data, FALSE);
            }

        }
        $data = array(  
            'title'     =>      'Alternatif | Administrator',
            'subtitle'  =>      'Hasil Weight Product',
            'isi'       =>      'admin/alternatif/hasil wp/list' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // detail history
    public function detail()
    {
        $kd_material = $_GET['kd_material'];
        // ambil nama material dalam tabel
        $material = $this->Suplier_model->getMaterial($kd_material);
        // ambil data history
        $history = $this->History_model->getHistoryByMaterial($kd_material);

        $data = array(
            'title'     =>      'History | Administrator',
            'subtitle'  =>      'Detail History '.$material,
            'material'  =>      $material,
            'detail'    =>      $history,
            'isi'       =>      'admin/laporan/detail'
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
        
    }

    // cetak laporan
    public function cetak()
    {
        // ambil kode material yang telah dipilih
        $kd_material = $_GET['kd_material'];
        // ambil nama material dalam tabel
        $material = $this->Suplier_model->getMaterial($kd_material);
        // mengambil bobot preferensi pada table kriteria
        $bobot_pref = $this->Kriteria_model->getBobot();

        $kd_harga       = 'krt-001';
        $kd_kualitas    = 'krt-002';
        $kd_kuantitas   = 'krt-003';

        // mengambil nilai masing material
        $eval_harga     = $this->Evaluasi_model->getEvalHarga($kd_material,$kd_harga);
        $eval_kualitas  = $this->Evaluasi_model->getEvalKualitas($kd_material,$kd_kualitas);
        $eval_kuantitas = $this->Evaluasi_model->getEvalkuantitas($kd_material,$kd_kuantitas);
        
        // membuat array pangkat setiap material dan memangkatkan nilai material dengan bobot pref
        $pangkat_harga = array();
        $pangkat_kualitas = array();
        $pangkat_kuantitas = array();
        for ($i=0; $i < count($eval_harga) ; $i++) { 
            $pangkat_harga[$i]['hasil'] = pow($eval_harga[$i]['nilai'],$bobot_pref[0]['bobot_pref']);
        }
        for ($i=0; $i < count($eval_harga) ; $i++) { 
            $pangkat_kualitas[$i]['hasil'] = pow($eval_kualitas[$i]['nilai'],$bobot_pref[1]['bobot_pref']);
        }
        for ($i=0; $i < count($eval_harga) ; $i++) { 
            $pangkat_kuantitas[$i]['hasil'] = pow($eval_kuantitas[$i]['nilai'],$bobot_pref[2]['bobot_pref']);
        }

        // membuat array vektor s dan mencari nilai vektor s setiap suplier
        $vektor_s = array();
        for ($i=0; $i < count($pangkat_harga) ; $i++) { 
            $vektor_s[$i]['hasil'] = $pangkat_harga[$i]['hasil']*$pangkat_kualitas[$i]['hasil']*$pangkat_kuantitas[$i]['hasil'];
        }

        //Menghitung Total Nilai Vektor S
        $total_vektor_s = 0;
        foreach ($vektor_s as $num => $values) {
            $total_vektor_s += $values['hasil'];
        }

        //Menghitung Nilai Vektor V dengan Membagi Nilai Vektor S suplier dengan Total Vektor S
        $vektor_v = array();
        for($x=0;$x<count($vektor_s);$x++){
            $vektor_v[$x]['hasil'] = $vektor_s[$x]['hasil']/$total_vektor_s;
        }
        
        // memasukkan semua data suplier, vektor s dan vektor v ke dalam array
        $data_wp = array();
        for ($i=0; $i < count($eval_harga); $i++) { 
            $data_wp[$i]['kd_suplier'] = $eval_harga[$i]['kd_suplier'];
            $data_wp[$i]['nm_suplier'] = $eval_harga[$i]['nm_suplier'];
            $data_wp[$i]['vektor_s'] = $vektor_s[$i]['hasil'];
            $data_wp[$i]['vektor_v'] = $vektor_v[$i]['hasil'];
        }
        
        // mengurutkan nilai vektor v dari yg lbh tinggi ke rendah.
        usort($data_wp, function($a, $b) {
            if ($a['vektor_v'] == $b['vektor_v'])
                return 0;
            return $a['vektor_v'] < $b['vektor_v'] ? 1 : -1;
        });

        if (count($data_wp) == 0) {
            // set flashdata
            $this->session->set_flashdata('warning', 'Tidak ada suplier yang menyuplai material yang anda pilih.');
            redirect(base_url('admin/alternatif/hasil_wp'));
        } else {
            $data = array(  
                'title'         =>      'Alternatif | Administrator',
                'subtitle'      =>      'Cetak Laporan',
                'data_wp'       =>      $data_wp,
                'material'      =>      $kd_material,
                'nm_material'   =>      $material,
                'isi'           =>      'admin/alternatif/hasil wp/cetak/cetak'
            );

            $this->load->view('admin/layout/wrapper', $data, FALSE);

            // $html = $this->load->view('admin/alternatif/hasil wp/cetak', $data, TRUE);
            // // Create an instance of the class:
            // $mpdf = new \Mpdf\Mpdf();

            // // Define the Header before writing anything so they appear on the first page
            // $mpdf->SetHTMLHeader($this->load->view('admin/alternatif/hasil wp/laporan/header', $data, TRUE));
            // // Write some HTML code:
            // $mpdf->WriteHTML($html);
            // // Define the Footer 
            // $mpdf->SetHTMLFooter($this->load->view('admin/alternatif/hasil wp/laporan/footer', $data, TRUE));

            // // Output a PDF file directly to the browser
            // $nama_file_pdf = url_title("Laporan Hasil $material",'dash','true').'-'.date('j-m-y').'.pdf';
            // $mpdf->Output($nama_file_pdf,'I');
        }
    }

    // unduh laporan
    public function unduh()
    {
        // ambil kode material yang telah dipilih
        $kd_material = $_GET['kd_material'];
        // ambil nama material dalam tabel
        $material = $this->Suplier_model->getMaterial($kd_material);
        // mengambil bobot preferensi pada table kriteria
        $bobot_pref = $this->Kriteria_model->getBobot();

        $kd_harga       = 'krt-001';
        $kd_kualitas    = 'krt-002';
        $kd_kuantitas   = 'krt-003';

        // mengambil nilai masing material
        $eval_harga     = $this->Evaluasi_model->getEvalHarga($kd_material,$kd_harga);
        $eval_kualitas  = $this->Evaluasi_model->getEvalKualitas($kd_material,$kd_kualitas);
        $eval_kuantitas = $this->Evaluasi_model->getEvalkuantitas($kd_material,$kd_kuantitas);
        
        // membuat array pangkat setiap material dan memangkatkan nilai material dengan bobot pref
        $pangkat_harga = array();
        $pangkat_kualitas = array();
        $pangkat_kuantitas = array();
        for ($i=0; $i < count($eval_harga) ; $i++) { 
            $pangkat_harga[$i]['hasil'] = pow($eval_harga[$i]['nilai'],$bobot_pref[0]['bobot_pref']);
        }
        for ($i=0; $i < count($eval_harga) ; $i++) { 
            $pangkat_kualitas[$i]['hasil'] = pow($eval_kualitas[$i]['nilai'],$bobot_pref[1]['bobot_pref']);
        }
        for ($i=0; $i < count($eval_harga) ; $i++) { 
            $pangkat_kuantitas[$i]['hasil'] = pow($eval_kuantitas[$i]['nilai'],$bobot_pref[2]['bobot_pref']);
        }

        // membuat array vektor s dan mencari nilai vektor s setiap suplier
        $vektor_s = array();
        for ($i=0; $i < count($pangkat_harga) ; $i++) { 
            $vektor_s[$i]['hasil'] = $pangkat_harga[$i]['hasil']*$pangkat_kualitas[$i]['hasil']*$pangkat_kuantitas[$i]['hasil'];
        }

        //Menghitung Total Nilai Vektor S
        $total_vektor_s = 0;
        foreach ($vektor_s as $num => $values) {
            $total_vektor_s += $values['hasil'];
        }

        //Menghitung Nilai Vektor V dengan Membagi Nilai Vektor S suplier dengan Total Vektor S
        $vektor_v = array();
        for($x=0;$x<count($vektor_s);$x++){
            $vektor_v[$x]['hasil'] = $vektor_s[$x]['hasil']/$total_vektor_s;
        }
        
        // memasukkan semua data suplier, vektor s dan vektor v ke dalam array
        $data_wp = array();
        for ($i=0; $i < count($eval_harga); $i++) { 
            $data_wp[$i]['kd_suplier'] = $eval_harga[$i]['kd_suplier'];
            $data_wp[$i]['nm_suplier'] = $eval_harga[$i]['nm_suplier'];
            $data_wp[$i]['vektor_s'] = $vektor_s[$i]['hasil'];
            $data_wp[$i]['vektor_v'] = $vektor_v[$i]['hasil'];
        }
        
        // mengurutkan nilai vektor v dari yg lbh tinggi ke rendah.
        usort($data_wp, function($a, $b) {
            if ($a['vektor_v'] == $b['vektor_v'])
                return 0;
            return $a['vektor_v'] < $b['vektor_v'] ? 1 : -1;
        });

        if (count($data_wp) == 0) {
            // set flashdata
            $this->session->set_flashdata('warning', 'Tidak ada suplier yang menyuplai material yang anda pilih.');
            redirect(base_url('admin/alternatif/hasil_wp'));
        } else {
            $data = array(  
                'title'         =>      'Alternatif | Administrator',
                'subtitle'      =>      'Evaluasi',
                'data_wp'       =>      $data_wp,
                'material'      =>      $kd_material,
                'nm_material'   =>      $material,
            );

            $html = $this->load->view('admin/alternatif/hasil wp/laporan/isi', $data, TRUE);
            // Create an instance of the class:
            $mpdf = new \Mpdf\Mpdf();

            // Define the Header before writing anything so they appear on the first page
            $mpdf->SetHTMLHeader($this->load->view('admin/alternatif/hasil wp/laporan/header', $data, TRUE));
            // Write some HTML code:
            $mpdf->WriteHTML($html);
            // Define the Footer 
            $mpdf->SetHTMLFooter($this->load->view('admin/alternatif/hasil wp/laporan/footer', $data, TRUE));

            // Output a PDF file directly to the browser
            $nama_file_pdf = url_title("Laporan Hasil $material",'dash','true').'-'.date('j-m-y').'.pdf';
            $mpdf->Output($nama_file_pdf,'I');
        }
    }

}

/* End of file Alternatif.php */
