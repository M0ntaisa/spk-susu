<div class="row">
                        <div class="col-lg-12">
                            <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<div class="breadcome-heading">
                                            <h1><?= $subtitle; ?></h1>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                            <div class="sparkline10-list shadow-reset mg-t-30">
                                <div class="sparkline10-hd">
                                    <div class="main-sparkline10-hd">
                                        <h1>Aksi</h1>
                                        <div class="sparkline10-outline-icon">
                                            <span class="sparkline10-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline10-collapse-close"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sparkline10-graph">
                                    <div class="basic-login-form-ad">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="basic-login-inner inline-basic-form">
                                                    <div class="form-group-inner">
                                                        <div class="login-btn-inner">
                                                            <a href="<?= base_url() ?>admin/laporan" type="button" class="btn btn-custon-four btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                                            <!-- <a href="<?= base_url() ?>admin/alternatif/unduh?kd_material=<?= $material ?>" type="button" target="_blank" class="btn btn-custon-four btn-success"><i class="fa fa-download"></i> Download</a> -->
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
                    </div>
                    </div>
                    <!-- Static Table Start -->
                <div class="static-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                                if( $this->session->flashdata('sukses') ) {
                                    echo '<div class="alert-wrap2 shadow-reset wrap-alert-b">';
                                    echo    '<div class="alert alert-success">';
                                    echo        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                    echo        "<strong>Berhasil! </strong>".$this->session->flashdata('sukses')."</div></div>";
                                }
                                if( $this->session->flashdata('gagal') ) {
                                    echo '<div class="alert-wrap2 shadow-reset wrap-alert-b">';
                                    echo    '<div class="alert alert-danger">';
                                    echo        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                    echo        "<strong>Gagal! </strong>".$this->session->flashdata('gagal')."</div></div>";
                                }
                                if( $this->session->flashdata('warning') ) {
                                    echo '<div class="alert-wrap2 shadow-reset wrap-alert-b">';
                                    echo    '<div class="alert alert-warning">';
                                    echo        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                    echo        "<strong>Perhatian! </strong>".$this->session->flashdata('warning')."</div></div>";
                                }
                            ?>
                            <div class="sparkline8-list shadow-reset">
                                <div class="sparkline8-hd">
                                    <div class="main-sparkline8-hd">
                                        <h1>Pasien Material <?= $material; ?></h1>
                                        <div class="sparkline8-outline-icon">
                                            <span class="sparkline8-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline8-collapse-close"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sparkline8-graph">
                                    <div class="static-table-list">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Pasien</th>
                                                    <th style="text-align:center;">Vektor V</th>
                                                    <th style="text-align:center;">Peringkat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no=1; foreach ($detail as $row) { ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $row['nm_suplier']; ?></td>
                                                    <td align="center"><?= $row['vektor_v']; ?></td>
                                                    <td align="center">Rank <?= $no++; ?></td>
                                                </tr>
                                            <?php }  ?>
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
                    