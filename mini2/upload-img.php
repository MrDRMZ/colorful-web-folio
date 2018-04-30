<?php include "includes/authentication.php"; ?>
<?php
// A.) save the image file name to the images table
require_once("conn/connApts.php");
$msg = "";
// cancel all if user clicked Upload Image without choosing a file to upload */
if($_FILES["fileToUpload"]["name"] != "") {
    
    $imgName = basename($_FILES["fileToUpload"]["name"]);
    
    // check to see if the name is already in the db
    $query = "SELECT imgName FROM images WHERE imgName='$imgName'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) == 0) { // if we got no result
        // since $imgName is NOT in the images table, INSERT it
        $query2 = "INSERT INTO images(imgName, catID, foreignID)
                 VALUES('$imgName', 3, '$IDmbr')"; // 3 == "member"
        mysqli_query($conn, $query2);
    } else {
        $msg .= "Whoa! The file name " . $imgName . " is already in the database! ";
    }

    // B.) upload the actual file to the server
    $target_dir = "members/" . $user . "/images/";
    $target_file = $target_dir . $imgName;
    $uploadOk = 1; // a Boolean to keep track of status (0==failure)

    // check if file aleady exists at destination with file_exists()
    if(file_exists($target_file)) {
       $msg .= " Upload failed. File already exists.";
       $uploadOk = 0;
    }

    // check if file exceeds upload size max of 5 MB
    if($_FILES["fileToUpload"]["size"] > 5000000) {
         $msg .= " Upload failed. File size exceeds 5MB Max";
         $uploadOk = 0;     
    }

    // determine the file type / file extension with pathinfo()
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // check if the file type/extension is eligible for upload
    if($imageFileType != "jpg" && $imageFileType != "png" 
       && $imageFileType != "jpeg" && $imageFileType != "gif") {
          $msg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
    }
  
    // if no errors ($uploadOk == 1), proceed to upload the file
    if($uploadOk == 0) {
       $msg .= "Sorry, your file was not uploaded.";
     } else { // if $uploadOk == 1, try to upload file
       if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
         $msg .= "Success! The file " . $imgName . " has been uploaded. ";
       } else {
         $msg .= "Sorry, there was an error uploading your file.";
       }
     }

} 
    // redirect back to Blog CMS
    // header("Location: blogCMS-Img.php");
    // stay on this page for 3 seconds to allow time to read messages
    header("Refresh:0.1; url=myNetwork.php?edit=yep", true, 303);
    session_write_close();
?>




