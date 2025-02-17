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
    $iduser = $_POST['iduser'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $namauser = $_POST['namauser'];
    $emailuser = $_POST['emailuser'];
    $level = $_POST['level'];

    $sql = "INSERT INTO user (iduser, username, password, namauser, emailuser, level) 
            VALUES ('$iduser', '$username', '$password', '$namauser', '$emailuser', '$level')";

    if (mysqli_query($conn, $sql)) {
        echo "Pengguna Berhasil Ditambahkan!";
        header("Location: dashboard-user.php"); // Arahkan kembali ke halaman utama setelah insert
        exit();
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
    <title>Tambah Pengguna</title>
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

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: rgb(65, 142, 205);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Tambah Pengguna Baru</h2>
    <form method="POST" action="createuser.php">
        <label for="iduser">ID User:</label>
        <input type="text" id="iduser" name="iduser" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required><br>

        <label for="namauser">Nama Pengguna:</label>
        <input type="text" id="namauser" name="namauser" required><br>

        <label for="emailuser">Email Pengguna:</label>
        <input type="email" id="emailuser" name="emailuser" required><br>

        <label for="level">Level:</label>
        <select id="level" name="level" required>
            <option value="">Pilih Level</option>
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
        </select><br><br>

        <input type="submit" value="Tambah Pengguna">
    </form>

</body>
</html>