<?php
    $conn = new mysqli("localhost", "Student", "2017", "shop");
    $sql = "UPDATE products SET count = count - 1 WHERE id = id";
    if ($conn->query($sql) === TRUE) {
    	echo "Заказ успешно оформлен";
    } else {
	echo "Error: ".$conn->error;
    }

    //unset($_SESSION['cart']); // очистка корзины
?>
