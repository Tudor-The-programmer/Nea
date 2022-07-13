class Quiz {
  constructor(questions, answers, count) {
    this.questions = questions;
    this.answers = answers;
    this.count = count;
  }

  firstQuestion() {
    if (this.count == 1) {
      let div = document.getElementById("question");
      let display = document.createElement("p");

      display.setAttribute("id", this.questions[this.count]);

      let node = document.createTextNode(this.questions[this.count]);

      display.appendChild(node);
      div.appendChild(display);
      this.count += 1;
    } else {
      return;
    }
  }

  removeCurrentQuestion() {
    let element = document.getElementById(this.questions[this.count - 1]);
    element.remove();
  }

  handleClick() {
    let div = document.getElementById("question");
    let display = document.createElement("p");

    display.setAttribute("id", this.questions[this.count]);

    let node = document.createTextNode(this.questions[this.count]);

    this.removeCurrentQuestion(div, display);
    display.appendChild(node);
    div.appendChild(display);

    this.count += 1;
  }
}

let array = document.getElementById("invisible").innerHTML;

let questions = [];
let answers = [];

array = array.replaceAll("[", "");
array = array.replaceAll("]", "");

console.log(array);



for (let i = 1; i != array.length; i++) {
  if (i % 2 != 0) {
    questions.push(array[i - 1]);
  } else {
    answers.push(array[i - 1]);
  }
}

console.log(questions);

let quiz = new Quiz(questions, answers, 1);
quiz.firstQuestion();
