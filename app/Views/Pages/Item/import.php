<?php $this->extend('Views/Layout/index.php') ?>
<?php $this->section('main') ?>
<div class="container mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Import Data Barang</h4>
        </div>
        <div class="card-body">
            <!-- form import -->
            <form action="<?= base_url('api/v1/item/import') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">Choose CSV file:</label>
                    <input type="file" class="form-control-file" id="file" name="file" accept=".xlsx" required>
                    <small class="form-text text-muted">Please upload a Excel file.</small>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>

        </div>
    </div>
</div>
<?php $this->endSection() ?>