let url = window.location.href;
url = url.split("=");
let unit = url[2];
let subject = url[1].replace("%20", " ").split("&")[0];

async function getCsv() {
  const response = await fetch("../Databases/" + subject + "/" + unit + ".csv");
  const data = await response.text();

  let rows = data.split("\n").splice(1);
  rows.forEach((elt) => {
    const row = elt.split(",");
    console.log(row);
  });
  console.log(rows);
}

getCsv();
