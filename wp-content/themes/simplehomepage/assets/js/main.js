// v.2.0.0

// Access the theme_uri passed from PHP
// Access the theme URI from the localized object
var themeUri = themeData.themeUri + "/";

var conf = [];
conf["confWrapperNavWidth"] = 900;
conf["confMenuItemAverageWidth"] = 130;
//conf["confMenuItemAverageWidth"] = 79;
conf["confBg"] = "on";

// Navigation JS part v.2.3.2

if (conf === undefined){
var conf = [];
// wrapper size for navigation, number in px from your CSS
conf["confWrapperNavWidth"] = 900;
conf["confMenuItemAverageWidth"] = 120;
//conf["confMenuItemAverageWidth"] = 79;
}

// count links
//var countMenuItem = document.querySelectorAll('.countMenuItem');
if (document.getElementById("topNav") != null){
//var countMenuItem = document.querySelectorAll('.countMenuItem');
var countMenuItem = document.getElementById("topNav").querySelectorAll('a');
} else {
var countMenuItem = 2;
}
if (document.getElementsByTagName("nav")[0] != null){

var mNavItemsAverageWidth = conf["confMenuItemAverageWidth"];
// Average item width: 66px
//var mNavItemsCount = (countMenuItem.length / 2);
var mNavItemsCount = ((countMenuItem.length + 2) / 2);
// /2 - dublicate items (links)
var mNavWhenDropdownWidth = (mNavItemsAverageWidth * mNavItemsCount) / 2;
// /2 - for 2 rows links
// auto based on item
var cssMedia = `@media(width <= ${mNavWhenDropdownWidth}px)`;
var cssMedia2 = `@media(width > ${mNavWhenDropdownWidth}px)`;

// if nav (items) more width then wrapper (forece dropdown)
if ((mNavWhenDropdownWidth) >= conf["confWrapperNavWidth"]){
cssMedia = '@media(width >= 1px)';
// cancel
cssMedia2 = `@media(width <= 0px)`; 
}

// embed style
//document.getElementsByTagName("nav")[0].innerHTML += `
document.head.insertAdjacentHTML("beforeend", `

<style>
${cssMedia} {
.navMenu {
display: none;
}
.topNav .dropdownMenuButton { display: inline-block; }
}

/* when dynamic change*/
${cssMedia2} {
.dropdownMenu, .dropdownMenuCotent, .showDropdownMenu {
display: none !important;
}
}
</style>

`);

}

// button
var dropdownButton = document.getElementById("dropdownMenuButton");
var dropdownMenu = document.getElementById("dropdownMenu");
var topNav = document.getElementById("topNav");

//https://www.w3.org/WAI/ARIA/apg/patterns/menu-button/examples/menu-button-links/
if (topNav != undefined&&topNav.querySelectorAll("a")[0] != undefined){
var topNavAllLinks = topNav.querySelectorAll("a");
topNavAllLinks.forEach((item, index) => {
topNav.querySelectorAll("a")[index].tabIndex = 0;
});
}

function fuMDropdownButton(){
//https://stackoverflow.com/questions/64487640/javascript-show-hide-div-onclick
if (dropdownMenu.style.display === "block"){
dropdownMenu.style.display = "none";
if (dropdownButton != null){
dropdownButton.innerHTML = `☰ Menu`;
}
} else {
dropdownMenu.style.display = "block";
if (dropdownButton != null){
dropdownButton.innerHTML = `☶ Menu`;

//https://www.w3.org/WAI/ARIA/apg/patterns/menu-button/examples/menu-button-links/
if (dropdownMenu.querySelectorAll("a")[0] != undefined){
let dropdownMenuAllLinks = dropdownMenu.querySelectorAll("a");
dropdownMenuAllLinks.forEach((item, index) => {
if (index == 0){
dropdownMenu.querySelectorAll("a")[index].tabIndex = 0;
dropdownMenu.querySelectorAll("a")[index].focus();
} else {
dropdownMenu.querySelectorAll("a")[index].tabIndex = 0;
}
});
}

//https://developer.mozilla.org/en-US/docs/Web/API/Element/keydown_event
topNav.addEventListener("keydown", fuMDropdownButtonLogKey);
function fuMDropdownButtonLogKey(e) {
//console.log(`${e.code}`);
if (e.code == "Escape"){
dropdownMenu.style.display = "none";
if (dropdownButton != null){
dropdownButton.innerHTML = `☰ Menu`;
}
dropdownButton.tabIndex = 0;
dropdownButton.focus();
}

}

}

//https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/toggle
//dropdownMenu.classList.toggle("showDropdownMenu");
}
}

if (topNav != null){
// out area click
//https://stackoverflow.com/questions/36695438/detect-click-outside-div-using-javascript
window.addEventListener('click', function(e){
dropdownMenu = document.getElementById("dropdownMenu");
if (topNav.contains(e.target) == true){
// Clicked in box
} else {
dropdownMenu.style.display = "none";
//dropdownMenu.classList.remove("showDropdownMenu");
if (dropdownButton != null){
dropdownButton.innerHTML = `☰ Menu`;
}
}
});
}

function fuMDropdownButtonClose(){
dropdownMenu.style.display = "none";
//dropdownMenu.classList.remove("showDropdownMenu");
if (dropdownButton != null){
dropdownButton.innerHTML = `☰ Menu`;
dropdownButton.tabIndex = 0;
dropdownButton.focus();
}
}

// end Navigation JS part




// Random bg image CSS (background img with random position)

if (conf["confBg"] == "on"){

let mBg = fuMRandomItem("bg.svg circle.svg line-chaotic.svg deco-paper.svg wood.png grid.png flower.png flower-2.png");
let mRandBgPos = fuMRandom(0, 100);
let mRandBgPos2 = fuMRandom(0, 100);

document.head.insertAdjacentHTML("beforeend", `
<style>
/*.reduceLight { filter: brightness(100%); }*/
body{
background-image: url("${themeUri}assets/images/bg/${mBg}");
background-repeat: repeat;
background-position: ${mRandBgPos}% ${mRandBgPos2}%;
background-attachment: fixed;
}
}
</style>
`);
}

// Random bg image CSS



//https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random
function fuMRandom(min, max){
//return Math.round(Math.random() * (max - min) + min);
const minCeiled = Math.ceil(min);
const maxFloored = Math.floor(max);
return Math.floor(Math.random() * (maxFloored - minCeiled + 1) + minCeiled); // The maximum is inclusive and the minimum is inclusive
}

function fuMRandomItem(text) {
let randomItemsArrList = [];
let delimiter = ["|", ",", " ", "\r\n", "\r", "\n"];
let items = ""
delimiter.forEach((val) => {
text = String(text.replaceAll(val, "SYMBOLFORSPLIT"));
});

text = text.split("SYMBOLFORSPLIT");
let text2 = "";
text.forEach((val) => {
if (val.trim != ''&&val != undefined&&val != null){
randomItemsArrList.push(val);
}
});

return randomItemsArrList[fuMRandom(0, Number(randomItemsArrList.length - 1))];
}
//console.table(fuMRandomItem(",,,,1 2      ,,,"));




