<?php
    // what do we need to do at the member page
    // 1.) authenticate user (redirect if not logged in)
    // 2.) query the db for that member's data, including their profile pic (so images table needs to be involved)
    // 3.) output results into some kind of layout
    // 4.) provide a means for user to Edit their info
    // 5.) search for other members
    // 6.) allow interaction between users

    // 1.) authenticate user (redirect if not logged in)
    session_start();
    // check for user as session var
    if(isset($_SESSION['user'])) { // if we will let them stay
      // pass Session vars to Regular vars :
        $user = $_SESSION['user']; // user filepath
        $IDmbr = $_SESSION['$IDmbr'];
        $firstName = $_SESSION['firstName'];


        require_once("conn/connMini.php");
        $msg = "Hi " . $_SESSION['firstName'];
        $msg .= '<a href="?logout=yep">Log Out</a>';
        // what do we do if logged in user gets to stay?
        // load their own personal data from members table
        $query = "SELECT * FROM members WHERE IDmbr='$IDmbr'";
        $IDmbr = $_SESSION['IDmbr'];
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        // testing, 1, 2, 3.. did we get the data to load..??
        $msg = $row['firstName'] . " " . $row['lastName'];
      } else { // Intruder Alert! Session var for user not set !
        // redirect to the login.php page
        header("Location: login.php");
    }

    // if they clicked the Log Out
    if(isset($_GET['logout'])) {
        session_destroy();
        $msg = 'You are logged out! Now redirecting..';
        header("Refresh:4; url=login.php", true, 303);
    }

    //querry the DB for the profile picture
    $queryMainPic = "SELECT * FROM images
                     WHERE catID=3
                     AND isMainPic=1
                     AND foreignID='$IDmbr'";

    $resultMainPic = mysqli_query($conn, $queryMainPic);

    //theres only ONE main pics
    $rowMainPic = mysqli_fetch_array($resultMainPic);
    $mainPic = $rowMainPic['imgName'];

    //load users picture albumb from DB
    $queryPics = "SELECT * FROM images
                  WHERE foreignID='$IDmbr'
                  AND catID=3
                  ORDER BY IDimg DESC";
    $resultPics = mysqli_query($conn, $queryPics);



?>

<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="utf-8">
    <title>Profile</title>

    <link href="css/mini.css" rel="stylesheet">

</head>

<body>

    <div id="profile-container">

        <header id="profile-header">
            <h3><?php echo $msg; ?></h3>

            <p style="text-align:right">

                <button id="edit-btn" onclick="toggleEdit()"
                        style="font-size:1rem;
                               padding: 3px 45px">Edit</button>

                 &nbsp; <a href="?logout=yep">Log Out</a>
            </p>

        </header>

        <div class="myPics" id="myPics"
          style="height:80px; padding:10px; background:beige; border-radius:10px; margin-top:20px;
          border:3px solid orange; overflow-x:scroll">
          <!-- output users picture gallery -->
          <?php
            while($rowPics = mysqli_fetch_array($resultPics)) {
              # code...
              echo '<img src="members/' . $user . '/images/' . $rowPics['imgName'] .'
                " height="100%" width="auto" onclick="swapImage()">';
            }


           ?>

          <h3 align="center">LOAD ALL USERS PICS HERE</h3>

        </div>

        <div id="profile-pics">

            <!-- ###***### UPLOAD PIC CODE START ###***###-->
            <div id="upload-pic" style="background-color:#EEF;
            min-height:30px; padding: 10px; text-align:left; margin:10px 5px">

                <p>Upload Profile Pic:</p>
                <form method="post" action="upload-pic-proc.php" enctype="multipart/form-data"
                style="padding:0; background-color:transparent; border:0px; width:100%; margin:0">

                    <input type="file" name="fileToUpload" style="border:0; width:100%">

                    <input type="checkbox" id="isMainPic" name="isMainPic" value="isMainPic" class="chkbox">

                    <label for="isMainPic">Set Profile Pic</label>
                    <br>
                    <button style="padding: 5px 15px">
                        Save Image
                    </button>

                </form>

            </div><!-- close upload-pic -->
            <!-- ###***### UPLOAD PIC CODE END ###***###-->


            <!-- use default "coming soon" picture -->
            <?php
              if($mainPic == "pic-coming-soon.jpg"){
                  //the coming soon picture is in main image folder
                  $imgPath = "images/" . $mainPic;
                } else {
                  //the users profile picture is in their own folder
                  $imgPath = 'members/' . $user . '/images/' . $mainPic;
              }
                //output the profile image
                echo '<img src="' . $imgPath . '"
                width="100%" heigh="auto" id="mainPic">';
            ?>

        </div>

        <div id="profile-details">

            <div id="profile-uneditable">

                <p>Name: <?php echo $row['firstName'] .
                    " " . $row['lastName']; ?></p>

                <p>Username: <?php echo $row['user']; ?></p>

                <p>Member Since: <?php echo date('M. D. d, Y', strtotime($row['joinTime'])); ?></p>

                <p>Company: <?php echo $row['company']; ?><br/>
                    Job Title: <?php echo $row['jobTitle']; ?><br/>
                    Hobbies: <?php echo $row['hobbies']; ?><br/><br/>
                    About Me: <?php echo $row['aboutMe']; ?></p>

            </div><!-- close #profile-uneditable -->

            <!-- Edit Me Box is hidden on page load -->
            <div id="profile-editable" style="display:none">

                <form method="post" action="profile-editable-proc.php">

                    <h3>Edit Your Personal Details</h3>

                    <!-- Company, Job Title, Hobbies, About Me -->
                    <p><input type="text" name="company" placeholder="Company" value="<?php echo $row['company']; ?>"></p>

                    <p><input type="text" name="jobTitle" placeholder="Job Title" value="<?php echo $row['jobTitle']; ?>"></p>

                    <p><textarea name="hobbies" cols="50" rows="3" placeholder="Hobbies"><?php echo $row['hobbies']; ?></textarea></p>

                    <p><textarea name="aboutMe" cols="50" rows="10"><?php echo $row['aboutMe']; ?></textarea></p>

                    <p><input type="submit" name="submitEditProfile"
                               value="Save Changes"></p>

                </form>

            </div><!-- close #profile-edit-me -->

        </div><!-- close #details -->

        <footer>
            <p>Links and stuff</p>
        </footer>

    </div><!-- close #profile-container -->

    <script>
        //change the Main profile pic to be the clicked thumbnail image
        function swapImage(){

          //event.target is the "thing" that called the  function
          //in this case, event.target  is the thumbnail image
          const mainPic = document.getElementById('mainPic');
          //set the source of tghe main pic source
          mainPic.src = event.target.src;


        }

        // toggle uneditable and editable member details boxes
        function toggleEdit() {

            // grab both boxes and the Edit button
            const profileUneditable = document.getElementById('profile-uneditable');
            const profileEditable = document.getElementById('profile-editable');
            const editBtn = document.getElementById('edit-btn');

            // toggle visibility: hide visible, show invisible
            if(editBtn.innerHTML == "Edit") {

                editBtn.innerHTML = "Cancel";
                profileEditable.style.display = "block"; // show hidden Edit Form/div
                profileUneditable.style.display = "none"; // show uneditable details

            } else { // edit button already says "Cancel"

                editBtn.innerHTML = "Edit";
                profileEditable.style.display = "none"; // show hidden Edit Form/div
                profileUneditable.style.display = "block"; // show uneditable details

            } // end if-else

        } // toggleEdit()

    </script>

</body>

</html>
