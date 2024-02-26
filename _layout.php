<?php
    session_start();
    $interval = "not";
    if(isset($_SESSION['user'])) {
      $interval = time() - $_SESSION['auth-moment'];
      if($interval>600) {
        unset($_SESSION['user']);
        unset($_SESSION['auth-moment']);
        $user = null;
      }
      else {
        $user = $_SESSION['user'];
        $_SESSION['auth-moment'] = time();
      }
    }
    else {
      $user = null;
    }
?>
<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PHP SPD-111</title>
    <link rel="stylesheet" href="/css/site.css"/>
</head>

<body>
<nav>
    <div class="nav-wrapper darken-1">
      <a href="/" class="brand-logo left"><img src="/img/php.png"/></a>
      <ul id="nav-mobile" class="right">
        <li><?php //include "signup.php" ; ?></li><!---->
          <?php foreach( [
              'basics'  => 'Основи',
              'layout'  => 'Шаблонізація',
              'api'     => 'API',
              'reg'     => 'Реєстрація'
              ] as $href => $name ) : ?>
            <li <?= $uri==$href ? 'class="active"' : '' ?> ><a href="/<?=$href?>"><?=$name?></a></li>
          <?php endforeach; ?>
          <?php
          if (!isset($_SESSION['user'])) {
            echo '<li><a class="waves-effect waves-light modal-trigger" href="#auth-modal"><i class="material-icons prefix">key</i></a></li>';
          } else {
            echo '<li><a id="output-button" class="waves-effect waves-light" href="#"><i class="material-icons prefix">close</i></a></li>';
          }
          ?>
      </ul>
    </div>
</nav>
<span><?= var_export('Name:'.' '.$user[2].' '.'E-mail:'.' '.$user[1], true) ?></span>
<br/>
<span>Auth in <?= var_export($interval, true) ?>sec</span>
    <?php include "_header.php"; ?>
    <div class="container">
        <?php include $page_body ; ?>
    </div>
    <div id="auth-modal" class="modal">
      <div class="col s12" method="post" asp-action="/">
        <div class="modal-content mymodel">
          <h4 class="mymodel">Введіть e-mail та пароль для входу</h4>
          <div class="input-field col s6">
              <i class="material-icons prefix">email</i>
              <input id="user-input-email" type="text" class="validate" name="auth-email">
              <label for="user-input-email">Email</label>
          </div>
          <div class="input-field col s6">
              <i class="material-icons prefix">lock</i>
              <input id="user-input-password" type="password" class="validate" name="auth-password">
              <label for="user-input-password">Password</label>
          </div>
        </div>
        <div class="modal-footer">
          <button class="modal-close btn-flat grey">Закрити</a>
          <button id="auth-button" class="btn-flat orange" style="margin-left:15px">Вхід</button>
        </div>
      </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/js/site.js"></script>
</body>
</html>