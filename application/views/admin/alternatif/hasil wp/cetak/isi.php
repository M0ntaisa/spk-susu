<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style type="text/css" media="print">
        body {
            font-family : Arial;
            font-size : 12px;
        }

        .cetak {
            width : 19cm;
            height : 27cm;
            padding : 1cm;
        }
        
        table {
            border : solid thin #000;
            border-collapse : collapse;
        }

        td, th {
            padding : 3mm 6mm;
            text-align : left;
            vertical-align : top;
        }

        th {
            background-color : #f5f5f5;
            font-weight : bold;
        }

        h1 {
            text-align : center;
            font-size : 18px;
            text-transform : uppercase;
        }
    </style>
    <style type="text/css" media="screen">
        body {
            font-family : Arial;
            font-size : 12px;
        }

        .cetak {
            width : 19cm;
            height : 27cm;
            padding : 1cm;
        }
        
        table {
            border : solid thin #000;
            border-collapse : collapse;
        }

        td, th {
            padding : 3mm 6mm;
            text-align : left;
            vertical-align : top;
        }

        th {
            background-color : #f5f5f5;
            font-weight : bold;
        }

        h1 {
            text-align : center;
            font-size : 18px;
            text-transform : uppercase;
        }

    </style>
</head>
<body onload="print()">
    
<div class="row">
    <div class="cetak">
        <br>
        <div style="padding:0cm 0cm 1cm 0cm;">
            <p align="center">Jenis Material :</p>
            <table align="center">
                <tr>
                    <th align="center">Material</th>
                </tr>
                <tr>
                    <td style="text-align:center;"><?= $nm_material; ?></td>
                </tr>
            </table>
        </div>
        
        <table class="table table-bordered" id="example3" align="center">
            <thead>
            <tr></tr>
                <tr>
                    <th>Nama Suplier</th>
                    <th style="text-align:center;">Nilai Akhir</th>
                    <th style="text-align:center;">Peringkat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($data_wp as $row) { ?>
                    <tr>
                        <td><?= $row['nm_suplier']; ?></td>
                        <td style="text-align:center;"><?= $row['vektor_v']; ?></td>
                        <td style="text-align:center;"><?= $no++; ?></td>
                    </tr>
                <?php }  ?>
            </tbody>
        </table>
        <br>
        <table align="center" style="border:0px;">
            <tr>
                <td width="600" align="justify">
                <p>
                    Berdasarkan hasil perhitungan yang telah dilakukan, didapatlah hasil akhir <b><?= $data_wp[0]['nm_suplier']; ?></b> yang memiliki nilai tertinggi diantara suplier yang lainnya untuk pemilihan bahan material <b><?= $nm_material; ?></b>.
                </p>
                </td>
            </tr>
            </table>
            <br />
    
    
            <br /><br />
            <br /><br />
    
            <table style="border:0px;">
            <tr>
                <td width="400"></td>
                <td>
                <p>Makassar, </p>
                <p>SEMEN BOSOWA<br/>Jabatan yg bertandatangan</p>
                <br />
                <br />
                <br />
                <br />
                <p class="nama">yang bertandatangan</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>