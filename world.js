window.onload = event =>{
    var searchBtn = document.getElementById('lookup');
    var country = document.getElementById('country');
    var countryInfo = document.getElementById('result');

    /* This is the code that is executed when the button is clicked. */
    searchBtn.onclick = event =>{
        /* Creating a new XMLHttpRequest object. */
        var httpReq = new XMLHttpRequest();
        httpReq.onreadystatechange = function(){
            if(httpReq.readyState==4 && httpReq.status==200){
               countryInfo.innerHTML = httpReq.response;
            }
        }
        /* Sending a GET request to the world.php file with the country name as a parameter. */
        httpReq.open('GET', `world.php?country=${country.value.trim()}`);
        /* Sending the request to the server. */
        httpReq.send();
    }
}