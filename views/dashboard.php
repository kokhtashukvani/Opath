<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                داشبورد
            </h2>
            <div class="text-muted mt-1">خوش آمدید، <?php echo htmlspecialchars($_SESSION['user_full_name']); ?>!</div>
        </div>
    </div>
</div>

<div class="row row-cards">
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            <?php echo count($data['purchase_requests']); ?> درخواست خرید
                        </div>
                        <div class="text-muted">
                            مجموع درخواست‌های شما
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">درخواست‌های خرید من</h3>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>کالا</th>
                    <th>برند</th>
                    <th>تعداد</th>
                    <th>وضعیت</th>
                    <th>تاریخ ثبت</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($data['purchase_requests'])): ?>
                <tr>
                    <td colspan="5" class="text-center">شما هیچ درخواست خریدی ثبت نکرده‌اید.</td>
                </tr>
            <?php else: ?>
                <?php foreach($data['purchase_requests'] as $request): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($request['product_name'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($request['brand'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($request['quantity'] ?? 'N/A'); ?></td>
                        <td><span class="badge bg-secondary">Pending</span></td>
                        <td><?php echo date('Y-m-d', strtotime($request['submitted_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
