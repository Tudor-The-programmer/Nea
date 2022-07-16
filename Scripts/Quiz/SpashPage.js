export function SpashPage(score, arrayLength) {
  const subject = document.getElementById("subject").innerHTML;
  const unit = document.getElementById("unit").innerHTML;

  //This class was built to make the quiz easier to use
  const overlay = document.createElement("div");
  overlay.setAttribute("id", "overlay");
  overlay.setAttribute("class", "overlay");

  const form = document.createElement("form");
  form.setAttribute("id", "form");
  form.setAttribute("class", "form");
  form.setAttribute(
    "action",
    "Handler.php" + "?subject=" + subject + "&Unit=" + unit
  );
  form.setAttribute("method", "post");

  const statWrapper = document.createElement("div");
  statWrapper.setAttribute("id", "stat-wrapper");
  statWrapper.setAttribute("class", "stat-wrapper");

  const statWrapper2 = document.createElement("div");
  statWrapper2.setAttribute("id", "stat-wrapper");
  statWrapper2.setAttribute("class", "stat-wrapper");

  const content = document.createElement("div");
  content.setAttribute("id", "content");
  content.setAttribute("class", "content");

  const title = document.createElement("h1");
  title.setAttribute("id", "title");
  title.setAttribute("class", "title");
  title.innerHTML = "Quiz Complete";

  const subtitle1 = document.createElement("label");
  subtitle1.setAttribute("id", "subtitle");
  subtitle1.setAttribute("class", "subtitle");
  subtitle1.innerHTML = "Score: ";

  const stat1 = document.createElement("input");
  stat1.setAttribute("id", "description");
  stat1.setAttribute("class", "description");
  stat1.setAttribute("type", "text");
  stat1.setAttribute("name", "score");
  stat1.setAttribute("value", score + "/" + (arrayLength - 1));
  stat1.setAttribute("readonly", "readonly");

  const subtitle2 = document.createElement("label");
  subtitle2.setAttribute("id", "subtitle");
  subtitle2.setAttribute("class", "subtitle");
  subtitle2.innerHTML = "Percentage: ";

  const stat2 = document.createElement("input");
  stat2.setAttribute("id", "description");
  stat2.setAttribute("class", "description");
  stat2.setAttribute("type", "text");
  stat2.setAttribute("name", "percentage");
  stat2.setAttribute("value", (score / (arrayLength - 1)) * 100 + "%");
  stat2.setAttribute("readonly", "readonly");

  const button = document.createElement("button");
  button.setAttribute("id", "button");
  button.setAttribute("class", "button");
  button.innerHTML = "start again";
  button.addEventListener("click", (event) => {
    location.reload();
  });

  const closeButton = document.createElement("button");
  closeButton.setAttribute("id", "close-button");
  closeButton.setAttribute("class", "button");
  closeButton.setAttribute("type", "submit");
  closeButton.setAttribute("name", "submit");
  closeButton.innerHTML = "Submit Score";
  closeButton.addEventListener("click", (event) => {
    history.back();
  });

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
