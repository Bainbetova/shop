<?php
    //$stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
    //$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    //$stmt->execute();

    //$product = $stmt->fetch();
    //$conn = new mysqli("localhost", "Student", "2017", "shop");
    //$res = $conn->query("UPDATE 'products' SET 'count'='count - 1' WHERE id = :id");
    //$product=$res->fetch_assoc();	
    //$stmt = $db->prepare("UPDATE 'products' SET 'count'='count - 1' WHERE id = :id");
    //$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    //$stmt->execute();

    //$product = $stmt->fetch();
    
    //unset($_SESSION['user_id']);

    //$row->clear();
    /*$stmt = $db->prepare('SELECT *, COUNT(product_id) as count FROM cart
                            INNER JOIN products ON product_id = products.id 
                            WHERE user_id = :user_id GROUP BY product_id');
    if ($stmt !== TRUE) echo "Error: ".$stmt->error;
    $stmt->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
    $stmt->execute();

    
    while ($row = $stmt->fetch()): */
    /*    $row['name'] = 0;
        $row['price'] = 0;
        $row['count'] = 0;
        $total = 0; */
    /*endwhile; */

    $conn = new mysqli("localhost", "Student", "2017", "shop");
    $sql = "DELETE FROM cart WHERE id = id";
    if ($conn->query($sql) === TRUE) {
    	echo "Корзина пуста. Пожалуйста обновите страницу.";
    } else {
        echo "Error: ".$conn->error;
    }
?>
