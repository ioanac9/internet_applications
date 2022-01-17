function toggleToolbar(activeElement) {
  let loginForm = document.getElementById("login-form");
  let registerForm = document.getElementById("register-form");
  let loginButton = document.getElementById("login-toolbar")
  let registerButton = document.getElementById("register-toolbar")
  if (activeElement === 'login') {
    loginForm.classList.add('active')
    loginButton.classList.add('active-toolbar')
    registerButton.classList.remove('active-toolbar')
    registerForm.classList.remove('active')
  } else if (activeElement === 'register') {
    registerForm.classList.add('active')
    registerButton.classList.add('active-toolbar')
    loginButton.classList.remove('active-toolbar')
    loginForm.classList.remove('active')
  }
}
