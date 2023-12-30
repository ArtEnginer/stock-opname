<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\StockOpname as StockOpnameEntity;

class StockOpnameModel extends Model
{
    protected $table            = 'stock_opname';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = StockOpnameEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_opname',
        'id_item',
        'stok_lapangan',
        'status',
        'keterangan',
        'operator',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
