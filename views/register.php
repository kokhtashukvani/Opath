<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="rtl">
    <h2>ثبت نام کاربر جدید</h2>
    <p>برای استفاده از سیستم، لطفاً فرم زیر را تکمیل کنید.</p>

    <form action="index.php?action=register" method="post">
        <div class="form-group">
            <label for="full_name">نام کامل:</label>
            <input type="text" name="full_name" id="full_name" required>
        </div>
        <div class="form-group">
            <label for="username">نام کاربری (انگلیسی):</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">تکرار رمز عبور:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">ثبت نام</button>
        </div>
    </form>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
