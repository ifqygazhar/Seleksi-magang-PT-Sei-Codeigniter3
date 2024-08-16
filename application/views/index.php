<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Proyek Dan Lokasi</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
</head>
<body>
    <h1>Proyek Dan Lokasi</h1>

    <div class="button-container">
        <a href="<?php echo site_url('proyek/create'); ?>"><button>Tambah Proyek</button></a>
        <a href="<?php echo site_url('lokasi/create'); ?>"><button>Tambah Lokasi</button></a>
    </div>

    <h2>Daftar Proyek</h2>
    <?php if (isset($proyek['data']) && !empty($proyek['data'])): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Proyek</th>
                    <th>Client</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Pimpinan Proyek</th>
                    <th>Keterangan</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyek['data'] as $proyek_item): ?>
                    <tr>
                        <td><?php echo $proyek_item['id']; ?></td>
                        <td><?php echo $proyek_item['namaProyek']; ?></td>
                        <td><?php echo $proyek_item['client']; ?></td>
                        <td><?php echo $proyek_item['tglMulai']; ?></td>
                        <td><?php echo $proyek_item['tglSelesai']; ?></td>
                        <td><?php echo $proyek_item['pimpinanProyek']; ?></td>
                        <td><?php echo $proyek_item['keterangan']; ?></td>
                        <td>
                            <ul>
                                <?php foreach ($proyek_item['lokasi'] as $lokasi_item): ?>
                                    <li><?php echo $lokasi_item['namaLokasi']; ?> (<?php echo $lokasi_item['kota']; ?>, <?php echo $lokasi_item['provinsi']; ?>, <?php echo $lokasi_item['negara']; ?>)</li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td>
                            <a href="<?php echo site_url('proyek/edit/' . $proyek_item['id']); ?>">Edit</a> |
                            <a href="<?php echo site_url('proyek/delete/' . $proyek_item['id']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada data proyek.</p>
    <?php endif; ?>

    <h2>Daftar Lokasi</h2>
    <?php if (isset($lokasi['data']) && !empty($lokasi['data'])): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lokasi</th>
                    <th>Negara</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Created At</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lokasi['data'] as $lokasi_item): ?>
                    <tr>
                        <td><?php echo $lokasi_item['id']; ?></td>
                        <td><?php echo $lokasi_item['namaLokasi']; ?></td>
                        <td><?php echo $lokasi_item['negara']; ?></td>
                        <td><?php echo $lokasi_item['provinsi']; ?></td>
                        <td><?php echo $lokasi_item['kota']; ?></td>
                        <td><?php echo $lokasi_item['createdAt']; ?></td>
                        <td>
                            <a href="<?php echo site_url('lokasi/edit/' . $lokasi_item['id']); ?>">Edit</a> |
                            <a href="<?php echo site_url('lokasi/delete/' . $lokasi_item['id']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada data lokasi.</p>
    <?php endif; ?>
</body>
</html>
