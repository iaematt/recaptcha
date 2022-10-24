<?php

require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location: form.php');
}

/** Change to your keys */
$secret_key = '';
$public_key = '';

$post = $_POST;
$captcha_code = $post['g-recaptcha-response'];

$captcha = new \iaematt\ReCaptcha($secret_key, $public_key);

$check = $captcha->check($captcha_code);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reCaptcha</title>

    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <?php if ($check): ?>
    <div class="notification success">
        Ok! captcha is valid, <a href="form.php">try again</a>
    </div>
    <?php else: ?>
    <div class="notification error">
        Invalid! please resolve captcha, <a href="form.php">try again</a>
    </div>
    <?php endif; ?>
</body>
</html>