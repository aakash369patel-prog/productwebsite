<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'                      => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'category_id'             => ['type' => 'INT', 'unsigned' => true],
            'name'                    => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'                    => ['type' => 'VARCHAR', 'constraint' => 255],
            'short_description'       => ['type' => 'TEXT', 'null' => true],
            'description'             => ['type' => 'TEXT', 'null' => true],
            'main_image'              => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'moq'                     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'moq_unit'                => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'applications'            => ['type' => 'TEXT', 'null' => true],
            'benefits'                => ['type' => 'TEXT', 'null' => true],
            'packaging_information'   => ['type' => 'TEXT', 'null' => true],
            'availability_information'=> ['type' => 'TEXT', 'null' => true],
            'meta_title'              => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_description'        => ['type' => 'TEXT', 'null' => true],
            'meta_keywords'           => ['type' => 'TEXT', 'null' => true],
            'is_featured'             => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'status'                  => ['type' => 'ENUM', 'constraint' => ['active', 'inactive'], 'default' => 'active'],
            'created_at'              => ['type' => 'DATETIME', 'null' => true],
            'updated_at'              => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addKey('category_id');
        $this->forge->addKey('status');
        $this->forge->addKey('is_featured');
        $this->forge->addForeignKey('category_id', 'product_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down(): void
    {
        $this->forge->dropTable('products');
    }
}
