<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Proyek</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
</head>

<body>
    <h1>Form Proyek</h1>

   
    <?php if (validation_errors()) : ?>
        <div style="color: red;">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php echo form_open('proyek/store'); ?>

    <fieldset>
        <legend>Lokasi</legend>
        <?php foreach ($lokasi as $loc) : ?>
            
            <label for="lokasi_<?php echo $loc['id']; ?>">
            <input type="checkbox" id="lokasi_<?php echo $loc['id']; ?>" name="lokasi[]" value="<?php echo $loc['id']; ?>" <?php echo set_checkbox('lokasi[]', $loc['id']); ?>>
                <?php echo $loc['namaLokasi']; ?> (<?php echo $loc['kota']; ?>, <?php echo $loc['provinsi']; ?>)
            </label>
        <?php endforeach; ?>
    </fieldset>

    <fieldset>
        <legend>Proyek</legend>
        <label for="namaProyek">Nama Proyek:</label>
        <input type="text" id="namaProyek" name="proyek[namaProyek]" value="<?php echo set_value('proyek[namaProyek]'); ?>" required><br>

        <label for="client">Client:</label>
        <input type="text" id="client" name="proyek[client]" value="<?php echo set_value('proyek[client]'); ?>" required><br>

        <label for="tglMulai">Tanggal Mulai:</label>
        <input type="datetime-local" id="tglMulai" name="proyek[tglMulai]" value="<?php echo set_value('proyek[tglMulai]'); ?>" required><br>

        <label for="tglSelesai">Tanggal Selesai:</label>
        <input type="datetime-local" id="tglSelesai" name="proyek[tglSelesai]" value="<?php echo set_value('proyek[tglSelesai]'); ?>" required><br>

        <label for="pimpinanProyek">Pimpinan Proyek:</label>
        <input type="text" id="pimpinanProyek" name="proyek[pimpinanProyek]" value="<?php echo set_value('proyek[pimpinanProyek]'); ?>" required><br>

        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="proyek[keterangan]"><?php echo set_value('proyek[keterangan]'); ?> </textarea><br>
    </fieldset>

    <button type="submit">Simpan</button>
    <?php echo form_close(); ?>

</body>

</html>
