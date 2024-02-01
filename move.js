const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const signInLink=document.getElementById('next');
const signUpLink=document.getElementById('prev');
signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

signInLink.addEventListener('click', () => {
	document.getElementById('sign-in-container').style.display = "none";
	document.getElementById('sign-up-container').style.display = "block";
});
signUpLink.addEventListener('click', () => {
	document.getElementById('sign-in-container').style.display = "block";
	document.getElementById('sign-up-container').style.display = "none";
});


