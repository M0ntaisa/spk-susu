<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Algoritma extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        $this->auth->cek_login();
        // load model
        $this->load->model('Kriteria_model');
        $this->load->model('Algoritma_model');
        $this->load->model('Pasien_model');
        $this->load->model('History_model');
        $this->load->model('Evaluasi_model');
    }

    public function index()
    {
        $data = array(  
            'title'     =>      'Algoritma | Administrator',
            'subtitle'  =>      'Algoritma',
            'isi'       =>      'admin/algoritma/list' 
        );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function proses()
    {
        // SCRIPT UNTUK MENGAMBIL DATA PERBANDINGAN BERPASANGAN X DARI TABEL tb_evaluasi 
        // echo "<pre>";
            //--- inisialisasi jumlah kriteria 'n'
            $n = count($this->Kriteria_model->getKriteria());
            
            $list = $this->Algoritma_model->getDataEval();
            // print_r($list);
            $list_x = array_values($list[0]);

            $X = array();
            $no=1;
            for ($i=0; $i < count($list_x) ; $i++) { 
                for ($j=1; $j <= count($list_x[$i]) ; $j++) { 
                    $X[$no][$j] = $list_x[$i][$j];
                    // echo $X[$no][$j]." = ".$list_x[$i][$j]."<br>";
                }
                $no++;
                // echo "<hr>";
            }
            
            // print_r($X);

            //-- inisialisasi jumlah alternatif 'm'

        // END SCRIPT PERBANDINGAN BERPASANGAN X

        // SCRIPT PERBANDINGAN BERPASANGAN TERNORMALISASI (R)

            //-- menentukan nilai rata-rata kuadrat per-kriteria
            $x_rata=array();
            foreach($X as $i=>$x){
                foreach($x as $j=>$value){
                $x_rata[$j]=(isset($x_rata[$j])?$x_rata[$j]:0)+pow($value,2);
                }
            }
            // print_r($x_rata);
            for($j=1;$j<=$n;$j++){
                $x_rata[$j]=sqrt($x_rata[$j]);
            }
            // $x_rata=array();
            // foreach($X as $i=>$x){
            //     foreach($x as $j=>$value){
            //         $x_rata[$j]=(isset($x_rata[$j])?$x_rata[$j]:0)+pow($value,2);
            //     }
            // }
            // print_r($x_rata);
            // for($j=1;$j<=$n;$j++){
            //     $x_rata[$j]=sqrt($x_rata[$j]);
            // }
            //-- menormalisasi matriks X menjadi matriks R
            $R=array();
            $alternatif='';
            foreach($X as $i=>$x){
                if($alternatif!=$i){
                $alternatif=$i;
                $R[$i]=array();
                }
                foreach($x as $j=>$value){
                $R[$i][$j]=$value/$x_rata[$j];
                // echo $value." / ".$x_rata[$j]."<br>";
                }
            }
            // print_r($R);

            // echo "<br>";
            // echo "NORMALISASI<br>";
            // echo "<table>";
            // foreach ($R as $i => $value) {
            //     echo "<tr>";
            //     for ($j=1; $j <= count($R[$i]) ; $j++) { 
            //         echo "<td>";
            //         echo $R[$i][$j]." || <br>";
            //         echo "</td>";
            //     }
            //     echo "</tr>";
            // }
            // echo "</table>";

            // $R=array();
            // $alternative='';
            // foreach($X as $i=>$x){
            // if($alternative!=$i){
            //     $alternative=$i;
            //     $R[$i]=array();
            // }
            // foreach($x as $j=>$value){
            //     $R[$i][$j]=$value/$x_rata[$j];
            // }
            // }

        // END SCRIPT PERBANDINGAN TERNORMALISASI

        // mengambil data nilai bobot criteria
        $criteria = $this->Algoritma_model->getBobotKriteria();

         //-- inisialisasi matrik preferensi V dan himpunan bobot kriteria w
         $V=$w=array();
         //-- memasukkan data bobot ke dalam $w
            foreach($criteria as $j=>$weight)
                $w[$j]=$weight;
            $alternative='';
         //-- menghitung nilai Preferensi V
            foreach($R as $i=>$r){
                if($alternative!=$i){
                $alternative=$i;
                $V[$i]=array();
                }
                foreach($r as $j=>$value){
                $V[$i][$j]=$w[$j]*$value;
                }
            }
            // print_r($V);

            //  Menentukan Concordance Index (Ckl)

            $c=array();
            $c_index='';
            $m = $list[1];
            for($k=1;$k<=$m;$k++){

                if($c_index!=$k){
                    $c_index=$k;
                    $c[$k]=array();
                }

                for($l=1;$l<=$m;$l++){
                    if($k!=$l){
                    for($j=1;$j<=$n;$j++){
                        if(!isset($c[$k][$l]))$c[$k][$l]=array();
                        if($V[$k][$j]>=$V[$l][$j]){
                        array_push($c[$k][$l],$j);
                        }
                    }
                    } else if (isset($c[$k][$l]) == NULL) {
                    $c[$k][$l]=$c[$k][$l] = "-";
                    }
                }

            }

            // print_r($c);

            // Menentukan Discordance Index (Dkl)
            
            $d=array();
            $d_index='';
            for($k=1;$k<=$m;$k++){
                if($d_index!=$k){
                $d_index=$k;
                $d[$k]=array();
                }
                for($l=1;$l<=$m;$l++){
                if($k!=$l){
                    for($j=1;$j<=$n;$j++){
                    if(!isset($d[$k][$l]))$d[$k][$l]=array();
                    // echo $V[$k][$j]." < ".$V[$l][$j]."<br>";
                    if($V[$k][$j]<$V[$l][$j]){
                        array_push($d[$k][$l],$j);
                    }
                    }
                } else if (isset($d[$k][$l]) == NULL) {
                    $d[$k][$l]=$d[$k][$l] = "-";
                }
                }
            }
            // print_r($d);

            // Membentuk Matriks Concordance (C)

            $C=array();
            $c_index='';
            for($k=1;$k<=$m;$k++){
                if($c_index!=$k){
                    $c_index=$k;
                    $C[$k]=array();
                }
                for($l=1;$l<=$m;$l++){
                    if($k!=$l && count($c[$k][$l])){
                    $f=0;
                    foreach($c[$k][$l] as $j){
                        $C[$k][$l]=(isset($C[$k][$l])?$C[$k][$l]:0)+$w[$j];
                    }
                    } else if (isset($C[$k][$l]) == NULL) {
                    $C[$k][$l]=$C[$k][$l] = "-";
                    }
                }
            }

            // print_r($C);

            // Threshold c

            $sigma_c=0;
            foreach($C as $k=>$cl){
                foreach($cl as $l=>$value){
                    // echo $value."<br>";
                    $sigma_c+=floatval($value);
                }
            }
            $threshold_c=$sigma_c/($m*($m-1));
            // echo $threshold_c;

            // Membentuk Matrix Discordance (D)

            $D=array();
            $d_index='';
            for($k=1;$k<=$m;$k++){
                if($d_index!=$k){
                    $d_index=$k;
                    $D[$k]=array();
                }
                for($l=1;$l<=$m;$l++){
                    if($k!=$l){
                    $max_d=0;
                    $max_j=0;
                    if(count($d[$k][$l])){
                        $mx=array();
                        foreach($d[$k][$l] as $j){
                        if($max_d < abs($V[$k][$j]-$V[$l][$j]))
                            $max_d=abs($V[$k][$j]-$V[$l][$j]);
                        }
                    }
                    $mx=array();
                    for($j=1;$j<=$n;$j++){
                        if($max_j < abs($V[$k][$j]-$V[$l][$j]))
                        $max_j=abs($V[$k][$j]-$V[$l][$j]);
                    }
                    $D[$k][$l]= $max_d == 0 ? 0 : $max_d/$max_j;
                    } else if (isset($D[$k][$l]) == NULL) {
                    $D[$k][$l]=$D[$k][$l] = "-";
                    }
                }
            }

            // print_r($D);

            // Threshold D

            $sigma_d=0;
            foreach($D as $k=>$dl){
              foreach($dl as $l=>$value){
                $sigma_d+=floatval($value);
              }
            }
            $threshold_d=$sigma_d/($m*($m-1));
            // echo $threshold_d;

            // Membentuk Matrik Concordance Dominan(F)

            $F=array();
            foreach($C as $k=>$cl){
                $F[$k]=array();
                foreach($cl as $l=>$value){
                $F[$k][$l]=($value >= $threshold_c?1:0);
                }
            }

            // print_r($F);

            // Membentuk Matrik Discordance Dominan(G)

            $G=array();
            foreach($D as $k=>$dl){
              $G[$k]=array();
              foreach($dl as $l=>$value){
                $G[$k][$l]=($value >= $threshold_d?1:0);
              }
            }
            // print_r($G);

            // Membentuk Matrik Agregasi Dominan(E)

            $hasil1 = array();
            $hasil2 = array();

            $E=array();
            foreach($F as $k=>$sl){
                $E[$k]=array();
                foreach($sl as $l=>$value){
                $E[$k][$l]=$F[$k][$l]*$G[$k][$l];
                }
            }
            // print_r($E);

            // Ranking Tanaman

            $alt = $this->Peternak_model->getPeternak();

            $peternak1 = array();
            $peternak2 = array();
            $no=1;
            for ($i=0; $i < count($alt); $i++) { 
                $peternak1[$no] = $alt[$i]['nama'];
                $peternak2[$no] = $alt[$i]['kd_alternatif'];
                $no++;
            } 

            foreach ($E as $key => $value) {

                $hasil1[$peternak1[$key]] = array_sum($value);
                $hasil2[$peternak2[$key]] = array_sum($value);
    
            }

            arsort($hasil1);
            arsort($hasil2);

            // print_r($hasil1);die;
            $a = '';
            for ($i = 0; $i<3; $i++) 
            {
                $a .= mt_rand(0,9);
            }
            $kd_history = "HTR0".$a;
            $rank = 1;
            foreach ($hasil2 as $key => $value) {
                $detail_history[] = [
                    "kd_history" => $kd_history,
                    "kd_alternatif" => $key,
                    "point" => $value,
                    "rank" => $rank++
                ];
            }

            // set timezone
            date_default_timezone_set('Asia/Makassar');
            $date = date('m/d/Y H:i:s', time());

            $history = [
                "kd_history" => $kd_history,
                "time_proc"  => $date
            ];

            // mengambil nilai data kelompok dan kriteria dengan nilai evaluasinya
            $kriteria = $this->Kriteria_model->getKriteria();
            $klp_ternak = $this->Peternak_model->getKdNama();

            $eval_klp_ternak = array();
            for ($i=0; $i < count($klp_ternak); $i++) { 
                $eval_klp_ternak[] = $this->Evaluasi_model->getEvalEachAlt($klp_ternak[$i]['kd_alternatif']);
            }

            for ($i=0; $i < count($klp_ternak) ; $i++) { 
                $klp_ternak[$i]['evaluasi'] = $eval_klp_ternak[$i];
            }

            // echo "<pre>";
            // print_r($history);
            // print_r($detail_history);
            // print_r($klp_ternak);die;

            // insert history
            $this->History_model->insertHistory($history, $detail_history);

            // Ranking Kelompok Ternak

            $data = array(  
                'title'     =>      'Algoritma | Administrator',
                'subtitle'  =>      'Hasil Algoritma',
                'kriteria'  =>      $kriteria,
                'eval_klp_ternak'  =>      $eval_klp_ternak,
                'klp_ternak'=>      $klp_ternak,
                'hasil'     =>      $hasil1,
                'isi'       =>      'admin/algoritma/hasil_algoritma' 
            );
    
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        
    }

}

/* End of file Algoritma.php */
