const sunIcon = document.querySelector("#sun");
const moonIcon = document.querySelector("#moon");
	  
const userTheme = localStorage.getItem("theme");
const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

const iconToggle = () => {
    moonIcon.classList.toggle("hidden");
    sunIcon.classList.toggle("hidden");
}; 

const themeCheck = () => {
    if(userTheme === "dark" || (!userTheme && systemTheme)){
	document.documentElement.classList.add("dark");
	moonIcon.classList.add("hidden");
	return;
    }
    sunIcon.classList.add("hidden");
};

const themeSwitch = () => {
    if(document.documentElement.classList.contains("dark")){
	document.documentElement.classList.remove("dark");
	localStorage.setItem("theme", "light");
	iconToggle();
	return;
    } 
    document.documentElement.classList.add("dark");
    localStorage.setItem("theme", "dark");
    iconToggle();
};

sunIcon.addEventListener("click", () => {
    themeSwitch();
});

moonIcon.addEventListener("click", () => {
    themeSwitch();
})

themeCheck();

const closeModal = document.querySelectorAll("#close")[0];
const openModal = document.querySelectorAll("#modalOpen")[0];
const modalContent = document.querySelectorAll("#modal-content")[0];
const modalContainer = document.querySelectorAll("#modal-container")[0];

openModal.addEventListener("click", function(e){
	e.preventDefault();
	modalContainer.style.opacity = "1";
	modalContainer.style.visibility = "visible";
	modalContent.classList.toggle("translate-y-[-200%]")
})

closeModal.addEventListener("click", function(){
	modalContent.classList.toggle("translate-y-[-200%]");
	modalContainer.style.opacity = "0";
	modalContainer.style.visibility = "hidden";
})

function hideSigns(){
    document.getElementbyId("#signsErrorSucces").style.display = "none";
}


