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

            //--- inisialisasi jumlah kriteria 'n'
            $n = count($this->Kriteria_model->getKriteria());
            
            $list = $this->Algoritma_model->getDataEval();
            echo "<pre>";
            $X = $list[0];
            print_r($X);
            //-- inisialisasi jumlah alternatif 'm'

        // END SCRIPT PERBANDINGAN BERPASANGAN X

        // SCRIPT PERBANDINGAN BERPASANGAN TERNORMALISASI (R)

            //-- menentukan nilai rata-rata kuadrat per-kriteria
            $x_rata=array();
            foreach($X as $i=>$X){
                foreach($X as $j=>$value){
                $x_rata[$j]=(isset($x_rata[$j])?$x_rata[$j]:0)+pow($value,2);
                }
            }
            // print_r($x_rata);die;
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
                foreach($X as $j=>$value){
                $R[$i][$j]=$value/$x_rata[$j];
                }
            }
            print_r($R);
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
            echo "<pre>";
            print_r($V);

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

            echo "<pre>";
            print_r($c);

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
                    echo $V[$k][$j]." < ".$V[$l][$j]."<br>";
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
        
    }

}

/* End of file Algoritma.php */
