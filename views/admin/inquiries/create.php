<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                ایجاد استعلام برای درخواست خرید
            </h2>
        </div>
    </div>
</div>

<div class="row row-cards">
    <!-- Purchase Request Details -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">مشخصات درخواست</h3>
            </div>
            <div class="card-body">
                <p><strong>کالا:</strong> <?php echo htmlspecialchars($data['request']->product_name); ?></p>
                <p><strong>برند:</strong> <?php echo htmlspecialchars($data['request']->brand); ?></p>
                <p><strong>تعداد:</strong> <?php echo htmlspecialchars($data['request']->quantity); ?></p>
                <p><strong>توضیحات:</strong> <?php echo nl2br(htmlspecialchars($data['request']->product_description)); ?></p>
            </div>
        </div>
    </div>

    <!-- Supplier Selection Form -->
    <div class="col-12">
        <form class="card" action="index.php?action=send_inquiry" method="post">
            <input type="hidden" name="request_id" value="<?php echo $data['request']->id; ?>">
            <div class="card-header">
                <h3 class="card-title">انتخاب تأمین‌کنندگان</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">مهلت پاسخگویی</label>
                    <input type="date" name="deadline" class="form-control" required>
                </div>
                <div class="form-label">تأمین‌کنندگان موجود</div>
                <div class="custom-controls-stacked">
                    <?php foreach($data['suppliers'] as $supplier): ?>
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input" name="suppliers[]" value="<?php echo $supplier->id; ?>">
                            <span class="form-check-label"><?php echo htmlspecialchars($supplier->name); ?> (<?php echo htmlspecialchars($supplier->city); ?>)</span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">ارسال استعلام به تأمین‌کنندگان منتخب</button>
            </div>
        </form>
    </div>
</div>


<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
