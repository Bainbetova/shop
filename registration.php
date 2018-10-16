<?php
if (isset($_POST['name'])) { $name = $_POST['name']; }
if (isset($_POST['mail'])) { $mail = $_POST['mail']; }
if (isset($_POST['login'])) { $login = $_POST['login']; }
if (isset($_POST['passwd'])) { $passwd = $_POST['passwd']; }
if (isset($_POST['repasswd'])) { $rePasswd = $_POST['repasswd']; }

if (isset($name) && isset($mail) && isset($login) && isset($passwd) && isset($repasswd)) {
	if (empty($name) || empty($mail) || empty($login) || empty($passwd) || empty($repasswd)) { echo "<p style=\"color: red; font-size: 13pt;\">Заполните пустые поля!</p>"; exit; }
	if (strlen($name) > 30) { echo "<p style=\"color: red; font-size: 13pt;\">Имя пользователя не должно превышать 30 символов!</p>"; exit; }
	if (strlen($mail) > 30) { echo "<p style=\"color: red; font-size: 13pt;\">Адрес эл. почты не должен превышать 30 символов!</p>"; exit; }
	if (strlen($login) >30) { echo "<p style=\"color: red; font-size: 13pt;\">Логин не должен превышать 30 символов!</p>"; exit; }
	if (strlen($passwd) > 30 || strlen($repasswd) > 30) { echo "<p style=\"color:red; font-size:13pt;\">Пароль не должен первышать 30 символов!</p>"; exit; }
	if (!strcmp($passwd, $repasswd) == 0) { echo "<p style=\"color: red; font-size: 13pt;\">Неверное подтверждение пароля!</p>"; exit; }
	if (!preg_match("/^[a-zA-Z0-9]+@mail.ru$/", $mail)) { echo "<p style=\"color: red; font-size: 13pt;\">Адрес эл. почты должен иметь формат имя_почтового_ящика@mail.ru</p>"; exit; }
	$conn = new mysqli("localhost", "Student", "2017", "shop");
	$i; $salt=""; for ($i = 1; $i <= 2; $i++) { $rnd = (int)(rand(75) + 48); if (($rnd > 57) && ($rnd < 65)) { $rnd = 65; } elseif (($rnd > 90) && ($rnd < 97)) { $rnd = 97; } $salt .= chr($rnd); } $cryptPasswd = crypt($passwd, $salt);
	$stmt = $db->prepare('INSERT INTO users (name, mail, login, passwd)
                              VALUES (:name, :mail, :login, :passwd)');
    $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
    $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
    $stmt->bindValue(':passwd', $passwd_hash, PDO::PARAM_STR);

    if ($stmt->execute()) {
      echo '<h2>Регистрация прошла успешно!</h2>';
      echo '<p>';
      echo 'Имя пользователя: ' . $_POST['name'] . '<br>';
      echo 'Почтовый ящик: ' . $_POST['mail'];
      echo '</p>';
      echo '<p><a href="/">Вернуться на главную</a></p>';

    } else {
      echo '<h2>Ошибка при регистрации!</h2>';
    }
    /*if ($conn->query("INSERT INTO users (name, mail, login, passwd) VALUES ('$name', '$mail', '$login', '$cryptPasswd')")) {
      echo "<p style=\"color: #293499; font-size: 13pt;\">Регистрация прошла успешно!<br>Имя пользователя: $name<br>Почтовый ящик: $mail<br><a href=\"index.html\">Вернуться на сайт</a></p>";
    } else {
      echo "<p style=\"color: red; font-size: 13pt;\">Пользователь с таким логином или почтовым адресом уже зарегистрирован!</p>";
    }*/
    
    exit;
}
?>

<div id="signup">
  <h3>Регистрация</h3>

  <form id="signup_form">

    <label for="sname">Имя пользователя</label>
    <input type="text" id="sname" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" required>

    <label for="smail">Адрес электронной почты</label>
    <input type="text" id="smail" value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>" required>

    <label for="slogin">Логин</label>
    <input type="text" id="slogin" value="<?php if (isset($_POST['login'])) echo $_POST['login']; ?>" required>

    <label for="spasswd">Пароль</label>
    <input type="password" id="spasswd" required>

    <label for="srepasswd">Подтверждение пароля</label>
    <input type="password" id="srepasswd" required>

    <div id="clear">
      <input type="reset" value="Очистить">
    </div>

    <div id="send">
      <input type="submit" value="Отправить">
    </div>

    <div class="clear"></div>
  </form>
</div>

<script>

  $('#signup_form').submit(function() {
    $.post('signup.php',
      {
        name: $('#sname').val(),
        mail: $('#smail').val(),
        login: $('#slogin').val(),
        passwd: $('#spasswd').val(),
        repasswd: $('#srepasswd').val()
      },
      function(data) {
        $('#main').html(data);
      }
    );
    return false;
  });
</script>

