<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>CRUD Data Siswa</title>
</head>

<body>
    <h1>Data Siswa</h1>

    <a href="create.php">Tambah Siswa</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Foto Diri</th>
            <th colspan='2'>Aksi</th>
        </tr>
        <?php
        include "koneksi.php";
        $sql = "SELECT * FROM siswa ORDER BY id_siswa DESC;";
        $hasil = mysqli_query($conn, $sql);
        $no = 0;

        while ($data = mysqli_fetch_assoc($hasil)) {
            $no++;
            ?>

            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data["nama"]; ?></td>
                <td><?php echo $data["kelas"]; ?></td>
                <td><?php echo $data["jurusan"]; ?></td>
                <td><?php echo $data["no_hp"]; ?></td>
                <td><?php echo $data["alamat"]; ?></td>
                <td>
                    <?php if($data['foto_diri']): ?>
                        <img src="uploads/<?php echo $data['foto_diri']; ?>" alt="Foto" class="siswa-img">
                    <?php else: ?>
                        <span>Tidak ada foto</span>
                    <?php endif; ?>
                </td>
                <td><a href="update.php?id=<?php echo $data["id_siswa"]; ?>">Ubah</a></td>
                <td><a href="delete.php?id=<?php echo $data["id_siswa"]; ?>">Hapus</a></td>
            </tr>
        <?php }
        ?>
    </table>
</body>
</html>

