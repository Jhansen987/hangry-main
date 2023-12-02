function responsiveNav(){
	let x = document.getElementById('responsive-nav-menu');
	let y = document.getElementById('black-screen');
	x.classList.toggle('slide-down');
	y.classList.toggle('fade-in');
}

document.getElementById('black-screen').addEventListener('click',responsiveNav);