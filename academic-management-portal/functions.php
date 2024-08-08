<?php

function registrationControl($email)
{
    $file = "users.txt";
    $result = 0;
    if (file_exists($file)) {
        $read = fopen($file, "r");
        while (!feof($read)) {
            $line = fgets($read);
            $array = explode(";", $line);
            if (isset($array[1]) && $array[1] == $email) {
                $result = 1;
                break;
            } else {
                $result = 0;
            }
        }
        fclose($read);
    } else {
        $result = 0;
    }
    return $result;
}

function registerMember($username, $email, $pword, $ip, $registeration_date, $authorisation)
{
    $file = "users.txt";
    $add = "\n" . $username . ";" . $email . ";" . $pword . ";" . $ip . ";" . $registeration_date . ";" . $authorisation;
    $open = fopen($file, "a");
    fwrite($open, $add);
    fclose($open);
    echo "Congratulations you have successfully registered! <a href='login.html'>Login</a>";
}

function loginControl($email, $pword)
{
    $file = "users.txt";
    $result = 0;
    if (file_exists($file)) {
        $read = fopen($file, "r");
        while (!feof($read)) {
            $line = fgets($read);
            $array = explode(";", $line);
            if (isset($array[1]) && isset($array[2]) && ($array[1] == $email) && ($array[2] == $pword)) {
                $result = 1;
                break;
            }
        }
        fclose($read);
    } else {
        $result = 0;
    }
    return $result;
}

function userInfo($email)
{
    $file = "users.txt";

    if (file_exists($file)) {
        $read = fopen($file, "r");

        while (!feof($read)) {
            $line = fgets($read);
            $array = explode(";", $line);

            if (isset($array[1]) && ($array[1]) == $email) {
                for ($i = 0; $i <= 5; $i++) {
                    $value[] = $array[$i];
                }
                break;
            }
        }
        fclose($read);
    } else {
        $value = "";
    }
    return $value;
}

function updateAuthorisation($username, $email, $authorisation_code)
{
    $file = "users.txt";
    $result = 0;
    if (file_exists($file)) {
        $lines = file($file);
        $updated = false;
        $update = fopen($file, "w");

        foreach ($lines as $line) {
            $array = explode(";", $line);
            if (isset($array[0], $array[1]) && trim($array[0]) == $username && trim($array[1]) == $email) {
                $array[5] = $authorisation_code;
                $line = implode(";", $array) . "\n";
                $updated = true;
                $result = 1;
            }
            fwrite($update, $line);
        }
        fclose($update);

        if (!$updated) {
            $result = 0;
        }
    } else {
        $result = 0;
    }
    return $result;
}



?>