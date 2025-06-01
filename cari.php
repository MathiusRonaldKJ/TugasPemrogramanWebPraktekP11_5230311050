<?php 
include 'koneksi.php';

$nama_mahasiswa = $_POST['nama_mahasiswa'];

$sql = "SELECT * FROM tb_mahasiswa WHERE nama_mahasiswa LIKE '%$nama_mahasiswa%'";
$hasil = mysqli_query($connection, $sql);

if (mysqli_num_rows($hasil) > 0) {
    echo "<h1>Hasil Pencarian Mahasiswa</h1>";
    while ($data = mysqli_fetch_array($hasil)) {
        echo "Nama Mahasiswa: " . htmlspecialchars($data['nama_mahasiswa']) . "<br>";
        echo "Prodi: " . htmlspecialchars($data['prodi_mahasiswa']) . "<br>";
        echo "Semester: " . htmlspecialchars($data['semester_mahasiswa']) . "<br><br>";
    }
} else {
    echo "<br>Tidak Ada Data Yang Ditemukan Untuk Nama: <b>" . htmlspecialchars($nama_mahasiswa) . "</b>";
}

echo "<br><a href='index.php'>Kembali ke Halaman Utama</a>";
?>
