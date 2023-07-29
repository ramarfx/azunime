<?php
if (isset($_FILES['gambar']) && !empty($_FILES['gambar']['tmp_name'])) {
    // Proses upload gambar
    $uploadDir = 'uploads/'; // Folder tempat menyimpan gambar yang diupload
    $tempFile = $_FILES['gambar']['tmp_name'];
    $targetFile = $uploadDir . $_FILES['gambar']['name'];

    if (move_uploaded_file($tempFile, $targetFile)) {
        // Gambar berhasil diunggah
        $imagePath = $targetFile;
        
        // Lakukan proses crop pada gambar menggunakan library atau metode yang Anda pilih
        // Simpan gambar yang sudah dicrop sesuai dengan kebutuhan Anda
        // Contoh menggunakan GD Library untuk crop (pastikan GD Extension aktif pada server):
        // cropAndSaveImage($imagePath, $targetFile, $width, $height); 

        echo "Gambar berhasil diunggah dan di-crop.";
    } else {
        echo "Gagal mengunggah gambar.";
    }
} else {
    echo "Tidak ada gambar yang diunggah.";
}
?>
