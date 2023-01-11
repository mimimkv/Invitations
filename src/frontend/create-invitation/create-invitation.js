(() => {
  const form = document.querySelector(".create-invitation");
  const inputs = document.querySelectorAll(".input");
  const formError = document.getElementById("form-error");

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    formError.classList.remove("error");

    formError.innerHTML = null;

    /*let data = {};
    inputs.forEach((i) => {
      data[i.name] = i.value;
    }); */

    const formData = new FormData();

    formData.append(inputs[0].name, inputs[0].value);
    formData.append(inputs[1].name, inputs[1].value);
    console.log(inputs[2].name);
    console.log(inputs[3].name);
    console.log(inputs[4].name);

    formData.append(inputs[2].name, inputs[2].value);
    formData.append(inputs[3].name, inputs[3].value);
    formData.append(inputs[4].name, inputs[4].files[0]);

    createInvitation(formData)
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
      /*headers: {
        "Content-Type": "application/json",
      }, */
      body: data
    }
  );

  const responseJson = await response.json();
  if (responseJson["success"] === false) {
    throw new Error(responseJson["error"]);
  }
}
