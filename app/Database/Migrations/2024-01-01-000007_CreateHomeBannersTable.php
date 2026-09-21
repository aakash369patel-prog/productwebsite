<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHomeBannersTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'                   => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'badge'                => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'title'                => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'          => ['type' => 'TEXT', 'null' => true],
            'image'                => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'button_text'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'button_url'           => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'secondary_button_text'=> ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'secondary_button_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order'           => ['type' => 'INT', 'default' => 0],
            'status'               => ['type' => 'ENUM', 'constraint' => ['active', 'inactive'], 'default' => 'active'],
            'created_at'           => ['type' => 'DATETIME', 'null' => true],
            'updated_at'           => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->addKey('sort_order');
        $this->forge->createTable('home_banners');

        $now = date('Y-m-d H:i:s');
        $this->db->table('home_banners')->insert([
            'badge'                 => 'Trusted B2B Exporter',
            'title'                 => 'Premium Natural Products for Global Markets',
            'description'           => 'We manufacture and export high-quality organic powders, essential oils, cold pressed oils and tea ingredients with export-grade documentation and reliable bulk supply.',
            'image'                 => null,
            'button_text'           => 'Explore Products',
            'button_url'            => 'products',
            'secondary_button_text' => 'Send Enquiry',
            'secondary_button_url'  => 'enquiry',
            'sort_order'            => 1,
            'status'                => 'active',
            'created_at'            => $now,
            'updated_at'            => $now,
        ]);
    }

    public function down(): void
    {
        $this->forge->dropTable('home_banners');
    }
}
