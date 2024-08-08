<?php
include ("functions.php");

if (isset($_POST["login"])) {
    $email = strip_tags($_POST["email"]);
    $pword = strip_tags($_POST["pword"]);

    $checkRegistration = registrationControl($email);
    $checkLogin = loginControl($email, $pword);
    if ($checkRegistration == 0) {
        echo "This email is not registered";
    } else {
        if ($checkLogin == 0) {
            echo "Username or password incorrect";
        } else {
            session_start();
            $_SESSION["session"] = true;
            echo "Login successful! Your session will be started shortly<br>";
            $info = userInfo($email);
            $_SESSION["username"] = $info[0];
            $_SESSION["email"] = $info[1];
            $_SESSION["pword"] = $info[2];
            $_SESSION["ip"] = $info[3];
            $_SESSION["registeration_date"] = $info[4];
            $_SESSION["authorisation"] = $info[5];
            // echo "Welcome {$_SESSION['username']}";
            header("Location: index.php");
        }
    }
    echo $checkRegistration;
} else {
    echo "<a href='login.html'>Please fill in the form first</a>";
}
?>

