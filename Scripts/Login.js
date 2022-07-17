function togglelogin() {
  let loginPopup = document.querySelector(".login-form");
  loginPopup.classList.toggle("active");
}

function toggleSignup() {
  let loginPopup = document.querySelector(".signup-form");
  loginPopup.classList.toggle("active");
}

function checkError() {
  console.log("checkError");
  let error = document.querySelectorAll(".error");
  return error;
}

let errors = checkError();

const elems = Array.from(errors);
elems.pop();
elems.map((node) => node.parentNode.removeChild(node));
