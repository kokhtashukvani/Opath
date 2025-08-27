<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                ایجاد درخواست خرید جدید
            </h2>
        </div>
    </div>
</div>

<div class="row row-cards">
    <div class="col-12">
        <form class="card" action="index.php?action=purchase_request_store" method="post">
            <div class="card-header">
                <h4 class="card-title">لطفاً مشخصات کالای مورد نیاز خود را وارد کنید</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">نام کالا</label>
                            <input type="text" class="form-control" name="product_name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">برند (اختیاری)</label>
                            <input type="text" class="form-control" name="brand">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">تعداد</label>
                            <input type="number" class="form-control" name="quantity" required min="1">
                        </div>
                    </div>
                    <div class="col-12">
                         <div class="mb-3">
                            <label class="form-label">مشخصات فنی و توضیحات</label>
                            <textarea class="form-control" name="product_description" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">ثبت درخواست</button>
            </div>
        </form>
    </div>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
