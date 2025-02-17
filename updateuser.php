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
    .update-form input[type="date"],
    .update-form select {
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
// Ambil id user yang diteruskan lewat URL
if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "database_ukk");

    // Siapkan query dengan parameter untuk mencegah injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE iduser = ?");
    $stmt->bind_param("i", $iduser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Tampilkan form untuk mengupdate data dengan styling CSS
        echo '<form method="post" action="prosesuser.php" class="update-form">
              <label for="iduser">Iduser:</label>
              <input type="text" id="iduser" name="iduser" value="' . $row['iduser'] . '" readonly><br>
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" value="' . $row['username'] . '"><br>
              <label for="password">Password:</label>
              <input type="text" id="password" name="password" value="' . $row['password'] . '"><br>
              <label for="namauser">Nama User:</label>
              <input type="text" id="namauser" name="namauser" value="' . $row['namauser'] . '"><br>
              <label for="emailuser">Email User:</label>
              <input type="text" id="emailuser" name="emailuser" value="' . $row['emailuser'] . '"><br>
              
              <label for="level">Level:</label>
              <select id="level" name="level">
                  <option value="siswa"' . ($row['level'] == 'siswa' ? ' selected' : '') . '>siswa</option>
                  <option value="guru"' . ($row['level'] == 'guru' ? ' selected' : '') . '>guru</option>
              </select><br>
              
              <input type="submit" value="Update">
        </form>';
    } else {
        echo "Data tidak ditemukan!";
    }

    $stmt->close();
    $conn->close();
}
?>