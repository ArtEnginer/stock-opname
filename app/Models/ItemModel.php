<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Item as ItemEntity;

class ItemModel extends Model
{
    protected $table            = 'items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = ItemEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode',
        'nama',
        'satuan',
        'supplier',
        'harga_beli',
        'harga_jual',
        'harga_jual_grosir',
        'stok',
        'stok_opname',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
