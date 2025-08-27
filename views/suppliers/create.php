<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                افزودن تأمین‌کننده جدید
            </h2>
        </div>
    </div>
</div>

<div class="row row-cards">
    <div class="col-12">
        <form class="card" action="index.php?action=supplier_store" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">نام تأمین‌کننده</label>
                            <input type="text" class="form-control" name="name" placeholder="نام شرکت یا فروشگاه" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">فرد مسئول</label>
                            <input type="text" class="form-control" name="contact_person" placeholder="نام فرد مسئول">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">ایمیل</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">تلفن</label>
                            <input type="text" class="form-control" name="phone" placeholder="شماره تماس">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">آدرس</label>
                            <textarea class="form-control" name="address" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">شهر</label>
                            <input type="text" class="form-control" name="city">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">استان</label>
                            <input type="text" class="form-control" name="province">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">حوزه فعالیت</label>
                            <input type="text" class="form-control" name="specialization" placeholder="مثال: قطعات کامپیوتر، لوازم اداری">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">رمز عبور (برای داشبورد تأمین‌کننده)</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">ذخیره تأمین‌کننده</button>
            </div>
        </form>
    </div>
</div>


<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
