<div class="top-shadow"></div>

<div class="inner-page">
<div class="slider-item" style="background-image: url('<?= base_url() ?>assets/templates/home/images/img_3.jpg');">
    
    <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
        <div class="col-md-8 text-center col-sm-12 element-animate pt-5">
            <h1 class="pt-5"><span><?= $title; ?></span></h1>
            <p class="mb-5 w-75 pl-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
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
?>

<section class="section border-bottom">
    <div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 mb-5 order-2">
        <?= form_open(base_url('suplier/update_eval')); ?>
        <input type="hidden" name="kd_suplier" value="<?= $_GET['kd_suplier'] ?>">
            <!-- menentukan harga dari setiap material -->
            <div class="row">
            <label for="suplier">Tentukan Harga Setiap Material</label>
            <?php if ($harga['batu_bara'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="harga[batubara]" id="exampleFormControlSelect1">
                        <option value="0" selected>Batubara</option>
                        <option value="1"><?= $harga['batu_bara'][0]['value']; ?></option>
                        <option value="3"><?= $harga['batu_bara'][1]['value']; ?></option>
                        <option value="5"><?= $harga['batu_bara'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="harga[batubara]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($harga['silica'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="harga[silica]" id="exampleFormControlSelect1">
                        <option value="0" selected>Silica</option>
                        <option value="1"><?= $harga['silica'][0]['value']; ?></option>
                        <option value="3"><?= $harga['silica'][1]['value']; ?></option>
                        <option value="5"><?= $harga['silica'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="harga[silica]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($harga['gypsum'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="harga[gypsum]" id="exampleFormControlSelect1">
                        <option value="0" selected>Gypsum</option>
                        <option value="1"><?= $harga['gypsum'][0]['value']; ?></option>
                        <option value="3"><?= $harga['gypsum'][1]['value']; ?></option>
                        <option value="5"><?= $harga['gypsum'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="harga[gypsum]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($harga['clay'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="harga[clay]" id="exampleFormControlSelect1">
                        <option value="0" selected>Clay</option>
                        <option value="1"><?= $harga['clay'][0]['value']; ?></option>
                        <option value="3"><?= $harga['clay'][1]['value']; ?></option>
                        <option value="5"><?= $harga['clay'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="harga[clay]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($harga['chipping'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="harga[chipping]" id="exampleFormControlSelect1">
                        <option value="0" selected>Batu kapur</option>
                        <option value="1"><?= $harga['chipping'][0]['value']; ?></option>
                        <option value="3"><?= $harga['chipping'][1]['value']; ?></option>
                        <option value="5"><?= $harga['chipping'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="harga[chipping]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <label for="suplier">Tentukan Kualitas Setiap Material</label>
            <?php if ($kualitas['batu_bara'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kualitas[batubara]" id="exampleFormControlSelect1">
                        <option value="0" selected>Batubara</option>
                        <option value="5"><?= $kualitas['batu_bara'][0]['value']; ?></option>
                        <option value="3"><?= $kualitas['batu_bara'][1]['value']; ?></option>
                        <option value="1"><?= $kualitas['batu_bara'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kualitas[batubara]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($kualitas['silica'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kualitas[silica]" id="exampleFormControlSelect1">
                        <option value="0" selected>Silica</option>
                        <option value="5"><?= $kualitas['silica'][0]['value']; ?></option>
                        <option value="3"><?= $kualitas['silica'][1]['value']; ?></option>
                        <option value="1"><?= $kualitas['silica'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kualitas[silica]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($kualitas['gypsum'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kualitas[gypsum]" id="exampleFormControlSelect1">
                        <option value="0" selected>Gypsum</option>
                        <option value="5"><?= $kualitas['gypsum'][0]['value']; ?></option>
                        <option value="3"><?= $kualitas['gypsum'][1]['value']; ?></option>
                        <option value="1"><?= $kualitas['gypsum'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kualitas[gypsum]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($kualitas['clay'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kualitas[clay]" id="exampleFormControlSelect1">
                        <option value="0" selected>Clay</option>
                        <option value="5"><?= $kualitas['clay'][0]['value']; ?></option>
                        <option value="3"><?= $kualitas['clay'][1]['value']; ?></option>
                        <option value="1"><?= $kualitas['clay'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kualitas[clay]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($kualitas['chipping'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kualitas[chipping]" id="exampleFormControlSelect1">
                        <option value="0" selected>Batu kapur</option>
                        <option value="5"><?= $kualitas['chipping'][0]['value']; ?></option>
                        <option value="3"><?= $kualitas['chipping'][1]['value']; ?></option>
                        <option value="1"><?= $kualitas['chipping'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kualitas[chipping]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <label for="suplier">Tentukan Kuantitas Setiap Material</label>
            <?php if ($kuantitas['batu_bara'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kuantitas[batubara]" id="exampleFormControlSelect1">
                        <option value="0" selected>Batubara</option>
                        <option value="5"><?= $kuantitas['batu_bara'][0]['value']; ?></option>
                        <option value="3"><?= $kuantitas['batu_bara'][1]['value']; ?></option>
                        <option value="1"><?= $kuantitas['batu_bara'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kuantitas[batubara]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($kuantitas['silica'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kuantitas[silica]" id="exampleFormControlSelect1">
                        <option value="0" selected>Silica</option>
                        <option value="5"><?= $kuantitas['silica'][0]['value']; ?></option>
                        <option value="3"><?= $kuantitas['silica'][1]['value']; ?></option>
                        <option value="1"><?= $kuantitas['silica'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kuantitas[silica]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($kuantitas['gypsum'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kuantitas[gypsum]" id="exampleFormControlSelect1">
                        <option value="0" selected>Gypsum</option>
                        <option value="5"><?= $kuantitas['gypsum'][0]['value']; ?></option>
                        <option value="3"><?= $kuantitas['gypsum'][1]['value']; ?></option>
                        <option value="1"><?= $kuantitas['gypsum'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kuantitas[gypsum]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($kuantitas['clay'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kuantitas[clay]" id="exampleFormControlSelect1">
                        <option value="0" selected>Clay</option>
                        <option value="5"><?= $kuantitas['clay'][0]['value']; ?></option>
                        <option value="3"><?= $kuantitas['clay'][1]['value']; ?></option>
                        <option value="1"><?= $kuantitas['clay'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kuantitas[clay]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
            <?php if ($kuantitas['chipping'] != null) { ?>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="kuantitas[chipping]" id="exampleFormControlSelect1">
                        <option value="0" selected>Batu kapur</option>
                        <option value="5"><?= $kuantitas['chipping'][0]['value']; ?></option>
                        <option value="3"><?= $kuantitas['chipping'][1]['value']; ?></option>
                        <option value="1"><?= $kuantitas['chipping'][2]['value']; ?></option>
                    </select>
                </div>
            <?php } else { ?>
                <select name="kuantitas[chipping]" id="" hidden>
                    <option value="0" selected></option>
                </select>
            <?php } ?>
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
