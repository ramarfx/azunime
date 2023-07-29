<?php 
session_start();
if (!isset($_SESSION['login'])) {
   header("location:login.php");
   exit;
}
//menyambungkan ke database
require 'function.php';

//pagination
// KONFIGURASI
$jumlahDataPerhalaman = 18;
$jumlahData = count(query("SELECT * FROM anime"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = ( isset($_GET['halaman']) ) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$animeList = query("SELECT * FROM anime LIMIT $awalData, $jumlahDataPerhalaman");
$genreList = query("SELECT * FROM genre");


//cari data anime
if(isset($_POST["cari"])){
   $cari = $_POST["cari"];
   $animeList = query("SELECT * FROM anime WHERE judul LIKE '%$cari%' OR genre LIKE '%$cari%'");
}

//sortir dulu gak sih
if (isset($_GET['genre'])) {
   $genre = $_GET['genre'];
   $animeList = query("SELECT * FROM anime WHERE genre = '$genre'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Homepage</title>
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
                     <li><a href="maintenance.php">About</a></li>
                     <li class="dropdown">
                        <button id="dropdownBtn">Genre list &nbsp; <span><i class="fa-solid fa-caret-down" id="dropdownIcon"></i></span></button>

                        <div class="dropdown-item" id="dropdown">
                           <?php foreach ($genreList as $genre):?>
                              <a href="?genre=<?= $genre['genre'] ?>"><?= $genre['genre'] ?></a>
                           <?php endforeach;?>
                        </div>
                     </li>
                     <li><a href="maintenance.php">Contact Us</a></li>
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

   <!-- section jumbotron start -->
   <section id="jumbotron">
      <div class="overlay"></div>
   </section>
   <!-- section jumbotron end -->

   <!-- main content start -->
   <section id="main">
      <div class="flex">
         <div class="profile">
            <div class="profile-picture">
               <img src="./src/img/Nakano.Azusa.full.3139693.jpg" alt="">
            </div>
            <!-- <a href="" class="profile-edit"><i class="fa-solid fa-pen-to-square"></i></a> -->
            <div class="profile-txt profile-name">
               <h3><?= $_SESSION['username'] ?></h3>
            </div>
            <div class="profile-txt profile-status">
               <p><?= status($_SESSION['username']) ?></p>
            </div>
            <div class="profile-txt profile-login">
               <p>Bergabung pada 12.juni.2023</p>
            </div>
            <div class="profile-txt profile-tambah">
               <a href="tambah.php">
                  <span><i class="fa-solid fa-plus"></i></span>
                  tambah anime
               </a>
               <a href="logout.php" class="logout">
                  <span><i class="fa-solid fa-right-from-bracket"></i></span>log out
               </a>
            </div>
         </div>

         <div class="anime-list">
            <div class="genre-list">
               <ul>
                  <li><a href="index.php">All</a></li>
                  <?php foreach ($genreList as $genre):?>
                     <?php 
                     if (isset($_GET['genre'])) {
                         $warna = ( $genre['genre'] == $_GET['genre']) ? 'white' : '#8C8C8C';
                     } 
                     ?>
                     <li><a href="?genre=<?= $genre['genre'] ?>" style="color: <?= $warna ?>;"><?= $genre['genre'] ?></a></li>
                  <?php endforeach;?>
               </ul>
            </div>

            <div class="anime">
               <?php $i = 1?>
               <?php foreach ($animeList as $anime):?>
               <div class="anime-inner">
                  <img src="./src/img/poster/<?= $anime['gambar'] ?>" alt="" loading="lazy">
                  <a href="ubah.php?id=<?= $anime['id'] ?>" class="profile-edit"><i class="fa-solid fa-pen-to-square"></i></a>
                  <div class="overlay">
                     <div class="episode"><?= $anime['episode'] ?> episode</div>
                     <div class="judul"><?= $anime['judul'] ?></div>
                     <div class="genre"><?= $anime['genre'] ?></div>
                     <a href="" class="play"><i class="fa-solid fa-play"></i>&ensp;play</a>
                  </div>
               </div>
               <?php $i++?>
               <?php endforeach;?>
            </div>

            <!-- navigasi pagnation -->
            <div class="pagination">
            <?php
            $halamanTampil = 4; // Jumlah tautan halaman yang ditampilkan (termasuk halaman saat ini)
            $setengahHalamanTampil = floor($halamanTampil / 2); // Bagian setengah dari jumlah tautan yang ditampilkan
            $halamanAwal = max(1, $halamanAktif - $setengahHalamanTampil);
            $halamanAkhir = min($halamanAwal + $halamanTampil - 1, $jumlahHalaman);

            if ($halamanAkhir - $halamanAwal + 1 < $halamanTampil) {
               $halamanAwal = max(1, $halamanAkhir - $halamanTampil + 1);
            }
            ?>

            <!-- HTML untuk menampilkan tombol "Previous" -->
            <?php if ($halamanAktif > 1): ?>
               <a href="?halaman=<?= $halamanAktif - 1 ?>"><i class="fa-solid fa-caret-left"></i></a>
            <?php else: ?>
               <a href="?halaman=<?= $halamanAktif - 1 ?>"><i class="fa-solid fa-caret-left" style="opacity: 0;"></i></a>
            <?php endif; ?>

            <!-- HTML untuk menampilkan tautan halaman -->
            <?php if ($halamanAwal > 1): ?>
               <a href="?halaman=1">1</a>
            <?php endif; ?>

            <?php for ($i = $halamanAwal; $i <= $halamanAkhir; $i++): ?>
               <?php if ($i == $halamanAktif): ?>
                  <a href="?halaman=<?= $i ?>" style="color:white;"><?= $i ?></a>
               <?php else: ?>
                  <a href="?halaman=<?= $i ?>"><?= $i ?></a>
               <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAkhir < $jumlahHalaman): ?>
               <?php if ($halamanAkhir < $jumlahHalaman - 1): ?>
                  <span>...</span>
               <?php endif; ?>
               <a href="?halaman=<?= $jumlahHalaman ?>"><?= $jumlahHalaman ?></a>
            <?php endif; ?>

            <!-- HTML untuk menampilkan tombol "Next" -->
            <?php if ($halamanAktif != $jumlahHalaman): ?>
               <a href="?halaman=<?= $halamanAktif + 1 ?>"><i class="fa-solid fa-caret-right"></i></a>
            <?php else: ?>
               <a href="?halaman=<?= $halamanAktif + 1 ?>"><i class="fa-solid fa-caret-right" style="opacity: 0;"></i></a>
            <?php endif; ?>               
            </div>
         </div>
      </div>
   </section>
   <!-- main content end -->

   <!-- footer start-->
   <section id="footer">
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
   <script src="./src/js/grid.js"></script>
</body>
</html>