//GRID DAN FLEX SECARA DINAMIS
const animeList = document.querySelectorAll("#main .anime .anime-inner");
const animeContainer = document.querySelector('.anime');

if (animeList.length > 5) {
  animeContainer.style.display = 'grid';
}else{
  animeContainer.style.display = 'flex';
};