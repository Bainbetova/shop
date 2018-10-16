<?php
  require 'connect.php';
  if (isset($_POST['email'])) { $email = $_POST['email']; }
  if (isset($_POST['password'])) { $password = $_POST['password']; }
?>

<?php
  if (isset($email) && isset($password)) {
    $conn = new mysqli("localhost", "Student", "2017", "shop");
    if ($res = $conn->query("SELECT * FROM users WHERE mail='$email'")) {
      if ($res->num_rows > 0) {
        if (password_verify($_POST['passwd'], $user['passwd'])) {
          //$stmt = $db->prepare('SELECT * FROM users WHERE mail = :mail');
          //$stmt->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
          //$stmt->bindValue($email, $_POST['mail'], PDO::PARAM_STR);
          //$stmt->execute();
          $user = $res->fetch();

          $row = $res->fetch_assoc();
          session_start();
          $_SESSION['user_id'] = $user['id'];
          echo "<p style=\"color: #293499; font-size: 14pt;\">Имя пользователя: {$row['name']}<br>Адрес электронной почты: {$row['mail']}<br>Логин: {$row['login']}<br>Пароль: {$row['passwd']}</p>";
        } else {
          echo "Указан неверный пароль, попробуйте заново";
        }
      } else {
        echo "<p style=\"color: red; font-size: 14pt;\">Такого пользователя нет в системе! Пройдите регистрацию!</p>";
      }
    }
  } else {
    echo "Ошибка подключения к MySQL";
  }
?>
