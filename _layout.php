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
      <a href="/" class="brand-logo"><img src="/img/php.png"/></a>
      <ul id="nav-mobile" class="right">
        <li><?php include "signup.php" ; ?></li>
          <?php foreach( [
              'basics'  => 'Основи',
              'layout'  => 'Шаблонізація',
              'api'     => 'API',
              'reg'     => 'Реєстрація'
              ] as $href => $name ) : ?>
            <li <?= $uri==$href ? 'class="active"' : '' ?> ><a href="/<?=$href?>"><?=$name?></a></li>
          <?php endforeach; ?>
      </ul>
    </div>
</nav>
    <?php include "_header.php"; ?>
    <div class="container">
        <?php include $page_body ; ?>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/js/site.js"></script>
</body>
</html>