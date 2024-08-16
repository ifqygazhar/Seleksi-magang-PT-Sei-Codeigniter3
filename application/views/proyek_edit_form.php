<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proyek dan Lokasi</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
</head>

<body>
    <h1>Edit Proyek</h1>

    <?php echo form_open('proyek/update/' . (isset($proyek['id']) ? $proyek['id'] : '')); ?>

    <?php if (validation_errors()) : ?>
        <div style="color: red;">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <fieldset>
        <legend>Proyek</legend>

        <label for="namaProyek">Nama Proyek:</label>
        <input type="text" id="namaProyek" name="proyek[namaProyek]" value="<?php echo isset($proyek['namaProyek']) ? $proyek['namaProyek'] : ''; ?>" required><br>

        <label for="client">Client:</label>
        <input type="text" id="client" name="proyek[client]" value="<?php echo isset($proyek['client']) ? $proyek['client'] : ''; ?>" required><br>

        <label for="tglMulai">Tanggal Mulai:</label>
        <input type="datetime-local" id="tglMulai" name="proyek[tglMulai]" value="<?php echo isset($proyek['tglMulai']) ? date('Y-m-d\TH:i', strtotime($proyek['tglMulai'])) : ''; ?>" required><br>

        <label for="tglSelesai">Tanggal Selesai:</label>
        <input type="datetime-local" id="tglSelesai" name="proyek[tglSelesai]" value="<?php echo isset($proyek['tglSelesai']) ? date('Y-m-d\TH:i', strtotime($proyek['tglSelesai'])) : ''; ?>" required><br>

        <label for="pimpinanProyek">Pimpinan Proyek:</label>
        <input type="text" id="pimpinanProyek" name="proyek[pimpinanProyek]" value="<?php echo isset($proyek['pimpinanProyek']) ? $proyek['pimpinanProyek'] : ''; ?>" required><br>

        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="proyek[keterangan]"><?php echo isset($proyek['keterangan']) ? $proyek['keterangan'] : ''; ?></textarea><br>
    </fieldset>

    <fieldset>
    <legend>Lokasi</legend>
    <?php if (is_array($lokasi) && !empty($lokasi)) : ?>
        <?php foreach ($lokasi as $loc) : ?>
            <?php if (is_array($loc) && isset($loc['id'], $loc['namaLokasi'], $loc['kota'], $loc['provinsi'])) : ?>
                <label for="lokasi_<?php echo htmlspecialchars($loc['id']); ?>">
                    <input type="checkbox" id="lokasi_<?php echo htmlspecialchars($loc['id']); ?>" name="lokasi[]" value="<?php echo htmlspecialchars($loc['id']); ?>" <?php echo set_checkbox('lokasi[]', $loc['id']); ?>>
                    <?php echo htmlspecialchars($loc['namaLokasi']); ?> (<?php echo htmlspecialchars($loc['kota']); ?>, <?php echo htmlspecialchars($loc['provinsi']); ?>)
                </label>
            <?php else : ?>
                <p>Data lokasi tidak valid.</p>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Data lokasi kosong.</p>
    <?php endif; ?>
</fieldset>



    <button type="submit">Edit</button>
    <?php echo form_close(); ?>

</body>

</html>