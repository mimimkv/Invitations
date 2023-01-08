(async () => {
  const settings = { method: "GET" };
  const url = "../../backend/endpoints/dashboard.php";

  await fetch(url, settings)
    .then((response) => response.json())
    .then((data) => loadUser(data))
    .catch((error) => console.log(error));

  const logoutButton = document.querySelector(".logout");

  logoutButton.addEventListener("submit", (event) => {
    event.preventDefault();

    const url = "../../backend/endpoints/logout.php";
    fetch(url, settings).then(window.location.replace("../login/login.html"));
    localStorage.setItem("isLoggedIn", false);
  });

  const invitations = document.getElementById("invitations");
  const result = await getInvitations();
  console.log(result);
  if (result["body"].length === 0) {
    const emptyBodyMessage = document.createElement("p");
    emptyBodyMessage.innerHTML = "No invitations yet.";
    invitations.appendChild(emptyBodyMessage);
    return;
  }

  result["body"].forEach((element) => {
    const div = document.createElement("div");
    const button = document.createElement("button");
    button.innerHTML = "Like";

    if (element["filename"] !== "NULL") {
      const image = document.createElement("img");
      image.setAttribute("src", "data:image/jpg;base64," + element["filename"]);

      div.appendChild(image);
      div.appendChild(button);
      div.setAttribute("class", "invitation");

      invitations.appendChild(div);
    } else {
      const defaultInvitation = document.createElement("section");
      defaultInvitation.setAttribute('class', 'default-invitation');

      const content = document.createElement("section");
      content.setAttribute('class', 'content');

      const invitationMessage = document.createElement('h2');
      invitationMessage.innerHTML = 'Заповядайте на презентацията на Гошо!';

      const title = document.createElement("p");
      title.innerHTML = "Title: " + element["title"];

      const place = document.createElement("p");
      place.innerHTML = "Place: " + element["place"];

      content.appendChild(invitationMessage);
      content.appendChild(title);
      content.appendChild(place);
      defaultInvitation.appendChild(content);
      defaultInvitation.appendChild(button);

      invitations.appendChild(defaultInvitation);
    }
  });
})();

const loadUser = (data) => {
  if (data.success) {
    const logout = document.querySelector(".logout");
    const hello = document.createElement("h3");
    hello.innerHTML = "Hello, " + data.name;
    logout.insertBefore(hello, logout.firstChild);
  } else {
    console.log(data.error);
    //window.location.replace("../login/login.html");
  }
};

async function getInvitations() {
  const settings = { method: "GET" };
  const url = "../../backend/endpoints/get-invitations.php";

  return await fetch(url, settings)
    .then((response) => response.json())
    .catch((error) => console.log(error));
}
