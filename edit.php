<?php require 'setup.php'; 
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
	
        $conn = new mysqli("localhost", "Student", "2017", "shop");
        //$res=$conn->query("SELECT * FROM products WHERE id = '$id'");
        // в UPDATE = '$id'
	    $sql = "UPDATE products SET name='$name', image='$image', description='$description', category='$category', price='$price', count='$count', date='$date', note='$note' WHERE id = id";
        if ($conn->query($sql) === TRUE) {
            echo "Изменеия применены.";
        } else {
            echo "Ошибка: ".$conn->error;
        }
    }
?>

<div id="editProduct">
      
    <h3>Добавление товара в базу данных</h3>

    <form id="editProduct_form">  

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
        <input type="submit" value="Сохранить изменения">
        </div>

    </form>
      
</div>

<script>
    $('#editProduct_form').submit(function() {
        $.post('edit.php',
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

