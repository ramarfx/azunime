<?php 
session_start();
include 'function.php';
$genreList = query("SELECT * FROM genre");

if (isset($_POST['submit'])) {
   tambah($_POST);
   
   //tampilkan pesan data berhasil ditambahkan
   echo "<script>
   alert('data berhasi di tambahkan');
   document.location.href = 'index.php';
   </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tambah judul anime</title>
   <script src="https://kit.fontawesome.com/2c2ad9e412.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="src/css/main.css">
   <link rel="stylesheet" href="./node_modules/cropperjs/dist/cropper.css">
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
                              <a href="index.php?genre=<?= $genre['genre'] ?>"><?= $genre['genre'] ?></a>
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
   <section id="tambah">
      <a href="index.php" class="kembali"><i class="fa-solid fa-angle-left"></i></a>
      <h2>tambahkan anime</h2>
      <form class="flex" action="" method="post" enctype="multipart/form-data">
         <div class="image" id="imageContainer">
               <input type="file" id="fileInput" name="gambar" onchange="showSelectedFile()" accept="image/*">
            <div class="tambah-file">
               <i class="fa-solid fa-plus"></i>
               <p class="teks">maximum 3mb</p>
            </div>
         </div>
         <div class="deskripsi">
            <input type="text" name="judul" id="judul" placeholder="Judul anime" required autocomplete="off">
            <input type="number" name="episode" id="episode" placeholder="total episode" required autocomplete="off">
            <!-- <input type="text" name="genre" id="genre" placeholder="genre" required> -->
            <div class="select">
               <select name="genre" id="genre" required>
                  <option value="" disabled selected>Genre</option>
                  <option value="Action">Action</option>
                  <option value="Romance">Romance</option>
                  <option value="Music">Music</option>
                  <option value="Sci-FI">Sci-Fi</option>
                  <option value="Slice of life">Slice of life</option>
                  <option value="Comedy">Comedy</option>
                  <option value="Advanture">Advanture</option>
               </select>
            </div>
            <p>(note: gambar harus memilki rasio 2:3 soalnya dah nyerah pake cropper.js :V)</p>
            <button type="submit" name="submit">Konfirmasi</button>
            <button type="reset" name="hapus">reset</button>
         </div>
      </form>
   </section>
   <!-- main content end -->

   <script src="./node_modules/cropperjs/dist/cropper.js"></script>
   <script src="./src/js/script.js"></script>
</body>
</html>