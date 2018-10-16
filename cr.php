<?php require 'setup.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Корзины цветов</title>
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
      $category = 'cr';

      $stmt = $db->prepare("SELECT * FROM products WHERE category = :category");
      $stmt->bindValue(':category', $category, PDO::PARAM_STR);
      $stmt->execute();
      while ($row = $stmt->fetch()): ?>

      <h4><?= $row['name'] ?></h4>
      <p>
        <img class="picture" src="image/<?= $row['image'] ?>" alt="<?= $row['name'] ?>" style="width: 90%">
        <?php if ($row['count'] > 0): ?>
          В наличии <?= $row['count'] ?> шт.<br>
          Цена: <?= $row['price'] ?> руб.
        <?php else: ?>
          Нет в наличии<br>
        <?php endif; ?>
      </p>
      <p>
        <a href="details.php?id=<?= $row['id'] ?>">Подробнее</a> </p>
        <?php if ($user['is_owner']): ?>
        <br><br>
        <?php endif; ?>
      <div class="separator"></div>
      <?php endwhile; ?>

    </div>
    <div id="news">
      <?php require 'news.php'; ?>
    </div>
  </div>
  <div id="footer">
  <p>Телефон горячей линии 8-800-800-80-80</p>
  <p>Сайт изготовлен администратором сайта 2017. По вопросам работы сайта обращайтесь по e-mail: <a href="#">flowers@compic.ru</a></p>  </div>
  </div>
</body>
</html>
