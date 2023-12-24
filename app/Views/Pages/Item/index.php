<?php $this->extend('Views/Layout/index.php') ?>
<?php $this->section('main') ?>
<div class="container mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Barang</h4>
            <div class="d-flex justify-content-end">
                <a href="<?= base_url() . 'item/create' ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
                <!-- import -->
                <a href="<?= base_url() . 'item/import' ?>" class="btn btn-success btn-sm"><i class="fas fa-file-import"></i> Import</a>
                <!-- export -->
                <a href="<?= base_url() . 'item/export' ?>" class="btn btn-warning btn-sm"><i class="fas fa-file-export"></i> Export</a>
            </div>
        </div>
        <div class="card-body">
            <table id="tableItem" class="display responsive" style="width:100%">
                <thead>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Harga Jual Grosir</th>
                    <th>Supplier</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endSection() ?>