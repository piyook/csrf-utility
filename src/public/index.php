<?php 
// send some CORS headers so the API can be called from anywhere
header("Access-Control-Allow-Origin: http://localhost:8000");
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Expose-Headers: Set-Cookie");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Origin, Accept, Pragma, Access-Control-Allow-Headers, Authorization, X-Requested-With");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF COOKIE TEST</title>
</head>
<body>

    <div align="center">
        <h1> CSRF Cookie Test </h1>
   

    <button onclick="setCSRF()">SET csrf cookie</button>
    <button onclick="checkCSRF()">SEND & CHECK csrf cookie</button>

    </div>
    

<script>

    async function setCSRF(){

        const result = await fetch('/csrf.php', {
        method: 'GET',
        mode: 'cors',
        credentials: 'include',

});
        if (result.status === 200) { alert("CSRF SET OK") } else {alert("CSRF NOT SET" )} ;
    }

    async function checkCSRF(){
        let formData = new FormData();
        formData.append('anyParam', 'anyValue');
        const result = await fetch('/protected.php', {
        method: 'POST',
        mode: 'cors',
        credentials: 'include',
        body: formData,
});
        if (result.status === 200) { alert("CSRF SET & IS OK") } else {alert("CSRF NOT SET OR NOT VALID" )} ;
    }
    

</script>
</body>

</html>

