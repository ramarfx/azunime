<?php 
require 'function.php';

//insert data dari form ke database
if (isset($_POST['submit'])) {
   
   if (registrasi($_POST) > 0) {
      echo "<script>
      alert('registrasi berhasil');
      document.location.href='login.php';
      </script>";
   }
   else {
      echo mysqli_error($conn);
   }
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
   <section id="register">
      <div class="flex">
         <div class="left"></div>
         <div class="right">
            <a class="judul"><span>Azu</span>nime</a>
            <div class="login">
               <h2>Sign Up</h2>
               <form action="" method="post" class="login-form">
                  <input type="text" name="username" id="username" placeholder="username">
                  <input type="password" name="password" id="password" placeholder="password">
                  <input type="password" name="password2" id="password" placeholder="konfirmasi password">
                  <button type="submit" name="submit">Sign Up</button>
                  <a href="login.php" class="register">sudah memiliki akun? <span>login sekarang</span></a>
               </form>
            </div>
         </div>
      </div>
   </section>
</body>
</html>