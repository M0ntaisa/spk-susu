<div class="top-shadow"></div>

<div class="inner-page">
<div class="slider-item" style="background-image: url('<?= base_url() ?>assets/templates/home/images/img_3.jpg');">
    
    <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
        <div class="col-md-8 text-center col-sm-12 element-animate pt-5">
            <h1 class="pt-5"><span><?= $title; ?></span></h1>
            <p class="mb-5 w-75 pl-0">Masukkan data anda pada form yang disediakan dibawah.</p>
        </div>
        </div>
    </div>

    </div>
</div>
<!-- END slider -->
</div> 

<?php
    // notifikasi gagal login
    if( $this->session->flashdata('gagal') ) {
        $message = $this->session->flashdata('gagal');
        echo "<script type='text/javascript'>alert('$message');</script>";
    } 

    // notifikasi logout
    if( $this->session->flashdata('sukses') ) {
        $message = $this->session->flashdata('sukses');
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    // notifikasi logout
    if( $this->session->flashdata('upload_fail') ) {
        $message = $this->session->flashdata('upload_fail') ;
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
?>

<section class="section border-bottom">
    <div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 mb-5 order-2">
        <?php 

            $a = '';
            for ($i = 0; $i<3; $i++) 
            {
                $a .= mt_rand(0,9);
            }
            $kd_suplier = "SUP00".$a;
            
        ?>
        <?= form_open_multipart(base_url('suplier/tambah_suplier')); ?>
            <div class="row">
            <div class="col-md-12 form-group">
            <input type="hidden" class="form-control" value="<?= $kd_suplier ?>" name="kd_suplier"/>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 form-group">
                <label for="suplier">Nama Suplier</label>
                <input type="suplier" name="suplier" id="suplier" class="form-control " required>
            </div>
            <div class="col-md-12 form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control " required>
            </div>
            <div class="col-md-12 form-group">
                <label for="telepon">No. Hp / Telepon</label>
                <input type="telepon" name="telepon" id="telepon" class="form-control " required>
            </div>
            <div class="col-md-12 form-group">
                <label for="telepon">Jenis Material</label>
                <div class="col-lg-10 col-md-8 col-sm-4 col-xs-8">
                    <div class="inline-checkbox-cs required">
                        <label class="label-cont">
                            <input type="checkbox" name="material[]" value="mtr-001" id="inlineCheckbox1"> Batu bara 
                            <span class="checkmark"></span> </label>
                        <label class="label-cont">
                            <input type="checkbox" name="material[]" value="mtr-002" id="inlineCheckbox2"> Silica
                            <span class="checkmark"></span> </label>
                        <label class="label-cont">
                            <input type="checkbox" name="material[]" value="mtr-003" id="inlineCheckbox3"> Gypsum
                            <span class="checkmark"></span> </label>
                        <label class="label-cont">
                            <input type="checkbox" name="material[]" value="mtr-004" id="inlineCheckbox4"> Clay
                            <span class="checkmark"></span> </label>
                        <label class="label-cont">
                            <input type="checkbox" name="material[]" value="mtr-005" id="inlineCheckbox5"> Batu kapur
                            <span class="checkmark"></span> </label>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 form-group">
                <label for="alamat">Alamat Suplier</label>
                <textarea name="alamat" id="alamat" class="form-control " cols="30" rows="8" required></textarea>
            </div>
            <div class="col-md-12 form-group">
                <label for="surat_usaha">Upload Surat Usaha</label>
                <?= form_upload('surat_usaha', set_value('surat_usaha'), 'class="form-control"'); ?>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6 form-group">
                <input type="submit" value="Kirim" class="btn btn-primary px-3 py-3">
            </div>
            </div>
        <?= form_close(); ?>
        </div>
    </div>
    </div>
</section>
