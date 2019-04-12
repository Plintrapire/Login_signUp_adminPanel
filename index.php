<?php 
require "db.php";
?>

<?php if(isset($_SESSION['logged_user'])) : ?>
<p style="color: green">logged <?php echo $_SESSION['logged_user']->login?></p>
<a href="/logout.php">logout</a>
<?php else : ?>
Вы не авторизованы<br>
<a href="/login.php">Войти</a><br>
<a href="/signup.php">Регистрация</a><br>
<a href="/admin.php">Админка</a>
<?php endif; ?>