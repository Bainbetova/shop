<?php
// output product list
$stmt = $db->prepare('SELECT * FROM products WHERE category = :category');
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->execute();
while ($row = $stmt->fetch()): ?>

<h4><?= $row['name'] ?></h4>
<p>
  <img class="picture" src="/image/products/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
  <?php if ($row['count'] > 0): ?>
    В наличии <?= $row['count'] ?> шт.<br>
    Цена: <?= $row['price'] ?> руб.
  <?php else: ?>
    Нет в наличии<br>
  <?php endif; ?>
</p>
<p>
  <a href="details.php?id=<?= $row['id'] ?>">Подробнее</a>
  <?php if ($user['is_owner']): ?>
  <br><br>
  
  <?php endif; ?>
</p>

<div class="separator"></div>
<?php endwhile; ?>
