<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class StockOpname extends Entity
{
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id_item' => 'item',

    ];
    protected $castHandlers = [
        'item' => \App\Entities\Cast\ItemCast::class,
    ];
    protected $datamap = [
        'item' => 'id_item',
    ];
}
