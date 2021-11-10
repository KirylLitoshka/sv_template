<?php require_once "src/php/template/ti.php" ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        КЖУП "Светочь"
        <?php emptyblock('title') ?>
    </title>

    <link rel="shortcut icon" href="src/img/icon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="src/img/icon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="src/img/icon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="src/img/icon/apple-touch-icon-114x114.png">

    <link rel="stylesheet" href="src/css/reset.css">
    <link rel="stylesheet" href="src/css/fonts.css">
    <link rel="stylesheet" href="src/css/main.css">
</head>

<body>

    <?php include "includes/header.php"; ?>
    <?php include "includes/menu_top.php"; ?>


    <div class="container">
        <div class="content_wrapper">
            <main class="main">
                <?php emptyblock('content') ?>
            </main>

            <?php emptyblock("sidebar") ?>
        </div>
    </div>

    <?php include "includes/footer_top.php"; ?>
    <?php include "includes/footer.php"; ?>

    <script src="src/js/jquery.js"></script>
	<script src="src/js/uhpv.js"></script>
	<script src="src/js/g_translate.js"></script>
	<script src="src/js/common.js"></script>
	<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</body>

</html>