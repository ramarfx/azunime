const navbar = document.querySelector('.navbar');
const navbarToggle = document.querySelector('.hamburger');

navbarToggle.addEventListener('click', ()=>{
   navbar.classList.toggle('active');
})

//navbar dropdown
const dropdown = document.getElementById('dropdown');
const dropdownBtn = document.getElementById('dropdownBtn');
const icon = document.getElementById('dropdownIcon');

dropdownBtn.addEventListener('mouseenter', ()=>{
  dropdown.style.display = 'flex';
  icon.classList.add('dropdown-active');
})
dropdown.addEventListener('mouseleave', ()=>{
  dropdown.style.display = 'none';
  icon.classList.remove('dropdown-active')
})

//upload file
const tambahFIle = document.querySelector('.image');
tambahFIle.addEventListener('click', ()=>{
   document.getElementById('fileInput').click();
})

function showSelectedFile() {
   const fileInput = document.getElementById("fileInput");
   const selectedFileDiv = document.getElementById("imageContainer");

   if (fileInput.files.length > 0) {
     const file = fileInput.files[0];
     
     // Membuat objek FileReader untuk membaca isi berkas
     const reader = new FileReader();
     reader.onload = function(event) {
       selectedFileDiv.style.backgroundImage = "url(" + event.target.result + ")";
       selectedFileDiv.querySelector("p").style.display = "none"; // Sembunyikan teks "Pilih berkas"
       selectedFileDiv.querySelector("i").style.display = "none"; // Sembunyikan teks "Pilih berkas"
     };
     reader.readAsDataURL(file); // Membaca berkas sebagai data URL (base64)
   }
 }
/*
-
-
-
-
-
*/
// SUBMIT TOMBOL SEARCH
const form = document.querySelector('.nav-user');
const btn = document.getElementById('hiddenSubmitButton');

form.addEventListener('keyup', (event)=>{
  if (event.key === 'Enter') {
    btn.click();
  };
});


