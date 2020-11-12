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
                    </div>
                    </div>
                    
                    <!-- Static Table Start -->
                <div class="static-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline8-list shadow-reset">
                                <div class="sparkline8-hd">
                                    <div class="main-sparkline8-hd">
                                        <h1>Peringkat Teratas</h1>
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
                                                    <th>Jenis Material</th>
                                                    <th>Nama Suplier</th>
                                                    <th>Vektor V</th>
                                                    <th width="270px;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; foreach ($top_rank as $row) { ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row['nama_material']; ?></td>
                                                    <td><?= $row['nm_suplier']; ?></td>
                                                    <td><?= $row['vektor_v']; ?></td>
                                                    <td>
                                                        <a href="<?= base_url() ?>admin/alternatif/detail?kd_material=<?= $row['kd_material'] ?>" type="button" class="btn btn-sm btn-info login-submit-cs"><i class="fa fa-file"></i> Detail</a>
                                                        <a href="<?= base_url() ?>admin/alternatif/cetak?kd_material=<?= $row['kd_material'] ?>" type="button" target="_blank" class="btn btn-sm btn-primary login-submit-cs"><i class="fa fa-print"></i> Cetak</a>
                                                        <a href="<?= base_url() ?>admin/alternatif/unduh?kd_material=<?= $row['kd_material'] ?>" type="button" target="_blank" class="btn btn-sm btn-success login-submit-cs"><i class="fa fa-download"></i> Download</a>
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
                    