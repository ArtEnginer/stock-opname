<?php $this->extend('Views/Layout/index.php') ?>
<?php $this->section('main') ?>
<div class="container mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Import Data Barang</h4>
        </div>
        <div class="card-body">
            <p>Download the Excel template <a href="<?= base_url('DATA BARANG.xlsx') ?>">here</a>.</p>

            <form id="importForm" action="<?= base_url('api/v1/item/import') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">Choose CSV file:</label>
                    <input type="file" class="form-control-file" id="file" name="file" accept=".xlsx" required>
                    <small class="form-text text-muted">Please upload an Excel file.</small>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("importForm").addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            var base_url = '<?= base_url() ?>';

            fetch(base_url + 'api/v1/item/import', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Network response was not ok.');
                    }
                })
                .then(data => {
                    if (data.status === 200) {
                        alert(data.message);
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Network error occurred. Please try again.');
                });
        });
    });
</script>
<?php $this->endSection() ?>