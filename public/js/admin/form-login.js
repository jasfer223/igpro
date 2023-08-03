const form = document.getElementById('form-login');
const email = document.getElementById('email');
const password = document.getElementById('password');

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces	
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();

	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
	} else {
		setErrorFor(email, '');
		if(passwordValue === '') {
		setErrorFor(password, 'Password cannot be blank');
		} else {
			setErrorFor(password, '');
			form.submit();
		}
	}
	if(passwordValue.length > 0){
		setErrorFor(password, '');
	}
	if(passwordValue === '') {
		setErrorFor(password, 'Password cannot be blank');
	} else {
		if(emailValue === '') {
			setErrorFor(email, 'Email cannot be blank');
		} else if (!isEmail(emailValue)) {
			setErrorFor(email, 'Not a valid email');
		} else {
			setErrorFor(email, '');
			if(passwordValue === '') {
			setErrorFor(password, 'Password cannot be blank');
			} else {
				setErrorFor(password, '');
				form.submit();
			}
		}
	}
}

function setErrorFor(input, message) {
	const formGroup = input.parentElement;
	const small = formGroup.querySelector('span');
	small.className = 'text-xs text-danger pl-3 error';
	small.innerText = message;
}	

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}