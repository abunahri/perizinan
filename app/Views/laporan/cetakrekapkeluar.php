<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Rekap Perizinan Keluar</title>
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
  <style type="text/css" media="print">
  @page { 
    size: landscape;
  }
  
</style>

</head>
<body onload="window.print();">
  <table style="text-align:center; width: 100%; border: none; ">
    <tr>
      <td colspan="2">
        <h3 style="font-family: arial;">REKAP PERIZINAN KELUAR SANTRI</h3>
        <h5 style="margin-top: 10px; font-family: arial;"><?= $setting['nama_sekolah'] ?></h5>
        <hr style="border-top: 1px solid #000; margin-top: 30px;" width="100%">
      </td>
    </tr>

    <tr style="text-align: left">
      <td width="150">Kelas</td>
      <td>: <?= $kelas ?></td>
    </tr>

    <tr style="text-align: left">
      <td>Kamar</td>
      <td>: <?= $kamar ?></td>
    </tr>
    <tr>
      <td colspan="2">
        <hr style="border: none; border-top: 1px solid; #000;">
      </td>
    </tr>
    
  </table>
  <table class="table table-bordered" style="width: 100%;">
    <thead style="border: 1px solid black;">
      <tr style="border: 1px solid black;">
        <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
        <th rowspan="2" style="text-align: center; vertical-align: middle;">Nama Siswa</th>
        <th rowspan="2" style="text-align: center; vertical-align: middle;">NIS</th>
        <!-- <th rowspan="2" style="text-align: center; vertical-align: middle;">Kelas</th>
          <th rowspan="2" style="text-align: center; vertical-align: middle;">Kamar</th> -->
          <th colspan="12" style="text-align: center; vertical-align: middle;">Bulan</th>
          <th rowspan="2" style="text-align: center; vertical-align: middle;">Total Izin</th>
        </tr>
        <tr style="border: 1px solid black;">
          <th>Jul</th>
          <th>Aug</th>
          <th>Sep</th>
          <th>Okt</th>
          <th>Nov</th>
          <th>Des</th>
          <th>Jan</th>
          <th>Feb</th>
          <th>Mar</th>
          <th>Apr</th>
          <th>Mei</th>
          <th>Jun</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $nomor = 1;

        foreach ($tampildata->getResultArray() as $row) :

          ?>
          <tr>
            <td><?= $nomor++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nis'] ?></td>
            
            <td><?= ($row['Juli'] > 0) ? $row['Juli'] : '-' ?></td>
            <td><?= ($row['Agustus'] > 0) ? $row['Agustus'] : '-' ?></td>
            <td><?= ($row['September'] > 0) ? $row['September'] : '-'  ?></td>
            <td><?= ($row['Oktober'] > 0) ? $row['Oktober'] : '-' ?></td>
            <td><?= ($row['November'] > 0) ? $row['November'] : '-' ?></td>
            <td><?= ($row['Desember'] > 0) ? $row['Desember'] : '-' ?></td>
            <td><?= ($row['Januari'] > 0) ? $row['Januari'] : '-' ?></td>
            <td><?= ($row['Februari'] > 0) ? $row['Februari'] : '-' ?></td>
            <td><?= ($row['Maret'] > 0) ? $row['Maret'] : '-' ?></td>
            <td><?= ($row['April'] > 0) ? $row['April'] : '-' ?></td>
            <td><?= ($row['Mei'] > 0) ? $row['Mei'] : '-' ?></td>
            <td><?= ($row['Juni'] > 0) ? $row['Juni'] : '-' ?></td>
            <td><?= $row['Total'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </body>
  </html>