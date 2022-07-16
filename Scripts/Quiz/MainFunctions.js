import { SpashPage } from "../Quiz/SpashPage.js";

//This class was built to make the quiz easier to use
//It also runs the quiz with one start method which is showQuestion()
export class Quiz {
  constructor(questions, answers) {
    //Initiating the arrays as properties of the Quiz object
    this.questions = questions;
    this.answers = answers;
    //Setting the current index to 1, as 0 is the headers for the csv file
    this.currentIndex = 1;
    //Setting the score to 0 as the user has not yet answered any questions
    this.score = 0;
    //Setting the array length to the length of the questions array as the array is 0 indexed
    this.arrayLength = this.questions.length;
    //Setting the seenQuestion array to empty as the user has not yet seen any questions
    this.seenQuestion = [];

    //Elements that will be used in the quiz and altered by the Quiz object
    this.question = document.getElementById("question");
    this.answer = document.getElementById("answer");
    this.showAnswerButton = document.getElementById("show-answer-button");

    /* These buttons have both different point values and are used to determine the score
    The buttons are also used to generate a new question and answer.
    They also give back the question at different points in the array, eg 
    bad means the question is given back quickly*/
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
    this.endOfQuiz();
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
      //Check wether to add score or not
      let flag;
      flag = this.checkAnswer();

      //no need to go over question anymore so remove it
      this.answers.splice(this.currentIndex, 1);
      this.questions.splice(this.currentIndex, 1);

      //Removing the true flag from the showAnswerButton
      this.showAnswerButton.classList.remove("true");

      //Add to the score
      if (flag == true) {
        this.score += 0;
      } else {
        this.score += 1;
      }

      console.log(this.score);

      //Moves to the next question
      this.showQuestion();
      //Remove the next answer from the page
      this.removeAnswer();
    } else {
      return;
    }
  }

  okayClicked() {
    //Quick check to see if the user has seen the question's answer
    if (this.showAnswerButton.classList.contains("true")) {
      //now there is a need to see the question again so add it back to the array
      //Generate a radom number between half of the array length and the length of the array
      let randomIndex = -1;
      //Quick check
      if (!(randomIndex >= 0 && randomIndex <= this.arrayLength)) {
        randomIndex =
          Math.floor(Math.random() * (this.arrayLength / 2)) +
          this.arrayLength / 5;
      }

      let flag;
      flag = this.checkAnswer();
      //Add to the score
      if (flag === true) {
        this.score += 0;
      } else {
        this.score += 0.5;
      }

      //Add the question and answer to the array
      this.questions.splice(randomIndex, 0, this.questions[this.currentIndex]);
      this.answers.splice(randomIndex, 0, this.answers[this.currentIndex]);

      this.answers.splice(this.currentIndex, 1);
      this.questions.splice(this.currentIndex, 1);
      //Remove the true flag from the showAnswerButton
      this.showAnswerButton.classList.remove("true");

      //this add the question to the seen questions which removes chance to add points
      this.seenQuestion.push(this.questions[this.currentIndex]);
      console.log(this.seenQuestion);
      console.log(this.score);

      //Moves to the next question
      this.showQuestion();
      //Remove the next answer from the page
      this.removeAnswer();
    } else {
      return;
    }
  }

  badClicked() {
    //Quick check to see if the user has seen the question's answer
    if (this.showAnswerButton.classList.contains("true")) {
      //Ensures that a new number is generated
      let randomIndex = -1;
      //Quick check
      if (!(randomIndex >= 0 && randomIndex <= this.arrayLength)) {
        randomIndex =
          Math.floor(Math.random() * (this.arrayLength / 2)) +
          this.arrayLength / 20;
      }

      //Add the question and answer back into the array based on the random number
      //This number is changed depending on the length of the array as well as button pressed

      this.questions.splice(randomIndex, 0, this.questions[this.currentIndex]);
      this.answers.splice(randomIndex, 0, this.answers[this.currentIndex]);

      this.answers.splice(this.currentIndex, 1);
      this.questions.splice(this.currentIndex, 1);

      //Removing the true flag from the showAnswerButton
      this.showAnswerButton.classList.remove("true");

      this.seenQuestion.push(this.questions[this.currentIndex]);
      console.log(this.seenQuestion);
      console.log(this.score);

      //Moves to the next question
      this.showQuestion();
      //Remove the next answer from the page
      this.removeAnswer();
    } else {
      return;
    }
  }

  //Function for score to not be allowed if the user has seen the question before
  checkAnswer() {
    if (this.seenQuestion.includes(this.questions[this.currentIndex])) {
      return true;
    } else {
      return false;
    }
  }

  //Checks wether the question has not value if so display splash page
  endOfQuiz() {
    if (this.questions[this.currentIndex] == undefined) {
      SpashPage(this.score, this.arrayLength);
    }
  }
}
