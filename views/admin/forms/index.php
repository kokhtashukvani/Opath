<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Form Builder
            </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="index.php?page=forms_create" class="btn btn-primary d-none d-sm-inline-block">
                    Create New Form
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Defined Forms</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>Form Name</th>
                    <th>Description</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['forms'])): ?>
                    <tr>
                        <td colspan="3" class="text-center">No forms have been defined yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($data['forms'] as $form): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($form->name); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($form->description); ?></td>
                            <td>
                                <a href="index.php?page=forms_show&id=<?php echo $form->id; ?>">View Fields</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
