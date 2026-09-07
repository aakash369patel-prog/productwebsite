<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductCategoriesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'              => ['type' => 'VARCHAR', 'constraint' => 200],
            'slug'              => ['type' => 'VARCHAR', 'constraint' => 220],
            'short_description' => ['type' => 'TEXT', 'null' => true],
            'description'       => ['type' => 'TEXT', 'null' => true],
            'image'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_title'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_description'  => ['type' => 'TEXT', 'null' => true],
            'meta_keywords'     => ['type' => 'TEXT', 'null' => true],
            'sort_order'        => ['type' => 'INT', 'default' => 0],
            'status'            => ['type' => 'ENUM', 'constraint' => ['active', 'inactive'], 'default' => 'active'],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addKey('status');
        $this->forge->createTable('product_categories');
    }

    public function down(): void
    {
        $this->forge->dropTable('product_categories');
    }
}
