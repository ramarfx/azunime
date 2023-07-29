<?php 
session_start();
require 'function.php';

//cek dulu cookie nya
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])){
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   //ambil username berdasarkan id
   $result = mysqli_query($conn, "SELECT username FROM users WHERE id = '$id'");

   $row = mysqli_fetch_assoc($result);

   //cek cookie dan username
   if ($key === hash('sha256', $row['username'])) {
      $_SESSION['login'] = true;
   }
}

if (isset($_SESSION['login'])) {
   header("location: index.php");
   exit;
}

if (isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

   //cek username
   if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      var_dump($row);
      if ($password == $row['password']) {
         //set session
         $_SESSION['login'] = true;
         $_SESSION['username'] = $_POST['username'];


         //cek remember me
         if (isset($_POST['rememberMe'])) {
            //buat cookie
            setcookie('id', $row['id'], time() + 600);
            setcookie('key', hash('sha256', $row['username']), time() + 600);
         }

         header('location: index.php');
         exit;
      }
   }

   $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Log In</title>
   <script src="https://kit.fontawesome.com/2c2ad9e412.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="./src/css/main.css">
</head>
<body>
   <section id="login">
      <div class="flex">
         <div class="left"></div>
         <div class="right">
            <a class="judul"><span>Azu</span>nime</a>
            <div class="login">
               <h2>Login</h2>
               <form action="" method="post" class="login-form">
                  <input type="text" name="username" id="username" placeholder="username">
                  <input type="password" name="password" id="password" placeholder="password">

                  <?php if(isset($error)):?>
                     <p class="error">Email atau password salah</p>
                  <?php endif;?>

                  <div class="remember">
                     <input type="checkbox" name="rememberMe" id="rememberMe">
                     <span class="checkmark"></span>
                     <label for="rememberMe">Remember me</label>
                  </div>
                  <button type="submit" name="login">Log In</button>
                  <a href="register.php" class="register">tidak memiliki akun? <span>registrasi sekarang</span></a>
               </form>
            </div>
         </div>
      </div>
   </section>
</body>
</html>