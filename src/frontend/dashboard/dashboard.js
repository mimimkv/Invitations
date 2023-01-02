(async () => {
    const settings = {method: 'GET'};
    const url = "../../backend/endpoints/dashboard.php";
    await fetch(url, settings)
        .then(response => response.json())
        .then(data => loadUser(data))
        .catch(error => console.log(error));
    
    //console.log("he");

    const logoutButton = document.querySelector('.logout');
    console.log(logoutButton);

    logoutButton.addEventListener('submit', (event) => {
        event.preventDefault();
    
        const url = "../../backend/endpoints/logout.php";
        fetch(url, settings)
            .then(console.log("hellp"))
            .then(window.location.replace("../login/login.html"));
    }); 

    // console.log("helllooooo");

})();

const loadUser = data => {

    //console.log(data);

    if (data.success) {
        document.body.innerHTML += "Kak sme, ";
        document.body.innerHTML += data.name;
    } else {
        console.log(data.error);
        window.location.replace('../login/login.html');
    }
}