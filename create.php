<?php
include('koneksi.php'); // Sertakan file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $jurusan = $_POST["jurusan"];
    $no_hp = $_POST["no_hp"];
    $alamat = $_POST["alamat"];
    
    // Penanganan berkas yang diunggah
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
                $sql = "INSERT INTO siswa (nama, kelas, jurusan, no_hp, alamat, foto_diri) VALUES ('$nama', '$kelas', '$jurusan', '$no_hp', '$alamat', '$nama_berkas')";

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
}
?>

<!-- Tampilkan form HTML untuk tambah data -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
</head>
<body>
    <h1>Tambah Siswa</h1>

    <form action="create.php" method="POST" enctype="multipart/form-data">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br>

        <label for="kelas">Kelas:</label>
        <input type="text" name="kelas" required><br>

        <label for="jurusan">Jurusan:</label>
        <input type text="name" name="jurusan" required><br>

        <label for="no_hp">No HP:</label>
        <input type="text" name="no_hp" required><br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" rows="4" required></textarea><br>

        <label for="foto_diri">Foto Diri:</label>
        <input type="file" name="foto_diri" id="foto_diri" accept="image/*">
        <input type="submit" value="Unggah dan Tambah">

        
    </form>

    <a href="index.php">Kembali ke Daftar Siswa</a>
</body>
</html>
