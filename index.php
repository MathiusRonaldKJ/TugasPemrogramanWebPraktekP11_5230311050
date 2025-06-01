<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: blanchedalmond;
            color: #333;
            max-width: 650px;
            margin: auto;
            padding: 20px;
        }

        h2.section-title {
            background-color: #3EB489; 
            color: white;
            text-align: center;
            margin: 0;
            padding: 10px 0;
            border: 1px solid #ccc;
            border-bottom: none; 
            border-radius: 6px 6px 0 0; 
            width: 100%;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 0; 
            border: 1px solid #ccc;
            border-top: none; 
            border-radius: 0 0 6px 6px; 
        }


        form {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin: 8px 0;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #00B16A; 
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #319977;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-bottom: 30px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th {
            background-color: white; 
            color: black;
            padding: 10px;
            text-align: center;
        }

        td {
            padding: 10px;
        }

        hr {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>

</head>
<body>
    <h2 class="section-title">Data Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Prodi</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $hasil = mysqli_query($connection, "SELECT * FROM tb_mahasiswa");

            while ($data = mysqli_fetch_array($hasil)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($data['nama_mahasiswa']) . "</td>";
                echo "<td>" . htmlspecialchars($data['prodi_mahasiswa']) . "</td>";
                echo "<td>" . htmlspecialchars($data['semester_mahasiswa']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h2 class="section-title">Tambah Data Mahasiswa</h2>
    <form action="tambah.php" method="post">
        <label for="nama_mahasiswa">Nama Mahasiswa:</label><br>
        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" required><br>

        <label for="prodi_mahasiswa">Prodi:</label><br>
        <input type="text" id="prodi_mahasiswa" name="prodi_mahasiswa" required><br>

        <label for="semester_mahasiswa">Semester:</label><br>
        <input type="text" id="semester_mahasiswa" name="semester_mahasiswa" required><br>

        <input type="submit" value="Tambah Data">
    </form>

    <h2 class="section-title">Cari Data Mahasiswa</h2>
    <form action="cari.php" method="post">
        <label for="nama_cari">Nama Mahasiswa:</label><br>
        <input type="text" id="nama_cari" name="nama_mahasiswa" required><br>
        <input type="submit" value="Cari Data">
    </form>

    <h2 class="section-title">Update Data Mahasiswa</h2>
    <form method="post">
        <label for="nama_update">Nama Mahasiswa:</label><br>
        <input type="text" id="nama_update" name="nama_update" required><br>
        <input type="submit" name="cari_nama_update" value="Cari Data Update ">
    </form>

    <?php
    if (isset($_POST['cari_nama_update'])) {
        $nama = mysqli_real_escape_string($connection, $_POST['nama_update']);
        $query = mysqli_query($connection, "SELECT * FROM tb_mahasiswa WHERE nama_mahasiswa LIKE '%$nama%'");

        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
    ?>
                <form action="update.php" method="post">
                    <input type="hidden" name="id_mahasiswa" value="<?= $data['id_mahasiswa'] ?>">
                    <label>Nama Mahasiswa:</label><br>
                    <input type="text" name="nama_mahasiswa" value="<?= htmlspecialchars($data['nama_mahasiswa']) ?>" required><br>
                    <label>Prodi:</label><br>
                    <input type="text" name="prodi_mahasiswa" value="<?= htmlspecialchars($data['prodi_mahasiswa']) ?>" required><br>
                    <label>Semester:</label><br>
                    <input type="text" name="semester_mahasiswa" value="<?= htmlspecialchars($data['semester_mahasiswa']) ?>" required><br><br>
                    <input type="submit" value="Update Data">
                </form>
                <hr>
    <?php
            }
        } else {
            echo "<p class='error'>Data tidak ditemukan untuk nama: " . htmlspecialchars($nama) . "</p>";
        }
    }
    ?>

    <h2 class="section-title">Hapus Data Mahasiswa</h2>
    <form method="post">
        <label for="nama_delete">Nama Mahasiswa:</label><br>
        <input type="text" id="nama_delete" name="nama_delete" required><br>
        <input type="submit" name="cari_nama_delete" value="Cari Data Hapus">
    </form>

    <?php
    if (isset($_POST['cari_nama_delete'])) {
        $nama = mysqli_real_escape_string($connection, $_POST['nama_delete']);
        $query = mysqli_query($connection, "SELECT * FROM tb_mahasiswa WHERE nama_mahasiswa LIKE '%$nama%'");

        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
    ?>
                <form action="delete.php" method="get" onsubmit="return confirm('Benar akan menghapus data ini?');">
                    <input type="hidden" name="id" value="<?= $data['id_mahasiswa'] ?>">
                    
                    <label>Nama Mahasiswa:</label><br>
                    <input type="text" value="<?= htmlspecialchars($data['nama_mahasiswa']) ?>" disabled><br>

                    <label>Prodi:</label><br>
                    <input type="text" value="<?= htmlspecialchars($data['prodi_mahasiswa']) ?>" disabled><br>

                    <label>Semester:</label><br>
                    <input type="text" value="<?= htmlspecialchars($data['semester_mahasiswa']) ?>" disabled><br><br>
                    
                    <input type="submit" value="Hapus Data">
                </form>
                <hr>
    <?php
            }
        } else {
            echo "<p class='error'>Data tidak ditemukan untuk nama: " . htmlspecialchars($nama) . "</p>";
        }
    }
    ?>



</body>
</html>
