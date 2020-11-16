    <header role="banner">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <a class="navbar-brand " href="<?= base_url() ?>">SEMEN <span style="font-color:yellow;">BOSOWA</span> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php 

                $home = "";
                $about = "";
                $suplier = "";
                $contact = "";
                if ($title == "Home") {
                    $home = "active";
                } elseif ($title == "About") {
                    $about = "active";
                } elseif ($title == "Contact") {
                    $contact = "active";
                } else {
                    $home = "";
                    $about = "";
                    $suplier = "";
                    $contact = "";
                }
                
            ?>

            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav pl-md-5 ml-auto">
                <li class="nav-item" style="padding-right:30px;">
                    <a class="nav-link <?= $home ?>" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item" style="padding-right:30px;">
                    <a class="nav-link <?= $about ?>" href="<?= base_url('about') ?>">About</a>
                </li>
                <li class="nav-item" style="padding-right:30px;">
                    <a class="nav-link <?= $suplier ?>" href="<?= base_url('Pasien') ?>">Pasien</a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="services.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="services.html">Architectural Design</a>
                    <a class="dropdown-item" href="services.html">Interior</a>
                    <a class="dropdown-item" href="services.html">Building</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.html">Blog</a>
                </li> -->
                <!-- <li class="nav-item" style="padding-right:30px;">
                    <a class="nav-link <?= $contact ?>" href="<?= base_url('contact') ?>">Contact</a>
                </li> -->
                </ul>
            
            </div>
            <div style="padding-right:300px;"></div>
            </div>
        </nav>
    </header>
    <!-- END header -->
