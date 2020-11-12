
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update-<?= $row['kd_suplier']; ?>">
    <i class="fa fa-edit"></i> Update
</button>

<div id="update-<?= $row['kd_suplier']; ?>" class="modal modal-adminpro-general modal-zoomInDown fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#" style="background-color:orange;"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="modal-login-form-inner">
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="sparkline12-graph">
                                    <div class="basic-login-form-ad">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="all-form-element-inner">
                                                    <?= form_open(base_url('admin/alternatif/update_nilai')); ?>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-9">
                                                                    <input type="hidden" class="form-control" value="<?= $row['kd_suplier'] ?>" name="kd_suplier" />
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <input type="hidden" class="form-control" value="<?= $material ?>" name="kd_material" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <label class="login2 pull-right pull-right-pro">Suplier</label>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <input type="text" class="form-control" id="suplier" name="suplier" value="<?= $row['nm_suplier'] ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <label class="login2 pull-right pull-right-pro">Harga</label>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <div class="form-select-list">
                                                                        <?php 
                                                                        $options = array(
                                                                            '0'     =>  'Pilih..',
                                                                            '1'     =>  $row[0][3][0]['value'],
                                                                            '3'     =>  $row[0][3][1]['value'],
                                                                            '5'     =>  $row[0][3][2]['value']
                                                                        );
                                                                        
                                                                        $cls = 'class="form-control custom-select-value"';
                                                                        echo form_dropdown('harga', $options, $row[0][0]['krt-001'], $cls);
                                                                        
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <label class="login2 pull-right pull-right-pro">Kualitas</label>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <div class="form-select-list">
                                                                        <?php 
                                                                        $options = array(
                                                                            '0'     =>  'Pilih..',
                                                                            '5'     =>  $row[0][4][0]['value'],
                                                                            '3'     =>  $row[0][4][1]['value'],
                                                                            '1'     =>  $row[0][4][2]['value']
                                                                        );
                                                                        
                                                                        $cls = 'class="form-control custom-select-value"';
                                                                        echo form_dropdown('kualitas', $options, $row[0][1]['krt-002'], $cls);
                                                                        
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <label class="login2 pull-right pull-right-pro">Kuantitas</label>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <div class="form-select-list">
                                                                        <?php 
                                                                        $options = array(
                                                                            '0'     =>  'Pilih..',
                                                                            '5'     =>  $row[0][5][0]['value'],
                                                                            '3'     =>  $row[0][5][1]['value'],
                                                                            '1'     =>  $row[0][5][2]['value']
                                                                        );
                                                                        
                                                                        $cls = 'class="form-control custom-select-value"';
                                                                        echo form_dropdown('kuantitas', $options, $row[0][2]['krt-003'], $cls);
                                                                        
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-7"></div>
                                                                    <div class="col-lg-5">
                                                                        <div class="login-horizental cancel-wp pull-left">
                                                                            <button class="btn btn-white" data-dismiss="modal" type="button">Batal</button>
                                                                            <button class="btn btn-m btn-warning" type="submit">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?= form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Form End-->
        </div>
    </div>
</div>