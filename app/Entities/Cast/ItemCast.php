<?php

namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

class ItemCast extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('ItemModel');
        return $model->find($value);
    }
}
