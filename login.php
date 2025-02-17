<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data berdasarkan username
    $stmt = $conn->prepare("SELECT iduser, username, password, level FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $db_username, $stored_password, $role);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Cek password plaintext
        if ($password === $stored_password) {
            $_SESSION['iduser'] = $id;
            $_SESSION['username'] = $db_username;
            $_SESSION['level'] = $role;

            // Arahkan berdasarkan peran
            if ($role == "admin") {
                header("Location: dashboard-user.php");
            } elseif ($role == "siswa") {
                header("Location: dashboard-siswa-2.php");
            } elseif ($role == "guru") {
                header("Location: dashboard-guru-2.php");
            } elseif ($role == "produk") {
                header("Location: dashboard-produk-2.php");
            }
            elseif ($role == "user") {
                header("Location: dashboard-user-2.php");
            }
            exit;
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
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
    <link href="assets/img/logo-kapal.jpeg" rel="icon">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: rgb(0, 118, 136);
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            max-width: 450px;
            margin: 50px auto;
            padding: 40px;
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

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color:rgb(36, 166, 58);
            background-color: #fff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #f06595;
        }

        .message {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .message a {
            color:rgb(62, 150, 175);
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
        <h2>Login</h2>

        <!-- Pesan jika gagal login -->
        <?php if (isset($message)): ?>
            <div class="notification <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>

    </div>
</body>
</html>