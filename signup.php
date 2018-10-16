<?php
  if (isset($_POST['name'])) { $name = $_POST['name']; if ($name == '') { unset($name);} } 
  if (isset($_POST['login'])) { $login = $_POST['login']; if ($login =='') { unset($login);} }
  if (isset($_POST['mail'])) { $mail = $_POST['mail']; if ($mail =='') { unset($mail);} }
  if (isset($_POST['passwd'])) { $passwd = $_POST['passwd']; if ($passwd =='') { unset($passwd);} }
  if (isset($_POST['repasswd'])) { $repasswd = $_POST['repasswd']; if ($repasswd =='') { unset($repasswd);} }

    // соединение с БД
    $conn = new mysqli("localhost", "Student", "2017", "shop");
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    if ($conn->query("SELECT id FORM users WHERE login='$login'")) {
        echo "<p style=\"color: red;\">Такой логин уже существует</p>";
    }
    if ($conn->query("SELECT id FORM users WHERE mail='$mail'")) {
        echo "<p style=\"color: red;\">Такой адрес электронной почты уже существует</p>";
    }
    if ($conn->query("INSERT INTO users (name, mail, login, passwd) VALUES ('$name', '$mail', '$login', '$passwd')")) {
        echo "<p>Регистрация прошла успешно!<br>Имя пользователя: $name<br>Почтовый ящик: $mail<br><a href=\"/\">Вернуться на главную</a></p>";
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

