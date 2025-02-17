<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_ukk";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil iduser yang diteruskan lewat URL
if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];

    // Query untuk mengambil data user berdasarkan iduser
    $sql = "SELECT * FROM user WHERE iduser = '$iduser'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Ambil data user
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Pengguna tidak ditemukan!";
        exit;
    }
} else {
    echo "ID Pengguna tidak tersedia!";
    exit;
}

// Tutup koneksi
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(227, 207, 207);
            margin: 0;
            padding: 0;
        }

        header {
            background-color: rgb(32, 168, 206);
            color: white;
            padding: 10px 20px;
        }

        header h1 {
            display: inline-block;
            margin: 0;
        }

        nav {
            float: right;
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin-left: 20px;
        }

        nav a:hover {
            background-color: rgb(17, 68, 62);
        }

        .container {
            padding: 20px;
            margin-top: 20px;
        }

        .user-detail {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }

        .user-detail h3 {
            margin-top: 0;
            font-size: 24px;
        }

        .user-detail p {
            font-size: 18px;
        }

        .user-detail .btn-back {
            background-color: rgb(12, 128, 59);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            text-align: center;
        }

        .user-detail .btn-back:hover {
            background-color: rgb(9, 51, 135);
        }
    </style>
</head>
<body>

<header>
    <h1>Detail Pengguna</h1>
    <nav>
    </nav>
</header>

<div class="container">
    <div class="user-detail">
        <h3>Detail Pengguna: <?php echo $row['namauser']; ?></h3>
        <p><strong>ID User:</strong> <?php echo $row['iduser']; ?></p>
        <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
        <p><strong>Password:</strong> <?php echo $row['password']; ?></p>
        <p><strong>Nama User:</strong> <?php echo $row['namauser']; ?></p>
        <p><strong>Email User:</strong> <?php echo $row['emailuser']; ?></p>
        <p><strong>Level:</strong> <?php echo $row['level']; ?></p>

        <a href="dashboard-user.php" class="btn-back">Kembali ke Data Pengguna</a>
    </div>
</div>

</body>
</html>