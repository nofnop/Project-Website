<?php
include('koneksi.php'); // Sertakan file koneksi ke database

if (isset($_GET["id"])) {
    $id_siswa = $_GET["id"];
    
    // Hapus data siswa berdasarkan id_siswa
    $sql = "DELETE FROM siswa WHERE id_siswa=$id_siswa";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama setelah berhasil hapus data
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>
