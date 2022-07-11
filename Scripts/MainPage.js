function toggleActive(id) {
  /*this is a work around to get the id of the current active tab
    it has to be done as the getting the element by class name doesnt 
    allow for stylings to be made
*/
  let currentId = document.querySelector(".active").id;
  let buttonActive = document.getElementById(currentId);
  let button = document.getElementById(id);

  let nextPanel = id + "2";
  let currentPanel = currentId + "2";

  let buttonActivePanel = document.getElementById(currentPanel);
  let buttonPanel = document.getElementById(nextPanel);

  button.classList.toggle("active");
  buttonActive.classList.toggle("active");

  buttonActivePanel.classList.toggle("invisible");
  buttonPanel.classList.toggle("invisible");
}

