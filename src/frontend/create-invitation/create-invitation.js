(() => {
  const form = document.querySelector(".create-invitation");
  const inputs = document.querySelectorAll(".input");
  const formError = document.getElementById("form-error");

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    formError.classList.remove("error");

    formError.innerHTML = null;

    let data = {};
    inputs.forEach((i) => {
      data[i.name] = i.value;
    });

    createInvitation(data)
      .then(() => {
        window.location.replace("../dashboard/dashboard.html");
      })
      .catch((error) => {
        formError.classList.add("error");
        formError.classList.remove("hide");
        const message = error;
        formError.innerText = message;
      });
  });
})();

async function createInvitation(data) {
  const response = await fetch(
    "../../backend/endpoints/create-invitation.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }
  );

  const responseJson = await response.json();
  if (responseJson["success"] === false) {
    throw new Error(responseJson["error"]);
  }
}
