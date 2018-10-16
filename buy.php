<?php
require 'setup.php';

if (isset($_POST['id'])) {
  // add a product to the user's shopping cart
  $stmt = $db->prepare('INSERT INTO cart (user_id, product_id)
                            VALUES (:user_id, :product_id)');
  $stmt->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_id', $_POST['id'], PDO::PARAM_INT);

  if ($stmt->execute()) {
    echo 'Товар успешно добавлен в корзину';
  } else {
    echo 'Ошибка при добавлении';
  }
}
?>