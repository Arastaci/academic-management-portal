<?php
include ("functions.php");

if (isset($_POST["register"])) {
    $username = strip_tags($_POST["username"]);
    $email = strip_tags($_POST["email"]);
    $pword = strip_tags($_POST["pword"]);
    $pword2 = strip_tags($_POST["pword2"]);
    $ip = strip_tags($_SERVER['REMOTE_ADDR']);
    $registeration_date = strip_tags(date("d/m/Y"));
    $authorisation = 0;
    if ($pword == $pword2) {
        $control = registrationControl($email);
        if ($control == 0) {
            registerMember($username, $email, $pword, $ip, $registeration_date, $authorisation);
        } else {
            echo "This email is already registered to log in: <a href='login.html'>Login</a>";
        }
    } else {
        echo "<script>alert('The passwords don't match!');</script>";
        echo "<div class='alert alert-danger' role='alert'><a href='register.html' class='alert-link'>Back to Register page!</a></div>";
    }
} else {
    echo "<script>alert('Please fill in the form first!');</script>";
    echo "<div class='alert alert-danger' role='alert'><a href='register.html' class='alert-link'>Please fill in the form first!</a></div>";
}

?>