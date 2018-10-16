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
      <table border="1">
        <thead>
          <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Кол-во</th>
            <th>Сумма</th>
          </tr>
        </thead>
        <tbody>
        <?php
        // output user's shopping cart
        $stmt = $db->prepare('SELECT *, COUNT(product_id) as count FROM cart
                                INNER JOIN products ON product_id = products.id 
                                WHERE user_id = :user_id GROUP BY product_id');
        $stmt->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
        $stmt->execute();

        // holds the purchase amount
        $total = 0;
        while ($row = $stmt->fetch()): ?>
        <tr>
          <td><?= $row['name'] ?></td>
          <td><?= $row['price'] ?></td>
          <td><?= $row['count'] ?></td>
          <td><?= $row['price'] * $row['count'] ?></td>
        </tr>
        <?php $total += $row['price'] * $row['count']; ?>
        <?php endwhile; ?>
        </tbody>
      </table>
      <p>Итого: <?= $total ?> руб.</p>
      <?php if ($total > 0): ?>
      <p id="order">
        <button>Оформить заказ</button>
      </p>
      <p id="Cclear">
        <button>Очистить корзину</button>
      </p>
      <script>
        $('#order button').click(function() {
          $.post('order.php',
            {
              id: '<?= $row['product_id'] ?>'
            },
            function(data) {
              $('#order').html(data);
            }
          );
        });
      </script>
      <script>
        $('#Cclear button').click(function() {
          $.post('clear.php',
            {
              id: '<?= $row['user_id'] ?>'
            },
            function(data) {
              $('#Cclear').html(data);
            }
          );
        });
      </script>
      <?php endif;?>
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
