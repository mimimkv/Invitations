const content = document.querySelector(".logout");
content.classList.add("hide");

const loading = document.querySelector(".loading-indicator");
loading.classList.remove("hide");

(async () => {
  const settings = { method: "GET" };
  const url = "../../backend/endpoints/dashboard.php";

  await fetch(url, settings)
    .then((response) => response.json())
    .then((data) => loadUser(data))
    .catch((error) => console.log(error));

  const logoutButton = document.querySelector(".logout");
  // console.log(logoutButton);

  logoutButton.addEventListener("submit", (event) => {
    event.preventDefault();

    const url = "../../backend/endpoints/logout.php";
    fetch(url, settings).then(window.location.replace("../login/login.html"));
  });
})();

const loadUser = (data) => {
  //console.log(data);

  if (data.success) {
    console.log("here");
    content.innerHTML += "Kak sme, ";
    content.innerHTML += data.name;
    content.classList.remove("hide");
    //loading.classList.remove('hide');
    loading.classList.add("hide");
  } else {
    console.log(data.error);
    window.location.replace("../login/login.html");
  }
};
