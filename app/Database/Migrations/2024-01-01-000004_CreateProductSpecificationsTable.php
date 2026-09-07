<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductSpecificationsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'                  => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'product_id'          => ['type' => 'INT', 'unsigned' => true],
            'specification_name'  => ['type' => 'VARCHAR', 'constraint' => 200],
            'specification_value' => ['type' => 'TEXT'],
            'sort_order'          => ['type' => 'INT', 'default' => 0],
            'created_at'          => ['type' => 'DATETIME', 'null' => true],
            'updated_at'          => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('product_id');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_specifications');
    }

    public function down(): void
    {
        $this->forge->dropTable('product_specifications');
    }
}
