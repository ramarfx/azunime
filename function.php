<?php 
   $conn = mysqli_connect('localhost', 'root', '', 'azunime');
function query($query){
   global $conn;

   $result = mysqli_query($conn, $query);
   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }
   return $rows;
}

function tambah($data) {
   global $conn;

   $judul = $data['judul'];
   $episode = $data['episode'];
   $genre = $data['genre'];

   //upload gambar
   $gambar = upload();
   if (!$gambar) {
       return false;
   }

   // Persiapkan pernyataan menggunakan Prepared Statements
   $stmt = $conn->prepare("INSERT INTO anime (judul, episode, genre, gambar) VALUES (?, ?, ?, ?)");
   if (!$stmt) {
       die("Pengaturan Prepared Statement gagal: " . $conn->error);
   }

   // Ikat nilai-parameter
   $stmt->bind_param("siss", $judul, $episode, $genre, $gambar);

   // Eksekusi pernyataan
   $stmt->execute();

   // Tutup pernyataan
   $stmt->close();
}

function ubah($data){
   global $conn;
   $id = $data['id'];
   $judul = $data['judul'];
   $episode = $data['episode'];
   $genre = $data['genre'];
   $gambarLama = $data['gambarOld'];

   //cek apakah user pilih gambar baru atau tidak
   if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
   }else {
      $gambar = upload();
   }

   $result = "UPDATE anime SET 
                  judul = '$judul',
                  episode = '$episode',
                  genre = '$genre',
                  gambar = '$gambar'
                  WHERE id = $id";

   mysqli_query($conn, $result);

   return mysqli_affected_rows($conn);
}


function upload(){
   $namaFile = $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['tmp_name'];

   //cek apakah tidak ada gambar yang di upload
   if ($error === 4) {
      echo "<script>
               alert('pilih gambar terlebih dahulu')
            </script>";
      return false;
   }

   //cek apakah gambar valid
   $ekstensiGambarValid = ['jpg', 'jpeg','png'];
   $ekstensiGambar = explode('.',$namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar));

   if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo "<script>
               alert('yang anda pilih bukan gambar')
            </script>";
      return false;
   }

   //cek jika ukurannya terlalu besar
   if ($ukuranFile > 24000000) {
      echo "<script>
               alert('ukuran gambar terlalu besar!')
            </script>";
      return false;
   }

   //generate nama gambar baru
   $namaFileBaru = uniqid();
   $namaFileBaru .= '.';
   $namaFileBaru .= $ekstensiGambar;

   //jika lolos pengecekan
   move_uploaded_file($tmpName, 'src/img/poster/'.$namaFileBaru);
   return $namaFileBaru;
}

function hapus($id){
   global $conn;
   $file = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM anime WHERE id='$id'"));
   unlink('src/img/poster/' . $file["gambar"]);
   mysqli_query($conn, "DELETE FROM anime WHERE id = '$id'");
}

function registrasi($data){
   global $conn;

   $username = strtolower(stripslashes($data['username']));
   $password = $data['password'];
   $password2 = $data['password2'];

   // cek apakah ada nickname yang sama atau tidak
   $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
   if (mysqli_num_rows($result) > 0) {
      echo "<script>
      alert('username sudah terdaftar!')
      </script>";

      return false;
   }

   //cek konfirmasi password
   if ($password != $password2) {
      echo "<script>
      alert('password tidak sama!')
      </script>";
      return false;
   }

   //insert kedalam database
   $query = "INSERT INTO users VALUES ('', '$username', '$password')";
   mysqli_query($conn, $query);
   return mysqli_affected_rows($conn);
   
}

function status($session){
   if ($session == 'admin'){
      return 'Administratior';
   }else{
      return 'member suki';
   }
}


// // Contoh penggunaan fungsi compressImage()
// $sourcePath = 'path/to/source/image.jpg'; // Ganti dengan path gambar sumber yang diunggah
// $targetPath = 'path/to/target/compressed_image.jpg'; // Ganti dengan path tujuan gambar yang telah dikompresi
// $compressionQuality = 0.7; // Kualitas kompresi (0-1), semakin kecil nilainya semakin tinggi kompresinya

// // Panggil fungsi compressImage() untuk mengompresi gambar
// compressImage($sourcePath, $targetPath, $compressionQuality);

// // Setelah gambar dikompresi, Anda dapat menyimpan path $targetPath ke dalam database.

?>