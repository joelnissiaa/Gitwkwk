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
if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "database_ukk");

    // Siapkan query dengan parameter untuk mencegah injection
    $stmt = $conn->prepare("SELECT * FROM guru WHERE nip = ?");
    $stmt->bind_param("i", $nip);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Tampilkan form untuk mengupdate data dengan styling CSS
        echo '<form method="post" action="prosesguru.php" class="update-form">
                        <label for="nip">NIP:</label>
            <input type="text" id="nip" name="nip" value="' . $row['nip'] . '"><br>
            <label for="namaguru">Nama Guru:</label>
            <input type="text" id="namaguru" name="namaguru" value="' . $row['namaguru'] . '"><br>
            <label for="jeniskelamin">Jenis Kelamin:</label>
              <select id="jeniskelamin" name="jeniskelamin">
                  <option value="lakilaki"' . ($row['jeniskelamin'] == 'lakilaki' ? ' selected' : '') . '>Laki-laki</option>
                  <option value="perempuan"' . ($row['jeniskelamin'] == 'perempuan' ? ' selected' : '') . '>Perempuan</option>
              </select><br>
            <label for="kontak">Kontak:</label>
            <input type="text" id="kontak" name="kontak" value="' . $row['kontak'] . '"><br>
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