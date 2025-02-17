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
    $iduser = $_POST['iduser'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $namauser = $_POST['namuser'];
    $emailuser  = $_POST['emailuser'];
    $level  = $_POST['level'];
    // Query untuk update data produk
    $sql = "UPDATE user SET  
                username = '$username', 
                password = '$password',
                namauser = '$namauser',
                emailuser = '$emailuser',
                level = '$level'
            WHERE iduser = '$iduser'";

    if (mysqli_query($conn, $sql)) {
        // Jika update berhasil, redirect ke halaman utama atau halaman lain
        header("Location: dashboard-user.php"); // Ganti dengan halaman yang diinginkan
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>