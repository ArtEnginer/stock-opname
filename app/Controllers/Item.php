<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Item extends BaseController
{
    function __construct()
    {
        $this->model = model('ItemModel');
    }
    public function index()
    {
        return view('Pages/Item/index');
    }
    public function import()
    {
        return view('Pages/Item/import');
    }
    public function export()
    {
        return view('Pages/Item/export');
    }
    public function download()
    {
        $data = $this->model->findAll();
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Kode');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Satuan');
        $sheet->setCellValue('D1', 'Harga Beli');
        $sheet->setCellValue('E1', 'Harga Jual');
        $sheet->setCellValue('F1', 'Harga Jual Grosir');
        $sheet->setCellValue('G1', 'Supplier');
        $sheet->setCellValue('H1', 'Stok');
        $i = 2;
        foreach ($data as $key => $value) {
            $sheet->setCellValue('A' . $i, $value->kode);
            $sheet->setCellValue('B' . $i, $value->nama);
            $sheet->setCellValue('C' . $i, $value->satuan);
            $sheet->setCellValue('D' . $i, $value->harga_beli);
            $sheet->setCellValue('E' . $i, $value->harga_jual);
            $sheet->setCellValue('F' . $i, $value->harga_jual_grosir);
            $sheet->setCellValue('G' . $i, $value->supplier);
            $sheet->setCellValue('H' . $i, $value->stok);
            $i++;
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Data Barang.xlsx';
        $writer->save($filename);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function cekItem()
    {
        return view('Pages/Item/cekItem');
    }
}
