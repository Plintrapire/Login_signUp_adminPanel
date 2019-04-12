<?php
require "db.php";
$data = $_POST;
if (isset($data['do_login']))
 {
        $errors = array();
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
    $errors[] = 'Данный аккаунт не существует, <a href="signup.php">Зарегистрировать аккаунт?</a>';
    }
    if (!empty($errors)) {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
}
?>
<a href="index.php">Назад</a>
<form action="login.php" method="POST">
    <p>
        <input type="text" name="login" value="<?php echo @$data['login']; ?>" placeholder="Введите Ваш логин">
    </p>

    <p>
        <input type="password" name="password" value="<?php echo @$data['password']; ?>" placeholder="Введите Ваш пароль">
    </p>
    <p>
        <button type="submit" name="do_login">Далее</button>
    </p>
</form>