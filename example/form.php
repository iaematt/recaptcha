<?php

require __DIR__ . '/../vendor/autoload.php';

/** Change to your keys */
$secret_key = '';
$public_key = '';

$captcha = new \iaematt\ReCaptcha($secret_key, $public_key);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <?= $captcha->importScript() ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reCaptcha</title>

    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div id="root">
        <h1 class="title">ReCaptcha</h1>
        <form action="check.php" id="demo-form" method="POST" class="form">
            <input type="text" name="name" placeholder="Type your name" required class="input" />
            <?= $captcha->importCaptcha() ?>
            <button type="submit" class="button">Enviar</button>
        </form>
    </div>
</body>
</html>