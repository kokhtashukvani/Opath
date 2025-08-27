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
        <?php
            // Echo the dynamically generated form HTML
            echo $data['form_html'];
        ?>
    </div>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>
