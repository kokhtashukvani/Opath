<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Create New Form Definition
            </h2>
        </div>
    </div>
</div>

<div class="row row-cards">
    <div class="col-12">
        <form class="card" action="index.php?action=form_store" method="post">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Form Name</label>
                    <input type="text" class="form-control" name="name" placeholder="e.g., Supplier Registration Form" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="A brief description of this form's purpose."></textarea>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Save Form Definition</button>
            </div>
        </form>
    </div>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
