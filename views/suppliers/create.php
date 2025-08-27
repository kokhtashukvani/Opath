<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="rtl">
    <h2>افزودن تأمین‌کننده جدید</h2>
    <p>اطلاعات تأمین‌کننده جدید را وارد کنید.</p>

    <form action="index.php?action=supplier_store" method="post">
        <div class="form-group">
            <label for="name">نام تأمین‌کننده:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="contact_person">فرد مسئول:</label>
            <input type="text" name="contact_person" id="contact_person">
        </div>
        <div class="form-group">
            <label for="email">ایمیل:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="phone">تلفن:</label>
            <input type="text" name="phone" id="phone">
        </div>
        <div class="form-group">
            <label for="address">آدرس:</label>
            <textarea name="address" id="address" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="city">شهر:</label>
            <input type="text" name="city" id="city">
        </div>
        <div class="form-group">
            <label for="province">استان:</label>
            <input type="text" name="province" id="province">
        </div>
        <div class="form-group">
            <label for="specialization">حوزه فعالیت:</label>
            <input type="text" name="specialization" id="specialization" placeholder="مثال: قطعات کامپیوتر، لوازم اداری">
        </div>
         <div class="form-group">
            <label for="password">رمز عبور (برای داشبورد تأمین‌کننده):</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">ذخیره تأمین‌کننده</button>
        </div>
    </form>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
