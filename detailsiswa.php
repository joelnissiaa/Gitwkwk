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
if (isset($_GET['id'])) {
    $nis = $_GET['id'];

    // Query untuk mengambil data siswa berdasarkan nis
    $sql = "SELECT * FROM siswa WHERE nis = '$nis'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Ambil data siswa
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Siswa tidak ditemukan!";
        exit;
    }
} else {
    echo "NIS tidak tersedia!";
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
    <title>Detail Siswa</title>
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
            background-color:rgb(32, 168, 206);
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
    <h1>Detail Siswa</h1>
    <nav>
    </nav>
</header>

<div class="container">
    <div class="student-detail">
        <h3>Detail Siswa: <?php echo $row['namasiswa']; ?></h3>
        <p><strong>Foto:</strong> <img src="assets/img/team/<?php echo $row['foto']; ?>" alt="Foto Siswa" width="150" height="150"></p>
        <p><strong>NIS:</strong> <?php echo $row['nis']; ?></p>
        <p><strong>Nama Siswa:</strong> <?php echo $row['namasiswa']; ?></p>
        <p><strong>Alamat:</strong> <?php echo $row['alamat']; ?></p>
        <p><strong>Jenis Kelamin:</strong> <?php echo $row['jeniskelamin']; ?></p>
        <p><strong>Kelas:</strong> <?php echo $row['kelas']; ?></p>
        <p><strong>Tanggal Lahir:</strong> <?php echo $row['ttl']; ?></p>

        <a href="dashboard-siswa.php" class="btn-back">Kembali ke Data Siswa</a>
    </div>
</div>

</body>
</html>