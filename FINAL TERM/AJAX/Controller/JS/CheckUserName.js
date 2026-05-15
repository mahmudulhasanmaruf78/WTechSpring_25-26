function CheckUserName() 
{
    let name = document.getElementById("name").value;
    let responseText = document.getElementById("userresponse");
    if(name.length == 0)
    {
        responseText.innerHTML = "Name is required";
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200)
        {
            responseText.innerHTML = this.responseText;
        }
        else
        {
            responseText.innerHTML = this.status;
        }
    }

    xhttp.open("POST", "../Controller/CheckUsername.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("name="+encodeURIComponent(name));
}