<?php
// We don't want the full dashboard layout on the login page, so we just load the essential head and footers.
require_once APP_ROOT . '/views/partials/header_auth.php'; // A new header for auth pages
?>

<body class="d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <h1>دستیار خرید</h1>
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">ورود به حساب کاربری</h2>
                    <form action="index.php?action=login" method="post" autocomplete="off">
                        <div class="mb-3">
                            <label class="form-label">نام کاربری</label>
                            <input type="text" name="username" class="form-control" placeholder="نام کاربری خود را وارد کنید" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                رمز عبور
                            </label>
                            <input type="password" name="password" class="form-control" placeholder="رمز عبور شما" required>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">ورود</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-muted mt-3">
                حساب کاربری ندارید؟ <a href="index.php?page=register" tabindex="-1">ثبت نام کنید</a>
            </div>
        </div>
    </div>

<?php require_once APP_ROOT . '/views/partials/footer_auth.php'; // A new footer for auth pages ?>
