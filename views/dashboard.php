<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="rtl">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>داشبورد کاربری</h2>
        <a href="index.php?page=purchase_request_create" class="btn">ایجاد درخواست خرید جدید</a>
    </div>
    <p>خوش آمدید، <?php echo $_SESSION['user_full_name']; ?>!</p>

    <hr>

    <h3>درخواست‌های خرید من</h3>
    <?php if (empty($data['purchase_requests'])): ?>
        <p>شما هیچ درخواست خریدی ثبت نکرده‌اید.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: right;">کالا</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: right;">برند</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: center;">تعداد</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: center;">وضعیت</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: right;">تاریخ ثبت</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['purchase_requests'] as $request): ?>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($request->product_name); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($request->brand); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><?php echo htmlspecialchars($request->quantity); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><?php echo htmlspecialchars($request->status); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo date('Y-m-d', strtotime($request->created_at)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
