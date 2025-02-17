<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $emailuser = $_POST['emailuser'];
    $namauser = $_POST['namauser'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Menyimpan data ke dalam database
    $stmt = $conn->prepare("INSERT INTO user (username, emailuser, namauser, password, level) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $emailuser, $namauser, $password, $level);

    if ($stmt->execute()) {
        $message = "Registrasi berhasil!";
        $message_type = "success"; // Jenis notifikasi sukses
    } else {
        $message = "Registrasi gagal. Silakan coba lagi.";
        $message_type = "error"; // Jenis notifikasi error
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="assets/img/rpl.png" rel="icon">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background:  rgb(0, 118, 136);
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            max-width: 400px;
            height: 650px;
            margin: 50px auto ;
            padding: 50px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 30px;
            font-weight: bold;
        }

        label {
            display: block;
            margin: 12px 0 6px;
            font-size: 16px;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 1px;
            margin-bottom: 10px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus {
            border-color:rgb(36, 166, 58);
            background-color: #fff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 1px;
            background-color:rgb(30, 126, 123);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color:rgb(49, 211, 187);
        }

        .message {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .message a {
            color: rgb(62, 150, 175);
            text-decoration: none;
            font-weight: bold;
        }

        .message a:hover {
            text-decoration: underline;
        }

        /* Notifikasi */
        .notification {
            width: 90%;
            max-width: 450px;
            margin: 10px auto;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }

        .notification.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .notification.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrasi Pengguna</h2>

        <!-- Menampilkan pesan notifikasi jika ada -->
        <?php if (isset($message)): ?>
            <div class="notification <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Email User:</label>
            <input type="email" name="emailuser" required>
            
            <label>Nama User:</label>
            <input type="text" name="namauser" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <label>Level:</label>
            <select name="level" required>
                <option value="siswa">Op Siswa</option>
                <option value="guru">Guru</option>
                <option value="produk">Produk</option>
            </select>
            
            <button type="submit">Register</button>
        </form>

        <div class="message">
            <p><span style="color:rgb(5, 18, 33);">Sudah memiliki akun?</span> <a href="login.php">Masuk di sini</a></p>
        </div>
    </div>
</body>
</html>