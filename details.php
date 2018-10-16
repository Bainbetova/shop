<?php require 'setup.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Магазин цветов</title>
  <link rel="stylesheet" href="style.css">
  <script src="libs/jquery-3.2.1.min.js"></script>
  <meta name="Разработчик" content="Баинбетова В. В.">
</head>
<body>
  <div id="title">
    <h1>Магазин цветов</h1>
  </div>
  <div id="content">
    <div id="sections">
      <?php require 'side.php'; ?>
    </div>
    <div id="main">
      <?php
      $stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
      $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
      $stmt->execute();

      $product = $stmt->fetch();

      if ($product): ?>
        <h4><?= $product['name'] ?></h4>
        <p>
          <img class="picture" style="width: 90%;" src="image/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
          <?= $product['description']; ?>
        </p>
        <p>
        <?php if ($product['count'] > 0): ?>
          В наличии <?= $product['count'] ?> шт.<br>
          Цена: <?= $product['price'] ?> руб.
        </p>
          <?php if ($user): ?>
            <p id="buy">
              <button>Купить</button>
            </p>
            <br>
            <p id = "edit">                
              <button>Изменить</button>
            </p>
            <br>
            <p id="delete"> 
              <button>Удалить</button> 
            </p>
            <script>
              $('#buy button').click(function() {
                $.post('buy.php',
                  {
                    id: '<?= $product['id'] ?>'
                  },
                  function(data) {
                    $('#buy').html(data);
                  }
                );
              });
            </script>
            <script>   
              $('#edit button').click(function() {
                  $.post('edit.php',
                    {
                      id: '<?= $product['id'] ?>'
                    },
                    function(data) {
                      $('#edit').html(data);
                    }
                  );
              });
            </script>
            <script>
                $('#delete button').click(function() {
                  $.post('delete.php',
                    {
                      id: '<?= $product['id'] ?>'
                    },
                    function(data) {
                      $('#delete').html(data);
                    }
                  );
              });
            </script>
          <?php endif; ?>
        <?php else: ?>
          Нет в наличии<br>
        </p>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div id="news">
      <?php require 'news.php'; ?>
    </div>
  </div>
  <div id="footer">
  <p>Телефон горячей линии 8-800-800-80-80</p>
  <p>Сайт изготовлен администратором сайта 2017. По вопросам работы сайта обращайтесь по e-mail: <a href="#">flowers@compic.ru</a></p>
  </div>
</body>
</html>
