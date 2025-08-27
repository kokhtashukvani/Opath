<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                مدیریت تأمین‌کنندگان
            </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="index.php?page=supplier_create" class="btn btn-primary d-none d-sm-inline-block">
                    افزودن تأمین‌کننده جدید
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>نام</th>
                    <th>فرد مسئول</th>
                    <th>ایمیل</th>
                    <th>تلفن</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['suppliers'])): ?>
                    <tr>
                        <td colspan="5" class="text-center">هیچ تأمین‌کننده‌ای یافت نشد.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($data['suppliers'] as $supplier): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($supplier->name); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($supplier->contact_person); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($supplier->email); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($supplier->phone); ?></td>
                            <td>
                                <a href="index.php?page=supplier_edit&id=<?php echo $supplier->id; ?>">ویرایش</a>
                                <a href="index.php?action=supplier_destroy&id=<?php echo $supplier->id; ?>" class="ms-3 text-danger" onclick="return confirm('آیا از حذف این تأمین‌کننده اطمینان دارید؟');">حذف</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
