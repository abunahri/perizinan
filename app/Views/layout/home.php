<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3>Selamat Datang</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<?php if (session()->idlevel == 1) : ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Selamat Datang <span><?= ucwords(session()->namauser) ?></span></h5>
        Di sistem aplikasi perizinan pondok modern al-aqsha
    </div>
<?php endif; ?>
<?php if (session()->idlevel == 2) : ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Selamat Datang <span><?= ucwords(session()->namauser) ?></span></h5>
        Di sistem aplikasi perizinan pondok modern al-aqsha
    </div>
<?php endif; ?>
<?php if (session()->idlevel == 3) : ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Selamat Datang <span><?= ucwords(session()->namauser) ?></span></h5>
        Di sistem aplikasi absensi pondok modern al-aqsha

        
    </div>
<?php endif; ?>

<?= $this->endSection() ?>