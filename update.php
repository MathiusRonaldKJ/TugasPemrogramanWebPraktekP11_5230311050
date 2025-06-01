<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_mahasiswa'];
    $nama = $_POST['nama_mahasiswa'];
    $prodi = $_POST['prodi_mahasiswa'];
    $semester = $_POST['semester_mahasiswa'];

    $sql = "UPDATE tb_mahasiswa 
            SET nama_mahasiswa='$nama', prodi_mahasiswa='$prodi', semester_mahasiswa='$semester' 
            WHERE id_mahasiswa=$id";

    if (mysqli_query($connection, $sql)) {
        echo "Data berhasil diupdate. <a href='index.php'>Kembali</a>";
    } else {
        echo "Gagal update: " . mysqli_error($connection);
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = $id");

    if ($data = mysqli_fetch_assoc($query)) {
?>
        <h2>Edit Data Mahasiswa</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id_mahasiswa" value="<?= $data['id_mahasiswa'] ?>">
            <label>Nama:</label><br>
            <input type="text" name="nama_mahasiswa" value="<?= $data['nama_mahasiswa'] ?>" required><br>
            <label>Prodi:</label><br>
            <input type="text" name="prodi_mahasiswa" value="<?= $data['prodi_mahasiswa'] ?>" required><br>
            <label>Semester:</label><br>
            <input type="text" name="semester_mahasiswa" value="<?= $data['semester_mahasiswa'] ?>" required><br><br>
            <input type="submit" value="Update">
        </form>
        <a href="index.php">Kembali</a>
<?php
    } else {
        echo "Data tidak ditemukan. <a href='index.php'>Kembali</a>";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
