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

// Ambil nis yang diteruskan lewat URL
if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    // Query untuk mengambil data siswa berdasarkan nis
    $sql = "SELECT * FROM guru WHERE nip = '$nip'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Ambil data siswa
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Data Guru tidak ditemukan!";
        exit;
    }
} else {
    echo "NIP Guru tidak tersedia!";
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
    <title>Detail Guru</title>
    <link href="assets/img/logo-new.png" rel="icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            background-color: #f76d12;
        }

        .container {
            padding: 20px;
            margin-top: 20px;
        }

        .student-detail {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }

        .student-detail h3 {
            margin-top: 0;
            font-size: 24px;
        }

        .student-detail p {
            font-size: 18px;
        }

        .student-detail .btn-back {
            background-color: #bd0e0e;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            text-align: center;
        }

        .student-detail .btn-back:hover {
            background-color: #f76d12;
        }

    </style>
</head>
<body>

<header>
    <h1>Detail Guru</h1>
    <nav>
    </nav>
</header>

<div class="container">
    <div class="student-detail">
        <h3>Detail Guru: <?php echo $row['namaguru']; ?></h3>
        <p><strong>Foto:</strong> <img src="assets/img/<?php echo $row['foto']; ?>" alt="Foto Siswa" width="250" height="350"></p>
        <p><strong>NIP:</strong> <?php echo $row['nip']; ?></p>
        <p><strong>Nama Guru:</strong> <?php echo $row['namaguru']; ?></p>
        <p><strong>Jenis Kelamin:</strong> <?php echo $row['jeniskelamin']; ?></p>
        <p><strong>Kontak:</strong> <?php echo $row['kontak']; ?></p>

        <a href="dashboard-guru.php" class="btn-back">Kembali ke Data Guru</a>
    </div>
</div>

</body>
</html>