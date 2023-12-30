<?php

namespace App\Controllers\API;

use App\Models\StockOpnameModel as model;
use App\Models\ItemModel as itemModel;
use CodeIgniter\RESTful\ResourceController;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Entities\StockOpname as StockOpnameEntity;


class StockOpname extends ResourceController
{

    public function __construct()
    {
        $this->model = new model();
        $this->itemModel = new itemModel();
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
        $item = $this->itemModel->find($input['id_item']);
        if (!$item) {
            $data = [
                'status' => 400,
                'message' => 'Item tidak ditemukan'
            ];
            return $this->respond($data);
        }
        $stok = $item->stok;
        $stok_lapangan = $input['stok_lapangan'];
        if ($stok_lapangan > $stok) {
            $status = 'Stok lapangan lebih besar dari stok sistem';
        } else if ($stok_lapangan < $stok) {
            $status = 'Stok lapangan lebih kecil dari stok sistem';
        } else {
            $status = 'Selesai';
        }
        $data = [
            'id_item' => $input['id_item'],
            'stok_lapangan' => $input['stok_lapangan'],
            'keterangan' => $input['keterangan'],
            'status' => $status,
        ];
        $this->model->insert($data);
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
}
