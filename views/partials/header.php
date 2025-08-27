<?php
// We will add session logic here later to show/hide links
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="logo">دستیار خرید</a>
    <div>
        <a href="index.php?page=home">خانه</a>
        <?php if (isLoggedIn()) : ?>
            <a href="index.php?page=dashboard">داشبورد</a>
            <?php if (isAdmin()) : ?>
                <a href="index.php?page=suppliers">مدیریت تأمین‌کنندگان</a>
            <?php endif; ?>
            <a href="index.php?action=logout">خروج</a>
        <?php else : ?>
            <a href="index.php?page=login">ورود</a>
            <a href="index.php?page=register">ثبت نام</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
