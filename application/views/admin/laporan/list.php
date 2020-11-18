    <!-- Breadcome start-->
    <div class="breadcome-area mg-b-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                        <div class="breadcome-heading">
                            <h2><?= $subtitle; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcome End-->
    <!-- stockprice, feed area start-->
    <div class="login-form-area">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                            <div class="sparkline7-list stock-price-section shadow-reset nt-mg-b-30">
                                <div class="sparkline7-hd">
                                    <div class="main-spark7-hd">
                                        <h1>Tambah Data Pasien</h1>
                                        <div class="sparkline7-outline-icon">
                                            <span class="sparkline7-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline7-collapse-close"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- stockprice, feed area end-->
    <!-- Static Table Start -->
    <div class="static-table-area mg-b-40">
        <div class="container">
            <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline10-list shadow-reset mg-t-30">
                        <div class="sparkline10-hd">
                            <div class="main-sparkline10-hd">
                                <h1>Peringkat Teratas</h1>
                                <div class="sparkline10-outline-icon">
                                    <span class="sparkline10-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                    <span><i class="fa fa-wrench"></i></span>
                                    <span class="sparkline10-collapse-close"><i class="fa fa-times"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="static-table-list">
                                <table class="table border-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Waktu Seleksi</th>
                                            <!-- <th>Nama Kelompok</th> -->
                                            <th>Poin</th>
                                            <th width="270px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($top_rank as $row) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= date( "d/m/Y H:i:s", strtotime($row['time_proc'])) ?></td>
                                            <!-- <td><?= $row['nama']; ?></td> -->
                                            <td><?= $row['point']; ?></td>
                                            <td>
                                                <a href="<?= base_url() ?>admin/laporan/detail_laporan?kd_alternatif=<?= $row['kd_alternatif']; ?>" type="button" class="btn btn-sm btn-info login-submit-cs"><i class="fa fa-file"></i> Detail</a>
                                                <a href="<?= base_url() ?>admin/laporan/cetak_laporan?kd_alternatif=<?= $row['kd_alternatif']; ?>" type="button" target="_blank" class="btn btn-sm btn-primary login-submit-cs"><i class="fa fa-print"></i> Cetak</a>
                                                <a href="<?= base_url() ?>admin/laporan/unduh_laporan?kd_alternatif=<?= $row['kd_alternatif']; ?>" type="button" target="_blank" class="btn btn-sm btn-success login-submit-cs"><i class="fa fa-download"></i> Download</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Static Table End -->