<?php $this->extend('Views/Layout/index.php') ?>
<?php $this->section('main') ?>
<div class="container mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Barang</h4>
            <div class="d-flex justify-content-end">
                <!-- <a href="<?= base_url() . 'item/create' ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a> -->
                <!-- import -->
                <a href="<?= base_url() . 'item/import' ?>" class="btn btn-success btn-sm"><i class="fas fa-file-import"></i> Import</a>
                <!-- export -->
                <!-- <a href="<?= base_url() . 'item/export' ?>" class="btn btn-warning btn-sm"><i class="fas fa-file-export"></i> Export</a> -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
</div>

<script>
    $(document).ready(function() {
        const table = $("#tableItem").DataTable({
            responsive: true,
            ajax: {
                url: "api/item",
                dataSrc: "item",
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "kode"
                },
                {
                    data: "nama"
                },
                {
                    data: "satuan"
                },
                {
                    data: "harga_beli"
                },
                {
                    data: "harga_jual"
                },
                {
                    data: "harga_jual_grosir"
                },
                {
                    data: "supplier"
                },
                {
                    data: "stok"
                },
                {
                    data: "action",
                    render: function(data, type, row) {
                        return (
                            '<a href="item/' +
                            row.id +
                            '/edit" class="btn btn-warning btn-sm">Edit</a> <button class="btn btn-danger btn-sm delete-btn" data-id="' +
                            row.id +
                            '">Hapus</button>'
                        );
                    },
                },
            ],
        });

        $('#tableItem').on('click', '.delete-btn', function() {
            const itemId = $(this).data('id');
            // ALERT
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'api/item/' + itemId,
                        type: 'DELETE',
                        success: function(result) {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            )
                            table.ajax.reload();
                        }
                    });
                }
            })

        });
    });
</script>
<?php $this->endSection() ?>