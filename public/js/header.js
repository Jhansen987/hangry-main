function responsiveNav(){
	let x = document.getElementById('mobile-nav-menu');
	let y = document.getElementById('black-screen');
	x.classList.toggle('slide-to-right'), y.classList.toggle('fade-in');
}

function responsiveSubDropdown1(){
	let x = document.getElementById('mobile-subdropdown-btn-1');
	let y = document.getElementById('nav-arrow-1');
	let z = document.getElementById('mobile-subdropdown-1');
	if(z.style.display === 'block'){x.style.backgroundColor = "#fff"; y.src='icons/down-arrow-icon-gray.svg';z.style.display = 'none';} 
	else{x.style.backgroundColor = "#eeeeee"; y.src='icons/up-arrow-icon-gray.svg'; z.style.display = 'block';}
}

function searchbarPopup(){
	let x = document.getElementById('black-screen-2');
	if(x.style.display === 'block'){x.style.display = 'none';} 
	else{x.style.display = 'block';}
	console.log("It was clicked!");
}

// FOR ADMIN SIDE....
function adminResponsiveSubDropdown1(){
	let x = document.getElementById('mobile-subdropdown-btn-1');
	let y = document.getElementById('nav-arrow-1');
	let z = document.getElementById('mobile-subdropdown-1');
	if(z.style.display === 'block'){x.style.backgroundColor = "#fff"; y.src='../icons/down-arrow-icon-gray.svg';z.style.display = 'none';} 
	else{x.style.backgroundColor = "#eeeeee"; y.src='../icons/up-arrow-icon-gray.svg'; z.style.display = 'block';}
}

function adminResponsiveSubDropdown2(){
	let x = document.getElementById('mobile-subdropdown-btn-2');
	let y = document.getElementById('nav-arrow-2');
	let z = document.getElementById('mobile-subdropdown-2');
	if(z.style.display === 'block'){x.style.backgroundColor = "#fff"; y.src='../icons/down-arrow-icon-gray.svg';z.style.display = 'none';} 
	else{x.style.backgroundColor = "#eeeeee"; y.src='../icons/up-arrow-icon-gray.svg'; z.style.display = 'block';}
}

document.getElementById('black-screen').addEventListener('click',responsiveNav);