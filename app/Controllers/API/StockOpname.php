<?php

namespace App\Controllers\API;

use App\Models\StockOpnameModel as model;
use CodeIgniter\RESTful\ResourceController;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Entities\StockOpname as StockOpnameEntity;


class StockOpname extends ResourceController
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
}
