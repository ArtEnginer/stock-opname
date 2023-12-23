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
}
