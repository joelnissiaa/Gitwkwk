<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_ukk";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang dikirim dari form
    $idproduk = $_POST['idproduk'];
    $namaproduk = $_POST['namaproduk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $foto  = $_POST['foto'];
    // Query untuk update data produk
    $sql = "UPDATE produk SET 
                namaproduk = '$namaproduk', 
                jumlah = '$jumlah', 
                harga = '$harga', 
                deskripsi = '$deskripsi',
                tanggal = '$tanggal',
                foto = '$foto'
            WHERE idproduk = '$idproduk'";

    if (mysqli_query($conn, $sql)) {
        // Jika update berhasil, redirect ke halaman utama atau halaman lain
        header("Location: dashboard-produk.php"); // Ganti dengan halaman yang diinginkan
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>