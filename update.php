<!-- <?php
include('koneksi.php'); // Sertakan file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_siswa = $_POST["id_siswa"];
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $jurusan = $_POST["jurusan"];
    $no_hp = $_POST["no_hp"];
    $alamat = $_POST["alamat"];
    $foto_diri = $_POST["foto_diri"];
    
    // Update data siswa
    $sql = "UPDATE siswa SET nama='$nama', kelas='$kelas', jurusan='$jurusan', no_hp='$no_hp', alamat='$alamat', foto_diri='$foto_diri' WHERE id_siswa=$id_siswa";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama setelah berhasil edit data
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

if (isset($_GET["id"])) {
    $id_siswa = $_GET["id"];
    
    // Ambil data siswa berdasarkan id_siswa
    $sql = "SELECT * FROM siswa WHERE id_siswa=$id_siswa";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data siswa tidak ditemukan.";
        exit();
    }
}

if (isset($_FILES['foto_diri'])) {
    $file = $_FILES['foto_diri'];

    // Periksa apakah tidak ada kesalahan dalam pengunggahan
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Direktori tempat Anda ingin menyimpan foto
        $nama_berkas = $file['name'];
        $uploadPath = $uploadDir . $nama_berkas;

        // Pindahkan file yang diunggah ke direktori yang ditentukan
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            // Masukkan data ke database dengan nama berkas
            $sql = "INSERT INTO siswa (nama, kelas, jurusan, no_hp, alamat, foto_diri) VALUES ('$nama', '$kelas', '$jurusan', '$no_hp', '$alamat', '$foto_diri')";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php"); // Redirect ke halaman utama setelah berhasil menambahkan data
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengunggah foto.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah foto.";
    }
}
?> -->

<!-- Tampilkan form HTML untuk edit data -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
</head>
<body>
    <h1>Edit Siswa</h1>

    <form action="proses_update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_siswa" value="<?php echo $row['id_siswa']; ?>">

        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required><br>

        <label for="kelas">Kelas:</label>
        <input type="text" name="kelas" value="<?php echo $row['kelas']; ?>" required><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" name="jurusan" value="<?php echo $row['jurusan']; ?>" required><br>

        <label for="no_hp">No HP:</label>
        <input type="text" name="no_hp" value="<?php echo $row['no_hp']; ?>" required><br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" rows="4" required><?php echo $row['alamat']; ?></textarea><br>

        <label for="alamat">Foto Diri:</label>
        <input type="file" name="foto_diri" accept="image/*" value="<?php echo $row['foto_diri']; ?>" required><br>

        <input type="submit" value="Simpan Perubahan">
    </form>

    <a href="index.php">Kembali ke Daftar Siswa</a>
</body>
</html>
