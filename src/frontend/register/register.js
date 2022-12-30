(() => {
  const form = document.querySelector(".registration");
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

    const email = data['email'];
    //if (!isValidEmail(email))
    if (true) {
        const emailError = document.getElementById('email-error');
        emailError.classList.add('error');
        emailError.classList.remove('hide');
        emailError.innerText = 'Invalid email address';
    }


    saveUser(data)
      .then((response) => {
        if (response["success"] === false) {
          throw new Error(response["error"]);
        } else {
          window.location.replace("../login/login.html");
        }
      })
      .catch((error) => {
        formError.classList.add("error");
        formError.classList.remove("hide");
        const message = error;
        formError.innerText = message;
      });
  });
})();

async function saveUser(data) {
    //mocked exception
  throw new Error("Unsupported operation");
  const response = await fetch(
    "../../backend/controllers/user-controller.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }
  );

  return await response.json();
}
