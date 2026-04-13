function validateForm() {
    let firstName = document.getElementById("firstname").value;
    let lastName = document.getElementById("lastname").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let message = document.getElementById("message").value;
    
    if (firstName === "" || lastName === "" || email === "" || phone === "" || message === "") {
        alert("Please fill in all fields.");
        return false;
    }else{
        console.log("First Name: " + firstName);
        console.log("Last Name: " + lastName);
        console.log("Email: " + email);
        console.log("Phone: " + phone);
        console.log("Message: " + message);
        return false;
    }
}