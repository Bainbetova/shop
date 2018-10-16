<?php
	require 'connect.php';
	if (isset($_POST['email'])) { $email = $_POST['email']; }
	if (isset($_POST['password'])) { $password = $_POST['password']; }
?>

<?php
	if (isset($email) && isset($password)) {
		$conn = new mysqli("localhost", "Student", "2017", "shop");
		if ($res = $conn->query("SELECT * FROM users  WHERE mail='$email'")) {
			if ($res->num_rows > 0) {
				//$stmt=$db->prepare('SELECT * FROM users WHERE mail=:mail');
			 	//$stmt->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
				//$stmt->execute();
				//$user = $stmt->fetch();

				//$row = $res->fetch_assoc();
				$cart = $conn->query("SELECT * FROM cart WHERE id = :id");
				
				$user=$res->fetch_assoc();
				session_start();
				$_SESSION['user_id'] = $user['id'];

				//$cart = $conn->query("SELECT * FROM cart WHERE id = :id");
				$_SESSION['cart'] = $cart['id'];
				echo "<p style=\"color: #293499; font-size: 14pt;\">Имя пользователя: {$user['name']}<br>Адрес электронной почты: {$user['mail']}<br>Логин: {$user['login']}<br>Пароль: {$user['passwd']}</p>";
			} else {
				echo "<p style=\"color: red; font-size: 14pt;\">Такого пользователя нет в системе! Пройдите регистрацию!</p>";
			}
		}
	}
?>
