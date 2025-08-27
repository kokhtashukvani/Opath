<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                تمام درخواست‌های خرید
            </h2>
            <div class="text-muted mt-1">نمایش تمام درخواست‌های ثبت شده توسط کاربران</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>کالا</th>
                    <th>درخواست دهنده</th>
                    <th>تعداد</th>
                    <th>وضعیت</th>
                    <th>تاریخ ثبت</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['requests'])): ?>
                    <tr>
                        <td colspan="6" class="text-center">هیچ درخواستی یافت نشد.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($data['requests'] as $request): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($request->product_name); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($request->user_name); ?></td>
                            <td><?php echo htmlspecialchars($request->quantity); ?></td>
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($request->status); ?></span></td>
                            <td><?php echo date('Y-m-d', strtotime($request->created_at)); ?></td>
                            <td>
                                <a href="index.php?page=inquiry_create&request_id=<?php echo $request->id; ?>">مشاهده و ایجاد استعلام</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
