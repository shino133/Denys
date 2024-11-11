const passwordInput = document.getElementById("pass");
const registerButton = document.getElementById("regst");
//only for password
const toggleButton = document.getElementById("togglePassword");
const kindOfPassword = document.getElementById("kindOfPassword");
const fnameInput = document.getElementById("fname");
const lnameInput = document.getElementById("lname");
passwordInput.addEventListener("input", () => {
  //empty password field
  if (passwordInput.value === "") {
    passwordInput.classList.remove("valid-password", "invalid-password");
    registerButton.disabled = true;
    registerButton.style.cursor = "not-allowed"; //change cursor to not-allowed
    toggleButton.hidden = true;
    kindOfPassword.hidden = true;
  } else {
    //non-empty password field
    const passwordPattern =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; //means a-z, A-Z, 0-9, @$!%*?& and min 8 characters
    if (passwordPattern.test(passwordInput.value)) {
      //check if password is valid
      passwordInput.classList.remove("invalid-password");
      passwordInput.classList.add("valid-password");
      registerButton.disabled = false;
      registerButton.style.cursor = "pointer"; //enable register button
      toggleButton.hidden = false; //hide password toggle button
      kindOfPassword.hidden = false;
    } else {
      //invalid password
      passwordInput.classList.remove("valid-password");
      passwordInput.classList.add("invalid-password");
      registerButton.disabled = true; //disable register button
      registerButton.style.cursor = "not-allowed"; //change cursor to not-allowed
      toggleButton.hidden = false;
      kindOfPassword.hidden = false;
    }
  }
});
//toggle password visibility

toggleButton.addEventListener("click", (e) => {
  e.preventDefault();
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);
  toggleButton.textContent = type === "password" ? "Show" : "Hide";
});
