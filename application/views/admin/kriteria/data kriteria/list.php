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
    <!-- Static Table Start -->
    <div class="static-table-area mg-b-40">
        <div class="container">
            <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline10-list shadow-reset mg-t-30">
                        <div class="sparkline10-hd">
                            <div class="main-sparkline10-hd">
                                <h1>Daftar Kriteria</h1>
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
                                            <th>Kode Kriteria</th>
                                            <th>Nama Kriteria</th>
                                            <th>Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($kriteria as $row) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['kd_kriteria']; ?></td>
                                            <td><?= $row['nm_kriteria']; ?></td>
                                            <td><?= $row['weight']; ?></td>
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

                    