
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-<?= $kd_alternatif; ?>">
    <i class="fa fa-edit"></i> Edit(undone)
</button>

<div id="edit-<?= $kd_alternatif; ?>" class="modal modal-adminpro-general modal-zoomInDown fade" role="dialog">
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
                                                    <?= form_open(base_url('admin/peternak/edit_klp_ternak')); ?>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-9">
                                                                    <input type="hidden" class="form-control" value="<?= $kd_alternatif ?>" name="kd_alternatif"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-left pull-left-pro">Nama Kelompok</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" class="form-control" id="kel_ternak" name="kel_ternak" value="<?= $row['nama'] ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-left pull-left-pro">Alamat</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $row['alamat'] ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-left pull-left-pro">No. Telepon Kelompok</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" class="form-control input-medium bfh-phone" id="telepon" name="telepon" value="<?= $row['telepon'] ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-left pull-left-pro">Status Kelompok</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <select name="st_kelompok" id="st_kelompok" class="form-control">
                                                                        <option value="">- Pilih Status Kelompok -</option>
                                                                        <?php foreach ($st_kelompok as $row) { ?>
                                                                            <option value="<?= $row['kd_subkriteria']; ?>"><?= $row['nm_subkriteria']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-left pull-left-pro">Status Bantuan</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <select name="st_bantuan" id="st_bantuan" class="form-control">
                                                                        <option value="">- Pilih Status Bantuan -</option>
                                                                        <?php foreach ($st_bantuan as $row) { ?>
                                                                            <option value="<?= $row['kd_subkriteria']; ?>"><?= $row['nm_subkriteria']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-left pull-left-pro">Sistem Pemeliharaan</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <select name="sys_pemeliharaan" id="sys_pemeliharaan" class="form-control">
                                                                        <option value="">- Pilih Sistem Pemeliharaan -</option>
                                                                        <?php foreach ($sys_pemeliharaan as $row) { ?>
                                                                            <option value="<?= $row['kd_subkriteria']; ?>"><?= $row['nm_subkriteria']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-left pull-left-pro">Pelayanan Kesehatan</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <select name="pel_kesehatan" id="pel_kesehatan" class="form-control">
                                                                        <option value="">- Pilih Pelayanan Kesehatan -</option>
                                                                        <?php foreach ($pel_kesehatan as $row) { ?>
                                                                            <option value="<?= $row['kd_subkriteria']; ?>"><?= $row['nm_subkriteria']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-left pull-left-pro">Sertifikat Ternak</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="file" class="form-control" name="sertifi_ternak" id="sertifi_ternak">
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
                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Simpan</button>
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