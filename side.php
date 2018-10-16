<ul>
  <li><a href="/">Главная</a></li>
  <li><a href="bq.php">Букеты</a></li>
  <li><a href="cr.php">Корзины цветов</a></li>
</ul>

<?php if ($user): ?>
<div id="login">
  <h3 style="color:rgb(152, 193, 255); font-size: 14px;"><?= $user['name']; ?></h3>
  <h3>добро пожаловать в магазин цветов!</h3>
  <?php if ($user['is_owner']): ?>    
    <a href="javascript:void(0)" id="newprod">Добавить товар</a>
  <?php endif; ?>
</div>
  <ul>
    <li><a href="cart.php">Корзина</a></li>
    <li><a href="javascript:void(0)" id="logout">Выход</a></li>

  </ul>

<script>   
  $('#newprod').click(function() {
    $.ajax({
      type: "GET",
      url: "new.php",
      success: function(data) {
        $("#main").html(data);
      }
    });
  });
</script>
<script>
  $('#logout').click(function() {
    $.ajax({
      url: 'logout.php',
      success: function() {
        location.reload();
      }
    });      
  });
</script>

<?php else: ?>
<div id="login">
  <h3>Авторизация</h3>
  <form id="login_form">
    <input type="text" id="lmail" placeholder="E-mail" required>
    <input type="password" id="lpasswd" placeholder="Пароль" required>
    <input type="submit" value="Войти">
  </form>
  <a href="javascript:void(0)" id="open_signup">Регистрация</a>
  <script>
  $(document).ready(function() {
    $('#login_form').submit(function() {
      $.ajax({
        type: "POST",
        url: "authorization.php",
        data: {
        email: $('#lmail').val(),
        password: $('#lpasswd').val() },
        success: function(data) {
          $("#main").html(data);
        }
      });
      return false;
    });
  });
    $('#open_signup').click(function() {
      $.ajax({
        type: "GET",
				url: "registration.php",
				success: function(data){
					$("#main").html(data);
				}
      });
    });
  </script>
	    
</div>
<?php endif ?>
