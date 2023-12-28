<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Db extends Migration
{
    public function up()
    {
        $timestamp = [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];
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
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'harga_jual' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'harga_jual_grosir' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'stok' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'stok_opname' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],

        ];

        $this->forge->addField($item);
        $this->forge->addField($timestamp);
        $this->forge->addKey('id', true);
        $this->forge->createTable('items');

        // stock opname
        $stock_opname = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode_opname' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_item' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'stok_lapangan' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'operator' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ];

        $this->forge->addField($stock_opname);
        $this->forge->addField($timestamp);
        $this->forge->addKey('id', true);
        $this->forge->createTable('stock_opname');
    }

    public function down()
    {
        $this->forge->dropTable('items');
        $this->forge->dropTable('stock_opname');
    }
}
