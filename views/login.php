<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="rtl">
    <h2>ورود به سیستم</h2>
    <p>برای دسترسی به داشبورد خود، لطفاً وارد شوید.</p>

    <form action="index.php?action=login" method="post">
        <div class="form-group">
            <label for="username">نام کاربری:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">ورود</button>
        </div>
    </form>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
