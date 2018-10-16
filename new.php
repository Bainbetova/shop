<?php
    if (isset($_POST['name'])) { $name = $_POST['name']; }
    if (isset($_POST['image'])) { $image = $_POST['image']; }
    if (isset($_POST['description'])) { $description = $_POST['description']; }
    if (isset($_POST['category'])) { $category = $_POST['category']; }
    if (isset($_POST['price'])) { $price = $_POST['price']; }
    if (isset($_POST['count'])) { $count = $_POST['count']; }
    if (isset($_POST['date'])) { $date = $_POST['date']; }
    if (isset($_POST['note'])) { $note = $_POST['note']; }

    if (isset($name) && isset($image) && isset($description) && isset($category) && isset($price) && isset($count) && isset($date) && isset($note)) {
        if (empty($name) || empty($image) || empty($description) || empty($category) || empty($price) || empty($count) || empty($date) || empty($note)) { 
            echo "<p style=\"color: red; font-size: 13pt;\">Заполните пустые поля!</p>"; 
            exit; 
        }
        if (strlen($name) > 128) { 
            echo "<p style=\"color: red; font-size: 13pt;\">Название товара не должно превышать 128 символов!</p>"; 
            exit; 
        }
        if (strlen($image) > 128) { 
            echo "<p style=\"color: red; font-size: 13pt;\">Название изображения товара не должно превышать 64 символов!</p>"; 
            exit; 
        }
        if (strlen($category) > 3) { 
                echo "<p style=\"color: red; font-size: 13pt;\">Введена неверная категория!</p>"; 
                exit;
        }
        if (strlen($price) > 11) { 
            echo "<p style=\"color: red; font-size: 13pt;\">Цена должна состоять не более чем из 11 цифр!</p>"; 
            exit; 
        }
        if (strlen($count) > 11) { 
            echo "<p style=\"color: red; font-size: 13pt;\">Количество должно состоять не более чем из 11 цифр!</p>"; 
            exit; 
        }
        /*$conn = new mysqli("localhost", "Student", "2017", "shop");
	
        $stmt = $db->prepare('INSERT INTO products(name, image, description, category, price, count, date, note) 
                                VALUES (:name, :image, :description, :category, :price, :count, :date, :note)');
        $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->bindValue(':image', $_POST['image'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
        $stmt->bindValue(':category', $_POST['category'], PDO::PARAM_STR);
        $stmt->bindValue(':count', $_POST['count'], PDO::PARAM_STR);
        $stmt->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
        $stmt->bindValue(':node', $_POST['node'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Товар успешно добавлен в базу данных.";
        } else {
            echo "Ошибка";
        }*/

        $conn = new mysqli("localhost", "Student", "2017", "shop");
        $sql = "INSERT INTO products (name, image, description, category, price, count, date, note) 
			VALUES ('$name', '$image', '$description', '$category', '$price', '$count', '$date', '$note')";
        if ($conn->query($sql) === TRUE) {
            echo "Товар успешно добавлен в базу данных.";
        } else {
            echo "Ошибка: ".$conn->error;
        }
    }
?>

<div id="newProduct">

    <h3>Добавление товара в базу данных</h3>

    <form id="newProduct_form">  

        <label for="pname">Название товара</label>
        <input type="text" id="pname" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" required>

        <label for="pimage">Название изображения товара</label>
        <input type="text" id="pimage" value="<?php if (isset($_POST['image'])) echo $_POST['image']; ?>" required>

        <label for="pdescription">Описание</label>
        <input type="text" id="pdescription" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>" required>

        <label for="pcategory">Категория</label>
        <input type="text" id="pcategory" value="<?php if (isset($_POST['category'])) echo $_POST['category']; ?>" required>

        <label for="pprice">Цена</label>
        <input type="text" id="pprice" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" required>

        <label for="pcount">Количество на складе</label>
        <input type="text" id="pcount" value="<?php if (isset($_POST['count'])) echo $_POST['count']; ?>" required>

        <label for="pdate">Дата сбора цветов</label>
        <input type="text" id="pdate" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>" required>

        <label for="pnote">Примечание</label>
        <input type="text" id="pnote" value="<?php if (isset($_POST['note'])) echo $_POST['note']; ?>" required>

        <div id="clear">
        <input type="reset" value="Очистить">
        </div>

        <div id="add">
        <input type="submit" value="Добавить товар">
        </div>

    </form>

</div>

       
<script>
    $('#newProduct_form').submit(function() {
        $.post('new.php',
            {
                name: $('#pname').val(),
                image: $('#pimage').val(),
                description: $('#pdescription').val(),
                category: $('#pcategory').val(),
                price: $('#pprice').val(),
                count: $('#pcount').val(), 
                date: $('#pdate').val(),
                note: $('#pnote').val() 
            },
            function(data) {
                $("#main").html(data);
            }
        );
        return false;
    });
</script>

