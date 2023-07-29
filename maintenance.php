<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>404</title>
   <script src="https://kit.fontawesome.com/2c2ad9e412.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="./src/css/main.css">
</head>
<body>
   <!-- section header start-->
   <section id="navbar">
      <div class="container">
         <div class="flex">
            <a href="index.php" class="logo"><span>Azu</span>nime</a>

            <div class="hamburger">
               <i class="fa-solid fa-bars"></i>
            </div>
            <nav class="nav navbar">
               <div class="nav-menu">
                  <ul>
                     <li><a href="index.php">Home</a></li>
                     <li><a href="">About</a></li>
                     <li class="dropdown">
                        <button id="dropdownBtn">Genre list &nbsp; <span><i class="fa-solid fa-caret-down" id="dropdownIcon"></i></span></button>

                        <div class="dropdown-item" id="dropdown">
                           <?php foreach ($genreList as $genre):?>
                              <a href="?genre=<?= $genre['genre'] ?>"><?= $genre['genre'] ?></a>
                           <?php endforeach;?>
                        </div>
                     </li>
                     <li><a href="">Contact Us</a></li>
                  </ul>
               </div>
               <form action="" method="post" class="nav-user">
                  <input type="text" placeholder="Cari..." name="cari" id="inputCari">
                  <button type="submit" id="hiddenSubmitButton" style="display: none;">cari</button>
                  <div class="icon">
                     <i class="fa-solid fa-user"></i>
                     <p class="username"><?= $_SESSION['username'] ?></p>
                  </div>
               </form>
            </nav>
         </div>

      </div>
   </section>
   <!-- section header end-->

   <!-- main content start -->
   <section id="maintenance">
      <div class="left">
         <h1 class="title">404</h1>
         <p>malas membuat halaman ini🧢</p>
         <a href="index.php">kembali</a>
      </div>
      <div class="right">
         <img src="./src/img/maintenance.png" alt="">
      </div>
   </section>
   <!-- main content end -->

   <!-- footer start-->
   <section id="footer" style="margin-top: 0;">
      <p>2023 &nbsp;-&nbsp; Ramarfx</p>
      <div class="sosmed">
         <a href="https://discordapp.com/users/755793484392300624"><i class="fa-brands fa-discord"></i></a>
         <a href="https://github.com/ramarfx"><i class="fa-brands fa-github"></i></a>
         <a href="https://www.instagram.com/ramtxh/"><i class="fa-brands fa-instagram"></i></a>
         <a href="https://youtu.be/dQw4w9WgXcQ"><i class="fa-solid fa-envelope"></i></a>
      </div>
      <div class="right">
         <a href="https://ramarfx.github.io/portfolio/">Portfolio</a>
         <p>AzunyanRight</p>
      </div>
   </section>
   <!-- footer end-->

   <script src="./src/js/script.js"></script>
</body>
</html>