<?php
require 'setup.php';

if (isset($_POST['id'])) {
  //$stmt = $db->prepare("DELETE FROM 'products' WHERE id = id");
  //$stmt->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
  //$stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

  /*if ($stmt->execute()) {
    echo 'Товар удален из базы данных';
  } else {
    echo 'Ошибка при удалении'.$stmt->error_log;
  }*/

  /*$last_error = $stmt->error_get_last;
   if($last_error['type'] === E_ERROR) {
      echo 'Ошибка при удалении';
   }*/

   $conn = new mysqli("localhost", "Student", "2017", "shop");
   $sql = "DELETE FROM products WHERE id = id";
   if ($conn->query($sql) === TRUE) {
     echo "Товар удален из базы данных.";
   } else {
       echo "Error: ".$conn->error;
   }
}
?>
