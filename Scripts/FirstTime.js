class Subject {
  constructor(subject, index) {
    console.log("Success");

    this.subject = subject;
    this.index = index;
  }

  create() {
    //loading the form
    const form = document.getElementById("form");

    //creating a parent div to style appropriately
    const parentDiv = document.createElement("div");
    parentDiv.setAttribute("class", "form-element-style");

    //Creating a div for both the label and the text to style and also fix a bug
    const elementDiv = document.createElement("div");
    elementDiv.setAttribute("id", "element-div-styling");

    //creating the label for each of the subjects
    const newLabel = document.createElement("label");
    newLabel.setAttribute("for", "checkbox");
    newLabel.setAttribute("id", "subject-text");
    newLabel.innerHTML = this.subject;

    //creating the inputs for the different subjects
    const element = document.createElement("input");
    element.setAttribute("type", "checkbox");
    element.setAttribute("id", "checkbox");

    //To make every single one unique the use of the index is needed
    element.setAttribute("class", this.subject);
    //adds a name to the element to allow for php to work with it
    element.setAttribute("name", "subjects[]");

    //Placing all attributes sequentially
    elementDiv.appendChild(element);
    elementDiv.appendChild(newLabel);
    parentDiv.appendChild(elementDiv);
    form.appendChild(parentDiv);
  }

  layer() {
    //this is used to layer the form correctly removing the 'Maths bug'
    const target = document.getElementById("element-div-styling");
    target.style.zIndex = this.index;
  }

  logVal() {
    //this is for debugging
    console.log(this.subject);
    console.log(this.index);
  }
}

let subject = [
  "Maths",
  "Computer Science",
  "Further Maths",
  "History",
  "Geography",
  "Pscycology",
];

for (var i = 0; i < subject.length; i++) {
  //passes through the subject name as well as an index
  let sub = new Subject(subject[i], i);
  sub.create();
  sub.logVal();
}
