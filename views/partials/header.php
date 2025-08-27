<?php
// We will add session logic here later to show/hide links
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <!-- Tabler Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabler@1.0.0-alpha.8/dist/css/tabler.min.css">
</head>
<body class="theme-light">
    <div class="page">
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="index.php?page=dashboard">
                        دستیار خرید
                    </a>
                </h1>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=dashboard">
                                <span class="nav-link-title">داشبورد</span>
                            </a>
                        </li>
                        <?php if (isAdmin()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=admin_requests">
                                <span class="nav-link-title">تمام درخواست‌های خرید</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=suppliers">
                                <span class="nav-link-title">مدیریت تأمین‌کنندگان</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=forms">
                                <span class="nav-link-title">Form Builder</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=purchase_request_create">
                                <span class="nav-link-title">ایجاد درخواست خرید</span>
                            </a>
                        </li>
                         <li class="nav-item" style="margin-top: auto;">
                            <?php if (isLoggedIn()) : ?>
                                <a class="nav-link" href="index.php?action=logout">
                                    <span class="nav-link-title">خروج</span>
                                </a>
                            <?php else: ?>
                                <a class="nav-link" href="index.php?page=login">
                                    <span class="nav-link-title">ورود</span>
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
