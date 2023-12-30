<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class StockOpname extends BaseController
{
    function __construct()
    {
        $this->model = model('ItemModel');
        $this->soModel = model('StockOpnameModel');
    }

    public function index()
    {
        $data = [
            'title' => 'Stock Opname',
            'items' => $this->model->findAll(),
            'so' => $this->soModel->findAll(),
        ];
        return view('Pages/StockOpname/index');
    }

    public function create()
    {
        $data = [
            'title' => 'Stock Opname',
        ];
        return view('Pages/StockOpname/create', $data);
    }
}
