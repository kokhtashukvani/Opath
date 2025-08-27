<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="rtl">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>مدیریت تأمین‌کنندگان</h2>
        <a href="index.php?page=supplier_create" class="btn">افزودن تأمین‌کننده جدید</a>
    </div>

    <hr>

    <?php if (empty($data['suppliers'])): ?>
        <p>هیچ تأمین‌کننده‌ای یافت نشد.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: right;">نام</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: right;">فرد مسئول</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: right;">ایمیل</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: right;">تلفن</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: center;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['suppliers'] as $supplier): ?>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($supplier->name); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($supplier->contact_person); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($supplier->email); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($supplier->phone); ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                            <a href="index.php?page=supplier_edit&id=<?php echo $supplier->id; ?>" style="margin-right: 10px;">ویرایش</a>
                            <a href="index.php?action=supplier_destroy&id=<?php echo $supplier->id; ?>" onclick="return confirm('آیا از حذف این تأمین‌کننده اطمینان دارید؟');" style="color: red;">حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
