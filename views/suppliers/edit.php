<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                ویرایش اطلاعات تأمین‌کننده: <?php echo htmlspecialchars($data['supplier']->name); ?>
            </h2>
        </div>
    </div>
</div>

<div class="row row-cards">
    <div class="col-12">
        <form class="card" action="index.php?action=supplier_update" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['supplier']->id); ?>">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">نام تأمین‌کننده</label>
                            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($data['supplier']->name); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">فرد مسئول</label>
                            <input type="text" class="form-control" name="contact_person" value="<?php echo htmlspecialchars($data['supplier']->contact_person); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">ایمیل</label>
                            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($data['supplier']->email); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">تلفن</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($data['supplier']->phone); ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">آدرس</label>
                            <textarea class="form-control" name="address" rows="3"><?php echo htmlspecialchars($data['supplier']->address); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">شهر</label>
                            <input type="text" class="form-control" name="city" value="<?php echo htmlspecialchars($data['supplier']->city); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">استان</label>
                            <input type="text" class="form-control" name="province" value="<?php echo htmlspecialchars($data['supplier']->province); ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">حوزه فعالیت</label>
                            <input type="text" class="form-control" name="specialization" value="<?php echo htmlspecialchars($data['supplier']->specialization); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="mb-3">
                            <label class="form-label">رمز عبور جدید (اختیاری)</label>
                            <input type="password" class="form-control" name="password" placeholder="برای عدم تغییر، خالی بگذارید">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">به‌روزرسانی تأمین‌کننده</button>
            </div>
        </form>
    </div>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
