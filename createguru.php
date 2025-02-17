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
    $nip = $_POST['nip'];
    $namaguru = $_POST['namaguru'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $kontak = $_POST['kontak'];
    $foto = $_POST['foto'];

    $sql = "INSERT INTO guru (nip, namaguru, jeniskelamin, kontak, foto) 
            VALUES ('$nip', '$namaguru', '$jeniskelamin', '$kontak', '$foto')";

    if (mysqli_query($conn, $sql)) {
        echo "Data Guru Berhasil Ditambahkan!";
        header("Location: dashboard-guru.php"); // Arahkan kembali ke halaman utama setelah insert
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
    <title>Tambah Data Guru</title>
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
            max-width: 400px;
            margin: 0 auto;
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
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

    <h2>Tambah Data Guru Baru</h2>
    <form method="POST" action="createguru.php">
        <label for="nip">NIP:</label>
        <input type="text" id="nip" name="nip" required><br>

        <label for="namaguru">Nama Guru:</label>
        <input type="text" id="namaguruk" name="namaguru" required><br>

        <label for="jeniskelamin">Jenis Kelamin:</label>
        <select id="jeniskelamin" name="jeniskelamin" required>
            <option value="">Pilih Gender</option>
            <option value="laki-laki">Laki-laki</option>
            <option value="perempuan">Perempuan</option>
        </select><br><br>

        <label for="kontak">kontak:</label>
        <input type="text" id="kontak" name="kontak" required><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" required><br><br>


        <input type="submit" value="Tambah Data">
    </form>

</body>
</html>