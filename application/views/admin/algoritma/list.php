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
                                <div class="sparkline10-hd">
                                    <div class="main-sparkline10-hd">
                                        <h1>Proses Algoritma</h1>
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
                                                    <?= form_open(base_url('admin/algoritma/proses')); ?>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="login-btn-inner">
                                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit"><i class="fa fa-flask"></i> Proses</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?= form_close(); ?>
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
            
            <!-- Static Table End -->
                    