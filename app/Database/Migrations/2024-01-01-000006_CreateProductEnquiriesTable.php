<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductEnquiriesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'product_id'   => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'name'         => ['type' => 'VARCHAR', 'constraint' => 150],
            'company_name' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'email'        => ['type' => 'VARCHAR', 'constraint' => 150],
            'phone'        => ['type' => 'VARCHAR', 'constraint' => 30],
            'country'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'quantity'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'unit'         => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'message'      => ['type' => 'TEXT'],
            'status'       => ['type' => 'ENUM', 'constraint' => ['new', 'read', 'replied', 'closed'], 'default' => 'new'],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('product_id');
        $this->forge->addKey('status');
        $this->forge->addKey('created_at');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('product_enquiries');
    }

    public function down(): void
    {
        $this->forge->dropTable('product_enquiries');
    }
}
