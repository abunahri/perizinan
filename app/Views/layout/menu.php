<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>
<?php if (session()->idlevel == 1) : ?>
    <li class="nav-item">
        <a href="<?= site_url('layout') ?>" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Home
            </p>
        </a>
    </li>
    <li class="nav-header">Master</li>
    <li class="nav-item">
        <a href="<?= site_url('santri/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
                Data Santri
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('musrif/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-restroom"></i>

            <p>
                Data Musrif
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('kelas/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-user-graduate"></i>
            <p>
                Data Kelas
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('kamar/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-building"></i>
            <p>
                Data Kamar
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('priode/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-calendar"></i>
            <p>
                Tahun Ajaran
            </p>
        </a>
    </li>
    <li class="nav-header">Transaksi</li>
    <li class="nav-item">
        <a href="<?= site_url('perizinan/data') ?>" class="nav-link">
            <i class="nav-icon fa fa-file"></i>

            <p>
                Perizinan
            </p>
        </a>
    </li>

    <!-- <li class="nav-item">
        <a href="<?= site_url('absen/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-table"></i>

            <p>
                Absensi
            </p>
        </a>
    </li> -->

    <li class="nav-header">Laporan</li>
    <li class="nav-item">
        <a href="<?= site_url('laporan/data') ?>" class="nav-link">
            <i class="nav-icon fa fa-list"></i>
            <p>
                Rekap Perizinan
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('absen/rekap') ?>" class="nav-link">
            <i class="nav-icon fa fa-list"></i>
            <p>
                Rekap Absensi
            </p>
        </a>
    </li>
    <li class="nav-header">Ekstra</li>
    <li class="nav-item">
        <a href="<?= site_url('users/data') ?>" class="nav-link">
            <i class="nav-icon fa fa-users"></i>
            <p>
                Data users
            </p>
        </a>

    </li>
    <li class="nav-item">
        <a href="<?= site_url('utility/gantipassword') ?>" class="nav-link">
            <i class="nav-icon fa fa-lock text-primary"></i>
            <p class="text">Ganti Password</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('utility/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-database text-primary"></i>
            <p class="text">Back up Database</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('karpel/data') ?>" class="nav-link">
            <i class="nav-icon fa fa-id-card"></i>
            <p>
                Kartu Pelajar
            </p>
        </a>

    </li>
    <li class="nav-item">
        <a href="<?= site_url('setting/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-cog"></i>
            <p>
                Setting Kartu
            </p>
        </a>

    </li>
    <li class="nav-item">
        <a href="<?= site_url('login/keluar') ?>" class="nav-link">
            <i class="nav-icon fa fa-sign-out-alt"></i>
            <p>
                Logout
            </p>
        </a>

    </li>
<?php endif; ?>
<?php if (session()->idlevel == 2) : ?>
    <li class="nav-item">
        <a href="<?= site_url('layout/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Home
            </p>
        </a>
    </li>
    <li class="nav-header">Master</li>
    <li class="nav-item">
        <a href="<?= site_url('santri/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
                Data Santri
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('musrif/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-restroom"></i>

            <p>
                Data Musrif
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('kelas/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-user-graduate"></i>
            <p>
                Data Kelas
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('kamar/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-building"></i>
            <p>
                Data Kamar
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('priode/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-calendar"></i>
            <p>
                Tahun Ajaran
            </p>
        </a>
    </li>
    <li class="nav-header">Transaksi</li>
    <li class="nav-item">
        <a href="<?= site_url('perizinan/data') ?>" class="nav-link">
            <i class="nav-icon fa fa-file"></i>

            <p>
                Perizinan
            </p>
        </a>
    </li>
    <li class="nav-header">Laporan</li>
    <li class="nav-item">
        <a href="<?= site_url('laporan/data') ?>" class="nav-link">
            <i class="nav-icon fa fa-list"></i>
            <p>
                Rekap Perizinan
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('absen/rekap') ?>" class="nav-link">
            <i class="nav-icon fa fa-list"></i>
            <p>
                Rekap Absensi
            </p>
        </a>
    </li>
    <li class="nav-header">Ekstra</li>
    <li class="nav-item">
        <a href="<?= site_url('utility/gantipassword') ?>" class="nav-link">
            <i class="nav-icon fa fa-lock text-primary"></i>
            <p class="text">Ganti Password</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= site_url('login/keluar') ?>" class="nav-link">
            <i class="nav-icon fa fa-sign-out-alt"></i>
            <p>
                Logout
            </p>
        </a>

    </li>

<?php endif; ?>
<?php if (session()->idlevel == 3) : ?>
    <li class="nav-item">
        <a href="<?= site_url('layout/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Home
            </p>
        </a>
    </li>
    <li class="nav-header">Transaksi</li>
    <li class="nav-item">
        <a href="<?= site_url('absen/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-table"></i>

            <p>
                Input Absensi
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('sakit/index') ?>" class="nav-link">
            <i class="nav-icon fa fa-table"></i>

            <p>
                Input Sakit
            </p>
        </a>
    </li>

    <li class="nav-header">Laporan</li>
    
    <li class="nav-item">
        <a href="<?= site_url('absen/rekap') ?>" class="nav-link">
            <i class="nav-icon fa fa-list"></i>
            <p>
                Rekap Data Absensi
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('sakit/data') ?>" class="nav-link">
            <i class="nav-icon fa fa-list"></i>
            <p>
                Rekap Data Sakit
            </p>
        </a>
    </li>
    <li class="nav-header">Ekstra</li>
    <li class="nav-item">
        <a href="<?= site_url('utility/gantipasswordMusrif') ?>" class="nav-link">
            <i class="nav-icon fa fa-lock text-primary"></i>
            <p class="text">Ganti Password</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= site_url('login/keluar') ?>" class="nav-link">
            <i class="nav-icon fa fa-sign-out-alt"></i>
            <p>
                Logout
            </p>
        </a>

    </li>

<?php endif; ?>

<?= $this->endSection(); ?>