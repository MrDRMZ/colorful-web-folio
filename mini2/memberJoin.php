<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="utf-8">
    <title>Register</title>
    
    <link href="css/mini.css" rel="stylesheet">
    
    <script>
    
        function validatePassword() {
            // get the pswds to compare
            const pswd = document.getElementById("pswd").value;
            const pswd2 = document.getElementById("pswd2").value;
            
            // do they match?
            if(pswd != pswd2) {
                alert("Passwords Don't Match!");
                return false;
            }
        }
    
    </script>
    
</head>
    
<body>
    
    <form method="post" action="memberJoinProc.php"                 onsubmit="return validatePassword()">
    
        <h1>Join Now! It's Free!</h1>
        
        Already a member? <a href="login.php">Log In</a>
        
        <p><input type="text" name="firstName" id="firstName" placeholder="First Name" required></p>
        
        <p><input type="text" name="lastName" id="lastName" placeholder="Last Name" required></p>
        
        <p><input type="email" name="email" id="email" placeholder="Email" required></p>
        
        <p><input type="text" name="user" id="user" placeholder="Username" required></p>
        
        <p><input type="password" name="pswd" id="pswd" placeholder="Password" required></p>
    
        <p><input type="password" name="pswd2" id="pswd2" placeholder="Re-Enter Password" required></p>
        
        <p><input type="submit" name="submit" id="submit" value="Sign Me Up"></p>
    
    </form>

</body>

</html>