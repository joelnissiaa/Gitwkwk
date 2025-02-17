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
    $nis = $_POST['nis'];
    $namasiswa = $_POST['namasiswa'];
    $alamat = $_POST['alamat'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $kelas = $_POST['kelas'];
    $ttl = $_POST['ttl'];
    $foto  = $_POST['foto'];
    // Query untuk update data produk
    $sql = "UPDATE siswa SET 
                namasiswa = '$namasiswa', 
                alamat = '$alamat', 
                jeniskelamin = '$jeniskelamin', 
                kelas = '$kelas',
                ttl = '$ttl',
                foto = '$foto'
            WHERE nis = '$nis'";

    if (mysqli_query($conn, $sql)) {
        // Jika update berhasil, redirect ke halaman utama atau halaman lain
        header("Location: dashboard-siswa.php"); // Ganti dengan halaman yang diinginkan
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>