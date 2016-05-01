<?php
$msg = "";
if(isset($_POST["submit"]))
{
    //Define and Sanitize username input
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $username = stripcslashes($username);
    $username =htmlspecialchars($username);

    //Define and Sanitize email input
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $email = stripcslashes($email);
    $email =htmlspecialchars($email);

    //Define and Sanitize password input
    $password = md5(mysqli_real_escape_string($db, $_POST['password']));
    $password = stripcslashes($password);
    $password =htmlspecialchars($password);


    $sql="SELECT email FROM users WHERE email='$email'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 1)
    {
        $msg = "Sorry...This email already exists...";
    }
    else
    {
        //echo $name." ".$email." ".$password;
        $query = mysqli_query($db, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')")or die(mysqli_error($db));
        if($query)
        {
            $msg = "Thank You! you are now registered. click <a href='index.php'>here</a> to login";
        }

    }
}
?>