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
    $idproduk = $_POST['idproduk'];
    $namaproduk = $_POST['namaproduk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $foto = $_POST['foto'];

    $sql = "INSERT INTO produk (idproduk, namaproduk, jumlah, harga, deskripsi, tanggal, foto) 
            VALUES ('$idproduk', '$namaproduk', '$jumlah', '$harga', '$deskripsi', '$tanggal', '$foto')";

    if (mysqli_query($conn, $sql)) {
        echo "Produk Berhasil Ditambahkan!";
        header("Location: dashboard-produk.php"); // Arahkan kembali ke halaman utama setelah insert
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
    <title>Tambah Produk</title>
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

    <h2>Tambah Produk Baru</h2>
    <form method="POST" action="createproduk.php">
        <label for="idproduk">ID Produk:</label>
        <input type="text" id="idproduk" name="idproduk" required><br>

        <label for="namaproduk">Nama Produk:</label>
        <input type="text" id="namaproduk" name="namaproduk" required><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" required><br>

        <label for="harga">Harga:</label>
        <input type="text" id="harga" name="harga" required><br>

        <label for="deskripsi">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" required><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required><br><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" required><br><br>


        <input type="submit" value="Tambah Produk">
    </form>

</body>
</html>