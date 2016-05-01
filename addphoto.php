<?php
include("connection.php"); //Establishing connection with our database

$msg = ""; //Variable for storing our errors.
if(isset($_POST["submit"])) {

    //Sanitize title input
    $title = stripcslashes($title);
    $title = mysqli_real_escape_string($db,$title);
    $title = htmlspecialchars($title);

    //Sanitize desc input
    $desc = stripcslashes($desc);
    $desc = mysqli_real_escape_string($db,$desc);
    $desc = htmlspecialchars($desc);

    $url = "test";
    $name = $_SESSION["username"];

    $uploadfile = $_FILES['fileToUpload']['name'];
    $imageFileType = pathinfo($uploadfile, PATHINFO_EXTENSION);
    $uploadsize = $_FILES['fileToUpload']['size'];
    $uploadtype = $_FILES['fileToUpload']['type'];
    //$uploadfile = md5($uploadfile);


    $target_dir = "versali35e/";
    $target_file = $target_dir . md5(basename($_FILES["fileToUpload"]["name"]));

    $uploadOk = 1;

    //specify file type as image type
    if (($imageFileType == 'jpg' || $imageFileType == 'jpeg' || $imageFileType == 'png') &&
        ($uploadsize < 8000) &&
        ($uploadtype == 'image/jpeg' || $uploadtype == 'image/png')

    ) {

        $sql = "SELECT userID FROM users WHERE username='$name'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) == 1) {
            //$timestamp = time();
            //$target_file = $target_file.$timestamp;
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $id = $row['userID'];
                $addsql = "INSERT INTO photos (title, description, postDate, url, userID) VALUES ('$title','$desc',now(),'$target_file','$id')";
                $query = mysqli_query($db, $addsql) or die(mysqli_error($db));
                if ($query) {
                    $msg = "Thank You! The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded. click <a href='photos.php'>here</a> to go back";
                }

            } else {
                $msg = "Sorry, there was an error uploading your file.";
            }
            //echo $name." ".$email." ".$password;


        } else {
            $msg = "You need to login first";
        }
    }
    else
    {
        $msg =' Sorry bruv wrong file type or file is too large';
    }
}
?>