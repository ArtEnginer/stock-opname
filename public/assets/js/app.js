$(document).ready(function () {
  $("#tableItem").DataTable({
    responsive: true,
    ajax: {
      url: "api/v1/item",
      dataSrc: "item",
    },
    columns: [
      {
        data: null,
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      { data: "kode" },
      { data: "nama" },
      { data: "satuan" },
      { data: "harga_beli" },
      { data: "harga_jual" },
      { data: "harga_jual_grosir" },
      { data: "supplier" },
      { data: "stok" },
      {
        data: "action",
        render: function (data, type, row) {
          return (
            '<a href="item/' +
            row.id +
            '/edit" class="btn btn-warning btn-sm">Edit</a> <a href="item/' +
            row.id +
            '" class="btn btn-danger btn-sm">Hapus</a>'
          );
        },
      },
    ],
  });
});
