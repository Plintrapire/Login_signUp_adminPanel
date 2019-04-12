<?php
require "db.php";
$user = R::findOne('users', 'login = ?', array($data['login']));
        if ($user) 
        {
            if (password_verify($data['password'], $user->password))
            {
                $_SESSION['logged_user'] = $user;
                echo '<div style="color: green;">logged, link to <a href="index.php">main page</a></div><hr>';
            }else
            {
                $errors[] = "wrong password";
            }
        } else 
    {
    $errors[] = 'login not found, <a href="signup.php">register now</a>';
    }
    if (!empty($errors)) {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
?>