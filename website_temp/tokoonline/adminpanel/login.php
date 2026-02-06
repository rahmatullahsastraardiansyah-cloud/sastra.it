<?php
    session_start();
    require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0d0d0d;
            color: #f1f1f1;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Poppins", sans-serif;
            margin: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            background-color: #2c2a2aff;
            padding: 50px 50px; /* ✅ padding kanan kiri ditambah agar kolom tidak nempel */
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(255, 255, 255, 1);
            text-align: center;
        }

        .login-box h3 {
            color: #00ff88;
            margin-bottom: 5px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .version {
            color: #f8f8f8ff;
            font-size: 12px;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #ffffffff;
            padding-left: 4px;
        }

        input.form-control {
            background-color: #ffffffff;
            border: 1px solid #ffffffff;
            color: #fff;
            padding: 10px 12px;
            border-radius: 8px;
            transition: 0.3s;
            width: 100%;
            font-size: 14px;
        }

        input.form-control:focus {
            background-color: #393d3aff;
            border-color: #00ff88;
            box-shadow: 0 0 10px #00ff88;
            color: #fff;
        }

        .btn-login {
            margin-top: 25px;
            background: linear-gradient(90deg, #d2d2d2ff, #f2f2f2ff);
            border: none;
            color: #000000ff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 15px;
            width: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #5db966ff, #5db966ff);
            transform: scale(1.03);
            box-shadow: 0 0 15px #00ff88;
        }

        .alert {
            margin-top: 20px;
            font-size: 14px;
        }
h3 {
  font-size: 32px;
  font-weight: bold;
  color: #fff;
  text-shadow: 
    0 0 10px #607272ff,
    0 0 10px #393d3aff,
    0 0 10px #000000ff;
}
</style>
</head>
<body>

    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box ">
            <h3 style="font-size: 32px; font-weight: bold; color: #ffffffff;">Login</h3>

            <p class="version">V1.1</p>

            <form action="" method="post">
                <div class="form-group">
                    <label for="username"> Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
                </div>

                <div class="form-group">
                    <label for="password"> Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                </div>

                <button class="btn btn-login" type="submit" name="loginbtn"> Login</button>
                <a href="../../../project_pkl/bulan2/dashboard.html">Kembali</a>

            </form>

            <?php
                if(isset($_POST["loginbtn"])){
                    $username = htmlspecialchars($_POST["username"]);
                    $password = htmlspecialchars($_POST["password"]);

                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);

                    if($countdata > 0){
                        if (password_verify($password, $data['password'])) {
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('Location: index.php');
                            exit;
                        } else {
                            echo '<div class="alert alert-danger text-center mt-3">❌ Password salah!</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning text-center mt-3">⚠️ Akun tidak ditemukan!</div>';
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>