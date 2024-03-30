<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Rekap Absensi Bulan <?= ucfirst($bulan) ?> (<?= $kamar ?>)</title>
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
  <style type="text/css" media="print">
  @page { 
    size: landscape;
  }

</style>
<style>
.tg  {
  border-collapse:collapse;
  border-spacing:0;
  width: 100%;
}
.tg th{
  border-color:black;
  border-style:solid;
  border-width:1px;
  font-family:Arial, sans-serif;
  font-size:14px; 
  font-weight:normal;
  overflow:hidden;
  padding:10px 5px;
  word-break:normal;
}
.tg td{
  border-color:black;
  border-style:solid;
  border-width:1px;
  font-family:Arial, sans-serif;
  font-size:14px;
  overflow:hidden;
  padding:10px 5px;
  word-break:normal;
}
</style>

</head>
<body onload="window.print();">
  <table style="text-align:center; width: 100%; border: none; ">
    <tr>
      <td colspan="2">
        <h3 style="font-family: arial;">REKAP ABSENSI BULAN <?= strtoupper($bulan) ?></h3>
        <h5 style="margin-top: 10px; font-family: arial;"><?= $setting['nama_sekolah'] ?></h5>
        <hr style="border-top: 1px solid #000; margin-top: 30px;" width="100%">

      </td>
    </tr>
    <tr style="text-align: left">
      <td width="150">Kamar</td>
      <td>: <?= $kamar ?></td>
    </tr>
    <tr style="text-align: left">
      <td>
        <?php if ($jenkel == "Laki-laki") {
          echo "Nama Musrif";
        } else {
          echo "Nama Musrifah";
        }?>
      </td>
      <td>: <?= $musrif ?></td>
    </tr>
    <tr style="text-align: left">
      <td>Tahun Ajaran</td>
      <td>: <?= $tahun['priode'] ?></td>
    </tr>
    <tr>
      <td colspan="2">
        <hr style="border: none; border-top: 1px solid; #000;">
      </td>
    </tr>
    
  </table>
  <table class="tg" width="100%">
    <thead>
      <tr>
        <th class="tg-9wq8" rowspan="2" style="text-align:center;vertical-align:middle">No</th>
        <th class="tg-9wq8" rowspan="2" style="text-align:center;vertical-align:middle;" width="250px">
          <?php if ($jenkel == "Laki-laki") {
           echo "Nama Santriwan";
         } else {
          echo "Nama Santriwati";
        } ?>

      </th>
      <th class="tg-9wq8" colspan="<?= count($tanggal) ?>" style="text-align:center;">Tanggal</th>
      <th class="tg-9wq8" colspan="2">Jumlah</th>
    </tr>
    <tr>
      <?php foreach ($tanggal as $value) : ?>
        <th align="center" style="background: lightgrey;"><?= $value->format('d'); ?></th>
      <?php endforeach; ?>
      <th class="tg-9wq8" style="background: lightgreen;"><center><b>H</b></center></th>
      <th class="tg-9wq8" style="background: red;"><center><b>P</b></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 0; ?>
    <?php 


    foreach($listSantri as $santri) : ?>
      <tr>
        <td class="tg-fymr"><?= $i + 1; ?></td>
        <td class="tg-fymr"><?= $santri['nama'] ?></td>
        <?php foreach ($listAbsen as $absen) : ?>
          <?= kehadiran($absen[$i]['keterangan'] ?? ($absen['lewat'] ? 4 : 3)) ?>
        <?php endforeach; ?>
        <td class="tg-fymr"><center><b><?= $santri['hadir'] ?></b></center></td>
        <td class="tg-fymr"><center><b><?= $santri['pulang'] ?></b></center></td>
      </tr>

      <?php $i++;
    endforeach;  ?>
  </tbody>
</table>

<?php
function kehadiran($kehadiran){
  $text = '';
  switch ($kehadiran) {
    case 1:
    $text = "<td class=\"tg-fymr\" align='center' style='background-color:lightgreen;'><b>H</b></td>";
    break;
    case 2:
    $text = "<td class=\"tg-fymr\" align='center' style='background-color:red;'><b>P</b></td>";
    break;
    case 3:
    $text = "<td class=\"tg-fymr\" align='center' style='background-color:OldLace ;'>-</td>";
    break;
    case 4:
    default:
    $text = "<td class=\"tg-fymr\"></td>";
    break;
  }
  return $text;
}
?>
</body>
</html>
