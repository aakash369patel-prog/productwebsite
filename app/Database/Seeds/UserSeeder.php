<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->db->table('users')->insert([
            'name'       => 'Administrator',
            'email'      => 'admin@example.com',
            'password'   => password_hash('Admin@123', PASSWORD_DEFAULT),
            'status'     => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
