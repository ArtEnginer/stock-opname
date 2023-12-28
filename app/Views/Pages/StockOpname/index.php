<?php $this->extend('Views/Layout/index.php') ?>
<?php $this->section('main') ?>
<div class="container mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Riwayat Opname</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableItem" class="display responsive" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Stok Sistem</th>
                        <th>Stok Lapangan</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Tanggal Opname</th>
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
                url: "api/so",
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