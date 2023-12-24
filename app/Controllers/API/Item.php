<?php

namespace App\Controllers\API;

use App\Models\ItemModel as model;
use CodeIgniter\RESTful\ResourceController;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class Item extends ResourceController
{

    public function __construct()
    {
        $this->model = new model();
        $this->ValidationId = 'item';
    }
    public function index()
    {
        $data = [
            'item' => $this->model->findAll()
        ];
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $input = $this->request->getVar();
        if (!$this->validate($this->ValidationId)) {
            return $this->fail($this->validator->getErrors());
        }
        $this->model->save($input);
        $data = [
            'status' => 200,
            'message' => 'Data berhasil ditambahkan'
        ];
        return $this->respond($data);
    }

    public function show($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->fail('Data tidak ditemukan');
        }
        $data = [
            'status' => 200,
            'data' => $this->model->find($id)
        ];
        return $this->respond($data);
    }

    public function update($id = null)
    {
        $input = $this->request->getVar();
        if (!$this->validate($this->ValidationId)) {
            return $this->fail($this->validator->getErrors());
        }
        $this->model->update($id, $input);
        $data = [
            'status' => 200,
            'message' => 'Data berhasil diupdate'
        ];
        return $this->respond($data);
    }

    public function remove($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->fail('Data tidak ditemukan');
        }

        $this->model->delete($id);

        $data = [
            'status' => 200,
            'message' => 'Data berhasil dihapus !!!!'
        ];

        return $this->respondDeleted($data);
    }

    public function delete($id = null)
    {
        return $this->remove($id);
    }


    public function import()
    {
        $file = $this->request->getFile('file');
        $excelMimes = [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        if (!in_array($file->getMimeType(), $excelMimes)) {
            return $this->fail('File yang diupload bukan file excel');
        }

        $reader = new Xlsx();
        $spreadsheet = $reader->load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];

        foreach ($sheetData as $key => $value) {
            if ($key > 0) {
                $existingData = $this->model->where('kode', $value[0])->get()->getRow();
                if ($existingData) {
                    $columnsToCheck = ['nama', 'satuan', 'harga_beli', 'harga_jual', 'harga_jual_grosir', 'supplier', 'stok'];
                    $needsUpdate = false;

                    foreach ($columnsToCheck as $index => $column) {
                        if ($existingData->{$column} != $value[$index + 1]) {
                            $needsUpdate = true;
                            break;
                        }
                    }
                    if ($needsUpdate) {
                        $updateData = [
                            'nama'              => $value[1],
                            'satuan'            => isset($value[2]) ? $value[2] : null,
                            'harga_beli'        => isset($value[3]) ? $value[3] : null,
                            'harga_jual'        => isset($value[4]) ? $value[4] : null,
                            'harga_jual_grosir' => isset($value[5]) ? $value[5] : null,
                            'supplier'          => isset($value[6]) ? $value[6] : null,
                            'stok'              => isset($value[7]) ? $value[7] : null,
                        ];

                        $this->model->update($existingData->id, $updateData);
                    }
                } else {
                    $data[] = [
                        'kode'              => isset($value[0]) ? $value[0] : null,
                        'nama'              => $value[1],
                        'satuan'            => isset($value[2]) ? $value[2] : null,
                        'harga_beli'        => isset($value[3]) ? $value[3] : null,
                        'harga_jual'        => isset($value[4]) ? $value[4] : null,
                        'harga_jual_grosir' => isset($value[5]) ? $value[5] : null,
                        'supplier'          => isset($value[6]) ? $value[6] : null,
                        'stok'              => isset($value[7]) ? $value[7] : null,
                    ];
                }
            }
        }

        if (!empty($data)) {
            $this->model->insertBatch($data);
        }

        $response = [
            'status' => 200,
            'message' => 'Data berhasil diimport'
        ];

        return $this->respond($response);
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
}
