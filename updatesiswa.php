<style>
    .update-form {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.update-form label {
    display: block;
    margin-bottom: 5px;
}

.update-form input[type="text"],
.update-form input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.update-form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
</style>
<?php
// Ambil id produk yang diteruskan lewat URL
if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "database_ukk");

    // Siapkan query dengan parameter untuk mencegah injection
    $stmt = $conn->prepare("SELECT * FROM siswa WHERE nis = ?");
    $stmt->bind_param("i", $nis);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Tampilkan form untuk mengupdate data dengan styling CSS
        echo '<form method="post" action="prosessiswa.php" class="update-form">
              <label for="nis">Nis:</label>
             <input type="text" id="nis" name="nis" value="' . $row['nis'] . '"><br>
            <label for="namasiswa">Nama Siswa:</label>
            <input type="text" id="namasiswa" name="namasiswa" value="' . $row['namasiswa'] . '"><br>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="' . $row['alamat'] . '"><br>
            <label for="jeniskelamin">Jenis Kelamin:</label>
            <input type="text" id="jeniskelamin" name="jeniskelamin" value="' . $row['jeniskelamin'] . '"><br>
            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="' . $row['kelas'] . '"><br>
            <label for="ttl">TTL:</label>
            <input type="text" id="ttl" name="ttl" value="' . $row['ttl'] . '"><br>
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" value="' . $row['foto'] . '"><br>
            
            <input type="submit" value="Update">
        </form>';
    } else {
        echo "Data tidak ditemukan!";
    }

    $stmt->close();
    $conn->close();
}
?>