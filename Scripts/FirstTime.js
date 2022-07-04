class Subject {
  constructor(subject, index) {
    console.log("Success");

    this.subject = subject;
    this.index = index;
  }

  create() {
    //Creating a parent div
    const parentDiv = document.createElement("div");
    parentDiv.classList.add("random");
    parentDiv.setAttribute("id", "div-styling" + this.index);

    //Creating a div for both the label and the text to style and also fix a bug
    const elementDiv = document.createElement("div");
    elementDiv.setAttribute('id', 'element-div-styling')

    //Creating the form
    const finalParent = document.querySelector("form");

    //creating the label for each of the subjects
    const newLabel = document.createElement("label");
    newLabel.setAttribute("for", "checkbox");
    newLabel.innerHTML = this.subject;

    //creating the inputs for the different subjects
    const element = document.createElement("input");
    element.setAttribute("type", "checkbox");
    element.setAttribute("id", "checkbox");

    //To make every single one unique the use of the index is needed
    element.classList.add("subject" + this.index);
    //adds a name to the element to allow for php to work with it
    element.setAttribute("name", "subjects[]");

    elementDiv.appendChild(newLabel);
    elementDiv.appendChild(element);

    parentDiv.appendChild(elementDiv); 

    finalParent.appendChild(parentDiv);
    document.body.appendChild(finalParent);
  }

  place() {
    //ensure that no two elements are being styled at the same time as this will break the site
    const element = document.getElementById("element-div-styling");

    //initating two random numbers for the width and height of the element to be placed

    var top = Math.random() * 500;
    var left = Math.random() * 50;

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
    element.style.marginTop = top + "px";
    element.style.marginLeft = left + "px";
  }
}

let subject = [
  "Maths",
  "Computer Science",
  "Further Maths",
  "History",
  "Geography",
  "Pscycology"]


for (var i = 0; i < subject.length; i++) {
  //passes through the subject name as well as an index
  let sub = new Subject(subject[i], i);
  sub.create();
  sub.place();
}
