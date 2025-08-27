<?php require_once APP_ROOT . '/views/partials/header_auth.php'; ?>

<body class="d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <h1>دستیار خرید</h1>
                </a>
            </div>
            <form class="card card-md" action="index.php?action=register" method="post" autocomplete="off">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">ایجاد حساب کاربری جدید</h2>
                    <div class="mb-3">
                        <label class="form-label">نام کامل</label>
                        <input type="text" name="full_name" class="form-control" placeholder="نام کامل خود را وارد کنید" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">نام کاربری (انگلیسی)</label>
                        <input type="text" name="username" class="form-control" placeholder="یک نام کاربری انتخاب کنید" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رمز عبور</label>
                        <input type="password" name="password" class="form-control" placeholder="رمز عبور" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">تکرار رمز عبور</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="تکرار رمز عبور" required>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">ایجاد حساب جدید</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                از قبل حساب کاربری دارید؟ <a href="index.php?page=login" tabindex="-1">وارد شوید</a>
            </div>
        </div>
    </div>

<?php require_once APP_ROOT . '/views/partials/footer_auth.php'; ?>
