//Import the quiz object
import { Quiz } from "./Quiz/MainFunctions.js";
//Get an array from the StudyPage.php file
let array = JSON.parse(document.getElementById("invisible").innerHTML);
//To not allow for the user to cheat by changing the answer
document.body.removeChild(document.getElementById("invisible"));

let questions = [];
let answers = [];

/*Assign the from the larger array questions and answers to the questions
and answers array*/
for (let i = 0; i < array.length; i++) {
  if (array[i][0] != null) {
    questions.push(array[i][0]);
    answers.push(array[i][1]);
  }
}

//Create a new quiz object
let quiz = new Quiz(questions, answers);

//starts the whole quiz
quiz.showQuestion();


