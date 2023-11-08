<?php
include('koneksi.php'); // Sertakan file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_siswa = $_POST["id_siswa"];
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $jurusan = $_POST["jurusan"];
    $no_hp = $_POST["no_hp"];
    $alamat = $_POST["alamat"];

    // Proses unggah foto jika ada file yang diunggah
    if (isset($_FILES['foto_diri']) && $_FILES['foto_diri']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Direktori tempat Anda ingin menyimpan foto
        $nama_berkas = $_FILES['foto_diri']['name'];
        $uploadPath = $uploadDir . $nama_berkas;

        // Pindahkan file yang diunggah ke direktori yang ditentukan
        if (move_uploaded_file($_FILES['foto_diri']['tmp_name'], $uploadPath)) {
            $foto_diri = $nama_berkas;
        } else {
            echo "Gagal mengunggah foto.";
            exit();
        }
    }

    // Update data siswa, termasuk foto_diri jika diunggah
    $sql = "UPDATE siswa SET nama='$nama', kelas='$kelas', jurusan='$jurusan', no_hp='$no_hp', alamat='$alamat'";
    if (isset($foto_diri)) {
        $sql .= ", foto_diri='$foto_diri'";
    }
    $sql .= " WHERE id_siswa=$id_siswa";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama setelah berhasil edit data
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
?>
