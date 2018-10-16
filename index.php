<?php require 'setup.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Магазин цветов</title>
  <link rel="stylesheet" href="style.css">
  <script src="libs/jquery-3.2.1.min.js"></script>
  <meta name="Разработчик" content="Баинбетова В.В.">
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
      <h2>Добрый день!</h2>
      <p>
        <img class="picture" src="image/101.jpg" alt="101.jpg">
        На данном сайте Вы сможете заказать прекрасные букеты цветов!<br><br>
        Администратор
      </p>
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