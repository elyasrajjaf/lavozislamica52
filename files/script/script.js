// Header Script 

const menu = document.querySelector(".menu");
const lien = document.querySelectorAll(".lien");
const hamburger= document.querySelector(".hamburger");
const fermerMenu= document.querySelector(".fermermenu");
const iconMenu = document.querySelector(".iconmenu");

function toggleMenu() {
  if (menu.classList.contains("ouvrirmenu")) {
    menu.classList.remove("ouvrirmenu");
    fermerMenu.style.display = "none";
    iconMenu.style.display = "block";
  } else {
    menu.classList.add("ouvrirmenu");
    fermerMenu.style.display = "block";
    iconMenu.style.display = "none";
  }
}

hamburger.addEventListener("click", toggleMenu);
