<?php
require "db.php";
$data = $_POST;
if (isset($data['do_signup'])) {
    if (trim($data['login']) == '') {
        $errors[] = 'Введите логин';
    }
    if ($data['password'] == '') {
        $errors[] = 'Введите пароль';
    }
    if(R::count('users', "login = ?",array($data['login'])) > 0)
    {
        $errors[] = "Логин уже существует";
    }
}
?>
<a href="index.php">Назад</a>
<form action="signup.php" method="POST">
    <p>
        <input type="text" name="login" value="<?php echo @$data['login']; ?>" placeholder="Придумайте логин">
    </p>
    <p>
        <input type="password" name="password"  placeholder="Придумайте пароль">
    </p>
    <p>
        <input type="password" name="password2" placeholder="Еще раз">
    </p>
    <?php 
    $vvedennoe_chislo = $_POST['password'];
    $chislo_kotoroe_hranitsa_na_saite = $_POST['password2'];
    if ($vvedennoe_chislo === $chislo_kotoroe_hranitsa_na_saite) {
        echo "Пароли совпадают";
        if (empty($errors)) {
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
            R::store($user);
            echo '<div style="color: green;">Удачно,<a href="login.php">login</a></div><hr>';} 
            else {
                echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
            }  
        }
    else{
        echo "Пароли не совпадают";
    }
    ?>
    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
</form>

