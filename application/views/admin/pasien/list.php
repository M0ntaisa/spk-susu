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
                                <div class="sparkline7-graph">
                                    <div class="dashone-bar-heading">

                                        <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addPasien" style="color:white;"><i class="fa fa-plus"></i> Tambah Data</a>
                                        
                                        <div id="addPasien" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header header-color-modal bg-color-1">
                                                        <h4 class="modal-title">Tambah Data Pasien</h4>
                                                        <div class="modal-close-area modal-close-df">
                                                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php 

                                                        $a = '';
                                                        for ($i = 0; $i<3; $i++) 
                                                        {
                                                            $a .= mt_rand(0,9);
                                                        }
                                                        $kd_alternatif = "ALT0".$a;

                                                        ?>
                                                        <?= form_open(base_url('admin/pasien/tambah_klp_ternak')); ?>
                                                            
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
                                                                        <input type="text" class="form-control" id="kel_ternak" name="kel_ternak" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <label class="login2 pull-left pull-left-pro">Alamat</label>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <label class="login2 pull-left pull-left-pro">No. Telepon Kelompok</label>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <input type="text" class="form-control input-medium bfh-phone" id="telepon" name="telepon" required>
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
                                <h1>Daftar Pasien</h1>
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
                                            <th>Kode</th>
                                            <!-- <th>Nama Kelompok Ternak</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th> -->
                                            <!-- <th>Surat Usaha</th> -->
                                            <th width="150px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x = 1; foreach ($pasien as $row) { ?>
                                        <tr>
                                            <td><?= $x++; ?></td>
                                            <td><?= $row['kd_alternatif']; ?></td>
                                            <!-- <td><?= $row['nama']; ?></td>
                                            <td><?= $row['alamat']; ?></td>
                                            <td><?= $row['telepon']; ?></td> -->
                                            <!-- <td><a href="<?= base_url('assets/upload/image/surat_usaha/'.$row[0]['surat_usaha']); ?>" data-lightbox='image-<?= $x ?>' data-title="Surat Usaha dari Pasien <?= $row[0]['nm_suplier'] ?>"><img src="<?= base_url('assets/upload/image/surat_usaha/thumbs/'.$row[0]['surat_usaha']); ?>" alt="Surat Usaha Tidak Ada" class="img img-responsive img-thumbnail" width="60"></a></td> -->
                                            <td>
                                                <?php $kd_alternatif = $row['kd_alternatif'] ?>
                                                <?php include('edit.php'); ?>
                                                
                                                <?php include('delete.php'); ?>
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