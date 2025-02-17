<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_ukk";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses data form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = $_POST['nis'];
    $namasiswa = $_POST['namasiswa'];
    $alamat = $_POST['alamat'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $kelas = $_POST['kelas'];
    $ttl = $_POST['ttl'];
    $foto = $_POST['foto'];

    $sql = "INSERT INTO siswa (nis, namasiswa, alamat, jeniskelamin, kelas, ttl, foto) 
            VALUES ('$nis', '$namasiswa', '$alamat', '$jeniskelamin', '$kelas', '$ttl', '$foto')";

    if (mysqli_query($conn, $sql)) {
        echo "Siswa Berhasil Ditambahkan!";
        header("Location: dashboard-siswa.php"); // Arahkan kembali ke halaman utama setelah insert
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 400px;
            margin: 0 auto;
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form .kolom {
            margin: 0px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Tambah Siswa Baru</h2>
    <form method="POST" action="createsiswa.php">
        <label for="nis">NIS:</label>
        <input type="text" id="nis" name="nis" class="kolom" required><br>

        <label for="namasiswa">Nama Siswa:</label>
        <input type="text" id="namasiswa" name="namasiswa" class="kolom" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" class="kolom" required><br>

        <label for="jeniskelamin">Jenis Kelamin:</label>
        <input type="text" id="jeniskelamin" name="jeniskelamin" class="kolom" required><br>

        <label for="kelas">Kelas:</label>
        <input type="text" id="kelas" name="kelas" class="kolom" required><br>

        <label for="ttl">TTL:</label>
        <input type="date" id="ttl" name="ttl" class="kolom" required><br><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" class="kolom" required><br><br>

        <input type="submit" value="Tambah Siswa">
    </form>

</body>
</html>