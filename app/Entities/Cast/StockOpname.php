<?php

namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

class StockOpname extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('StockOpnameModel');
        return $model->find($value);
    }
}
