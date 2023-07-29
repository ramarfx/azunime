<?php
session_start();
include 'function.php';

$id = $_GET['id'];

$anime = query("SELECT * FROM anime WHERE id = $id")[0];
$genreList = query("SELECT * FROM genre");

//jika tombol di submit
if (isset($_POST['submit'])){
   //cek data berhasil di tambahkan atau tidak
   if (ubah($_POST) > 0 ) {
      echo "<script>
               alert('data berhasil diubah');
               document.location.href = 'index.php'
            </script>";
   }else{
      echo "<script>
         alert('data gagal diubah');
         document.location.href = 'index.php'
      </script>";
   }
}
if (isset($_POST['hapus'])){
   hapus($id);
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>edit anime</title>
   <script src="https://kit.fontawesome.com/2c2ad9e412.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="src/css/main.css">
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
      <h2>edit anime</h2>
      <form class="flex" action="" method="post" enctype="multipart/form-data">
         <div class="image" id="imageContainer">
               <img src="./src/img/poster/<?= $anime['gambar'] ?>" alt="">
               <input type="file" id="fileInput" name="gambar" onchange="showSelectedFile()" accept="image/*">
            <div class="ubah-file">
               <i class="fa-solid fa-plus"></i>
               <!-- <p class="teks">tambahkan poster</p> -->
            </div>
         </div>
         <div class="deskripsi">
            <input type="hidden" name="id" value="<?= $anime['id'] ?>">
            <input type="hidden" name="gambarOld" value="<?= $anime['gambar'] ?>">
            <input type="text" name="judul" id="judul" placeholder="Judul anime" value="<?= $anime['judul'] ?>" required autocomplete="off">
            <input type="number" name="episode" id="episode" placeholder="total episode" value="<?= $anime['episode'] ?>" required autocomplete="off">
            <div class="select">
            <select name="genre" id="genre">
               <option value="" disabled selected>Genre</option>

               <?php foreach ($genreList as $genre): ?>
                  <?php $selected = ($anime['genre'] == $genre['genre']) ? 'selected' : ''; ?>
                  <option value="<?= $genre['genre'] ?>" <?= $selected ?>><?= $genre['genre'] ?></option>
               <?php endforeach; ?>
               
            </select>
            </div>
            <p>(note: gambar harus memilki rasio 2:3 soalnya dah nyerah pake cropper.js :V)</p>
            <button type="submit" name="submit">Konfirmasi</button>
            <button type="submit" name="hapus" onclick="return confirm('yakin dek?')">Hapus anime ini</button>
         </div>
      </form> 
   </section>
   <!-- main content end -->

   <script src="./node_modules/cropperjs/dist/cropper.js"></script>
   <script src="./src/js/script.js"></script>
</body>
</html>