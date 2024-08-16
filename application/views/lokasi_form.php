<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lokasi</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
</head>
<body>

<h2>Form Lokasi</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('lokasi/store'); ?>

    <label for="namaLokasi">Nama Lokasi</label>
    <input type="text" name="lokasi[namaLokasi]" id="namaLokasi" value="<?php echo set_value('lokasi[namaLokasi]'); ?>"><br>

    <label for="negara">Negara</label>
    <input type="text" name="lokasi[negara]" id="negara" value="<?php echo set_value('lokasi[negara]'); ?>"><br>

    <label for="provinsi">Provinsi</label>
    <input type="text" name="lokasi[provinsi]" id="provinsi" value="<?php echo set_value('lokasi[provinsi]'); ?>"><br>

    <label for="kota">Kota</label>
    <input type="text" name="lokasi[kota]" id="kota" value="<?php echo set_value('lokasi[kota]'); ?>"><br>

    <button type="submit">Simpan</button>

<?php echo form_close(); ?>

</body>
</html>
