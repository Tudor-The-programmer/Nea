class Subject {
  constructor(subject, index) {
    console.log("Success");

    this.subject = subject;
    this.index = index;
  }

  create() {
    //create the subject div
    const element = document.createElement("button");
    //The subject name must be read
    const content = document.createTextNode(this.subject);
    //this is to place the created div inside of a predone dive
    const parent = document.querySelector(".space");

    //To make every single one unique the use of the index is needed
    element.classList.add("subject" + this.index);
    //This is to style all of them at once
    element.classList.add("random");
    //adds a name to the element to allow for php to work with it
    element.setAttribute('name','subjects[]')

    //adds the subject name into the div to be diplayed
    element.appendChild(content);
    //The whole div element with the legible text is put into the space array
    parent.appendChild(element);
  }

  place() {
    //ensure that no two elements are being styled at the same time as this will break the site
    const element = document.querySelector(".subject" + this.index);

    //initating two random numbers for the width and height of the element to be placed

    var top = Math.random() * 80;
    var left = Math.random() * 200;

    //Quick check to ensure the buttons don't overlap the title
    while ((top > 40 && top < 65) || top > 96 || top < 5) {
      top = Math.random() * 100;
    }

    top = Math.floor(top);
    left = Math.floor(left);

    //debugging purposes
    console.log(top);
    console.log(left);

    //styles the element accoding to the values given
    element.style.top = top + "%";
    element.style.left = left + "%";
  }
}

//Easily add more subjects in
let listOfSubject = [
  "Maths",
  "Physics",
  "Biology",
  "Chemisty",
  "Computer science",
  "History",
  "Geography",
  "English",
];

//Create the new divs for all of the subjects
for (var i = 0; i < listOfSubject.length; i++) {
  //passes through the subject name as well as an index
  let sub = new Subject(listOfSubject[i], i);
  sub.create();
  sub.place();
}

//Applies an onclick function to all of the subjects in the array
for (var i = 0; i < listOfSubject; i++) {
  button = document.getElementsByClassName("subject" + i);
}

//Nice animation for user
const subtext = document.querySelector(".subtext");
const subbutton = document.querySelector(".submit-button");


const checkScroll = function () {
  const x = window.scrollX;
  //as soon as the user starts scrolling the subtext is gone
  if (x == 0) {
    subtext.remove();
    subbutton.className = "submit-button show";

  } else {
    subtext.className = "subtext";
  }
};

const scrollContainer = document.querySelector(".space");
scrollContainer.addEventListener("wheel", (evt) => {
  evt.preventDefault();
  scrollContainer.scrollLeft += evt.deltaY;
});

document.querySelectorAll(".random").forEach((item) => {
  item.addEventListener("click", (event) => {
    item.classList.toggle('chosen');
  });
});

scrollContainer.addEventListener("scroll", checkScroll);

//Takes in the space which the subjects take up and allows the user to scroll with the mouse for better user experience

