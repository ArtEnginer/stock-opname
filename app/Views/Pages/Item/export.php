<?php $this->extend('Views/Layout/index.php') ?>
<?php $this->section('main') ?>
<div class="container mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Export Data Barang</h4>
        </div>
        <div class="card-body">
            <p>Export data to Excel <a href="<?= base_url() . 'item/download' ?>">here</a>.</p>
        </div>
    </div>
</div>
<?php $this->endSection() ?>