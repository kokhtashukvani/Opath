<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="rtl">
    <h2>ویرایش اطلاعات تأمین‌کننده</h2>
    <p>اطلاعات تأمین‌کننده را ویرایش کنید.</p>

    <form action="index.php?action=supplier_update" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['supplier']->id); ?>">

        <div class="form-group">
            <label for="name">نام تأمین‌کننده:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($data['supplier']->name); ?>" required>
        </div>
        <div class="form-group">
            <label for="contact_person">فرد مسئول:</label>
            <input type="text" name="contact_person" id="contact_person" value="<?php echo htmlspecialchars($data['supplier']->contact_person); ?>">
        </div>
        <div class="form-group">
            <label for="email">ایمیل:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['supplier']->email); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">تلفن:</label>
            <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($data['supplier']->phone); ?>">
        </div>
        <div class="form-group">
            <label for="address">آدرس:</label>
            <textarea name="address" id="address" rows="3"><?php echo htmlspecialchars($data['supplier']->address); ?></textarea>
        </div>
        <div class="form-group">
            <label for="city">شهر:</label>
            <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($data['supplier']->city); ?>">
        </div>
        <div class="form-group">
            <label for="province">استان:</label>
            <input type="text" name="province" id="province" value="<?php echo htmlspecialchars($data['supplier']->province); ?>">
        </div>
        <div class="form-group">
            <label for="specialization">حوزه فعالیت:</label>
            <input type="text" name="specialization" id="specialization" value="<?php echo htmlspecialchars($data['supplier']->specialization); ?>">
        </div>
        <p>برای تغییر رمز عبور، فیلد زیر را پر کنید. در غیر این صورت، آن را خالی بگذارید.</p>
        <div class="form-group">
            <label for="password">رمز عبور جدید:</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn">به‌روزرسانی تأمین‌کننده</button>
        </div>
    </form>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
