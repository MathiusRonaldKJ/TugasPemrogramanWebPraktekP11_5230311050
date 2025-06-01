<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tb_mahasiswa WHERE id_mahasiswa = $id";

    if (mysqli_query($connection, $sql)) {
        echo "Data berhasil dihapus. <a href='index.php'>Kembali</a>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($connection);
    }
} else {
    echo "ID tidak ditemukan. <a href='index.php'>Kembali</a>";
}
?>
