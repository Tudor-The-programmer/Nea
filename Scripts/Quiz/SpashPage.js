export function SpashPage(score, arrayLength) {
  const subject = document.getElementById("subject").innerHTML;
  const unit = document.getElementById("unit").innerHTML;

  //This class was built to make the quiz easier to use
  const overlay = document.createElement("div");
  overlay.setAttribute("id", "overlay");
  overlay.setAttribute("class", "overlay");

  //THis block will allow me to pass throught the information of the scores to another page
  const form = document.createElement("form");
  form.setAttribute("id", "form");
  form.setAttribute("class", "form");
  form.setAttribute(
    "action",
    "Handler.php" + "?subject=" + subject + "&Unit=" + unit
  );
  form.setAttribute("method", "post");

  //The stat wrapper class used to make stying the stats easier
  const statWrapper = document.createElement("div");
  statWrapper.setAttribute("id", "stat-wrapper");
  statWrapper.setAttribute("class", "stat-wrapper");

  //same idea here
  const statWrapper2 = document.createElement("div");
  statWrapper2.setAttribute("id", "stat-wrapper");
  statWrapper2.setAttribute("class", "stat-wrapper");

  //Content class will wrap around the whole of the stats
  const content = document.createElement("div");
  content.setAttribute("id", "content");
  content.setAttribute("class", "content");

  //Simple title page to show the quiz is completed
  const title = document.createElement("h1");
  title.setAttribute("id", "title");
  title.setAttribute("class", "title");
  title.innerHTML = "Quiz Complete";

  //Subtitle used to show the most important aspect, the score
  const subtitle1 = document.createElement("label");
  subtitle1.setAttribute("id", "subtitle");
  subtitle1.setAttribute("class", "subtitle");
  subtitle1.innerHTML = "Score: ";

  //score marker
  const stat1 = document.createElement("input");
  stat1.setAttribute("id", "description");
  stat1.setAttribute("class", "description");
  stat1.setAttribute("type", "text");
  stat1.setAttribute("name", "score");
  stat1.setAttribute("value", score + "/" + (arrayLength - 1));
  stat1.setAttribute("readonly", "readonly");

  //percentage marker
  const subtitle2 = document.createElement("label");
  subtitle2.setAttribute("id", "subtitle");
  subtitle2.setAttribute("class", "subtitle");
  subtitle2.innerHTML = "Percentage: ";

  //Shows the score as a percentage
  const stat2 = document.createElement("input");
  stat2.setAttribute("id", "description");
  stat2.setAttribute("class", "description");
  stat2.setAttribute("type", "text");
  stat2.setAttribute("name", "percentage");
  stat2.setAttribute(
    "value",
    //Simple math to get the percent
    Math.floor((score / (arrayLength - 1)) * 100) + "%"
  );
  stat2.setAttribute("readonly", "readonly");

  //This function will simply restart the quiz
  const button = document.createElement("button");
  button.setAttribute("id", "button");
  button.setAttribute("class", "button");
  button.innerHTML = "start again";
  //On the click of the button it will reload the webpage
  //Causing it to start over
  button.addEventListener("click", (event) => {
    location.reload();
  });

  //This is for the score to submit their scores
  const closeButton = document.createElement("button");
  closeButton.setAttribute("id", "close-button");
  closeButton.setAttribute("class", "button");
  closeButton.setAttribute("type", "submit");
  closeButton.setAttribute("name", "submit");
  closeButton.innerHTML = "Submit Score";
  closeButton.addEventListener("click", (event) => {
    //this onclick takes the last webpage *always is the main page*
    //and sends the user back to it
    history.back();
  });

  //Appending all of the values to form the page
  document.body.appendChild(overlay);
  overlay.appendChild(content);
  content.appendChild(title);

  statWrapper.appendChild(subtitle1);
  statWrapper.appendChild(stat1);
  form.appendChild(statWrapper);

  statWrapper2.appendChild(subtitle2);
  statWrapper2.appendChild(stat2);
  form.appendChild(statWrapper2);

  form.appendChild(closeButton);

  content.appendChild(button);
  content.appendChild(form);
}

// Language: javascript
// Path: Scripts\Quiz\Quiz.js
// This is for all the elements for when you finish the quiz and want to submit the score
