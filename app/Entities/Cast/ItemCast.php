<?php

namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

class CastItem extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('ItemModel');
        return $model->find($value);
    }
}
