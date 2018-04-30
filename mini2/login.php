<?php

    if(!isset($_SESSION)) {
        // session is required to set and access $_SESSION variables, which are stored on the server and are 
        // used to authenticate users
        session_start();
        // Ending a session in 30 minutes from the starting time.
        // $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
    }

    require_once("conn/connMini.php");

    // ###***### ###***## ###***## ###***##
    // ###***### LOG IN PROCESSOR ###***###
    // ###***### ###***## ###***## ###***##

    // memberJoinProc.php redirects here on successful registration of new member

    // if the Log In form was submitted
    // the form variables are all set
    // only run this code on submit of form
    if(isset($_POST['loginSubmit'])) {
        $user = $_POST['user']; // process the login attempt
        $pswd = $_POST['pswd'];       
        // query the database for the user
        $query = "SELECT * FROM members WHERE user='$user'";    
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);      
        // if we found results, output their data as a test
        // and compare pswd they entered to the hashed pswd in db
        if(mysqli_num_rows($result) == 1) {
            // check to see if pswd entered matches hashed
            if(password_verify($pswd, $row['pswd'])) {
                // we made it this far, so user n pswd both good
                // welcome the user and provide log out link
                $msg = 'Welcome ' . $row['firstName'] . '!<br/>';
                $msg .= '<a href="?logout=yep">Log Out</a>';
                
                // Make SESSION variables for Authentication
                $_SESSION['user'] = $row['user'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['IDmbr'] = $row['IDmbr'];
                
                // did the session vars get initialized ??
                $msg .= "<br/>Username: " . $_SESSION['user'];
                
                // provide link to personal profile page
                $msg .= '<br/><a href="profile.php">My Profile</a>';
                
            } // end if(password_verify($pswd, $row['pswd'])) 
        } // end if(mysqli_num_rows($result) == 1)  
    } // end if(isset)

    // if user clicked Log Out, a URL Var called logout=yep
    // got appended to the URL: login.php?logout=yep
    // the following if statement looks for the logout var, and 
    // if it finds it, ends the session, destroying all SESSION vars in the process
    if(isset($_GET['logout'])) {
        session_destroy();
        $msg = 'You are logged out';
    }

?>

<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="utf-8">
    <title>Log In</title>
    
    <link href="css/mini.css" rel="stylesheet">

</head>
    
<body>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
        <h3>Please Log In</h3>
        
        <p>
            <input type="text" name="user" placeholder="Username" required>
        </p>
        
        <p>
            <input type="password" name="pswd" placeholder="Password" required>
        </p>
        
        <p>
            <input type="submit" name="loginSubmit" value="Log In">
        </p>
        
        <h4 style="text-align:center; 
                  font-size:0.9rem">
            <?php echo $msg; ?>
        </h4>
    
    </form> 

</body>

</html>