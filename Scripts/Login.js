//To open the Login form
function togglelogin() {
  let loginPopup = document.querySelector(".login-form");
  loginPopup.classList.toggle("active");
}

//To open the signup form
function toggleSignup() {
  let loginPopup = document.querySelector(".signup-form");
  loginPopup.classList.toggle("active");
}

//Each error will be searched for with a error id
function checkError() {
  console.log("checkError");
  let error = document.querySelectorAll(".error");
  return error;
}

//This will show all of the errors as an array
let errors = checkError();

//if there are multiple errors, then it will only show one of them, not multiple
const elems = Array.from(errors);
elems.pop();
elems.map((node) => node.parentNode.removeChild(node));
