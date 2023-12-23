<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Db extends Migration
{
    public function up()
    {
        $item = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'supplier' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'harga_beli' => [
                'type' => 'FLOAT',
                'constraint' => 11,
            ],
            'harga_jual' => [
                'type' => 'FLOAT',
                'constraint' => 11,
            ],
            'harga_jual_grosir' => [
                'type' => 'FLOAT',
                'constraint' => 11,
            ],
            'stok' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'stok_opname' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ];

        $this->forge->addField($item);
        $this->forge->addKey('id', true);
        $this->forge->createTable('items');
    }

    public function down()
    {
        $this->forge->dropTable('items');
    }
}
