export class Quiz {
  constructor(questions, answers) {
    //Initiating the arrays as properties of the Quiz object
    this.questions = questions;
    this.answers = answers;
    this.currentIndex = 1;
    this.score = 0;
    this.arrayLength = this.questions.length;

    //Elements that will be used in the quiz and altered by the Quiz object
    this.question = document.getElementById("question");
    this.answer = document.getElementById("answer");
    this.showAnswerButton = document.getElementById("show-answer-button");
    this.good = document.getElementById("good");
    this.bad = document.getElementById("bad");
    this.okay = document.getElementById("okay");

    //Event listeners for the buttons that will be used in the quiz
    this.showAnswerButton.addEventListener("click", (event) => {
      this.showAnswer();
    });

    this.good.addEventListener("click", (event) => {
      this.goodClicked();
    });
    this.bad.addEventListener("click", (event) => {
      this.badClicked();
    });
    this.okay.addEventListener("click", (event) => {
      this.okayClicked();
    });
  }
  showQuestion() {
    this.question.innerHTML = this.questions[this.currentIndex];
  }
  showAnswer() {
    this.answer.innerHTML = this.answers[this.currentIndex];
    this.showAnswerButton.classList.add("true");
  }
  removeAnswer() {
    this.answer.innerHTML = "";
  }

  goodClicked() {
    //Quick check to see if the user has seen the question's answer
    if (this.showAnswerButton.classList.contains("true")) {
      //no need to go over question anymore so remove it
      this.answers.splice(this.currentIndex, 1);
      this.questions.splice(this.currentIndex, 1);

      //Removing the true flag from the showAnswerButton
      this.showAnswerButton.classList.remove("true");

      //Moves to the next question
      this.showQuestion();
      //Remove the next answer from the page
      this.removeAnswer();

      //Add to the score
      this.score += 2;

      console.log(this.score);
      console.log(this.questions);
      console.log(this.answers);
    } else {
      return;
    }
  }

  okayClicked() {
    //Quick check to see if the user has seen the question's answer
    if (this.showAnswerButton.classList.contains("true")) {
      //now there is a need to see the question again so add it back to the array
      //Generate a radom number between half of the array length and the length of the array
      let randomIndex = Math.floor(
        Math.random() * (this.arrayLength / 2) + this.arrayLength / 2
      );

      //Add the question and answer to the array
      console.log;

      consolthis.questions.pop(this.currentIndex, 1);
      this.answers.pop(this.currentIndex, 1);
      //Remove the true flag from the showAnswerButton
      this.showAnswerButton.classList.remove("true");
      //Moves to the next question
      this.showQuestion();
      //Remove the next answer from the page
      this.removeAnswer();
      //Add to the score
      this.score += 1;
    } else {
      return;
    }
  }
}
