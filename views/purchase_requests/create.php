<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="rtl">
    <h2>ایجاد درخواست خرید جدید</h2>
    <p>لطفاً مشخصات کالای مورد نیاز خود را وارد کنید.</p>

    <form action="index.php?action=purchase_request_store" method="post">
        <div class="form-group">
            <label for="product_name">نام کالا:</label>
            <input type="text" name="product_name" id="product_name" required>
        </div>
        <div class="form-group">
            <label for="brand">برند (اختیاری):</label>
            <input type="text" name="brand" id="brand">
        </div>
        <div class="form-group">
            <label for="quantity">تعداد:</label>
            <input type="number" name="quantity" id="quantity" required min="1">
        </div>
        <div class="form-group">
            <label for="product_description">مشخصات فنی و توضیحات:</label>
            <textarea name="product_description" id="product_description" rows="5"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">ثبت درخواست</button>
        </div>
    </form>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
